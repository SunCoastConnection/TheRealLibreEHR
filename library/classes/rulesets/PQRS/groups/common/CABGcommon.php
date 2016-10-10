<?php
/**
 * PQRS CABG Group -- 
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
" WHERE b1.pid = ? ".
" AND YEAR(fe.date) ='2016' ".
" AND TIMESTAMPDIFF(YEAR,p.dob,fe.date) >= '18' ".
" AND b1.code IN ('33510', '33511', '33512', '33513', '33514', '33516', '33517', '33518', '33519', '33521', '33522', '33523', '33533', '33534', '33535', '33536' ); ";

?>
