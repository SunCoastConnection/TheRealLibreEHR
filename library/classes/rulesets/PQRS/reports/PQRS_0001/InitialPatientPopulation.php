<?php
/**
 * PQRS Measure 0001 -- Initial Patient Population
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
 
class PQRS_0001_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {

$query =

"SELECT COUNT(b1.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1".  //b1 is the first billing table alias to get the diagnosis as Dx. denominator
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  //b2 is the second billing table alias to get the procedure code (CPT4 or G code) as Tx. We are matching the Patient ID (PID).  denominator
"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".  //fe is the alias of form_encounter that gets the date of service for the Tx
"JOIN patient_data AS p ON (b1.pid = p.pid)".  //We join the patient_data table to check the patient's age.

"WHERE b1.pid = '$patient' ".  ///only check for current patient, which is matched on the PID
"AND b1.code IN".  //Diagnosis must match one of the following
"('250.00','250.01','250.02','250.03','250.10','250.11','250.12','250.13','250.20','250.21',".
" '250.22','250.23','250.30','250.31','250.32','250.33','250.40','250.41','250.42','250.43','250.50',".
" '250.51','250.52','250.53','250.60','250.61','250.62','250.63','250.70','250.71','250.72','250.73',".
" '250.80','250.81','250.82','250.83','250.90','250.91','250.92','250.93','357.2','362.01','362.02',".
" '362.03','362.04','362.05','362.06','362.07','366.41','648.00','648.01','648.02','648.03','648.04',".
" 'E10.10','E10.11','E10.21','E10.22','E10.29','E10.311','E10.319','E10.321','E10.329','E10.331',".
" 'E10.339','E10.341','E10.349','E10.351','E10.359','E10.36','E10.39','E10.40','E10.41','E10.42',".
" 'E10.43','E10.44','E10.49','E10.51','E10.52','E10.59','E10.610','E10.618','E10.620','E10.621',".
" ' E10.622','E10.628','E10.630','E10.638','E10.641','E10.649','E10.65','E10.69','E10.8','E10.9',".
" 'E11.00','E11.01','E11.21','E11.22','E11.29','E11.311','E11.319','E11.321','E11.329','E11.331',".
" 'E11.339','E11.341','E11.349','E11.351','E11.359','E11.36','E11.39','E11.40','E11.41','E11.42',".
" 'E11.43','E11.44','E11.49','E11.51','E11.52','E11.59','E11.610','E11.618','E11.620','E11.621',".
" 'E11.622','E11.628','E11.630','E11.638','E11.641','E11.649','E11.65','E11.69','E11.8','E11.9',".
" 'O24.011','O24.012','O24.013','O24.019','O24.02','O24.03','O24.111','O24.112','O24.113',".
" 'O24.119','O24.12','O24.13')"
."AND YEAR(fe.date) ='2015' "
."AND TIMESTAMPDIFF(YEAR,p.dob,fe.date)  BETWEEN '18' AND '75' ".  //age must be between 18 and 75 on the date of treatment
."AND b2.code IN".  //Procedure code must match one of the following
"('97802','97803','97804','99201','99202','99203','99204','99205','99211',99212','99213','99214','99215',".
" '99217','99218','99219','99220','99221','99222','99223','99231','99232','99233','99238','99239','99281',".
" '99282','99283','99284','99285','99291','99304','99305','99306','99307','99308','99309','99310','99315',".
" '99316','99318','99324','99325','99326','99327','99328','99334','99335','99336','99337','99341','99342',".
" '99343','99344','99345','99347','99348','99349','99350','G0270','G0271','G0402','G0438','G0439');";

$result = sqlStatement($query);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ return true;} else {return false;}  //there is a better way of stating this, but this is easier to understand for N00bs


    }
}

?>
