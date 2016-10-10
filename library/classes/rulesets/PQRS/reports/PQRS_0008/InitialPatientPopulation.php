<?php
/**
 * PQRS Measure 0008 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0008_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$Dx1= 	"( '402.01', '402.11', '402.91', '404.01', '404.03', '404.11', '404.13', '404.91', '404.93',".
" '428.0', '428.1', '428.20', '428.21', '428.22', '428.23', '428.30', '428.31', '428.32', '428.33', '428.40',".
 " '428.41', '428.42', '428.43', '428.9', 'I11.0', 'I13.0', 'I13.2', 'I50.1', 'I50.20', 'I50.21', 'I50.22', 'I50.23',".
  " 'I50.30', 'I50.31', 'I50.32', 'I50.33', 'I50.40', 'I50.41', 'I50.42', 'I50.43', 'I50.9' )";  
$Tx1=   "( '99201', '99202', '99203', '99204', '99205', '99212', '99213', '99214', '99215', '99304',".
 " '99305', '99306', '99307', '99308', '99309', '99310', '99324', '99325', '99326', '99327', '99328', '99334',".
 " '99335', '99336', '99337', '99341', '99342', '99343', '99344', '99345', '99347', '99348', '99349', '99350' )";
$Tx2 = "( '99238', '99239' )";

$query1 =
"SELECT COUNT(b1.code) as count ". 
"  FROM billing AS b1".  
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid)". 
" INNER JOIN billing AS b3 ON (b1.pid = b3.pid)".
" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".  
" JOIN patient_data AS p ON (b1.pid = p.pid)".  
" WHERE b1.pid = ? ". 
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' ".  
" AND b1.code IN $Dx1".
" AND b2.code IN   $Tx1" .
" AND b3.code ='G8923' ";  

$query2 =
"SELECT COUNT(b1.code) as count ". 
"  FROM billing AS b1". 
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  
" INNER JOIN billing AS b3 ON (b1.pid = b3.pid)".
" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".  
" JOIN patient_data AS p ON (b1.pid = p.pid)".  
" WHERE b1.pid = ? ".  
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' ".  
" AND b1.code IN $Dx1".
" AND b2.code IN $Tx2" .
" AND b3.code ='3021F'; ";  
$result = sqlFetchArray(sqlStatementNoLog($query1, array($patient->id)));
if ($result['count']> 1){ return true;} 
	 else{
		 $result = sqlFetchArray(sqlStatementNoLog($query2, array($patient->id), $beginDate, $endDate));
		 if ($result['count']> 0){
			 return true;}else{
								return false;}  
			}
    }
}

?>
