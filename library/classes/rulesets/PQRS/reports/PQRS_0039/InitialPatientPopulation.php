<?php
/**
 * PQRS Measure 0039 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0039_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)".
" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
" WHERE b1.pid = ? ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) BETWEEN ('65' AND '85') ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0039_a'); ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  

    }
}

?>
