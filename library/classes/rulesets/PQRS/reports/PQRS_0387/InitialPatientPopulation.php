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
 
class PQRS_0387_InitialPatientPopulation extends PQRSFilter
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
" JOIN billing AS b2 ON (b2.pid = b1.pid)".
" WHERE b1.pid = ? ".
" AND fe.provider_id = '".$this->_reportOptions['provider']."'".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND b1.code = 'G9518'".
" AND NOT  b2.code = 'B18.2' ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ 
			$query =
			"SELECT COUNT(b1.code) as count ".  
			"  FROM billing AS b1". 
			" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
			" WHERE b1.pid = ? ".
    		" AND fe.provider_id = '".$this->_reportOptions['provider']."'".
			" AND fe.date >= '".$beginDate."' ".
			" AND fe.date <= '".$endDate."' ".
			" AND b1.code IN('G0438','G0439') ; ";
			
			$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 
			if ($result['count']> 0){ return true;}}
			 else {
	 				$query =
					"SELECT COUNT(b1.code) as count ".  
					" FROM billing AS b1". 
					" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
					" WHERE b1.pid = ? ".
    				" AND fe.provider_id = '".$this->_reportOptions['provider']."'".
					" AND fe.date >= '".$beginDate."' ".
					" AND fe.date <= '".$endDate."' ".
					" AND b1.code IN( '99201', '99202', '99203', '99204', '99205', '99212','99213', '99214', '99215', '99304', '99305', '99306', '99307', '99308', '99309', '99310', '99324', '99325', '99326', '99327','99328', '99334', '99335', '99336', '99337', '99341', '99342', '99343', '99344', '99345', '99347', '99348', '99349', '99350') ; ";
					
					$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 
					if ($result['count']> 2){ return true;} else{return false; } } 

    }

}
?>
