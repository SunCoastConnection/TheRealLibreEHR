<?php
/**
 * PQRS Measure Group_AOE_0154 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_AOE_0154_Exclusion extends PQRSFilter
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
" SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1".
" INNER JOIN billing AS b2 ON (b2.pid = b1.pid)".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND ((b1.code = '3288F'  AND b1.modifier ='1P' AND b2.code = '1100F') OR (b1.code = '1101F' AND b1.modifier IN('','8P') )); ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));

if ($result['count'] > 0){ return true;} else {return false;}  
    }
}

?>

