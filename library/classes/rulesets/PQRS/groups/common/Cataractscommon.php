<?php
/**
 * PQRS Cataracts Group 
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
" INNER JOIN pqrs_group AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (b1.pid = p.pid)". 
" WHERE b1.pid = ? ".
" AND fe.provider_id = '".$this->_reportOptions['provider']."'".  
" AND fe.date BETWEEN '".$beginDate."' AND DATE_SUB('".$endDate."', INTERVAL 3 MONTH) ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18'  ". 
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_cataracts_a') ".
" AND b1.modifier NOT IN ('55', '56') ;";
?>

