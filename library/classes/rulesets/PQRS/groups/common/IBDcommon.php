<?php
/*
 * PQRS IBD Group 
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

$IBD =
"SELECT COUNT(b1.code)". 
"  FROM billing AS b1".  
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  

"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
"JOIN patient_data AS p ON (b1.pid = p.pid)". 
"WHERE b1.pid = '$patient' ".  
"AND b1.code IN".  
"('555.0', '555.1', '555.2', '555.9', '556.0', '556.1', '556.2', '556.3', '556.4', '556.5', '556.6', '556.8', '556.9', 'K50.00', 'K50.011', 'K50.012', 'K50.013', 'K50.014', 'K50.018', 'K50.019', 'K50.10', 'K50.111', 'K50.112', 'K50.113', 'K50.114', 'K50.118', 'K50.119', 'K50.80', 'K50.811', 'K50.812', 'K50.813', 'K50.814', 'K50.818', 'K50.819', 'K50.90', 'K50.911', 'K50.912', 'K50.913', 'K50.914', 'K50.918', 'K50.919', 'K51.00', 'K51.011', 'K51.012', 'K51.013', 'K51.014', 'K51.018', 'K51.019', 'K51.20', 'K51.211', 'K51.212', 'K51.213', 'K51.214', 'K51.218', 'K51.219', 'K51.30', 'K51.311', 'K51.312', 'K51.313', 'K51.314', 'K51.318', 'K51.319', 'K51.40', 'K51.411', 'K51.412', 'K51.413', 'K51.414', 'K51.418', 'K51.419', 'K51.50', 'K51.511', 'K51.512', 'K51.513', 'K51.514', 'K51.518', 'K51.519', 'K51.80', 'K51.811', 'K51.812', 'K51.813', 'K51.814', 'K51.818', 'K51.819', 'K51.90', 'K51.911', 'K51.912', 'K51.913', 'K51.914', 'K51.918', 'K51.919')".
"AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  ".  
"AND b2.code IN". 
"('99201', '99202', '99203', '99204', '99205', '99212', '99213', '99214', '99215', '99341', '99342', '99343', '99344', '99345', '99347', '99348', '99349', '99350', '99406', '99407');";
?>

 