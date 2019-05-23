<?php
/*
 *  Billing Report Program
 *
 *  This program displays the main search and select screen for claims generation
 *
 *  The changes to this file as of November 16 2016 to add the 1500 pre-printed form
 *  are covered under the terms of the Mozilla Public License, v. 2.0
 *
 * @copyright Copyright (C) 2016-2017 Terry Hill <teryhill@yahoo.com>
 * No previous copyright listed in file. This was an original OpenEMR program.
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-license.php.
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package Libre EHR
 * @author Terry Hill <teryhill@yahoo.com>
 * @link http://LibreEHR.org
 *
 * Please help the overall project by sending changes you make to the author and to the Libre EHR community.
 * Added hooks for UB04 and End of day reporting Terry Hill 2014 teryhill@yahoo.com
 *
 */

$fake_register_globals=false;
$sanitize_all_escapes=true;

require_once("../globals.php");
require_once("../../library/acl.inc");
require_once("../../custom/code_types.inc.php");
require_once("$srcdir/patient.inc");
include_once("$srcdir/../interface/reports/report.inc.php");//Criteria Section common php page
require_once("$srcdir/billrep.inc");
require_once(dirname(__FILE__) . "/../../library/classes/OFX.class.php");
require_once(dirname(__FILE__) . "/../../library/classes/X12Partner.class.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/headers.inc.php");
require_once("$srcdir/options.inc.php");
require_once("adjustment_reason_codes.php");

$EXPORT_INC = "$webserver_root/custom/BillingExport.php";
//echo $GLOBALS['daysheet_provider_totals'];

$daysheet = false;
$daysheet_total = false;
$provider_run = false;
$DateFormat = DateFormatRead();

if ($GLOBALS['use_custom_daysheet'] != 0) {
  $daysheet = true;
  if ($GLOBALS['daysheet_provider_totals'] == 1) {
   $daysheet_total = true;
   $provider_run =  false;
  }
  if ($GLOBALS['daysheet_provider_totals'] == 0) {
   $daysheet_total = false;
   $provider_run =  true;
  }
}

$alertmsg = '';

if (isset($_POST['mode'])) {
  if ($_POST['mode'] == 'export') {
    $sql = ReturnOFXSql();
    $db = get_db();
    $results = $db->Execute($sql);
    $billings = array();
    if ($results->RecordCount() == 0) {
      echo xlt("No Bills Found to Include in OFX Export")."<br>";
    } else {
      while(!$results->EOF) {
        $billings[] = $results->fields;
        $results->MoveNext();
      }
      $ofx = new OFX($billings);
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Disposition: attachment; filename=libreehr_ofx.ofx");
      header("Content-Type: text/xml");
      echo $ofx->get_OFX();
      exit;
    }
  }


}

//global variables:
$from_date     = isset($_POST['from_date'])  ? $_POST['from_date']  : date('Y-m-d');
$to_date       = isset($_POST['to_date'  ])  ? $_POST['to_date'  ]  : '';
$code_type     = isset($_POST['code_type'])  ? $_POST['code_type']  : 'all';
$unbilled      = isset($_POST['unbilled' ])  ? $_POST['unbilled' ]  : 'on';
$my_authorized = isset($_POST["authorized"]) ? $_POST["authorized"] : '';


// This tells us if only encounters that appear to be missing a "25" modifier
// are to be reported.
$missing_mods_only = (isset($_POST['missing_mods_only']) && !empty($_POST['missing_mods_only']));

$left_margin = isset($_POST["left_margin"]) ? $_POST["left_margin"] : $GLOBALS['cms_left_margin_default'];
$top_margin  = isset($_POST["top_margin"] ) ? $_POST["top_margin" ] : $GLOBALS['cms_top_margin_default'];

if ($GLOBALS['claim_type'] =='1' || $GLOBALS['claim_type'] =='2' ) {
$ubleft_margin = isset($_POST["ubleft_margin"]) ? $_POST["ubleft_margin"] : $GLOBALS['ubleft_margin_default'];
$ubtop_margin  = isset($_POST["ubtop_margin"] ) ? $_POST["ubtop_margin" ] : $GLOBALS['ubtop_margin_default'];
}

$ofrom_date  = $from_date;
$oto_date    = $to_date;
$ocode_type  = $code_type;
$ounbilled   = $unbilled;
$oauthorized = $my_authorized;
?>

<html>
<head>
<?php if (function_exists('html_header_show')) html_header_show();


?>

<?php
# load the required libraries
call_required_libraries(array("font-awesome", "jquery-min-3-3-1", "select2", "bootstrap"));

function get_account_type_list() {
    $sql = "SELECT title FROM `list_options` WHERE list_id='insurance_account_type'";
    $res = sqlQ($sql);
    $resArray = array();
    while ($row = sqlFetchArray($res) ) {
        array_push($resArray, $row);
    }
    return $resArray;

}

?>
<link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css">
<style>
.red-text {
  color: red !important;
}
.patient_encounter {
  color: #000 !important;
  text-decoration: underline !important;
  font-weight: bold !important;
}
.primary-table {
  margin-top: 10px !important;
  margin-bottom: 0px !important;
  background-color: #fbfbfe !important;
}

.secondary-table {
  margin-bottom: 0px !important;
  background-color: #eee !important;

}
.criteria_copy_input{
  cursor: pointer !important;
   border: none !important;
   background: inherit !important;
  font-family: inherit;
  font-size: inherit;
  padding: none;



}

.criteria_copy_input:focus {
  outline: none !important;
}


.borderless td, .borderless th {
    border: none  !important;
}


.borderless-rows td {
  border: none !important;
}

body, html {
  background-color: #ffffff;
  color: #000;
}
.primary-table, .secondary-table {
    table-layout: fixed;
    word-wrap: break-word;
}

.cp-output, .subbtn, .cp-misc {
  border: 4px solid #000;
  padding: 40px;
  background: white;
  color: #000;
  width: 100px;
}
.subbtn { margin-top:3px; margin-bottom:3px; margin-left:2px; margin-right:2px }
</style>
<script>

function select_all() {
  for($i=0;$i < document.update_form.length;$i++) {
    $name = document.update_form[$i].name;
    if ($name.substring(0,7) == "claims[" && $name.substring($name.length -6) == "[bill]") {
      document.update_form[$i].checked = true;
    }
  }
  set_button_states();
}

function set_button_states() {
  var f = document.update_form;
  var count0 = 0; // selected and not billed or queued
  var count1 = 0; // selected and queued
  var count2 = 0; // selected and billed
  for($i = 0; $i < f.length; ++$i) {
    $name = f[$i].name;
    if ($name.substring(0, 7) == "claims[" && $name.substring($name.length -6) == "[bill]" && f[$i].checked == true) {
      if      (f[$i].value == '0') ++count0;
      else if (f[$i].value == '1' || f[$i].value == '5') ++count1;
      else ++count2;
    }
  }

  var can_generate = (count0 > 0 || count1 > 0 || count2 > 0);
  var can_mark     = (count1 > 0 || count0 > 0 || count2 > 0);
  var can_bill     = (count0 == 0 && count1 == 0 && count2 > 0);

<?php if (file_exists($EXPORT_INC)) { ?>
  f.bn_external.disabled        = !can_generate;
<?php } else { ?>
  // f.bn_hcfa_print.disabled      = !can_generate;
  // f.bn_hcfa.disabled            = !can_generate;
  // f.bn_ub92_print.disabled      = !can_generate;
  // f.bn_ub92.disabled            = !can_generate;
<?php if ($GLOBALS['claim_type'] =='0' || $GLOBALS['claim_type'] =='2' ) { ?>
  f.bn_x12.disabled             = !can_generate;
<?php } ?>
<?php if ($GLOBALS['support_encounter_claims']) { ?>
  f.bn_x12_encounter.disabled   = !can_generate;
<?php } ?>
<?php if ($GLOBALS['claim_type'] =='0' || $GLOBALS['claim_type'] =='2' ) { ?>
  f.bn_process_hcfa.disabled    = !can_generate;
<?php if ($GLOBALS['preprinted_cms_1500']) { ?>
  f.bn_process_hcfa_form.disabled    = !can_generate;
<?php } ?>
  f.bn_hcfa_txt_file.disabled   = !can_generate;
 <?php } ?>
<?php if ($GLOBALS['claim_type'] =='1' || $GLOBALS['claim_type'] =='2' ) { ?>
  f.bn_process_ub04.disabled    = !can_generate;
  <?php if ($GLOBALS['preprinted_cms_1450']) { ?>
  f.bn_process_ub04_form.disabled    = !can_generate;
<?php } ?>
  f.bn_ub04_txt_file.disabled   = !can_generate;
  f.bn_837I.disabled            = !can_generate;
 <?php } ?>
  // f.bn_electronic_file.disabled = !can_bill;
  f.bn_reopen.disabled          = !can_bill;
<?php } ?>
  f.bn_mark.disabled            = !can_mark;
}

// Process a click to go to an encounter.
function toencounter(pid, pubpid, pname, enc, datestr, dobstr) {
 top.restoreSession();
     encurl = 'patient_file/encounter/encounter_top.php?set_encounter=' + enc + '&pid=' + pid;
 parent.left_nav.setPatient(pname,pid,pubpid,'',dobstr);
     parent.left_nav.setEncounter(datestr, enc, 'enc');
     parent.left_nav.loadFrame('enc2', 'enc', encurl);
}
// Process a click to go to an patient.
function topatient(pid, pubpid, pname, enc, datestr, dobstr) {
 top.restoreSession();
    paturl = 'patient_file/summary/demographics_full.php?pid=' + pid;
 parent.left_nav.setPatient(pname,pid,pubpid,'',dobstr);
    parent.left_nav.loadFrame('dem1', 'pat1', paturl);
}
</script>
<script language="javascript" type="text/javascript">
EncounterDateArray=new Array;
CalendarCategoryArray=new Array;
EncounterIdArray=new Array;
function SubmitTheScreen()
 {//Action on Update List link
  //if(!ProcessBeforeSubmitting())
   //return false;
  top.restoreSession();
  //document.the_form.mode.value='change';
  document.the_form.target='_self';
  document.the_form.action='billing_report.php';
  document.the_form.submit();
  return true;
 }
function SubmitTheScreenPrint()
 {//Action on View Printable Report link
  if(!ProcessBeforeSubmitting())
   return false;
  top.restoreSession();
  document.the_form.target='new';
  document.the_form.action='print_billing_report.php';
  document.the_form.submit();
  return true;
 }
  function SubmitTheEndDayPrint()
 {//Action on View End of Day Report link
  if(!ProcessBeforeSubmitting())
   return false;
  top.restoreSession();
  document.the_form.target='new';
<?php if ($GLOBALS['use_custom_daysheet'] == 1) { ?>
  document.the_form.action='print_daysheet_report_num1.php';
<?php } ?>
<?php if ($GLOBALS['use_custom_daysheet'] == 2) { ?>
  document.the_form.action='print_daysheet_report_num2.php';
<?php } ?>
<?php if ($GLOBALS['use_custom_daysheet'] == 3) { ?>
  document.the_form.action='print_daysheet_report_num3.php';
<?php } ?>
<?php if ($GLOBALS['use_custom_daysheet'] == 4) { ?>
  document.the_form.action='print_daysheet_report_num4.php';
<?php } ?>
  document.the_form.submit();
  return true;
 }
function SubmitTheScreenExportOFX()
 {//Action on Export OFX link
  if(!ProcessBeforeSubmitting())
   return false;
  top.restoreSession();
  document.the_form.mode.value='export';
  document.the_form.target='_self';
  document.the_form.action='billing_report.php';
  document.the_form.submit();
  return true;
 }
function TestExpandCollapse()
 {//Checks whether the Expand All, Collapse All labels need to be placed.If any result set is there these will be placed.
    var set=-1;
    for(i=1;i<=document.getElementById("divnos").value;i++)
    {
        var ele = document.getElementById("divid_"+i);
        if(ele)
        {
        set=1;
        break;
        }
    }
    if(set==-1)
         {
         if(document.getElementById("ExpandAll"))
          {
             document.getElementById("ExpandAll").innerHTML='';
             document.getElementById("CollapseAll").innerHTML='';
          }
         }
 }
function expandcollapse(atr){
    if(atr == "expand") {//Called in the Expand All, Collapse All links(All items will be expanded or collapsed)
        for(i=1;i<=document.getElementById("divnos").value;i++){
            var mydivid="divid_"+i;var myspanid="spanid_"+i;
                var ele = document.getElementById(mydivid);    var text = document.getElementById(myspanid);
                if(ele)
                 {
                    ele.style.display = "inline";text.innerHTML = "<?php echo htmlspecialchars(xl('Collapse'), ENT_QUOTES); ?>";
                 }
        }
      }
    else {
        for(i=1;i<=document.getElementById("divnos").value;i++){
            var mydivid="divid_"+i;var myspanid="spanid_"+i;
                var ele = document.getElementById(mydivid);    var text = document.getElementById(myspanid);
                if(ele)
                 {
                    ele.style.display = "none";    text.innerHTML = "<?php echo htmlspecialchars(xl('Expand'), ENT_QUOTES); ?>";
                 }
        }
    }

}
function divtoggle(spanid, divid) {//Called in the Expand, Collapse links(This is for a single item)
    var ele = document.getElementById(divid);
    if(ele)
     {
        var text = document.getElementById(spanid);
        if(ele.style.display == "inline") {
            ele.style.display = "none";
            text.innerHTML = "<?php echo htmlspecialchars(xl('Expand'), ENT_QUOTES); ?>";
        }
        else {
            ele.style.display = "inline";
            text.innerHTML = "<?php echo htmlspecialchars(xl('Collapse'), ENT_QUOTES); ?>";
        }
     }
}
function MarkAsCleared(Type)
 {
  CheckBoxBillingCount=0;
  for (var CheckBoxBillingIndex =0; ; CheckBoxBillingIndex++)
   {
    CheckBoxBillingObject=document.getElementById('CheckBoxBilling'+CheckBoxBillingIndex);
    if(!CheckBoxBillingObject)
     break;
    if(CheckBoxBillingObject.checked)
     {
       ++CheckBoxBillingCount;
     }
   }
   if(Type==1)
    {
     Message='<?php echo htmlspecialchars( xl('After saving your batch, click [View Log] to check for errors.'), ENT_QUOTES); ?>';
    }
   if(Type==2)
    {
     Message='<?php echo htmlspecialchars( xl('After saving the PDF, click [View Log] to check for errors.'), ENT_QUOTES); ?>';
    }
   if(Type==3)
    {
     Message='<?php echo htmlspecialchars( xl('After saving the TEXT file(s), click [View Log] to check for errors.'), ENT_QUOTES); ?>';
    }
  if(confirm(Message + "\n\n\n<?php echo addslashes( xl('Total') ); ?>" + ' ' + CheckBoxBillingCount + ' ' +  "<?php echo addslashes( xl('Selected') ); ?>\n" +
  "<?php echo addslashes( xl('Would You Like them to be Marked as Cleared.') ); ?>"))
   {
    document.getElementById('HiddenMarkAsCleared').value='yes';
  }
  else
   {
    document.getElementById('HiddenMarkAsCleared').value='';
   }
 }
</script>
<?php include_once("$srcdir/../interface/reports/report.script.php"); ?><!-- Criteria Section common javascript page-->
<!-- ================================================== -->
<!-- =============Included for Insurance ajax criteria==== -->
<!-- ================================================== -->
<link rel="stylesheet" href="../../library/css/jquery.datetimepicker.css">
<!-- <script type="text/javascript" src="../../library/js/jquery-1.7.2.min.js"></script>
 --><script type="text/javascript" src="../../library/js/jquery.datetimepicker.full.min.js"></script>
<?php include_once("{$GLOBALS['srcdir']}/ajax/payment_ajax_jav.inc.php"); ?>
<script type="text/javascript" src="../../library/js/blink/jquery.modern-blink.js"></script>
<script type="text/javascript" src="../../library/js/common.js"></script>
<style>
#ajax_div_insurance {
    position: absolute;
    z-index:10;
    background-color: #FBFDD0;
    border: 1px solid #ccc;
    padding: 10px;
}
</style>
<script language="javascript" type="text/javascript">
</script>
<!-- ================================================== -->
<!-- =============Included for Insurance ajax criteria==== -->
<!-- ================================================== -->
</head>
<body class="body_top" onLoad="TestExpandCollapse()">

<p style='margin-top:5px;margin-bottom:5px;margin-left:5px'>
<font class='title'><?php echo xlt('Build Claim List') ?></font>
</p>

<?php

  function get_all_insurance_companies() {

    $resultArray = array();
    $res = sqlStatement("SELECT insurance_companies.id,name,city,state,country FROM insurance_companies
        left join addresses on insurance_companies.id=addresses.foreign_id  where name like '$insurance_text_ajax%' or  insurance_companies.id like '$insurance_text_ajax%' ORDER BY name");


    while ($row = sqlFetchArray($res))
{

      $text = $row['name'];
      array_push($resultArray, $text);



}

     return $resultArray;

 }
?>
<!--- BUILD NEW UI HERE -->
<div class="col-xs-12">

  <div class="col-xs-6">
      <form name="the_form" method="Post">
      <table class="table table-responsive borderless">
        <input type="hidden" name="mode">
        <tr>
          <td>
            <b> Select Criteria</b>
          </td>
        </tr>
        <!-- first row -->
        <tr>
          <td>
            <b>Billing Status</b>
            <br/>
            <select name="new_ui_billing_status" id="new_ui_billing_status" class="form-control reactive_element">
              <option value="all">All</option>
              <option value="0">Unbilled</option>
              <option value="1">Billed</option>
              <option value="7">Denied</option>
            </select>
          </td>
          <td>
            <b> Claim Type</b>
            <br/>
            <select name="new_ui_claim_type" id="new_ui_claim_type" class="reactive_element form-control">
              <option value="all">All</option>
              <option value="standard">eClaim</option>
              <option value="hcfa">Paper</option>
            </select>
          </td>
        </tr>
        <!--second row-->
        <tr>
          <td>
            <b>Date of Service</b>
            <br/>

            <input  type="text" id="new_ui_from_date"  name="from_date" class="form-control reactive_element">
             &nbsp;
             to
             &nbsp;
             <input type="text" id="new_ui_to_date"  name="to_date" class="form-control reactive_element">

          </td>
          <td>
            <b> Patient Id</b>
            <br/>
            <input type="text" id="new_ui_pid" name="pid" class="form-control reactive_element" onclick="sel_patient()">
          </td>
        </tr>

 <tr>
          <td>
            <b>Insurance</b>
            <br/>
            <select id="new_ui_insurance" name="insurance" class="form-control reactive_element">

              <?php

                $insurance_company_array = get_all_insurance_companies();


                foreach ($insurance_company_array as $key => $value) {
                  echo "<option value='$value'>$value</option>";
                }


              ?>

             </select>

      </td>
          <td>
            <b> Patient Name</b>
            <br/>
            <input type="text" name="pid" class="form-control reactive_element" id="new_ui_patient_name" disabled>
      </td>
          <input type='hidden' name='form_pid' value='0' />
        </tr>
        <tr>
          <td>
            <b>Account type</b> <br/>
            <select id="new_ui_account_type" name="account_type" class="reactive_element">
<?php
                $account_type_list = get_account_type_list();
                foreach ($account_type_list as $key) {
                  $value = $key['title'];
                  echo "<option value='$value'>$value</option>";
                }
?>

            </select>
          </td>
        </tr>
      </table>
    </form>
  </div>

  <div class="col-xs-6" style="background-color:#eee;">

      <table class="table table-responsive borderless" style="background-color:#eee;">
          <tr>
          <td>
            <b> Current Criteria</b>
          </td>
          </tr>
          <tr>
          <td>Billing Status:&nbsp;
          <input type="text" id="new_ui_billing_status_copy" class="criteria_copy_input"></td>
          </tr>
          <tr>
          <td>Date:&nbsp;
          <input type="text"id="new_ui_date_copy" class="criteria_copy_input"></td>
          </tr>

          <tr>
          <td>Insurance:&nbsp;
          <input type="text" id="new_ui_insurance_copy" class="criteria_copy_input">
    </td>
          </tr>

          <tr>
          <td>Claim Type:&nbsp;
          <input type="text" id="new_ui_claim_type_copy" class="criteria_copy_input">
            </td>
          </tr>
          <tr>
          <td>Patient Id:&nbsp;
          <input type="text" id="new_ui_pid_copy" class="criteria_copy_input">
          </td>
          </tr>
        <tr>
          <td>Patient Name:&nbsp;
          <input type="text"  id="new_ui_patient_name_copy" class="criteria_copy_input">


      </td>
 </tr>
    <tr>
          <td>Account type:&nbsp;
          <input type="text" id="new_ui_account_type_copy" class="criteria_copy_input" style="width: 100%;">

    </tr>
</table>
  </div>

  <div class="text-right">
    <b>
    <button class="btn" id="clear_criteria">Clear</button>
    <button onclick="SubmitTheScreen()" class="btn btn-primary" >Update List</button>
  </b>
  </div>

</div>
<!--- NEW UI END -->















<form name='update_form' method='post' action='billing_process.php' onsubmit='return top.restoreSession()' style="display:inline">
<center>
<span class='text' style="display:inline">
<?php if (file_exists($EXPORT_INC)) { ?>
<input type="submit" data-open-popup="true" class="subbtn" name="bn_external" value="Export Billing" title="<?php echo xla('Export to external billing system') ?>">
<input type="submit" data-open-popup="true" class="subbtn" name="bn_mark" value="Mark as Cleared" title="<?php echo xla('Mark as billed but skip billing') ?>">
<?php } else { ?>
<!--
<input type="submit" class="subbtn" name="bn_hcfa_print" value="Queue HCFA &amp; Print" title="<?php echo xla('Queue for HCFA batch processing and printing') ?>">
<input type="submit" class="subbtn" name="bn_hcfa" value="Queue HCFA" title="<?php echo xla('Queue for HCFA batch processing')?>">
<input type="submit" class="subbtn" name="bn_ub92_print" value="Queue UB92 &amp; Print" title="<?php echo xla('Queue for UB-92 batch processing and printing')?>">
<input type="submit" class="subbtn" name="bn_ub92" value="Queue UB92" title="<?php echo xla('Queue for UB-92 batch processing')?>">
-->
<?php if ($GLOBALS['claim_type'] =='0' || $GLOBALS['claim_type'] =='2' ) { ?>
<input type="submit" class="subbtn cp-output" name="bn_x12" value="<?php echo xla('Generate X12')?>"
 title="<?php echo xla('Generate and download X12 batch')?>"
 onclick="MarkAsCleared(1)">
<?php if ($GLOBALS['support_encounter_claims']) { ?>
<input type="submit" class="subbtn cp-output" name="bn_x12_encounter" value="<?php echo xla('Generate X12 Encounter')?>"
 title="<?php echo xla('Generate and download X12 encounter claim batch')?>"
 onclick="MarkAsCleared(1)">
<?php } ?>
<input type="submit" class="subbtn cp-output" style="width:105px;" name="bn_process_hcfa" value="<?php echo xla('CMS 1500 PDF')?>"
 title="<?php echo xla('Generate and download CMS 1500 paper claims')?>"
 onclick="MarkAsCleared(2)">
 <?php if ($GLOBALS['preprinted_cms_1500']) { ?>
<input type="submit" class="subbtn cp-output" style="width:210px;" name="bn_process_hcfa_form" value="<?php echo xla('CMS 1500 PREPRINTED FORM')?>"
 title="<?php echo xla('Generate and download CMS 1500 paper claims on Preprinted form')?>"
 onclick="MarkAsCleared(2)">
 <?php } ?>
<input type="submit" class="subbtn cp-output" style="width:120px;" name="bn_hcfa_txt_file" value="<?php echo xla('CMS 1500 TEXT')?>"
 title="<?php echo xla('Making batch text files for uploading to Clearing House and will mark as billed')?>"
 onclick="MarkAsCleared(3)">
<input type="submit" data-open-popup="true" class="subbtn cp-misc" name="bn_mark" value="<?php echo xla('Mark as Cleared')?>" title="<?php echo xla('Post to accounting and mark as billed')?>">
<input type="submit" data-open-popup="true" class="subbtn cp-misc" name="bn_reopen" value="<?php echo xla('Re-Open')?>" title="<?php echo xla('Mark as not billed')?>">
<!--
<input type="submit" class="subbtn" name="bn_electronic_file" value="Make Electronic Batch &amp; Clear" title="<?php echo xla('Download billing file, post to accounting and mark as billed')?>">
-->
&nbsp;&nbsp;&nbsp;
<?php echo xlt('CMS 1500 Margins'); ?>:
&nbsp;<?php echo xlt('Left'); ?>:
<input type='text' size='2' name='left_margin'
 value='<?php echo attr($left_margin); ?>'
 title='<?php echo xla('HCFA left margin in points'); ?>' />
&nbsp;<?php echo xlt('Top'); ?>:
<input type='text' size='2' name='top_margin'
 value='<?php echo attr($top_margin); ?>'
 title='<?php echo xla('HCFA top margin in points'); ?>' /><br></br>

 <?php } ?>

<?php if ($GLOBALS['claim_type'] =='1' || $GLOBALS['claim_type'] =='2') { ?>

<input type="submit" class="subbtn" name="bn_837I" value="<?php echo xla('Generate 837I')?>"
 title="<?php echo xla('Generate and download 837I file')?>"
 onclick="MarkAsCleared(1)">

<input type="submit" class="subbtn" style="width:175px;" name="bn_process_ub04" value="<?php echo xla('Generate CMS 1450 PDF')?>"
 title="<?php echo xla('Generate and download CMS 1450 paper claims')?>"
 onclick="MarkAsCleared(2)">

 <?php if ($GLOBALS['preprinted_cms_1450']) { ?>
<input type="submit" class="subbtn" style="width:210px;" name="bn_process_ub04_form" value="<?php echo xla('CMS 1450/UB04 PREPRINTED FORM')?>"
 title="<?php echo xla('Generate and download CMS 1450/UB04 paper claims on Preprinted form')?>"
 onclick="MarkAsCleared(2)">
 <?php } ?>

<input type="submit" class="subbtn" style="width:175px;" name="bn_ub04_txt_file" value="<?php echo xla('Generate CMS 1450 TEXT')?>"
 title="<?php echo xla('Making batch text files for uploading to Clearing House and will mark as billed')?>"
 onclick="MarkAsCleared(3)">

<?php if ($GLOBALS['claim_type'] =='1') { ?>

<input type="submit" class="subbtn" name="bn_mark" value="<?php echo xla('Mark as Cleared')?>" title="<?php echo xla('Post to accounting and mark as billed')?>">
<input type="submit" class="subbtn" name="bn_reopen" value="<?php echo xla('Re-Open')?>" title="<?php echo xla('Mark as not billed')?>">

<?php } ?>

<?php if ($GLOBALS['claim_type'] =='2') { ?>

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php } ?>

 &nbsp;&nbsp;&nbsp;

<?php echo xlt('CMS 1450 Margins'); ?>:
&nbsp;<?php echo xlt('Left'); ?>:
<input type='text' size='2' name='ubleft_margin'
 value='<?php echo attr($ubleft_margin); ?>'
 title='<?php echo xla('UB04 left margin in points'); ?>' />
&nbsp;<?php echo xlt('Top'); ?>:
<input type='text' size='2' name='ubtop_margin'
 value='<?php echo attr($ubtop_margin); ?>'
 title='<?php echo xla('UB04 top margin in points'); ?>' />

<?php } ?>
<?php } ?>
</span>

</center>
<input type='hidden' name='HiddenMarkAsCleared'  id='HiddenMarkAsCleared' value="" />
<input type='hidden' name='mode' value="bill" />
<input type='hidden' name='authorized' value="<?php echo attr($my_authorized); ?>" />
<input type='hidden' name='unbilled' value="<?php echo attr($unbilled); ?>" />
<input type='hidden' name='code_type' value="%" />
<input type='hidden' name='to_date' value="<?php echo attr($to_date); ?>" />
<input type='hidden' name='from_date' value="<?php echo attr($from_date); ?>" />

<?php
if ($my_authorized == "on" ) {
  $my_authorized = "1";
} else {
  $my_authorized = "%";
}
if ($unbilled == "on") {
  $unbilled = "0";
} else {
  $unbilled = "%";
}
$list = getBillsListBetween("%");
?>

<input type='hidden' name='bill_list' value="<?php echo attr($list); ?>" />

<!-- new form for uploading -->

<?php
if (!isset($_POST["mode"])) {
  if (!isset($_POST["from_date"])) {
    $from_date = date("Y-m-d");
  } else {
    $from_date = $_POST["from_date"];
  }
  if (empty($_POST["to_date"])) {
    $to_date = '';
  } else {
    $to_date = $_POST["to_date"];
  }
  if (!isset($_POST["code_type"])) {
    $code_type="all";
  } else {
    $code_type = $_POST["code_type"];
  }
  if (!isset($_POST["unbilled"])) {
    $unbilled = "on";
  } else {
    $unbilled = $_POST["unbilled"];
  }
  if (!isset($_POST["authorized"])) {
    $my_authorized = "on";
  } else {
    $my_authorized = $_POST["authorized"];
  }
} else {
  $from_date = $_POST["from_date"];
  $to_date = $_POST["to_date"];
  $code_type = $_POST["code_type"];
  $unbilled = $_POST["unbilled"];
  $my_authorized = $_POST["authorized"];
}

if ($my_authorized == "on" ) {
  $my_authorized = "1";
} else {
  $my_authorized = "%";
}

if ($unbilled == "on") {
  $unbilled = "0";
} else {
  $unbilled = "%";
}

if (isset($_POST["mode"]) && $_POST["mode"] == "bill") {
  billCodesList($list);
}
?>


<?php
$ThisPageSearchCriteriaDisplayRadioMaster=array();
  $ThisPageSearchCriteriaRadioKeyMaster=array();
  $ThisPageSearchCriteriaQueryDropDownMaster=array();
  $ThisPageSearchCriteriaQueryDropDownMasterDefault=array();
  $ThisPageSearchCriteriaQueryDropDownMasterDefaultKey=array();
  $ThisPageSearchCriteriaIncludeMaster=array();

  if ($daysheet) {
  $ThisPageSearchCriteriaDisplayMaster= array( xl("Date of Service"),xl("Date of Entry"),xl("Date of Billing"),xl("Patient Name"),xl("Patient Id"),xl("Provider"),xl("Referring Provider"),xl("Insurance Company"),xl("Claim Type"),xl("Encounter"),xl("Whether Insured"),xl("Charge Coded"),xl("Billing Status"),xl("Authorization Status"),xl("Last Level Billed"),xl("X12 Partner"),xl("User") );
  $ThisPageSearchCriteriaKeyMaster="form_encounter.date,billing.date,claims.process_time,patient_data.fname,".
                                   "form_encounter.pid,form_encounter.provider_id,form_encounter.referring_physician,claims.payer_id,claims.target,form_encounter.encounter,insurance_data.provider,billing.id,billing.billed,".
                                   "billing.authorized,form_encounter.last_level_billed,billing.x12_partner_id,billing.user";
  $ThisPageSearchCriteriaDataTypeMaster="datetime,datetime,datetime,text_like,".
                                        "text,query_drop_down,query_drop_down,include,radio,text,radio,radio,radio,".
                                        "radio_like,radio,query_drop_down,text";
                     }
                    else
                     {

  $ThisPageSearchCriteriaDisplayMaster= array( xl("Date of Service"),xl("Date of Entry"),xl("Date of Billing"),xl("Patient Name"),xl("Patient Id"),xl("Provider"),xl("Referring Provider"),xl("Insurance Company"),xl("Claim Type"),xl("Encounter"),xl("Whether Insured"),xl("Charge Coded"),xl("Billing Status"),xl("Authorization Status"),xl("Last Level Billed"),xl("X12 Partner") );
  $ThisPageSearchCriteriaKeyMaster="form_encounter.date,billing.date,claims.process_time,patient_data.fname,".
                                   "form_encounter.pid,form_encounter.provider_id,form_encounter.referring_physician,claims.payer_id,claims.target,form_encounter.encounter,insurance_data.provider,billing.id,billing.billed,".
                                   "billing.authorized,form_encounter.last_level_billed,billing.x12_partner_id";
  $ThisPageSearchCriteriaDataTypeMaster="datetime,datetime,datetime,text_like,".
                                        "text,query_drop_down,query_drop_down,include,radio,text,radio,radio,radio,".
                                        "radio_like,radio,query_drop_down";



                     }
  //The below section is needed if there is any 'radio' or 'radio_like' type in the $ThisPageSearchCriteriaDataTypeMaster
  //$ThisPageSearchCriteriaDisplayRadioMaster,$ThisPageSearchCriteriaRadioKeyMaster ==>For each radio data type this pair comes.
  //The key value 'all' indicates that no action need to be taken based on this.For that the key must be 'all'.Display value can be any thing.
  $ThisPageSearchCriteriaDisplayRadioMaster[1] = array( xl("All"),xl("eClaims"),xl("Paper") );//Display Value
  $ThisPageSearchCriteriaRadioKeyMaster[1]="all,standard,hcfa";//Key
  $ThisPageSearchCriteriaDisplayRadioMaster[2]= array( xl("All"),xl("Insured"),xl("Non-Insured") );//Display Value
  $ThisPageSearchCriteriaRadioKeyMaster[2]="all,1,0";//Key
  $ThisPageSearchCriteriaDisplayRadioMaster[3]= array( xl("All"),xl("Coded"),xl("Not Coded") );//Display Value
  $ThisPageSearchCriteriaRadioKeyMaster[3]="all,not null,null";//Key
  $ThisPageSearchCriteriaDisplayRadioMaster[4]= array( xl("All"),xl("Unbilled"),xl("Billed"),xl("Denied") );//Display Value
  $ThisPageSearchCriteriaRadioKeyMaster[4]="all,0,1,7";//Key
  $ThisPageSearchCriteriaDisplayRadioMaster[5]= array( xl("All"),xl("Authorized"),xl("Unauthorized") );
  $ThisPageSearchCriteriaRadioKeyMaster[5]="%,1,0";
  $ThisPageSearchCriteriaDisplayRadioMaster[6]= array( xl("All"),xl("None"),xl("Ins 1"),xl("Ins 2 or Ins 3") );
  $ThisPageSearchCriteriaRadioKeyMaster[6]="all,0,1,2";
  //The below section is needed if there is any 'query_drop_down' type in the $ThisPageSearchCriteriaDataTypeMaster
  $ThisPageSearchCriteriaQueryDropDownMaster[1]="SELECT id, CONCAT(lname, ', ', fname) AS name FROM users WHERE authorized = 1 AND username != '' ORDER BY name ;";
  $ThisPageSearchCriteriaQueryDropDownMasterDefault[1]= xl("All");//Only one item will be here
  $ThisPageSearchCriteriaQueryDropDownMasterDefaultKey[1]="all";//Only one item will be here
  $ThisPageSearchCriteriaQueryDropDownMaster[2]="SELECT id, CONCAT(lname, ', ', fname) AS name FROM users WHERE authorized = 1 OR npi != '' ORDER BY name ;";
  $ThisPageSearchCriteriaQueryDropDownMasterDefault[2]= xl("All");//Only one item will be here
  $ThisPageSearchCriteriaQueryDropDownMasterDefaultKey[2]="all";//Only one item will be here
  $ThisPageSearchCriteriaQueryDropDownMaster[3]="SELECT name,id FROM x12_partners;";
  $ThisPageSearchCriteriaQueryDropDownMasterDefault[3]= xl("All");//Only one item will be here
  $ThisPageSearchCriteriaQueryDropDownMasterDefaultKey[3]="all";//Only one item will be here
  //The below section is needed if there is any 'include' type in the $ThisPageSearchCriteriaDataTypeMaster
  //Function name is added here.Corresponding include files need to be included in the respective pages as done in this page.
  //It is labled(Included for Insurance ajax criteria)(Line:-279-299).
  $ThisPageSearchCriteriaIncludeMaster[1]="InsuranceCompanyDisplay";//This is php function defined in the file 'report.inc.php'

  if(!isset($_REQUEST['mode']))//default case
               {
    $_REQUEST['final_this_page_criteria'][0]="(form_encounter.date between '".date("Y-m-d 00:00:00")."' and '".date("Y-m-d 23:59:59")."')";
    $_REQUEST['final_this_page_criteria'][1]="billing.billed = '0'";

    $_REQUEST['final_this_page_criteria_text'][0]=xl("Date of Service = Today");
    $_REQUEST['final_this_page_criteria_text'][1]=xl("Billing Status = Unbilled");

    $_REQUEST['date_master_criteria_form_encounter_date']="today";
    $_REQUEST['master_from_date_form_encounter_date']=date($DateFormat);
    $_REQUEST['master_to_date_form_encounter_date']=date($DateFormat);

    $_REQUEST['radio_billing_billed']=0;

    }
          else {


      $_REQUEST['final_this_page_criteria'][0]="(form_encounter.date between '".$from_date."' and '".$to_date."')";
      $_REQUEST['final_this_page_criteria'][1]="billing.billed = '$unbilled'";

      $_REQUEST['final_this_page_criteria_text'][0]=xl("Date of Service = Today");
      $_REQUEST['final_this_page_criteria_text'][1]=xl("Billing Status = Unbilled");

      $_REQUEST['date_master_criteria_form_encounter_date']="today";
      $_REQUEST['master_from_date_form_encounter_date']=date($DateFormat);
      $_REQUEST['master_to_date_form_encounter_date']=date($DateFormat);

      $_REQUEST['radio_billing_billed']=0;


          }
  ?>

<?php

  require 'billing_report_claim_list.php';
  PrintBillingReport();

?>

</form>

<script>
set_button_states();
<?php
if ($alertmsg) {
  echo "alert('".addslashes($alertmsg)."');\n";
}
?>
$(document).ready(function() {
    $("#view-log-link").click( function() {
        top.restoreSession();
        dlgopen('customize_log.php', '_blank', 500, 400);
    });

    $('input[type="submit"]').click( function() {
        top.restoreSession();
        $(this).attr('data-clicked', true);
    });

    $('form[name="update_form"]').submit( function(e) {
        var clickedButton = $("input[type=submit][data-clicked='true'")[0];

        // clear clicked button indicator
        $('input[type="submit"]').attr('data-clicked', false);

        if ( !clickedButton || $(clickedButton).attr("data-open-popup") !== "true" ) {
            $(this).removeAttr("target");
            return top.restoreSession();
        } else {
            top.restoreSession();
            var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=300,left = 312,top = 234');
            this.target = 'Popup_Window';
        }
    });

    $('#new_ui_billing_status').val("0").change();
    $('#new_ui_billing_status_copy').val("Unbilled");
    $('#new_ui_date_copy').val("today");

          $('.js-blink-infinite').modernBlink();
});
</script>
<input type="hidden" name="divnos"  id="divnos" value="<?php echo attr($divnos) ?>"/>
<input type='hidden' name='ajax_mode' id='ajax_mode' value='' />
</body>
</html>
<?php call_required_libraries(array("jquery-ui")); ?>
<script>



function sel_patient() {
  dlgopen('<?php echo $GLOBALS["web_root"]; ?>/modules/calendar/find_patient_popup.php?pflag=0', '_blank', 500, 400);
}


   // This is for callback by the find-patient popup.
function setpatient(pid, lname, fname, dob) {

  let patient_name = lname + ', ' + fname;

  $('#new_ui_pid').val(pid);
  $('#new_ui_patient_name').val(patient_name);
  $('#new_ui_pid_copy').text(pid);
  $('#new_ui_patient_name_copy').text(patient_name);


}


$.fn.valAndTrigger = function (element) {
    return $(this).val(element).trigger('change');
}


$(document).ready(function () {

  $('#new_ui_from_date').datepicker({
    dateFormat: "yy-mm-dd",
     onSelect: function(dateText) {

        let date_value =  $('#new_ui_from_date').val()  + "  to  " + $('#new_ui_to_date').val()
        $('#new_ui_date_copy').val(date_value)


     } }).datepicker("setDate", new Date());

  $('#new_ui_to_date').datepicker({ dateFormat: "yy-mm-dd",
   onSelect: function(dateText) {

        let date_value =  $('#new_ui_from_date').val()  + "  to  " + $('#new_ui_to_date').val()
        $('#new_ui_date_copy').val(date_value)


     }
      });

  $('#new_ui_insurance').select2({  multiple: true});

  $('#new_ui_account_type').select2({multiple: true});

  $(document).on('change', '.reactive_element', function() {



  });

  $('.reactive_element').on('input', function() {

      let id = $(this).attr('id');

      let suffix = "_copy";

      if (id == "new_ui_from_date" || id == "new_ui_to_date") {
        let date_value =  $('#new_ui_from_date').val()  + "  to  " + $('#new_ui_to_date').val()
        $('#new_ui_date_copy').val(date_value)

      }
      else if (id == "new_ui_billing_status") {
          let value = $("#"+id+" option:selected").text();
          $('#' + id + suffix).val(value);

      }
      else {
        if (value == undefined) {
          let value = $("#"+id+" option:selected").text();
          console.log(value);
        }
        $('#' + id + suffix).val(value);
      }
  });


  $('.reactive_element').on("select2:select", function(e) {
      let id = $(this).attr('id');
      let value = $("#"+id).val();
      let suffix = "_copy";
      $('#' + id + suffix).val(value);



  });

  $('#clear_criteria').click(function () {

    $('#new_ui_patient_name_copy').val("");
    $('#new_ui_date_copy').val("");
    $('#new_ui_insurance_copy').val("");
    $('#new_ui_claim_type_copy').val("");
    $('#new_ui_pid_copy').val("");
    $('#new_ui_billing_status_copy').val("");
    $('#new_ui_account_type_copy').val("");
    $('#new_ui_account_type').val("");
    $('#new_ui_patient_name').val("");
    $('#new_ui_to_date').val("");
    $('#new_ui_from_date').val("");
    $('#new_ui_insurance').val('').trigger('change');
    $('#new_ui_claim_type').val("");
    $('#new_ui_pid').val("");
    $('#new_ui_billing_status').val("");


  });

  var SELECTED_COPY_CRITERIA_ID = "";

  $('.criteria_copy_input').click(function () {
    $(this).addClass("form-control");
  });

  $('.criteria_copy_input').focusout(function () {
    $(this).removeClass("form-control");
  });






});






</script>
