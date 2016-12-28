<?php
/**
 * PQRS Measure Group_CP_236 -- Denominator 
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_Group_CP_0236_Denominator extends PQRSFilter
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
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" WHERE b1.pid = ? ".
" AND fe.date <= DATE_SUB('".$endDate."', INTERVAL 6 MONTH) ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) BETWEEN '21' AND '85' ".
" AND b1.code = 'I10'; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;} 
    }
}

?>
