<?php
/**
 * PQRS Measure 0005 -- Population Criteria 2
 *
 * Copyright (C) 2016 Suncoast Connection
 * Suncoastconnection.com
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
 * @author  leebc
 * @author  Art Eaton
 * @link    http://Suncoastconnection.com
 * @link    http://www.oemr.org
 */
 
class PQRS_0005_PopulationCriteria2 implements PQRSPopulationCrtiteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria 2";
    }
    
    public function createInitialPatientPopulation()
    {
        return new PQRS_0005_InitialPatientPopulation2();
    }
    
    public function createNumerators()
    {
        return new PQRS_0005_Numerator2();
    }
    
    public function createDenominator()
    {
        return new PQRS_0005_Denominator();
	// Both varients use same Denominator
    }
    
    public function createExclusion()
    {
        return new PQRS_0005_Exclusion();
	// Both varients use same Exclusion
    }
}
?>
