<?php
/**
 * PQRS Measure 0402 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0402_InitialPatientPopulation extends PQRSFilter
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)".
" INNER JOIN pqrs_poph AS codelist_a ON (b1.code = codelist_a.code)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND MONTH(fe.date)<'4' AND MONTH(fe.date)>'9' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) BETWEEN '12' AND '20' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0402_a');";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  

    }
}

?>

