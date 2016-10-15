<?php
/**
 * PQRS Measure 0400 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0400_InitialPatientPopulation implements PQRSFilterIF
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
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" INNER JOIN billing as b3 ON (b3.pid =b1.pid)".
" JOIN billing AS b4 ON (b4.pid = b1.pid)".
" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
" INNER JOIN pqrs_efcc AS codelist_c ON (b3.code = codelist_c.code)".

" WHERE b1.pid = ? ".
" AND fe.date BETWEEN ('".$beginDate."' AND '".$endDate."') ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >=18 ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0400_a')".
" AND ( (YEAR(p.DOB) BETWEEN 1945 AND 1965 ) OR b3.code  = codelist_c.code AND codelist_c.type = 'pqrs_0400_c')".
" AND NOT (b4.code = 'B18.2' ) ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else { 

$query =
"SELECT COUNT(b1.code) as count ".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" INNER JOIN billing as b3 ON (b3.pid =b1.pid)".
" JOIN billing AS b4 ON (b4.pid = b1.pid)".
" INNER JOIN pqrs_efcc AS codelist_b ON (b1.code = codelist_b.code)".
" INNER JOIN pqrs_efcc AS codelist_c ON (b3.code = codelist_c.code)".

" WHERE b1.pid = ? ".
" AND fe.date BETWEEN ('".$beginDate."' AND '".$endDate."') ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >=18 ".
" AND (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0400_b')".
" AND ( (YEAR(p.DOB) BETWEEN 1945 AND 1965 ) OR b3.code  = codelist_c.code AND codelist_c.type = 'pqrs_0400_c')".
" AND NOT (b4.code = 'B18.2' ) ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 1){ return true;} else {return false;}  
}

    }
}
/*This measure is to be reported a minimum of once per reporting period for all patients with one or more of the
following: a history of injection drug use, receipt of a blood transfusion prior to 1992, receiving maintenance
hemodialysis OR birthdate in the years 1945–1965 seen during the reporting period AND who were seen twice for
any visits or who had at least one preventive care visit within the 12 month reporting period. This measure may be
reported by clinicians who perform the quality actions described in the measure based on the services provided and
the measure-specific denominator coding*/
?>
