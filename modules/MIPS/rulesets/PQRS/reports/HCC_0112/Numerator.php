
<?php
/*
 * HCC Measure HCC_0112 -- Numerator
 *
 * Copyright (C) 2018      Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */
 
class HCC_0112_Numerator extends PQRSFilter
{
    public function getTitle()
    {
        return "HCC_0112";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
  
    return true;
    }
}

?>
