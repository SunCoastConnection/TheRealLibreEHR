<?php
/*
 * PQRS Measure 0387 -- Initial Patient Population
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
 
class PQRS_0387_InitialPatientPopulation implements PQRSFilterIF
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
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" JOIN billing AS b2 ON (b2.pid = b1.pid)".

" INNER JOIN pqrs_ecc AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN pqrs_ecc AS codelist_c ON (b2.code = codelist_c.code)".

" WHERE b1.pid = '$patient' ".
" AND YEAR(fe.date) ='2015' ".

" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0387_a')".
" AND NOT (codelist_b.type = 'pqrs_0387_c' AND b2.code = codelist_c.code) ; ";

$result = sqlStatement($query);
if ($result > 0){ return true;}
 else {
	$query =
"SELECT COUNT(b1.code)".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" JOIN billing AS b2 ON (b2.pid = b1.pid)".

" INNER JOIN pqrs_ecc AS codelist_b ON (b1.code = codelist_b.code)".
" JOIN pqrs_ecc AS codelist_c ON (b2.code = codelist_c.code)".

" WHERE b1.pid = '$patient' ".
" AND YEAR(fe.date) ='2015' ".

" AND (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0387_b')".
" AND NOT (b2.code = codelist_c.code AND codelist_b.type = 'pqrs_0387_c') ; ";

$result = sqlStatement($query); 
if ($result > 1){ return true;}
 		else {return false;}  
	 }  

    }
}
?>
