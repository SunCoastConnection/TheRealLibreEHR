<?php
/**
 * Manage & Run Reports
 *
 * Copyright (C) 2011      Ken Chapple <ken@mi-squared.com>
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
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>.
 *
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @link    http://SuncoastConnection.com
 * @author  Brady Miller <brady@sparmy.com>
 * @author  Bryan lee <leebc11 at acm dot org>
 */

require_once('ReportTypes.php');

class ReportManager {
  public function __construct() {
    foreach(glob(dirname(__FILE__).'/library/*.php') as $filename) {
      require_once($filename);
    }

    foreach(glob(dirname(__FILE__).'/Cqm/*.php') as $filename) {
      require_once($filename);
    }

    foreach(glob(dirname(__FILE__).'/Amc/*.php') as $filename) {
      require_once($filename);
    }

    foreach(glob(dirname(__FILE__).'/PQRS/*.php') as $filename) {
      require_once($filename);
    }
  }

  public function runReport($rowRule, $patients, $dateTarget, $options = array()) {
    $ruleId = $rowRule['id'];
    $patientData = array();

    foreach( $patients as $patient ) {
      $patientData[] = $patient['pid'];
    }

    $reportFactory = null;

    switch (ReportTypes::getType($ruleId)) {
      case ReportTypes::CQM:
        $reportFactory = new CqmReportFactory(); 
        break;

      case ReportTypes::AMC:
        $reportFactory = new AmcReportFactory();
        break;

      case ReportTypes::PQRS:
        $reportFactory = new PQRSReportFactory();
        break;

      default:
      error_log("ReportManager:  (now with less fatality) Unknown rule: $ruleId");

        //throw new Exception('Unknown rule: '.$ruleId);
        break;
    }

    $report = null;

    if($reportFactory instanceof RsReportFactoryAbstract) {
      $report = $reportFactory->createReport(ReportTypes::getClassName($ruleId), $rowRule, $patientData, $dateTarget, $options);
    }

    $results = array();

    if($report instanceof RsReportIF &&
      !$report instanceof RsUnimplementedIF
    ) {
      $report->execute();

      $results = $report->getResults();
    }

    return RsHelper::formatClinicalRules($results);
  }
}

?>
