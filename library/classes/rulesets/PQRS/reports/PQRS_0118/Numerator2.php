<?php
/**
 * PQRS Measure 0118 -- Numerator 2
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
 
class PQRS_0118_Numerator2 implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
		    $query =
"SELECT COUNT(b.code)".  
"  FROM billing AS b".
"JOIN form_encounter AS fe ON (b.encounter = fe.encounter)".
"WHERE b.pid = '".$patient->id."' ".
"AND YEAR(fe.date) ='2015' ".
"AND b.code IN ('G8473','G8474');";

$result = sqlStatement($query); 

if ($result > 0){ return true;} else {return false;}     

	
    }
}

?>