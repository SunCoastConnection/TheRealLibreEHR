<?php
/**
 * PQRS Measure 0400 -- Initial Patient Population
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
 
class PQRS_0400_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" INNER JOIN billing as b3 ON (b3.pid =b1.pid)".
" JOIN billing AS b4 ON (b4.pid = b1.pid)".
" INNER JOIN pqrs_poph AS codelist_a ON (b1.code = codelist_a.code)".
" INNER JOIN pqrs_poph AS codelist_c ON (b3.code = codelist_c.code)".
" JOIN pqrs_poph AS codelist_d ON (b4.code = codelist_d.code)".

" WHERE b1.pid = ? ".
" AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >=18 ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0400_a')".
" AND ( (YEAR(p.dob) BETWEEN 1945 AND 1965 ) OR b3.code  = codelist_c.code AND codelist_c.type = 'pqrs_0400_c')".
" AND NOT (b4.code = codelist_d.code AND codelist_d.type = 'pqrs_0400_d' ) ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else { 

$query =
"SELECT COUNT(b1.code) as count ".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" INNER JOIN billing as b3 ON (b3.pid =b1.pid)".
" JOIN billing AS b4 ON (b4.pid = b1.pid)".
" INNER JOIN pqrs_poph AS codelist_b ON (b1.code = codelist_b.code)".
" INNER JOIN pqrs_poph AS codelist_c ON (b3.code = codelist_c.code)".
" JOIN pqrs_poph AS codelist_d ON (b4.code = codelist_d.code)".

" WHERE b1.pid = ? ".
" AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >=18 ".
" AND (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0400_b')".
" AND ( (YEAR(p.dob) BETWEEN 1945 AND 1965 ) OR b3.code  = codelist_c.code AND codelist_c.type = 'pqrs_0400_c')".
" AND NOT (b4.code = codelist_d.code AND codelist_d.type = 'pqrs_0400_d' ) ; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 1){ return true;} else {return false;}  
}

    }
}
/*This measure is to be reported a minimum of once per reporting period for all patients with one or more of the
following: a history of injection drug use, receipt of a blood transfusion prior to 1992, receiving maintenance
hemodialysis OR birthdate in the years 1945–1965 seen during the reporting period AND who were seen twice for
any visits or who had at least one preventive care visit within the 12 month reporting period. This measure may be
reported by clinicians who perform the quality actions described in the measure based on the services provided and
the measure-specific denominator coding*/
?>
