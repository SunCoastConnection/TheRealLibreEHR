<?php
/**
 * PQRS Filter
 *
 * Copyright (C) 2015 - 2017      Suncoast Connection
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
 * Please support this product by sharing your changes with the Libre.io community.
 */

require_once(__DIR__.'/PQRSFilterIF.php');

abstract class PQRSFilter implements PQRSFilterIF {
    protected $_reportOptions;

    public function setReportOptions($options) {
    	$this->_reportOptions = $options;
    }
}
