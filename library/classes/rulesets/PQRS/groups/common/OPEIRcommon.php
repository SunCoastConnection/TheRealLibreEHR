<?php
/**
 * PQRS OPEIR Group 
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

$query =
"SELECT COUNT(b1.code) as count". 
"  FROM billing AS b1".  
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ".  
" AND b1.code IN".  
"('70450', ' 70460', ' 70470', ' 70480', ' 70481', ' 70482', ' 70486', ' 70487', ' 70488', ' 70490', ' 70491', ' 70492', ' 70496', ' 70498', ' 71250', ' 71260', ' 71270', ' 71275', ' 72125', ' 72126', ' 72127', ' 72128', ' 72129', ' 72130', ' 72131', ' 72132', ' 72133', ' 72191', ' 72192', ' 72193', ' 72194', ' 73200', ' 73201', ' 73202', ' 73206', ' 73700', ' 73701', ' 73702', ' 73706', ' 74150', ' 74160', ' 74170', ' 74174', ' 74175', ' 74176', ' 74177', ' 74178', ' 74261', ' 74262', ' 75571', ' 75572', ' 75573', ' 75574', ' 75635', ' 76380', ' 76497', ' 77011', ' 77013', ' 77078', ' 78072')".
" AND YEAR(fe.date) ='2016' ;";
?>
