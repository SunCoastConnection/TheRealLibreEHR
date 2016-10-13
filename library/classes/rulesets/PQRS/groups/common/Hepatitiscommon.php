<?php
/**
 * PQRS Hepatitis Group 
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
" JOIN billing AS b2 ON (b2.pid = b1.pid)".
" INNER JOIN pqrs_efcc AS codelist_b ON (b1.code = codelist_b.code)".
" JOIN pqrs_efcc AS codelist_c ON (b2.code = codelist_c.code)".
" WHERE b1.pid = ? ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ".
" AND YEAR(fe.date) ='2016' ".
" AND  (b1.code = codelist_b.code AND codelist_b.type = 'pqrs_0387_c')".  ///looks strange, but is correct
" AND (b2.code = codelist_c.code AND codelist_c.type = 'pqrs_0387_b') ; ";

?>
