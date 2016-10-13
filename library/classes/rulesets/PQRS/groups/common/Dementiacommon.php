<?php
/**
 * PQRS Dementia Group 
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
"('094.1', ' 290.0', ' 290.10', ' 290.11', ' 290.12', ' 290.13', ' 290.20', ' 290.21', ' 290.3', ' 290.40', ' 290.41', ' 290.42', ' 290.43', ' 290.8', ' 290.9', ' 294.10', ' 294.11', ' 294.20', ' 294.21', ' 294.8', ' 331.0', ' 331.11', ' 331.19', ' 331.82', ' A52.17', ' F01.50', ' F01.51', ' F02.80', ' F02.81', ' F03.90', ' F03.91', ' F05', ' F06.8', ' G30.0', ' G30.1', ' G30.8', ' G30.9', ' G31.01', ' G31.09', ' G31.83')".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18'  ".  
" AND b2.code IN". 
"('90791', ' 90792', ' 90832', ' 90834', ' 90837', ' 96116', ' 96118', ' 96119', ' 96120', ' 96150', ' 96151', ' 96152', ' 96154', ' 97003', ' 97004', ' 99201', ' 99202', ' 99203', ' 99204', ' 99205', ' 99212', ' 99213', ' 99214', ' 99215', ' 99304', ' 99305', ' 99306', ' 99307', ' 99308', ' 99309', ' 99310', ' 99324', ' 99325', ' 99326', ' 99327', ' 99328', ' 99334', ' 99335', ' 99336', ' 99337', ' 99341', ' 99342', ' 99343', ' 99344', ' 99345', ' 99347', ' 99348', ' 99349', ' 99350');";
?>

