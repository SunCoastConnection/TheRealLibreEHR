<?php
/*
 * HCC Measure 00XX -- HardFail
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
 
class HCC_0010_HardFail extends PQRSFilter
{
    public function getTitle()
    {
        return "HardFailHCC";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {

   return true;     

    }
}

?>
