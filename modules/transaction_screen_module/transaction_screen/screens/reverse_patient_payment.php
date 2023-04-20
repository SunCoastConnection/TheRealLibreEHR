<?php
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/sql.inc");
require_once("$srcdir/headers.inc.php");

call_required_libraries(["bootstrap-4-0"]);


$pid = $_REQUEST['pid'];
$encounter = $_REQUEST['encounter'];
$sequence_no = $_REQUEST['sequence_no'];

$query = "SELECT option_id, title FROM `list_options` WHERE list_id='adjreason'";
$result = sqlStatement($query, array());
$option_text = "";

while ($row = sqlFetchArray($result)) {
  $value = $row['option_id'];
  $title = $row['title'];
  $option_text .= "<option value='$value'>$title</option>";
}

// when adjustment code is selected then reverse the patient payment by creating a new entry

if (isset($_REQUEST['adjustment_code']) && isset($_REQUEST['pid'])
    && isset($_REQUEST['encounter']) && isset($_REQUEST['sequence_no'])) 
{

  $adjustment_code = $_REQUEST['adjustment_code'];
  $pid = $_REQUEST['pid'];
  $encounter = $_REQUEST['encounter'];
  $sequence_no = $_REQUEST['sequence_no'];
  $query = "SELECT * FROM ar_activity WHERE pid = ? AND encounter = ? AND sequence_no = ?";
    
    $old_row_result = sqlQuery($query, array($pid, $encounter, $sequence_no));


    $r = $old_row_result;

    $new_row_query = "INSERT INTO `ar_activity`(`pid`, `encounter`, `billing_id`, `code_type`, `code`, `modifier`, `payer_type`, `post_time`, `post_user`, `session_id`, `memo`, `pay_amount`, `adj_amount`, `modified_time`, `follow_up`, `follow_up_note`, `account_code`, `reason_code`, `unapplied`, `date_closed`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $new_row_binding_array = array($pid, $encounter,
      $r['billing_id'], $r['code_type'], $r['code'], $r['modifier'],
      $r['payer_type'], $r['post_time'], $r['post_user'],
      $r['session_id'], $adjustment_code, -$r['pay_amount'], 
      $r['adj_amount'], $r['modified_time'], $r['follow_up'], $r['follow_up_note'], $r['account_code'], $r['reason_code'], $r['unapplied'], $r['date_closed']);

    sqlQuery($new_row_query, $new_row_binding_array);

    echo "<script>
    parent.updatePatientPaymentRowOnServiceModal();
    parent.$('#reverse-patient-payment-modal').iziModal('close');
    </script>";
}

?>
<div class="col-xs-12 text-center">
<form method="POST">
        <h4>Adjustment Reason</h4><br/>
        <select name="adjustment_code" class="form-control"><?php echo $option_text; ?></select><br/>
  <input type="hidden" name="pid" value="<?php echo $pid; ?>">
  <input type="hidden" name="encounter" value="<?php echo $encounter; ?>">
  <input type="hidden" name="sequence_no" value="<?php echo $sequence_no; ?>">
  <input type="submit" name="submit" class="btn btn-primary">
</form>
</div>
