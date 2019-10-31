<?php
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/global_functions.php");
require_once("$srcdir/formatting.inc.php");

// class to create replacable key value pairs for replacing it in html

require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");

class PaymentRowDataManager implements TemplateDataManager  {

	private $keyValuePairs;

	function __construct($ar_activity_row, $encounter_row, $pid, $row_count, $bill_count) {
		global $GLOBALS;
		$this->payment_details_array = $payment_details_array;

		$SEQUENCE_NO_ID = "sequence_no_".$ar_activity_row['sequence_no'];

		$this->keyValuePairs = array(

			"SEQUENCE_NO_ID"=>$SEQUENCE_NO_ID,

			"SEQUENCE_NO"=>$ar_activity_row['sequence_no'],

			"BILLING_ID"=>$ar_activity_row['billing_id'],

			"PAY_AMOUNT"=>$ar_activity_row['pay_amount'],

			"FORMATTED_PAY_AMOUNT"=>number_format($ar_activity_row['pay_amount'], 2),

			"PID"=>$pid,

			"ROW_COUNT"=>$row_count,

			"BILL_COUNT"=>$bill_count,

			"ENCOUNTER"=>$encounter_row['encounter'],

			"ADJUSTMENT_AMOUNT"=>$ar_activity_row['adj_amount'],

			"FORMATTED_ADJUSTMENT_AMOUNT"=>number_format($ar_activity_row['adj_amount'], 2),

			"ADJUSTMENT_REASON"=>$ar_activity_row['memo'],

			"FORMATTED_POST_TIME"=>oeFormatShortDate(substr($ar_activity_row['check_date'],0,10)),
			
			"UNFORMATTED_POST_TIME"=>substr($ar_activity_row['check_date'],0,10),
			
			"UNAPPLIED"=>$ar_activity_row['unapplied']

		);

        $should_disable_date_field = $GLOBALS['transaction_patient_payment_date_edit_allowed'];
        if ($should_disable_date_field != "1") {
            $this->keyValuePairs['SHOULD_DISABLE_PATIENT_PAYMENT_DATE_FIELD'] = "disabled"; 
        }
        else {
            $this->keyValuePairs['SHOULD_DISABLE_PATIENT_PAYMENT_DATE_FIELD'] = "";
        }

	}

	public function getReplacementKeyValuePairs() {
		return $this->keyValuePairs;
	}

	public function getTemplateName() {
		return "patient_payment_row_template";
	}

}
