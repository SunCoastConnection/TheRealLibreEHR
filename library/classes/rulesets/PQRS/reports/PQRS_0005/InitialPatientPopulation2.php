<?php
/*
 * PQRS Measure 0005 -- Population Criteria 2
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0005_InitialPatientPopulation2 implements PQRSFilterIF
{


    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	    
	 $query =
$query =
"SELECT COUNT(b1.code) as count ". 
" FROM billing AS b1 ".  
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid) ".  
" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".  
" JOIN patient_data AS p ON (b1.pid = p.pid)".  
" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
" INNER JOIN pqrs_efcc AS codelist_b ON (b2.code = codelist_c.code)".
" WHERE b1.pid = ? ". 
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  ". 
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0005_a') ".
" AND (b2.code = codelist_c.code AND codelist_c.type = 'pqrs_0005_c') ;";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 1){ return true;} else {return false;}  
	    

    }
}

?>
