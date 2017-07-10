<?php
/**
 * pre Measure 0441 -- Numerator 2
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class pre_0441_Numerator2 extends PQRSFilter
{
    public function getTitle()
    {
        return "Numerator 2";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) AS count".  
"  FROM billing AS b1".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND b1.code = '3320F';";
//3319F no modifier hard fail
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 

if ($result['count'] > 0){ return true;} else {return false;}     


	
    }
}

?>