<?php

require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");

// class to create replacable key value pairs for replacing it in html

require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");

class GenericRowDataManager implements TemplateDataManager  {

    private $keyValuePairs;

    function __construct(
        $bill_count,
        $row_count,
        $bill_array,
        $encounter_array,
        $insurance_type,
        $patient_paid,
        $insurance_paid,
        $adjustment_amount,
        $adjustment_reason,
        $primary_insurance_total,
        $secondary_insurance_total,
        $tertiary_insurance_total,
        $pat_pay_amt_unapplied,
        $pat_pay_amt_applied) {

        // only the applied payments are subtracted from the balance
        // the applied and unapplied payments are summed.
        // the patient payments should be shown when it inactive == 0, and only applied payments should be removed from the balance. but total patient payments should appear on the line item
        //compute all the informations to be displayed in this layer, format as you like

        $line_total_with_patient_payment = $bill_array['fee'] - $adjustment_amount - $insurance_paid - $pat_pay_amt_applied - $pat_pay_amt_unapplied;

        // compute line total here
         $line_total = $bill_array['fee'] - $adjustment_amount - $insurance_paid - $pat_pay_amt_applied;

         $line_total_without_patient_payment = $bill_array['fee'] - $adjustment_amount - $insurance_paid;

         $this->keyValuePairs = array(

            "APPLIED_PP"=>number_format($pat_pay_amt_applied,2),
            "UNAPPLIED_PP"=>$pat_pay_amt_unapplied,

            "BILL_COUNT" => $bill_count,
            "ROW_COUNT"=>$row_count,
            "INSURANCE_TYPE"=>$insurance_type,

            // retrieve from billing array
            "BILLING_ID"=>$bill_array['id'],
            "BILLING_FORMATTED_DATE"=>oeFormatShortDate(substr($bill_array['date'],0,10)),
            "BILLING_UNFORMATTED_DATE"=>substr($bill_array['date'],0,10),
            "BILLING_CODE"=>$bill_array['code'],
            "BILLING_CODE_TEXT"=>$bill_array['code_text'],
            "BILLING_MODIFIER"=>$bill_array['modifier'],
            "BILLING_UNITS"=>$bill_array['units'],

            // facility should be from facility id table
            "ENCOUNTER_FACILITY"=>GenericRowDataManager::getFacilityNameByFacilityId($encounter_array['facility_id']),


            "BILLING_FEE"=>$bill_array['fee'],
            "FORMATTED_BILLING_FEE"=>number_format($bill_array['fee'],2),


            "FORMATTED_PATIENT_PAID"=>number_format($patient_paid, 2),
            "UNFORMATTED_PATIENT_PAID"=>$patient_paid,

            "FORMATTED_INSURANCE_PAID"=>number_format($insurance_paid, 2),
            "UNFORMATTED_INSURANCE_PAID"=>$insurance_paid,

            "FORMATTED_ADJUSTMENT_AMOUNT"=>number_format($adjustment_amount, 2),
            "UNFORMATTED_ADJUSTMENT_AMOUNT"=>$adjustment_amount,

            "ADJUSTMENT_REASON"=>$adjustment_reason,

            "FORMATTED_TOTAL_WITH_PATIENT_PAID"=>number_format($line_total_with_patient_payment, 2),
            "FORMATTED_TOTAL_WITHOUT_PATIENT_PAID"=>number_format($line_total_without_patient_payment, 2),

            // individual insurance amounts which should be paid against the charges
            "PRIMARY_INSURANCE_TOTAL"=>$primary_insurance_total,
            "SECONDARY_INSURANCE_TOTAL"=>$secondary_insurance_total,
            "TERTIARY_INSURANCE_TOTAL"=>$tertiary_insurance_total
        );
    }

    public function getReplacementKeyValuePairs() {
        return $this->keyValuePairs;
    }

    public function getTemplateName() {
        return "generic_row_template";
    }

    public static function getFacilityNameByFacilityId($facility_id) {

        return ORM::for_table('facility')
        ->select('name')
        ->where('id', $facility_id)
        ->find_array()[0]['name'];

    }

}
?>
