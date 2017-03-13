<?php
/**
 * pre Measure 0118 -- Initial Patient Population 2
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class pre_0118_InitialPatientPopulation2 extends preFilter
{
    public function getTitle() 
    {
        return "Initial Patient Population 2";
    }
    
    public function test( prePatient $patient, $beginDate, $endDate )
    {
 return false;
    }
}

?>
