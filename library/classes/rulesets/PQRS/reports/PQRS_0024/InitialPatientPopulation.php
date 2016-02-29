<?php
/**
 * PQRS Measure 0024 -- Initial Patient Population
 *
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
 
class PQRS_0024_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code)".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)".
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".
" INNER JOIN pqrs_communication_and_care_coordination AS codelist_a ON (b1.code = codelist_a.code)".
" INNER JOIN pqrs_communication_and_care_coordination AS codelist_b ON (b1.code = codelist_b.code)".
" WHERE b1.pid = '$patient' ".
" AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '50' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0024_a') ".
" AND (b2.code = codelist_b.code AND codelist_a.type = 'pqrs_0024_b') ;";

$result = sqlStatement($query);
if ($result > 0){ return true;} else {return false;}  

    }
}
?>
