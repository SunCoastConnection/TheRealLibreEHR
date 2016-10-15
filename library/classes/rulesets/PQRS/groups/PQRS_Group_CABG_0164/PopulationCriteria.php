<?php
/**
 * PQRS Measure Group_CABG_0164 -- Population Criteria
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_CABG_0164_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_Group_CABG_0164_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_Group_CABG_0164_Numerator();
    }
    
    public function createDenominator()
    {
        return new PQRS_Group_CABG_0164_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_Group_CABG_0164_Exclusion();
    }
}

?>

