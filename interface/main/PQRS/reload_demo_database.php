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
	$action=$_POST['action'];
	if($action == "none"){
		echo "<p><b>Please chose a valid preset and an action.</b><p>";
		}else{
		$preset=$_POST['preset'];
		if( ( 0 < $preset ) && ( $preset < 10 ) ){
			echo "<p>Doing something with a valid preset<p>";
			$demopath="/var/www/".$GLOBALS['webroot']."/sql/demopresets/".$preset;
			//$demopath="";
			echo "<p>demopath= $demopath<p>";
			$files1 = scandir($demopath);
			echo "File listing:  ";
			print_r($files1);
			echo "<hr>";

			$ourtables = array( "addresses", "billing", "facility", "form_encounter", "forms", "insurance_companies", "insurance_data", "patient_data", "phone_numbers", "x12_partners");

			if($action == "load"){
				echo "<p>Loading from Preset $preset...<p>";

				foreach ($ourtables as $value) {
				   sqlStatement("TRUNCATE TABLE `$value`;");
				}

				foreach ($ourtables as $value) {
				   $ourpath="$demopath/$value";
				   $query = file_get_contents("$ourpath", true);
				   sqlStatement($query);
				}

				//  Do we even want to do users/groups?
//				sqlStatement("DELETE FROM `users` WHERE `users`.`id` > '20';");
//				$query = file_get_contents("$demopath/users.sql", true);
//				sqlStatement($query);
//
//				sqlStatement("DELETE FROM `groups` WHERE `groups`.`id` > '20';");
//				$query = file_get_contents("$demopath/groups.sql", true);
//				sqlStatement($query);

				echo "<p>Database updated!<p>";
			} else if ($action == "save"){
					// Art's suggestion
					// exec('mysqldump --root=... --rootpass=... --localhost=... openemrtest > /path/to/output/file.sql');

				echo "Saving to Preset $preset...<br>";

				$ourpath="$demopath/$value.sql";
				//$query = "SHOW TABLES;";
				echo "Path: $ourpath<br>";

				$towrite='';
				foreach ($ourtables as $value) {
					echo "Table: $value  <br>";

				   	$query = "SHOW CREATE TABLE $value";
					$createresult=sqlStatement($query);
					echo "<p>Query: $query  <br>  result:  $createresult <p>";
				   	$towrite.= "\n\n".$createresult[1].";\n\n";

					$query = "SELECT * FROM $value ;";
					$result=sqlStatement($query);
					echo "<p>Query: $query <br>  result:  $result <p>";
					$num_rows = mysqli_num_rows($result);	
					if ( $num_rows !== 0) {
                				$row3 = mysqli_fetch_fields($result);
                				$towrite.= 'INSERT INTO '.$table.'( '.$createresult.' ) VALUES '.$result.');';

					}
					//$return.= ' ) VALUES';
					//$return.="\n(";
				}

				echo "towrite:<br> $towrite";

				echo "<p>Database updated!<p>";
			}
		}
	}
	


}
?>
<html>
Choose a preset to Load from or Save the database to, then click "Submit".
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
<input type="radio" name="action" value="none" checked="checked">Do nothing
<input type="radio" name="action" value="load">Load
<input type="radio" name="action" value="save">Save
<p>
<input type="submit" name="formSubmit" value="Submit" />
</form>
</html>
</form>
