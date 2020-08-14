<?php
//fee_sheet
function alphaCodeType($id) {
  global $code_types;
  foreach ($code_types as $key => $value) {
    if ($value['id'] == $id) return $key;
  }
  return '';
}

// Helper function for creating drop-lists.
function endFSCategory() {
  global $i, $last_category, $FEE_SHEET_COLUMNS;
  if (! $last_category) return;
  echo "   </select>\n";
  echo "  </td>\n";
  if ($i >= $FEE_SHEET_COLUMNS) {
    echo " </tr>\n";
    $i = 0;
  }
}

// Generate JavaScript to build the array of diagnoses.
function genDiagJS($code_type, $code) {
  global $code_types;
  if ($code_types[$code_type]['diag']) {
    echo "diags.push('" . attr($code_type) . "|" . attr($code) . "');\n";
  }
}

# gets the provider from the encounter file , or from the logged on user or from the patient file
function findProvider() {
  global $encounter, $pid;
  $find_provider = sqlQuery("SELECT provider_id FROM form_encounter " .
        "WHERE pid = ? AND encounter = ? " .
        "ORDER BY id DESC LIMIT 1", array($pid,$encounter) );
  $providerid = $find_provider['provider_id'];
  if($providerid == 0) {
   $get_authorized = $_SESSION['userauthorized'];
   if($get_authorized ==1) {
      $providerid = $_SESSION[authUserID];
   }
  }
  if($providerid == 0) {
    $find_provider = sqlQuery("SELECT providerID FROM patient_data " .
        "WHERE pid = ? ", array($pid) );
    $providerid = $find_provider['providerID'];
  }
  return $providerid;
}

// This writes a billing line item to the output page.
//
function echoLine($lino, $codetype, $code, $modifier, $ndc_info='',
  $auth = FALSE, $del = FALSE, $units = NULL, $fee = NULL, $id = NULL,
  $billed = FALSE, $code_text = NULL, $justify = NULL, $provider_id = 0, $notecodes='', $exclude ="0")
{
  global $code_types, $ndc_applies, $ndc_uom_choices, $justinit, $pid;
  global $usbillstyle, $hasCharges;

  // If using line item billing and user wishes to default to a selected provider, then do so.
  if($GLOBALS['default_fee_sheet_line_item_provider'] == 1 && $GLOBALS['support_fee_sheet_line_item_provider'] ==1 ) {
    if ($provider_id == 0) {
      $provider_id = 0 + findProvider();
    }
  }

  if ($codetype == 'COPAY') {
    if (!$code_text) $code_text = 'Cash';
    if ($fee > 0) $fee = 0 - $fee;
  }
  if (! $code_text) {
    $sqlArray = array();
    $query = "select id, units, exclude_from_insurance_billing, code_text from codes where code_type = ? " .
      " and " .
      "code = ? and ";
    array_push($sqlArray,$code_types[$codetype]['id'],$code);
    if ($modifier) {
      $query .= "modifier = ?";
      array_push($sqlArray,$modifier);
    } else {
      $query .= "(modifier is null or modifier = '')";
    }
    $result = sqlQuery($query, $sqlArray);
    $code_text = $result['code_text'];
    $exclude = $result['exclude_from_insurance_billing'];

    if (empty($units)) $units = max(1, intval($result['units']));
    if (!isset($fee)) {
      // Fees come from the prices table now.
      $query = "SELECT prices.pr_price " .
        "FROM patient_data, prices WHERE " .
        "patient_data.pid = ? AND " .
        "prices.pr_id = ? AND " .
        "prices.pr_selector = '' AND " .
        "prices.pr_level = patient_data.pricelevel " .
        "LIMIT 1";
      echo "\n<!-- $query -->\n"; // debugging
      $prrow = sqlQuery($query, array($pid,$result['id']) );
      $fee = empty($prrow) ? 0 : $prrow['pr_price'];
    }
  }
  $fee = sprintf('%01.2f', $fee);
  if (empty($units)) $units = 1;
  $units = max(1, intval($units));
  // We put unit price on the screen, not the total line item fee.
  $price = $fee / $units;
  $strike1 = ($id && $del) ? "<strike>" : "";
  $strike2 = ($id && $del) ? "</strike>" : "";
  echo " <tr>\n";
  echo "  <td class='billcell'>$strike1" .
    ($codetype == 'COPAY' ? xl($codetype) : $codetype) . $strike2;
  //if the line to ouput is copay, show the date here passed as $ndc_info,
  //since this variable is not applicable in the case of copay.
  if($codetype == 'COPAY'){
    echo "(".htmlspecialchars($ndc_info).")";
    $ndc_info = '';
  }
  if ($id) {
    echo "<input type='hidden' name='bill[".attr($lino)."][id]' value='$id'>";
  }
  echo "<input type='hidden' name='bill[".attr($lino)."][code_type]' value='".attr($codetype)."'>";
  echo "<input type='hidden' name='bill[".attr($lino)."][code]' value='".attr($code)."'>";
  echo "<input type='hidden' name='bill[".attr($lino)."][billed]' value='".attr($billed)."'>";
  echo "</td>\n";
  if ($codetype != 'COPAY') {
    echo "  <td class='billcell'>$strike1" . text($code) . "$strike2</td>\n";
  } else {
    echo "  <td class='billcell'>&nbsp;</td>\n";
  }
  if ($billed) {
    if (modifiers_are_used(true)) {
      echo "  <td class='billcell'>$strike1" . text($modifier) . "$strike2" .
        "<input type='hidden' name='bill[".attr($lino)."][mod]' value='".attr($modifier)."'></td>\n";
    }
    if (fees_are_used()) {
      echo "  <td class='billcell' align='right'>" . text(oeFormatMoney($price)) . "</td>\n";
      if ($codetype != 'COPAY') {
        echo "  <td class='billcell' align='center'>" . text($units) . "</td>\n";
      } else {
        echo "  <td class='billcell'>&nbsp;</td>\n";
      }
    }
    if (justifiers_are_used()) {
      echo "  <td class='billcell' align='center'$usbillstyle>" . text($justify) . "</td>\n";
    }

    // Show provider for this line (if using line item billing).
    if($GLOBALS['support_fee_sheet_line_item_provider'] ==1) {
      echo "  <td class='billcell' align='center'>";
    }
    else
    {
      echo "  <td class='billcell' align='center' style='display: none'>";
    }
      genProviderSelect('', '-- '.xl("Default").' --', $provider_id, true);
      echo "</td>\n";

    if ($code_types[$codetype]['claim'] && !$code_types[$codetype]['diag']) {
      echo "  <td class='billcell' align='center'$usbillstyle>" .
        htmlspecialchars($notecodes, ENT_NOQUOTES) . "</td>\n";
    }
    else {
      echo "  <td class='billcell' align='center'$usbillstyle></td>\n";
    }
    echo "  <td class='billcell' align='center'$usbillstyle><input type='checkbox'" .
      ($auth ? " checked" : "") . " disabled /></td>\n";
    echo "  <td class='billcell' align='center'><input type='checkbox'" .
      " disabled /></td>\n";
    if($GLOBALS['bill_to_patient'] ==1) {
    echo "  <td class='billcell' align='center'$usbillstyle><input type='checkbox'" .
      ($exclude ? " checked" : "") . " disabled /></td>\n";
  }
  }
  else { // not billed
    if (modifiers_are_used(true)) {
      if ($codetype != 'COPAY' && ($code_types[$codetype]['mod'] || $modifier)) {
        echo "  <td class='billcell'><input type='text' name='bill[".attr($lino)."][mod]' " .
             "value='" . attr($modifier) . "' " .
             "title='" . xla("Multiple modifiers can be separated by colons or spaces, maximum of 4 (M1:M2:M3:M4)") . "' " .
             "value='" . attr($modifier) . "' size='" . attr($code_types[$codetype]['mod']) . "'></td>\n";
      } else {
        echo "  <td class='billcell'>&nbsp;</td>\n";
      }
    }
    if (fees_are_used()) {
      if ($codetype == 'COPAY' || $code_types[$codetype]['fee'] || $fee != 0) {
        echo "  <td class='billcell' align='right'>" .
          "<input type='text' name='bill[".attr($lino)."][price]' " .
          "value='" . attr($price) . "' size='6'";
        if (acl_check('prices'))
          echo " style='text-align:right'";
        else
          echo " style='text-align:right;background-color:transparent' readonly";
        echo "></td>\n";
        echo "  <td class='billcell' align='center'>";
        if ($codetype != 'COPAY') {
          echo "<input type='text' name='bill[".attr($lino)."][units]' " .
          "value='" . attr($units) . "' size='2' style='text-align:right'>";
        } else {
          echo "<input type='hidden' name='bill[".attr($lino)."][units]' value='" . attr($units) . "'>";
        }
        echo "</td>\n";
      } else {
        echo "  <td class='billcell'>&nbsp;</td>\n";
        echo "  <td class='billcell'>&nbsp;</td>\n";
      }
    }
    if (justifiers_are_used()) {
      if ($code_types[$codetype]['just'] || $justify) {
        echo "  <td class='billcell' align='center'$usbillstyle ";
        echo "title='" . xla("Select one or more diagnosis codes to justify the service") . "' >";
        echo "<select name='bill[".attr($lino)."][justify]' onchange='setJustify(this)'>";
        echo "<option value='" . attr($justify) . "'>" . text($justify) . "</option></select>";
        echo "</td>\n";
        $justinit .= "setJustify(f['bill[".attr($lino)."][justify]']);\n";
      } else {
        echo "  <td class='billcell'$usbillstyle>&nbsp;</td>\n";
      }
    }

    // Show provider for this line (if using line item billing)
    if($GLOBALS['support_fee_sheet_line_item_provider'] ==1) {
      echo "  <td class='billcell' align='center'>";
    }
    else
    {
      echo "  <td class='billcell' align='center' style='display: none'>";
    }
      genProviderSelect("bill[$lino][provid]", '-- '.xl("Default").' --', $provider_id);
      echo "</td>\n";

    if ($code_types[$codetype]['claim'] && !$code_types[$codetype]['diag']) {
      echo "  <td class='billcell' align='center'$usbillstyle><input type='text' name='bill[".attr($lino)."][notecodes]' " .
        "value='" . htmlspecialchars($notecodes, ENT_QUOTES) . "' maxlength='50' size='8' /></td>\n";
    }
    else {
      echo "  <td class='billcell' align='center'$usbillstyle></td>\n";
    }
    echo "  <td class='billcell' align='center'$usbillstyle><input type='checkbox' name='bill[".attr($lino)."][auth]' " .
      "value='1'" . ($auth ? " checked" : "") . " /></td>\n";
    echo "  <td class='billcell' align='center'><input type='checkbox' name='bill[".attr($lino)."][del]' " .
      "value='1'" . ($del ? " checked" : "") . " /></td>\n";
        //ADD THE NEW CHECKBOX "Bill to Patient EXCLUDE"
    if($GLOBALS['bill_to_patient'] ==1) {
      echo "  <td class='billcell' align='center'><input type='checkbox' name='bill[".attr($lino)."][exclude_from_insurance_billing]' " .
        "value='1'" . ($exclude ? " checked" : "") . " /></td>\n";
    }
  }

  echo "  <td class='billcell'>$strike1" . text($code_text) . "$strike2</td>\n";
  echo " </tr>\n";

  // If NDC info exists or may be required, add a line for it.
  if ($codetype == 'HCPCS' && $ndc_applies && !$billed) {
    $ndcnum = ''; $ndcuom = ''; $ndcqty = '';
    if (preg_match('/^N4(\S+)\s+(\S\S)(.*)/', $ndc_info, $tmp)) {
      $ndcnum = $tmp[1]; $ndcuom = $tmp[2]; $ndcqty = $tmp[3];
    }
    echo " <tr>\n";
    echo "  <td class='billcell' colspan='2'>&nbsp;</td>\n";
    echo "  <td class='billcell' colspan='6'>&nbsp;NDC:&nbsp;";
    echo "<input type='text' name='bill[".attr($lino)."][ndcnum]' value='" . attr($ndcnum) . "' " .
      "size='11' style='background-color:transparent'>";
    echo " &nbsp;Qty:&nbsp;";
    echo "<input type='text' name='bill[".attr($lino)."][ndcqty]' value='" . attr($ndcqty) . "' " .
      "size='3' style='background-color:transparent;text-align:right'>";
    echo " ";
    echo "<select name='bill[".attr($lino)."][ndcuom]' style='background-color:transparent'>";
    foreach ($ndc_uom_choices as $key => $value) {
      echo "<option value='" . attr($key) . "'";
      if ($key == $ndcuom) echo " selected";
      echo ">" . text($value) . "</option>";
    }
    echo "</select>";
    echo "</td>\n";
    echo " </tr>\n";
  }
  else if ($ndc_info) {
    echo " <tr>\n";
    echo "  <td class='billcell' colspan='2'>&nbsp;</td>\n";
    echo "  <td class='billcell' colspan='6'>&nbsp;" . xlt("NDC Data") . ": " . text($ndc_info) . "</td>\n";
    echo " </tr>\n";
  }


  if ($fee != 0) $hasCharges = true;
}

// This writes a product (drug_sales) line item to the output page.
//
function echoProdLine($lino, $drug_id, $del = FALSE, $units = NULL,
  $fee = NULL, $sale_id = 0, $billed = FALSE)
{
  global $code_types, $ndc_applies, $pid, $usbillstyle, $hasCharges;

  $drow = sqlQuery("SELECT name FROM drugs WHERE drug_id = ?", array($drug_id) );
  $code_text = $drow['name'];

  $fee = sprintf('%01.2f', $fee);
  if (empty($units)) $units = 1;
  $units = max(1, intval($units));
  // We put unit price on the screen, not the total line item fee.
  $price = $fee / $units;
  $strike1 = ($sale_id && $del) ? "<strike>" : "";
  $strike2 = ($sale_id && $del) ? "</strike>" : "";
  echo " <tr>\n";
  echo "  <td class='billcell'>{$strike1}" . xlt("Product") . "$strike2";
  echo "<input type='hidden' name='prod[".attr($lino)."][sale_id]' value='" . attr($sale_id) . "'>";
  echo "<input type='hidden' name='prod[".attr($lino)."][drug_id]' value='" . attr($drug_id) . "'>";
  echo "<input type='hidden' name='prod[".attr($lino)."][billed]' value='" . attr($billed) . "'>";
  echo "</td>\n";
  echo "  <td class='billcell'>$strike1" . text($drug_id) . "$strike2</td>\n";
  if (modifiers_are_used(true)) {
    echo "  <td class='billcell'>&nbsp;</td>\n";
  }
  if ($billed) {
    if (fees_are_used()) {
      echo "  <td class='billcell' align='right'>" . text(oeFormatMoney($price)) . "</td>\n";
      echo "  <td class='billcell' align='center'>" . text($units) . "</td>\n";
    }
    if (justifiers_are_used()) {
      echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // justify
    }
    echo "  <td class='billcell' align='center'>&nbsp;</td>\n";             // provider
    echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // note codes
    echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // auth
    echo "  <td class='billcell' align='center'><input type='checkbox'" .   // del
      " disabled /></td>\n";
  } else {
    if (fees_are_used()) {
      echo "  <td class='billcell' align='right'>" .
        "<input type='text' name='prod[".attr($lino)."][price]' " .
        "value='" . attr($price) . "' size='6'";
      if (acl_check('prices'))
        echo " style='text-align:right'";
      else
        echo " style='text-align:right;background-color:transparent' readonly";
      echo "></td>\n";
      echo "  <td class='billcell' align='center'>";
      echo "<input type='text' name='prod[".attr($lino)."][units]' " .
        "value='" . attr($units) . "' size='2' style='text-align:right'>";
      echo "</td>\n";
    }
    if (justifiers_are_used()) {
      echo "  <td class='billcell'$usbillstyle>&nbsp;</td>\n"; // justify
    }
    echo "  <td class='billcell' align='center'>&nbsp;</td>\n"; // provider
    echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // note codes
    echo "  <td class='billcell' align='center'$usbillstyle>&nbsp;</td>\n"; // auth
    echo "  <td class='billcell' align='center'><input type='checkbox' name='prod[".attr($lino)."][del]' " .
      "value='1'" . ($del ? " checked" : "") . " /></td>\n";
    if($GLOBALS['bill_to_patient'] ==1) {
      echo "  <td class='billcell' align='center'><input type='checkbox' name='bill[".attr($lino)."][exclude_from_insurance_billing]' " .
        "value='1'" . ($del ? " checked" : "") . " /></td>\n";
    }
  }

  echo "  <td class='billcell'>$strike1" . text($code_text) . "$strike2</td>\n";
  echo " </tr>\n";

  if ($fee != 0) $hasCharges = true;
}


// Build a drop-down list of providers.  This includes users who
// have the word "provider" anywhere in their "additional info"
// field, so that we can define providers (for billing purposes)
// who do not appear in the calendar.
//
function genProviderSelect2($selname, $toptext, $default=0, $disabled=false) {
  $query = "SELECT id, lname, fname FROM users WHERE " .
    "( authorized = 1 OR info LIKE '%provider%' ) AND username != '' " .
    "AND active = 1 AND ( info IS NULL OR info NOT LIKE '%Inactive%' ) " .
    "ORDER BY lname, fname";
  $res = sqlStatement($query);
  echo "   <select name='" . attr($selname) . "'";
  if ($disabled) echo " disabled";
  echo ">\n";
  echo "    <option value=''>" . text($toptext) . "\n";
  while ($row = sqlFetchArray($res)) {
    $provid = $row['id'];
    echo "    <option value='" . attr($provid) . "'";
    if ($provid == $default) echo " selected";
    echo ">" . text($row['lname'] . ", " . $row['fname']) . "\n";
  }
  echo "   </select>\n";
}


// Compute a current checksum of Fee Sheet data from the database.
//
function visitChecksum($pid, $encounter, $saved=false) {
  $rowb = sqlQuery("SELECT BIT_XOR(CRC32(CONCAT_WS(',', " .
    "id, code, modifier, units, fee, authorized, provider_id, ndc_info, justify, billed" .
    "))) AS checksum FROM billing WHERE " .
    "pid = ? AND encounter = ? AND activity = 1",
    array($pid, $encounter));
  $rowp = sqlQuery("SELECT BIT_XOR(CRC32(CONCAT_WS(',', " .
    "sale_id, inventory_id, prescription_id, quantity, fee, sale_date, billed" .
    "))) AS checksum FROM drug_sales WHERE " .
    "pid = ? AND encounter = ?",
    array($pid, $encounter));
  $ret = intval($rowb['checksum']) ^ intval($rowp['checksum']);
  if (CHECKSUM_LOGGING) {
    $comment = "Checksum = '$ret'";
    $comment .= ", AJAX = " . (empty($_POST['running_as_ajax']) ? "false" : "true");
    $comment .= ", Save = " . (empty($_POST['bn_save']) ? "false" : "true");
    $comment .= ", Saved = " . ($saved ? "true" : "false");
    newEvent("checksum", $_SESSION['authUser'], $_SESSION['authProvider'], 1, $comment, $pid);
  }
  return $ret;
}

?>
