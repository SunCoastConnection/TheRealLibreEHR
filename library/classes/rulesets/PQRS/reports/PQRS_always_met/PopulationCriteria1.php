<?php
// Copyright (C) 2011 Ken Chapple <ken@mi-squared.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
class PQRS_always_met_PopulationCriteria1 implements PQRSPopulationCrtiteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria 1";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_always_met_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_always_met_Numerator1();
    }
    
    public function createDenominator()
    {
        return new PQRS_always_met_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_always_met_Exclusion();
    }
}
