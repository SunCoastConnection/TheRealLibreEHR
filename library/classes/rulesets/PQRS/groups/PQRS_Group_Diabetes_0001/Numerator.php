<?php
/**
 * PQRS Measure Group_Diabetes_0001 -- Numerator
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_Diabetes_0001_Numerator extends PQRSFilter
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b.code) as count".
"  FROM billing AS b".
" JOIN form_encounter AS fe ON (b.encounter = fe.encounter)".
" WHERE b.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ". 
" AND b.code = '3046F';";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));

if ($result['count'] > 0){ return true;} else {return false;}    

	
    }
}

?>

