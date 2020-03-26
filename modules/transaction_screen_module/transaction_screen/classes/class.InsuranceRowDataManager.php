<?php
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/global_functions.php");
// class to create replacable key value pairs for replacing it in html

require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");

class InsuranceRowDataManager implements TemplateDataManager  {

    private $keyValuePairs;

    function __construct($payment_details_array, $row_count, $bill_count, $insurance_type) {
        global $GLOBALS;
        $this->payment_details_array = $payment_details_array;

        $this->keyValuePairs = array(

            "PID"=>$payment_details_array['pid'],

            "ENCOUNTER"=>$payment_details_array['encounter'],

            "SEQUENCE_NO"=>$payment_details_array['sequence_no'],

            "PAYMENT_TYPE"=>$payment_details_array['s_PaymentType'],

            "PAYMENT_TYPE_WITHOUT_SPACES"=>str_replace(" ", "-", strtolower($payment_details_array['s_PaymentType'])),

            "INSURANCE_TYPE"=>$insurance_type,

            "ROW_COUNT"=>$row_count,

            "BILL_COUNT"=>$bill_count,

            "BACKGROUND_COLOR"=>$payment_details_array['s_RowBgColor'],

            "PAYMENT_DATE"=>$payment_details_array['pay_post_date'],

            "UNFORMATTED_PAYMENT_DATE"=>$payment_details_array['unformatted_pay_post_date'],

            "PAYMENT_AMOUNT"=>$payment_details_array['s_m_Amount'],

            "FORMATTED_PAYMENT_AMOUNT"=>number_format($payment_details_array['s_m_Amount'], 2),

            "FORMATTED_INSURANCE_PAYMENT_AMOUNT"=>number_format($payment_details_array['ins_pay_amt'], 2),

            "ADJUSTMENT_AMOUNT"=>$payment_details_array['adj_amount'],

            "FORMATTED_ADJUSTMENT_AMOUNT"=>number_format($payment_details_array['adj_amount'], 2),

            "ADJUSTMENT_REASON"=>$payment_details_array['adjustment_reason'],

            "COL_SPAN"=>$payment_details_array['i_ColumnSpan']
        );

        $should_disable_date_field = $GLOBALS['transaction_insurance_payment_date_edit_allowed'];
        if ($should_disable_date_field != "1") {
            $this->keyValuePairs['SHOULD_DISABLE_INSURANCE_PAYMENT_DATE_FIELD'] = "disabled"; 
        }
        else {
            $this->keyValuePairs['SHOULD_DISABLE_INSURANCE_PAYMENT_DATE_FIELD'] = "";
        }
    }

    public function getReplacementKeyValuePairs() {
        return $this->keyValuePairs;
    }

    public function getTemplateName() {
        return "insurance_row_template";
    }
}

?>
