<?php
/*
 * PQRS Measure 0141 -- HardFail
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
 
class PQRS_0141_HardFail extends PQRSFilter
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
" INNER JOIN billing AS b2 ON (b2.pid = b1.pid)".
" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
" WHERE b1.pid = ? ".
" AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
" AND ((b1.code = '3284F' AND b1.modifier ='8P')".
" OR (b1.code = '0517F' AND b1.modifier ='8P' AND b2.code = '3285F')); ";
$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id))); 
//hard fail identical to above but with modifier 8P for each of the above 2 conditions
if ($result['count']> 0){ return true;} else {return false;}  	        

    }
}

?>
