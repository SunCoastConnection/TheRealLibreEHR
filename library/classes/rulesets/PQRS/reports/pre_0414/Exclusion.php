<?php
/**
 * pre Measure 0414 -- Exclusion 
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package PQRS_Gateway
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */

class pre_0414_Exclusion extends preFilter
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( prePatient $patient, $beginDate, $endDate )
    {
       	// Default return 
        return false;
    }
}

?>
