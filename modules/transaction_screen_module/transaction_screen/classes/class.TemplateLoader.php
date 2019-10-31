<?php 

/**
 * class to load templates and return the rendered html with replaced values
 */
class TemplateLoader
{
	// template loader will replace {KEY} with {VALUE}, it is a simple template
	// engine

	private $templateHtml = NULL;
	
	// template data manager instance should know about the template file name,
	// every mapping should be done inside that class, the loader will only
	// know how to load the html
	
	private $templateDataManagerInstance;

	function __construct($templateDataManagerInstance)
	{	

		if ($templateDataManagerInstance != NULL){
			$this->templateDataManagerInstance = $templateDataManagerInstance;
			// load the template to the state variable
			$this->templateHtml = file_get_contents(__DIR__."/../templates/".$this->templateDataManagerInstance->getTemplateName().".html");
		}
		
	}

	public function setTemplateDataManagerInstance($instance) {
		$this->templateDataManagerInstance = $instance;
		if ($this->templateHtml == NULL) {
			$this->templateHtml = file_get_contents(__DIR__."/../templates/".$this->templateDataManagerInstance->getTemplateName().".html");
		}
	}

	public function getOutput() {

		$output_html = $this->templateHtml;

		$replacableKeyValuePairs = $this->templateDataManagerInstance->getReplacementKeyValuePairs();

		foreach ($replacableKeyValuePairs as $key => $value) {
			


			$output_html = str_replace("{".strtoupper($key)."}", $value, $output_html);
		}
		return $output_html;
	}

}

?>