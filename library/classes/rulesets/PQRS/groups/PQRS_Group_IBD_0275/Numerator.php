<?php
/**
 * PQRS Measure Group_IBD_0275 -- Numerator
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_IBD_0275_Numerator implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
" SELECT COUNT(b1.code) as count".  
" FROM billing AS b1".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN billing as b2 ON (b2.pid = b1.pid)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN ('".$beginDate."' AND '".$endDate."') ".
" AND ((b1.code = '4149F' AND b2.code = '3517F' AND b2.modifier ='') OR (b1.code IN ('G8869', 'G8870', 'G8871')) OR (b1.code ='3517F' AND b1.modifier = '2P')) ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));  

if ($result['count']> 0){ return true;} else {return false;}   		
    }
}

?>

