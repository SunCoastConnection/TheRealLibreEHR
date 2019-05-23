<?php
/**
 * pre Measure 0391 -- Population Criteria 1
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
 * Please support this product by sharing your changes with the Libre.io community.
 */
 
class pre_0391_PopulationCriteria1 implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new pre_0391_InitialPatientPopulation1();
    }
    
    public function createNumerators()
    {
        return new pre_0391_Numerator1();
    }
    
    public function createDenominator()
    {
        return new pre_0391_Denominator1();
    }
    
    public function createExclusion()
    {
        return new pre_0391_Exclusion1();
    }
}

?>