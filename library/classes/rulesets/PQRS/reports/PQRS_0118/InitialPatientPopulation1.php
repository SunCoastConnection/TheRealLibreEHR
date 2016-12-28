<?php
/**
 * PQRS Measure 0118 -- Initial Patient Population 1
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0118_InitialPatientPopulation1 extends PQRSFilter
{
    public function getTitle() 
    {
        return "Initial Patient Population 1";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	       
    
		$query =
		"SELECT COUNT(b1.code) as count ".  
		"  FROM billing AS b1". 
		" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
		" JOIN patient_data AS p ON (p.pid = b1.pid)".
		" WHERE b1.pid = ? ".
		" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
		" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ".
		" AND b1.code = 'G8934' ;";
		
		$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
			if ($result['count']> 0){  
	
	    
				$query =
				"SELECT COUNT(b1.code) as count ".  
				" FROM billing AS b1". 
				" INNER JOIN pqrs_efcc AS codelist_b ON (b1.code = codelist_b.code)".
				" WHERE b1.pid = ? ".
				" AND (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0118_b');";
				
				$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
				if ($result['count']> 0){

							$query =
							"SELECT COUNT(b1.code) as count ".  
							" FROM billing AS b1". 
							" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
							" WHERE b1.pid = ? ".
							" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0118_a');";
							
							$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
							if ($result['count']> 1){ return true;} else {return false;}  
						}			
			 } else {return false;}  
    }
}

?>
