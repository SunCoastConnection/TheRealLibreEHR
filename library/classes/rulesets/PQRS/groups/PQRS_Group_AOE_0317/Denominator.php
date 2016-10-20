<?php
/**
 * PQRS Measure Group_AOE_0317 -- Denominator 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_AOE_0317_Denominator implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
 $query =
" SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,'".$endDate."') >='18'; ";
" AND fe.date BETWEEN ('".$beginDate."' AND '".$endDate."') ".
" AND b1.code IN ( 99201', '99202,".
"  '99203', '99204', '99205', '99212', '99213', '99214', '99215', '99304', '99305', '99306', '99307', '99308', '99309', '99310',".
"  '99324', '99325', '99326', '99327', '99328', '99334', '99335', '99336', '99341', '99342', '99343', '99344', '99345', '99347',".
"  '99348', '99349', '99350') ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));

if ($result['count'] > 0){ return true;} else {return false;}   
    }
}

?>

