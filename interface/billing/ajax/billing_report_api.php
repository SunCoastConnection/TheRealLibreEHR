<?php
require_once("../../globals.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/sql.inc");

require_once("$srcdir/global_functions.php");

if (isset($_POST['form_encounter_id'])) {
    if (!empty($_POST['form_encounter_id'])) {
        echo $toggle = $_POST['toggle'];
        $form_encounter_id = $_POST['form_encounter_id'];
        $query = "UPDATE `form_encounter` SET coding_complete=? WHERE id=?";
        $binding_array = array($toggle, $form_encounter_id);
        sqlStatement($query, $binding_array);
    }
}

if(isset($_REQUEST['save_selected_criteria'])) {
    $selected_criteria = json_encode($_REQUEST['selected_criteria']);
    echo insert_or_update_global("billing_page_selected_criteria", $selected_criteria);
}