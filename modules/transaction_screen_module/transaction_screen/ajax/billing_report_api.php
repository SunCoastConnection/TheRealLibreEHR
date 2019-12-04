<?php
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/sql.inc");

if (isset($_POST)) {
    if (!empty($_POST)) {
        echo $toggle = $_POST['toggle'];
        $form_encounter_id = $_POST['form_encounter_id'];
        $query = "UPDATE `form_encounter` SET coding_complete=? WHERE id=?";
        $binding_array = array($toggle, $form_encounter_id);
        sqlStatement($query, $binding_array);
    }
}