<?php
/**
 * Display PQRS Measures for (de)activation
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
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>.
 *
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @link    http://SuncoastConnection.com
 * @author  Sam Likins <sam.likins@wsi-services.com>
 */

// SANITIZE ALL ESCAPES
$sanitize_all_escapes = true;

// STOP FAKE REGISTER GLOBALS
$fake_register_globals = false;

require_once '../../globals.php';
require_once $srcdir.'/api.inc';

$updateStatus = array(
	'off' => array(),
	'on' => array()
);

if(array_key_exists('action', $_GET) && $_GET['action'] == 'save') {
	if(array_key_exists('pqrsRules', $_POST)) {
		$pqrsRules = $_POST['pqrsRules'];
	} else {
		$pqrsRules = array();
	}

	if(array_key_exists('pqrsRulesInitial', $_POST)) {
		$pqrsRulesInitial = $_POST['pqrsRulesInitial'];
	} else {
		$pqrsRulesInitial = array();
	}

	foreach($pqrsRulesInitial as $pqrsRule => $pqrsRuleActive) {
		if(($pqrsRuleActive == '1' && !array_key_exists($pqrsRule, $pqrsRules)) ||
			($pqrsRuleActive == '0' && array_key_exists($pqrsRule, $pqrsRules))
		) {
			$pqrsRuleActive = ($pqrsRuleActive == 1 ? 0 : 1);

			sqlStatementNoLog('UPDATE `clinical_rules`
				SET `active` = ?
				WHERE `id` = ?;',
				array(
					$pqrsRuleActive,
					$pqrsRule
				)
			);

			$updateStatus[($pqrsRuleActive == 0 ? 'off' : 'on')][] = $pqrsRule;
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css">
		<style>
h1, h2, h3 {
	margin-bottom: 0.25ex;
}
#measures ul {
	padding-left: 1em;
}
#measures li {
	list-style: none;
}
.updateStatus {
	color: #007c00;
}
.updateCount {
	font-weight: bold;
}
.checkbox-button {
	display: inline-block;
}
.checkbox-button label {
	background-color: #808080;
	border: 1px solid #333333;
	border-radius: 4px;
	color: #f0f0f0;
	display: inline-block;
	font-family: monospace;
	margin: 0.25ex 0.15ex 0.15ex 0ex;
	padding: 0 0.75ex;
	text-size: 16pt;
}
.checkbox-button label:before {
	color: #ff0000;
	content: '\2718';
	padding-right: 0.5ex;
}
.checkbox-button input[type=checkbox]:checked + label {
	color: #333333;
	background-color: #f0f0f0;
}
.checkbox-button input[type=checkbox]:checked + label:before {
	color: #007c00;
	content: '\2714';
}
.checkbox-button input[type=checkbox] {
	display: none;
}
		</style>
		<script type="text/javascript" src="../../../library/js/jquery-1.9.1.min.js"></script>
		<script language="JavaScript">
$(document).ready(function() {
	$('input[type=checkbox]').change(function(e) {
		var checked = $(this).prop('checked'),
			container = $(this).parent(),
			siblings = container.siblings();

		container.find('input[type=checkbox]').prop({
			indeterminate: false,
			checked: checked
		});

		function checkSiblings(element) {
			var parent = element.parent().parent(),
			all = true;

			element.siblings().each(function() {
				return all = ($(this).children('input[type=checkbox]').prop('checked') === checked);
			});

			if(all && checked) {
				parent.children('input[type=checkbox]').prop({
					indeterminate: false,
					checked: checked
				});

				checkSiblings(parent);
			} else if(all && !checked) {
				parent.children('input[type=checkbox]').prop('checked', checked);
				parent.children('input[type=checkbox]').prop('indeterminate', (parent.find('input[type=checkbox]:checked').length > 0));

				checkSiblings(parent);
			} else {
				element.parents('li').children('input[type=checkbox]').prop({
					indeterminate: true,
					checked: false
				});
			}
		}

		checkSiblings(container);
	});

	$('#measures ul').each(function() {
		measure = $(this).children('li.checkbox-button').first();

		if(measure.length) {
			checkbox = $(measure).children('input[type=checkbox]');
			$(checkbox).click();
			$(checkbox).click();
		}
	});
});
		</script>
	</head>
	<body class="body_top">
		<form action="?action=save" method="post">
			<h1>PQRS Measures Selector</h1>
<?php

if(count($updateStatus['off']) || count($updateStatus['on'])) {

?>
			<p class="updateStatus">Updated <span class="updateCount"><?php echo count($updateStatus['off']) + count($updateStatus['on']); ?></span> measures [<?php echo (count($updateStatus['off']) ? ' Off: <span class="updateCount">'.count($updateStatus['off']).'</span>' : '').(count($updateStatus['on']) ? ' On: <span class="updateCount">'.count($updateStatus['on']).'</span>' : ''); ?> ]</p>
<?php

}

?>
			<p><input type="submit" value="Update" /></p>
			<div id="measures">
				<ul>
					<li>
						<input type="checkbox" id="pqrs-toggle">
						<label for="pqrs-toggle">All Measures</label>
						<ul>
							<li>
								<input type="checkbox" id="individual-toggle">
								<label for="individual-toggle">Individual Measures</label>
								<ul>
<?php

$rules = sqlStatementNoLog(
	'SELECT `id`, `active`
	FROM `clinical_rules`
	WHERE `id` LIKE "PQRS_%"
		AND `id` NOT LIKE "%_Group_%"
	ORDER BY `id` ASC;'
);

foreach($rules as $rule) {
	$id = $rule['id'];
	$active = $rule['active'];

	$idParts = explode('_', $id);
	array_shift($idParts);
	$label = implode(' ', $idParts);

?>
									<li class="checkbox-button">
										<input type="hidden" name="pqrsRulesInitial[<?php echo $id; ?>]" value="<?php echo $active ?>">
										<input type="checkbox" class="measure" id="<?php echo $id; ?>" name="pqrsRules[<?php echo $id; ?>]" value="1"<?php if($active == 1) { echo ' checked="checked"'; } ?>>
										<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
									</li>
<?php

}

?>
								</ul>
							</li>
							<li>
								<input type="checkbox" id="group-toggle">
								<label for="group-toggle">Group Measures</label>
								<ul>
<?php

$rules = sqlStatementNoLog(
	'SELECT `id`, `active`
	FROM `clinical_rules`
	WHERE `id` LIKE "PQRS_Group_%"
	ORDER BY `id` ASC;'
);

$previousGroup = '';

foreach($rules as $rule) {
	$id = $rule['id'];
	$active = $rule['active'];

	$idParts = explode('_', $id);
	array_shift($idParts);
	array_shift($idParts);
	$label = array_pop($idParts);
	$group = implode(' ', $idParts);
	$section = strtolower($group);

	if($group !== $previousGroup) {
		if($previousGroup !== '') {

?>
										</ul>
									</li>
<?php

		}

?>
									<li>
										<input type="checkbox" id="<?php echo $section; ?>-toggle">
										<label for="<?php echo $section; ?>-toggle"><?php echo $group; ?></label>

										<ul>
<?php

	}

?>
											<li class="checkbox-button">
												<input type="hidden" name="pqrsRulesInitial[<?php echo $id; ?>]" value="<?php echo $active ?>">
												<input type="checkbox" class="measure" id="<?php echo $id; ?>" name="pqrsRules[<?php echo $id; ?>]" value="1"<?php if($active == 1) { echo ' checked="checked"'; } ?>>
												<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
											</li>
<?php

	$previousGroup = $group;
}

?>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<p><input type="submit" value="Update" /></p>
		</form>
	</body>
</html>