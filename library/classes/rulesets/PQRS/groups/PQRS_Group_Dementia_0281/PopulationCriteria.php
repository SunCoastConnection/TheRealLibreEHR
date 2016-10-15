<?php
/**
 * PQRS Measure Group_Dementia_0281 -- Population Criteria
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_Dementia_0281_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_Group_Dementia_0281_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_Group_Dementia_0281_Numerator();
    }
    
    public function createDenominator()
    {
        return new PQRS_Group_Dementia_0281_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_Group_Dementia_0281_Exclusion();
    }
}

?>

