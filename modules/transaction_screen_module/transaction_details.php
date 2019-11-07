<?php
/*
 *  show_transactions_details.php for the showing the transactions after searching using pid
 *
 *  This program shows details for selected patient's transactions
 *
 *
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
require_once("$srcdir/classes/class.TransactionOverview.php");

require_once("transaction.inc");

require_once("transaction_screen/classes/class.TemplateLoader.php");
require_once("transaction_screen/classes/class.GenericRowDataManager.php");
require_once("transaction_screen/classes/class.InsuranceRowDataManager.php");
require_once("transaction_screen/classes/class.PaymentRowDataManager.php");
require_once("transaction_screen/classes/class.HeaderRowDataManager.php");

// Get transactions audit trail
if (isset($_POST['audit_pid'])) {
    $logs = sqlStatement("SELECT * FROM transactions_log WHERE pid = ? AND encounter = ? ORDER BY date DESC", array($_POST['audit_pid'], $_POST['audit_encounter']) );
    $renderHtml = '';
    foreach ($logs as $log) {
        $date = $time = '';
        list($date, $time) = explode(" ", $log['date']);
        $renderHtml .= '<ul class="list-group list-group-flush" style="list-style: none;">
            <li><span  style="float: left"><strong>'.oeFormatShortDate($date).'</strong>&nbsp;'.oeFormatTime($time).'</span><span  style="float: right"><strong>'.getUserLnameFname($log['user_id']).'</strong></span></li>
            <li><span  style="float: left">'.$log['description'].'</span><span style="float: right; color: grey">'.$log['change_made'].'</span></li>
        </ul><br>';
    }


    echo $renderHtml;
}


function getBillingNote($pid)
{
  return sqlQuery("SELECT billing_note FROM patient_data WHERE pid = ?", array($pid))['billing_note'];
}

function getAllCharges($pid) {
    $inres = sqlStatement("SELECT * FROM billing WHERE pid = ? AND code_type != 'COPAY' AND activity = 1 ORDER BY date DESC", array($pid) );
        // Charges
    $billed_encounters = array();
    while ($inrow = sqlFetchArray($inres)) {
      array_push($billed_encounters, $inrow['encounter']);
    }

    return $billed_encounters;
}




function getAllUnbilledEncounters($pid, $unbilled, $unbilled_encounters)
{
    $inres2 = sqlStatement("SELECT * FROM billing WHERE pid = ? AND code_type != 'COPAY' AND activity = 1 AND billed != 1  ORDER BY date DESC", array($pid) );

    while ($unrow = sqlFetchArray($inres2)) {
      $unbilled += sprintf('%01.2f', $unrow['fee']);
      array_push($unbilled_encounters, $unrow['encounter']);
      //error_log('UNROW : ' . print_r($unrow, true));
    }
  return array($unbilled_encounters);
}

function getAllArActivityRows($pid)
{
    $ar_activity_rows = ORM::for_table('ar_activity')
        ->join('ar_session',
            array('ar_activity.session_id', '=', 'ar_session.session_id'))
        ->where('ar_activity.inactive', '0')
        ->where('ar_activity.pid', $pid)
        ->find_array();

    return $ar_activity_rows;
}


function getTableHeaderRow($endresult, $enc_row, $joined_case_description, $n, $therapist_name)
{
          $templateLoader = new TemplateLoader(NULL);
          $HeaderRowDataManagerInstance = new HeaderRowDataManager(
                    $enc_row, $joined_case_description, $n, $therapist_name);

          $templateLoader->setTemplateDataManagerInstance($HeaderRowDataManagerInstance);
          $endresult .= $templateLoader->getOutput();

           return $endresult;
}

function iteratePaymentRowsTemplate($i_RowIterator, $i_InRowNewCount, $arr_PaymentDetails, $endresult, $n, $bill_count)
{

  $templateLoader = new TemplateLoader(NULL);
    // Unapplied payment rows
for ($i_RowIterator = 0; $i_RowIterator <= $i_InRowNewCount; $i_RowIterator++) {
    if ($arr_PaymentDetails[$i_RowIterator]['b_IsUnapplied'] == "1") {
        if ($arr_PaymentDetails[$i_RowIterator]['s_PaymentType'] != "Patient Payment") {
            $ins_item = '';
            if ($arr_PaymentDetails[$i_RowIterator]['s_PaymentType'] == "Primary Insurance Payment") {
                $ins_item = "'primary'";
            }
            elseif ($arr_PaymentDetails[$i_RowIterator]['s_PaymentType'] == "Secondary Insurance Payment") {
                $ins_item = "'secondary'";
            } elseif ($arr_PaymentDetails[$i_RowIterator]['s_PaymentType'] == "Tertiary Insurance Payment") {
                $ins_item = "'tertiary'";
            }

            $InsuranceRowDataManagerInstance = new InsuranceRowDataManager(
                          $arr_PaymentDetails[$i_RowIterator],
                          $n,
                          $bill_count,
                          $ins_item);

            $templateLoader->setTemplateDataManagerInstance($InsuranceRowDataManagerInstance);
            $endresult .= $templateLoader->getOutput();

        }
    }
}
return $endresult;

}

// returns whether the account code is empty, if empty
// then returns a valid account code
function findAccountCodeIfEmpty($ar_activity_row) {
    $account_code_empty = false;
    $account_code = $ar_activity_row['account_code'];
    if ($account_code == ""){
        $account_code_empty = true;
        $adjustments = intval($ar_activity_row['adj_amount']);
        $pay_amount = intval($ar_activity_row['pay_amount']);
        $payer_type = intval($ar_activity_row['payer_type']);
        if ($adjustments > 0) {
            $account_code = "ADJ";
        }
        else if ($pay_amount > 0 && ($payer_type == 1 || $payer_type == 2)) {
            $account_code = "IPP";
        }
    }

    return array($account_code, $account_code_empty);
}

function updateAccountCodeWhenEmpty($ar_activity_row) {
    list($account_code,$account_code_empty) = findAccountCodeIfEmpty($ar_activity_row);
    if ($account_code_empty) {
        // only update if the account code is empty
        updateArActivityRow(
                $ar_activity_row['sequence_no'],
                $billing_row['id'],
                $account_code);
    }
}

// this function is used to validate by
// pid, encounter and code when the billing id of the ar_activity_row is
// empty
function validateBillingId($ar_activity_row, $billing_row) {
    // check if billing id is empty or zero (the default value is empty)
    $isValid = true;
    $account_code = $ar_activity_row['account_code'];
    if ($ar_activity_row['billing_id'] == "" ||
        intval($ar_activity_row['billing_id']) == 0) {
        if ($account_code == "PP" || $account_code == "PCP") {
            // if patient payment row then compare only for pid and encounter
            $isValid = ( $billing_row['pid'] == $ar_activity_row['pid'] &&
                         $billing_row['encounter'] == $ar_activity_row['encounter'] );
        }
        else {
            $isValid = ( $billing_row['pid'] == $ar_activity_row['pid'] &&
                         $billing_row['encounter'] == $ar_activity_row['encounter'] &&
                         $billing_row['code'] == $ar_activity_row['code']);
        }

        // if valid then update the ar_activity row
        if ($isValid) {
            updateAccountCodeWhenEmpty($ar_activity_row);
        }

    }
    else {
        $isValid = ($ar_activity_row['billing_id'] == $billing_row['id']);
        updateAccountCodeWhenEmpty($ar_activity_row);
    }

    return $isValid;

}

function updateArActivityRow($sequence_no,
 $billing_id, $account_code) {
    $ar_activity_row = ORM::for_table('ar_activity')
        ->where('sequence_no', $sequence_no)
        ->find_one();

    $ar_activity_row->billing_id = $billing_id;
    $ar_activity_row->account_code = $account_code;
    $ar_activity_row->save();
}



if (isset($_REQUEST['pid'])) {
    // 1524933
    $pid = $_REQUEST['pid'];

    // encounter overview data array keeps track of every encounter
    // overview data, so we dont have to request it to again to speed up the time
    // in the ui, the key is encounter number for this array
    $encounter_overview_data = array();
    $billed_encounters = array();
    $unbilled_encounters = array();
    $billed_encounters = getAllCharges($pid);
    $billed_encounters = array_unique($billed_encounters);
    list($unbilled_encounters) = getAllUnbilledEncounters($pid, $unbilled, $unbilled_encounters);
    $unbilled_encounters = array_unique($unbilled_encounters);
    //error_log("THIS IS IT: " . print_r($inrows, true));
    // inres2 unbilled
    $billing_note = getBillingNote($pid);
    // unbilled amount but not unbilled encounters Maybe Open encounters ?
    $encounters = array_unique(array_merge($billed_encounters, $unbilled_encounters));
    //$encounters = sort($encounters1,date);
    $indrows = getAllArActivityRows($pid);

    $endresult = '';
    $pat_payment_details = '';
    $encs = [];

    // filter by encounter here
    if (isset($_REQUEST['filter_encounter']) && $_REQUEST['filter_encounter'] != "") {
        $encounters = [$_REQUEST['filter_encounter']];
    }


    foreach ($encounters as $value) {
        array_push($encs, sqlStatement("SELECT * FROM form_encounter WHERE pid = ? AND encounter = ?", array($pid, $value)));
    }

    $n = 0; // keep track of every encounter

    foreach ($encs as $enc) {
        $enc_row = sqlFetchArray($enc);
        $overview_data_instance = new TransactionOverview($pid, $enc_row['encounter']);
        $encounter_overview_data[$enc_row['encounter']]  = $overview_data_instance->getData();
        // add code to get provider name.
        if (!empty($enc_row)) {
            $therapist_name = getProviderName($enc_row['provider_id']);
            $the_case_description = $enc_row['case_body_part'].$enc_row['case_number'];
            $joined_case_description = str_replace(' ', '', $the_case_description);
            // get all billing records
            $bills = sqlStatement("SELECT * FROM billing INNER JOIN `code_types` ON billing.code_type = code_types.ct_key WHERE pid = ? AND encounter = ? AND activity = 1 AND code_types.ct_active='1' AND code_types.ct_diag != '1'  AND code_types.ct_claim='1'  ORDER BY date DESC", array($pid, $enc_row['encounter']));
            $bill_count = 0;
            $adjustment_reason = "";
            $non_null_adjustment_reason = "";
            $endresult = getTableHeaderRow($endresult, $enc_row, $joined_case_description, $n, $therapist_name);
            $paymentTemplateLoader = new TemplateLoader(NULL);

            $sequence_numbers = array();
            // keep the sequence numbers so that we can use them to indentify distinct pat-payment entries
            foreach ($bills as $bill) {
                if ($enc_row['encounter'] == $bill['encounter']) {
                    $ins_pay_amt = 0.00;
                    $pat_pay_amt = 0.00;
                    $pat_pay_amt_unapplied = 0.00;
                    $pat_pay_amt_applied = 0.00;
                    $primary_insurance_total = 0.00;
                    $secondary_insurance_total = 0.00;
                    $tertiary_insurance_total = 0.00;
                    $adj_amt = 0.00;
                    $amount_amt = 0.00;
                    $reason_code = " ";
                    $b_IsUnapplied = 0;
                    $i_InRowNewCount = 0;
                    $arr_Payments = [];
                    $arr_PaymentDetails = [];
                    $ins_item = '';
                    $inrownew_tracking_list = array();

                    foreach ($indrows as $inrownew) {
                            // there is a possibility for rows to exist
                            // without billing id, so we need to verify by
                            // comparing against pid, encounter and code against a billing
                            // item
                            $current_sequence_number = $inrownew['sequence_no'];
                            if (validateBillingId($inrownew, $bill) && !in_array($current_sequence_number, $sequence_numbers)) {

                                list($inrownew['account_code'],$is_account_code_empty) = findAccountCodeIfEmpty($inrownew);
                                $adjustment_reason = $inrownew['memo'];

                                # adjustment reason part
                                if ($non_null_adjustment_reason == "" && $adjustment_reason != "")
                                {
                                    $non_null_adjustment_reason = $adjustment_reason;
                                }
                                $pay_post_date = oeFormatShortDate(substr($inrownew['check_date'],0,10));
                                $unformatted_pay_post_date = substr($inrownew['check_date'],0,10);
                                array_push($sequence_numbers, $inrownew['sequence_no']);
                                switch ($inrownew['account_code']) {
                                    // Patient payment
                                    case 'PP':
                                        // push the patient payment sequence numbers
                                        // in to a container since patient payment rows
                                        // cant be compared with column 'code' in billing table
                                        // since pid, encounter are multiple not doing this
                                        // will lead to duplication of column

                                        if ($inrownew['inactive'] == 0) {
                                            // if patient payment is active then show it.
                                            if ($inrownew['unapplied'] == 1) {
                                                $pat_pay_amt_unapplied += $inrownew['pay_amount'];
                                            }
                                            else {
                                                $pat_pay_amt_applied += $inrownew['pay_amount'];
                                            }
                                            $pat_pay_amt +=  $inrownew['pay_amount'];
                                            $ins_pay_amt += 0.00;
                                            $adj_amt += 0.00;
                                            $s_PaymentType = 'Patient Payment';
                                            $s_m_Amount = $pat_pay_amt;
                                            $s_RowBgColor = '#ff3b304d';
                                            $b_IsUnapplied = $inrownew['unapplied'];
                                            $sequence_no_id = 'sequence_no_'.$inrownew['sequence_no'];
                                            $adj_reason = "'" . $inrownew['memo'] . "'";
                                            $paymentRowDataManagerInstance = new PaymentRowDataManager($inrownew, $enc_row, $pid, $n, $bill_count);
                                            $paymentTemplateLoader->setTemplateDataManagerInstance($paymentRowDataManagerInstance);
                                            $pat_payment_details .= $paymentTemplateLoader->getOutput();
                                        }

                                        break;
                                        case 'IPP':
                                            // Insurance provider payment
                                            $adj_amt += 0.00;
                                            if ($inrownew['payer_type'] == 1 ) {
                                                  $s_PaymentType = 'Primary Insurance Payment';
                                                  $s_RowBgColor = '#6c5bd64d';
                                                  $ins_item = "'primary'";
                                                  $primary_insurance_total += $inrownew['pay_amount'];
                                            }
                                            elseif ($inrownew['payer_type'] == 2 ) {
                                                 $secondary_insurance_total += $inrownew['pay_amount'];
                                                  $s_PaymentType = 'Secondary Insurance Payment';
                                                  $s_RowBgColor = '#ff95004d';
                                                  $ins_item = "'secondary'";
                                            }
                                            else{
                                                $tertiary_insurance_total += $inrownew['pay_amount'];
                                                  $s_PaymentType = 'Tertiary Insurance Payment';
                                                  $s_RowBgColor = '#ff95004d';
                                                  $ins_item = "'tertiary'";
                                            }
                                            //$s_m_Amount = $ins_pay_amt;
                                            $s_m_Amount = $ins_detail_amt;
                                            if($ins_detail_amt >0) {
                                              $b_IsUnapplied = 1;
                                              $ins_detail_amt = 0.00;
                                            }


                                            // Insurance provider payment
                                            $pat_pay_amt += 0.00;
                                            $ins_pay_amt +=  $inrownew['pay_amount'];
                                            $ins_detail_amt = $inrownew['pay_amount'];
                                            $adj_amt += 0.00;
                                            //$s_m_Amount = $ins_pay_amt;
                                            $s_m_Amount = $ins_detail_amt;


                                            if($ins_detail_amt >0) {
                                              $b_IsUnapplied = 1;
                                              $ins_detail_amt = 0.00;
                                            }
                                            break;
                                        case 'ADJ':
                                            // Adjustment
                                            # Add adjustment reason to this code.
                                            $pat_pay_amount += 0.00;
                                            $ins_pay_amt += 0.00;
                                            $adj_amt += $inrownew['adj_amount'];
                                            $s_PaymentType = 'Adjusment';
                                            $s_m_Amount = $adj_amt;
                                            $s_RowBgColor = '#FF0000';
                                            $b_IsUnapplied = $inrownew['unapplied'];
                                            //if($adj_amt >0) {
                                            //  $b_IsUnapplied = 1;
                                            //}
                                            break;
                                        default:
                                            $pat_pay_amount += 0.00;
                                            $ins_pay_amt += 0.00;
                                            $adj_amt += 0.00;
                                            $s_PaymentType = '';
                                            $b_IsUnapplied = 0;
                                            break;
                                    }
                                    $arr_PaymentDetails[$i_InRowNewCount]['pid'] = $pid;
                                    $arr_PaymentDetails[$i_InRowNewCount]['encounter'] = $bill['encounter'];
                                    $arr_PaymentDetails[$i_InRowNewCount]['sequence_no']=$inrownew['sequence_no'];
                                    $arr_PaymentDetails[$i_InRowNewCount]
                                          ['adjustment_reason'] =$inrownew['memo'];

                                    $arr_PaymentDetails[$i_InRowNewCount]['pat_pay_amount'] = $pat_pay_amt;
                                            $arr_PaymentDetails[$i_InRowNewCount]['ins_pay_amt'] = $ins_pay_amt;
                                    $arr_PaymentDetails[$i_InRowNewCount]['ins_detail_amt'] = $ins_detail_amt;
                                    $arr_PaymentDetails[$i_InRowNewCount]['adj_amount'] = $adj_amt;
                                    $arr_PaymentDetails[$i_InRowNewCount]['s_m_Amount'] = $s_m_Amount;
                                    $arr_PaymentDetails[$i_InRowNewCount]['s_PaymentType'] = $s_PaymentType;
                                    $arr_PaymentDetails[$i_InRowNewCount]['s_RowBgColor'] = $s_RowBgColor;
                                    $arr_PaymentDetails[$i_InRowNewCount]['b_IsUnapplied'] = $b_IsUnapplied;
                                    $arr_PaymentDetails[$i_InRowNewCount]['pay_post_date'] = $pay_post_date;
                                    $arr_PaymentDetails[$i_InRowNewCount]['unformatted_pay_post_date'] = $unformatted_pay_post_date;
                                    $i_InRowNewCount++;
                                }
                                //$line_total = $bill['fee'];
                            }

                            $rowDataManagerInstance = new GenericRowDataManager(
                                                      $bill_count,
                                                      $n,
                                                      $bill,
                                                      $enc_row,
                                                      $ins_item,
                                                      $pat_pay_amt,
                                                      $ins_pay_amt,
                                                      $adj_amt,
                                                      $adjustment_reason,
                                                      $primary_insurance_total,
                                                      $secondary_insurance_total,
                                                      $tertiary_insurance_total,
                                                      $pat_pay_amt_unapplied,
                                                      $pat_pay_amt_applied);

                            $templateLoader = new TemplateLoader($rowDataManagerInstance);
                            $endresult .= $templateLoader->getOutput();
                            $endresult = iteratePaymentRowsTemplate($i_RowIterator, $i_InRowNewCount, $arr_PaymentDetails, $endresult, $n, $bill_count);
                }
                $bill_count++;
            }

            $endresult = str_replace("{ADJUSTMENT_REASON}", $non_null_adjustment_reason, $endresult);
            $endresult .= $pat_payment_details; // keep payment details at the End
            $encounter_overview_data_json_string = json_encode($encounter_overview_data);
            $endresult .= '
                        <script>
                                    calcTotalUnits('.$n.');
                                    calcTotalBalance('.$n.');
                                    encounter_overview_data = '.$encounter_overview_data_json_string.'
                                    </script>';

            $n++;
        } // closes !empty($enc_row)
    }

$end_result = array('billing_note' => $billing_note, 'renderHtml' => $endresult);

// preparing correct format for json_encode
header('Content-type: application/json');
echo json_encode(array('result' => $end_result)); //sending response to ajax

}
