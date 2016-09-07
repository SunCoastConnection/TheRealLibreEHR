<?php
/**
 * PQRS Measure 0005 -- Denominator
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
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Art Eaton <art@starfrontiers.org>
 */
 
class PQRS_0005_Denominator implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	 $query =	    
		"SELECT COUNT(b1.code) as count ".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1 ".  //b1 is the first billing table alias to get the diagnosis as Dx. denominator
"  JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".  //fe is the alias of form_encounter that gets the date of service for the Tx
"  JOIN patient_data AS p ON (b1.pid = p.pid)".  //We join the patient_data table to check the patient's age.
"  WHERE b1.pid = ? ".  ///only check for current patient, which is matched on the PID
" AND fe.date >=? ".
" AND fe.date <=? ".
"  AND b1.code = '3021F';";  //CPT2 must match 
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id), $beginDate, $endDate));
if ($result['count']> 0){ return true;} else {return false;}  

    }
}

?>
