<?php
/**
 * PQRS RA Group 
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */

$query1 =
"SELECT COUNT(b1.code) as count".  
"  FROM billing AS b1". 
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" INNER JOIN pqrs_group AS codelist_a ON (b1.code = codelist_a.code)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_RA_a');";
$result = sqlFetchArray(sqlStatementNoLog($query1, array($patient->id))); 
if ($result['count']> 0){ $counted = 1;
	$query =
	"SELECT COUNT(b1.code) as count".  
	"  FROM billing AS b1". 
	" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
	" INNER JOIN pqrs_group AS codelist_a ON (b1.code = codelist_a.code)".
	" WHERE b1.pid = ? ".
	" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
	" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_RA_b');";
} else{$counted = 0;} 
?>
