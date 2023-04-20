<?php
/**
 * PQRS Measure 0474 -- Denominator 
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
 
class PQRS_0474_Denominator extends PQRSFilter
{
    public function getTitle() 
    {
        return "Denominator";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
	$query =
	"SELECT COUNT(b1.code) AS count ". 
	" FROM billing AS b1 ". 
	" JOIN form_encounter AS fe ON (b1.encounter = fe.encounter) ".   
	" WHERE b1.pid = ? ".
	" AND b1.code IN ('M1061','M1062');";

		$result = sqlFetchArray(sqlStatementNoLog($query, array($patient->id)));
	if ($result['count'] > 0){
		 return false;} else {return true;} 
		 //inverse count.  If find code, it is a denom exclude.
    }
}

?>
