<?php
/**
 * PQRS Measure 0383 -- Initial Patient Population
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */
 
class PQRS_0383_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
$query =
"SELECT COUNT(b1.code) as count ".  
" FROM billing AS b1". 
" INNER JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" INNER JOIN patient_data AS p ON (p.pid = b1.pid)".
" INNER JOIN facility AS fac ON (fe.facility = fac.id)".
" JOIN billing AS b2 ON (b2.pid = b1.pid)".
" JOIN billing AS b3 ON (b3.pid = b1.pid)".
" JOIN billing AS b4 ON (b4.pid = b1.pid)".
" JOIN billing AS b5 ON (b5.pid = b1.pid)".
" JOIN billing AS b6 ON (b6.pid = b1.pid)".
" JOIN billing AS b7 ON (b7.pid = b1.pid)".
" INNER JOIN pqrs_ptsf AS codelist_a ON (b1.code = codelist_a.code)".
" JOIN pqrs_ptsf AS codelist_b ON (b2.code = codelist_b.code)".
" JOIN pqrs_ptsf AS codelist_c ON (b3.code = codelist_c.code)".
" JOIN pqrs_ptsf AS codelist_d ON (b4.code = codelist_d.code)".
" JOIN pqrs_ptsf AS codelist_e ON (b5.code = codelist_e.code)".
" JOIN pqrs_ptsf AS codelist_f ON (b6.code = codelist_f.code)".
" JOIN pqrs_ptsf AS codelist_g ON (b7.code = codelist_g.code)".
" WHERE b1.pid = ? ".
" AND fe.date >= '".$beginDate."' ".
" AND fe.date <= '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '18' ".
" AND (b1.code = codelist_a.code AND codelist_a.type = 'pqrs_0383_a') ".
" AND NOT (b2.code = codelist_b.code AND codelist_b.type = 'pqrs_0383_b')".
" AND ((b3.code = codelist_c.code AND codelist_c.type = 'pqrs_0383_c') ".
" OR (b4.code = codelist_d.code AND codelist_d.type = 'pqrs_0383_d' AND fac.pos_code IN ('03', '05', '07', '09', '11', '12', '13', '14', '15', '20', '22', '24', '26', '33', '49', '50', '52', '53', '71', '72')) ".
" OR (b5.code = codelist_e.code AND codelist_e.type = 'pqrs_0383_e' AND fac.pos_code = '23') ".
" OR (b6.code = codelist_f.code AND codelist_f.type = 'pqrs_0383_f' AND fac.pos_code IN ('31','32','56')) ".
" OR (b7.code = codelist_g.code AND codelist_g.type = 'pqrs_0383_g' AND fac.pos_code  IN ('21','51'))) "; ";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){ return true;} else {return false;}   
    }
}
