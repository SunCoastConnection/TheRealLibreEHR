<?php
/**
 * PQRS Measure 0005 -- Exclusion 
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

class PQRS_0005_Exclusion implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Exclusion";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	    
	  $query =
"SELECT COUNT(b1.code) as count".  ///just give us a number as a result of all this, counting how many results we get.
" FROM billing AS b1 ".
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter) ".
"WHERE b1.pid = ? ".
"AND YEAR(fe.date) ='2016' ".
"AND b1.code = ('4010F') " .
"AND b1.modifier IN ('1P','2P','3P');";
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  
    

    }
}

?>
