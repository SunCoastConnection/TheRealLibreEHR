<?php
/**
 * PQRS Measure 0387 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0387_InitialPatientPopulation implements PQRSFilterIF
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
" JOIN billing AS b2 ON (b2.pid = b1.pid)".

" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN pqrs_efcc AS codelist_c ON (b2.code = codelist_c.code)".

" WHERE b1.pid = ? ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".

" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0387_a')".
" AND NOT (codelist_c.type = 'pqrs_0387_c' AND b2.code = codelist_c.code) ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;}
 else {
	$query =
"SELECT COUNT(b1.code) as count ".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" JOIN billing AS b2 ON (b2.pid = b1.pid)".

" INNER JOIN pqrs_efcc AS codelist_b ON (b1.code = codelist_b.code)".
" JOIN pqrs_efcc AS codelist_c ON (b2.code = codelist_c.code)".

" WHERE b1.pid = ? ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".

" AND (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0387_b')".
" AND NOT (b2.code = codelist_c.code AND codelist_b.type = 'pqrs_0387_c') ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 
if ($result['count']> 1){ return true;}
 		else {return false;}  
	 }  

    }
}

?>
