<?php
/*
 * PQRS COPD Group 
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

$COPD =
"SELECT COUNT(b1.code)". 
"  FROM billing AS b1".  
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  

"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
"JOIN patient_data AS p ON (b1.pid = p.pid)". 
"WHERE b1.pid = '$patient' ".  
"AND b1.code IN".  
"('491.0', '491.1', '491.20', '491.21', '491.22', '491.8', '491.9', '492.0', '492.8', '493.20', '493.21', '493.22', '496', 'J41.0', 'J41.1', 'J41.8', 'J42', 'J43.0', 'J43.1', 'J43.2', 'J43.8', 'J43.9', 'J44.0', 'J44.1', 'J44.9')".
"AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  ".  
"AND b2.code IN". 
"('99201','99202','99203','99204','99205','99212','99213','99214','99215');";
?>
