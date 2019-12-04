<?php 
/**
* This file saves patient note to patient data table
*/

require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
$pid = $_REQUEST['pid'];

if (isset($_REQUEST['get_notes'])) {

	echo ORM::for_table('patient_data')
					->select('transaction_billing_note')
					->where("pid", $pid)
					->find_one()['transaction_billing_note'];
}

if (isset($_REQUEST['save_notes'])) {

	$transaction_note = $_REQUEST['transaction_note'];
	
	ORM::configure('id_column_overrides', array(
    	'patient_data' => 'pid'
	));

	$row = ORM::for_table('patient_data')
					->find_one($pid);

	$row->set('transaction_billing_note', $transaction_note);
	$row->save();
	
}