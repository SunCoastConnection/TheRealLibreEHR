<?php
/**
 * PQRS HF Group 
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

$HF =
"SELECT COUNT(b1.code)". 
"  FROM billing AS b1".  
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  

"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
"JOIN patient_data AS p ON (b1.pid = p.pid)". 
"WHERE b1.pid = '$patient' ".  
"AND b1.code IN".  
"('402.01','402.11','402.91','404.01','404.03','404.11','404.13','404.91','404.93','428.0','428.1','428.20',".
" '428.21','428.22','428.23','428.30','428.31','428.32','428.33','428.40','428.41','428.42','428.43','428.9',".
" 'I11.0','I13.0','I13.2','I50.1','I50.20','I50.21','I50.22','I50.23','I50.30','I50.31','I50.32','I50.33','I50.40',".
" 'I50.41','I50.42','I50.43','I50.9')"
."AND YEAR(fe.date) ='2015' "
." AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  "  
."AND b2.code IN". 
"('99201','99202','99203','99204','99205','99212','99213','99214','99215','99304','99305','99306','99307',".
" '99308','99309','99310','99324','99325','99326','99327','99328','99334','99335','99336','99337','99341','99342','99343','99344','99345','99347','99348','99349','99350');";
?>
