<?php

require_once("../../interface/globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/patient.inc");

require_once("transaction.inc");

// Save patient payment
if (isset($_POST['payment_pid'])) {
    //error_log("Saving payment_type: ".print_r($_POST, true));
    //error_log("Session: ".print_r($_SESSION, true));

    $n = $_POST['send_n'];
    $pid = $_POST['payment_pid'];
    $acct_ref = $_POST['payment_acct_ref'];
    $case_number = $_POST['payment_case'];
    $encounter = $_POST['payment_encounter'];
    $payment_amount = $_POST['payment_amount'];
    $payment_billing_id = $_POST['payment_billing_id'];

    if (empty($payment_billing_id)) {
        $payment_billing_id = 0;
    }

    if (isset($_POST['payment_patient'])) {
        $payer_id = 0;
        $payer_type = 0;
        $not_applied = 1;
        $account_code = 'PP';
        $payment_type = 'patient';
        $description = getPatientName($pid);
        $adjustment_code = 'patient_payment';
        $code_text = $_POST['payment_patient'];
    }
    else if($_POST['payment_primary'] || $_POST['payment_secondary'] || $_POST['payment_tertiary']) {
        $account_code = 'IPP';
        $payment_type = 'insurance';
        $adjustment_code = 'insurance_payment';
        $not_applied = 0;
        $acct_ref = $_POST['payment_acct_ref'];

        if ($_POST['payment_primary']) {
            $payer_type = 1;
            $code_text = $_POST['payment_primary'];
            $ins_type = 'primary';
        }
        if ($_POST['payment_secondary']) {
            $payer_type = 2;
            $code_text = $_POST['payment_secondary'];
            $ins_type = 'secondary';
        }
        if ($_POST['payment_tertiary']) {
            $payer_type = 3;
            $code_text = $_POST['payment_tertiary'];
            $ins_type = 'tertiary';
        }
        $payer_id = getPayerId($pid, $case_number, $ins_type);
        $description = getInsuranceName($payer_id);

        if (!$description) {
            $description = "None";

            $end_result = array('error_message' => 'No Insurance company exists for this payment.');

            // preparing correct format for json_encode
            header('Content-type: application/json');
            echo json_encode(array('result' => $end_result)); //sending response to ajax
            die();
        }

    }
    else {
        echo "The payment must be 'Patient' in order to proceed this route.";
        die();
    }

    $date = date('Y-m-d');
    $dateTime = date('Y-m-d H:i:s');
    $payment_method = str_replace(' ', '_', strtolower($_POST['payment_method']));

//    sqlInsert("INSERT INTO billing (date, pid, encounter, code_text) VALUES (?,?,?,?)", array($date, $pid, $encounter, $code_text));

    // HAVE i used the correct values for reference and pay_total here???

    $session_id = sqlInsert("INSERT INTO ar_session (payer_id, user_id, reference, check_date, deposit_date, pay_total, created_time, payment_type, description, adjustment_code, post_to_date, patient_id, payment_method)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", array($payer_id, $_SESSION['authUserID'], $acct_ref, $date, $date, $payment_amount, $dateTime, $payment_type, $description, $adjustment_code, $date, $pid, $payment_method));

    sqlInsert("INSERT INTO ar_activity (pid, encounter, billing_id, payer_type, post_time, post_user, session_id, pay_amount, account_code, unapplied)
    VALUES (?,?,?,?,?,?,?,?,?,?)", array($pid, $encounter, $payment_billing_id, $payer_type, $dateTime, $_SESSION['authUserID'], $session_id, $payment_amount, $account_code, $not_applied));

    $sequence_no = sqlQuery("SELECT `sequence_no` FROM `ar_activity` WHERE `encounter` = ? AND `pid` = ? ORDER BY `sequence_no` DESC LIMIT 1", array($encounter, $pid));

    $renderHtml = '<tr id="sequence_no_'.$sequence_no.'" class="table-detail-data x-rows-' . $n . ' '.$n.' collapse show" onclick="showPaymentModal('.$n.','.$pid.','.$encounter.','.$sequence_no.','.$payment_amount.','.$payment_billing_id.')" style="background-color: #FFC4C0 !important">
        <td></td>
        <td class="date-detail">' . oeFormatShortDate(substr($date,0,10)) . '</td>';

    $log_desc = '';

    if (isset($_POST['payment_patient'])) {
        $renderHtml .= '<td colspan="6" class="description">' . $code_text . '</td>';
        $log_desc = $code_text;
    } else {
        $renderHtml .= '<td colspan="6" class="description">' . $description . '</td>';
        $log_desc = $description;
    }

    $renderHtml .= '<td class="amount pat-paid-total pat-paid" id="patient-paid-total-'.$n.'" data-total-patient-paid="' . $payment_amount . '">$' . $payment_amount . '</td>
        <td></td>
        <td class="adj-amount-detail-' . $n . ' adjusted" id="adj-amount-row-'.$n.'" data-amount="0.00">$0.00</td>
        <td class="adj-reason-detail-' . $n . ' adj-reason" id="adj-reason-row-'.$n.'"></td>
        <td></td>
     </tr>';

     $endresult = array('n' => $n, 'renderHtml' => $renderHtml, 'pay_date' => $date, 'amt_paid' => $payment_amount);
     if ($_POST['payment_primary']) {
         $endresult = array_merge($endresult, array('primary' => $payment_amount));
     }
     if ($_POST['payment_secondary']) {
         $endresult = array_merge($endresult, array('secondary' => $payment_amount));
     }
     if ($_POST['payment_tertiary']) {
         $endresult = array_merge($endresult, array('tertiary' => $payment_amount));
     }
     if ($_POST['payment_patient']) {
         $endresult = array_merge($endresult, array('patient' => $payment_amount));
     }

     // log this patient payment action in the transactions_log table
     $log_description = "Made a ".$log_desc;
     $change = "$".$payment_amount." payment.";
     $audit_html = logTransactionAction($dateTime, $log_description, $encounter, $change, $payment_billing_id, $pid, $_SESSION["authUserID"]);
     if ($audit_html) {
         $endresult = array_merge($endresult, array('audit_html' => $audit_html));
     }

     // preparing correct format for json_encode
      header('Content-type: application/json');
      echo json_encode(array('result' => $endresult)); //sending response to ajax
}

// Update patient payment record
if (isset($_POST['edit_sequence_no'])) {
    //error_log("EDIT POST array: ".print_r($_POST, true));
    $endresult = array();
    $dateTime = date('Y-m-d H:i:s');
    $payment_amount = number_format($_POST["edit_payment_amount"], 2);
    $adj_amount = number_format($_POST["edit_adj_amount"], 2);
    $adj_reason = $_POST["edit_adj_reason"];
    $updated = sqlStatement("UPDATE ar_activity SET pay_amount = ?, adj_amount = ?, reason_code = ?, modified_time = ? WHERE sequence_no = ? AND pid = ? AND encounter = ?", array($payment_amount, $adj_amount, $adj_reason, $dateTime, $_POST["edit_sequence_no"], $_POST["edit_pid"], $_POST["edit_encounter"]));
    if ($updated) {
        $description = "Updated patient payment.";
        $change = "$" . $_POST["old_payment_amount"] . " to $" . $_POST["edit_payment_amount"];
        $audit_html = logTransactionAction($dateTime, $description, $_POST["edit_encounter"], $change, $_POST['edit_billing_id'], $_POST["edit_pid"], $_SESSION["authUserID"]);

        //echo $_POST['edit_sequence_no'];
        $endresult = array_merge($endresult, array('sequence_no' => $_POST['edit_sequence_no'], 'audit_html' => $audit_html));
    }
    else {
        $failure = "Failed to update payment";
        $endresult = array_merge($endresult, array('failure' => $failure));
    }

    // preparing correct format for json_encode
     header('Content-type: application/json');
     echo json_encode(array('result' => $endresult)); //sending response to ajax
}


// Save charges
if (isset($_POST['charges_cpt_code'])) {
    //error_log("charge post here: " . print_r($_POST, true));
    $dateTime = date('Y-m-d H:i:s');

    $send_n = $_POST['send_n'];
    $pid = $_POST['charges_pid'];
    $units = $_POST['charges_units'];
    $mod_1 = $_POST['charges_mod_1'];
    $mod_2 = $_POST['charges_mod_2'];
    $modifier = $mod_1 . ' ' . $mod_2;
    $code = $_POST['charges_cpt_code'];
    $case_number = $_POST['case_number'];
    $fee_amount = $_POST['charges_amount'];
    $encounter = $_POST['charges_encounter'];
    $code_type = $_POST['charges_code_type'];
    $code_text = $_POST['charges_description'];

    $charges_date = $_POST['charges_modal_date'];
    if (empty($charges_date)) {
        $charges_date = "NOW()";
    }

    $charges_billing_id = sqlInsert('INSERT INTO billing (case_number, date, code_type, code, pid, provider_id, user, groupname, authorized, encounter, code_text, billed, activity, units, fee, modifier)
        VALUES (?,?,?,?,?,0,?,?,?,?,?,0,1,?,?,?)',
        array($case_number, $charges_date, $code_type, $code, $pid, $_SESSION['authUserID'], $_SESSION['authGroup'], $_SESSION['userauthorized'], $encounter, $code_text, $units, $fee_amount, $modifier));

    $desc = "Added charge with code: " . $code_type . ":" . $code;
    $change = "$" . $fee_amount . " charge.";

    $audit_html = logTransactionAction($dateTime, $desc, $encounter, $change, $charges_billing_id, $pid, $_SESSION["authUserID"]);

    $end_result = array('message' => "Charge successfully saved", 'audit_html' => $audit_html);

    // preparing correct format for json_encode
     header('Content-type: application/json');
     echo json_encode(array('result' => $end_result)); //sending response to ajax
}

// Save claim
if (isset($_POST['claim_pid'])) {
    $dateTime = date('Y-m-d H:i:s');

    $pid = $_POST['claim_pid'];
    $units = 1;
    $ins_code = $_POST['claim_ins_code'];
    $case_number = $_POST['claim_case_number'];
    $encounter = $_POST['claim_encounter'];

    $claim_type = $_POST['claim_claim_type'];
    $claim_amount = $_POST['claim_amount'];
    $claim_billing_id = $_POST['claim_billing_id'];

    sqlStatement("UPDATE billing SET billed = 0, ready_to_bill = 1 WHERE case_number = ? AND pid = ? AND encounter = ?", array($case_number, $pid, $encounter));

    $desc = "Added $claim_type insurance claim";
    $change = "$" . $claim_amount . " claim.";

    $audit_html = logTransactionAction($dateTime, $desc, $encounter, $change, $claim_billing_id, $pid, $_SESSION["authUserID"]);

    $end_result = array('message' => "Claim successfully saved", 'audit_html' => $audit_html);

    // preparing correct format for json_encode
     header('Content-type: application/json');
     echo json_encode(array('result' => $end_result)); //sending response to ajax
}

// Delete selected line items
if (isset($_POST['billing_ids'])) {
    error_log(print_r($_POST['billing_ids'], true));

    foreach ($_POST['billing_ids'] as $id) {
        sqlStatement("DELETE FROM billing WHERE id=?", array($id));
        error_log("deleted bill number: " . $id);
    }

    $dateTime = date('Y-m-d H:i:s');
    $desc = "Deleted " . sizeof($_POST['billing_ids']) . " line items.";
    $change = "Deleted line items.";

    $audit_html = logTransactionAction($dateTime, $desc, $_POST['del_encounter'], $change, 0, $pid, $_SESSION["authUserID"]);

    $end_result = array('message' => "Line item(s) deleted successfully.", 'audit_html' => $audit_html);

    // preparing correct format for json_encode
     header('Content-type: application/json');
     echo json_encode(array('result' => $end_result)); //sending response to ajax
}

// This blocks handles closing a visit. i.e after clicking the "Close Visit" button.
// this section isn't reached if the unapplied_fee != balance_fee.
if (isset($_POST['close_visit_balance_fee'])) {
    //error_log("CLOSE VISIT SESSION: " . print_r($_SESSION, true));
    //error_log("CLOSE VISIT: " . print_r($_POST, true));

    $pid = $_SESSION['pid'];
    $encounter = $_POST['close_visit_encounter'];
    $balance_fee = $_POST['close_visit_balance_fee'];
    $unapplied_fee = $_POST['close_visit_unapplied_fee'];
    //$unapplied_fee = 215;

    $indol1 = sqlStatement("SELECT a.code_type, a.code, a.modifier, a.encounter, a.memo, a.post_time, a.payer_type, a.adj_amount, a.pay_amount, a.account_code, a.unapplied, " .
      "s.payer_id, a.billing_id, a.reason_code, s.reference, s.check_date, s.deposit_date " .
      "FROM ar_activity AS a " .
      "LEFT JOIN ar_session AS s ON s.session_id = a.session_id WHERE " .
      "a.pid = ? " .
      "ORDER BY s.check_date, a.sequence_no", array($pid) );

      // Adjustments.
      $indrows = array();
      while ($indrow1 = sqlFetchArray($indol1)) {
        array_push($indrows, $indrow1);
      }

    // get all billing records
    $bills = sqlStatement("SELECT * FROM billing WHERE pid = ? AND encounter = ? AND activity = 1 ORDER BY date DESC", array($pid, $encounter));

    sqlStatement("UPDATE `ar_activity` SET `inactive`=1 WHERE pid = ? AND encounter = ? AND inactive=0", array($pid, $encounter));

    foreach ($bills as $bill) {
        if ($bill['code_type'] == 'CPT4') {
            if ($bill['encounter'] == $encounter) {
                $pat_pay_amt = 0.00;
                $ins_pay_amt = 0.00;
                $adj_amt = 0.00;

                foreach ($indrows as $inrownew) {
                    if ($inrownew['billing_id'] == $bill['id']) {
                        switch ($inrownew['account_code']) {
                            case 'PP':
                            case 'PCP':
                                $pat_pay_amt +=  $inrownew['pay_amount'];
                                break;
                            case 'IPP':
                                $ins_pay_amt +=  $inrownew['pay_amount'];
                                break;
                            case 'ADJ':
                                $adj_amt += $inrownew['adj_amount'];
                                break;
                            default:
                                $pat_pay_amount += 0.00;
                                $ins_pay_amt += 0.00;
                                $adj_amt += 0.00;
                                break;
                        }
                    }
                }
                $bill_balance = $bill['fee'] - $pat_pay_amt - $ins_pay_amt - $adj_amt;

                echo json_encode(array(
                    "fee"=>$bill['fee'],
                    "pat_pay_amt"=>$pat_pay_amt,
                    "ins_pay_amt"=>$ins_pay_amt,
                    "adjustment_amount"=>$adj_amt,
                    "bill_balance"=>$bill_balance
                ));

                if ($bill_balance > 0) {
                    $balance_fee = $balance_fee - $bill_balance;

                    // Now apply a patient payment here
                    $payer_id = 0;
                    $payer_type = 0;
                    $not_applied = 1;
                    $account_code = 'PP';
                    $date = date('Y-m-d');
                    $payment_type = 'patient';
                    $dateTime = date('Y-m-d H:i:s');
                    $description = getPatientName($pid);
                    $adjustment_code = 'patient_payment';
                    $code_text = $_POST['payment_patient'];

                    $payment_method = 'unapplied amount';

                    $unapplied = 0;

                    // set inactive = 1 for all the patient payments before creating a new patient payment




                    $session_id = sqlInsert("INSERT INTO ar_session (payer_id, user_id, check_date, deposit_date, pay_total, created_time, payment_type, description, adjustment_code, post_to_date, patient_id, payment_method)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", array($payer_id, $_SESSION['authUserID'], $date, $date, $bill_balance, $dateTime, $payment_type, $description, $adjustment_code, $date, $pid, $payment_method));

                    $activity_id = sqlInsert("INSERT INTO ar_activity (pid, encounter, payer_type, post_time, post_user, session_id, pay_amount, account_code, unapplied, date_closed)
                    VALUES (?,?,?,?,?,?,?,?,?,?)", array($pid, $encounter, $payer_type, $dateTime, $_SESSION['authUserID'], $session_id, $bill_balance, $account_code, $unapplied, $date));
                }
            }
        }
    }

    echo "I have seen the post you sent";
}


 function saveAdjustmentPayment($adj_reason, $billingId, $adjustment_amount, $type, $date, $dateTime, $pid, $encounter, $bill, $payer_type, $payment_amount){
    if (empty($adj_reason)) {
        $adj_reason = "";
    }

    $session_id = sqlInsert("INSERT INTO ar_session (payer_id, user_id, reference, check_date, deposit_date, pay_total, created_time, payment_type, description, adjustment_code, post_to_date, patient_id, payment_method)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", array(00000, $_SESSION['authUserID'], $type, $date, $date, $adjustment_amount, $dateTime, $type, $type, $type, $date, $pid, $type));

    sqlInsert("INSERT INTO ar_activity (pid, encounter, billing_id, code_type, code, payer_type, post_time, post_user, session_id, memo, adj_amount, account_code, unapplied)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,0)", array($pid, $encounter, $billingId, $bill['code_type'], $bill['code'], $payer_type, $dateTime, $_SESSION['authUserID'], $session_id, $adj_reason, $adjustment_amount, 'ADJ'));

    $change = "$".$payment_amount." adjustment";
    $desc = 'Made an ' . $type;
    logTransactionAction($dateTime, $desc, $encounter, $change, $billingId, $pid, $_SESSION["authUserID"]);
}


function getPayerIdAndInsuranceName($pid,$case_number, $ins_type) {

    $payer_id = getPayerId($pid,$case_number, $ins_type);

    if (!$payer_id) {
        $payer_id = 00000;
    }

    $description = getInsuranceName($payer_id);

    if (!$description) {
        $description = "None";

        $end_result = array('error_message' => 'No '.$ins_type.' Insurance company exists for this payment.');

        // preparing correct format for json_encode
        header('Content-type: application/json');
        echo json_encode(array('result' => $end_result)); //sending response to ajax
        die();
    }
    return array($payer_id, $description);

}

function saveTableRowItem (
                            $row,
                            $case_number,
                            $acct_ref,
                            $date,
                            $payment_amount,
                            $dateTime,
                            $payment_type,
                            $description,
                            $adjustment_code,
                            $pid,
                            $payment_method,
                            $encounter,
                            $bill,
                            $payer_type,
                            $ins_type,
                            $billingId)
  {

    list($payer_id, $description) = getPayerIdAndInsuranceName($pid,$case_number, $ins_type);

    $session_id = sqlInsert("INSERT INTO ar_session (payer_id, user_id, reference, check_date, deposit_date, pay_total, created_time, payment_type, description, adjustment_code, post_to_date, patient_id, payment_method)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", array($payer_id, $_SESSION['authUserID'], $acct_ref, $date, $date, $payment_amount, $dateTime, $payment_type, $description, $adjustment_code, $date, $pid, $payment_method));

    // write payment amount
    sqlInsert("INSERT INTO ar_activity (pid, encounter, billing_id, code_type, code, payer_type, post_time, post_user, session_id, pay_amount, account_code, unapplied)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,0)", array($pid, $encounter, $billingId, $bill['code_type'], $bill['code'], $payer_type, $dateTime, $_SESSION['authUserID'], $session_id, $payment_amount, 'IPP'));

    $change = "$".$payment_amount." payment";
    $desc = $description . ' made a ' . $ins_type . ' payment.';

    logTransactionAction($dateTime, $desc, $encounter, $change, $billingId, $pid, $_SESSION["authUserID"]);

    // log all the adjustment items and adjustment reasons
    $row_adjustment_reason_array = $row['adjustment_reason'];
    $row_adjustment_amount = $row['adjustment_amount'];

    for ($i = 0; $i < count($row_adjustment_amount); $i++) {

            $adj_reason = $row_adjustment_reason_array[$i];
            $adjustment_amount = $row_adjustment_amount[$i];

            saveAdjustmentPayment($adj_reason, $billingId, $adjustment_amount, $type, $date, $dateTime, $pid, $encounter, $bill, $payer_type, $payment_amount);

    }





}


// Save the service modal details i.e Insurance payment
if (isset($_POST['paymentObject']) && isset($_POST['tableObject'])) {
    $audit_html = '';
    $total_ins_paid = 0;
    $paymentObject = $_POST['paymentObject'];
    $tableObject = $_POST['tableObject'];
    // assign values from payment object here
    $description = $paymentObject['type']." Payment";
    $total_ins_paid += $paymentObject['amount'];
    $ins_type = str_replace(" ", "", str_replace("payment","",strtolower($paymentObject['type'])));
    $case_number = $paymentObject['case'];
    $acct_ref = $paymentObject['acct_ref'];

    $date = date('Y-m-d');
    $dateTime = date('Y-m-d H:i:s');
    $code_text = "Test code text";
    $pid = $_SESSION['pid'];
    $payment_amount = 15;
    $payment_method = str_replace(' ', '_', strtolower($paymentObject['method']));
    $payment_type = 'insurance';
    $adjustment_code = 'insurance_payment';
    $encounter = $paymentObject['encounter'];

    foreach ($tableObject as $row) {

        switch ($ins_type) {
            case 'primary':
                $payer_type = 1;
                $payment_amount = $row['primary_paid'];
                break;
            case 'secondary':
                $payer_type = 2;
                $payment_amount = $row['secondary_paid'];
                break;
            case 'tertiary':
                $payer_type = 3;
                $payment_amount = $row['tertiary_paid'];
                break;
            default:
                break;
        }

        // get individual billing ids
        $billingId = $row['billing_id'];

        // if no billingid exists then they are payment rows

        if (!empty($billingId) && !empty($payment_amount) && $payment_amount != "") {

            $bill = sqlQuery("SELECT code, code_type, code_text FROM billing WHERE id = ?", array($billingId));
            // each rows holds the data of billing id, mod_1, mod_2, mod_3, mod_4,
            // paid, adj_item


            saveTableRowItem ($row,
                                $case_number,
                                $acct_ref,
                                $date,
                                $payment_amount,
                                $dateTime,
                                $payment_type,
                                $description,
                                $adjustment_code,
                                $pid,
                                $payment_method,
                                $encounter,
                                $bill,
                                $payer_type,
                                $ins_type,
                                $billingId);
        }

    }

}

 ?>
