<?php 


require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");

abstract class ServiceModalRowType { 
	const CHARGES_ROW = 0;
	const INSURANCE_ROW = 1;
	const PATIENT_PAYMENT_ROW = 2;

} 


abstract class ServiceModalTriggeringLocation { 
	const MAIN_TABLE = 0;
	const PAYMENT_MODAL = 1;
}



class ServiceModalRowDataManager implements TemplateDataManager  {

	private $keyValuePairs;

	public function __construct($rowObject) {
		$this->keyValuePairs = $rowObject;
		$this->createCssBackgroundColorClass();
		$this->showCheckBoxForPatientPaymentRow($rowObject);
		$this->showModifiersForChargeRow($rowObject);
		$this->alterServiceModalBasedOnTriggeringLocation();
		$this->alterServiceModalBasedOnPaymentType();
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

	private function alterServiceModalBasedOnTriggeringLocation() {

		$triggering_location  = $this->keyValuePairs['ServiceModalTriggeringLocation'];

		switch ($triggering_location) {
			
			case ServiceModalTriggeringLocation::MAIN_TABLE:
				$this->keyValuePairs['IS_PAYMENT_FIELDS_DISABLED'] = "disabled=true";
				break;
			
			case ServiceModalTriggeringLocation::PAYMENT_MODAL:
				$this->keyValuePairs['IS_PAYMENT_FIELDS_DISABLED'] = "";
				break;

			default:
				# code...
				break;
		}
	}

	private function createCssBackgroundColorClass() {
		$description = $this->keyValuePairs['description'];
		$css_class = strtolower($description);
		$css_class = str_replace(" ", "-", $css_class);
		$css_class .= "-row";
		$this->keyValuePairs['CSS_CLASS'] = $css_class;
	}

	private function showModifiersForChargeRow($rowObject) {
		$this->keyValuePairs['MOD_1'] = "";
		$this->keyValuePairs['MOD_2'] = "";
		$this->keyValuePairs['MOD_3'] = "";
		$this->keyValuePairs['MOD_4'] = "";

		if ($rowObject['rowType'] == ServiceModalRowType::CHARGES_ROW) {
			
			$modifier_array = explode(" ", $rowObject['modifiers']);

			for ($i = 0; $i < count($modifier_array); $i++) {
				$j = $i + 1;
				$this->keyValuePairs['MOD_'.$j] = $modifier_array[$i];
			}

		
		}
	}

	private function showCheckBoxForPatientPaymentRow($rowObject) {

		if ($rowObject['rowType'] == ServiceModalRowType::PATIENT_PAYMENT_ROW) {

			$this->keyValuePairs['CHECK_BOX'] = "<input type='checkbox'>";
		
		}
		else {
			$this->keyValuePairs['CHECK_BOX'] = "";
		}
	}


	public function getReplacementKeyValuePairs() {

		return $this->keyValuePairs;

	}

	public function getTemplateName() {
		$row_type = $this->keyValuePairs['rowType'];
		switch ($row_type) {
			case ServiceModalRowType::CHARGES_ROW:
				return "charge_row_service_modal_template";
				break;
			case ServiceModalRowType::INSURANCE_ROW:
				return "insurance_row_service_modal_template";
				break;
			case ServiceModalRowType::PATIENT_PAYMENT_ROW:
				return "patient_payment_row_service_modal_template";
				break;
			default:
				# code...
				break;
		}
		
	}



}


?>