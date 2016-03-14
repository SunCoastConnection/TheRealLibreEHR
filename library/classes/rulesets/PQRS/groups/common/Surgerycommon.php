<?php
/**
 * PQRS Surgery Group 
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

$Surgery =
"SELECT COUNT(b1.code)". 
"  FROM billing AS b1".  
"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
"JOIN patient_data AS p ON (b1.pid = p.pid)". 
"WHERE b1.pid = '$patient' ".  
"AND b1.code IN".  
"('19101', ' 19301', ' 19302', ' 19303', ' 19304', '19305', ' 19306', ' 19307', ' 36818', ' 36819', ' 36820', ' 36821', ' 36825', ' 36830', ' 43644', ' 43645', ' 43775', ' 43846', ' 43847 ', '44140', ' 44141', ' 44143', ' 44144', ' 44145', ' 44146', ' 44147', ' 44150', ' 44151', ' 44160', ' 44204', ' 44205', ' 44206', ' 44207', ' 44208', ' 44210', ' 44950', ' 44960', ' 44970', ' 47562', ' 47563', ' 47564', ' 47600', ' 47605', ' 47610', ' 49560', ' 49561', ' 49565', ' 49566', ' 49572', ' 49585', ' 49587', ' 49590', ' 49652', ' 49653', ' 49654', ' 49655', ' 49656', ' 49657', ' 60200', ' 60210', ' 60212', ' 60220', ' 60225', ' 60240', ' 60252', ' 60254', ' 60260', ' 60270', ' 60271')".
"AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' ;";
?>
