<?php
/**
 * pre Measure 0427 -- Population Criteria
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package PQRS_Gateway
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class pre_0427_PopulationCriteria implements prePopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new pre_0427_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new pre_0427_Numerator();
    }
    
    public function createDenominator()
    {
        return new pre_0427_Denominator();
    }
    
    public function createExclusion()
    {
        return new pre_0427_Exclusion();
    }
}

?>
