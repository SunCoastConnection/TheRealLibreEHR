<?php 
/**
* The date edits made on the screen is saved using this code
*/

require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
if (isset($_REQUEST)) {
	if (!empty($_REQUEST)) {

		switch ($type) {
			
			case 'billing_table_row':
				$billing_record = ORM::for_table('billing')
				->where("id", $billing_id)
				->find_one();
				$billing_record->date = $changed_date;
				$billing_record->save();
				break;
			
			case 'ar_activity_row':
				$pid = $_REQUEST['pid'];
				$encounter = $_REQUEST['encounter'];
				$sequence_no = $_REQUEST['sequence_no'];

				ORM::configure('id_column', array('sequence_no'));

				$ar_activity_record = ORM::for_table('ar_activity')							
										->where('sequence_no', $sequence_no)
										->find_array()[0];

				// get session id from ar_activity

				echo $session_id = $ar_activity_record['session_id'];
				
				ORM::configure('id_column', array('session_id'));
				$ar_session_record = ORM::for_table('ar_session')
									->where('session_id', $session_id)					
									->find_one();

				$ar_session_record->check_date = $changed_date;
				$ar_session_record->save();				
				break;

			default:
				# code...
				break;
		}





	}
}


?>