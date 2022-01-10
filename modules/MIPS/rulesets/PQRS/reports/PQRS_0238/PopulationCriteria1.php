<?php
/**
 * PQRS Measure 0238 -- Population Criteria 1
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
 */
 
class PQRS_0238_PopulationCriteria1 implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_0238_InitialPatientPopulation1();
    }
    
    public function createNumerators()
    {
        return new PQRS_0238_Numerator1();
    }
    
    public function createDenominator()
    {
        return new PQRS_0238_Denominator1();
    }
    
    public function createExclusion()
    {
        return new PQRS_0238_Exclusion1();
    }
    
    public function createHardFail()
    {
        return new PQRS_0238_HardFail1();
    }
}

?>
