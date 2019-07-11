<?php
/**
 * Report Factory for PQRS Measures
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
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */

class PQRSReportFactory extends RsReportFactoryAbstract {

  public function __construct() {
    foreach(glob(dirname(__FILE__).'/library/*.php') as $filename) {
      require_once($filename);
    }

    foreach(glob(dirname(__FILE__).'/reports/MIPSCQM/*.php') as $filename) {
      require_once($filename);
    }
    
      foreach(glob(dirname(__FILE__).'/reports/HCC/*.php') as $filename) {
      require_once($filename);
    }
      foreach(glob(dirname(__FILE__).'/reports/Premeasure/*.php') as $filename) {
      require_once($filename);
    }

  }

  public function createReport($className, $rowRule, $patientData, $dateTarget, $options) {
    $reportObject = null;

    if(class_exists($className)) {
      $reportObject = new $className($rowRule, $patientData, $dateTarget, $options);
    } else {
      $reportObject = new NFQ_Unimplemented();
    }

    return $reportObject;
  }
}

?>