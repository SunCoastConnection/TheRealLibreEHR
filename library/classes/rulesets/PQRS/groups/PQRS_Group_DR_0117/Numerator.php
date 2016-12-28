<?php
/**
 * PQRS Measure Group_DR_0117 -- Numerator
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_Group_DR_0117_Numerator extends PQRSFilter
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
" WHERE b1.pid = ? ".
" AND fe.date >= DATE_SUB('".$beginDate."', INTERVAL 1 YEAR)".
" AND b1.code IN ( '2022F','2024F','2026F','3072F') AND b1.modifier =''; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 

if ($result['count']> 0){ return true;} else {return false;} 
		
    }
}

?>
