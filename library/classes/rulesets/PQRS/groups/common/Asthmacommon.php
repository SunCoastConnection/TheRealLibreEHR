<?php
/**
 * PQRS Asthma Group 
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

$Asthma =
"SELECT COUNT(b1.code)". 
"  FROM billing AS b1".  
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  

"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
"JOIN patient_data AS p ON (b1.pid = p.pid)". 
"WHERE b1.pid = '$patient' ".  
"AND b1.code IN".  
"('493.00', '493.01', '493.02', '493.10', '493.11', '493.12', '493.20', '493.21', '493.22', '493.81', '493.82', '493.90', '493.91', '493.92', 'J45.20', 'J45.21', 'J45.22', 'J45.30', 'J45.31', 'J45.32', 'J45.40', 'J45.41', 'J45.42', 'J45.50', 'J45.51', 'J45.52', 'J45.901', 'J45.902', 'J45.909', 'J45.990', 'J45.991', 'J45.998')".
"AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '5'  ".  
"AND b2.code IN". 
"('99201','99202','99203','99204','99205','99212','99213','99214','99215','99341');";
?>
