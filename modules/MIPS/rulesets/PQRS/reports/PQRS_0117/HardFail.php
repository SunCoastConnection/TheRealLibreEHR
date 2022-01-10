<?php
/*
 * PQRS Measure 0117 -- HardFail
 *
 * Copyright (C) 2019   Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 *
 */
 
class PQRS_0117_HardFail extends PQRSFilter
{
    public function getTitle()
    {
        return "HardFail";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {

 $query =
" SELECT COUNT(b1.code) AS count".  
" FROM billing AS b1".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date >= DATE_SUB('".$beginDate."', INTERVAL 1 YEAR)".
" AND b1.code IN ( '2022F','2024F','2026F') AND b1.modifier ='8P'; ";
//Hard fail  (2022F or 2024F or 2026F with 8P
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 

if ($result['count']> 0){ return true;} else {return false;}           

    }
}

?>
