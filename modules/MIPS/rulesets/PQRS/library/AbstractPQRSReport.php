<?php
/**
 * Abstract PQRS Report
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

require_once( dirname(__FILE__)."/../../../clinical_rules.php" );

abstract class AbstractPQRSReport implements RsReportIF
{
    protected $_pqrsPopulation;

    protected $_resultsArray = array();

    protected $_rowRule;
    protected $_ruleId;
    protected $_beginMeasurement;
    protected $_endMeasurement;
    public $_reportOptions;

    protected $numerator_false = array();  // save patient_id => Numerator class return value
    protected $exclusion_false = array();   // save patient_id => Exclusion class return value
    protected $notmet_false = array();   // save patient_id => NotMet class return value

    public function __construct( array $rowRule, array $patientIdArray, $dateTarget, $options )
    {
        // require all .php files in the report's sub-folder
        $className = get_class( $this );
        foreach ( glob( dirname(__FILE__)."/../reports/".$className."/*.php" ) as $filename ) {
            require_once( $filename );
        }
        foreach ( glob( dirname(__FILE__)."/../groups/".$className."/*.php" ) as $filename ) {
            require_once( $filename );
        }
        // require common .php files
        foreach ( glob( dirname(__FILE__)."/../reports/common/*.php" ) as $filename ) {
            require_once( $filename );
        }
        // require clinical types
        foreach ( glob( dirname(__FILE__)."/../../../ClinicalTypes/*.php" ) as $filename ) {
            require_once( $filename );
        }

        $this->_pqrsPopulation = new PQRSPopulation( $patientIdArray );
        $this->_rowRule = $rowRule;
        $this->_ruleId = isset( $rowRule['id'] ) ? $rowRule['id'] : '';
        // Calculate measurement period
        if(is_array($dateTarget)) {
            $this->_beginMeasurement = $dateTarget['dateBegin'];
            $this->_endMeasurement = $dateTarget['dateTarget'];
        } else {
            $tempDateArray = explode('-', $dateTarget);
            $this->_beginMeasurement = $tempDateArray[0] . '-01-01 00:00:00';
            $this->_endMeasurement = $tempDateArray[0] . '-12-31 23:59:59';
        }
        $this->_reportOptions = $options;
    }

    public abstract function createPopulationCriteria();

    public function getBeginMeasurement() {
        return $this->_beginMeasurement;
    }

    public function getEndMeasurement() {
        return $this->_endMeasurement;
    }

    public function getResults() {
        return $this->_resultsArray;
    }

    public function execute()
    {
        $populationCriterias = $this->createPopulationCriteria();
        if ( !is_array( $populationCriterias ) ) {
            $populationCriterias = array( $populationCriterias );
        }

        foreach ( $populationCriterias as $populationCriteria )
        {

            // If itemization is turned on, then iterate the rule id iterator
            if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                $GLOBALS['report_itemized_test_id_iterator']++;
            }

            if ( $populationCriteria instanceof PQRSPopulationCriteriaFactory )
            {
                $initialPatientPopulationFilter = $populationCriteria->createInitialPatientPopulation();
                if ( !$initialPatientPopulationFilter instanceof PQRSFilterIF ) {
                    throw new Exception( "InitialPatientPopulation must be an instance of PQRSFilterIF" );
                }
                $initialPatientPopulationFilter->setReportOptions($this->_reportOptions);

                $denominator = $populationCriteria->createDenominator();
                if ( !$denominator instanceof PQRSFilterIF ) {
                    throw new Exception( "Denominator must be an instance of PQRSFilterIF" );
                }
                $denominator->setReportOptions($this->_reportOptions);

                $numerators = $populationCriteria->createNumerators();
                if ( !is_array( $numerators ) ) {
                    $numerators = array( $numerators );
                }
                foreach ( $numerators as $numerator ) {
                    $numerator->setReportOptions($this->_reportOptions);
                }

                $notmet = $populationCriteria->createNotMet();
                if ( !is_array( $notmet ) ) {
                    $notmet = array( $notmet );
                }
                foreach ( $notmet as $notmets ) {
                    $notmets->setReportOptions($this->_reportOptions);
                }

                $exclusion = $populationCriteria->createExclusion();
                if ( !$exclusion instanceof PQRSFilterIF ) {
                    throw new Exception( "Exclusion must be an instance of PQRSFilterIF" );
                }
                $exclusion->setReportOptions($this->_reportOptions);

                //Denominator Exception added
                $denomExept = false;
                if( method_exists($populationCriteria, 'createDenominatorException')){
                    $denomExept = true;
                }

                $totalPatients = count( $this->_pqrsPopulation );
                $initialPatientPopulation = 0;
                $denominatorPatientPopulation = 0;
                $exclusionsPatientPopulation = 0; //exclusions now reported as exceptions!
                $exceptionsPatientPopulation = 0; // this is a bridge to no where variable (calculated but not used below). Will keep for now, though.
                $patExclArr = array();
                $patExceptArr = array();
                $numeratorPatientPopulations = $this->initNumeratorPopulations( $numerators );
                $notmetPatientPopulations = $this->initNotMetPopulations( $notmet );
                $unreported = 0;

                foreach ( $this->_pqrsPopulation as $patient )
                {
                    if ( !$initialPatientPopulationFilter->test( $patient, $this->_beginMeasurement, $this->_endMeasurement ) )
                    {
                        continue;
                    }

                    $initialPatientPopulation++;

                    // If itemization is turned on, then record the "Initial Patient population" item
                    if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                        insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 3, $patient->id);
                    }

                    if ( !$denominator->test( $patient, $this->_beginMeasurement, $this->_endMeasurement ) )
                    {
                        continue;
                    }

                    $denominatorPatientPopulation++;

                    if ( $exclusion->test( $patient, $this->_beginMeasurement, $this->_endMeasurement ) )
                    {
                        $exclusionsPatientPopulation++;
                        $patExclArr[] = $patient->id;
                    } else {
                        $this->exclusion_false = array_merge($this->exclusion_false, array('"'.$patient->id.'"' => 0));
                    }

                    //Denominator Exception added
                    if($denomExept){
                        $denom_exception = $populationCriteria->createDenominatorException();
                        if ( $denom_exception->test( $patient, $this->_beginMeasurement, $this->_endMeasurement ) )
                        {
                            $exceptionsPatientPopulation++; // this is a bridge to no where variable (not used below). Will keep for now, though.
                            $patExceptArr[] = $patient->id;
                        }
                    }

                    foreach ( $numerators as $numerator ) {
                        $test_numerator = $this->testNumerator( $patient, $numerator, $numeratorPatientPopulations );
                        if ($test_numerator == FALSE) {
                            $this->numerator_false = array_merge($this->numerator_false, array('"'.$patient->id.'"' => 0));
                        }
                    }
                    foreach ( $notmet as $notmets ) {
                        $test_notmet = $this->testNotMet( $patient, $notmets, $notmetPatientPopulations );
                        if ($test_notmet == FALSE) {
                            $this->notmet_false = array_merge($this->notmet_false, array('"'.$patient->id.'"' => 0));
                        }
                    }
                }

                // tally results, run exclusion on each numerator
                $pass_filt = $denominatorPatientPopulation;
                $exclude_filt = $exclusionsPatientPopulation;
                $pass_not = $notmetPatientPopulations;
                foreach ( $numeratorPatientPopulations as $title => $pass_targ ) {

                    if(count($patExclArr) > 0){
                        foreach($patExclArr as $patVal){
                            // If itemization is turned on, then record the "excluded" item
                            if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                                insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 2, $patVal, $title);
                            }
                        }
                    }
                    if(count($patExceptArr) > 0){
                        foreach($patExceptArr as $patVal){
                            // If itemization is turned on, then record the "exception" item
                            if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                                insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 4, $patVal, $title);
                            }
                        }
                    }
/////May redo NotMet like Exclusion/Exception above with a value of 5
                    $percentage = calculate_percentage( $pass_filt, $exclude_filt, $pass_targ );

                    $pass_notmet = $pass_not["NotMet"];

                    //error_log("NUMERATOR: " . print_r($this->numerator_false, true) . " EXCLUSION: " . print_r($this->exclusion_false, true) . " NOTMET: " . print_r($this->notmet_false, true));

                    $unreported = $this->countUnreported($this->numerator_false, $this->exclusion_false, $this->notmet_false);

                    $this->_resultsArray[]= new PQRSResult( $this->_rowRule, $title, $populationCriteria->getTitle(),
                        $totalPatients, $pass_filt, $exclude_filt, $pass_targ, $pass_notmet, $unreported, $percentage );
                }
            }
        }

        return $this->_resultsArray;
    }

    private function initNumeratorPopulations( array $numerators )
    {
        $numeratorPatientPopulations = array();
        foreach ( $numerators as $numerator ) {
            $numeratorPatientPopulations[$numerator->getTitle()] = 0;
        }
        return $numeratorPatientPopulations;
    }

    private function initNotMetPopulations( array $notmets )
    {
        $notmetPatientPopulations = array();
        foreach ( $notmets as $notmet ) {
            $notmetPatientPopulations[$notmet->getTitle()] = 0;
        }
        return $notmetPatientPopulations;
    }

    private function testNumerator( $patient, $numerator, &$numeratorPatientPopulations )
    {
        if ( $numerator instanceof PQRSFilterIF  )
        {
            if ( $numerator->test( $patient, $this->_beginMeasurement, $this->_endMeasurement ) ) {

                $numeratorPatientPopulations[$numerator->getTitle()]++;

                // If itemization is turned on, then record the "passed" item
                if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                   insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 1, $patient->id, $numerator->getTitle());
                   return true;
                }
            }
            else {
                // If itemization is turned on, then record the "failed" item
                if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                   insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 0, $patient->id, $numerator->getTitle());
                   return false;
                }

            }
        }
        else
        {
            throw new Exception( "Numerator must be an instance of PQRSFilterIF" );
        }
    }

    private function testNotMet( $patient, $notmets, &$notmetPatientPopulations )
    {
        if ( $notmets instanceof PQRSFilterIF  )
        {
            if ( $notmets->test( $patient, $this->_beginMeasurement, $this->_endMeasurement ) ) {

                $notmetPatientPopulations[$notmets->getTitle()]++;

                // If itemization is turned on, then record the "passed" item
                if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                    updateNumeratorPass($patient->id, 5); //Save 5 as Numberator value when NotMet.php class returns true
                    insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 1, $patient->id, $notmets->getTitle());
                    return true;
                }
            }
            else {
                // If itemization is turned on, then record the "failed" item
                if ($GLOBALS['report_itemizing_temp_flag_and_id']) {
                   insertItemReportTracker($GLOBALS['report_itemizing_temp_flag_and_id'], $GLOBALS['report_itemized_test_id_iterator'], 0, $patient->id, $notmets->getTitle());
                   return false;
                }

            }
        }
        else
        {
            throw new Exception( "NotMet must be an instance of PQRSFilterIF" );
        }
    }

    // If there's a zero in all 3 arrays with same patient_id as key, then it's unreported
    private function countUnreported($numerator_false, $exclusion_false, $notmet_false)
    {
        $unreported_items = 0;
        foreach ($notmet_false as $key => $value) {
            if ($numerator_false[$key] == 0 && $exclusion_false[$key] == 0 && $value == 0) {
                $unreported_items++;
            }
            //    error_log("NUMERATOR: " . $key . " => " . $numerator_false[$key]);
            //    error_log("EXCLUSION: " . $key . " => " . $exclusion_false[$key]);
            //    error_log("NOTMET: " . $key . " => " . $notmet_false[$key]);
        }
        return $unreported_items;
    }

}
