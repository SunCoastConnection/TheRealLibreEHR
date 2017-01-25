<?php
/**
 * PQRS Measure Group_CP_438 -- Denominator 
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_Group_CP_0438_Denominator extends PQRSFilter
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	$counted=0;	    
	$query =
	"SELECT COUNT(b1.code) as count ".  
	" FROM billing AS b1". 
	" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
	" JOIN patient_data AS p ON (p.pid = b1.pid)".
	" WHERE b1.pid = ? ".
	" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
	" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >='21'  ".
	" AND b1.code IN('G9662','G9663') ; ";
	
	$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
	if ($result['count']> 0){ $counted=1;}
							else{	    
								    
							$query =
							"SELECT COUNT(b1.code) as count ".  
							" FROM billing AS b1". 
							" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
							" JOIN patient_data AS p ON (p.pid = b1.pid)".
							" JOIN billing AS b2 ON (b2.pid = b1.pid)".
							" INNER JOIN pqrs_efcc5 AS codelist_a ON (b2.code = codelist_a.code)".
							" WHERE b1.pid = ? ".
							" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
							" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) BETWEEN '40' AND '75'  ".
							" AND b1.code = 'G9666' ".
							" AND (b2.code = codelist_a.code AND codelist_a.type = 'pqrs_0438_b');";
							
							$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
							if ($result['count']> 0){ $counted=1;} else {$counted=0;} }	    
	    
	    	    
	    
	if ($counted==1){ return true;} else {return false;} 

	}

   
}

?>
