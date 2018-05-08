<?php
/*
 * MIPS table/module installer
 * Copyright (C) 2015 - 2018      Suncoast Connection
 * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @author  Bryan lee <leebc@suncoastconnection.com>
 * @package LibreHealthEHR 
 * @link    http://suncoastconnection.com
 * @link    http://librehealth.io
 *
 * Please support this product by sharing your changes with the LibreHealth.io community.
 */
require_once '../../interface/globals.php';
include_once("$srcdir/api.inc");
include_once("$srcdir/acl.inc");
?>	
<html>
<?php if (acl_check('admin', 'practice' )) { ?>
<span class='title' visibility: hidden>Install MIPS Module</span>
<h1>Install/Update MIPS reporting database tables</h1>
<b>This tool truncates all data from previous versions and installs the current database tables required for accurate MIPS reporting.</b>
<form action="import_data.php" method="post">	
<?php
if($_POST['formSubmit'] == "Submit") 
{

$query = file_get_contents(SQL/1_INSTALL/PQRS_billingcodes.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_clinical_rules.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_direct_entry_table.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_efcc1.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_efcc2.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_efcc3.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_efcc4.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_efcc5.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_mips.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_poph.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_ptct.sql");
sqlStatementNoLog($query);
$query = file_get_contents(SQL/1_INSTALL/PQRS_codes_ptsf.sql");
sqlStatementNoLog($query);

echo "MIPS module updated!";
}else{
    echo "<input type='submit' name='formSubmit' value='Submit' />";}
?>
<?php }
else {echo "You do not have access to this feature.";}
?>
</form>
</html>

