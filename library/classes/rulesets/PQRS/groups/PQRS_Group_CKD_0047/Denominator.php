<?php
/**
 * PQRS Measure Group_CKD_0047 -- Denominator 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_CKD_0047_Denominator implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.pid) as count ".  
" FROM  patient_data AS p ON (p.pid = ?)".
" WHERE TIMESTAMPDIFF(YEAR,p.DOB,'".$endDate."') >='65'; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  
    }
}

?>

