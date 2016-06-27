<?php
 /*
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @author  Suncoast Connection
 * @author  Bryan Lee
 * @link    http://suncoastconnection.com
*/

//require_once(dirname(__FILE__) . "/jsonwrapper/jsonwrapper.php");
//
//function listingCDRReminderLog($begin_date='',$end_date='') {
  //if (empty($end_date)) {
    //$end_date=date('Y-m-d H:i:s');
  //}
//}

//pid=' + '&date=' + '20160620' + '&CPT2codevalue=

$pid = $_POST['pid'];
$date = $_POST['date'];
$code = $_POST['CPT2codevalue'];


// echo 'Hello !' . htmlspecialchars($_GET["name"]) . '!';
// echo '<p>';
// echo 'pid !' . htmlspecialchars($pid) . '!';
// echo '<p>';
// echo 'date !' . htmlspecialchars($date) . '!';
// echo '<p>';
// echo 'CPT2codevalue !' . htmlspecialchars($code) . '!';
// echo '<p>';

if(rand(1, 15) > 10) {
        echo 'SUCCESS';
} else {
        echo 'FAILED';
}
?>
