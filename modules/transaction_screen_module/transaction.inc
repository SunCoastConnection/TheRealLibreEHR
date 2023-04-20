<?php
/*
 *  Helper functions for the transaction screen
 *
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-license.php.
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
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/patient.inc");

/**
 * Return user's name using user Id
 * @param  integer $user_id Id of user to return
 * @return string Specified user lname and fname
 */
function getUserLnameFname($user_id) {
    $user_id = (int)$user_id;
    $user = sqlQuery('SELECT lname, fname FROM users WHERE id = ?;', array($user_id));
    return $user['lname'].' '.$user['fnmame'];
}

// Get the payer_id for the supplied pid and case_number
function getPayerId($pid, $case_number ,$ins_type) {
    error_log("PID: " . $pid . " Case number: " . $case_number . " INSURANCE type: " . $ins_type);
    $provider = sqlQuery("SELECT provider FROM insurance_data WHERE pid = ? AND case_number = ? AND type = ?", array($pid, $case_number ,$ins_type));
    return $provider['provider'];
}

// Get the insurance name for the particular provider ($payer_id in this case)
function getInsuranceName($payer_id) {
    $insurance = sqlQuery("SELECT name FROM insurance_companies WHERE id = ?", array($payer_id));
    return $insurance['name'];
}

// Log transaction actions to the transactions_log table
function logTransactionAction($dateTime, $description, $encounter, $change, $billing_id, $pid, $user_id) {
    $log = sqlInsert("INSERT INTO transactions_log (date, description, encounter, change_made, billing_id, pid, user_id)
    VALUES (?,?,?,?,?,?,?)", array($dateTime, $description, $encounter, $change, $billing_id, $pid, $user_id));

    // return html to update the view after saving action
    if ($log) {
        $date = $time = '';
        list($date, $time) = explode(" ", $dateTime);
        $audit_html = '<ul class="list-group list-group-flush" style="list-style: none;">
            <li><span  style="float: left"><strong>'.oeFormatShortDate($date).'</strong>&nbsp;'.oeFormatTime($time).'</span><span  style="float: right"><strong>'.getUserLnameFname($user_id).'</strong></span></li>
            <li><span  style="float: left">'.$description.'</span><span style="float: right; color: grey">'.$change.'</span></li>
        </ul><br>';
        return $audit_html;
    } else {
        return "ERROR: couldn't log this action!";
    }
}
?>
