<?php
require_once("../classes/class.TemplateLoader.php");
require_once("../classes/class.ChargeModalDataManager.php");

if (isset($_REQUEST)) {
	if (!empty($_REQUEST)) {
		$payment_object = $_REQUEST['charge_modal_data']['payment_object'];

		// add payment_ suffix to keys
		$template_payment_object = array_combine(
								   		array_map(function($k){ return 'payment_'.$k; }, array_keys($payment_object)),
										$payment_object
									);

		$templateDataManagerInstance = new ChargeModalDataManager($template_payment_object);
		$templateLoader = new TemplateLoader($templateDataManagerInstance);

		echo $templateLoader->getOutput();
	}
}

?>
