<?php
/**
 * PQRS Measure Group_HIVAIDS_0134 -- Population Criteria
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_HIVAIDS_0134_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_Group_HIVAIDS_0134_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_Group_HIVAIDS_0134_Numerator();
    }
    
    public function createDenominator()
    {
        return new PQRS_Group_HIVAIDS_0134_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_Group_HIVAIDS_0134_Exclusion();
    }
}

?>

