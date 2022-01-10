<?php
/**
 * PQRS Measure 0407 -- Population Criteria
 *
 * Copyright (C) 2015 - 2017      Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 *
 * @author  Suncoast Connection
 */
 
class PQRS_0407_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_0407_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_0407_Numerator();
    }
    
    public function createDenominator()
    {
        return new PQRS_0407_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_0407_Exclusion();
    }
    public function createHardFail()
    {
        return new PQRS_0407_HardFail();
    }
}

?>
