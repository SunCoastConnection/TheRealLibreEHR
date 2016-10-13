<?php
/**
 * PQRS Asthma Group 
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
"('493.00', '493.01', '493.02', '493.10', '493.11', '493.12', '493.20', '493.21', '493.22', '493.81', '493.82', '493.90', '493.91', '493.92', 'J45.20', 'J45.21', 'J45.22', 'J45.30', 'J45.31', 'J45.32', 'J45.40', 'J45.41', 'J45.42', 'J45.50', 'J45.51', 'J45.52', 'J45.901', 'J45.902', 'J45.909', 'J45.990', 'J45.991', 'J45.998')".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '5'  ".  
" AND b2.code IN". 
"('99201','99202','99203','99204','99205','99212','99213','99214','99215','99341');";
?>
