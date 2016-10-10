<?php
/**
 * PQRS Measure 0052 -- Numerator
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0052_Numerator implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
" SELECT COUNT(b1.code) AS count".  
" FROM billing AS b1".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" INNER JOIN billing AS b2 ON (b2.pid = b1.pid)".
" WHERE b1.pid = ? ".

" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND ((b1.code = '4025F' AND b1.modifier != '8P')AND b2.code = 'G8924' ); ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 

if ($result['count']> 0){ return true;} else {return false;}     
			
    }
}

?>
