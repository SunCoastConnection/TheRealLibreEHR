<?php

/**
* This file gives data to the transaction screen after a search
*/
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once($GLOBALS['fileroot'].'/custom/code_types.inc.php');

if (isset($_REQUEST)) {
	if (!empty($_REQUEST)) {
		$search_term = $_REQUEST['search_term'];
		$code_type = $_REQUEST['code_type'];
		$result = main_code_set_search($code_type,$search_term);
	    $resultArray = array();
		
	    while ($row = sqlFetchArray($result)) {
	    	array_push($resultArray, $row);
	    }

	    echo json_encode($resultArray);
	}
}

?>
