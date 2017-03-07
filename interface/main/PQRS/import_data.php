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
 * @package OpenEMR
 * @link    http://www.oemr.org
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
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/addresses.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `billing`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/billing.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `facility`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/facilities.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `form_encounter`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/form_encounter.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `forms`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/forms.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `insurance_companies`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/insurance_companies.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `insurance_data`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/insurance_data.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `patient_data`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/patient_data.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `phone_numbers`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/phone_numbers.sql");
sqlStatement($query);

sqlStatement("TRUNCATE TABLE `x12_partners`;");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/x12_partners.sql");
sqlStatement($query);

sqlStatement("DELETE FROM `users` WHERE `users`.`id` > '20';");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/users.sql");
sqlStatement($query);

sqlStatement("DELETE FROM `groups` WHERE `groups`.`id` > '20';");
$query = file_get_contents($GLOBALS['OE_SITES_BASE']."/Importer/groups.sql");
sqlStatement($query);
echo "Database updated!";
}
?>
<html>
<input type="submit" name="formSubmit" value="Submit" />
</html>
</form>
