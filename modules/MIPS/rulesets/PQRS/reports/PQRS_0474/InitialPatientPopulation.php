<?php
/**
 * PQRS Measure 0474 -- Initial Patient Population
 *
 * Copyright (C) 2015 - 2018      Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */
 
class PQRS_0474_InitialPatientPopulation extends PQRSFilter
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
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" JOIN patient_data AS p ON (p.pid = b1.pid)".
" WHERE b1.pid = ? ".
        "";
        $thisprov = $this->_reportOptions['provider'];
        if ($thisprov != 1000000001){ $query .=
        " AND fe.provider_id = '".$this->_reportOptions['provider']."'";}
        $query .=
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND TIMESTAMPDIFF(YEAR,p.DOB,fe.date) >= '50' ".
" AND b1.code IN ('99201', '99202', '99203', '99204', '99205','99211', '99212', '99213', '99214', '99215', '99324','99325', '99326', '99327', '99328', '99334', '99335', '99336', '99337', '99341', '99342', '99343', '99344', '99345', '99347', '99348', '99349', '99350', '99495', '99496', 'G0402', 'G0438','G0439')".
" AND b1.modifier NOT IN('GQ','GT','95') ;";

$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
if ($result['count']> 0){return true; } else {return false;}  
    }
}
