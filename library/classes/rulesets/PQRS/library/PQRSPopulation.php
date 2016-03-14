<?php
/**
 * Defines a population of patients
 *
 * Copyright (C) 2016      Suncoast Connection
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
 * @link    http://www.oemr.org
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <leebc 11 at acm dot org>
 * @author  Art Eaton <art@starfrontiers.org>
 */

require_once( "PQRSPatient.php" );

class PQRSPopulation extends RsPopulation {
    /*
     * Initialize the patient population
     */
    public function __construct(array $patientIdArray) {
        foreach ($patientIdArray as $patientId) {
            $this->_patients[]= new PQRSPatient($patientId);
        }
    }

    /*
     * ArrayAccess Interface
     */
    public function offsetSet($offset, $value) {
        if ($value instanceof PQRSPatient) {
            if($offset == '') {
                $this->_patients[] = $value;
            } else {
                $this->_patients[$offset] = $value;
            }
        } else {
            throw new Exception('Value must be an instance of PQRSPatient');
        }
    }

}

?> 