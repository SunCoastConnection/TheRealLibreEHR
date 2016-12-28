<?php
/**
 * PQRS Measure Group_CP_226 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */

class PQRS_Group_CP_0226_Exclusion extends PQRSFilter
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
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN DATE_SUB('".$beginDate."', INTERVAL 1 YEAR) AND '".$endDate."' ".
" AND b1.code = '4004F' AND b1.modifier ='1P'  ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));

if ($result['count'] > 0){ return true;} else {return false;} 
    }
}

?>
