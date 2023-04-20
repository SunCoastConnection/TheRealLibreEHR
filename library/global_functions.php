<?php
// inserts the global to the db
function insert_or_update_global($key, $value) {
    // check if exists, then update
    $global_record = ORM::for_table('globals')
        ->where("gl_name", $key)
        ->where("gl_index", $_SESSION['authUserID'])
        ->find_array();
    if ( count($global_record) > 0) {
        $result = ORM::raw_execute("UPDATE globals SET gl_value=:gl_value WHERE gl_index=:gl_index AND gl_name=:gl_name", array(
                'gl_index' => $_SESSION['authUserID'],
                'gl_value' => $value,
                'gl_name' => $key
            ));
    }
    else {
        // create a new record.
        $record = ORM::for_table('globals')->create();
        $record->gl_index = $_SESSION['authUserID'];
        $record->gl_value = $value;
        $record->gl_name = $key;
        return $record->save();
    }

}

function getGlobalValue($key) {

    $user_id = $_SESSION['authUserID'];

    $row = ORM::for_table('globals')
            ->select('gl_value')
            ->where('gl_name', $key)
            ->where('gl_index', $user_id)
            ->find_array();

    if ( count($row) > 0 ) {
        return $row[0]['gl_value'];
    }
    else {
        return false;
    }
}
