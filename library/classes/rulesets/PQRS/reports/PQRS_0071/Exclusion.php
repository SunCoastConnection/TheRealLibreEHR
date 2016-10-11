<?php
/**
 * PQRS Measure 0071 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */

class PQRS_0071_Exclusion implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
" SELECT COUNT(b1.code) AS count".  
" FROM billing AS b1".
" JOIN billing AS b2 ON (b2.pid = b1.pid)".
" JOIN billing AS b3 ON (b3.pid = b1.pid)".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND (((b1.code = '4179F' AND b1.modifier IN('1P', '2P', '3P'))".
" AND b2.code IN('3374F', '3376F', '3378F')".
" AND b3.code = '3315F')".
" OR (b1.code IN ('3370F','3316F') AND b1.modifier IN('', '8P'))
" OR (b1.code IN ('3372F', '3380F')  )); ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 

if ($result['count']> 0){ return true;} else {return false;}    
    }
}
