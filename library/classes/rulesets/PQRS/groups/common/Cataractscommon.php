<?php
/**
 * PQRS Cataracts Group 
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

$Cataracts =
"SELECT COUNT(b1.code)". 
"  FROM billing AS b1".  
"JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
"JOIN patient_data AS p ON (b1.pid = p.pid)". 
"WHERE b1.pid = '$patient' ".  
"AND b1.code IN".  
"('66840', ' 66850', ' 66852', ' 66920', ' 66930', ' 66940', ' 66983', ' 66984')".
"AND YEAR(fe.date) ='2015' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18'  ".  
"AND b1.modifier NOT IN ('55', '56') ;";
?>

