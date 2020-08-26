<?php
//by Art Eaton
include_once("../../globals.php");
include_once($GLOBALS["srcdir"]."/api.inc");
function cpn_report( $pid, $encounter, $cols, $id) {
$count = 0;
$obj = formFetch("form_cpn", $id);
?>

<span class="title"><center><b>Counseling Progress Note</b></center></span>
<br></br>

<?php $res = sqlStatement("SELECT date FROM form_encounter WHERE encounter = $encounter");
$encounterdata_array = SqlFetchArray($res); 
$res = sqlStatement("SELECT fname,mname,lname FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>
<b>Client:</b>&nbsp;&nbsp; <?php echo htmlspecialchars(stripslashes($result['fname'])) . '&nbsp' . htmlspecialchars(stripslashes($result['mname'])) . '&nbsp;' . htmlspecialchars(stripslashes($result['lname']));?>
<br>
<b>Related Diagnosis:</b>&nbsp;&nbsp;<?php echo stripslashes($obj{"dx"});?>
<BR>
<?php echo "Date of Service:&nbsp;&nbsp;".date("Y-m-d",strtotime($encounterdata_array['date'])).
 "&nbsp;&nbsp;For Service Type:&nbsp;&nbsp;";
 IF ($obj{"tx"}=="Other"){
    echo stripslashes($obj{"tx2"});
}else{
    echo stripslashes($obj{"tx"});
}
?>
<BR>

<b>Location:</b>&nbsp;<?php echo stripslashes($obj{"location"});?>
<BR>
<b>Start Time:</b>&nbsp;<?php echo stripslashes($obj{"data1"});?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>End Time:</b>&nbsp;<?php echo stripslashes($obj{"data2"});?>
<br><br>

<b><u>Participants:  </u></b><br>
<?php echo stripslashes($obj{"data3"});?>
<br><br>

<b><u>Contacts Since Last Session:</u></b><br>
<?php echo stripslashes($obj{"data4"});?>
<br><br>

<b><u>Treatment Goals/Objectives Addressed:</u></b><br>
<?php echo stripslashes($obj{"data5"});?>
<br><br>

<b><u>Therapeutic Interventions:</u></b><br>
<?php echo stripslashes($obj{"data6"});?>
<br><br>

<b><u>Session Focus:</u></b><br>
<?php echo stripslashes($obj{"data7"});?>
<br><br>

<b>Assessment/Response of Client:</b><br>
 <?php 
 if ($obj{"data8"} == "on") {echo "<b>Engaging</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if ($obj{"data9"} == "on") {echo "<b>Withdrawn</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if ($obj{"data10"} == "on") {echo "<b>Cooperative</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if ($obj{"data11"} == "on") {echo "<b>Defiant</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if ($obj{"data12"} == "on") {echo "<b>Flat Affect</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if ($obj{"data13"} == "on") {echo "<b>Anxious/Fearful</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if ($obj{"data14"} == "on") {echo "<b>Happy</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data15"} == "on") {echo "<b>Sad</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data16"} == "on") {echo "<b>Angry</b>";}
 if ($obj{"data16"} == "on") {echo "<BR>Assessment Notes:&nbsp;&nbsp;".stripslashes($obj{"assessment_notes"});}
 ?>
<br>
<br>

<b><u>Progress Toward Treatment Goals:</u></b><br>
<?php echo stripslashes($obj{"data17"});?>
<br><br>

<b>Risk Assessment:&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo stripslashes($obj{"data18"});?>
<br><br>


<b>Risk Factors:</b>
<?php if ($obj{"data19"} == "on") {echo "Hx of Tx Non-Compliance&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data20"} == "on") {echo "Hx/Px of Elopement&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data21"} == "on") {echo "Hx of Multiple Dx&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data22"} == "on") {echo "Prior Inpatient Treatment&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data23"} == "on") {echo "Prior Homicide or Suicide Attempt&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data24"} == "on") {echo "Self Injurious&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data25"} == "on") {echo "Current Suicide Ideation&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data26"} == "on") {echo "Imminent Risk of Harm to Self&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data27"} == "on") {echo "Threats to Harm Others&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data28"} == "on") {echo "Aggression&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data29"} == "on") {echo "Current Homicidal Ideation&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data30"} == "on") {echo "Imminent Risk of Harm to Others&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data31"} == "on") {echo "Sexual Acting Out&nbsp;&nbsp;&nbsp;&nbsp;";}
 if ($obj{"data32"} == "on") {echo "Other Risks Noted&nbsp;&nbsp;&nbsp;&nbsp;";}?>
 

<br><br>

<b><u>Risk Management</u></b><br>
<?php echo stripslashes($obj{"data33"});?><br><br>




<b>Plan: </b><br>
<?php echo stripslashes($obj{"data34"});?>
<br><br>

Next Planned Appointment Date : <?php echo stripslashes($obj{"data35"});?>&nbsp;&nbsp; Start Time : <?php echo stripslashes($obj{"data36"});?>&nbsp;&nbsp;End Time : <?php echo stripslashes($obj{"data37"});?> <br>
Appointment status should be checked in the calendar.

<br><br>
<b>Digital Signature:</b>&nbsp; <?php echo $providerNameRes;
}?>
