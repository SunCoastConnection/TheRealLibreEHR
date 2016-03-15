<?php
/**
 * PQRS Measure Group_Dementia_0288 -- Population Criteria
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @package OpenEMR
 * @link    http://www.oemr.org
 * @link    http://suncoastconnection.com
 * @author  Suncoast Connection
*/

class PQRS_Group_Dementia_0288_PopulationCriteria implements PQRSPopulationCriteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_Group_Dementia_0288_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new PQRS_Group_Dementia_0288_Numerator();
    }
    
    public function createDenominator()
    {
        return new PQRS_Group_Dementia_0288_Denominator();
    }
    
    public function createExclusion()
    {
        return new PQRS_Group_Dementia_0288_Exclusion();
    }
}

?>

