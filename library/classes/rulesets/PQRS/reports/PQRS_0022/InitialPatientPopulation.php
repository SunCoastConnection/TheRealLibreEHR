<?php
/**
 * PQRS Measure 0022 -- Initial Patient Population
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
 
class PQRS_0022_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	require_once('PQRS_0022temptable.php');
	
$query =
"SELECT COUNT(b1.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1".  //b1 is the first billing table alias to get the diagnosis as Dx. denominator
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".  //fe is the alias of form_encounter that gets the date of service for the Tx
"JOIN patient_data AS p ON (b1.pid = p.pid)".  //We join the patient_data table to check the patient's age.
"INNER JOIN measure22codes AS temp ON (b1.code = temp.code)".  
"WHERE b1.pid = '$patient' ".  ///only check for current patient, which is matched on the PID
"AND YEAR(fe.date) ='2015' "
." AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' "  //age must be between 18 and 75 on the date of treatment
. "AND b1.code = temp.code;";

$result = sqlStatement($query);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ return true;} else {return false;}  //there is a better way of stating this, but this is easier to understand for N00bs
 
    }
}
