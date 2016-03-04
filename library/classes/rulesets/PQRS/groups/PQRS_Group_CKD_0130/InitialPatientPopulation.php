<?php
/*
 * PQRS Measure Group_CKD_0130 -- Initial Patient Population
 *
 * Copyright (C) 2016 Suncoast Connection
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @package OpenEMR
 * @author  Suncoast Connection
 * @link    http://suncoastconnection.com
 * @link    http://www.oemr.org
*/

class PQRS_Group_CKD_0130_InitialPatientPopulation implements PQRSFilterIF
{
    public function getTitle() 
    {
        return "Initial Patient Population";
    }
    
    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
require_once("$srcdir/classes/rulesets/PQRS/groups/common/CKDcommon.php");
$result = sqlStatement($CKD);
if ($result > 0){ return true;} else {return false;}  

    }
}

?>

