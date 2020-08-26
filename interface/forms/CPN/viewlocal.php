
<?php
//by Art Eaton
include_once("../../globals.php");
include_once("$srcdir/api.inc");
formHeader("Form: CPN");
?>

  <style>
 
#ros {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
    background: #f5f5f5;
}

#ros td, #ros th {
    font-size: 1em;
    padding: 3px 0 2px 7px;
}

#ros th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
    background-color: #eeeeee;
    color: black;    
}

#ros tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}

.checkbox-button {
  margin: 1pt 1pt 2pt 1pt;
  padding:0;
  display: inline-block;
}
.checkbox-button input[type=checkbox] {
	display: none;
}
.checkbox-button label {
	text-size: 16pt;
	background-color: #cccccc;
  background: linear-gradient(to bottom, #eeeeee 0%, #cccccc 100%);
  color: #333333;
  border: 1px solid #333333;
  border-radius: 4px;
  margin: 1pt;
 	padding: 0 3pt 0 3pt;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.15);
}
.checkbox-button input[type=checkbox]:checked + label {
 	color: #eeeeee;
  background: linear-gradient(to bottom, #cc1100 0%, #E42F02 100%);
  font-weight: bold;
  padding: 0 1.8pt 1.8pt;
  box-shadow: none;
}

label {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
} 

  </style>



<?php
$obj = formFetch("form_cpn", $_GET["id"]);
?>

<form method=post action="<?php echo $rootdir?>/forms/CPN/save.php?mode=update&id=<?php echo $_GET["id"];?>" name="my_form">
<span class="title"><center>Counseling Progress Note</center></span><br><br>


<?php $res = sqlStatement("SELECT date FROM form_encounter WHERE encounter = $encounter");
$encounterdata_array = SqlFetchArray($res); ?>

<?php $res = sqlStatement("SELECT fname,mname,lname FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>


<b><u>Client and Service Information For:</u></b>&nbsp;&nbsp; <?php echo $result['fname'] . '&nbsp' . $result['mname'] . '&nbsp;' . $result['lname'];?>

<br><br>
<label for="dx">Related Diagnosis:</label>
<input type="text" id="dx" name="dx" value="<?php echo stripslashes($obj{"dx"});?>">
<br>

<label for="tx">Services:</label>
<select name="tx" size="1">
<option value="H2019:HR"<?php if ($obj{'tx'} == 'H2019:HR') { echo'selected="selected"'; } ?>>H2019 HR Individual/family</option>
<option value="H2019:HO"<?php if ($obj{'tx'} == 'H2019:HO') { echo'selected="selected"'; } ?>>H2019 HO Therapeutic Behavioral On site</option>
<option value="Other"<?php if ($obj{'tx'} == 'Other') { echo'selected="selected"'; } ?>>Other</option>
</select>
&nbsp;&nbsp;&nbsp;
<label for="tx2">Other:</label>
<input type="text" id="tx2" name="tx2" value="<?php echo stripslashes($obj{"tx2"});?>"> 
<br>
<label for="location">Location:</label>
<input type="text" id="location" name="location" value="<?php echo stripslashes($obj{"location"});?>">

<br><br>
<?php echo "Date of Service: ". '&nbsp' .date("Y-m-d",strtotime($encounterdata_array['date']))  ;?>
&nbsp;&nbsp;&nbsp;       
<b>Start Time:</b>&nbsp;<input type="time" name='data1' value="<?php echo stripslashes($obj{"data1"});?>">
&nbsp;&nbsp;&nbsp;
<b>End Time:</b>&nbsp;<input type="time" name='data2'value="<?php echo stripslashes($obj{"data2"});?>">
<br><br>

<b><u>Participants:  </u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data3" ><?php echo stripslashes($obj{"data3"});?></textarea>
<br><br>

<b><u>Contacts Since Last Session:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data4" ><?php echo stripslashes($obj{"data4"});?></textarea>
<br><br>

<b><u>Treatment Goals/Objectives Addressed:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data5" ><?php echo stripslashes($obj{"data5"});?></textarea>
<br><br>

<b><u>Therapeutic Interventions:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data6" ><?php echo stripslashes($obj{"data6"});?></textarea>
<br><br>

<b><u>Session Focus:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data7" ><?php echo stripslashes($obj{"data7"});?></textarea>
<br><br>


<table id='ar'>

	<TR class="alt">
	<TD>
	<B>Assessment/Response of Client:</b>
	</TD>
	</tr>
	<tr>
	<TD>
  
		<span class="checkbox-button">
			<input id="data8" name="data8" type="checkbox" value="on"  <?php if ($obj{"data8"} == "on") {echo "checked";};?>>
			<label for="data8" > Engaging </label>
		</span>

		<span class="checkbox-button">
			<input id="data9" name="data9" type="checkbox" value="on"  <?php if ($obj{"data9"} == "on") {echo "checked";};?>>
			<label for="data9"> Withdrawn </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data10" name="data10" type="checkbox" value="on"  <?php if ($obj{"data10"} == "on") {echo "checked";};?>>
			<label for="data10"> Cooperative </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data11" name="data11" type="checkbox" value="on"  <?php if ($obj{"data11"} == "on") {echo "checked";};?>>
			<label for="data11"> Defiant </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data12" name="data12" type="checkbox" value="on"  <?php if ($obj{"data12"} == "on") {echo "checked";};?>>
			<label for="data12"> Flat Affect </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data13" name="data13" type="checkbox" value="on"  <?php if ($obj{"data13"} == "on") {echo "checked";};?>>
			<label for="data13"> Anxious/Fearful </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data14" name="data14" type="checkbox" value="on"  <?php if ($obj{"data14"} == "on") {echo "checked";};?>>
			<label for="data14"> Happy </label>
		</span>

		<span class="checkbox-button">
			<input id="data15" name="data15" type="checkbox" value="on"  <?php if ($obj{"data15"} == "on") {echo "checked";};?>>
			<label for="data15"> Sad </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="data16" name="data16" type="checkbox" value="on"  <?php if ($obj{"data16"} == "on") {echo "checked";};?>>
			<label for="data16"> Angry </label>
		</span>
		</TD>
		</tr>
		<TR>
		<TD>
		<BR>
		Assessment Notes: <BR>
					<TEXTAREA NAME="assessment_notes" ROWS=3 COLS=25 WRAP=SOFT STYLE="width: 2in; height: 0.21in"><?php echo stripslashes($obj{"assessment_notes"});?></TEXTAREA></FONT>
					</TD>
	</TR>	
</table>


<br><br>

<b><u>Progress Toward Treatment Goals:</u></b><br>
<i>including strengths/limitations that impacted achievement</i><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data17" ><?php echo stripslashes($obj{"data17"});?></textarea>
<br><br>


<b>Risk Assessment:</b>&nbsp;&nbsp;
<i>Based on the following risk factor:</i><br>
<select name="data18" size="3">
<option value="No Noted or Observed Risk"<?php if ($obj{'data18'} == 'No Noted or Observed Risk') { echo'selected="selected"'; } ?>>None Noted</option>
<option value="Low Risk"<?php if ($obj{'data18'} == 'Low Risk') { echo'selected="selected"'; } ?>>Low Risk</option>
<option value="Moderate Risk"<?php if ($obj{'data18'} == 'Moderate Risk') { echo'selected="selected"'; } ?>>Moderate Risk</option>
<option value="High Risk"<?php if ($obj{'data18'} == 'High Risk') { echo'selected="selected"'; } ?>>High Risk</option>
<option value="Very High Risk"<?php if ($obj{'data18'} == 'Very High Risk') { echo'selected="selected"'; } ?>>Very High Risk</option>
</select>
<br><br>




	<table id='rf'>
	<TR class="alt">
	<TD>
	<B>Risk Factors:</b>
	</TD>
	</tr>
	<tr>
	<TD>
  
		<span class="checkbox-button">
			<input id="data19" name="data19" type="checkbox" value="on" <?php if ($obj{"data19"} == "on") {echo "checked";};?>>
			<label for="data19" > Hx of Tx Non-Compliance </label>
		</span>

		<span class="checkbox-button">
			<input id="data20" name="data20" type="checkbox" value="on" <?php if ($obj{"data20"} == "on") {echo "checked";};?>>
			<label for="data20"> Hx/Px of Elopement </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data21" name="data21" type="checkbox" value="on"  <?php if ($obj{"data21"} == "on") {echo "checked";};?>>
			<label for="data21"> Hx of Multiple Dx </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data22" name="data22" type="checkbox" value="on"  <?php if ($obj{"data22"} == "on") {echo "checked";};?>>
			<label for="data22"> Prior Inpatient Treatment </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data23" name="data23" type="checkbox" value="on"  <?php if ($obj{"data23"} == "on") {echo "checked";};?>>
			<label for="data23"> Prior Homicide or Suicide Attempt </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data24" name="data24" type="checkbox" value="on"  <?php if ($obj{"data24"} == "on") {echo "checked";};?>>
			<label for="data24"> Self Injurious </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data25" name="data25" type="checkbox" value="on"  <?php if ($obj{"data25"} == "on") {echo "checked";};?>>
			<label for="data25"> Current Suicide Ideation </label>
		</span>

		<span class="checkbox-button">
			<input id="data26" name="data26" type="checkbox" value="on"  <?php if ($obj{"data26"} == "on") {echo "checked";};?>>
			<label for="data26"> Imminent Risk of Harm to Self </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="data27" name="data27" type="checkbox" value="on"  <?php if ($obj{"data27"} == "on") {echo "checked";};?>>
			<label for="data27"> Threats to Harm Others </label>
		</span>
		<span class="checkbox-button">
			<input id="data28" name="data28" type="checkbox" value="on"  <?php if ($obj{"data28"} == "on") {echo "checked";};?>>
			<label for="data28"> Aggression </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data29" name="data29" type="checkbox" value="on"  <?php if ($obj{"data29"} == "on") {echo "checked";};?>>
			<label for="data29"> Current Homicidal Ideation </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data30" name="data30" type="checkbox" value="on"  <?php if ($obj{"data30"} == "on") {echo "checked";};?>>
			<label for="data30"> Imminent Risk of Harm to Others </label>
		</span>

		<span class="checkbox-button">
			<input id="data31" name="data31" type="checkbox" value="on"  <?php if ($obj{"data31"} == "on") {echo "checked";};?>>
			<label for="data31"> Sexual Acting Out </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="data32" name="data32" type="checkbox" value="on"  <?php if ($obj{"data32"} == "on") {echo "checked";};?>>
			<label for="data32"> Other Risk Factors Noted </label>
		</span>
		</TD>
		</tr>
		<TR>
		<TD>
		<BR>
		Risk Management: <BR>
					<TEXTAREA NAME="data33" ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in"><?php echo stripslashes($obj{"data33"});?></TEXTAREA></FONT>
					</TD>
	</TR>	
</table>



<b>Plan: </b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data34"><?php echo stripslashes($obj{"data34"});?></textarea><br><br>
<br><br>
<?php 
if (!empty($obj{"data35"} )) {?>
Next Appointment Date : <?php echo stripslashes($obj{"data35"});?><br>
Next Appointment Start Time : <?php echo stripslashes($obj{"data36"});?><br>
Next Appointment End Time : <?php echo stripslashes($obj{"data37"});?> <br>
This is the date and time of appointment set at time of writing.  Edit appointment data in the Calender.
<br>
<br>
<?php } ?>
<center><a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link_submit"
 onclick="top.restoreSession()">[Don't Save]</a></center>
<br>
</form>
<?php
formFooter();
?>
