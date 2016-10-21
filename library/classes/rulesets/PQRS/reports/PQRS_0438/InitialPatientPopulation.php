<?php
/**
 * PQRS Measure 0438 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_0438_InitialPatientPopulation implements PQRSFilterIF
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
"  JOIN billing AS b2 ON (b2.pid = b1.pid)".
"  JOIN billing AS b3 ON (b3.pid = b1.pid)".
"  JOIN billing AS b4 ON (b4.pid = b1.pid)".
" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN pqrs_efcc AS codelist_b ON (b2.code = codelist_b.code)".
" JOIN pqrs_efcc AS codelist_c ON (b3.code = codelist_c.code)".
" JOIN pqrs_efcc AS codelist_d ON (b4.code = codelist_d.code)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND ((TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '21' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0438_a')".
" AND (b2.code = codelist_b.code AND codelist_b.type = 'pqrs_0438_b' ))".
" OR (TIMESTAMPDIFF(YEAR,p.DOB,fe.date) BETWEEN '45' AND '75' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0438_a')".
" AND (b3.code = codelist_c.code AND codelist_c.type = 'pqrs_0438_c' ) ".
" AND (b4.code = codelist_b.code AND codelist_d.type = 'pqrs_0438_d' ))); ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  

    
    }
}

?>
