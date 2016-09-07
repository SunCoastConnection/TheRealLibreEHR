<?php
/**
 * PQRS Measure 0005 -- Initial Patient Population 2
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
 
class PQRS_0005_InitialPatientPopulation2 implements PQRSFilterIF
{
/*      Measure #5 (NQF 0081): Heart Failure (HF): Angiotensin-Converting
Enzyme (ACE) Inhibitor or Angiotensin Receptor Blocker (ARB) Therapy
for Left Ventricular Systolic Dysfunction (LVSD) 
*/
/*      DESCRIPTION: Percentage of patients aged 18 years and older with a
diagnosis of heart failure (HF) with a current or prior left ventricular
ejection fraction (LVEF) < 40% who were prescribed ACE inhibitor or
ARB therapy either within a 12 month period when seen in the outpatient
setting OR at each hospital discharge 
*/
/*      INSTRUCTIONS: This measure is to be reported for all heart
failure patients a minimum of once per reporting period when seen in
the outpatient setting AND reported at each hospital discharge (99238*
and 99239*) during the reporting period.
        *NOTE: When reporting CPT code 99238 and 99239, it is recommended the measure be reported each time the code is submitted for hospital discharge.
*/

    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	    
	 $query =
"SELECT COUNT(b1.code) as count ". 
" FROM billing AS b1". 
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid)". 
" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)". 
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ". 
" AND b1.code IN". 
"('402.01','402.11','402.91','404.01','404.03','404.11','404.13','404.91','404.93','428.0','428.1','428.20',".
" '428.21','428.22','428.23','428.30','428.31','428.32','428.33','428.40','428.41','428.42','428.43','428.9',".
" 'I11.0','I13.0','I13.2','I50.1','I50.20','I50.21','I50.22','I50.23','I50.30','I50.31','I50.32','I50.33','I50.40',".
" 'I50.41','I50.42','I50.43','I50.9')".
" AND fe.date >=? ".
" AND fe.date <=? ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  ".  
"AND b2.code IN". 
"('99238','99239');";


$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id), $beginDate, $endDate));
if ($result['count']> 1){ return true;} else {return false;}  
	    

    }
}

?>
