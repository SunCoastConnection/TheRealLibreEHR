<?php
/**
 * PQRS Measure Group_HepatitisC_0401 -- Denominator 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_HepatitisC_0401_Denominator extends PQRSFilter
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
 $query =
" SELECT COUNT(b1.code) AS count".  
" FROM billing AS b1".
" WHERE b1.pid = ? ".
" AND b1.code IN('K70.30', 'K70.31', 'K74.60', 'K74.69') ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 

if ($result['count']> 0){ return true;} else {return false;} 
    }
}

?>

