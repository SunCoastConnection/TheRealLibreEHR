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
include_once("../../../../interface/globals.php");
include_once("$srcdir/sql.inc");
//
//function listingCDRReminderLog($begin_date='',$end_date='') {
  //if (empty($end_date)) {
    //$end_date=date('Y-m-d H:i:s');
  //}
//}

//pid=' + '&date=' + '20160620' + '&CPT2codevalue=

function AddCPT2CodeBilling($pid,$date,$ourCode,$encounter,$userID)
{
	error_log("DEBUG: ACPT2CBilling -- Passed us:  pid=".$pid."  date=".$date."  code=".$code."  encounter=".$encounter."  user/provider=".$userID);

	if ( $ourCode != "" ) {
		$codesplit=explode(":",$ourCode);
                $codeBase=$codesplit[0];
                $codeModifier=$codesplit[1];

	error_log("DEBUG: ACPT2CBilling -- codeBase=".$codeBase." codeModifier=".$codeModifier);

//sqlInsert("update pqrs_form_acute_otitis_externa set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(), purpose ='".$_POST["purpose"]."'

		$query=
		"INSERT INTO `billing` ".
		" ( `date`, `code_type`, `code`, `pid`, ".
		" `provider_id`, `user`, `groupname`, `authorized`, ".
		" `encounter`, `billed`, `activity`, ".
		" `payer_id`, `bill_process`, `modifier`) ".
		" VALUES ".
		" ('".$date."','CPT2','".$codeBase."','".$pid."', ".
		" '".$userID."','".$userID."','Default','1', ".
		" '".$encounter."','0','1', ".
		" '1','0','".$codeModifier."');";
		$result = sqlQuery($query);
        	error_log("DEBUG: ACPT2CBilling -- Generated my query:  ".$query."  Executed with result:  ".$result);
	}

	return $result;
}

function AddCPT2CodeEncounter($pid,$date,$passedCodes)
{
	 
	//This is a DEBUG block:
	$var="";
	$session_string="";
	foreach ($_SESSION as $k => $var) {
		$session_string=$session_string." // ".$k." = ".$var;
	}
	error_log("DEBUG AddCPT2CodeEncounter() -- _SESSION:".$session_string);
//$_SESSION contains:
// language_choice = 1 
// authUser = admin 
// authPass = $
// authGroup = Default 
// authProvider = Default 
// authId = 1 
// cal_ui = 3 
// userauthorized = 1 
// last_update = 1468528344 
// encounter =  
// pc_username = admin 
// pc_framewidth = 1126 
// pc_facility = 0 
// viewtype = day 
// PNSVrand = 146242944 
// PNSVlang = eng 
// lastcaldate = 2016-07-14 
// pid = 1,


//	*	Get the userID
	$myuserID=$_SESSION["authUserID"];
// authUserID = 1 
//	* 	Is this user authorized?
//	/	check the date
//		x	Format the date for database entry
//		*	check the PID
//		* 	check the CODE
//	*	Break the code part into $codeBase and $codeModifier
//	*	Query the facility Name
//	*	Query the facility ID
// site_id = default 
//	$myfacility=$_SESSION["facilityID"].RRRRR;
	$myfacility=$facility;
//	*	Find Provider ID
	$myprovider_id = findProvider( $pid );

//	*	Find the next encounter number

	$query = "SELECT MAX(encounter) as enc FROM form_encounter;";
	$result = sqlStatement($query);
	$tmpEncounterNumber = SqlFetchArray($result);
	$myencounterNumber = 1 + $tmpEncounterNumber['enc'];
error_log("DEBUG AddCPT2CodeEncounter() -- queried encounter with: \"".$query."\" and got \"".$result."\"  and next encounterNumber as:  ".$myencounterNumber);


	$query= "INSERT INTO `form_encounter` ".
		" ( `date`, `reason`, ".
		" `facility`, `facility_id`, ".
		" `pid`, `encounter`, `onset_date`, ".
		" `sensitivity`, `billing_note`, `pc_catid`, `provider_id`, ".
		" `supervisor_id`, `billing_facility`) ".
		" VALUES ".
		" ('".$date."', 'PQRS Direct Entry Input:  See Fee Sheet', ".
		" '".$myfacility."','1', ".
		" '".$pid."','".$myencounterNumber."','0000-00-00 00:00:00', ".
		" 'normal', 'PQRS CPT2 Entries','1','".$myprovider_id."', ".
		" '0','1');";
	$result = sqlStatement($query);
error_log("DEBUG AddCPT2CodeEncounter() -- Built form_encounter query: \"".$query." with result \"".SqlFetchArray($result)."\"");

//	* Now query and find out the form_id we just created
	$query = "SELECT id FROM form_encounter WHERE encounter = ".$myencounterNumber.";";
	$result = sqlStatement($query);
	$myFormID = SqlFetchArray($result)['id'];
error_log("DEBUG AddCPT2CodeEncounter() -- Queried form_id with query: \"".$query."\". Ran it with result \"".$result."  myFormID =".$myFormID );


	$query= "INSERT INTO `forms` ".
		" ( `date`, `encounter`, ".
		" `form_name`, `form_id`, ".
		" `pid`, `user`, `groupname`, `authorized`, ".
		"  `deleted`, `formdir`) ".
		" VALUES ".
		" ('".$date."','".$myencounterNumber."', ".
		" 'New Patient Encounter', '".$myFormID."', ".
		" '".$pid."', '".$myuserID."','Default', '1', ".
		" '0', 'newpatient');";
	$result = sqlStatement($query);
error_log("DEBUG AddCPT2CodeEncounter() -- Built forms-newpatient query: \"".$query." with result \"".SqlFetchArray($result)."\"");

	foreach (explode(" ", $passedCodes) as $ourCode ) {

		AddCPT2CodeBilling($pid,$date,$ourCode,$myencounterNumber,$myuserID);
	}

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

    return "'pid=".$pid." / date=".$date." / codes=".$passedCodes." / provider_id=".$myprovider_id." / user=".$_SESSION["authUserID"]."'" ; //$result;

}	// End function AddCPT2CodeEncounter()


function findProvider($pid) {
	$find_provider = sqlQuery("SELECT providerID FROM patient_data " .
                "WHERE pid = ? ", array($pid) );
	$providerid = $find_provider['providerID'];

	error_log("DEBUG findProvider() -- called with pid:  ".$pid.", found provider:  ".$providerid."  ");
	
	return $providerid;
}	// End function find_provider()


//  Begin Main
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$mypid = $_POST['pid'];
	$mydate = $_POST['date'];
	$mycode = $_POST['CPT2codevalue'];
error_log("DEBUG Main -- POSTed us with pid=".$mypid."  date=".$mydate."  code=".$mycode."  encounter=".$encounter."  user/provider=".$userID);

	if ( $mypid !='' and $mydate!='' and $mycode!='') {

		$result=AddCPT2CodeEncounter($mypid,$mydate,$mycode);

		if(rand(1, 15) > 15) {
        		echo 'SUCCESS';
		} else {
        		echo 'FAILED:'.$result;
		}
	}
}

?>
