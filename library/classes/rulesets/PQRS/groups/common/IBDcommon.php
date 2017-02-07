<?php
/**
 * PQRS IBD Group 
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
" INNER JOIN pqrs_group AS codelist_a ON (b1.code = codelist_a.code)".
" INNER JOIN pqrs_group AS codelist_b ON (b2.code = codelist_b.code)".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ".  
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18'  ".  
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_IBD_a') ".
" AND (b2.code = codelist_b.code AND codelist_b.type = 'pqrs_IBD_b');";
?>

 
