<?php

require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");



class ServiceModalDataManager implements TemplateDataManager  {



    private $keyValuePairs;

    public function __construct($caseNumber, $description, $facility, $clinician, $charges, $balance, $rowData, $payment_type, $real_balance) {

        $this->keyValuePairs = array("CASE_NUMBER"=>$caseNumber,
            "DESCRIPTION"=>$description,
            "FACILITY"=>$facility,
            "CLINICIAN"=>$clinician,
            "CHARGES"=>$charges,
            "BALANCE"=>$balance,
            "ROW_DATA"=>$rowData,
            "REAL_BALANCE"=>$real_balance,
            "ServiceModalPaymentType"=>$payment_type);
        $this->alterServiceModalBasedOnPaymentType();
    }

    public function getReplacementKeyValuePairs() {

        return $this->keyValuePairs;

    }

    public function getTemplateName() {
        return "service_modal_template";
    }


    private function dontHideAnyPaymentFields() {
        $this->keyValuePairs['PRIMARY_PAID_VISIBILITY'] = "";
        $this->keyValuePairs['SECONDARY_PAID_VISIBILITY'] = "";
        $this->keyValuePairs['TERTIARY_PAID_VISIBILITY'] = "";
    }

    private function hideAllPaymentFields() {
        $this->keyValuePairs['PRIMARY_PAID_VISIBILITY'] = "do-not-display-this-column";
        $this->keyValuePairs['SECONDARY_PAID_VISIBILITY'] = "do-not-display-this-column";
        $this->keyValuePairs['TERTIARY_PAID_VISIBILITY'] = "do-not-display-this-column";
    }

    private function alterServiceModalBasedOnPaymentType() {
        // show or hide table columns based on payment type, ie use the css class to determine that

        $payment_type = $this->keyValuePairs['ServiceModalPaymentType'];

        // hide all the columns
        $this->hideAllPaymentFields();

        switch ($payment_type) {
            case ServiceModalPaymentType::PRIMARY_PAID:
                $this->keyValuePairs['PRIMARY_PAID_VISIBILITY'] = "";
                break;
            case ServiceModalPaymentType::SECONDARY_PAID:
                $this->keyValuePairs['SECONDARY_PAID_VISIBILITY'] = "";
                break;

            case ServiceModalPaymentType::TERTIARY_PAID:
                $this->keyValuePairs['TERTIARY_PAID_VISIBILITY'] = "";
                break;
            case ServiceModalPaymentType::NONE:
                $this->dontHideAnyPaymentFields();
                break;
            default:
                break;
        }
    }


}



?>