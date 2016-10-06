<?php
/**
 * PQRS Measure 0423 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_0423_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
"FROM billing AS b1 ".
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter) ".
"WHERE b1.pid = ? ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".  
"AND b1.code ='35301';"; 

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count'] > 0){ return true;} else {return false;}  
    }
}

?>
