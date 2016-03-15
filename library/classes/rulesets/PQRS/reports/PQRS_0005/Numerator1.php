<?php
/**
 * PQRS Measure 0005 -- Numerator 1
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
 
class PQRS_0005_Numerator1 implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	    
	  $query =
"SELECT COUNT(b.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b".
"JOIN form_encounter AS fe ON (b.encounter = fe.encounter)".
"WHERE b.pid = '$Patient' ".
"AND b.user = '$Provider' ".
"AND YEAR(fe.date) ='2015' ".
"AND CONCAT(b.code,b.modifier) = ('4010F');" ;//checking for CPT2 code with modifier. 8P modifier is a fail
$result = sqlStatement($query);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ return true;} else {return false;}  //there is a better way of stating this, but this is easier to understand for N00bs

    }
}

?>
