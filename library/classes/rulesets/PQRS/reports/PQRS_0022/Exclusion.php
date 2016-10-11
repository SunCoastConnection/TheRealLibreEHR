<?php
/**
 * PQRS Measure 0022 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */

class PQRS_0022_Exclusion implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) AS count".  ///just give us a number as a result of all this, counting how many results we get.
" FROM billing AS b1 ".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN billing AS b2 ON (b2.pid=b1.pid)".
" WHERE b1.pid = ? ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND ((b1.code = '4042F'AND b1.modifier ='')OR(b1.code = '4049F' AND b1.modifier ='1P' AND b2.code = '4046F')) " ;
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));  

if ($result['count'] > 0){ return true;} else {return false;}  
     
	    

    }
}
