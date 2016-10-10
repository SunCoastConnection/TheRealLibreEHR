<?php
/**
 * PQRS Preventive Group 
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
" INNER JOIN pqrs_efcc AS codelist_a ON (b1.code = codelist_a.code)".
" WHERE b1.pid = ? ".
" AND YEAR(fe.date) ='2016' ".
" AND b1.code IN('99201', '99202', '99203', '99204', '99205','99212', '99213', '99214', '99215'); ";

?>
