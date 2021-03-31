
<?php
include_once("../../interface/globals.php");
include_once("$srcdir/api.inc");

?>

<html>
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
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
} 

  </style>
<title>User Access Control</title>
<BR>
<BR>

<form method="post" action="acl_admin.php" name="theform">


///////////////
<div id="report_parameters">

<input type='hidden' name='form_refresh' id='form_refresh' value=''/>

<table>
 <tr>
  <td width='660px'>
	<div style='float:left'>

	<table class='text'>
		<tr>

			<td class='label'>
			   <?php xl('User','e'); ?>:
			</td>
			<td>
				<?php

					// Build a drop-down list of users.
					//
					$query = "select id, lname, fname from users where " .
						"active = 1 AND password ='NoLongerUsed' order by lname, fname";
					$res = sqlStatement($query);
					echo "   &nbsp;<select name='form_user'>\n";
					while ($row = sqlFetchArray($res)) {
						$userid = $row['id'];
						echo "    <option value='$userid'";
						if ($userid == $_POST['form_user']) echo " selected";
						echo ">" . $row['lname'] . ", " . $row['fname'] . "\n";
					}
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
			<td>
				<div style='margin-left:15px'>
					<a href='#' class='css_button' onclick='$("#form_refresh").attr("value","true"); $("#theform").submit();'>
					<span>
						<?php xl('Submit','e'); ?>
					</span>
					</a>

				</div>
			</td>
		</tr>
	</table>
  </td>
 </tr>
</table>
</div>

<?php
 if ($_POST['form_refresh']) {
       $form_user = $_POST['form_user'];
       $Query = "SELECT * from users_acl where user = '$form_user';";
       $punchrow = sqlStatement($Query);
       
       $row = SqlFetchArray($punchrow);
       
       $deletedocuments                 = $row['deletedocuments'];           
       $batchcom                        = $row['batchcom'];                  
       $eob                             = $row['eob'];                       
       $bill                            = $row['bill'];                      
       $billing_reports                 = $row['billing_reports'];           
       $report_select_any_provider      = $row['report_select_any_provider'];
       $super                           = $row['super'];                     
       $edit_drugs                      = $row['edit_drugs'];                
       $prices                          = $row['prices'];                    
       $sensitive                       = $row['sensitive'];                 
       $create_encounters               = $row['create_encounters'];         
       $encounter_notes                 = $row['encounter_notes'];           
       $anyones_encounter               = $row['anyones_encounter'];         
       $link_issue_encounter            = $row['link_issue_encounter'];      
       $encounter_date_edit             = $row['encounter_date_edit'];       
       $Dx_edit                         = $row['Dx_edit'];                   
       $fee_sheet                       = $row['fee_sheet'];                 
       $fee_sheet_any                   = $row['fee_sheet_any'];             
       $language                        = $row['language'];                  
       $patients_add                    = $row['patients_add'];              
       $patient_dems                    = $row['patient_dems'];              
       $patients_edit_dems              = $row['patients_edit_dems'];        
       $messages                        = $row['messages'];                  
       $patient_alerts                  = $row['patient_alerts'];            
       $orders_procedures               = $row['orders_procedures'];         
       $chart_amendments                = $row['chart_amendments'];          
       $sign_orders                     = $row['sign_orders'];               
       $practice_admin                  = $row['practice_admin'];            
       $calendar_add                    = $row['calendar_add'];              
       $calendar_edit                   = $row['calendar_edit'];             
       $calendar_super                  = $row['calendar_super'];
?>
         
<input type='hidden' name='form_save' id='form_save' value='save'/>


















<table id='ar'>

	<TR class="alt">
	<TD>
	<B>Access Points:</b>
	</TD>
	</tr>
	<tr>
	<TD>

		<span class="checkbox-button">
			<input id="deletedocuments" name="deletedocuments" type="checkbox" value="1"  <?php if ($deletedocuments == "1") {echo "checked";};?>>
			<label for="deletedocuments" > Delete Documents </label>
		</span>

		<span class="checkbox-button">
			<input id="batchcom" name="batchcom" type="checkbox" value="1"  <?php if ($batchcom == "1") {echo "checked";};?>>
			<label for="batchcom"> BatchCom </label>
		</span>
		
		<span class="checkbox-button">
			<input id="eob" name="eob" type="checkbox" value="1"  <?php if ($eob == "1") {echo "checked";};?>>
			<label for="eob"> EOBs </label>
		</span>
		
		<span class="checkbox-button">
			<input id="bill" name="bill" type="checkbox" value="1"  <?php if ($bill == "1") {echo "checked";};?>>
			<label for="bill"> Billing </label>
		</span>
		
		<span class="checkbox-button">
			<input id="billing_reports" name="billing_reports" type="checkbox" value="1"  <?php if ($billing_reports == "1") {echo "checked";};?>>
			<label for="billing_reports"> Billing Reports </label>
		</span>
		
		<span class="checkbox-button">
			<input id="report_select_any_provider" name="report_select_any_provider" type="checkbox" value="1"  <?php if ($report_select_any_provider == "1") {echo "checked";};?>>
			<label for="report_select_any_provider"> Report on Any Provider </label>
		</span>
		
		<span class="checkbox-button">
			<input id="super" name="super" type="checkbox" value="1"  <?php if ($super == "1") {echo "checked";};?>>
			<label for="super"> SuperUser </label>
		</span>

		<span class="checkbox-button">
			<input id="edit_drugs" name="edit_drugs" type="checkbox" value="1"  <?php if ($edit_drugs == "1") {echo "checked";};?>>
			<label for="edit_drugs"> Edit Drug Warehouse </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="prices" name="prices" type="checkbox" value="1"  <?php if ($prices == "1") {echo "checked";};?>>
			<label for="prices"> Prices </label>
		</span>
		<span class="checkbox-button">
			<input id="sensitive" name="sensitive" type="checkbox" value="1"  <?php if ($sensitive == "1") {echo "checked";};?>>
			<label for="sensitive" > VIP patients </label>
		</span>

		<span class="checkbox-button">
			<input id="create_encounters" name="create_encounters" type="checkbox" value="1"  <?php if ($create_encounters == "1") {echo "checked";};?>>
			<label for="create_encounters"> Create Encounters </label>
		</span>
		
		<span class="checkbox-button">
			<input id="encounter_notes" name="encounter_notes" type="checkbox" value="1"  <?php if ($encounter_notes == "1") {echo "checked";};?>>
			<label for="encounter_notes"> Clinical Forms </label>
		</span>
		
		<span class="checkbox-button">
			<input id="anyones_encounter" name="anyones_encounter" type="checkbox" value="1"  <?php if ($anyones_encounter == "1") {echo "checked";};?>>
			<label for="anyones_encounter"> Anyone's Encounter </label>
		</span>
		
		<span class="checkbox-button">
			<input id="link_issue_encounter" name="link_issue_encounter" type="checkbox" value="1"  <?php if ($link_issue_encounter == "1") {echo "checked";};?>>
			<label for="link_issue_encounter"> Link issues/dx to encounter </label>
		</span>
		
		<span class="checkbox-button">
			<input id="encounter_date_edit" name="encounter_date_edit" type="checkbox" value="1"  <?php if ($encounter_date_edit == "1") {echo "checked";};?>>
			<label for="encounter_date_edit"> Edit Encounter Dates </label>
		</span>
		
		<span class="checkbox-button">
			<input id="Dx_edit" name="Dx_edit" type="checkbox" value="1"  <?php if ($Dx_edit == "1") {echo "checked";};?>>
			<label for="Dx_edit"> Edit Dx </label>
		</span>

		<span class="checkbox-button">
			<input id="fee_sheet" name="fee_sheet" type="checkbox" value="1"  <?php if ($fee_sheet == "1") {echo "checked";};?>>
			<label for="fee_sheet"> Fee Sheet </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="fee_sheet_any" name="fee_sheet_any" type="checkbox" value="1"  <?php if ($fee_sheet_any == "1") {echo "checked";};?>>
			<label for="fee_sheet_any"> Other user's Fee Sheet </label>
		</span>
				<span class="checkbox-button">
			<input id="language" name="language" type="checkbox" value="1"  <?php if ($language == "1") {echo "checked";};?>>
			<label for="language" > Language Settings </label>
		</span>

		<span class="checkbox-button">
			<input id="patients_add" name="patients_add" type="checkbox" value="1"  <?php if ($patients_add == "1") {echo "checked";};?>>
			<label for="patients_add"> Add Patients </label>
		</span>
		
		<span class="checkbox-button">
			<input id="patient_dems" name="patient_dems" type="checkbox" value="1"  <?php if ($patient_dems == "1") {echo "checked";};?>>
			<label for="patient_dems"> Access Demographics </label>
		</span>
		
		<span class="checkbox-button">
			<input id="patients_edit_dems" name="patients_edit_dems" type="checkbox" value="1"  <?php if ($patients_edit_dems == "1") {echo "checked";};?>>
			<label for="patients_edit_dems"> Edit Demographics </label>
		</span>
		
		<span class="checkbox-button">
			<input id="messages" name="messages" type="checkbox" value="1"  <?php if ($messages == "1") {echo "checked";};?>>
			<label for="messages"> Messages </label>
		</span>
		
		<span class="checkbox-button">
			<input id="patient_alerts" name="patient_alerts" type="checkbox" value="1"  <?php if ($patient_alerts == "1") {echo "checked";};?>>
			<label for="patient_alerts"> Patient Alert Admin </label>
		</span>
		
		<span class="checkbox-button">
			<input id="orders_procedures" name="orders_procedures" type="checkbox" value="1"  <?php if ($orders_procedures == "1") {echo "checked";};?>>
			<label for="orders_procedures"> Write/Access Orders/Procedures </label>
		</span>

		<span class="checkbox-button">
			<input id="chart_amendments" name="chart_amendments" type="checkbox" value="1"  <?php if ($chart_amendments == "1") {echo "checked";};?>>
			<label for="chart_amendments"> Chart Amendments </label>
		</span>
		
		<span class="checkbox-button">
		    <input id="sign_orders" name="sign_orders" type="checkbox" value="1"  <?php if ($sign_orders == "1") {echo "checked";};?>>
			<label for="sign_orders"> Sign Orders </label>
		</span>
				
		<span class="checkbox-button">
		    <input id="practice_admin" name="practice_admin" type="checkbox" value="1"  <?php if ($practice_admin == "1") {echo "checked";};?>>
			<label for="practice_admin"> Practice Admin </label>
		</span>
				
		<span class="checkbox-button">
		    <input id="calendar_add" name="calendar_add" type="checkbox" value="1"  <?php if ($calendar_add == "1") {echo "checked";};?>>
			<label for="calendar_add"> Schedule on Calendar </label>
		</span>
				
		<span class="checkbox-button">
		    <input id="calendar_edit" name="calendar_edit" type="checkbox" value="1"  <?php if ($calendar_edit == "1") {echo "checked";};?>>
			<label for="calendar_edit"> Edit Schedule </label>
		</span>
				
		<span class="checkbox-button">
		    <input id="calendar_super" name="calendar_super" type="checkbox" value="1"  <?php if ($calendar_super == "1") {echo "checked";};?>>
			<label for="calendar_super"> Calendar Admin </label>
		</span>
				
		</TD>
		</tr>

</table>

  <div style='margin-left:15px'>
	<input type="submit" value="Save Changes!">
	</span>
	</a>
<BR>
	</div>
<?php
}
  if ($_POST['form_save']) { 
$insert = "UPDATE users_acl SET ". 
" deletedocuments                    = $_POST['deletedocuments'],".
" batchcom                           = $_POST['batchcom'],".
" eob                                = $_POST['eob'],".
" bill                               = $_POST['bill'],".
" billing_reports                    = $_POST['billing_reports'],".
" report_select_any_provider         = $_POST['report_select_any_provider'],".
" super                              = $_POST['super'],".
" edit_drugs                         = $_POST['edit_drugs'],".
" prices                             = $_POST['prices'],".
" sensitive                          = $_POST['sensitive'],".
" create_encounters                  = $_POST['create_encounters'],".
" encounter_notes                    = $_POST['encounter_notes'],".
" anyones_encounter                  = $_POST['anyones_encounter'],".
" link_issue_encounter               = $_POST['link_issue_encounter'],".
" encounter_date_edit                = $_POST['encounter_date_edit'],".
" Dx_edit                            = $_POST['Dx_edit'],".
" fee_sheet                          = $_POST['fee_sheet'],".
" fee_sheet_any                      = $_POST['fee_sheet_any'],".
" language                           = $_POST['language'],".
" patients_add                       = $_POST['patients_add'],".
" patient_dems                       = $_POST['patient_dems'],".
" patients_edit_dems                 = $_POST['patients_edit_dems'],".
" messages                           = $_POST['messages'],".
" patient_alerts                     = $_POST['patient_alerts'],".
" orders_procedures                  = $_POST['orders_procedures'],".
" chart_amendments                   = $_POST['chart_amendments'],".
" sign_orders                        = $_POST['sign_orders'],".
" practice_admin                     = $_POST['practice_admin'],".
" calendar_add                       = $_POST['calendar_add'],".
" calendar_edit                      = $_POST['calendar_edit'],".
" calendar_super                     = $_POST['calendar_super'],".
" WHERE user = $thisuser";

   sqlStatement($insert);
   echo "Updated User #".$thisuser; 

      }
?>
  </form>