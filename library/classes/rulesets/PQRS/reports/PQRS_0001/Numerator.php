<?php
/**
 * PQRS Measure 0001 -- Numerator
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
 
class PQRS_0001_Numerator implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	////////////////Check for numerator fail ( which is good!!!)////////////////////////////////
$query =
"SELECT COUNT(b.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b".
"JOIN form_encounter AS fe ON (b.encounter = fe.encounter)".
"WHERE b.pid = '$Patient' ".
"AND (YEAR(fe.date) =YEAR('.$beginDate.')) "  /// could be hard coded for 2015
."AND b.code IN ('3044F','3045F');"; //checking for CPT2 code.

$result = sqlStatement($query);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ return false;} else {return true;}  //there is a better way of stating this, but this is easier to understand for N00bs
	
    }
}
/*  NOTES FOR DIRECT ENTRY FORM:
This is an inverted measure.  The code.modifier sets below are verified pass (which is a failure to meet performance),
 and need to be reported in the direct entry form as SET, and not addendable.
$query_verify_documented_pass =
"SELECT COUNT(b.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b".
"JOIN form_encounter AS fe ON (b.encounter = fe.encounter)".
"WHERE b.pid = '$Patient' ".
"AND b.user = '$Provider' "
"AND (YEAR(fe.date) ='2015' ".
"AND CONCAT(b.code,b.modifier) IN ('3046F','3046F8P');" ;//checking for CPT2 code with modifier.
*/
?>
