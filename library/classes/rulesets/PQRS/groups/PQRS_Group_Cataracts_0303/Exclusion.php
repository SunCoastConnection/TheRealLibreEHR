<?php
/**
 * PQRS Measure Group_Cataracts_0303 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_Cataracts_0303_Exclusion implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
       	// Default return 
        return false;
    }
}

?>

