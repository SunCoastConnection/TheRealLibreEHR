<?php
/**
 * PQRS Measure 0007 -- Initial Patient Population 1
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0008_InitialPatientPopulation1 implements PQRSFilterIF
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
" INNER JOIN pqrs_efcc AS codelist_b ON (b1.code = codelist_b.code)".
" WHERE b1.pid = ? ". 
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  ". 
" AND (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0008_b') ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 1){ 
			   $query =
		"SELECT COUNT(b1.code) as count ". 
		" FROM billing AS b1".
		" INNER JOIN billing AS b2 ON (b1.pid = b2.pid) ".   
		" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".  
		" JOIN patient_data AS p ON (b1.pid = p.pid)".
		" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".		
		" WHERE b1.pid = ? ". 
		" AND fe.date >= '".$beginDate."' ".
		" AND fe.date <= '".$endDate."' ".
		" AND b2.code = 'G8923';
		" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0008_a') ";   
		
		$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
		if ($result['count']> 0){ return true;}  
	
	} else {return false;}  
 
    }
}

?>