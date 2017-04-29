<?php
/*
 *Claims2OEMR import script
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
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @link    http://suncoastconnection.com
 * @author  Suncoast Connection
*/
require_once("../../globals.php");
include_once("$srcdir/api.inc");

?>	
<form action="import_data.php" method="post">	
<?php
if($_POST['formSubmit'] == "Submit") 
{
sqlStatement("TRUNCATE TABLE `addresses`;");
$query = file_get_contents("./SQL/addresses.sql", true);
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `billing`;");
$query = file_get_contents("./SQL/billing.sql", true);
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `facility`;");
$query = file_get_contents("./SQL/facilities.sql", true);
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `form_encounter`;");
$query = file_get_contents("./SQL/form_encounter.sql", true);
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `forms`;");
$query = file_get_contents("./SQL/forms.sql", true);
sqlStatement($query);

/*INSERT INTO `forms` (`id`, `date`, `encounter`, `form_name`, `form_id`, `pid`, `user`, `groupname`, `authorized`, `deleted`, `formdir`) VALUES
('1','20151201123739','158940559170','New Patient Encounter','1','1','1356326920','Default', '1', '0', 'newpatient'),
INSERT INTO `form_encounter` (`id`, `date`, `reason`, `facility`, `facility_id`, `pid`, `encounter`,
                 `onset_date`, `sensitivity`, `billing_note`, `pc_catid`, `last_level_billed`, `last_level_closed`, `last_stmt_date`, `stmt_count`,
                  `provider_id`, `supervisor_id`, `invoice_refno`, `referral_source`, `billing_facility`) VALUES
('1','20151201123739','Imported Encounter','BOWENPRIMARYCARE','1','1','158940559170','0000-00-00 00:00:00','normal','NULL','1','0','0','NULL','0','1356326920','0','','','1'),
INSERT INTO `billing` (`id`, `date`, `code_type`, `code`, `pid`,
                 `provider_id`, `user`, `groupname`, `authorized`, `encounter`, `code_text`, `billed`, `activity`,
                  `payer_id`, `bill_process`, `bill_date`, `process_date`, `process_file`, `modifier`,  `units`,
                   `fee`, `justify`) VALUES
('1','20151201123739','CPT4','99327','1','1356326920','1356326920','Default','1','158940559170','','0','1','1','0','NULL','NULL','NULL','','','0.00','F03.90'),
echo "Database updated!";

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); 

<b><u>Participants:  </u></b><br>
<textarea cols=80 rows=1 wrap=virtual name="data3" ></textarea>
<br><br>
<b>Next Appointment Date (USE FORMAT YYYY-MM-DD ONLY!):</b>&nbsp;<input type="date" name='data35' autocomplete="on"><br>*/
}
?>
//<html>
<input type="submit" name="formSubmit" value="Submit" />
//<b>Next Appointment Date (USE FORMAT YYYY-MM-DD ONLY!):</b>&nbsp;<input type="date" name='data35' autocomplete="on"><br>
</html>
</form>