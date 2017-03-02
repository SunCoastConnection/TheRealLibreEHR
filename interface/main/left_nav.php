<?php

/* Copyright (C) 2006-2012 Rod Roark <rod@sunsetsystems.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 */

 // This provides the left navigation frame when $GLOBALS['concurrent_layout']
 // is true.  Following are notes as to what else was changed for this feature:
 //
 // * interface/main/main_screen.php: the top-level frameset.
 // * interface/main/finder/patient_select.php: loads stuff when a new patient
 //   is selected.
 // * interface/patient_file/summary/demographics.php: this is the first frame
 //   loaded when a new patient is chosen, and in turn sets the current pid and
 //   then loads the initial bottom frame.
 // * interface/patient_file/summary/demographics_full.php: added support for
 //   setting a new pid, needed for going to demographics from billing.
 // * interface/patient_file/summary/demographics_save.php: redisplay
 //   demographics.php and not the frameset.
 // * interface/patient_file/summary/summary_bottom.php: new frameset for the
 //   summary, prescriptions and notes for a selected patient, cloned from
 //   patient_summary.php.
 // * interface/patient_file/encounter/encounter_bottom.php: new frameset for
 //   the selected encounter, mosting coding/billing stuff, cloned from
 //   patient_encounter.php.  This will also self-load the superbill pages
 //   as requested.
 // * interface/usergroup/user_info.php: removed Back link.
 // * interface/usergroup/admin_frameset.php: new frameset for Admin pages,
 //   cloned from usergroup.php.
 // * interface/main/onotes/office_comments.php: removed Back link target.
 // * interface/main/onotes/office_comments_full.php: changed Back link.
 // * interface/billing/billing_report.php: removed Back link; added logic
 //   to properly go to demographics or to an encounter when requested.
 // * interface/new/new.php: removed Back link and revised form target.
 // * interface/new/new_patient_save.php: modified to load the demographics
 //   page to the current frame instead of loading a new frameset.
 // * interface/patient_file/history/history.php: target change.
 // * interface/patient_file/history/history_full.php: target changes.
 // * interface/patient_file/history/history_save.php: target change.
 // * interface/patient_file/history/encounters.php: link/target changes.
 // * interface/patient_file/encounter/encounter_top.php: another new frameset
 //   cloned from patient_encounter.php.
 // * interface/patient_file/encounter/forms.php: link target removal.
 // * interface/patient_file/encounter/new_form.php: target change.
 // * interface/forms/newpatient/new.php, view.php, save.php: link/target
 //   changes.
 // * interface/patient_file/summary/immunizations.php: removed back link.
 // * interface/patient_file/summary/pnotes.php: changed link targets.
 // * interface/patient_file/summary/pnotes_full.php: changed back link and
 //   added set_pid logic.
 // * interface/patient_file/transaction/transactions.php: various changes.
 // * interface/patient_file/transaction/add_transaction.php: new return js.
 // * interface/patient_file/encounter/superbill_codes.php: target and link
 //   changes.
 // * interface/patient_file/encounter/superbill_custom_full.php: target and
 //   link changes.
 // * interface/patient_file/encounter/diagnosis.php: target changes.
 // * interface/patient_file/encounter/diagnosis_full.php: target and link
 //   changes.
 // * interface/main/authorizations/authorizations.php: link and target changes.
 // * library/api.inc: url change.
 // * interface/patient_file/summary/rx_frameset.php: new frameset.
 // * interface/patient_file/summary/rx_left.php: new for prescriptions.
 // * all encounter forms: remove all instances of "target=Main" and change
 //   all instances of "patient_encounter.php" to "encounter_top.php".

 // Our find_patient form, when submitted, invokes patient_select.php in the
 // upper frame. When the patient is selected, demographics.php is invoked
 // with the set_pid parameter, which establishes the new session pid and also
 // calls the setPatient() function (below).  In this case demographics.php
 // will also load the summary frameset into the bottom frame, invoking our
 // loadFrame() and setRadio() functions.
 //
 // Similarly, we have the concept of selecting an encounter from the
 // Encounters list, and then having that "stick" until some other encounter
 // or a new encounter is chosen.  We also have a navigation item for creating
 // a new encounter.  interface/patient_file/encounter/encounter_top.php
 // supports set_encounter to establish an encounter.
 //
 // TBD: Include active_pid and/or active_encounter in relevant submitted
 // form data, and add logic to the save routines to make sure they match
 // the corresponding session values.

use ESign\Api;

require_once '../globals.php';
require_once $GLOBALS['fileroot'].'/library/acl.inc';
require_once $GLOBALS['fileroot'].'/custom/code_types.inc.php';
require_once $GLOBALS['fileroot'].'/library/patient.inc';
require_once $GLOBALS['fileroot'].'/library/lists.inc';
require_once $GLOBALS['fileroot'].'/library/ESign/Api.php';

// Helper functions for treeview generation.
function genTreeLink($frame, $name, $title, $mono = false) {
	global $primary_docs, $disallowed;

	if(empty($disallowed[$name])) {
		$id = $name.$primary_docs[$name][1];

		echo '<li><a href="" id="'.$id.'" onclick="';

		if($mono) {
			if($frame == 'RTop') {
				echo 'forceSpec(true, false); ';
			} else {
				echo 'forceSpec(false, true); ';
			}
		}

		echo 'return loadFrame2(\''.$id.'\', \''.$frame.'\', \''.$primary_docs[$name][2].'\')">'.
			$title.($name == 'msg' ? ' <span id="reminderCountSpan" class="bold"></span>' : '').
			'</a></li>';
	}
}

function genMiscLink($frame, $name, $level, $title, $url, $mono = false) {
	global $disallowed;

	if(empty($disallowed[$name])) {
		$id = $name.$level;

		echo '<li><a href="" id="'.$id.'" onclick="';

		if($mono) {
			if($frame == 'RTop') {
				echo 'forceSpec(true, false); ';
			} else {
				echo 'forceSpec(false, true); ';
			}
		}

		echo 'return loadFrame2(\''.$id.'\', \''.$frame.'\', \''.$url.'\')">'.
			$title.
			'</a></li>';
	}
}

function genMiscLink2($frame, $name, $level, $title, $url, $mono = false, $mouseovertext = '') {
	global $disallowed;

	if(empty($disallowed[$name])) {
		$id = $name.$level;

		echo '<li><a href="" id="'.$id.'" title="'.$mouseovertext.'" onclick="';

		if($mono) {
			if($frame == 'RTop') {
				echo 'forceSpec(true, false); ';
			} else {
				echo 'forceSpec(false, true); ';
			}
		}

		echo 'return loadFrame3(\''.$id.'\', \''.$frame.'\', \''.$url.'\')">'.
			$title.
			'</a></li>';
	}
}

function genPopLink($title, $url, $linkid = '') {
	echo '<li><a href="" ';

	if($linkid) {
		echo 'id="'.$linkid.'" ';
	}

	echo 'onclick="return repPopup(\''.$url.'\')">'.
		$title.'</a></li>';
}

function genDualLink($topname, $botname, $title) {
	global $primary_docs, $disallowed;

	if(empty($disallowed[$topname]) && empty($disallowed[$botname])) {
		$topid = $topname.$primary_docs[$topname][1];
		$botid = $botname.$primary_docs[$botname][1];

		echo '<li><a href="" id="'.$topid.'" onclick="return loadFrameDual(\''.$topid.'\', \''.$botid.'\', \''.$primary_docs[$topname][2].'\', \''.$primary_docs[$botname][2].'\')">'.
			$title.'</a></li>';
	}
}

function genPopupsList($style = '') {
	global $disallowed, $webserver_root;

	echo '<select name="popups" onchange="selpopup(this)" style="background-color: transparent; font-size: 9pt; '.$style.'">'.PHP_EOL.
		'<option value="">'.xl('Popups').'</option>'.PHP_EOL;

	if(!$disallowed['iss']) {
		echo '<option value="../patient_file/problem_encounter.php">'.xl('Issues').'</option>'.PHP_EOL;
	}

	if(!$GLOBALS['ippf_specific']) {
		echo '<option value="../../custom/export_xml.php">'.xl('Export').'</option>'.PHP_EOL.
			'<option value="../../custom/import_xml.php">'.xl('Import').'</option>'.PHP_EOL;
	}

	if(!$GLOBALS['disable_calendar']) {
		echo '<option value="../reports/appointments_report.php?patient='.(isset($pid) ? $pid : '').'">'.xl('Appts').'</option>'.PHP_EOL;
	}

	if(file_exists($webserver_root.'/custom/refer.php')) {
		echo '<option value="../../custom/refer.php">'.xl('Refer').'</option>'.PHP_EOL;
	}

	echo '<option value="../patient_file/printed_fee_sheet.php?fill=1">'.xl('Superbill').'</option>'.PHP_EOL.
		'<option value="../patient_file/front_payment.php">'.xl('Payment').'</option>'.PHP_EOL;

	if($GLOBALS['inhouse_pharmacy']) {
		echo '<option value="../patient_file/pos_checkout.php">'.xl('Checkout').'</option>'.PHP_EOL;
	}

	if(is_dir($GLOBALS['OE_SITE_DIR'] . "/letter_templates")) {
		echo '<option value="../patient_file/letter.php">'.xl('Letter').'</option>'.PHP_EOL;
	}

	if($GLOBALS['chart_label_type'] != '0') {
		echo '<option value="../patient_file/label.php">'.xl('Chart Label').'</option>'.PHP_EOL;
	}

	if($GLOBALS['barcode_label_type'] != '0') {
		echo '<option value="../patient_file/barcode_label.php">'.xl('Barcode Label').'</option>'.PHP_EOL;
	}

	if($GLOBALS['addr_label_type']) {
		echo '<option value="../patient_file/addr_label.php">'.xl('Address Label').'</option>'.PHP_EOL;
	}

	echo '</select>'.PHP_EOL;
}

function genFindBlock() {

?>
	<table cellpadding='0' cellspacing='0' border='0'>
		<tr>
			<td class='smalltext'><?php xl('Find', 'e'); ?>:&nbsp;</td>
			<td class='smalltext' colspan='2'>
				<input type="entry" size="7" name="patient" class='inputtext' style='width:65px;' />
			</td>
		</tr>
		<tr>
			<td class='smalltext'><?php xl('by', 'e'); ?>:</td>
			<td class='smalltext'>
				<a href="javascript:findPatient('Last');" class="navitem"><?php xl('Name', 'e'); ?></a>
			</td>
			<td class='smalltext' align='right'>
				<a href="javascript:findPatient('ID');" class="navitem"><?php xl('ID', 'e'); ?></a>
			</td>
		</tr>
		<tr>
			<td class='smalltext'>&nbsp;</td>
			<td class='smalltext'>
				<a href="javascript:findPatient('SSN');" class="navitem"><?php xl('SSN', 'e'); ?></a>
			</td>
			<td class='smalltext' align='right'>
				<a href="javascript:findPatient('DOB');" class="navitem"><?php xl('DOB', 'e'); ?></a>
			</td>
		</tr>
		<tr>
			<td class='smalltext'>&nbsp;</td>
			<td class='smalltext'>
				<a href="javascript:findPatient('Any');" class="navitem"><?php xl('Any', 'e'); ?></a>
			</td>
			<td class='smalltext' align='right'>
				<a href="javascript:initFilter();" class="navitem"><?php xl('Filter', 'e'); ?></a>
			</td>
		</tr>
	</table>
<?php

}


// This array defines the list of primary documents that may be
// chosen.  Each element value is an array of 3 values:
//
// * Name to appear in the navigation table
// * Usage: 0 = global, 1 = patient-specific, 2 = encounter-specific
// * The URL relative to the interface directory
//
$primary_docs = array(
	'ros' => array(xl('Roster'),             0, 'reports/players_report.php?embed=1'),
	'cal' => array(xl('Calendar'),           0, 'main/main_info.php'),
	'pfb' => array(xl('Patient Flow Board'), 0, '../interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1'),
	'app' => array(xl('Portal Activity'),    0, '../myportal/index.php'),
	'msg' => array(xl('Messages'),           0, 'main/messages/messages.php?form_active=1'),
	'pwd' => array(xl('Password'),           0, 'usergroup/user_info.php'),
	'prf' => array(xl('Preferences'),        0, 'super/edit_globals.php?mode=user'),
	'adm' => array(xl('Admin'),              0, 'usergroup/admin_frameset.php'),
	'rep' => array(xl('Reports'),            0, 'reports/index.php'),
	'ono' => array(xl('Ofc Notes'),          0, 'main/onotes/office_comments.php'),
	'fax' => array(xl('Fax/Scan'),           0, 'fax/faxq.php'),
	'adb' => array(xl('Addr Bk'),            0, 'usergroup/addrbook_list.php'),
	'orl' => array(xl('Proc Prov'),          0, 'orders/procedure_provider_list.php'),
	'ort' => array(xl('Proc Cat'),           0, 'orders/types.php'),
	'orc' => array(xl('Proc Load'),          0, 'orders/load_compendium.php'),
	'orb' => array(xl('Proc Bat'),           0, 'orders/orders_results.php?batch=1'),
	'ore' => array(xl('E-Reports'),          0, 'orders/list_reports.php'),
	'ppo' => array(xl('CMS Portal'),         0, 'cmsportal/list_requests.php'),
	'cht' => array(xl('Chart Trk'),          0, '../custom/chart_tracker.php'),
	'imp' => array(xl('Import'),             0, '../custom/import.php'),
	'bil' => array(xl('Billing'),            0, 'billing/billing_report.php'),
	'sup' => array(xl('Superbill'),          0, 'patient_file/encounter/superbill_custom_full.php'),
	'aun' => array(xl('Authorizations'),     0, 'main/authorizations/authorizations.php'),
	'new' => array(xl('New Pt'),             0, 'new/new.php'),
	'ped' => array(xl('Patient Education'),  0, 'reports/patient_edu_web_lookup.php'),
	'lab' => array(xl('Check Lab Results'),  0, 'orders/lab_exchange.php'),
	'dem' => array(xl('Patient'),            1, 'patient_file/summary/demographics.php'),
	'his' => array(xl('History'),            1, 'patient_file/history/history.php'),
	'ens' => array(xl('Visit History'),      1, 'patient_file/history/encounters.php'),
	'nen' => array(xl('Create Visit'),       1, 'forms/newpatient/new.php?autoloaded=1&calenc='),
	'pre' => array(xl('Rx'),                 1, 'patient_file/summary/rx_frameset.php'),
	'iss' => array(xl('Issues'),             1, 'patient_file/summary/stats_full.php?active=all'),
	'imm' => array(xl('Immunize'),           1, 'patient_file/summary/immunizations.php'),
	'doc' => array(xl('Documents'),          1, '../controller.php?document&list&patient_id={PID}'),
	'orp' => array(xl('Proc Pending Rev'),   1, 'orders/orders_results.php?review=1'),
	'orr' => array(xl('Proc Res'),           1, 'orders/orders_results.php'),
	'lda' => array(xl('Lab overview'),       1, 'patient_file/summary/labdata.php'),
	'tan' => array(xl('Configure Tracks'),   0, 'forms/track_anything/create.php'),
	'prp' => array(xl('Pt Report'),          1, 'patient_file/report/patient_report.php'),
	'prq' => array(xl('Pt Rec Request'),     1, 'patient_file/transaction/record_request.php'),
	'pno' => array(xl('Pt Notes'),           1, 'patient_file/summary/pnotes.php'),
	'pqr' => array(xl('PQRS Measures'),      0, 'reports/clinical_measures.php?type=pqrs'),
	'tra' => array(xl('Transact'),           1, 'patient_file/transaction/transactions.php'),
	'sum' => array(xl('Summary'),            1, 'patient_file/summary/summary_bottom.php'),
	'enc' => array(xl('Encounter'),          2, 'patient_file/encounter/encounter_top.php'),
	'erx' => array(xl('e-Rx'),               1, 'eRx.php'),
	'err' => array(xl('e-Rx Renewal'),       1, 'eRx.php?page=status'),
	'ere' => array(xl('e-Rx EPCS'),          1, 'eRx.php?page=epcs-admin'),
	'pay' => array(xl('Payment'),            1, '../patient_file/front_payment.php'),
	'edi' => array(xl('EDI History'),        0, 'billing/edih_view.php'),
	'dld' => array(xl('Display Documents'),  0, 'main/display_documents.php'),
	'npa' => array(xl('Batch Payments'),     0, 'billing/new_payment.php'),
);

if($GLOBALS['use_charges_panel'] || $GLOBALS['concurrent_layout'] == 2) {
	$primary_docs['cod'] = array(xl('Charges'), 2, 'patient_file/encounter/encounter_bottom.php');
}

// This section decides which navigation items will not appear.
$disallowed = array(
	'edi' => !($GLOBALS['enable_edihistory_in_left_menu'] || acl_check('acct', 'eob')),
	'adm' => !(acl_check('admin', 'calendar') || acl_check('admin', 'database') || acl_check('admin', 'forms') ||
		acl_check('admin', 'practice') || acl_check('admin', 'users') || acl_check('admin', 'acl') ||
		acl_check('admin', 'super') || acl_check('admin', 'superbill') || acl_check('admin', 'drugs')),
	'bil' => !(acl_check('acct', 'rep') || acl_check('acct', 'eob') || acl_check('acct', 'bill')),
	'new' => !(acl_check('patients', 'demo', '', array('write', 'addonly'))),
	'fax' => !($GLOBALS['enable_hylafax'] || $GLOBALS['enable_scanner']),
	'iss' => !((acl_check('encounters', 'notes', '', 'write') || acl_check('encounters', 'notes_a', '', 'write')) && acl_check('patients', 'med', '', 'write')),
	'cht' => !is_readable($webserver_root.'/custom/chart_tracker.php'),
	'pre' => !(acl_check('patients', 'med')),
);
$disallowed['imp'] = $disallowed['new'] || !is_readable($webserver_root.'/custom/import.php');

$esignApi = new Api();

?>
<html>
	<head>
		<title>Navigation</title>
		<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
		<style type="text/css">
body {
	font-size: 8pt;
	font-weight: normal;
	padding: 5px 3px 5px 3px;
}
.smalltext {
	font-family: sans-serif;
	font-size: 8pt;
	font-weight: normal;
}
a.navitem, a.navitem:visited {
	color: #0000ff;
	font-family: sans-serif;
	font-size: 8pt;
	font-weight: bold;
}
.inputtext {
	font-size: 9pt;
	font-weight: normal;
	border-style: solid;
	border-width: 1px;
	padding-left: 2px;
	padding-right: 2px;
	border-color: #000000;
	background-color: transparent;
}
#navigation ul {
	background-color: transparent;
}
#navigation-slide ul {
	background-color: transparent;
}
#navigation-slide a{
	width: 92%;
}
.nav-menu-img{
	width: 25px;
	height: 25px;
	border: none;
	margin-right: 5px;
	vertical-align: middle;
}
		</style>
		<link rel="stylesheet" href="../../library/js/jquery.treeview-1.4.1/jquery.treeview.css" />
		<script src="../../library/js/jquery-1.6.4.min.js" type="text/javascript"></script>
		<script src="../../library/js/jquery.treeview-1.4.1/jquery.treeview.js" type="text/javascript"></script>
		<script type="text/javascript" src="../../library/dialog.js"></script>
		<script language="JavaScript">
// tajemo work by CB 2012/01/31 12:32:57 PM dated reminders counter
function getReminderCount() {
	top.restoreSession();

	// Send the skip_timeout_reset parameter to not count this as a manual entry in the
	// timing out mechanism in OpenEMR.
	$.post(
		'<?php echo $GLOBALS['webroot']; ?>/library/ajax/dated_reminders_counter.php',
		{
			skip_timeout_reset: '1'
		},
		function(data) {
			$('#reminderCountSpan').html(data);

			// run updater every 60 seconds
			var repeater = setTimeout('getReminderCount()', 60000);
		}
	);

	//piggy-back on this repeater to run other background-services
	//this is a silent task manager that returns no output
	$.post(
		'<?php echo $GLOBALS['webroot']; ?>/library/ajax/execute_background_services.php',
		{
			skip_timeout_reset: '1',
			ajax: '1'
		}
	);
}

$(document).ready(function() {
	getReminderCount();

	parent.loadedFrameCount += 1;
<?php

if($GLOBALS['drop_bottom'] == 1) {

?>

	$('input[name=cb_bot]').trigger('click');
	toggleFrame(2);
<?php

}

?>
})
// end of tajemo work dated reminders counter

// Master values for current pid and encounter.
var active_pid = 0;
var active_encounter = 0;
var encounter_locked = false;

// Current selections in the top and bottom frames.
var topName = '';
var botName = '';

// Expand and/or collapse frames in response to checkbox clicks.
// fnum indicates which checkbox was clicked (1 = left, 2 = right).
function toggleFrame(fnum) {
	var f = document.forms[0];
	var fset = top.document.getElementById('fsright');

	if(!f.cb_top.checked && !f.cb_bot.checked) {
		if(fnum == 1) {
			f.cb_bot.checked = true;
		} else {
			f.cb_top.checked = true;
		}
	}

	fset.rows = ((f.cb_top.checked ? '*' : '0') +
		(f.cb_bot.checked ? ', *' : ', 0'));
}

// Load the specified url into the specified frame (RTop or RBot).
// The URL provided must be relative to interface.
function loadFrame(fname, frame, url) {
	top.restoreSession();

	var i = url.indexOf('{PID}');

	if(i >= 0) {
		url = url.substring(0, i) + active_pid + url.substring(i + 5);
	}

	top.frames[frame].location = '<?php echo $web_root.'/interface/'; ?>' + url;

	if(frame == 'RTop') {
		topName = fname;
	} else {
		botName = fname;
	}
}

// Load the specified url into a frame to be determined, with the specified
// frame as the default; the url must be relative to interface.
function loadFrame2(fname, frame, url) {
	var usage = fname.substring(3);

	if(active_pid == 0 && usage > '0') {
		alert('<?php xl('You must first select or add a patient.', 'e'); ?>');
		return false;
	} else if(active_encounter == 0 && usage > '1') {
		alert('<?php xl('You must first select or create an encounter.', 'e'); ?>');
		return false;
	} else if(encounter_locked && usage > '1') {
		alert('<?php xl('This encounter is locked. No new forms can be added.', 'e'); ?>');
		return false;
	}

	var f = document.forms[0];
	top.restoreSession();
	var i = url.indexOf('{PID}');

	if(i >= 0) {
		url = url.substring(0, i) + active_pid + url.substring(i + 5);
	}

	if(f.sel_frame) {
		var fi = f.sel_frame.selectedIndex;

		if(fi == 1) {
			frame = 'RTop';
		} else if(fi == 2) {
			frame = 'RBot';
		}
	}

	if(!f.cb_bot.checked) {
		frame = 'RTop';
	} else if(!f.cb_top.checked) {
		frame = 'RBot';
	}

	top.frames[frame].location = '<?php echo $web_root.'/interface/'; ?>' + url;

	if(frame == 'RTop') {
		topName = fname;
	} else {
		botName = fname;
	}

	return false;
}

function loadFrame3(fname, frame, url) {
	var f = document.forms[0];
	top.restoreSession();
	var i = url.indexOf('{PID}');

	if(i >= 0) {
		url = url.substring(0, i) + active_pid + url.substring(i + 5);
	}

	if(f.sel_frame) {
		var fi = f.sel_frame.selectedIndex;
		if(fi == 1) {
			frame = 'RTop';
		} else if(fi == 2) {
			frame = 'RBot';
		}
	}

	if(!f.cb_bot.checked) {
		frame = 'RTop';
	} else if(!f.cb_top.checked) {
		frame = 'RBot';
	}

	top.frames[frame].location = '<?php echo $web_root.'/interface/'; ?>' + url;

	if(frame == 'RTop') {
		topName = fname;
	} else {
		botName = fname;
	}

	return false;
}

// Make sure the the top and bottom frames are open or closed, as specified.
function forceSpec(istop, isbot) {
	var f = document.forms[0];

	if(f.cb_top.checked != istop) {
		f.cb_top.checked = istop;
		toggleFrame(1);
	}

	if(f.cb_bot.checked != isbot) {
		f.cb_bot.checked = isbot;
		toggleFrame(2);
	}
}

// Make sure both frames are open.
function forceDual() {
	forceSpec(true, true);
}

// Load the specified url into a frame to be determined, with the specified
// frame as the default; the url must be relative to interface.
function loadFrameDual(tname, bname, topurl, boturl) {
	var topusage = tname.substring(3);
	var botusage = bname.substring(3);

	if(active_pid == 0 && (topusage > '0' || botusage > '0')) {
		alert('<?php xl('You must first select or add a patient.', 'e'); ?>');
		return false;
	} else if(active_encounter == 0 && (topusage > '1' || botusage > '1')) {
		alert('<?php xl('You must first select or create an encounter.', 'e'); ?>');
		return false;
	} else if(encounter_locked && (topusage > '1' || botusage > '1')) {
		alert('<?php xl('This encounter is locked. No new forms can be added.', 'e'); ?>');
		return false;
	}

	var f = document.forms[0];
	forceDual();
	top.restoreSession();

	var i = topurl.indexOf('{PID}');

	if(i >= 0) {
		topurl = topurl.substring(0, i) + active_pid + topurl.substring(i + 5);
	}

	i = boturl.indexOf('{PID}');

	if(i >= 0) {
		boturl = boturl.substring(0, i) + active_pid + boturl.substring(i + 5);
	}

	top.frames.RTop.location = '<?php echo $web_root.'/interface/'; ?>' + topurl;
	top.frames.RBot.location = '<?php echo $web_root.'/interface/'; ?>' + boturl;
	topName = tname;
	botName = bname;

	return false;
}

// Select a designated radio button. raname may be either the radio button
// array name (rb_top or rb_bot), or the frame name (RTop or RBot).
// You should call this if you directly load a document that does not
// correspond to the current radio button setting.
function setRadio(raname, rbid) {
<?php

if($GLOBALS['concurrent_layout'] < 2) {

?>
	var f = document.forms[0];

	if(raname == 'RTop') {
		raname = 'rb_top';
	} else if(raname == 'RBot') {
		raname = 'rb_bot';
	}

	for(var i = 0; i < f[raname].length; ++i) {
		if(f[raname][i].value.substring(0, 3) == rbid) {
			f[raname][i].checked = true;
			return true;
		}
	}
<?php

} else {

?>
	return false;
<?php

}

?>
}

// Set disabled/enabled state of radio buttons and associated labels
// depending on whether there is an active patient or encounter.
function syncRadios() {
	var f = document.forms[0];

	encounter_locked = isEncounterLocked(active_encounter);

<?php

if($GLOBALS['concurrent_layout'] == 2 || $GLOBALS['concurrent_layout'] == 3) {

?>
	var nlinks = document.links.length;

	for(var i = 0; i < nlinks; ++i) {
		var lnk = document.links[i];

		if(lnk.id.length != 4) continue;

		var usage = lnk.id.substring(3);

		if(usage == '1' || usage == '2') {
			var da = false;

			if(active_pid == 0) {
				da = true;
			} else if(active_encounter == 0 && usage > '1') {
				da = true;
			} else if(encounter_locked && usage > '1') {
				da = true;
			}

			lnk.style.color = da ? '#888888' : <?php echo ($GLOBALS['concurrent_layout'] == 2 ? '\'#0000ff\'' : '\'#000000\''); ?>;
		}
	}
<?php

} elseif($GLOBALS['concurrent_layout'] < 2) {

?>
	for(var i = 0; i < f.rb_top.length; ++i) {
		var da = false;
		var rb1 = f.rb_top[i];
		var rb2 = f.rb_bot[i];
		var rbid = rb1.value.substring(0, 3);
		var usage = rb1.value.substring(3);

		if(active_pid == 0 && usage > '0') {
			da = true;
		} else if(active_encounter == 0 && usage > '1') {
			da = true;
		} else if(encounter_locked && usage > '1') {
			da = true;
		}

		// daemon_frame can also set special label colors, so don't mess with
		// them unless we have to.
		if(rb1.disabled != da) {
			rb1.disabled = da;
			rb2.disabled = da;

			document.getElementById('lbl_' + rbid).style.color = (da ? '#888888' : '#000000');
		}
	}
<?php

}

?>

	f.popups.disabled = (active_pid == 0);
}

function goHome() {
	top.frames['RTop'].location = '<?php echo $GLOBALS['default_top_pane']; ?>';
	top.frames['RBot'].location = 'messages/messages.php?form_active=1';
}

//Function to clear active patient and encounter in the server side
function clearactive() {
	top.restoreSession();

	//Ajax call to clear active patient in session
	$.ajax({
		type: 'POST',
		url: '<?php echo $GLOBALS['webroot'] ?>/library/ajax/unset_session_ajax.php',
		data: {
			func: 'unset_pid'
		},
		success: function(msg) {
			clearPatient();

			top.frames['RTop'].location = '<?php echo $GLOBALS['default_top_pane']; ?>';
			top.frames['RBot'].location = 'messages/messages.php?form_active=1';
		}
	});

	$(parent.Title.document.getElementById('clear_active')).hide();
}

// Reference to the search.php window.
var my_window;

// Open the search.php window.
function initFilter() {
	my_window = window.open('../../custom/search.php', 'mywindow', 'status=1');
}

// This is called by the search.php (Filter) window.
function processFilter(fieldString, serviceCode) {
	var f = document.forms[0];

	document.getElementById('searchFields').value = fieldString;

	f.search_service_code.value = serviceCode;
	findPatient('Filter');
	f.search_service_code.value = '';

	my_window.close();
}

// Process the click to find a patient by name, id, ssn or dob.
function findPatient(findby) {
	var f = document.forms[0];

	if(!f.cb_top.checked) {
		f.cb_top.checked = true;
		toggleFrame(1);
	}

	f.findBy.value = findby;

	setRadio('rb_top', 'dem');
	top.restoreSession();
	document.find_patient.submit();
}

// Helper function to set the contents of a div.
function setSomeContent(id, content, doc) {
	if(doc.getElementById) {
		var x = doc.getElementById(id);
	} else if(doc.all) {
		var x = doc.all[id];
	}

	x.innerHTML = content;
}

function setDivContent(id, content) {
	setSomeContent(id, content, document);
}

function setTitleContent(id, content) {
	setSomeContent(id, content, parent.Title.document);
}

// This is called automatically when a new patient is set, to make sure
// there are no patient-specific documents showing stale data.  If a frame
// was just loaded with data for the correct patient, its name is passed so
// that it will not be zapped.  At this point the new server-side pid is not
// assumed to be set, so this function will only load global data.
function reloadPatient(frname) {
	var f = document.forms[0];

	if(topName.length > 3 && topName.substring(3) > '0' && frname != 'RTop') {
		loadFrame('cal0', 'RTop', '<?php echo $primary_docs['cal'][2]; ?>');
		setRadio('rb_top', 'cal');
	}

	if(botName.length > 3 && botName.substring(3) > '0' && frname != 'RBot') {
		loadFrame('ens0', 'RBot', '<?php echo $primary_docs['ens'][2]; ?>');
		setRadio('rb_bot', 'ens');
	}
}

// Reload encounter-specific frames, excluding a specified frame.  At this
// point the new server-side encounter ID may not be set and loading the same
// document for the new encounter will not work, so load patient info instead.
function reloadEncounter(frname) {
	var f = document.forms[0];

	if(topName.length > 3 && topName.substring(3) > '1' && frname != 'RTop') {
		loadFrame('dem1', 'RTop', '<?php echo $primary_docs['dem'][2]; ?>');
		setRadio('rb_top', 'dem');
	}

	if(botName.length > 3 && botName.substring(3) > '1' && frname != 'RBot') {
		loadFrame('ens1', 'RBot', '<?php echo $primary_docs['ens'][2]; ?>');
		setRadio('rb_bot', 'ens');
	}
}

// This is referenced in left_nav_issues_ajax.php and is called when [Add]
// is clicked for an issue menu item to add a new encounter for the issue.
// So far this only applies to the Athletic Team version of the menu.
//
function addEncNotes(issue) {
	// top.restoreSession();
	// $.getScript('../../library/ajax/left_nav_encounter_ajax.php?createvisit=1&issue=' + issue);

	// The above AJAX call was to create the encounter right away, but we later
	// (2012-07-03) decided it's better to present the New Encounter form instead.
	// Note the issue ID is passed so it will be pre-selected in that form.
	loadFrame2('nen1', 'RBot', 'forms/newpatient/new.php?autoloaded=1&calenc=&issue=' + issue);

	return false;
}

// Call this to announce that the patient has changed.  You must call this
// if you change the session PID, so that the navigation frame will show the
// correct patient and so that the other frame will be reloaded if it contains
// patient-specific information from the previous patient.  frname is the name
// of the frame that the call came from, so we know to only reload content
// from the *other* frame if it is patient-specific.
function setPatient(pname, pid, pubpid, frname, str_dob) {
	var str = '<a href="javascript:;" onclick="parent.left_nav.loadCurrentPatientFromTitle()" title="PID = ' + pid + '"><b>' + pname + ' (' + pubpid + ')<br /></b></a>';

	setDivContent('current_patient', str);
	setTitleContent('current_patient', str + str_dob);

	if(pid == active_pid) {
		return;
	}

	setDivContent('current_encounter', '<b><?php xl('None', 'e'); ?></b>');

	active_pid = pid;
	active_encounter = 0;
	encounter_locked = false;

	if(frname) {
		reloadPatient(frname);
	}

	syncRadios();

	$(parent.Title.document.getElementById('current_patient_block')).show();
	var encounter_block = $(parent.Title.document.getElementById('current_encounter_block'));
	$(encounter_block).hide();

	// zero out the encounter frame, replace it with the encounter list frame
	var f = document.forms[0];

	if( f.cb_top.checked && f.cb_bot.checked ) {
		var encounter_frame = getEncounterTargetFrame('enc');

		if( encounter_frame != undefined ) {
			loadFrame('ens0', encounter_frame, '<?php echo $primary_docs['ens'][2]; ?>');
			setRadio(encounter_frame, 'ens');
		}
	}

	//To display Clear Active Patient button on selecting a patient
	$(parent.Title.document.getElementById('clear_active')).show();
}

function setPatientEncounter(EncounterIdArray, EncounterDateArray, CalendarCategoryArray) {
	//This function lists all encounters of the patient.
	//This function writes the drop down in the top frame.
	//It is called when a new patient is create/selected from the search menu.
	var str = '<select class="text" id="EncounterHistory" onchange="top.restoreSession(); toencounter(this.options[this.selectedIndex].value)">' +
		'<option value=""><?php echo htmlspecialchars(xl('Encounter History'), ENT_QUOTES); ?></option>' +
		'<option value="New Encounter"><?php echo htmlspecialchars(xl('New Encounter'), ENT_QUOTES); ?></option>' +
		'<option value="Past Encounter List"><?php echo htmlspecialchars(xl('Past Encounter List'), ENT_QUOTES); ?></option>';

	for(CountEncounter = 0; CountEncounter < EncounterDateArray.length; CountEncounter++) {
		str += '<option value="' + EncounterIdArray[CountEncounter] + '~' + EncounterDateArray[CountEncounter] + '">' +
			EncounterDateArray[CountEncounter] + '-' + CalendarCategoryArray[CountEncounter] +
			'</option>';
	}

	str += '</Select>';

	$(parent.Title.document.getElementById('past_encounter_block')).show();
	top.window.parent.Title.document.getElementById('past_encounter').innerHTML = str;
}

function loadCurrentPatientFromTitle() {
	top.restoreSession();
	top.frames['RTop'].location = '../patient_file/summary/demographics.php';
}

function getEncounterTargetFrame(name) {
	var bias = <?php echo $primary_docs['enc'][ 1 ]; ?>;
	var f = document.forms[0];
	var r = 'RTop';

	if(f.cb_top.checked && f.cb_bot.checked) {
		if(bias == 2) {
			r = 'RBot';
		} else {
			r = 'RTop';
		}
	} else {
		if(f.cb_top.checked) {
			r = 'RTop';
		} else if(f.cb_bot.checked) {
			r = 'RBot';
		}
	}

	return r;
}

function isEncounterLocked(encounterId) {
<?php

if($esignApi->lockEncounters()) {

?>
	// If encounter locking is enabled, make a syncronous call (async=false) to check the
	// DB to see if the encounter is locked.
	// Call restore session, just in case
	top.restoreSession();

	$.ajax({
		type: 'POST',
		url: '<?php echo $GLOBALS['webroot']; ?>/interface/esign/index.php?module=encounter&method=esign_is_encounter_locked',
		data: { encounterId : encounterId },
		success: function(data) {
			encounter_locked = data;
		},
		dataType: 'json',
		async: false
	});

	return encounter_locked;
<?php

} else {

?>
	// If encounter locking isn't enabled, just tell the left_nav that the encounter
	// isn't locked.
	return false;
<?php

}

?>
}

// Call this to announce that the encounter has changed.  You must call this
// if you change the session encounter, so that the navigation frame will
// show the correct encounter and so that the other frame will be reloaded if
// it contains encounter-specific information from the previous encounter.
// frname is the name of the frame that the call came from, so we know to only
// reload encounter-specific content from the *other* frame.
function setEncounter(edate, eid, frname) {
	if(eid == active_encounter) {
		return;
	}

	if(!eid) {
		edate = '<?php xl('None', 'e'); ?>';
	}

	var str = '<b>' + edate + '</b>';

	setDivContent('current_encounter', str);

	active_encounter = eid;
	encounter_locked = isEncounterLocked(active_encounter);

	reloadEncounter(frname);
	syncRadios();

	var encounter_block = $(parent.Title.document.getElementById('current_encounter_block'));
	var encounter = $(parent.Title.document.getElementById('current_encounter'));
	var estr = '<a href="javascript:;" onclick="parent.left_nav.loadCurrentEncounterFromTitle()"><b>' + edate + ' (' + eid + ')</b></a>';

	encounter.html(estr);
	encounter_block.show();
}

function loadCurrentEncounterFromTitle() {
	top.restoreSession();

	top.frames[parent.left_nav.getEncounterTargetFrame('enc')].location = '../patient_file/encounter/encounter_top.php';
}

// You must call this if you delete the active patient (or if for any other
// reason you "close" the active patient without opening a new one), so that
// the appearance of the navigation frame will be correct and so that any
// stale content will be reloaded.
function clearPatient() {
	if(active_pid == 0) {
		return;
	}

	var f = document.forms[0];

	active_pid = 0;
	active_encounter = 0;
	encounter_locked = false;

	setDivContent('current_patient', '<b><?php xl('None', 'e'); ?></b>');

	$(parent.Title.document.getElementById('current_patient_block')).hide();
	top.window.parent.Title.document.getElementById('past_encounter').innerHTML = '';
	$(parent.Title.document.getElementById('current_encounter_block')).hide();

	reloadPatient('');
	syncRadios();
}

// You must call this if you delete the active encounter (or if for any other
// reason you "close" the active encounter without opening a new one), so that
// the appearance of the navigation frame will be correct and so that any
// stale content will be reloaded.
function clearEncounter() {
	if(active_encounter == 0) {
		return;
	}

	top.window.parent.Title.document.getElementById('current_encounter').innerHTML = '<b><?php echo htmlspecialchars( xl('None'), ENT_QUOTES) ?></b>';

	active_encounter = 0;
	encounter_locked = false;

	reloadEncounter('');
	syncRadios();
}

//Removes an item from the Encounter drop down.
function removeOptionSelected(EncounterId) {
	var elSel = top.window.parent.Title.document.getElementById('EncounterHistory');
	var i;
	for(i = elSel.length - 1; i >= 2; i--) {
		EncounterHistoryValue = elSel.options[i].value;
		EncounterHistoryValueArray = EncounterHistoryValue.split('~');

		if(EncounterHistoryValueArray[0] == EncounterId) {
			elSel.remove(i);
		}
	}
}

// You can call this to make sure the session pid is what we expect.
function pidSanityCheck(pid) {
	if(pid != active_pid) {
		alert('Session patient ID is ' + pid + ', expecting ' + active_pid +
		'. This session is unstable and should be abandoned. Do not use ' +
		'OpenEMR in multiple browser windows!');
		return false;
	}

	return true;
}

// You can call this to make sure the session encounter is what we expect.
function encounterSanityCheck(eid) {
	if(eid != active_encounter) {
		alert('Session encounter ID is ' + eid + ', expecting ' + active_encounter +
		'. This session is unstable and should be abandoned. Do not use ' +
		'OpenEMR in multiple browser windows!');
		return false;
	}

	return true;
}

// Pop up a report.
function repPopup(aurl) {
	top.restoreSession();

	window.open('<?php echo $web_root.'/interface/reports/'; ?>' + aurl, '_blank', 'width=750,height=550,resizable=1,scrollbars=1');

	return false;
}

// This is invoked to pop up some window when a popup item is selected.
function selpopup(selobj) {
	var i = selobj.selectedIndex;
	var opt = selobj.options[i];

	if(i > 0) {
		var width  = 750;
		var height = 550;

		if(opt.text == 'Export' || opt.text == 'Import') {
			width  = 500;
			height = 400;
		} else if(opt.text == 'Refer') {
			width  = 700;
			height = 500;
		}

		dlgopen(opt.value, '_blank', width, height);
	}

	selobj.selectedIndex = 0;
}

// Treeview activation stuff:
$(document).ready(function() {
	if(3 == <?php echo $GLOBALS['concurrent_layout'] ?>) {
		$('#navigation-slide > li > a.collapsed + ul').slideToggle('medium');
		$('#navigation-slide > li > ul > li > a.collapsed_lv2 + ul').slideToggle('medium');

		$('#navigation-slide > li > a.expanded').click(function() {
			$('#navigation-slide > li > a.expanded').not(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
			$(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
		});

		$('#navigation-slide > li > a.collapsed').click(function() {
			$('#navigation-slide > li > a.expanded').not(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
			$(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
		});

		$('#navigation-slide > li > ul > li > a.expanded_lv2').click(function() {
			$('#navigation-slide > li > a.expanded').next('ul').find('li > a.expanded_lv2').not(this).toggleClass('expanded_lv2').toggleClass('collapsed_lv2').parent().find('> ul').slideToggle('medium');
			$(this).toggleClass('expanded_lv2').toggleClass('collapsed_lv2').parent().find('> ul').slideToggle('medium');
		});

		$('#navigation-slide > li > ul > li > a.collapsed_lv2').click(function() {
			$('#navigation-slide > li > a.expanded').next('ul').find('li > a.expanded_lv2').not(this).toggleClass('expanded_lv2').toggleClass('collapsed_lv2').parent().find('> ul').slideToggle('medium');
			$(this).toggleClass('expanded_lv2').toggleClass('collapsed_lv2').parent().find('> ul').slideToggle('medium');
		});

		$('#navigation-slide > li > a#pqr0').prepend('<img src="../../images/reports.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#pqrs').prepend('<img src="../../images/pfb.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#cal0').prepend('<img src="../../images/calendar.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#pfb0').prepend('<img src="../../images/pfb.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#msg0').prepend('<img src="../../images/messages.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#patimg').prepend('<img src="../../images/patient.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#app0').prepend('<img src="../../images/patient.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#ppo0').prepend('<img src="../../images/patient.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#repimg').prepend('<img src="../../images/reports.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#feeimg').prepend('<img src="../../images/fee.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#adm0').prepend('<img src="../../images/inventory.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#invimg').prepend('<img src="../../images/inventory.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#admimg').prepend('<img src="../../images/admin.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#misimg').prepend('<img src="../../images/misc.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#proimg').prepend('<img src="../../images/procedures.png" class="nav-menu-img" />');
		$('#navigation-slide > li > a#modimg').prepend('<img src="../../images/module.png" class="nav-menu-img" />');
		$('#navigation-slide > li').each(function(index) {
			if($(' > ul > li', this).size() == 0) {
				$(' > a', this).addClass('collapsed');
			}
		});
	} else if(2 == <?php echo $GLOBALS['concurrent_layout']; ?>) {
		//Remove the links (used by the sliding menu) that will break treeview
		$('a.collapsed').each(function() {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});

		$('a.collapsed_lv2').each(function() {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});

		$('a.expanded').each(function() {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});

		$('a.expanded_lv2').each(function() {
			$(this).replaceWith('<span>' + $(this).text() + '</span>');
		});

		// Initiate treeview
		$('#navigation').treeview({
			animated: 'fast',
			collapsed: true,
			unique: true,
			toggle: function() {
				window.console && console.log('%o was toggled', this);
			}
		});
	}
});
		</script>
	</head>
	<body class="body_nav">
		<form method="post" name="find_patient" target="RTop" action="<?php echo $rootdir; ?>/main/finder/patient_select.php">
<?php

if($GLOBALS['concurrent_layout'] == 2 || $GLOBALS['concurrent_layout'] == 3) {

?>
			<center>
				<select name="sel_frame" style="background-color:transparent;font-size:9pt;width:100%;">
					<option value="0"><?php xl('Default', 'e'); ?></option>
					<option value="1"><?php xl('Top', 'e'); ?></option>
					<option value="2"><?php xl('Bottom', 'e'); ?></option>
				</select>
			</center>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td class="smalltext" nowrap>
						<input type="checkbox" name="cb_top" onclick="toggleFrame(1)" checked />
						<b><?php xl('Top', 'e'); ?></b>
					</td>
					<td class="smalltext" align="right" nowrap>
						<b><?php xl('Bot', 'e'); ?></b>
						<input type="checkbox" name="cb_bot" onclick="toggleFrame(2)" checked />
					</td>
				</tr>
			</table>
<?php

	if($GLOBALS['concurrent_layout'] == 3) {

?>
			<ul id="navigation-slide">
<?php

	} else { // ($GLOBALS['concurrent_layout'] == 2)

?>
			<ul id="navigation">
<?php

	}

	if($GLOBALS['enable_pqrs']) {

?>
				<li><a class="expanded" id="pqrs"><span><?php xl('PQRS', 'e'); ?></span></a>
					<ul>
<?php
		genMiscLink('RTop', 'rep', '0', xl('View Report Results'), 'reports/report_results.php');
		genTreeLink('RTop', 'pqr', xl('Run Measures Report'));
		genMiscLink('RTop', 'pqr', '0', xl('Select Measures'), 'reports/PQRS/measure_activate.php');
		genMiscLink('RTop', 'pqr', '0', xl('Upload Claim Files'),'/../../sites/'.$_SESSION['site_id'].'/PQRS/dropzone/index.php');
		if(acl_check('admin', 'super')) {
			genMiscLink('RTop', 'rep', '0', xl('Delete Old Reports'), 'main/PQRS/truncate_reports.php');
			genMiscLink('RTop', 'rep', '0', xl('Remove Provider Assignments'), 'main/PQRS/reset_provider_to_unassigned.php');
			genMiscLink('RTop', 'rep', '0', xl('Provider Encounter Counts'), 'main/PQRS/provider_encounter_counts.php');
			genMiscLink('RTop', 'rep', '0', xl('Client Database Import'), 'main/PQRS/import_data.php');
		}
		genTreeLink('RTop', 'pwd', xl('Change Your Password'));
		if( $GLOBALS['pqrs_demosystem'] ) {
			genMiscLink('RTop', 'rep', '0', xl('Save/Load Demo Database'), 'main/PQRS/reload_demo_database.php');
		}
?>
					</ul>
				</li>
<?php

	}

	if(acl_check('admin', 'super')) {
		if(!$GLOBALS['disable_calendar'] && !$GLOBALS['ippf_specific']) {
			genTreeLink('RTop', 'cal', xl('Calendar'));
		}

		if(!$GLOBALS['disable_pat_trkr'] && !$GLOBALS['disable_calendar']) {
			genTreeLink('RTop', 'pfb', xl('Flow Board'));
		}

		genTreeLink('RBot', 'msg', xl('Messages'));

		if($GLOBALS['lab_exchange_enable']) {
			genTreeLink('RTop', 'lab', xl('Check Lab Results'));
		}

		if($GLOBALS['portal_offsite_enable'] && $GLOBALS['portal_offsite_address'] && acl_check('patientportal', 'portal')) {
			genTreeLink('RTop', 'app', xl('Portal Activity'));
		}

		if($GLOBALS['gbl_portal_cms_enable'] && acl_check('patientportal', 'portal')) {
			// genTreeLink('RTop', 'ppo', xl('WordPress Portal'));
			genPopLink(xl('CMS Portal'), '../cmsportal/list_requests.php', 'ppo0');
		}

?>
				<li class="open"><a class="expanded" id="patimg" ><span><?php xl('Patient/Client', 'e'); ?></span></a>
					<ul>
<?php

		genMiscLink('RTop', 'fin', '0', xl('Patients'), 'main/finder/dynamic_finder.php');
		genTreeLink('RTop', 'new', ($GLOBALS['full_new_patient_form'] ? xl('New/Search') : xl('New')));
		genTreeLink('RTop', 'dem', xl('Summary'));

?>
						<li class="open"><a class="expanded_lv2"><span><?php xl('Visits', 'e'); ?></span></a>
							<ul>
<?php

		if($GLOBALS['ippf_specific'] && !$GLOBALS['disable_calendar']) {
			genTreeLink('RTop', 'cal', xl('Calendar'));
		}

		genTreeLink('RBot', 'nen', xl('Create Visit'));
		genTreeLink('RBot', 'enc', xl('Current'));
		genTreeLink('RBot', 'ens', xl('Visit History'));

?>
							</ul>
						</li>
						<li><a class="collapsed_lv2"><span><?php xl('Records', 'e'); ?></span></a>
							<ul>
<?php

		genTreeLink('RTop', 'prq', xl('Patient Record Request'));

?>
							</ul>
						</li>
<?php

		if($GLOBALS['gbl_nav_visit_forms']) {

?>
						<li><a class="collapsed_lv2"><span><?php xl('Visit Forms', 'e'); ?></span></a>
							<ul>
<?php

			// Generate the items for visit forms, both traditional and LBF.
			$lres = sqlStatement('SELECT * FROM list_options WHERE list_id = "lbfnames" ORDER BY seq, title');

			if(sqlNumRows($lres)) {
				while($lrow = sqlFetchArray($lres)) {
					$option_id = $lrow['option_id']; // should start with LBF
					$title = $lrow['title'];

					genMiscLink('RBot', 'cod', '2', xl_form_title($title), 'patient_file/encounter/load_form.php?formname='.$option_id);
				}
			}

			include_once $srcdir.'/registry.inc';
			$reg = getRegistered();

			if(!empty($reg)) {
				foreach($reg as $entry) {
					$option_id = $entry['directory'];
					$title = trim($entry['nickname']);

					if($option_id == 'fee_sheet' || $option_id == 'newpatient') {
						continue;
					}

					if(empty($title)) {
						$title = $entry['name'];
					}

					genMiscLink('RBot', 'cod', '2', xl_form_title($title), 'patient_file/encounter/load_form.php?formname='.urlencode($option_id));
				}
			}

?>
							</ul>
						</li>
						<li class="collapsed" ><a class="collapsed_lv2"><span><?php echo xl('Import', 'e'); ?></span></a>
							<ul>
<?php

			genMiscLink('RTop', 'ccr', '0', xlt('Upload'), 'patient_file/ccr_import.php');
			genMiscLink('RTop', 'apr', '0', xlt('Pending Approval'), 'patient_file/ccr_pending_approval.php');

?>
							</ul>
						</li>
<?php

		} // end if gbl_nav_visit_forms

?>
					</ul>
				</li>
<?php

		// TajEmo Work by CB 2012/06/21 10:41:15 AM hides fees if disabled in globals
		if(!isset($GLOBALS['enable_fees_in_left_menu']) || $GLOBALS['enable_fees_in_left_menu'] == 1) {

?>
				<li><a class="collapsed" id="feeimg" ><span><?php xl('Fees', 'e'); ?></span></a>
					<ul>
<?php

			genMiscLink('RBot', 'cod', '2', xl('Fee Sheet'), 'patient_file/encounter/load_form.php?formname=fee_sheet');

			if($GLOBALS['use_charges_panel']) {
				genTreeLink('RBot', 'cod', xl('Charges'));
			}

			genMiscLink('RBot', 'pay', '1', xl('Payment'), 'patient_file/front_payment.php');
			genMiscLink('RBot', 'bil', '1', xl('Checkout'), 'patient_file/pos_checkout.php?framed=1');

			if(!$GLOBALS['simplified_demographics']) {
				genTreeLink('RTop', 'bil', xl('Billing'));
			}

			genTreeLink('RTop', 'npa', xl('Batch Payments'), false, 2);

			if($GLOBALS['enable_edihistory_in_left_menu'] && acl_check('acct', 'eob')) {
				genTreeLink('RTop', 'edi', xl('EDI History'), false, 2);
			}

?>
					</ul>
				</li>
<?php

		}

		if(acl_check('menus', 'modle')) {

?>
				<li><a class="collapsed" id="modimg"><span><?php echo xlt('Modules'); ?></span></a>
					<ul>
<?php

			genMiscLink('RTop', 'adm', '0', xl('Manage Modules'), 'modules/zend_modules/public/Installer');
			// genTreeLink('RTop', 'ort', xl('Settings'));

			$module_query = sqlStatement('SELECT mod_directory, mod_name, mod_nick_name, mod_relative_link, type
				FROM modules
				WHERE mod_active = 1
					AND sql_run = 1
				ORDER BY mod_ui_order
				ASC');

			if(sqlNumRows($module_query)) {
				while($modulerow = sqlFetchArray($module_query)) {
					$acl_section = strtolower($modulerow['mod_directory']);
					$disallowed[$acl_section] = zh_acl_check($_SESSION['authUserID'], $acl_section) ? '' : '1';

					$modulePath = '';
					$added 		= '';

					if($modulerow['type'] == 0) {
						$modulePath = $GLOBALS['customModDir'];
						$added		= '';
					} else {
						$added		= 'index';
						$modulePath = $GLOBALS['zendModDir'];
					}

					$relative_link = 'modules/'.$modulePath.'/'.$modulerow['mod_relative_link'].$added;
					$mod_nick_name = $modulerow['mod_nick_name'] ? $modulerow['mod_nick_name'] : $modulerow['mod_name'];

					genMiscLink2('RTop', $acl_section, '0', xlt($mod_nick_name), $relative_link);
				}
			}

?>
					</ul>
				</li>
<?php

		}

		// if($GLOBALS['inhouse_pharmacy'] && acl_check('admin', 'drugs')) {
		// 	genMiscLink('RTop', 'adm', '0', xl('Inventory'), 'drugs/drug_inventory.php');
		// }

		if($GLOBALS['inhouse_pharmacy'] && acl_check('admin', 'drugs')) {

?>
				<li><a class="collapsed" id="invimg" ><span><?php xl('Inventory', 'e'); ?></span></a>
					<ul>
<?php

			genMiscLink('RTop', 'adm', '0', xl('Management'), 'drugs/drug_inventory.php');
			genPopLink(xl('Destroyed'), 'destroyed_drugs_report.php');

?>
					</ul>
				</li>
<?php

		}

?>
				<li><a class="collapsed" id="proimg" ><span><?php xl('Procedures', 'e'); ?></span></a>
					<ul>
<?php

		genTreeLink('RTop', 'orl', xl('Providers'));
		genTreeLink('RTop', 'ort', xl('Configuration'));
		genTreeLink('RTop', 'orc', xl('Load Compendium'));
		genTreeLink('RTop', 'orp', xl('Pending Review'));
		genTreeLink('RTop', 'orr', xl('Patient Results'));
		genTreeLink('RTop', 'lda', xl('Lab Overview'));
		genTreeLink('RTop', 'orb', xl('Batch Results'));
		genTreeLink('RTop', 'ore', xl('Electronic Reports'));
		genTreeLink('RTop', 'dld', xl('Lab Documents'));

?>
					</ul>
				</li>
<?php

		if($GLOBALS['erx_enable']) {
			$newcrop_user_role = sqlQuery('SELECT newcrop_user_role FROM users WHERE username = "'.$_SESSION['authUser'].'"');

			if($newcrop_user_role['newcrop_user_role']) {

?>
				<li><a class="collapsed" id="feeimg" ><span><?php xl('New Crop', 'e'); ?></span></a>
					<ul>
						<li><a class="collapsed_lv2"><span><?php xl('Status', 'e'); ?></span></a>
							<ul>
<?php

				genTreeLink('RTop', 'erx', xl('e-Rx'));
				genMiscLink('RTop', 'err', '0', xl('e-Rx Renewal'), 'eRx.php?page=status');

				if($newcrop_user_role['newcrop_user_role'] === 'erxadmin') {
					genMiscLink('RTop', 'ere', '0', xl('e-Rx EPCS'), 'eRx.php?page=epcs-admin');
				}

?>
							</ul>
						</li>
					</ul>
				</li>
<?php

			}
		}

		if(!$disallowed['adm']) {

?>
				<li><a class="collapsed" id="admimg" ><span><?php xl('Administration', 'e'); ?></span></a>
					<ul>
<?php

			if(acl_check('admin', 'super')) {
				genMiscLink('RTop', 'adm', '0', xl('Globals'), 'super/edit_globals.php');
			}

			if(acl_check('admin', 'users')) {
				genMiscLink('RTop', 'adm', '0', xl('Facilities'), 'usergroup/facilities.php');
			}

			if(acl_check('admin', 'users')) {
				genMiscLink('RTop', 'adm', '0', xl('Users'), 'usergroup/usergroup_admin.php');
			}

			if(acl_check('admin', 'practice')) {
				genTreeLink('RTop', 'adb', xl('Ad dr Book'));
			}

			// Changed the target URL from practice settings -> Practice Settings - Pharmacy... Dec 09, 09 .. Visolve ... This replaces empty frame with Pharmacy window
			if(acl_check('admin', 'practice')) {
				genMiscLink('RTop', 'adm', '0', xl('Practice'), '../controller.php?practice_settings&pharmacy&action=list');
			}

			if(acl_check('admin', 'superbill')) {
				genTreeLink('RTop', 'sup', xl('Codes'));
			}

			if(acl_check('admin', 'super')) {
				genMiscLink('RTop', 'adm', '0', xl('Layouts'), 'super/edit_layout.php');
			}

			if(acl_check('admin', 'super')) {
				genMiscLink('RTop', 'adm', '0', xl('Lists'), 'super/edit_list.php');
			}

			if(acl_check('admin', 'acl')) {
				genMiscLink('RTop', 'adm', '0', xl('ACL'), 'usergroup/adminacl.php');
			}

			if(acl_check('admin', 'super')) {
				genMiscLink('RTop', 'adm', '0', xl('Files'), 'super/manage_site_files.php');
			}

			if(acl_check('admin', 'super')) {
				genMiscLink('RTop', 'adm', '0', xl('Backup'), 'main/backup.php');
			}

			if(acl_check('admin', 'super') && $GLOBALS['enable_cdr']) {
				genMiscLink('RTop', 'adm', '0', xl('Rules'), 'super/rules/index.php?action=browse!list');
			}

			if(acl_check('admin', 'super') && $GLOBALS['enable_cdr']) {
				genMiscLink('RTop', 'adm', '0', xl('Alerts'), 'super/rules/index.php?action=alerts!listactmgr');
			}

			if(acl_check('admin', 'super') && $GLOBALS['enable_cdr']) {
				genMiscLink('RTop', 'adm', '0', xl('Patient Reminders'), 'patient_file/reminder/patient_reminders.php?mode=admin&patient_id=');
			}

			if(acl_check('admin', 'super') && $GLOBALS['include_de_identification']) {
				genMiscLink('RTop', 'adm', '0', xl('De Identification'), 'de_identification_forms/de_identification_screen1.php');
			}

			if(acl_check('admin', 'super') && $GLOBALS['include_de_identification']) {
				genMiscLink('RTop', 'adm', '0', xl('Re Identification'), 'de_identification_forms/re_identification_input_screen.php');
			}

			if(acl_check('admin', 'super') && !empty($GLOBALS['code_types']['IPPF'])) {
				genMiscLink('RTop', 'adm', '0', xl('Export'), 'main/ippf_export.php');
			}

?>
						<li><a class="collapsed_lv2"><span><?php xl('Other', 'e'); ?></span></a>
							<ul>
<?php

			if(acl_check('admin', 'language')) {
				genMiscLink('RTop', 'adm', '0', xl('Language'), 'language/language.php');
			}

			if(acl_check('admin', 'forms'   )) {
				genMiscLink('RTop', 'adm', '0', xl('Forms'), 'forms_admin/forms_admin.php');
			}

			if(acl_check('admin', 'calendar') && !$GLOBALS['disable_calendar']) {
				genMiscLink('RTop', 'adm', '0', xl('Calendar'), 'main/calendar/index.php?module=PostCalendar&type=admin&func=modifyconfig');
			}

			if(acl_check('admin', 'users'   )) {
				genMiscLink('RTop', 'adm', '0', xl('Logs'), 'logview/logview.php');
			}

			if(acl_check('admin', 'users') && $GLOBALS['erx_enable']) {
				genMiscLink('RTop', 'adm', '0', xl('eRx Logs'), 'logview/erx_logview.php');
			}

			if(!$GLOBALS['disable_phpmyadmin_link'] && acl_check('admin', 'database')) {
				genMiscLink('RTop', 'adm', '0', xl('Database'), '../phpmyadmin/index.php');
			}

			if(acl_check('admin', 'users'   )) {
				genMiscLink('RTop', 'adm', '0', xl('Certificates'), 'usergroup/ssl_certificates_admin.php');
			}

			if(acl_check('admin', 'super'   )) {
				genMiscLink('RTop', 'adm', '0', xl('Native Data Loads'), '../interface/super/load_codes.php');
			}

			if(acl_check('admin', 'super'   )) {
				genMiscLink('RTop', 'adm', '0', xl('External Data Loads'), '../interface/code_systems/dataloads_ajax.php');
			}

			if(acl_check('admin', 'super'   )) {
				genMiscLink('RTop', 'adm', '0', xl('Merge Patients'), 'patient_file/merge_patients.php');
			}

			if($GLOBALS['enable_auditlog_encryption']) {
				genMiscLink('RTop', 'rep', '0', xl('Audit Log Tamper'), 'reports/audit_log_tamper_report.php');
			}


?>
							</ul>
						</li>
					</ul>
				</li>
<?php

		}

?>
				<li><a class="collapsed" id="repimg" ><span><?php xl('Reports', 'e'); ?></span></a>
					<ul>
<?php

		$module_query = sqlStatement('SELECT msh.*, ms.menu_name, ms.path, m.mod_ui_name, m.type
			FROM modules_hooks_settings AS msh
			LEFT OUTER JOIN modules_settings AS ms
				ON obj_name = enabled_hooks
					AND ms.mod_id = msh.mod_id
			LEFT OUTER JOIN modules AS m
				ON m.mod_id = ms.mod_id
			WHERE fld_type = 3
				AND mod_active = 1
				AND sql_run = 1
				AND attached_to = "reports"
			ORDER BY mod_id');

		if(sqlNumRows($module_query)) {
			$jid = 0;
			$modid = '';

			while($modulerow = sqlFetchArray($module_query)) {
				$modulePath = '';
				$added 		= '';

				if($modulerow['type'] == 0) {
					$modulePath = $GLOBALS['customModDir'];
					$added		= '';
				} else {
					$added		= 'index';
					$modulePath = $GLOBALS['zendModDir'];
				}

				$relative_link ='modules/'.$modulePath.'/'.$modulerow['mod_relative_link'].$modulerow['path'];
				$mod_nick_name = $modulerow['menu_name'] ? $modulerow['menu_name'] : 'NoName';

				if($jid == 0 || ($modid != $modulerow['mod_id'])) {
					if($modid != '') {

?>
							</ul>
						</li>
<?php

					}

?>
						<li><a class="collapsed_lv2"><span><?php echo xlt($modulerow['mod_ui_name']); ?></span></a>
							<ul>
<?php

				}

				$jid++;
				$modid = $modulerow['mod_id'];

				genMiscLink('RTop', 'adm', '0', xlt($mod_nick_name), $relative_link);
			}

?>
							</ul>
						</li>
<?php

		}

?>
						<li><a class="collapsed_lv2"><span><?php xl('Clients', 'e'); ?></span></a>
							<ul>
<?php

		genMiscLink('RTop', 'rep', '0', xl('List'), 'reports/patient_list.php');

		if(acl_check('patients', 'med') && !$GLOBALS['disable_prescriptions']) {
			genMiscLink('RTop', 'rep', '0', xl('Rx'), 'reports/prescriptions_report.php');
		}

		if(acl_check('patients', 'med')) {
			genMiscLink('RTop', 'rep', '0', xl('Patient List Creation'), 'reports/patient_list_creation.php');
		}

		if(acl_check('patients', 'med')) {
			genMiscLink('RTop', 'rep', '0', xl('Clinical'), 'reports/clinical_reports.php');
		}

		genMiscLink('RTop', 'rep', '0', xl('Referrals'), 'reports/referrals_report.php');
		genMiscLink('RTop', 'rep', '0', xl('Immunization Registry'), 'reports/immunization_report.php');

?>
							</ul>
						</li>
						<li><a class="collapsed_lv2"><span><?php xl('Clinic', 'e'); ?></span></a>
							<ul>
<?php

		if($GLOBALS['enable_cdr'] || $GLOBALS['enable_cqm']  || $GLOBALS['enable_amc']) {
			genMiscLink('RTop', 'rep', '0', xl('Report Results'), 'reports/report_results.php');
		}

		if($GLOBALS['enable_cdr']) {
			genMiscLink('RTop', 'rep', '0', xl('Standard Measures'), 'reports/clinical_measures.php?type=standard');
		}

		if($GLOBALS['enable_cqm']) {
			genMiscLink('RTop', 'rep', '0', xl('Quality Measures (CQM)'), 'reports/clinical_measures.php?type=cqm');
		}

		if($GLOBALS['enable_amc']) {
			genMiscLink('RTop', 'rep', '0', xl('Automated Measures (AMC)'), 'reports/clinical_measures.php?type=amc');
		}

		if($GLOBALS['enable_amc_tracking']) {
			genMiscLink('RTop', 'rep', '0', xl('AMC Tracking'), 'reports/amc_tracking.php');
		}

		if($GLOBALS['enable_cdr'] && $GLOBALS['enable_alert_log'] ) {
			genMiscLink('RTop', 'rep', '0', xl('Alerts Log'), 'reports/cdr_log.php');
		}

?>
							</ul>
						</li>
						<li><a class="collapsed_lv2"><span><?php xl('Visits', 'e'); ?></span></a>
							<ul>
<?php

		if(!$GLOBALS['disable_calendar']) {
			genMiscLink('RTop', 'rep', '0', xl('Appointments'), 'reports/appointments_report.php');
		}

		if(!$GLOBALS['disable_pat_trkr'] && !$GLOBALS['disable_calendar']) {
			genMiscLink('RTop', 'rep', '0', xl('Patient Flow Board'), 'reports/patient_flow_board_report.php');
		}

		genMiscLink('RTop', 'rep', '0', xl('Encounters'), 'reports/encounters_report.php');

		if(!$GLOBALS['disable_calendar']) {
			genMiscLink('RTop', 'rep', '0', xl('Appt-Enc'), 'reports/appt_encounter_report.php');
		}

		if(empty($GLOBALS['code_types']['IPPF'])) {
			genMiscLink('RTop', 'rep', '0', xl('Superbill'), 'reports/custom_report_range.php');
		}

		genMiscLink('RTop', 'rep', '0', xl('Eligibility'), 'reports/edi_270.php');
		genMiscLink('RTop', 'rep', '0', xl('Eligibility Response'), 'reports/edi_271.php');

		if(!$GLOBALS['disable_chart_tracker']) {
			genMiscLink('RTop', 'rep', '0', xl('Chart Activity'), 'reports/chart_location_activity.php');
		}

		if(!$GLOBALS['disable_chart_tracker']) {
			genMiscLink('RTop', 'rep', '0', xl('Charts Out'), 'reports/charts_checked_out.php');
		}

		genMiscLink('RTop', 'rep', '0', xl('Services'), 'reports/services_by_category.php');
		genMiscLink('RTop', 'rep', '0', xl('Syndromic Surveillance'), 'reports/non_reported.php');

?>
							</ul>
						</li>
<?php

		if(acl_check('acct', 'rep_a')) {

?>
						<li><a class="collapsed_lv2"><span><?php xl('Financial', 'e'); ?></span></a>
							<ul>
<?php

			genMiscLink('RTop', 'rep', '0', xl('Sales'), 'reports/sales_by_item.php');
			genMiscLink('RTop', 'rep', '0', xl('Cash Rec'), 'billing/sl_receipts_report.php');
			genMiscLink('RTop', 'rep', '0', xl('Front Rec'), 'reports/front_receipts_report.php');
			genMiscLink('RTop', 'rep', '0', xl('Pmt Method'), 'reports/receipts_by_method_report.php');
			genMiscLink('RTop', 'rep', '0', xl('Collections'), 'reports/collections_report.php');
			genMiscLink('RTop', 'rep', '0', xl('Pat Ledger'), 'reports/pat_ledger.php?form=0');
			genMiscLink('RTop', 'rep', '0', xl('Financial Summary by Service Code'), 'reports/svc_code_financial_report.php');

?>
							</ul>
						</li>
<?php

		}

		if($GLOBALS['inhouse_pharmacy']) {

?>
						<li><a class="collapsed_lv2"><span><?php xl('Inventory', 'e'); ?></span></a>
							<ul>
<?php

			genMiscLink('RTop', 'rep', '0', xl('List'), 'reports/inventory_list.php');
			genMiscLink('RTop', 'rep', '0', xl('Activity'), 'reports/inventory_activity.php');
			genMiscLink('RTop', 'rep', '0', xl('Transactions'), 'reports/inventory_transactions.php');

?>
							</ul>
						</li>
<?php

		}

?>
						<li><a class="collapsed_lv2"><span><?php xl('Procedures', 'e'); ?></span></a>
							<ul>
<?php

		genPopLink(xl('Pending Res'), '../orders/pending_orders.php');

		if(!empty($GLOBALS['code_types']['IPPF'])) {
			genPopLink(xl('Pending F/U'), '../orders/pending_followup.php');
		}

		genPopLink(xl('Statistics'), '../orders/procedure_stats.php');

?>
							</ul>
						</li>
<?php

		if(!$GLOBALS['simplified_demographics']) {

?>
						<li><a class="collapsed_lv2"><span><?php xl('Insurance', 'e'); ?></span></a>
							<ul>
<?php

			genMiscLink('RTop', 'rep', '0', xl('Distribution'), 'reports/insurance_allocation_report.php');
			genMiscLink('RTop', 'rep', '0', xl('Indigents'), 'billing/indigent_patients_report.php');
			genMiscLink('RTop', 'rep', '0', xl('Unique SP'), 'reports/unique_seen_patients_report.php');

?>
							</ul>
						</li>
<?php

		}

		if(!empty($GLOBALS['code_types']['IPPF'])) {

?>
						<li><a class="collapsed_lv2"><span><?php xl('Statistics', 'e'); ?></span></a>
							<ul>
<?php

			genPopLink(xl('IPPF Stats'), 'ippf_statistics.php?t=i');
			genPopLink(xl('GCAC Stats'), 'ippf_statistics.php?t=g');
			genPopLink(xl('MA Stats'), 'ippf_statistics.php?t=m');
			genPopLink(xl('CYP'), 'ippf_cyp_report.php');
			genPopLink(xl('Daily Record'), 'ippf_daily.php');

?>
							</ul>
						</li>
<?php

		} // end ippf-specific

?>
						<li><a class="collapsed_lv2"><span><?php xl('Blank Forms', 'e'); ?></span></a>
							<ul>
<?php

		genPopLink(xl('Demographics'), '../patient_file/summary/demographics_print.php');
		genPopLink(xl('Superbill/Fee Sheet'), '../patient_file/printed_fee_sheet.php');
		genPopLink(xl('Referral'), '../patient_file/transaction/print_referral.php');


		$lres = sqlStatement('SELECT * FROM list_options WHERE list_id = "lbfnames" ORDER BY seq, title');

		while($lrow = sqlFetchArray($lres)) {
			$option_id = $lrow['option_id']; // should start with LBF
			$title = $lrow['title'];

			genPopLink($title, '../forms/LBF/printable.php?formname='.$option_id);
		}

?>
							</ul>
						</li>
<?php

		if(acl_check('admin', 'super')) {

?>
						<li><a class="collapsed_lv2"><span><?php echo xl('Services', 'e'); ?></span></a>
							<ul>
<?php

			genMiscLink('RTop', 'rep', '0', xl('Background Services'), 'reports/background_services.php');
			genMiscLink('RTop', 'rep', '0', xl('Direct Message Log'), 'reports/direct_message_log.php');

?>
							</ul>
						</li>
<?php

		}

		// genTreeLink('RTop', 'rep', 'Other');

?>
					</ul>
				</li>
				<li><a class="collapsed" id="misimg" ><span><?php xl('Miscellaneous', 'e'); ?></span></a>
					<ul>
<?php

		genTreeLink('RTop', 'ped', xl('Patient Education'));
		genTreeLink('RBot', 'aun', xl('Authorizations'));
		genTreeLink('RTop', 'fax', xl('Fax/Scan'));
		genTreeLink('RTop', 'adb', xl('Addr Book'));
		genTreeLink('RTop', 'ort', xl('Order Catalog'));

		if(!$GLOBALS['disable_chart_tracker']) {
			genTreeLink('RTop', 'cht', xl('Chart Tracker'));
		}

		genTreeLink('RTop', 'ono', xl('Ofc Notes'));
		genMiscLink('RTop', 'adm', '0', xl('BatchCom'), 'batchcom/batchcom.php');

		$myrow = sqlQuery('SELECT state FROM registry WHERE directory = "track_anything"');

		if($myrow['state']=='1') {
			genTreeLink('RTop', 'tan', xl('Configure Tracks'));
		}

		genTreeLink('RTop', 'pwd', xl('Password'));
		genMiscLink('RTop', 'prf', '0', xl('Preferences'), 'super/edit_globals.php?mode=user');

		if(acl_check('patients', 'docs')) {
			genMiscLink('RTop', 'adm', '0', xl('New Documents'), '../controller.php?document&list&patient_id=00');
		}

		if(acl_check('patients', 'docs')) {
			genMiscLink('RTop', 'adm', '0', xl('Document Templates'), 'super/manage_document_templates.php');
		}

?>
					</ul>
				</li>
			</ul>
<?php

	}

} else { // end ($GLOBALS['concurrent_layout'] == 2 || $GLOBALS['concurrent_layout'] == 3)

?>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td colspan="3">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td class="smalltext" nowrap>
									<input type="checkbox" name="cb_top" onclick="toggleFrame(1)" checked />
									<b><?php xl('Top', 'e'); ?></b>
								</td>
								<td class="smalltext" align="right" nowrap>
									<b><?php xl('Bot', 'e'); ?></b>
									<input type="checkbox" name="cb_bot" onclick="toggleFrame(2)" checked />
								</td>
							</tr>
						</table>
					</td>
				</tr>
<?php

	// Builds the table of radio buttons and their labels.  Radio button values
	// are comprised of the 3-character document id and the 1-digit usage type,
	// so that JavaScript can easily access this information.
	$default_top_rbid = 'cal';

	foreach ($primary_docs as $key => $varr) {
		if(!empty($disallowed[$key])) {
			continue;
		}

		$label = $varr[0];
		$usage = $varr[1];
		$url   = $varr[2];

		echo '<tr>'.PHP_EOL.
			'<td class="smalltext">'.
			'<input type="radio" name="rb_top" value="'.$key.$usage.
			'" onclick="loadFrame(\''.$key.$usage.'\', \'RTop\', \''.$url.'\')"'.
			($key == $default_top_rbid ? ' checked' : '').' /></td>'.PHP_EOL.
			'<td class="smalltext" id="lbl_'.$key.'">'.$label.'</td>'.PHP_EOL.
			'<td class="smalltext"><input type="radio" name="rb_bot" value="'.$key.$usage.
			'" onclick="loadFrame(\''.$key.$usage.'\', \'RBot\', \''.$url.'\')"'.
			($key == 'msg' ? ' checked' : '').' /></td>'.PHP_EOL.
			'</tr>'.PHP_EOL;
	}

?>
			</table>
<?php

}

?>
			<br /><hr />
<?php

// To use RelayHealth, see comments and parameters in includes/config.php.
if(!empty($GLOBALS['ssi']['rh'])) {
	include_once '../../library/ssi.inc';
	echo getRelayHealthLink().'<br /><hr />'.PHP_EOL;
}

?>
			<div id="current_patient" style="display: none;">
				<b><?php xl('None', 'e'); ?></b>
			</div>
			<div id="current_encounter" style="display: none;">
				<b><?php xl('None', 'e'); ?></b>
			</div>
<?php

genPopupsList();
echo '<hr />'.PHP_EOL;

genFindBlock();
echo '<hr />'.PHP_EOL;

if(!empty($GLOBALS['online_support_link'])) {

?>
			<a href="<?php echo $GLOBALS['online_support_link']; ?>" target="_blank" id="support_link" class="css_button" onClick="top.restoreSession()"><span><?php xl('Online Support', 'e'); ?></span></a>
<?php

}

?>
			<input type="hidden" name="findBy" value="Last" />
			<input type="hidden" name="searchFields" id="searchFields"/>
			<input type="hidden" name="search_service_code" value="" />
		</form>
		<script language="JavaScript">
			syncRadios();
		</script>
	</body>
</html>
