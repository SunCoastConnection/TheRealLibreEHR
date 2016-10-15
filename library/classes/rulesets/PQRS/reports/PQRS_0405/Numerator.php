<?php
/**
 * PQRS Measure 0405 -- Numerator
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_0405_Numerator implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN billing AS b2 ON (b2.pid = b1.pid)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN ('".$beginDate."' AND '".$endDate."') ".
" AND b1.code = 'G9547' AND b2.code = 'G9548'; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}
		
    }
}

?>
