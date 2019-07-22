<?php
/*
 * PQRS Measure 0001 -- NotMet
 *
 * Copyright (C) 2018   Suncoast Connection
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

class PQRS_0001_NotMet extends PQRSFilter
{
    public function getTitle()
    {
        return "NotMet";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
        //inverse measure
        $query =
        "SELECT COUNT(b1.code) as count ".
        " FROM billing AS b1 ".
        " JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
        " WHERE b1.pid = ? ".
        " AND fe.date BETWEEN '".$beginDate."' AND '".$endDate."' ".
        " AND b1.code IN('3044F','3045F');";

        $result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
        if ($result['count'] > 0){
            return true;
        } else {
            return false;
        }
    }
}

?>
