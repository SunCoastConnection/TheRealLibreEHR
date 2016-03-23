<?php
/**
 * PQRS Measure 0006 -- Denominator 
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
 
class PQRS_0006_Denominator implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	   $query =

"SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1".  
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  
" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".  
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ".  ///only check for current patient, which is matched on the PID
" AND b1.code IN".  //Diagnosis must match one of the following
" ('410.00','410.01','410.02','410.10','410.11','410.12','410.20','410.21','410.22','410.30','410.31','410.32',".
" '410.40','410.41','410.42','410.50','410.51','410.52','410.60','410.61','410.62','410.70','410.71','410.72',".
" '410.80','410.81','410.82','410.90','410.91','410.92','411.0','411.1','411.81','411.89','412','413.0','413.1',".
" '413.9','414.00','414.01','414.02','414.03','414.04','414.05','414.06','414.07','414.2','414.3','414.8','414.9',".
" 'V45.81','V45.82','I20.0','I20.1','I20.8','I20.9','I21.01','I21.02','I21.09','I21.11','I21.19','I21.21','I21.29','I21.3',".
" 'I21.4','I22.0','I22.1','I22.2','I22.8','I22.9','I24.0','I24.1','I24.8','I24.9','I25.10','I25.110','I25.111','I25.118',".
" 'I25.119','I25.2','I25.5','I25.6','I25.700','I25.701','I25.708','I25.709','I25.710','I25.711','I25.718','I25.719',".
" 'I25.720','I25.721','I25.728','I25.729','I25.730','I25.731','I25.738','I25.739','I25.750','I25.751','I25.758',".
" 'I25.759','I25.760','I25.761','I25.768','I25.769','I25.790','I25.791','I25.798','I25.799','I25.810','I25.811',".
" 'I25.812','I25.82','I25.83','I25.89','I25.9','Z95.1','Z95.5','Z98.61')".
" AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' ".
" AND b2.code IN". 
"('99201','99202','99203','99204','99205','99212','99213','99214','99215','99304','99305','99306','99307',".
" '99308','99309','99310','99324','99325','99326','99327','99328','99334','99335','99336','99337','99341',".
" '99342','99343','99344','99345','99347','99348','99349','99350');";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}  
 
    }
}

?>
