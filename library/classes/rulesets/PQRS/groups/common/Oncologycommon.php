<?php
/**
 * PQRS Oncology Group 
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
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" JOIN billing AS b2 ON (b1.pid = b2.pid)".

" INNER JOIN pqrs_ptct AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN pqrs_ptct AS codelist_b ON (b2.code = codelist_b.code)".

" WHERE b1.pid = ? ".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0143_a')".
" AND (b2.code = codelist_b.code AND codelist_b.type = 'pqrs_0143_b' ) ; ";

/*$query =
"SELECT COUNT(b1.code) as count".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" JOIN billing AS b2 ON (b1.pid = b2.pid)".
" JOIN billing AS b3 ON (b1.pid = b3.pid)".
" JOIN billing AS b4 ON (b1.pid = b4.pid)".
" INNER JOIN pqrs_ptct AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN pqrs_ptct AS codelist_b ON (b2.code = codelist_b.code)".
" JOIN pqrs_ptct AS codelist_c ON (b3.code = codelist_c.code)".
" JOIN pqrs_ptct AS codelist_d ON (b4.code = codelist_d.code)".
" WHERE b1.pid = ? ".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0143_a')".
" AND ((b2.code = codelist_b.code AND codelist_b.type = 'pqrs_0143_b' ) OR  ((b3.code = codelist_c.code AND codelist_c.type = 'pqrs_0143_c' ) AND (b4.code = codelist_d.code AND codelist_d.type = 'pqrs_0143_d' ))) ; ";*/



?>
