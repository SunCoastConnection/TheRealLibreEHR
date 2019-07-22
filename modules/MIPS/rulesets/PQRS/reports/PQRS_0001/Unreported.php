<?php
/*
 * PQRS Measure 0001 -- Unreported
 *
 * The unreported column contains number of patients who lack the failing and passing code.
 * i.e Their data hasn't been collected for this billing.code field
 *
 * Copyright (C) 2019      Suncoast Connection
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Tigpezeghe Rodrige K. <tigrodrige@gmail.com>
 * @package LibreEHR
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */

class PQRS_0001_Unreported extends PQRSFilter
{
    public function getTitle()
    {
        return "Unreported";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
    	$query =
    	"SELECT COUNT(b1.code) AS count ".
    	" FROM billing AS b1 ".
    	" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter) ".
    	" JOIN patient_data AS p ON (b1.pid = p.pid) ".
    	" WHERE b1.pid = ? ".
    	" AND fe.date >= '".$beginDate."' ".
    	" AND fe.date <= '".$endDate."' ".
    	" AND b1.code IS NULL;";

        error_log("Unreported RUNNING: " . print_r($patient, true));

        $result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
        error_log("RESULTS: ". print_r($result, true));
        if ($result['count'] > 0){
            error_log("PATIENT UNREPORTED: ".$patient->id);
            return true;
        } else {
                return false;
        }
    		 //inverse count.  If find NULL, it is unreported.
    }
}

?>
