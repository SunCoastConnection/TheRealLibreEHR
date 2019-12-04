<?php
// inserts the global to the db
function insert_or_update_global($key, $value) {
	// check if exists, then update
	$global_record = ORM::for_table('globals')
		->where("gl_name", $key)
		->where("gl_index", $_SESSION['authUserID'])
		->find_one();

	if ($global_record == false) {
		// if the record didnt exist then create it
		$global_record = ORM::for_table('globals')
						 ->create();
		$global_record->gl_index = $_SESSION['authUserID'];
	}
	
	$global_record->gl_name = $key;
	$global_record->gl_value = $value;
	return $global_record->save();
}

function getGlobalValue($key) {

    $user_id = $_SESSION['authUserID'];

    $row = ORM::for_table('globals')
            ->select('gl_value')
            ->where('gl_name', $key)
            ->where('gl_index', $user_id)
            ->find_array()[0]['gl_value'];

    return $row;
}
