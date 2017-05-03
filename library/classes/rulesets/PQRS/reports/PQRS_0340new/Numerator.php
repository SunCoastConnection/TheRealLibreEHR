<?php
/**
 * PQRS Measure Group_HIVAIDS_0340 -- Numerator
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/
//NOTE:  This measure requires two visits in each 6 month period separated by a
//60 day period, but the test calls for a G code that indicates this status, not a calculation.
//If desired, a different calculation can be done with  fe.date >= DATE_SUB('".$endDate."', INTERVAL 6 MONTH) etc..
//and looking for the result as any encounter set.
class PQRS_Group_HIVAIDS_0340_Numerator extends PQRSFilter
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
" SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND b1.code = 'G9247' ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));

if ($result['count'] > 0){ return true;} else {return false;}    			
    }
}

?>

