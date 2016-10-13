<?php
/**
 * PQRS Surgery Group 
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */

$query =
"SELECT COUNT(b1.code) as count". 
"  FROM billing AS b1".  
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ".  
" AND b1.code IN".  
"('19101', ' 19301', ' 19302', ' 19303', ' 19304', '19305', ' 19306', ' 19307', ' 36818', ' 36819', ' 36820', ' 36821', ' 36825', ' 36830', ' 43644', ' 43645', ' 43775', ' 43846', ' 43847 ', '44140', ' 44141', ' 44143', ' 44144', ' 44145', ' 44146', ' 44147', ' 44150', ' 44151', ' 44160', ' 44204', ' 44205', ' 44206', ' 44207', ' 44208', ' 44210', ' 44950', ' 44960', ' 44970', ' 47562', ' 47563', ' 47564', ' 47600', ' 47605', ' 47610', ' 49560', ' 49561', ' 49565', ' 49566', ' 49572', ' 49585', ' 49587', ' 49590', ' 49652', ' 49653', ' 49654', ' 49655', ' 49656', ' 49657', ' 60200', ' 60210', ' 60212', ' 60220', ' 60225', ' 60240', ' 60252', ' 60254', ' 60260', ' 60270', ' 60271')".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ;";
?>
