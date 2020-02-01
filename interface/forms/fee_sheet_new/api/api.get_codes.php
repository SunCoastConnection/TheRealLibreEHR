<?php
require_once("../../../globals.php");
// Get all the service categories.
$service_categories = ORM::for_table('list_options')
	                  ->select('title')->select('option_id')
                                       ->where_equal('list_id', 'superbill')
                                       ->where_equal('activity', 1)->find_array();
$result_array  = array();
foreach ( $service_categories as $service_category ) {
	$superbill_id = (int) $service_category['option_id'];
	$codes = ORM::for_table('codes')
		     ->select('code_type', 'codeType')
		     ->select('modifier')
		     ->select('code_text', 'description')
		     ->select('code')
		     ->where_equal('superbill', $superbill_id)
		     ->find_array();
	array_push( $result_array, array(
		'serviceCategory' => $service_category['title'],
		'codes' => $codes
	));
}

echo json_encode( $result_array );