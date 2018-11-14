
<?php
/*
 * HCC Measure HCC_0166 -- Numerator
 *
 * Copyright (C) 2018      Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreHealthEHR 
 * @link    http://suncoastconnection.com
 * @link    http://librehealth.io
 *
 * Please support this product by sharing your changes with the LibreHealth.io community.
 */
 
class HCC_0166_Numerator extends PQRSFilter
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
        $query = 
        "REPLACE INTO `lists` ( `pid`,`date`, `type`, `title`, `diagnosis`, `activity`, `user`) VALUES ".
    "('".$patient."','".$beginDate."','medical_problem','HCC_0166','HCC_0166',1,'".$this->_reportOptions['provider']."');";
    
    sqlStatementNoLog($query);
    
    return true;
    }
}

?>
