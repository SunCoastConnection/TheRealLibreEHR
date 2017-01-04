<?php
/**
 * PQRS Measure 0005 -- Denominator
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0005_Denominator1 extends PQRSFilter
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	 $query =	    
		"SELECT COUNT(b1.code) as count ".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1 ".  //b1 is the first billing table alias to get the diagnosis as Dx. denominator
"  JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".  //fe is the alias of form_encounter that gets the date of service for the Tx
"  JOIN patient_data AS p ON (b1.pid = p.pid)".  //We join the patient_data table to check the patient's age.
"  WHERE b1.pid = ? ".  ///only check for current patient, which is matched on the PID
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
"  AND b1.code = '3021F';";  //CPT2 must match 
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  

    }
}

?>
