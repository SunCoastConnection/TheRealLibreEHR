<?php
/**
 * PQRS Measure Group_Asthma_0053 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_Asthma_0053_Exclusion implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
		"SELECT COUNT(b1.code) as count ".  
		" FROM billing AS b1". 
		" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
		" JOIN patient_data AS p ON (p.pid = b1.pid)".
		" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
		" WHERE b1.pid = ? ".
		" AND b1.code = '1039F';";
		
		$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
			if ($result['count']> 0){ return true;}else{ 
	
	    
				$query =
				" SELECT COUNT(b1.code) as count ".  
				" FROM billing AS b1".
				" JOIN billing AS b2 ON (b2.pid = b1.pid)".
				" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
				" WHERE b1.pid = ? ".
				" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
				" AND b1.code = '1038F' AND b2.code ='4140F' AND b2.modifier ='2P';";
				
				$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
				if ($result['count']> 0){ return true;} else {return false;}  
						}  
    }
}

?>

