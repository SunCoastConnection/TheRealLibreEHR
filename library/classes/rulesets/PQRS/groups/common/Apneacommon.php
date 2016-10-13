<?php
/**
 * PQRS Apnea Group 
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
" INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  

" JOIN form_encounter AS fe ON (b2.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ".  
" AND b1.code IN".  
"('327.23', ' 780.51', ' 780.53', ' 780.57', ' G47.30', ' G47.33')".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18'  ".  
" AND b2.code IN". 
"('99201', ' 99202', ' 99203', ' 99204', ' 99205', ' 99212', ' 99213', ' 99214', ' 99215', ' 99304', ' 99305', ' 99306', ' 99307', ' 99308', ' 99309', ' 99310', ' 99324', ' 99325', ' 99326', ' 99327', ' 99328', ' 99334', ' 99335', ' 99336', ' 99337', ' 99341', ' 99342', ' 99343', ' 99344', ' 99345', ' 99347', ' 99348', ' 99349', ' 99350');";
?>
