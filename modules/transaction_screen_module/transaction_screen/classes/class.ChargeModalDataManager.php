<?php

// class to create replacable key value pairs for replacing it in html

require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");

class ChargeModalDataManager implements TemplateDataManager  {

	private $keyValuePairs;

	function __construct($keyValuePairs) {
		$this->keyValuePairs = $keyValuePairs;
	}

	public function getReplacementKeyValuePairs() {
		return $this->keyValuePairs;
	}

	public function getTemplateName() {
		return "charges_modal";
	}

}
