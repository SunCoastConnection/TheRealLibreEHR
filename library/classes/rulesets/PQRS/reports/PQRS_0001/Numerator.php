<?php
/*
 * PQRS Measure 0001 -- Numerator
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
"SELECT COUNT(b.code) as count ".  
"FROM billing AS b ".
"JOIN form_encounter AS fe ON (b.encounter = fe.encounter) ".
"WHERE b.pid = ? ".
"AND YEAR(`fe`.`date`) = YEAR(?) ".  
"AND b.code = '3046F';"; 

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id, $beginDate)));
if ($result['count'] > 0){ return true;} else {return false;}  
	
    }
}

?>
