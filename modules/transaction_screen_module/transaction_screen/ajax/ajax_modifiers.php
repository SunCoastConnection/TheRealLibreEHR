<?php 

require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
	require_once("$srcdir/sql.inc");

	$sql = "SELECT option_id, title FROM list_options WHERE list_id = ?";

	$modifier_list_id = "transactions_modifiers";

	$result = sqlStatement($sql, array($modifier_list_id));

	$resultArray = array();

	while ($row = sqlFetchArray($result)) {
		array_push($resultArray, $row);
	}

	echo json_encode($resultArray);



?>



