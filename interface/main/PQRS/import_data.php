<?php
/*
 *Claims2OEMR import script
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @package OpenEMR
 * @link    http://www.oemr.org
 * @link    http://suncoastconnection.com
 * @author  Suncoast Connection
*/

use \SunCoastConnection\ClaimsToOEMR\Document\Options;
use \SunCoastConnection\ClaimsToOEMR\Document\Raw;
use \SunCoastConnection\ClaimsToOEMR\Store\Database;
use \SunCoastConnection\ClaimsToOEMR\X12N837;
use \SunCoastConnection\ClaimsToOEMR\X12N837\Cache;
use \Symfony\Component\Finder\Finder;
use \Symfony\Component\Finder\SplFileInfo;

// SANITIZE ALL ESCAPES
$sanitize_all_escapes = true;
// STOP FAKE REGISTER GLOBALS
$fake_register_globals = false;

require_once('../../globals.php');
include_once($srcdir.'/api.inc');

/**
 * Return a human readable size of provided bite size with defined precission
 * @param  integer $bytes     Bite size to convert to human readable
 * @param  integer $precision Percision of returned value
 * @return string             Human readable value
 */
function humanFilesize($bytes, $precision = 2) {
	$unit = 'BKMGTPEZYXSD';

	$pow = floor((strlen($bytes) - 1) / 3);
	$pow = ($pow > 12 ? 12 : $pow);

	$precision = ($pow > 0 ? $precision : 0);

	return sprintf("%.{$precision}f", ($bytes / pow(1024, $pow))).@$unit[$pow];
}

/**
 * Return array of statuses with arrays of file informantion
 * @return array Array of statuses with associated file information
 */
function getFiles() {
	$records = sqlStatementNoLog('SELECT * FROM `pqrs_import_files` ORDER BY `relative_path` ASC;');

	$files = [
		'Staged' => [],
		'Queued' => [],
		'Processing' => [],
		'Failed' => [],
		'Completed' => []
	];

	while(!$records->EOF) {
		$file = $records->FetchRow();
		$file['size'] = humanFilesize($file['size']);

		$files[$file['status']][] = $file;
	}

	return $files;
}

/**
 * Run a scan of the PQRS inbox and update the database information
 * @param  array   $filenameIds Array of file ids
 * @param  Options $options     Configuration options object
 */
function actionRescan(Options $options, $filenameIds = []) {
	$finder = new Finder;
	$finder->files()
		->in($options->get('Inbox.path'))
		->name($options->get('Inbox.pattern'))
		->ignoreDotFiles(false)
		->notName('.gitignore')
		->sortByName();

	if($options->get('Inbox.recursive') == false) {
		$finder->depth('== 0');
	}

	$filenameIds = [ 0 ];

	if($finder->count()) {
		foreach($finder as $file) {
			$record = sqlQueryNoLog(
				'SELECT * FROM `pqrs_import_files` WHERE `relative_path` = ?;',
				[
					$file->getRelativePathname()
				]
			);

			$filenameIds[] = $record['id'];

			if($record === false) {
				sqlStatementNoLog(
					'INSERT INTO `pqrs_import_files` (`status`, `relative_path`, `size`, `md5`, `staged_datetime`) VALUES ("Staged", ?, ?, ?, NOW());',
					[
						$file->getRelativePathname(),
						$file->getSize(),
						md5_file($file->getRealpath())
					]
				);
			} elseif($file->getSize() != $record['size']) {
				sqlStatementNoLog(
					'UPDATE `pqrs_import_files` SET `status` = "Staged", `size` = ?, `md5` = ?, `staged_datetime` = NOW(), `queued_datetime` = NULL, `processing_datetime` = NULL, `processing_id` = NULL, `failed_datetime` = NULL, `failed_reason` = NULL, `completed_datetime` = NULL WHERE `id` = ?;',
					[
						$file->getSize(),
						md5_file($file->getRealpath()),
						$record['id'],
					]
				);
			}
		}
	}

	$records = sqlStatementNoLog(
		'SELECT `id`, `relative_path` FROM `pqrs_import_files` WHERE `id` NOT IN ('.implode(', ', array_fill(0, count($filenameIds), '?')).');',
		$filenameIds
	);

	while(!$records->EOF) {
		$record = $records->FetchRow();

		if(!is_file($options->get('Inbox.path').'/'.$record['relative_path'])) {
			sqlStatementNoLog(
				'DELETE FROM `pqrs_import_files` WHERE `id` = ?;',
				[
					$record['id']
				]
			);
		}
	}
}

/**
 * Process files base on provided file ids
 * @param  array   $filenameIds Array of file ids
 * @param  Options $options     Configuration options object
 */
function actionProcess(Options $options, $filenameIds = []) {
	sqlStatementNoLog(
		'UPDATE `pqrs_import_files` SET `status` = "Queued", `queued_datetime` = NOW() WHERE `id` IN ('.implode(', ', array_fill(0, count($filenameIds), '?')).');',
		$filenameIds
	);

	$options->set('App.store', Database::getInstance($options));
	$inboxPath = $options->get('Inbox.path');

	foreach($filenameIds as $filenameId) {
		sqlStatementNoLog(
			'UPDATE `pqrs_import_files` SET `status` = "Processing", `processing_datetime` = NOW() WHERE `id` = ?;',
			[
				$filenameId
			]
		);

		$failed = false;

		try {
			$file = sqlQueryNoLog(
				'SELECT `relative_path` FROM `pqrs_import_files` WHERE `id` = ?;',
				[
					$filenameId
				]
			);

			$raw = Raw::getInstance($options);
			$raw->parseFromFile($inboxPath.'/'.$file['relative_path']);

			$document = X12N837::getInstance($options);
			$document->parse($raw);

			$cache = Cache::getInstance($options->get('App.store'));
			$cache->processDocument($document);
		} catch(Exception $e) {
			$failed = true;
			$failedReason = $e->getMessage();
		}

		if($failed) {
			sqlStatementNoLog(
				'UPDATE `pqrs_import_files` SET `status` = "Failed", `failed_datetime` = NOW(), `failed_reason` = ? WHERE `id` = ?;',
				[
					$failedReason,
					$filenameId
				]
			);
		} else {
			sqlStatementNoLog(
				'UPDATE `pqrs_import_files` SET `status` = "Completed", `completed_datetime` = NOW() WHERE `id` = ?;',
				[
					$filenameId
				]
			);
		}

	}
}

/**
 * Reset status to staged based on provided file ids
 * @param  array   $filenameIds Array of file ids
 * @param  Options $options     Configuration options object
 */
function actionStage(Options $options, $filenameIds = []) {
	sqlStatementNoLog(
		'UPDATE `pqrs_import_files` SET `status` = "Staged", `queued_datetime` = NULL, `processing_datetime` = NULL, `processing_id` = NULL, `failed_datetime` = NULL, `failed_reason` = NULL, `completed_datetime` = NULL WHERE `id` IN ('.implode(', ', array_fill(0, count($filenameIds), '?')).');',
		$filenameIds
	);
}

/**
 * Remove files and records based on file ids
 * @param  array   $filenameIds Array of file ids
 * @param  Options $options     Configuration options object
 */
function actionDelete(Options $options, $filenameIds = []) {
	$records = sqlStatementNoLog(
		'SELECT `id`, `relative_path` FROM `pqrs_import_files` WHERE `id` IN ('.implode(', ', array_fill(0, count($filenameIds), '?')).');',
		$filenameIds
	);

	while(!$records->EOF) {
		$record = $records->FetchRow();

		unlink($options->get('Inbox.path').'/'.$record['relative_path']);

		sqlStatementNoLog(
			'DELETE FROM `pqrs_import_files` WHERE `id` = ?;',
			[
				$record['id']
			]
		);
	}
}

if(
	array_key_exists('action', $_POST) &&
	in_array($_POST['action'], ['Delete', 'Process', 'Rescan', 'Stage'])
) {
	$options = Options::getInstance(require_once(__DIR__.'/claimsToOEMRConfig.php'));

	$actionFunction = 'action'.$_POST['action'];

	if(array_key_exists('filename', $_POST)) {
		$filenames = $_POST['filename'];
	} else {
		$filenames = [];
	}

	$actionFunction($options, $filenames);
}

$files = getFiles();

?>
<html>
	<head>
		<title>PQRS Importer</title>
		<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css">
		<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery-1.9.1.min.js"></script>
		<style type="text/css" media="screen">
			html, body {
				margin: 0;
				padding: 0.5ex;
			}
			.topPad {
				margin-top: 1ex;
				font-weight: bold;
			}
			.datagrid {
				font: normal 12px/150% Arial, Helvetica, sans-serif;
				background: #fff;
				overflow: hidden;
				border: 1px solid #006699;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				margin: 1ex 0;
			}
			.datagrid table {
				border-collapse: collapse;
				text-align: left;
				width: 100%;
			}
			.datagrid table td, .datagrid table th {
				padding: 3px 10px;
			}
			.datagrid table thead th {
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F));
				background: -moz-linear-gradient(center top, #006699 5%, #00557F 100%);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');
				background-color: #006699;
				color:#FFFFFF;
				font-size: 15px;
				font-weight: bold;
				border-left: 1px solid #0070A8;
			}
			.datagrid table thead th:first-child {
				border: none;
			}
			.datagrid table thead th:nth-child(1),
			.datagrid table tbody td:nth-child(1) {
				text-align: center;
			}
			.datagrid table thead th:nth-child(2),
			.datagrid table tbody td:nth-child(2) {
				width: 100%;
				text-align: left;
			}
			.datagrid table thead th:nth-child(3),
			.datagrid table tbody td:nth-child(3) {
				text-align: right;
			}
			.datagrid table thead th.controls {
				text-align: left;
			}
			.datagrid table tbody td {
				color: #00496B;
				border-left: 1px solid #E1EEF4;
				font-size: 12px;
				font-weight: normal;
			}
			.datagrid table tbody tr:nth-child(even) td {
				background: #E1EEF4;
			}
			.datagrid table tbody td:first-child {
				border-left: none;
			}
			.datagrid table tbody tr:last-child td {
				border-bottom: none;
			}
			.datagrid th.controls input {
				background: #0199d9;
				border-radius: 8px;
				-webkit-border-radius: 8px;
				border: 2px solid #ffffff;
				box-shadow: 3px 3px 4px 1px rgba(255,255,255,0.2);
				-webkit-box-shadow: 3px 3px 4px 1px rgba(255,255,255,0.2);
				box-sizing: content-box;
				-moz-box-sizing: content-box;
				-webkit-box-sizing: content-box;
				color: rgba(255,255,255,0.8);
				display: inline-block;
				font-weight: bold;
				margin: 0 5px 5px 0;
				opacity: 1;
				padding: 4px 8px;
				text-shadow: -1px -1px 0 rgba(15,73,168,0.66);
				transform-origin: 50% 50% 0;
				-webkit-transform-origin: 50% 50% 0;
				transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
				-moz-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
				-o-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
				-webkit-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
			}
			.datagrid th.controls input:hover {
				box-shadow: 3px 3px 4px 1px rgba(255,255,255,0.6);
				-webkit-box-shadow: 3px 3px 4px 1px rgba(255,255,255,0.6);
				color: rgba(255,255,255,1);
			}
			.datagrid th.controls input:active {
				box-shadow: 0px 0px 8px 3px rgba(255,255,255,1);
				-webkit-box-shadow: 0px 0px 8px 3px rgba(255,255,255,1);
 			}
		</style>
		<script>
			function selectAll(grid, changeTo = 'checked') {
				$('#' + grid + ' .datagrid input[type=checkbox]').prop({checked: changeTo});
			}
		</script>
	</head>
	<body class="body_top">
		<h1>Claims Files: <?php echo count($files['Staged']) + count($files['Queued']) + count($files['Processing']) + count($files['Failed']) + count($files['Completed']); ?></h1>
		<form id="stagedGrid" action="import_data.php" method="post">
			<h2>Staged Files: <?php echo count($files['Staged']); ?></h2>
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls" colspan="3">
								<input type="button" value="Select All" onClick="selectAll('stagedGrid');">&nbsp;
								<input type="button" value="Deselect All" onClick="selectAll('stagedGrid', false);">&nbsp;|&nbsp;
								<input type="submit" name="action" value="Rescan" />&nbsp;
								<input type="submit" name="action" value="Process" />&nbsp;
								<input type="submit" name="action" value="Delete" />&nbsp;
							</th>
						</tr>
						<tr>
							<th>Include</th>
							<th>Filename</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
<?php

if(count($files['Staged'])) {
	foreach($files['Staged'] as $file) {

?>
						<tr>
							<td><input type="checkbox" name="filename[]" value="<?php echo $file['id']; ?>"></td>
							<td><?php echo $file['relative_path']; ?></td>
							<td><?php echo $file['size']; ?></td>
						</tr>
<?php

	}
} else {

?>
						<tr>
							<td colspan="4">No staged files in import directory.</td>
						</tr>
<?php

}

?>
					</tbody>
				</table>
			</div>
		</form>
		<form id="queuedGrid" action="import_data.php" method="post">
			<h2>Queued Files: <?php echo count($files['Queued']); ?></h2>
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls" colspan="3">
								<input type="button" value="Select All" onClick="selectAll('queuedGrid');">&nbsp;
								<input type="button" value="Deselect All" onClick="selectAll('queuedGrid', false);">&nbsp;|&nbsp;
								<input type="submit" name="action" value="Stage" />&nbsp;
								<input type="submit" name="action" value="Delete" />&nbsp;
							</th>
						</tr>
						<tr>
							<th>Include</th>
							<th>Filename</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
<?php

if(count($files['Queued'])) {
	foreach($files['Queued'] as $file) {

?>
						<tr>
							<td><input type="checkbox" name="filename[]" value="<?php echo $file['id']; ?>"></td>
							<td><?php echo $file['relative_path']; ?></td>
							<td><?php echo $file['size']; ?></td>
						</tr>
<?php

	}
} else {

?>
						<tr>
							<td colspan="4">No queued files in import directory.</td>
						</tr>
<?php

}

?>
					</tbody>
				</table>
			</div>
		</form>
		<form id="processingGrid" action="import_data.php" method="post">
			<h2>Processing Files: <?php echo count($files['Processing']); ?></h2>
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls" colspan="3">
								<input type="button" value="Select All" onClick="selectAll('processingGrid');">&nbsp;
								<input type="button" value="Deselect All" onClick="selectAll('processingGrid', false);">&nbsp;|&nbsp;
								<input type="submit" name="action" value="Stage" />&nbsp;
								<input type="submit" name="action" value="Delete" />&nbsp;
							</th>
						</tr>
						<tr>
							<th>Include</th>
							<th>Filename</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
<?php

if(count($files['Processing'])) {
	foreach($files['Processing'] as $file) {

?>
						<tr>
							<td><input type="checkbox" name="filename[]" value="<?php echo $file['id']; ?>"></td>
							<td><?php echo $file['relative_path']; ?></td>
							<td><?php echo $file['size']; ?></td>
						</tr>
<?php

	}
} else {

?>
						<tr>
							<td colspan="4">No processing files in import directory.</td>
						</tr>
<?php

}

?>
					</tbody>
				</table>
			</div>
		</form>
		<form id="failedGrid" action="import_data.php" method="post">
			<h2>Failed Files: <?php echo count($files['Failed']); ?></h2>
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls" colspan="3">
								<input type="button" value="Select All" onClick="selectAll('failedGrid');">&nbsp;
								<input type="button" value="Deselect All" onClick="selectAll('failedGrid', false);">&nbsp;|&nbsp;
								<input type="submit" name="action" value="Stage" />&nbsp;
								<input type="submit" name="action" value="Delete" />&nbsp;
							</th>
						</tr>
						<tr>
							<th>Include</th>
							<th>Filename</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
<?php

if(count($files['Failed'])) {
	foreach($files['Failed'] as $file) {

?>
						<tr>
							<td><input type="checkbox" name="filename[]" value="<?php echo $file['id']; ?>"></td>
							<td><?php echo $file['relative_path']; ?></td>
							<td><?php echo $file['size']; ?></td>
						</tr>
<?php

	}
} else {

?>
						<tr>
							<td colspan="4">No failed files in import directory.</td>
						</tr>
<?php

}

?>
					</tbody>
				</table>
			</div>
		</form>
		<form id="completedGrid" action="import_data.php" method="post">
			<h2>Completed Files: <?php echo count($files['Completed']); ?></h2>
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls" colspan="3">
								<input type="button" value="Select All" onClick="selectAll('completedGrid');">&nbsp;
								<input type="button" value="Deselect All" onClick="selectAll('completedGrid', false);">&nbsp;|&nbsp;
								<input type="submit" name="action" value="Stage" />&nbsp;
								<input type="submit" name="action" value="Delete" />&nbsp;
							</th>
						</tr>
						<tr>
							<th>Include</th>
							<th>Filename</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
<?php

if(count($files['Completed'])) {
	foreach($files['Completed'] as $file) {

?>
						<tr>
							<td><input type="checkbox" name="filename[]" value="<?php echo $file['id']; ?>"></td>
							<td><?php echo $file['relative_path']; ?></td>
							<td><?php echo $file['size']; ?></td>
						</tr>
<?php

	}
} else {

?>
						<tr>
							<td colspan="4">No completed files in import directory.</td>
						</tr>
<?php

}

?>
					</tbody>
				</table>
			</div>
		</form>
	</body>
</html>