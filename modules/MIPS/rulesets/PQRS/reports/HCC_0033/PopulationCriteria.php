
<?php
/*
 * HCC Measure HCC_0033 -- Population Criteria
 *
 * Copyright (C) 2018      Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the Libre.io community.
 */
 
class HCC_0033_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new HCC_0033_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new HCC_0033_Numerator();
    }
    
    public function createDenominator()
    {
        return new HCC_0033_Denominator();
    }
    
    public function createExclusion()
    {
        return new HCC_0033_Exclusion();
    }
}

?>

