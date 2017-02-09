<?php
/**
 * Patient selector screen.
 *
 * LICENSE: This shit is ours.
 *
 * @package PQRS_Gateway
 * @author  Bryan Lee <leebc11@acm.org>
 * @link    http://suncoastconnection.com
 */

//SANITIZE ALL ESCAPES
$sanitize_all_escapes=true;
//

//STOP FAKE REGISTER GLOBALS
$fake_register_globals=false;
//

require_once("../../globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/report_database.inc");

$fstart = isset($_REQUEST['fstart']) ? $_REQUEST['fstart'] : 0;
$message = isset($_GET['message']) ? $_GET['message'] : "";
$from_page = isset($_REQUEST['from_page']) ? $_REQUEST['from_page'] : "";

?>

<html>
<head>
<?php html_header_show();?>

<link rel=stylesheet href="<?php echo $css_header;?>" type="text/css">
<style>
form {
    padding: 0px;
    margin: 0px;
}
#searchCriteria {
    text-align: center;
    width: 100%;
    font-size: 0.8em;
    background-color: #ddddff;
    font-weight: bold;
    padding: 3px;
}
#searchResultsHeader { 
    width: 100%;
    background-color: lightgrey;
}
#searchResultsHeader table { 
    width: 96%;  /* not 100% because the 'searchResults' table has a scrollbar */
    border-collapse: collapse;
}
#searchResultsHeader th {
    font-size: 0.7em;
}
#searchResults {
    width: 100%;
    height: 60%;
    overflow: auto;


.srName { width: 12%; }
.srGender { width: 5%; }
.srPhone { width: 11%; }
.srSS { width: 11%; }
.srDOB { width: 8%; }
.srID { width: 7%; }
.srPID { width: 7%; }
.srNumEnc { width: 11%; }
.srNumDays { width: 11%; }
.srDateLast { width: 11%; }
.srDateNext { width: 11%; }
.srMisc { width: 10%; }
.srAnswer { 
    text-align: center;}
.srUpdate { 
    width: 1%; 
    text-align: right;}

#searchResults table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
}
#searchResults tr {
    cursor: hand;
    cursor: pointer;
}
#searchResults td {
    font-size: 0.7em;
    border-bottom: 1px solid #eee;
}
.oneResult { }
.billing { color: red; font-weight: bold; }
.highlight { 
    background-color: #336699;
    color: white;
}
.reminder { color: blue; font-weight: bold; }
</style>

<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery-1.2.2.min.js"></script>



<script language="JavaScript">

// This is called when forward or backward paging is done.
//
function submitList(offset) {
 var f = document.forms[0];
 var i = parseInt(f.fstart.value) + offset;
 if (i < 0) i = 0;
 f.fstart.value = i;
 top.restoreSession();
 f.submit();
}

</script>

</head>
<body class="body_top">

<form method='post' action='patient_select.php' name='theform' onsubmit='return top.restoreSession()'>
<input type='hidden' name='fstart'  value='<?php echo htmlspecialchars( $fstart, ENT_QUOTES); ?>' />

<?php
$MAXSHOW = 200; // maximum number of results to display at once

//the maximum number of patient records to display:
$sqllimit = $MAXSHOW;
$given = "*, DATE_FORMAT(DOB,'%m/%d/%Y') as DOB_TS";
$orderby = "lname ASC, fname ASC";

//$search_service_code = trim($_POST['search_service_code']);
//echo "<input type='hidden' name='search_service_code' value='" .
 // htmlspecialchars($search_service_code, ENT_QUOTES) . "' />\n";


  // Collect setting from pqrs report
  echo "<input type='hidden' name='from_page' value='$from_page' />\n";
  $report_id = isset($_REQUEST['report_id']) ? $_REQUEST['report_id'] : 0;
  echo "<input type='hidden' name='report_id' value='".$report_id."' />\n";
  $itemized_test_id = isset($_REQUEST['itemized_test_id']) ? $_REQUEST['itemized_test_id'] : 0;
  echo "<input type='hidden' name='itemized_test_id' value='".$itemized_test_id."' />\n";
  $numerator_label = isset($_REQUEST['numerator_label']) ? $_REQUEST['numerator_label'] : '';
  echo "<input type='hidden' name='numerator_label' value='".$numerator_label."' />\n";
  $pass_id = isset($_REQUEST['pass_id']) ? $_REQUEST['pass_id'] : "all";
  echo "<input type='hidden' name='pass_id' value='".$pass_id."' />\n";
  $print_patients = isset($_REQUEST['print_patients'])? $_REQUEST['print_patients'] : 0;
  echo "<input type='hidden' name='print_patients' value='".$print_patients."' />\n";

  // Collect patient listing from pqrs report
  if ($print_patients) {
    // collect entire listing for printing
    $result = collectItemizedPatientsCdrReport($report_id,$itemized_test_id,$pass_id,$numerator_label);
    $GLOBALS['PATIENT_INC_COUNT'] = count($result);
    $MAXSHOW = $GLOBALS['PATIENT_INC_COUNT'];
  }
  else {
    // collect the total listing count
    $GLOBALS['PATIENT_INC_COUNT'] = collectItemizedPatientsCdrReport($report_id,$itemized_test_id,$pass_id,$numerator_label,true);
    // then just collect applicable list for pagination
    $result = collectItemizedPatientsCdrReport($report_id,$itemized_test_id,$pass_id,$numerator_label,false,$sqllimit,$fstart);
  }


?>

</form>

<table border='0' cellpadding='5' cellspacing='0' width='100%'>
 <tr>
  <td class='text'>
   <a href='../../reports/clinical_measures.php?report_id=<?php echo attr($report_id) ?>' class='css_button' onclick='top.restoreSession()'>
   <span><?php echo xlt("Return To Report Results"); ?></span></a>
  </td>
  <td class='text' align='center'>
<?php if ($message) echo "<font color='red'><b>".htmlspecialchars( $message, ENT_NOQUOTES)."</b></font>\n"; ?>
  </td>
  <td>
   <?php 
     echo "<a href='patient_select.php?from_page=pqrs_report&pass_id=".attr($pass_id).
     "&report_id=".attr($report_id)."&itemized_test_id=".attr($itemized_test_id).
     "&numerator_label=".urlencode(attr($row['numerator_label'])).
     "&print_patients=1' class='css_button' onclick='top.restoreSession()'><span>".
     xlt("Print Entire Listing")."</span></a>";
     ?> &nbsp;
  </td>
  <td class='text' align='right'>
<?php
$count = $GLOBALS['PATIENT_INC_COUNT'];
$fend = $fstart + $MAXSHOW;
if ($fend > $count) $fend = $count;
?>
<?php if ($fstart) { ?>
   <a href="javascript:submitList(-<?php echo $MAXSHOW ?>)">
    &lt;&lt;
   </a>
   &nbsp;&nbsp;
<?php } ?>
   <?php echo ($fstart + 1) . htmlspecialchars( " - $fend of $count", ENT_NOQUOTES); ?>
<?php if ($count > $fend) { ?>
   &nbsp;&nbsp;
   <a href="javascript:submitList(<?php echo $MAXSHOW ?>)">
    &gt;&gt;
   </a>
<?php } ?>
  </td>
 </tr>
 <tr>
   <?php 
     echo "<td colspan='6' class='text'>";
     echo "<b>";
     if ($pass_id == "fail") {
       echo xlt("Failed Patients");
     }
     else if ($pass_id == "pass") {
       echo xlt("Passed Patients");
     }
     else if ($pass_id == "exclude") {
       echo xlt("Excluded Patients");
     }
     else { // $pass_id == "all"
       echo xlt("All Patients");
     }
     echo "</b>";
     echo " - ";
     echo collectItemizedRuleDisplayTitle($report_id,$itemized_test_id,$numerator_label);
     echo "</td>";
    ?>
 </tr>
</table>


<?php 
//  Start here.
	// echo "report_id:", $report_id, ", itemized_test_id:", $itemized_test_id , ", Patients in the ", $numerator_label, "<br>";
	// echo "That thing:  ", collectItemizedRuleDisplayTitle($report_id,$itemized_test_id,$numerator_label), "<br>";
	$report_view = collectReportDatabase($report_id);
	$type_report = $report_view['type'];
	$report_year = end(explode('_', $type_report));
	$dataSheet = json_decode($report_view['data'],TRUE);
	foreach ($dataSheet as $row) {
      		if ( ($row['itemized_test_id'] == $itemized_test_id) && ($row['numerator_label'] == $numerator_label) ) {
			$measure_number = text($row['pqrs_code']) ;
		}
	}

// Query or search the measure specific information to find number of answers
        $query = "SELECT value AS value FROM pqrs_direct_entry_lookup WHERE ".
                "measure_number = '$measure_number' AND type = 'description'";
        $pqrs_result = SqlFetchArray(sqlStatement($query));
	$measure_description=implode(" ",$pqrs_result);

        $query = "SELECT value AS value FROM pqrs_direct_entry_lookup WHERE ".
                "measure_number = '$measure_number' AND type = 'question'";
        $pqrs_result = SqlFetchArray(sqlStatement($query));
	$measure_question=implode(" ",$pqrs_result);

        $query = "SELECT COUNT(*) AS count FROM pqrs_direct_entry_lookup WHERE".
                " measure_number = '$measure_number' AND type = 'answer'";
        $pqrs_result = SqlFetchArray(sqlStatement($query));

//error_log("***** DEBUG *****  patient_select() -- Queried p_d_e_l with \"".$query."\" and got pqrs_result \"".implode(" ",$pqrs_result)."\"" );


	$number_answers_of_measure = implode(" ",$pqrs_result);
//error_log("***** DEBUG *****  patient_select() -- number_answers_of_measure=\"".$number_answers_of_measure."\"  $from_page=\"".$from_page);

	echo "<b>Report Year:</b> ".$report_year."<br>";
	echo "<b>Measure Number:</b>".$measure_number ."<br>";
	echo "<p>";
	echo "<b>Description:</b>  ".$measure_description."<br>";
	echo "<p>";
        echo "<b>Measure Criteria:</b> ".$measure_question."</b><br>";
	echo "<p>";
 ?>

<div id="searchResultsHeader">

	☺ <span class="reminder"> Reminder: You MUST run a new report to see your changes</span>  ☺ <p>

	<table>
	<tr>
	<th class="srName"><?php echo htmlspecialchars( xl('Name'), ENT_NOQUOTES);?></th>
	<th class="srGender"><?php echo htmlspecialchars( xl('Sex'), ENT_NOQUOTES);?></th>
	<th class="srDOB"><?php echo htmlspecialchars( xl('DOB'), ENT_NOQUOTES);?></th>

	<?php if (empty($GLOBALS['patient_search_results_style'])) { ?>
	<?php
		$add_days = 90;
		if ( preg_match('/^(\d+)\s*(.*)/',$patient,$matches) > 0) {
  			$add_days = $matches[1];
  			$patient = $matches[2];
			}
		}
		else {
  // Alternate patient search results style; this gets address plus other
  // fields that are mandatory, up to a limit of 5.
// -- leebc doesn't know if we need this, but errors if I removed it 2016-06-16
  		$extracols = array();
 $tres = sqlStatement("SELECT * FROM layout_options " .
    "WHERE form_id = 'DEM' AND ( uor > 1 AND field_id != '' " .
    "OR uor > 0 AND field_id = 'street' ) AND " .
    "field_id NOT LIKE '_name' AND " .
    "field_id NOT LIKE 'phone%' AND " .
    "field_id NOT LIKE 'title' AND " .
    "field_id NOT LIKE 'ss' AND " .
    "field_id NOT LIKE 'DOB' AND " .
    "field_id NOT LIKE 'pubpid' " .
    "ORDER BY group_name, seq LIMIT 5");
  		while ($trow = sqlFetchArray($tres)) {
    			$extracols[$trow['field_id']] = $trow;
    			echo "<th class='srMisc'>" . htmlspecialchars(xl($trow['title']), ENT_NOQUOTES) . "</th>\n";
  			}
		}
	$query = "SELECT value FROM pqrs_direct_entry_lookup WHERE ".
		"measure_number = '$measure_number' ".
		"AND type = 'answer'";
        $pqrs_result = sqlStatement($query);
//error_log("***** DEBUG *****  patient_select() -- Queried p_d_e_l with \"".$query."\" and got pqrs_result \"".$pqrs_result."\"" );
	// Need to loop and write "short answer" for each answer here
	for ($i = 1; $i <= $number_answers_of_measure; $i++) { 
	 ?>
		<th class="srAnswer"><?php echo htmlspecialchars( xl('Answer'), ENT_NOQUOTES) . " $i" ;?></th>
	<?php } ?>

	<th class="srUpdate">Update</th>	
	</tr>
	</table>

</div>

<div id="searchResults">

<table>
<tr>
<?php
if ($result) {
    foreach ($result as $iter) {
	$row_pid=$iter['pid'];
		// Check whether this is a Medicare Patient
		$mc_query="SELECT COUNT(p.pid) AS count ".
			" FROM patient_data p ".
			" JOIN insurance_data i on (i.pid=p.pid) ".
			" JOIN insurance_companies c on (c.id = i.provider) ".
			" WHERE c.freeb_type = 2 ".
			" AND p.pid = ? ;";
		$mc_result=sqlFetchArray(sqlStatement($mc_query, array($iter{"pid"}) ));
		if ($mc_result['count'] > 0){
			$medicare_flag=$GLOBALS['webroot']."/images/CMS_logo0.png";}
		else {
			$medicare_flag="";}

        	echo "		<tr>
	<td>
		<table id='".htmlspecialchars( $iter['pid'], ENT_QUOTES)."'>\n		<tr>\n";
		echo  "			<td class='oneresult srName' style=background-image:url(" . $medicare_flag . ");background-repeat:no-repeat;text-align:center; >" . htmlspecialchars($iter['lname'] . ", " . $iter['fname']) . "</td>\n";
        	echo  "			<td class='oneresult srGender'>" . text(getListItemTitle("sex",$iter['sex'])) . "</td>\n";
        	if ($iter{"DOB"} != "0000-00-00 00:00:00") {
            	echo "			<td class='oneresult srDOB'>" . htmlspecialchars( $iter['DOB_TS'], ENT_NOQUOTES) . "</td>\n";
        	} else {
            		echo "			<td class='srDOB'>&nbsp;</td>";
        	}
        foreach ( $pqrs_result as $thisAnswer ) {
//error_log("***** DEBUG *****  foreach1--thisAnswer=\"".$thisAnswer['value']."\"");
		$explodedAnswer=explode("|", $thisAnswer['value']);
		$myOrder=$explodedAnswer[0];
		$myDesc=$explodedAnswer[1];
		$myCode=$explodedAnswer[2];
// error_log("***** DEBUG *****  foreach: $myOrder  |  $myDesc  |  $myCode" );
        	echo "<td class='srAnswer'><label><input type=\"radio\" name=\"pidi".htmlspecialchars( $iter['pid'] )." \"  value=\"$myCode\">$myDesc</label></td>";
	}
		?>
        	<td class='srAnswer'><button type="button" onclick="updatePatient(<?php echo htmlspecialchars( $iter['pid'] ) ?>)">Update</button></td>
	</table>
        <?php
	 
    }  // End foreach
}  // end if $result
?>
</table>
</div>  <!-- end searchResults DIV -->


<table border='0' cellpadding='5' cellspacing='0' width='100%'>
 <tr>
  <td class='text'>
   <a href='../../reports/clinical_measures.php?report_id=<?php echo attr($report_id) ?>' class='css_button' onclick='top.restoreSession()'>
   <span>
   <?php echo xlt("Return To Report Results"); ?>
   </span></a>
  </td>
  <td class='text' align='center'>
<?php if ($message) echo "<font color='red'><b>".htmlspecialchars( $message, ENT_NOQUOTES)."</b></font>\n"; ?>
  </td>
  <td class='text' align='right'>
<?php

$count = $GLOBALS['PATIENT_INC_COUNT'];
$fend = $fstart + $MAXSHOW;
if ($fend > $count) $fend = $count;
?>
<?php if ($fstart) { ?>
   <a href="javascript:submitList(-<?php echo $MAXSHOW ?>)">
    &lt;&lt;
   </a>
   &nbsp;&nbsp;
<?php } ?>
   <?php echo ($fstart + 1) . htmlspecialchars( " - $fend of $count", ENT_NOQUOTES); ?>
<?php if ($count > $fend) { ?>
   &nbsp;&nbsp;
   <a href="javascript:submitList(<?php echo $MAXSHOW ?>)">
    &gt;&gt;
   </a>
<?php } ?>
  </td>
 </tr>
</table>


<script language="javascript">

// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    // $("#searchparm").focus();
    $(".oneresult").mouseover(function() { $(this).addClass("highlight"); });
    $(".oneresult").mouseout(function() { $(this).removeClass("highlight"); });
    $(".oneresult").click(function() { SelectPatient(this.parentNode.parentNode.parentNode); });
    // $(".event").dblclick(function() { EditEvent(this); });
    <?php if($print_patients) { ?>
      var win = top.printLogPrint ? top : opener.top;
      win.printLogPrint(window);
    <?php } ?>
});

var SelectPatient = function (eObj) {
<?php 
// For the old layout we load a frameset that also sets up the new pid.
// The new layout loads just the demographics frame here, which in turn
// will set the pid and load all the other frames.
if ($GLOBALS['concurrent_layout']) {
    $newPage = "../../patient_file/summary/demographics.php?set_pid=";
    $target = "document";
}
else {
    $newPage = "../../patient_file/patient_file.php?set_pid=";
    $target = "top";
}
?>
    var tableId = eObj.id;
    <?php echo "top.restoreSession();\n"; ?>
    return true;
}

<?php 
	echo "function updatePatient(pid) {\n";
	echo "	selected = $('table[id=' + pid + '] input[type=\'radio\']:checked');\n";
	echo "	if(selected.length > 0) {\n";
	echo "		var date = '".$report_year."1231235959';\n";
	echo "		var code = selected.val();\n\n";
	echo "		console.log('PID: ' + pid + ', Date: ' + date + ', Code: ' + code);\n\n";
	echo "		$.ajax({\n";
	echo "			type: 'POST',\n";
	echo "			url: '".$GLOBALS['webroot']."/library/classes/rulesets/PQRS/PQRSEncounter.php',\n";
	echo "			dataType: 'text',\n";
	echo "			data: {\n";
	echo "				pid: pid,\n";
	echo "				date: date,\n";
	echo "				CPT2codevalue: code\n";
	echo "			},\n";
	echo "			success: function(data, status, xHR) {\n";
	echo "				if(data == 'SUCCESS') {\n";
	echo "					$('table[id=' + pid + ']').parent().parent().slideUp();\n";
	echo "					console.log('Update succeeded.  Hiding patient row.');\n";
	echo "				} else {\n";
	echo "					console.log('Update failed: '+ data);\n";
	echo "				}\n";
	echo "			},\n";
	echo "			error: function(xHR, status, error) {\n";
	echo "				console.log('Status: ' + status + ', Error: ' + error);\n";
	echo "			},\n";
	echo "		});\n";
	echo "	} else {\n";
	echo "		alert('Answer not selected.  Please select an answer before attempting to \'Update\'.')\n";
	echo "	}\n";
	echo "}  // end updatePatient()\n";

?>

		</script>
	</body>
</html>
