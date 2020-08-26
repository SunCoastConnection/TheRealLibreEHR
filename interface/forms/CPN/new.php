
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

<form method=post action="<?php echo $rootdir;?>/forms/CPN/save.php?mode=new" name="my_form">
<br>
<span class="title"><center>Counseling Progress Note</center></span><br><br>
<center><a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
You must EDIT the form after saving and reviewing to finalize
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link_submit"
 onclick="top.restoreSession()">[Don't Save]</a></center>
<br>

<?php $res = sqlStatement("SELECT date FROM form_encounter WHERE encounter = $encounter");
$encounterdata_array = SqlFetchArray($res); ?>

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>


<b><u>Client and Service Information For:</u></b>&nbsp;&nbsp; <?php echo $result['fname'] . '&nbsp' . $result['mname'] . '&nbsp;' . $result['lname'];?>

<br><br>
<label for="dx">Related Diagnosis:</label>
<input type="text" id="dx" name="dx">
<br>

<label for="tx">Services:</label>
<select name="tx" size="1">
<option value="H2019:HR">H2019 HR Individual/family</option>
<option value="H2019:HO">H2019 HO Therapeutic Behavioral On site</option>
<option value="Other">Other</option>
</select>
&nbsp;&nbsp;&nbsp;
<label for="tx2">Other:</label>
<input type="text" id="tx2" name="tx2"> 
<br>
<label for="location">Location:</label>
<input type="text" id="location" name="location">

<br><br>
<?php echo "Date of Service: ". '&nbsp' .date("Y-m-d",strtotime($encounterdata_array['date']))  ;?>
&nbsp;&nbsp;&nbsp;       
<b>Start Time:</b>&nbsp;<input type="time" name='data1'>
&nbsp;&nbsp;&nbsp;
<b>End Time:</b>&nbsp;<input type="time" name='data2'>
<br><br>

<b><u>Participants:  </u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data3" ></textarea>
<br><br>

<b><u>Contacts Since Last Session:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data4" ></textarea>
<br><br>

<b><u>Treatment Goals/Objectives Addressed:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data5" ></textarea>
<br><br>

<b><u>Therapeutic Interventions:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data6" ></textarea>
<br><br>

<b><u>Session Focus:</u></b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data7" ></textarea>
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
			<input id="data8" name="data8" type="checkbox" value="on" >
			<label for="data8" > Engaging </label>
		</span>

		<span class="checkbox-button">
			<input id="data9" name="data9" type="checkbox" value="on" >
			<label for="data9"> Withdrawn </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data10" name="data10" type="checkbox" value="on" >
			<label for="data10"> Cooperative </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data11" name="data11" type="checkbox" value="on" >
			<label for="data11"> Defiant </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data12" name="data12" type="checkbox" value="on" >
			<label for="data12"> Flat Affect </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data13" name="data13" type="checkbox" value="on" >
			<label for="data13"> Anxious/Fearful </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data14" name="data14" type="checkbox" value="on" >
			<label for="data14"> Happy </label>
		</span>

		<span class="checkbox-button">
			<input id="data15" name="data15" type="checkbox" value="on" >
			<label for="data15"> Sad </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="data16" name="data16" type="checkbox" value="on" >
			<label for="data16"> Angry </label>
		</span>
		</TD>
		</tr>
		<TR>
		<TD>
		<BR>
		Assessment Notes: <BR>
					<TEXTAREA NAME="assessment_notes" ROWS=3 COLS=25 WRAP=SOFT STYLE="width: 2in; height: 0.21in"></TEXTAREA></FONT>
					</TD>
	</TR>	
</table>


<br><br>

<b><u>Progress Toward Treatment Goals:</u></b><br>
<i>including strengths/limitations that impacted achievement</i><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in" name="data17" ></textarea>
<br><br>








<p><b>Risk Assessment:</b>&nbsp;&nbsp;
<i>Based on the following risk factor:</i><br>
<select name="data18" size="3">
<option value="No Noted or Observed Risk" selected>None Noted</option>
<option value="Low Risk">Low Risk</option>
<option value="Moderate Risk">Moderate Risk</option>
<option value="High Risk">High Risk</option>
<option value="Very High Risk">Very High Risk</option>
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
			<input id="data19" name="data19" type="checkbox" value="on" >
			<label for="data19" > Hx of Tx Non-Compliance </label>
		</span>

		<span class="checkbox-button">
			<input id="data20" name="data20" type="checkbox" value="on" >
			<label for="data20"> Hx/Px of Elopement </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data21" name="data21" type="checkbox" value="on" >
			<label for="data21"> Hx of Multiple Dx </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data22" name="data22" type="checkbox" value="on" >
			<label for="data22"> Prior Inpatient Treatment </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data23" name="data23" type="checkbox" value="on" >
			<label for="data23"> Prior Homicide or Suicide Attempt </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data24" name="data24" type="checkbox" value="on" >
			<label for="data24"> Self Injurious </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data25" name="data25" type="checkbox" value="on" >
			<label for="data25"> Current Suicide Ideation </label>
		</span>

		<span class="checkbox-button">
			<input id="data26" name="data26" type="checkbox" value="on" >
			<label for="data26"> Imminent Risk of Harm to Self </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="data27" name="data27" type="checkbox" value="on" >
			<label for="data27"> Threats to Harm Others </label>
		</span>
		<span class="checkbox-button">
			<input id="data28" name="data28" type="checkbox" value="on" >
			<label for="data28"> Aggression </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data29" name="data29" type="checkbox" value="on" >
			<label for="data29"> Current Homicidal Ideation </label>
		</span>
		
		<span class="checkbox-button">
			<input id="data30" name="data30" type="checkbox" value="on" >
			<label for="data30"> Imminent Risk of Harm to Others </label>
		</span>

		<span class="checkbox-button">
			<input id="data31" name="data31" type="checkbox" value="on" >
			<label for="data31"> Sexual Acting Out </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="data32" name="data32" type="checkbox" value="on" >
			<label for="data32"> Other Risk Factors Noted </label>
		</span>
		</TD>
		</tr>
		<TR>
		<TD>
		<BR>
		Risk Management: <BR>
					<TEXTAREA NAME="data33" ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in">The current risk is rated as low based on the factors above and it is my clinical judgment that the recommended level of counseling indicated below is sufficient to manage this risk.</TEXTAREA></FONT>
					</TD>
	</TR>	
</table>



<b>Plan: </b><br>
<textarea ROWS=7 COLS=125 WRAP=SOFT STYLE="width: 6in; height: .75in"   name="data34"></textarea><br><br>
<br><br>
The appointment entry below is not currently configured to set a calendar appointment or set a reminder.
<br>
<b>Next Appointment Date:</b>&nbsp;<input type="date" name='data35' autocomplete="on"><br>
<b>Next Appointment Time (AM/PM):</b><br>
Start Time:&nbsp;&nbsp;<input type="time" name='data36'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
End Time:&nbsp;&nbsp;<input type="time" name='data37'>
<br>
<br>

<center><a href="javascript:top.restoreSession();document.my_form.submit();" class="link_submit">[Save]</a>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="link_submit"
 onclick="top.restoreSession()">[Don't Save]</a></center>
<br>
</form>

