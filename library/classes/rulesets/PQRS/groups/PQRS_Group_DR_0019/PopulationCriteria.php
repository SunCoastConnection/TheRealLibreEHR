<?php
/**
 * PQRS Measure Group_DR_0019 -- Population Criteria
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Suncoast Connection
 */
 
class PQRS_Group_DR_0019_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_Group_DR_0019_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_Group_DR_0019_Numerator();
    }
    
    public function createDenominator()
    {
        return new PQRS_Group_DR_0019_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_Group_DR_0019_Exclusion();
    }
}

?>
