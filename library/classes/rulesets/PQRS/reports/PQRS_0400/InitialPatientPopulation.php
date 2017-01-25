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
 
class PQRS_0400_InitialPatientPopulation extends PQRSFilter
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
	" WHERE b1.pid = ? ".
    " AND fe.provider_id = '".$this->_reportOptions['provider']."'".
" AND  b1.code = 'B18.2' ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']== 0){  

	$query =
	"SELECT COUNT(b1.code) as count ".  
	" FROM billing AS b1".
	" JOIN patient_data AS p ON (p.pid = b1.pid)". 
	" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
		" WHERE b1.pid = ? ".
    " AND fe.provider_id = '".$this->_reportOptions['provider']."'".
	" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
	" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >=18 ".
	" AND b1.code IN('90951', '90952', '90953', '90954', '90955',".
	" '90956', '90957','90958', '90959', '90960', '90961', '90962',".
	" '90963', '90964', '90965', '90966', '90967', '90968', '90969',".
	" '90970','G9448','G9449') ; ";
	$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;}else{return false;}
	
  
}else{return false;}

    }
}

?>
