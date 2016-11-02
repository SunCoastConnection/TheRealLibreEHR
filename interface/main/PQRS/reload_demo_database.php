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
<form action="reload_demo_database.php" method="post">	
<?php
if($_POST['formSubmit'] == "Submit") 
{

$i=$_POST['preset'];

echo "before switch, i= $i";

switch ($i) {
    case 0:
        echo "i equals 0";
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
    default:
       echo "i is not equal to 0, 1 or 2";
}
// sqlStatement("TRUNCATE TABLE `addresses`;");
// sqlStatement("TRUNCATE TABLE `billing`;");
// sqlStatement("TRUNCATE TABLE `facility`;");
// sqlStatement("TRUNCATE TABLE `form_encounter`;");
// sqlStatement("TRUNCATE TABLE `forms`;");
// sqlStatement("TRUNCATE TABLE `insurance_companies`;");
// sqlStatement("TRUNCATE TABLE `insurance_data`;");
// sqlStatement("TRUNCATE TABLE `patient_data`;");
// sqlStatement("TRUNCATE TABLE `phone_numbers`;");
// sqlStatement("TRUNCATE TABLE `x12_partners`;");

// $query = file_get_contents("./SQL/x12_partners.sql", true);
// sqlStatement($query);

// sqlStatement("DELETE FROM `users` WHERE `users`.`id` > '20';");
// $query = file_get_contents("./SQL/users.sql", true);
// sqlStatement($query);

// sqlStatement("DELETE FROM `groups` WHERE `groups`.`id` > '20';");
// $query = file_get_contents("./SQL/groups.sql", true);
// sqlStatement($query);

echo "Database updated!";
}
?>
<html>
Choose a preset to reload into the database, then click "Submit".
<p>
<select name="preset">
	<option value="1">Preset 1</option>
	<option value="2">Preset 2</option>
	<option value="3">Preset 3</option>
	<option value="4">Preset 4</option>
	<option value="5">Preset 5</option>
	<option value="6">Preset 6</option>
	<option value="7">Preset 7</option>
	<option value="8">Preset 8</option>
	<option value="9">Preset 9</option>
</select>
<p>
<input type="submit" name="formSubmit" value="Submit" />
</form>
</html>
</form>
