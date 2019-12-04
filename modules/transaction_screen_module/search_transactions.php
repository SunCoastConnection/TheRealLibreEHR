<?php
/*
 *  search_transactions.php for the searching for transactions using either patient's name, DOB, case or facility
 *
 *  This program searches for transactions
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package LibreEHR
 *
 * @link http://libre.org
 *
 * Please help the overall project by sending changes you make to the author and to the LibreEHR community.
 *
 */
require_once("../../interface/globals.php");

$encounter_date = $_REQUEST['encounter_date'];
$name = $_REQUEST['name'];
$dob = $_REQUEST['dob'];


$patient_data_rows = ORM::for_table('patient_data')
                        ->inner_join('form_encounter', array('patient_data.pid', '=', 'form_encounter.pid'))
                        ->select('patient_data.pid')
                        ->select('form_encounter.encounter')
                        ->select('fname')
                        ->select('mname')
                        ->select('lname')
                        ->select('DOB')
                        ->select_expr('DATE(form_encounter.date)', 'date');

if ($name != "") {
    // it can be fname or lname
    $name_like_string = "%$name%";
    $patient_data_rows = $patient_data_rows
    ->where_raw('(`fname` LIKE ? OR lname LIKE ? OR mname LIKE ?)', array($name_like_string, $name_like_string, $name_like_string));
}

if ($dob != "") {
    $patient_data_rows = $patient_data_rows->where('DOB', $dob);
}
if ($encounter_date != "") {
    $patient_data_rows = $patient_data_rows->where('form_encounter.date', $encounter_date);
}

echo json_encode($patient_data_rows->find_array());