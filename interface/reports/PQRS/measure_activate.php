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
.quickselect {
	background-color: #f0f0f0;
	border: 1px solid #333333;
	border-radius: 4px;
	color: #333333;
	display: inline-block;
	font-family: monospace;
	margin: 0.25ex 0.15ex 0.15ex 0ex;
	padding: 0 0.75ex;
	font-size: 9pt;
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

	function quickSelect(specialty) {
		var mymeasurelist;
		console.log('Called quickSelect() with ' + specialty);
		switch(specialty) {
			case "AllergyImmunology":
				//console.log('AllergyImmunology!');
				mymeasurelist = [110, 111, 130, 226, 317, 331, 332, 333, 334, 398, 402];
				break;
			case "Anesthesiology":
				//console.log('Anesthesiology!');
				mymeasurelist = [44, 76, 130, 317, 404, 424, 426, 427, 430];
				break;
			case "Cardiology":
				//console.log('Cardiology!');
				mymeasurelist = [5, 6, 7, 8, 47, 118, 128, 130, 204, 226, 236, 317, 322, 323, 324, 326, 348, 392, 393, 399, 402, 431, 438];
				break;
			case "ChronicConditions":
				//console.log('Chronic Conditions');
				mymeasurelist = [46, 47, 48, 110, 111, 128, 130, 131, 134, 154, 155, 181, 226, 236, 238];
				break;
			case "Dermatology":
				//console.log('Dermatology');
				mymeasurelist = [128, 130, 137, 138, 224, 226, 265, 317, 337, 397, 402, 410, 431];
                                break;
                        case "EmergencyMedicine":
				//console.log('Emergency Medicine');
                                mymeasurelist = [47, 54, 66, 91, 93, 116, 130, 226, 254, 255, 317, 402, 415, 416, 431];
                                break;
                        case "Gastroenterology":
                                //console.log('Gastroenterology');
                                mymeasurelist = [47, 113, 128, 130, 185, 226, 271, 275, 317, 320, 343, 387, 390, 400, 401, 402, 431, 438, 439];
				break;
                        case "GeneralFamilyMedicine":
                                //console.log('General/Family Medicine');
                                mymeasurelist = [1, 5, 7, 8, 41, 47, 48, 50, 65, 66, 93, 109, 110, 112, 113, 116, 117, 119, 128, 134, 154, 155, 181, 204, 226, 236, 317, 326, 331, 332, 333, 334, 337, 342, 343, 370, 383, 387, 390, 391, 394, 398, 400, 401, 402, 408, 412, 414, 418, 431, 438];
                                break;
                        case "Hospitalist":
                                //console.log('Hospitalist');
                                mymeasurelist = [5, 8, 32, 47, 76, 128, 130, 187, 226, 317, 402, 407, 431];
                                break;
                        case "InfectiousDisease":
                                //console.log('Infectious Disease');
                                mymeasurelist = [47, 76, 130, 134, 205, 226, 387, 400, 401, 402, 431];
                                break;
                        case "InternalMedicine":
                                //console.log('Internal Medicine');
                                mymeasurelist = [1, 5, 41, 47, 48, 50, 109, 110, 112, 113, 116, 117, 128, 130, 134, 154, 155, 181, 204, 226, 236, 317, 326, 331, 332, 333, 334, 387, 390, 400, 401, 402, 408, 412, 414, 418, 431, 438];
                                break;
                        case "MentalBehavioralHealth":
                                //console.log('Mental Health/BehavioralHealth');
                                mymeasurelist = [47, 128, 130, 134, 181, 226, 325, 370, 383, 391, 402, 411, 431];
                                break;
                        case "Neurology":
                                //console.log('Neurology');
                                mymeasurelist = [32, 47, 128, 130, 226, 268, 317, 386, 402, 408, 412, 414, 419, 431, 435];
                                break;
                        case "OBGYN":
                                //console.log('OB-GYN');
                                mymeasurelist = [39, 41, 47, 48, 50, 53, 110, 112, 130, 204, 226, 236, 265, 317, 402, 418, 422, 431, 432, 433, 434];
                                break;
                        case "OncologyHematology":
                                //console.log('Oncology-Hematology');
                                mymeasurelist = [47, 67, 68, 69, 70, 71, 72, 102, 111, 128, 130, 143, 144, 226, 250, 317, 402, 431];
                                break;
                        case "Ophthalmology":
                                //console.log('Ophthalmology');
                                mymeasurelist = [12, 14, 19, 47, 117, 130, 140, 141, 191, 192, 226, 303, 304, 384, 385, 388, 389, 402];
                                break;
                        case "Orthopedics":
                                //console.log('Orthopedics');
                                mymeasurelist = [21, 22, 23, 24, 32, 39, 41, 46, 47, 109, 110, 111, 128, 130, 131, 154, 155, 182, 226, 238, 317, 358, 402, 431];
                                break;
                        case "PainSpecialist":
                                //console.log('Pain Specialist');
                                mymeasurelist = [1, 41, 47, 109, 110, 111, 128, 130, 131, 134, 154, 155, 204, 226, 238, 317, 402, 408, 412, 414];
                                break;
                        case "Pathology":
                                //console.log('Pathology');
                                mymeasurelist = [99, 100, 249, 250, 251, 395, 396, 397];
                                break;
                        case "Pediatrics":
                                //console.log('Pediatrics');
                                mymeasurelist = [66, 69, 91, 93, 110, 134, 205, 391, 394, 402];
                                break;
                        case "PhysicalOccupationalTherapy":
                                //console.log('Physical Therapy/Occupational Therapy');
                                mymeasurelist = [126, 127, 128, 130, 131, 134, 154, 155, 181, 182, 217, 218, 219, 220, 221, 222, 223, 226, 431];
                                break;
                        case "Podiatry":
                                //console.log('Podiatry');
                                mymeasurelist = [110, 111, 126, 127, 128, 130, 226, 236];
                                break;
                        case "Radiology":
                                //console.log('Radiology');
                                mymeasurelist = [102, 143, 144, 145, 146, 147, 156, 195, 225, 226, 259, 265, 322, 323, 324, 344, 345, 358, 405, 406, 436];
                                break;
                        case "SurgeryGeneral":
                                //console.log('Surgery (General)');
                                mymeasurelist = [21, 22, 23, 47, 128, 130, 185, 226, 317, 320, 343, 358, 402, 431];
                                break;
                        case "Urology":
                                //console.log('Urology');
                                mymeasurelist = [47, 48, 50, 102, 104, 119, 130, 226, 265, 317, 358, 402, 431];
                                break;
			case "MIPS-1 Allergy/Immunology":
				mymeasurelist = [110,111,130,160,226,317,331,332,333,334,374,398,402,444];
				break;
			case "MIPS-2 Anesthesiology":
				mymeasurelist = [44,76,130,317,404,424,426,427,430];
                                break;
                        case "MIPS-3 Cardiology":
				mymeasurelist = [5,6,7,8,47,118,128,130,204,226,236,317,322,323,324,326,402,431,438];
                                break;
                        case "MIPS-4 Dermatology":
                                mymeasurelist = [130,137,138,224,226,265,317,337,402,410];
                                break;
                        case "MIPS-5 Diagnostic Radiology":
                                mymeasurelist = [145,146,147,195,225,359,360,361,362,363,364,405,406,436];
                                break;
                        case "MIPS-6 Electrophysiology Cardiac Specialist":
                                mymeasurelist = [348,392,393];
                                break;
                        case "MIPS-7 Emergency Medicine":
                                mymeasurelist = [47,66,91,93,116,130,226,254,255,317,402,415,416,431];
                                break;
                        case "MIPS-8 Gastroenterology":
                                mymeasurelist = [47,128,130,185,226,271,275,317,320,343,390,401,402,431,439];
                                break;
                        case "MIPS-9 General Oncology":
                                mymeasurelist = [47,102,130,143,226,250,317,402,431,449,450,451,452,453,454,455,456,457];
                                break;
                        case "MIPS-10 General Practice/Family Medicine":
                                mymeasurelist = [1,5,7,8,47,50,65,66,93,109,110,112,113,116,117,119,128,130,134,154,155,181,204,226,236,317,326,331,332,333,334,337,338,342,370,387,394,398,400,401,402,408,412,414,418,431,438,442,443,444];
                                break;
                        case "MIPS-11 General Surgery":
                                mymeasurelist = [21,23,47,128,130,226,317,354,355,356,357,358,402];
                                break;
                        case "MIPS-12 Hospitalists":
                                mymeasurelist = [5,8,32,47,76,128,130,226,317,402,407,431];
                                break;
                        case "MIPS-13 Internal Medicine":
                                mymeasurelist = [1,5,47,50,109,110,112,113,116,117,128,130,134,154,155,181,204,226,236,317,326,331,332,333,334,387,400,401,402,408,412,414,418,431,438];
                                break;
                        case "MIPS-14 Interventional Radiology":
                                mymeasurelist = [259,265,344,345];
                                break;
                        case "MIPS-15 Mental Health/Behavioral Health/Dementia":
                                mymeasurelist = [47,128,130,134,181,226,282,283,284,286,288,317,325,370,383,391,402,411,431];
                                break;
                        case "MIPS-16 Neurology":
                                mymeasurelist = [32,47,128,130,226,268,282,283,284,286,288,290,291,293,294,317,386,402,408,412,414,419,431,435];
                                break;
                        case "MIPS-17 Obstetrics and Gynecology":
                                mymeasurelist = [47,48,50,110,112,128,130,226,236,265,317,402,418,422,431,432,433,434,443,447,448];
                                break;
                        case "MIPS-18 Ophlamology":
                                mymeasurelist = [12,14,19,47,117,130,140,141,191,192,226,303,304,317,384,385,388,389,402];
                                break;
                        case "MIPS-19 Orthopedic Surgery":
                                mymeasurelist = [21,23,47,109,128,130,178,179,180,226,317,350,351,352,353,358,402];
                                break;
                        case "MIPS-20 Otolaryngology":
                                mymeasurelist = [21,23,47,91,93,128,130,226,317,331,332,333,334,357,358,402,431];
                                break;
                        case "MIPS-21 Pathology":
                                mymeasurelist = [99,100,249,250,251,395,396,397];
                                break;
                        case "MIPS-22 Pediatrics":
                                mymeasurelist = [65,66,91,93,110,134,205,391,394,402,444];
                                break;
                        case "MIPS-23 Physical Medicine":
                                mymeasurelist = [47,109,128,130,131,182,226,317,402,408,412,414,431];
                                break;
                        case "MIPS-24 Plastic Surgery":
                                mymeasurelist = [21,23,47,128,130,226,317,357,358,402];
                                break;
                        case "MIPS-25 Preventive Medicine":
                                mymeasurelist = [1,24,39,47,48,109,110,111,112,128,130,226,236,317,402,431];
                                break;
                        case "MIPS-26 Radiation Oncology":
                                mymeasurelist = [102,143,144,156];
                                break;
                        case "MIPS-27 Rheumatology":
                                mymeasurelist = [47,128,130,176,177,178,179,180,226,317,337,402];
                                break;
                        case "MIPS-28 Thoracic Surgery":
                                mymeasurelist = [21,23,47,130,164,165,166,167,168,226,236,317,358,402];
                                break;
                        case "MIPS-29 Urology":
                                mymeasurelist = [47,48,50,102,104,130,226,265,317,358,402];
                                break;
                        case "MIPS-30 Vascular Surgery":
                                mymeasurelist = [47,128,130,226,236,258,259,260,317,344,345,347,357,402];
                                break;

			default:
				console.log('Something Else!');
		}
		console.log('mymeasurelist = '+mymeasurelist);
		for (var mymeasure of mymeasurelist) {
			//console.log('For ' + mymeasure);
			mymeasurestring="#PQRS_"+("000" + mymeasure).slice(-4);
			$(mymeasurestring).prop('checked', true);
		}
	};

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
						Quick Select Specialty Types from 2016
						<ul>
							<li>
							<button type="button" class="quickselect" onclick="quickSelect('AllergyImmunology')">Allergy/Immunology</button>
							<button type="button" class="quickselect" onclick="quickSelect('Anesthesiology')">Anesthesiology</button>
							<button type="button" class="quickselect" onclick="quickSelect('Cardiology')">Cardiology</button>
							<button type="button" class="quickselect" onclick="quickSelect('ChronicConditions')">Chronic Conditions</button>
							<button type="button" class="quickselect" onclick="quickSelect('Dermatology')">Dermatology</button>
							<button type="button" class="quickselect" onclick="quickSelect('EmergencyMedicine')">Emergency Medicine</button>
							<button type="button" class="quickselect" onclick="quickSelect('Gastroenterology')">Gastroenterology (GI)</button>
							<button type="button" class="quickselect" onclick="quickSelect('GeneralFamilyMedicine')">General/Family Medicine</button>
							<button type="button" class="quickselect" onclick="quickSelect('Hospitalist')">Hospitalist</button>
							<button type="button" class="quickselect" onclick="quickSelect('InfectiousDisease')">Infectious Disease</button>
							<button type="button" class="quickselect" onclick="quickSelect('InternalMedicine')">Internal Medicine</button>
							<button type="button" class="quickselect" onclick="quickSelect('MentalBehavioralHealth')">Mental Health/Behavioral Health</button>
							<button type="button" class="quickselect" onclick="quickSelect('Neurology')">Neurology</button>
							<button type="button" class="quickselect" onclick="quickSelect('OBGYN')">OB-GYN</button>
							<button type="button" class="quickselect" onclick="quickSelect('OncologyHematology')">Oncology-Hematology</button>
							<button type="button" class="quickselect" onclick="quickSelect('Ophthalmology')">Ophthalmology</button>
							<button type="button" class="quickselect" onclick="quickSelect('Orthopedics')">Orthopedics</button>
							<button type="button" class="quickselect" onclick="quickSelect('PainSpecialist')">Pain Specialist</button>
							<button type="button" class="quickselect" onclick="quickSelect('Pathology')">Pathology</button>
							<button type="button" class="quickselect" onclick="quickSelect('Pediatrics')">Pediatrics</button>
							<button type="button" class="quickselect" onclick="quickSelect('PhysicalOccupationalTherapy')">Physical Therapy/Occupational Therapy</button>
							<button type="button" class="quickselect" onclick="quickSelect('Podiatry')">Podiatry</button>
							<button type="button" class="quickselect" onclick="quickSelect('Radiology')">Radiology</button>
							<button type="button" class="quickselect" onclick="quickSelect('SurgeryGeneral')">Surgery (General)</button>
							<button type="button" class="quickselect" onclick="quickSelect('Urology')">Urology</button>
						</ul>
					</li>
					<li>MIPS Specialty Sets for 2017
						<ul>
							<button type="button" class="quickselect" onclick="quickSelect('MIPS-1 Allergy/Immunology')">MIPS-1 Allergy/Immunology</button>
							<button type="button" class="quickselect" onclick="quickSelect('MIPS-2 Anesthesiology')">MIPS-2 Anesthesiology</button>
							<button type="button" class="quickselect" onclick="quickSelect('MIPS-3 Cardiology')">MIPS-3 Cardiology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-4 Dermatology')">MIPS-4 Dermatology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-5 Diagnostic Radiology')">MIPS-5 Diagnostic Radiology</button>               
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-6 Electrophysiology Cardiac Specialist')">MIPS-6 Electrophysiology Cardiac Specialist</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-7 Emergency Medicine')">MIPS-7 Emergency Medicine</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-8 Gastroenterology')">MIPS-8 Gastroenterology</button> 
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-9 General Oncology')">MIPS-9 General Oncology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-10 General Practice/Family Medicine')">MIPS-10 General Practice/Family Medicine</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-11 General Surgery')">MIPS-11 General Surgery</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-12 Hospitalists')">MIPS-12 Hospitalists</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-13 Internal Medicine')">MIPS-13 Internal Medicine</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-14 Interventional Radiology')">MIPS-14 Interventional Radiology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-15 Mental Health/Behavioral Health/Dementia')">MIPS-15 Mental Health/Behavioral Health/Dementia</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-16 Neurology')">MIPS-16 Neurology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-17 Obstetrics and Gynecology')">MIPS-17 Obstetrics and Gynecology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-18 Ophlamology')">MIPS-18 Ophlamology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-19 Orthopedic Surgery')">MIPS-19 Orthopedic Surgery</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-20 Otolaryngology')">MIPS-20 Otolaryngology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-21 Pathology')">MIPS-21 Pathology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-22 Pediatrics')">MIPS-22 Pediatrics</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-23 Physical Medicine')">MIPS-23 Physical Medicine</button>   
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-24 Plastic Surgery')">MIPS-24 Plastic Surgery</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-25 Preventive Medicine')">MIPS-25 Preventive Medicine</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-26 Radiation Oncology')">MIPS-26 Radiation Oncology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-27 Rheumatology')">MIPS-27 Rheumatology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-28 Thoracic Surgery')">MIPS-28 Thoracic Surgery</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-29 Urology')">MIPS-29 Urology</button>
                                                        <button type="button" class="quickselect" onclick="quickSelect('MIPS-30 Vascular Surgery')">MIPS-30 Vascular Surgery</button>
						</ul>
					</li>
					
					<li>
						<input type="checkbox" id="pqrs-toggle">
						<label for="pqrs-toggle">All Measures</label>
						<ul>
							<li>
								<input type="checkbox" id="individual-toggle">
								<label for="individual-toggle">Individual Measure Selection (click twice to de-select all)</label>
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
								<ul>
<?php

$rules = sqlStatementNoLog(
	'SELECT `id`, `active`
	FROM `clinical_rules`
	WHERE `id` LIKE "pre_%"
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
										<label for="<?php echo $id; ?>"><?php echo "pre-select ".$label; ?></label>
									</li>
<?php

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
