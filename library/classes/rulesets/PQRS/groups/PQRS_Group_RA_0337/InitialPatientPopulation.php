<?php
/**
 * PQRS Measure Group_RA_0337 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_Group_RA_0337_InitialPatientPopulation extends PQRSFilter
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
require(__DIR__."/../common/RAcommon.php");
if ($counted == 1){
	$counted=0;
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 
if ($result['count']> 0){ return true;} else {return false;} }else{return false;} 
    }
}

?>
