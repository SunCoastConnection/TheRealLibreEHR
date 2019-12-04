<?php 

abstract class ServiceModalPaymentType { 
	const PRIMARY_PAID = 0;
	const SECONDARY_PAID = 1;
	const TERTIARY_PAID = 2;
	const NONE = 3;
}



interface TemplateDataManager {
	public function getReplacementKeyValuePairs();
	public function getTemplateName();
}




?>