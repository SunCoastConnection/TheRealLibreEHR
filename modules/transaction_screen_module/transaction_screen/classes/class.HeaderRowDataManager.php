<?php 
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");
require_once(__DIR__."/../interfaces/interface.TemplateDataManager.php");
require_once("class.GenericRowDataManager.php");


class HeaderRowDataManager implements TemplateDataManager  {

	private $keyValuePairs;

	function __construct($enc_row, $case_description, $row_count, $therapist_name)
	{
		$this->keyValuePairs = array(
			"JOINED_CASE_DESCRIPTION"=>$case_description,
			"ROW_COUNT"=>$row_count,
			"THERAPIST_NAME"=>$therapist_name,
			"ENCOUNTER_PID"=>$enc_row['pid'],
			"ENCOUNTER_CASE_NUMBER"=>$enc_row['case_number'],
			"ENCOUNTER_CASE_BODY_PART"=>$enc_row['case_body_part'],
			"ENCOUNTER_FORMATTED_DATE"=>oeFormatShortDate(substr($enc_row['date'],0,10)),
			"ENCOUNTER_REASON"=>$enc_row['reason'],
			"ENCOUNTER_ENCOUNTER"=>$enc_row['encounter'],
			"ENCOUNTER_FACILITY"=>GenericRowDataManager::getFacilityNameByFacilityId($enc_row['facility_id'])
		);
	}

	public function getReplacementKeyValuePairs() {
		return $this->keyValuePairs;
	}

	public function getTemplateName() {
		return "header_row_template";
	}
}
?>