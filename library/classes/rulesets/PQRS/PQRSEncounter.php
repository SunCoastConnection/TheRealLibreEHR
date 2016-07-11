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

function AddCPT2CodeEncounter($postVars)
{
    $pid = $postVars[0];
    $date = $postVars[1];
    $code = $postVars[2];

//	*	Get the userID
//	* 	Is this user authorized?
//	*	check the date
//	*	check the PID
//	* 	check the CODE
//	*	Query the facility Name
//	*	Query the facility ID
//	*	Find the next encounter number
//	*	Find Provider ID

//		Art's encounter creation query guide.  (PQRS Gateway Issue #3)
	$query=
		"INSERT INTO `form_encounter` ".
		" ( `date`, `reason`, ".
		" `facility`, `facility_id`, ".
		" `pid`, `encounter`, `onset_date`, ".
		" `sensitivity`, `billing_note`, `pc_catid`, `provider_id`, ".
		" `supervisor_id`, `billing_facility`) ".
		" VALUES ".
		" ('".$date."', 'PQRS Direct Entry Input:  See Fee Sheet', ".
		" 'Query Facility Name Here','1', ".
		" '".$pid."','".$encounterNumber."','0000-00-00 00:00:00', ".
		" 'normal', 'PQRS CPT2 Entries','1','".$providerID."', ".
		" '0','1');";

	$query=
		"INSERT INTO `forms` ".
		" ( `date`, `encounter`, ".
		" `form_name`, `form_id`, ".
		" `pid`, `user`, `groupname`, `authorized`, ".
		"  `deleted`, `formdir`) ".
		" VALUES ".
		" ('".$date."','".$encounterNumber."', ".
		" 'New Patient Encounter', '1', ".
		" '".$pid."', '".$userID".','Default', '1', ".
		" '0', 'newpatient');";

	$query=
		"INSERT INTO `billing` ".
		" ( `date`, `code_type`, `code`, `pid`, ".
		" `provider_id`, `user`, `groupname`, `authorized`, ".
		" `encounter`, `billed`, `activity`, ".
		" `payer_id`, `bill_process`, `modifier`) ".
		" VALUES ".
		" ('".$date."','CPT2','".$code."','".$pid."', ".
		" '".$providerID."','".$userID."','Default','1', ".
		" '".$encounterNumber."','0','1', ".
		" '1','0','HR');";


// SAMPLE:  Passing values into a query
// $query =
//	"SELECT COUNT(b1.code) AS count ". 
//	" FROM billing AS b1 ". 
//	" INNER JOIN billing AS b2 ON (b1.pid = b2.pid) ". 
//	" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter) ".  
//	" JOIN patient_data AS p ON (b1.pid = p.pid) ". 
//	" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
//	" INNER JOIN pqrs_efcc AS codelist_b ON (b2.code = codelist_b.code)".
//	" WHERE b1.pid = ? ".  
//	" AND YEAR(fe.date) ='2015' ".
//	" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date)  BETWEEN '18' AND '75' ".  //age must be between 18 and 75 on the date of treatment
//	" AND b1.code = codelist_a.code ".
//	" AND codelist_a.type = 'pqrs_0001_a' ".
//	" AND b2.code = codelist_b.code".
//	" AND codelist_b.type = 'pqrs_0001_b' ;";

// SAMPLE
//	$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
//	if ($result['count'] > 0){
//		 return true;} else {return false;} 

    return true; //$result;
}

//  Begin Main
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$pid = $_POST['pid'];
	$date = $_POST['date'];
	$code = $_POST['CPT2codevalue'];

//	AddCPT2CodeEncounter($pid,$date,$code);

	if(rand(1, 15) > 10) {
        	echo 'SUCCESS';
	} else {
        	echo 'FAILED';
	}
}

?>
