<?php
/**
 * PQRS Measure 0022 -- Numerator
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
 * @link    http://www.open-emr.org
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 */
 
class PQRS_0022_Numerator implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
		    $query =
"SELECT COUNT(b1.code) as count ".  
"  FROM billing AS b1".
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
"INNER JOIN billing AS b2 ON (b2.pid = b1.pid)".  
"WHERE b1.pid = ?  ".
"AND YEAR(fe.date) =? ".
"AND ".
"((b1.code = '4049F' AND b1.modifier !='8P') AND b2.code= '4046F'); ";

$result = sqlFetchArray(sqlStatementNoLog($query),array($patient->id), $beginDate); 

if ($result > 0){ return true;} else {return false;}     
	
    }
}

?>
