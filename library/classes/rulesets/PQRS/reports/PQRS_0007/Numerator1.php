<?php
/**
 * PQRS measure 0007 -- Numerator 1
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
 
class PQRS_0007_Numerator1 implements PQRSFilterIF
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
"WHERE b.pid = '$Patient' ".
"AND b.user = '$Provider' ".
"AND YEAR(fe.date) ='2015' ".
"AND b.code IN ('G9189','G9190','G9191','G9192');";

$result = sqlStatement($query); 

if ($result > 0){ return true;} else {return false;}     

		
    }
}
?>
