<?php
 /* Copyright (C) 2016 SunCoast Connection Inc.
 
 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
*/

$sanitize_all_escapes=true;

$fake_register_globals=false;


require_once("../globals.php");
require_once("../../library/patient.inc");
require_once("$srcdir/formatting.inc.php");
require_once "$srcdir/options.inc.php";
require_once "$srcdir/formdata.inc.php";
require_once "$srcdir/clinical_rules.php";
require_once "$srcdir/report_database.inc";

// See if showing an old report or creating a new report
$report_id = (isset($_GET['report_id'])) ? trim($_GET['report_id']) : "";

// Collect the back variable, if pertinent
$back_link = (isset($_GET['back'])) ? trim($_GET['back']) : "";

// If showing an old report, then collect information
if (!empty($report_id)) {
  $report_view = collectReportDatabase($report_id);
  $date_report = $report_view['date_report'];
  $type_report = $report_view['type'];
  
  $type_report = (($type_report == "individual") || ($type_report == "groups")) ? $type_report : "individual";
  $rule_filter = $report_view['type'];
  
 
    $begin_date = $report_view['date_begin'];
   
  $target_date = $report_view['date_target'];
  $plan_filter = $report_view['plan'];
  $organize_method = $report_view['organize_mode'];
  $provider  = $report_view['provider'];
  $pat_prov_rel = $report_view['pat_prov_rel'];
  $dataSheet = json_decode($report_view['data'],TRUE);
 }
else {
  // Collect report type parameter (standard, amc, cqm)
  // Note that need to convert amc_2011 and amc_2014 to amc and cqm_2011 and cqm_2014 to cqm
  // to simplify for when submitting for a new report.
  $type_report = (isset($_GET['type'])) ? trim($_GET['type']) : "individual";
  

  // Collect form parameters (set defaults if empty)
 // if ($type_report == "amc") {
 $begin_date = (isset($_POST['form_begin_date'])) ? trim($_POST['form_begin_date']) : "2015-01-01 00:00:00";
 //   $labs_manual = (isset($_POST['labs_manual_entry'])) ? trim($_POST['labs_manual_entry']) : "0";
 // }
  $target_date = (isset($_POST['form_target_date'])) ? trim($_POST['form_target_date']) : "2015-12-31 23:59:59" ; //date('Y-m-d H:i:s');
  $rule_filter = (isset($_POST['form_rule_filter'])) ? trim($_POST['form_rule_filter']) : "";
  $plan_filter = (isset($_POST['form_plan_filter'])) ? trim($_POST['form_plan_filter']) : "";
  $organize_method = (empty($plan_filter)) ? "default" : "plans";
  $provider  = trim($_POST['form_provider']);
  $pat_prov_rel = (empty($_POST['form_pat_prov_rel'])) ? "primary" : trim($_POST['form_pat_prov_rel']);
}
?>

<html>

<head>
<?php html_header_show();?>

<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">

<?php if ($type_report == "individual") { ?>
  <title><?php echo xlt('Physician Quality Reporting System -- Measures'); ?></title>
<?php } ?>

<?php if ($type_report == "groups") { ?>
  <title><?php echo xlt('Physician Quality Reporting System -- Measure Groups'); ?></title>
<?php } ?>

<?php if ($type_report == "pqrs_individual_2015") { ?>
  <title><?php echo xlt('Physician Quality Reporting System -- Measures -- 2015'); ?></title>
<?php } ?>

<?php if ($type_report == "pqrs_groups_2015") { ?>
  <title><?php echo xlt('Physician Quality Reporting System -- Measure Groups -- 2015'); ?></title>
<?php } ?>

<?php if ($type_report == "pqrs_individual_2016") { ?>
  <title><?php echo xlt('Physician Quality Reporting System -- Measures -- 2016'); ?></title>
<?php } ?>

<?php if ($type_report == "pqrs_groups_2016") { ?>
  <title><?php echo xlt('Physician Quality Reporting System -- Measure Groups -- 2016'); ?></title>
<?php } ?>


<script type="text/javascript" src="../../library/overlib_mini.js"></script>
<script type="text/javascript" src="../../library/textformat.js"></script>
<script type="text/javascript" src="../../library/dialog.js"></script>
<script type="text/javascript" src="../../library/js/jquery.1.3.2.js"></script>

<script LANGUAGE="JavaScript">

 var mypcc = '<?php echo text($GLOBALS['phone_country_code']) ?>';

 $(document).ready(function() {
  var win = top.printLogSetup ? top : opener.top;
  win.printLogSetup(document.getElementById('printbutton'));
 });

 function runReport() {



   // Showing processing wheel
   $("#processing").show();

   // hide Submit buttons
   $("#submit_button").hide();   
   $("#xmla_button").hide();
   $("#xmlb_button").hide();
   $("#xmlc_button").hide();
   $("#print_button").hide();
    $("#genQRDA").hide();

   // hide instructions
   $("#instructions_text").hide();

   // Collect an id string via an ajax request
   top.restoreSession();
   $.get("../../library/ajax/collect_new_report_id.php",
     function(data){
       // Set the report id in page form
       $("#form_new_report_id").attr("value",data);

       // Start collection status checks
       collectStatus($("#form_new_report_id").val());

       // Run the report
       top.restoreSession();
       $.post("../../library/ajax/execute_pqrs_report.php",
         {provider: $("#form_provider").val(),
          type: $("#form_rule_filter").val(),
          date_target: $("#form_target_date").val(),
          date_begin: $("#form_begin_date").val(),
          plan: $("#form_plan_filter").val(),
        //  labs: $("#labs_manual_entry").val(),
          pat_prov_rel: $("#form_pat_prov_rel").val(),
          execute_report_id: $("#form_new_report_id").val()
         });
   });
 }

 function collectStatus(report_id) {
   // Collect the status string via an ajax request and place in DOM at timed intervals
   top.restoreSession();
   // Do not send the skip_timeout_reset parameter, so don't close window before report is done.
   $.post("../../library/ajax/status_report.php",
     {status_report_id: report_id},
     function(data){
       if (data === "PENDING") {
         // Place the pending string in the DOM
         $('#status_span').replaceWith("<span id='status_span'><?php echo xlt("Preparing To Run Report"); ?></span>");
       }
       else if (data === "COMPLETE") {
         // Go into the results page
         top.restoreSession();
         link_report = "pqrs.php?report_id="+report_id;
         window.open(link_report,'_self',false);
         //$("#processing").hide();
         //$('#status_span').replaceWith("<a id='view_button' href='cqm.php?report_id="+report_id+"' class='css_button' onclick='top.restoreSession()'><span><?php echo xlt('View Report'); ?></span></a>");
       }
       else {
         // Place the string in the DOM
         $('#status_span').replaceWith("<span id='status_span'>"+data+"</span>");
       }
   });
   // run status check every 10 seconds
   var repeater = setTimeout("collectStatus("+report_id+")", 10000);
 }
//    Important for XML generation////////////////////////////////////////////////////////////////////////////////////PQRS TEAM NOTE!!!!!
 function GenXml(sNested) {
	  top.restoreSession();
	  //PQRS simple xml export
	  if(sNested === "PQRS"){
		var form_rule_filter = theform.form_rule_filter.value;
		var sLoc = '../../custom/export_pqrs_xml.php?target_date=' + theform.form_target_date.value + '&qrda_version=3&rule_filter=cqm_2014&form_provider='+theform.form_provider.value+"&report_id=<?php echo attr($report_id);?>";
	  }else{
		var sLoc = '../../custom/export_registry_xml.php?&target_date=' + theform.form_target_date.value + '&nested=' + sNested;
	  }
	  dlgopen(sLoc, '_blank', 600, 500);
	  return false;
 }
 
 //QRDA I - 2014 Download
 function downloadQRDA() {
	top.restoreSession();
	var reportID = '<?php echo attr($report_id); ?>';
	var provider = $("#form_provider").val();
	sLoc = '../../custom/download_qrda.php?&report_id=' + reportID + '&provider_id=' + provider;
	dlgopen(sLoc, '_blank', 600, 500);
 }

 function validateForm() {
   <?php if ( (empty($report_id)) && ($type_report == "cqm") ) { ?>
     // If this is a cqm and plan set not set to ignore, then need to ensure consistent with the rules set
     if ($("#form_plan_filter").val() != '') {
       if ($("#form_rule_filter").val() == $("#form_plan_filter").val()) {
         return true;
       } else {
         return false;
       }
     }
     else {
       return true;
     }
   <?php } else { ?>
     return true;
   <?php } ?>
 }
 
 function Form_Validate() {
	 <?php if ( empty($report_id)  ){ ?>	
		 var d = document.forms[0];		 
		 FromDate = d.form_begin_date.value;
		 ToDate = d.form_target_date.value;
		  if ( (FromDate.length > 0) && (ToDate.length > 0) ) {
			 if (FromDate > ToDate){
				  alert("<?php echo xls('End date must be later than Begin date!'); ?>");
				  return false;
			 }
		 }
	<?php } ?>

	//For Results are in Gray Background & disabling anchor links
	<?php if($report_id != ""){?>
	$("#report_results").css("opacity", '0.4');
	$("#report_results").css("filter", 'alpha(opacity=40)');
	$("a").removeAttr("href");
	<?php }?>

	$("#form_refresh").attr("value","true"); 
	runReport();
	return true;
}

</script>

<style type="text/css">

/* specifically include & exclude from printing */
@media print {
    #report_parameters {
        visibility: hidden;
        display: none;
    }
    #report_parameters_daterange {
        visibility: visible;
        display: inline;
    }
    #report_results table {
       margin-top: 0px;
    }
}

/* specifically exclude some from the screen */
@media screen {
    #report_parameters_daterange {
        visibility: hidden;
        display: none;
    }
}

</style>
</head>

<body class="body_top">

<!-- Required for the popup date selectors -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<span class='title'><?php echo xlt('Report'); ?> 

<?php if ($type_report == "individual") { ?>
  <?php echo xlt('Physician Quality Reporting System -- Measures'); ?>
<?php } ?>

<?php if ($type_report == "groups") { ?>
  <?php echo xlt('Physician Quality Reporting System -- Measure Groups'); ?>
<?php } ?>

<?php if ($type_report == "pqrs_standard_2015") { ?>
  <?php echo xlt('Physician Quality Reporting System -- Measures -- 2015'); ?>
<?php } ?>

<?php if ($type_report == "pqrs_groups_2015") { ?>
  <?php echo xlt('Physician Quality Reporting System -- Measure Groups -- 2015'); ?>
<?php } ?>

<?php if ($type_report == "pqrs_standard_2016") { ?>
  <?php echo xlt('Physician Quality Reporting System -- Measures -- 2016'); ?>
<?php } ?>

<?php if ($type_report == "pqrs_groups_2016") { ?>
  <?php echo xlt('Physician Quality Reporting System -- Measure Groups -- 2016'); ?>
<?php } ?>


<?php if (!empty($report_id)) { ?>
  <?php echo " - " . xlt('Date of Report') . ": " . text($date_report);
        //prepare to disable form elements
        $dis_text = " disabled='disabled' ";
  ?>
<?php } ?>
</span>

<form method='post' name='theform' id='theform' action='pqrs.php?type=<?php echo attr($type_report) ;?>' >

<div id="report_parameters">
<?php
	$widthDyn = "470px";
	//if (($type_report == "cqm") || ($type_report == "cqm_2011") || ($type_report == "cqm_2014")) $widthDyn = "410px";
?>
<table>
 <tr>
  <td scope="row" width='<?php echo $widthDyn;?>'>
	<div style='float:left'>

	<table class='text'>


                   <tr>
                      <td class='label'>
                         <?php echo htmlspecialchars( xl('Begin Date'), ENT_NOQUOTES); ?>:
                      </td>
                      <td>
                         <input <?php echo $dis_text; ?> type='text' name='form_begin_date' id="form_begin_date" size='20' value='<?php echo htmlspecialchars( $begin_date, ENT_QUOTES); ?>'
                            onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' title='<?php echo htmlspecialchars( xl('yyyy-mm-dd hh:mm:ss'), ENT_QUOTES); ?>'>
                          <?php if (empty($report_id)) { ?>
                           <img src='../pic/show_calendar.gif' align='absbottom' width='24' height='22'
                            id='img_begin_date' border='0' alt='[?]' style='cursor:pointer'
                            title='<?php echo htmlspecialchars( xl('Click here to choose a date'), ENT_QUOTES); ?>'>
                          <?php } ?>
                      </td>
                   </tr>


                <tr>
                        <td class='label'>
                     
                              <?php echo htmlspecialchars( xl('End Date'), ENT_NOQUOTES); ?>:
                           
                        </td>
                        <td>
                           <input <?php echo $dis_text; ?> type='text' name='form_target_date' id="form_target_date" size='20' value='<?php echo htmlspecialchars( $target_date, ENT_QUOTES); ?>'
                                onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' title='<?php echo htmlspecialchars( xl('yyyy-mm-dd hh:mm:ss'), ENT_QUOTES); ?>'>
                           <?php if (empty($report_id)) { ?>
                             <img src='../pic/show_calendar.gif' align='absbottom' width='24' height='22'
                                id='img_target_date' border='0' alt='[?]' style='cursor:pointer'
                                title='<?php echo htmlspecialchars( xl('Click here to choose a date'), ENT_QUOTES); ?>'>
                           <?php } ?>
                        </td>
                </tr>

        
                    <tr>
                        <td class='label'>
                            <?php echo xlt('Measure Sets'); ?>:
                        </td>
                        <td>
                            <select <?php echo $dis_text; ?> id='form_rule_filter' name='form_rule_filter'>
                            <option value='individual' <?php if ($rule_filter == "individual") echo "selected"; ?>>
                            <?php echo xlt('All 2015 PQRS Individual Measures'); ?></option>
                            <option value='groups' <?php if ($rule_filter == "groups") echo "selected"; ?>>
                            <?php echo xlt('All 2015 PQRS Groups'); ?></option>
                            
                            </select>
                        </td>
                    </tr>
               


           
                    <tr>
                        <td class='label'>
                           <?php echo htmlspecialchars( xl('Measure Group Selection'), ENT_NOQUOTES); ?>:
                        </td>
                        <td>
                                 <select <?php echo $dis_text; ?> id='form_plan_filter' name='form_plan_filter'>
                                 <option value=''>-- <?php echo htmlspecialchars( xl('Ignore'), ENT_NOQUOTES); ?> --</option>
                                 
                                   <option value='individual' <?php if ($plan_filter == "individual") echo "selected"; ?>>
                                   <?php echo htmlspecialchars( xl('All 2015 Individual Measures'), ENT_NOQUOTES); ?></option>
                                   <option value='groups' <?php if ($plan_filter == "groups") echo "selected"; ?>>
                                   <?php echo htmlspecialchars( xl('All 2015 Measure Groups'), ENT_NOQUOTES); ?></option>
                                   <option value='justonegroup' <?php if ($plan_filter == "justonegroup") echo "selected"; ?>>
                                   <?php echo htmlspecialchars( xl('Stub to add selection of just one group'), ENT_NOQUOTES); ?></option>
                                 
                                
                        </td>
                    </tr>
           

                <tr>      
			<td class='label'>
			   <?php echo htmlspecialchars( xl('Provider'), ENT_NOQUOTES); ?>:
			</td>
			<td>
				<?php

				 // Build a drop-down list of providers.
				 //  This is done badly, and may result in non providers being selected

				 $query = "SELECT id, lname, fname FROM users WHERE ".
				  "authorized = 1 $provider_facility_filter ORDER BY lname, fname"; //(CHEMED) facility filter

				 $ures = sqlStatement($query);

				 echo "   <select " . $dis_text . " id='form_provider' name='form_provider'>\n";
				 echo "    <option value=''>-- " . htmlspecialchars( xl('All (Cumulative)'), ENT_NOQUOTES) . " --\n";
/////not sure what this does yet, but may have use for creating multiple files/provider stuff.
                                 echo "    <option value='collate_outer'";
                                 if ($provider == 'collate_outer') echo " selected";
                                 echo ">-- " . htmlspecialchars( xl('All (Collated Format A)'), ENT_NOQUOTES) . " --\n";

                                 echo "    <option value='collate_inner'";
                                 if ($provider == 'collate_inner') echo " selected";
                                 echo ">-- " . htmlspecialchars( xl('All (Collated Format B)'), ENT_NOQUOTES) . " --\n";

				 while ($urow = sqlFetchArray($ures)) {
				  $provid = $urow['id'];
				  echo "    <option value='".htmlspecialchars( $provid, ENT_QUOTES)."'";
				  if ($provid == $provider) echo " selected";
				  echo ">" . htmlspecialchars( $urow['lname'] . ", " . $urow['fname'], ENT_NOQUOTES) . "\n";
				 }

				 echo "   </select>\n";

				?>
                        </td>
		</tr>

                <tr>
                        <td class='label'>
                           <?php echo htmlspecialchars( xl('Provider Relationship'), ENT_NOQUOTES); ?>:
                        </td>
                        <td>
                                <?php

                                 // Build a drop-down list of of patient provider relationships.
                                 //
                                 echo "   <select ". $dis_text ." id='form_pat_prov_rel' name='form_pat_prov_rel' title='" . xlt('Only applicable if a provider or collated list was chosen above. PRIMARY only selects patients that the provider is the primary provider. ENCOUNTER selects all patients that the provider has seen.') . "'>\n";
                                 echo "    <option value='primary'";
                                 if ($pat_prov_rel == 'primary') echo " selected";
                                 echo ">" . xlt('Primary') . "\n";
                                 echo "    <option value='encounter'";
                                 if ($pat_prov_rel == 'encounter') echo " selected";
                                 echo ">" . xlt('Encounter') . "\n";
                                 echo "   </select>\n";
                                ?>
                        </td>
                </tr>



	</table>

	</div>

  </td>
  <td align='left' valign='middle' height="100%">
	<table style='border-left:1px solid; width:100%; height:100%' >
		<tr>
			<td scope="row">

				<div style='margin-left:15px'>

                                    <?php if (empty($report_id)) { ?>
					<a id='submit_button' href='#' class='css_button' onclick='runReport();'>
					<span>
						<?php echo htmlspecialchars( xl('Submit'), ENT_NOQUOTES); ?>
					</span>
					</a>
                                        <span id='status_span'></span>
                                        <div id='processing' style='margin:10px;display:none;'><img src='../pic/ajax-loader.gif'/></div>
					<?php if ($type_report == "individual" || $type_report == "groups") { ?>
						<a id='xmla_button' href='#' class='css_button' onclick='return GenXml("false")'>
							<span>
								<?php echo htmlspecialchars( xl('Generate PQRS report (SimpleXML) 2015'), ENT_NOQUOTES); ?>
							</span>
						</a>
                                        	<a id='xmlb_button' href='#' class='css_button' onclick='return GenXml("true")'>
                                                	<span>
                                                        	<?php echo htmlspecialchars( xl('Stub for additional xml format submissions'), ENT_NOQUOTES); ?>
                                                	</span>
                                        	</a>
					<?php } ?>
                                    <?php } ?>

                                    <?php if (!empty($report_id)) { ?>
					<a href='#' class='css_button' id='printbutton'>
						<span>
							<?php echo htmlspecialchars( xl('Print'), ENT_NOQUOTES); ?>
						</span>
					</a>
                                            <?php if ($type_report == "individual") { ?>
                                                        <a href="#" id="genPQRS" class='css_button' onclick='return downloadQRDA()'>
                                                                <span>
                                                                        <?php echo htmlspecialchars( xl('Generate PQRS 2015 STUB'), ENT_NOQUOTES); ?>
                                                                </span>
                                                        </a>
                                                        <a href="#" id="xmlc_button" class='css_button' onclick='return GenXml("QRDA")'>
                                                                <span>
                                                                        <?php echo htmlspecialchars( xl('Generate PQRS 2016 STUB (GenXml reference)'), ENT_NOQUOTES); ?>
                                                                </span>
                                                        </a>
                                            <?php } ?>

                                            <?php if ($back_link == "list") { ?>
                                               <a href='report_results.php' class='css_button' onclick='top.restoreSession()'><span><?php echo xlt("Return To Report Results"); ?></span></a> 
                                            <?php } else { ?>
                                               <a href='#' class='css_button' onclick='top.restoreSession(); $("#theform").submit();'><span><?php echo xlt("Start Another Report"); ?></span></a>
                                            <?php } ?>
                                    <?php } ?>
				</div>
			</td>
		</tr>
	</table>
  </td>
 </tr>
</table>

</div>  <!-- end of search parameters -->

<br>

<?php
 if (!empty($report_id)) {
?>


<div id="report_results">
<table>

 <thead>
  <th>
   <?php echo htmlspecialchars( xl('Title'), ENT_NOQUOTES); ?>
  </th>

  <th>
   <?php echo htmlspecialchars( xl('Total Patients'), ENT_NOQUOTES); ?>
  </th>

  <th>
  
    <?php echo htmlspecialchars( xl('Denominator'), ENT_NOQUOTES); ?></a>
  

  </th>

  
   <th>
    <?php echo htmlspecialchars( xl('Excluded Patients'), ENT_NOQUOTES); ?></a>
   </th>


  <th>

    <?php echo htmlspecialchars( xl('Passed Patients') . ' (' . xl('Numerator') . ')', ENT_NOQUOTES); ?></a>

  </th>

  <th>

    <?php echo htmlspecialchars( xl('Failed Patients'), ENT_NOQUOTES); ?></a>

  </th>

  <th>
   <?php echo htmlspecialchars( xl('Performance Percentage'), ENT_NOQUOTES); ?></a>
  </th>

 </thead>
 <tbody>  <!-- added for better print-ability -->
<?php

  $firstProviderFlag = TRUE;
  $firstPlanFlag = TRUE;
  $existProvider = FALSE;
  foreach ($dataSheet as $row) {

?>

 <tr bgcolor='<?php echo $bgcolor ?>'>

  <?php
   if (isset($row['is_main']) || isset($row['is_sub'])) {
     echo "<td class='detail'>";
     if (isset($row['is_main'])) {
///////////////////Art note...No idea what I am doing here yet....................the below is very ambiguous
       // is_sub is a special case of is_main whereas total patients, denominator, and excluded patients are taken
       // from is_main prior to it. So, need to store denominator patients from is_main for subsequent is_sub
       // to calculate the number of patients that failed.
       // Note that exlusion in the standard rules is not the same as in the cqm/amd and should not be in calculation
       // as is in the cqm/amc rules.
       $main_pass_filter = $row['pass_filter'];

       echo "<b>".generate_display_field(array('data_type'=>'1','list_id'=>'clinical_rules'),$row['id'])."</b>";

       $tempPqrsString = "";
       if (($type_report == "individual") || ($type_report == "groups")) {
         if (!empty($row['pqrs_code'])) {
           $tempPqrsString .= " " . htmlspecialchars( xl('PQRS') . ":" . $row['pqrs_code'], ENT_NOQUOTES) . " ";
         }
       
       }
    
     

       if (!empty($tempPqrsString)) {
         echo "(".$tempPqrsString.")";
       }

       if ( !(empty($row['concatenated_label'])) ) {
           echo ", " . htmlspecialchars( xl( $row['concatenated_label'] ), ENT_NOQUOTES) . " ";
       }
       
     }
     else { // isset($row['is_sub'])
       echo generate_display_field(array('data_type'=>'1','list_id'=>'rule_action_category'),$row['action_category']);
       echo ": " . generate_display_field(array('data_type'=>'1','list_id'=>'rule_action'),$row['action_item']);
     }
     echo "</td>";
     echo "<td align='center'>" . $row['total_patients'] . "</td>";

     if ( isset($row['itemized_test_id']) && ($row['pass_filter'] > 0) ) {
       echo "<td align='center'><a href='../main/finder/patient_select.php?from_page=pqrs_report&pass_id=all&report_id=".attr($report_id)."&itemized_test_id=".attr($row['itemized_test_id'])."&numerator_label=".urlencode(attr($row['numerator_label']))."' onclick='top.restoreSession()'>" . $row['pass_filter'] . "</a></td>";
     }
     else {
       echo "<td align='center'>" . $row['pass_filter'] . "</td>";
     }

    
       if ( isset($row['itemized_test_id']) && ($row['excluded'] > 0) ) {
         // Note standard reporting exluded is different than cqm/amc and will not support itemization  _art note: and I think pqrs does not either, but leaving in for now
         echo "<td align='center'><a href='../main/finder/patient_select.php?from_page=pqrs_report&pass_id=exclude&report_id=".attr($report_id)."&itemized_test_id=".attr($row['itemized_test_id'])."&numerator_label=".urlencode(attr($row['numerator_label']))."' onclick='top.restoreSession()'>" . $row['excluded'] . "</a></td>";
       }
       else {
         echo "<td align='center'>" . $row['excluded'] . "</td>";
       }
     
////////////////////////////////// _art note: Targets are not implemented in PQRS reports as far as I understand.  May be useful, but direct entry form will do this instead
     if ( isset($row['itemized_test_id']) && ($row['pass_target'] > 0) ) {
       echo "<td align='center'><a href='../main/finder/patient_select.php?from_page=pqrs_report&pass_id=pass&report_id=".attr($report_id)."&itemized_test_id=".attr($row['itemized_test_id'])."&numerator_label=".urlencode(attr($row['numerator_label']))."' onclick='top.restoreSession()'>" . $row['pass_target'] . "</a></td>";
     }
     else {
       echo "<td align='center'>" . $row['pass_target'] . "</td>";
     }

     $failed_items = 0;
     if (isset($row['is_main'])) {   
         // This is assuming excluded is needed in pqrs
         $failed_items = $row['pass_filter'] - $row['pass_target'] - $row['excluded'];
       
     }
     else { // isset($row['is_sub'])
       // Excluded is not part of denominator in standard rules so do not use in calculation....I think I have hosed something up here already trying to figure out which settings are for which report type.
       $failed_items = $main_pass_filter - $row['pass_target'];
     }
     if ( isset($row['itemized_test_id']) && ($failed_items > 0) ) {
       echo "<td align='center'><a href='../main/finder/patient_select.php?from_page=cdr_report&pass_id=fail&report_id=".attr($report_id)."&itemized_test_id=".attr($row['itemized_test_id'])."&numerator_label=".urlencode(attr($row['numerator_label']))."' onclick='top.restoreSession()'>" . $failed_items . "</a></td>";
     }
     else {
       echo "<td align='center'>" . $failed_items . "</td>";
     }

     echo "<td align='center'>" . $row['percentage'] . "</td>";
   }
   else if (isset($row['is_provider'])) {
     // Display the provider information
     if (!$firstProviderFlag && $_POST['form_provider'] == 'collate_outer') {
       echo "<tr><td>&nbsp</td></tr>";
     }
     echo "<td class='detail' align='center'><b>";
     echo htmlspecialchars( xl("Provider").": " . $row['prov_lname'] . "," . $row['prov_fname'], ENT_NOQUOTES);
     if (!empty($row['npi']) || !empty($row['federaltaxid'])) {
       echo " (";
       if (!empty($row['npi'])) {
        echo " " . htmlspecialchars( xl('NPI') . ":" . $row['npi'], ENT_NOQUOTES) . " ";
       }
       if (!empty($row['federaltaxid'])) {
        echo " " . htmlspecialchars( xl('TID') . ":" . $row['federaltaxid'], ENT_NOQUOTES) . " ";
       }
       echo ")";
     }
     echo "</b></td>";
     $firstProviderFlag = FALSE;
     $existProvider = TRUE;
   }
   else { // isset($row['is_plan'])
     if (!$firstPlanFlag && $_POST['form_provider'] != 'collate_outer') {
       echo "<tr><td>&nbsp</td></tr>";
     }
     echo "<td class='detail' align='center'><b>";
     echo htmlspecialchars( xl("Plan"), ENT_NOQUOTES) . ": ";
     echo generate_display_field(array('data_type'=>'1','list_id'=>'clinical_plans'),$row['id']);
     if (!empty($row['pqrs_measure_group'])) {
       echo " (". htmlspecialchars( xl('Measure Group Code') . ": " . $row['pqrs_measure_group'], ENT_NOQUOTES) . ")";
     }
     echo "</b></td>";
     $firstPlanFlag = FALSE;
   }
  ?>
 </tr>

<?php
  }
?>
</tbody>
</table>
</div>  <!-- end of search results -->
<?php } else { ?>
<div id="instructions_text" class='text'>
 	<?php echo htmlspecialchars( xl('Please input search criteria above, and click Submit to start report.'), ENT_NOQUOTES); ?>
</div>
<?php } ?>

<input type='hidden' name='form_new_report_id' id='form_new_report_id' value=''/>

</form>

</body>

<!-- stuff for the popup calendar -->
<style type="text/css">@import url(../../library/dynarch_calendar.css);</style>
<script type="text/javascript" src="../../library/dynarch_calendar.js"></script>
<?php include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php"); ?>
<script type="text/javascript" src="../../library/dynarch_calendar_setup.js"></script>
<script language="Javascript">
 <?php if ($type_report == "individual" || $type_report == "groups") { ?>
  Calendar.setup({inputField:"form_begin_date", ifFormat:"%Y-%m-%d %H:%M:%S", button:"img_begin_date", showsTime:'true'});
 <?php } ?>
 Calendar.setup({inputField:"form_target_date", ifFormat:"%Y-%m-%d %H:%M:%S", button:"img_target_date", showsTime:'true'});
</script>

</html>

