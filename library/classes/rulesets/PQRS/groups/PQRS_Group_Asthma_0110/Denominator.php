<?php
/**
 * PQRS Measure Group_Asthma_0110 -- Denominator 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_Asthma_0110_Denominator implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)".
" WHERE b1.pid = ? ".
" AND ((fe.date BETWEEN ('".$beginDate."' AND DATE_SUB('".$beginDate."', INTERVAL 9 MONTH)))".
" OR (fe.date BETWEEN (DATE_SUB('".$beginDate."', INTERVAL 9 MONTH) AND '".$endDate."')));";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;} 
    }
}

?>

