<?php
/*
 * Claims Importer
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

	return sprintf("%.{$precision}f", ($bytes / pow(1024, $pow))).$unit[$pow];
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
 * Upload files to the PQRS inbox and update the database information
 * @param  array   $filenameIds Array of file ids
 * @param  Options $options     Configuration options object
 */
function actionUpload(Options $options, $filenameIds = []) {
	$uploadCount = 0;

	foreach($_FILES['files']['error'] as $key => $error) {
		if(
			$error == UPLOAD_ERR_OK &&
			$_FILES['files']['type'][$key] == 'text/plain'
		) {
			move_uploaded_file(
				$_FILES['files']['tmp_name'][$key],
				$options->get('Inbox.path').'/'.basename($_FILES['files']['name'][$key])
			) && ++$uploadCount;
		}
	}

	if($uploadCount > 0) {
		actionRescan($options);
	}
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
	in_array($_POST['action'], ['Delete', 'Process', 'Rescan', 'Stage', 'Upload'])
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

$sections = [
	'Staged' => [ 'Process', 'Delete' ],
	'Queued' => [ 'Stage', 'Delete' ],
	'Processing' => [ 'Stage', 'Delete' ],
	'Failed' => [ 'Stage', 'Delete' ],
	'Completed' => [ 'Stage', 'Delete' ],
];

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
				border: 3px solid #006699;
				-webkit-border-radius: 12px;
				-moz-border-radius: 12px;
				border-radius: 12px;
				margin: 0;
			}
			.datagrid table {
				border-collapse: collapse;
				text-align: left;
				width: 100%;
			}
			.datagrid table td, .datagrid table th {
				padding: 2px 6px;
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
			.datagrid th.controls input,
			.datagrid th.controls input[type=file] + label {
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
				margin: 1px 2px 3px -1px;
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
			.datagrid th.controls input[type=file] {
				width: 0.1px;
				height: 0.1px;
				opacity: 0;
				overflow: hidden;
				position: absolute;
				z-index: -1;
			}
			.datagrid th.controls input[type=file] + label {
				cursor: pointer;
				padding: 3px 8px;
			}
			.datagrid th.controls input[type=file] + label * {
				pointer-events: none;
			}
			.datagrid th.controls input:hover,
			.datagrid th.controls input[type=file]:hover + label {
				box-shadow: 3px 3px 4px 1px rgba(255,255,255,0.6);
				-webkit-box-shadow: 3px 3px 4px 1px rgba(255,255,255,0.6);
				color: rgba(255,255,255,1);
			}
			.datagrid th.controls input:active,
			.datagrid th.controls input[type=file]:active + label {
				box-shadow: 0px 0px 8px 3px rgba(255,255,255,1);
				-webkit-box-shadow: 0px 0px 8px 3px rgba(255,255,255,1);
			}
		</style>
		<script>
			function selectAll(grid, changeTo = 'checked') {
				$('#' + grid + ' .datagrid input[type=checkbox]').prop({checked: changeTo});
			}

			$(document).ready(function() {
				$('input[type=file]').each(function() {
					var $input	 = $(this),
						$label	 = $input.next('label'),
						labelVal = $label.html();

					$input.on('change', function(e) {
						var fileName = '';

						if(this.files && this.files.length > 1) {
							fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
						} else if(e.target.value) {
							fileName = e.target.value.split('\\').pop();
						}

						if(fileName) {
							$label.find('span').html(fileName);
						} else {
							$label.html(labelVal);
						}
					});
				});
			});
		</script>
	</head>
	<body class="body_top">
		<h1>Claims Files: <?php echo count($files['Staged']) + count($files['Queued']) + count($files['Processing']) + count($files['Failed']) + count($files['Completed']); ?></h1>
		<form id="updateFiles" action="claims_importer.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls">
								<input type="submit" name="action" value="Rescan" />&nbsp;&mdash;&nbsp;OR&nbsp;&mdash;&nbsp;
								<input type="file" id="files" name="files[]" data-multiple-caption="{count} files selected" multiple="multiple" />
								<label for="files"><span>Choose a file</span></label>&nbsp;
								<input type="submit" name="action" value="Upload" />
							</th>
						</tr>
					</thead>
				</table>
			</div>
		</form>
<?php

foreach($sections as $sectionName => $actions) {

?>
		<form id="<?php echo strtolower($sectionName); ?>Grid" action="claims_importer.php" method="post" accept-charset="utf-8">
			<h2><?php echo $sectionName; ?> Files: <?php echo count($files[$sectionName]); ?></h2>
			<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th class="controls" colspan="3">
								<input type="button" value="Select All" onClick="selectAll('<?php echo strtolower($sectionName); ?>Grid');">&nbsp;
								<input type="button" value="Deselect All" onClick="selectAll('<?php echo strtolower($sectionName); ?>Grid', false);">&nbsp;|&nbsp;
<?php

	foreach($actions as $action) {

?>
								<input type="submit" name="action" value="<?php echo $action; ?>" />&nbsp;
<?php

	}

?>
							</th>
						</tr>
						<tr>
							<th>&check;</th>
							<th>Filename</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
<?php

	if(count($files[$sectionName])) {
		foreach($files[$sectionName] as $file) {

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
							<td colspan="4">No <?php echo strtolower($sectionName); ?> files in import directory.</td>
						</tr>
<?php

	}

?>
					</tbody>
				</table>
			</div>
		</form>
<?php

}

?>
	</body>
</html>