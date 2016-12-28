<?php
/**
 * PQRS Measure Group_IBD_0274 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_IBD_0274_InitialPatientPopulation extends PQRSFilter
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
require(__DIR__."/../common/IBDcommon.php");
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 
if ($result['count']> 0){ return true;} else {return false;}  
    }
}

?>

