<?php
/*
 *  Billing Report Claim List
 *
 *  This program contains functions and support code for the main search and select screen for claims generation
 *
 * @copyright Copyright (C) 2019 Terry Hill <teryhill@yahoo.com>
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package LibreEHR
 * @author Terry Hill <teryhill@yahoo.com>
 *
 * Please help the overall project by sending changes you make to the author and to the LibreEHR community.
 *
 */

$HIDDEN_DIV_INDEX = 0;

function echoBillingTemplateHeader(
  $tpl_form_encounter_id,
  $tpl_coding_done,
  $tpl_patient_name,
  $tpl_encounter_id,
  $tpl_patient_href,
  $tpl_encounter_href,
  $tpl_payer_type_selection_box,
  $tpl_partner_type_selection_box,
  $blinkingMessage) {



$checkedOrNot = "";
if ($tpl_coding_done == "1") {
  $checkedOrNot = "checked";
}

  global $HIDDEN_DIV_INDEX;

  $DIV_BLINKING_CLASSES = "";
  if ($blinkingMessage != null) {
    $DIV_BLINKING_CLASSES = "js-blink-infinite red-text";
  }
  echo "<table class='table primary-table table-condensed'>";
  echo "<tr>";
  echo "<td style='width:10%'><input type='checkbox' class='patient_check_box'>&nbsp;&nbsp;<a class='patient_name' href=".'"'.$tpl_patient_href.'"'."><span class='$DIV_BLINKING_CLASSES' title='$blinkingMessage'>$tpl_patient_name</span></a></td>";

  echo "<td style='width:10%'><a class='patient_encounter' href=$tpl_encounter_href>$tpl_encounter_id</td>";
  echo "<td style='width:10%'>$tpl_payer_type_selection_box</td>";
  echo "<td style='width:10%'>$tpl_partner_type_selection_box</td>";
  echo "<td style='width:10%'><i class='fa fa-arrow-down' data-target='#claim_messages_$HIDDEN_DIV_INDEX' data-toggle='modal'></i></td>";
  echo '<td style="width:10%"><label class="switch">
  <input type="checkbox"'.$checkedOrNot.' onclick="toggleCodingDoneSwitch('.$tpl_form_encounter_id.', this);">
  <span class="slider round"></span>
</label></td>';
  echo "</tr>";

  echo "</table>";




}

function echoBillingTemplateBody() {
  echo "<table class='table secondary-table table-condensed'>";
}


function echoBillingCodeRow($tpl_code_row) {
  $tpl_code_row  = str_replace("<td></td>", "", $tpl_code_row);
  echo "<tr>";
  echo $tpl_code_row;
  echo "</tr>";
}

/**
 * [printPatientName description]
 * @param [type] $namecolor [description]
 * @param [type] $lhtml [description]
 * @param [type] $ptname [description]
 * @param [type] $iter [description]
 */
function returnPatientData($namecolor, $lhtml, $ptname, $iter, $encounter_href, $patient_href){


  // if ($namecolor != 'black') {
  //       #error_log("Color: ".$namecolor, 0);
  //   $lhtml .= "&nbsp;<span class=js-blink-infinite><font color='$namecolor'>". text($ptname) .
  //     "</font></span><span class=small>&nbsp;(" . text($iter['enc_pid']) . "-" .
  //     text($iter['enc_encounter']) . ")</span>";
  // }
  // else
  // {
    // $lhtml .= "<span class=bold><font color='$namecolor'>". text($ptname) .
    //   "</font></span><span class=small>&nbsp;(" . text($iter['enc_pid']) . "-" .
    //   text($iter['enc_encounter']) . ")</span>";
  // }


  // $lhtml .= '<td><a  class="patient_name" href="'.$patient_href.'">'. text($ptname) .'</a></td>';

  // $lhtml .= '<td><a class="patient_encounter" href="'.$encounter_href.'">' . text($iter['enc_pid']) . "-" .text($iter['enc_encounter']) . "</a></td>";

  $encounter_id  = $iter['enc_pid']."-".text($iter['enc_encounter']) . "-" . text($iter['form_enc_case_number']);

  return array($ptname, $encounter_id, $patient_href, $encounter_href);
}


function checkBillingRecordExistsForCurrentUser($iter)
{
      if (!$iter['id']) {
        $res = sqlQuery("SELECT count(*) AS count FROM billing WHERE " .
        "encounter = ? AND " .
        "pid=? AND " .
        "activity = 1", array($iter['enc_encounter'],$iter['enc_pid']) );
    }

}


function getNullAndEmptyVariables($resultArray,$fieldArray) {
  $emptyVariableNames = array();

  for ($i = 0; $i < count($fieldArray); $i++) {
      $field_name = $fieldArray[$i];
      $field_value =  $resultArray[$field_name];

      if ($field_value == null || $field_value == '') {
        array_push($emptyVariableNames, $fieldArray[$i]);
      }
  }
  return $emptyVariableNames;
}

function checkPatientHasPrimaryInsurance($iter)
{
      # Check if patient has primary insurance and a subscriber exists for it.
      # If not we will highlight their name in red.
      # TBD: more checking here.
      #
      $res = sqlQuery("select count(*) as count from insurance_data where " .
        "pid = ? and " .
        "type='primary' and " .
        "subscriber_relationship != '' and " .
        "subscriber_relationship is not null and " .
        "subscriber_street != '' and " .
        "subscriber_street is not null and " .
        "subscriber_city != '' and " .
        "subscriber_city is not null and " .
        "subscriber_state != '' and " .
        "subscriber_state is not null and " .
        "subscriber_sex != '' and " .
        "subscriber_sex is not null and " .
        "subscriber_DOB != '0000-00-00' and " .
        "subscriber_DOB is not null and " .
        "subscriber_DOB != '' and " .
        "subscriber_fname is not null and " .
        "subscriber_fname != '' and " .
        "subscriber_lname is not null and " .
        "subscriber_lname != '' limit 1", array($iter['enc_pid']) );
        return $res;
}


function loadInsuranceDataToJsArray($iter)
{
     //Encounter details are stored to javacript as array.
        $result4 = sqlStatement("SELECT fe.encounter,fe.date,fe.billing_note,libreehr_postcalendar_categories.pc_catname FROM form_encounter AS fe ".
            " left join libreehr_postcalendar_categories on fe.pc_catid=libreehr_postcalendar_categories.pc_catid  WHERE fe.pid = ? order by fe.date desc", array($iter['enc_pid']) );
           if(sqlNumRows($result4)>0)
            $enc_pid = $iter['enc_pid'];
            echo "<script language='JavaScript'>\n";
            echo "Count=0;\n";
            echo "EncounterDateArray[$enc_pid]=new Array;\n";
            echo "CalendarCategoryArray[$enc_pid]=new Array;\n";
            echo "EncounterIdArray[$enc_pid]=new Array;\n";

            while($rowresult4 = sqlFetchArray($result4))
             {

                echo "EncounterIdArray[$enc_pid][Count]='".htmlspecialchars($rowresult4['encounter'], ENT_QUOTES)."';\n";
                echo "EncounterDateArray[$enc_pid][Count]='".htmlspecialchars(oeFormatShortDate(date("Y-m-d", strtotime($rowresult4['date']))), ENT_QUOTES)."';\n";
                echo "CalendarCategoryArray[$enc_pid][Count]='".htmlspecialchars( xl_appt_category($rowresult4['pc_catname']), ENT_QUOTES)."';\n";
                echo "Count++;";

             }

        echo "</script>";
}


function PrintToEncounterButton($iter, $name, $ptname, $raw_encounter_date)
{
          $href =
        "javascript:window.toencounter(" . $iter['enc_pid'] .
        ",'" . addslashes($name['pid']) .
        "','" . addslashes($ptname) . "'," . $iter['enc_encounter'] .
        ",'" . oeFormatShortDate($raw_encounter_date) . "',' " .
        xl('DOB') . ": " . oeFormatShortDate($name['DOB_YMD']) . " " . xl('Age') . ": " . getPatientAge($name['DOB_YMD']) . "');
                 top.window.parent.left_nav.setPatientEncounter(EncounterIdArray[" . $iter['enc_pid'] . "],EncounterDateArray[" . $iter['enc_pid'] .
                 "], CalendarCategoryArray[" . $iter['enc_pid'] . "])";
        return $href;

}


function PrintToPatientButton($iter, $name, $ptname, $raw_encounter_date)
{
  $href =
        "javascript:window.topatient(" . $iter['enc_pid'] .
        ",'" . addslashes($name['pid']) .
        "','" . addslashes($ptname) . "'," . $iter['enc_encounter'] .
        ",'" . oeFormatShortDate($raw_encounter_date) . "',' " .
        xl('DOB') . ": " . oeFormatShortDate($name['DOB_YMD']) . " " . xl('Age') . ": " . getPatientAge($name['DOB_YMD']) . "');
                 top.window.parent.left_nav.setPatientEncounter(EncounterIdArray[" . $iter['enc_pid'] . "],EncounterDateArray[" . $iter['enc_pid'] .
                 "], CalendarCategoryArray[" . $iter['enc_pid'] . "])";
  return $href;
}

function getInsuranceDataProviderTypeByPid($iter, $raw_encounter_date)
{
        $query = "SELECT id.provider AS id, id.type, id.date, " .
        "ic.x12_default_partner_id AS ic_x12id, ic.name AS provider " .
        "FROM insurance_data AS id, insurance_companies AS ic WHERE " .
        "ic.id = id.provider AND " .
        "id.pid = ? AND " .
        "id.case_number = ? AND " .
        "id.date <= ? " .
        "ORDER BY id.type ASC, id.date DESC";

      return  sqlStatement($query, array($iter['enc_pid'],$iter['form_enc_case_number'],$raw_encounter_date) );
}


function getMissingFieldString($missing_field_results, $fieldArray) {

  $missingFieldString = null;
  $emptyVariableArray = getNullAndEmptyVariables($missing_field_results, $fieldArray);
  for($i = 0; $i < count($emptyVariableArray); $i++) {
    $missingFieldString .= ", ".$emptyVariableArray[$i];
  }

  if ($missingFieldString != null){
    $missingFieldString .= " are missing";
    $missingFieldString = ltrim($missingFieldString, ',');
  }


  return $missingFieldString;

}


function generateClaimsPayerTypeSelectionBox($lhtml, $this_encounter_id, $bgcolor, $iter, $raw_encounter_date)
{

     $lhtml .= "<select name='claims[" . attr($this_encounter_id) . "][payer]' style='background-color:$bgcolor'>";

     $result  = getInsuranceDataProviderTypeByPid($iter, $raw_encounter_date);
     $count = 0;
     $default_x12_partner = $iter['ic_x12id'];
     $prevtype = '';

     while ($row = sqlFetchArray($result)) {
       if (strcmp($row['type'], $prevtype) == 0) continue;
       $prevtype = $row['type'];
       if (strlen($row['provider']) > 0) {
         // This preserves any existing insurance company selection, which is
         // important when EOB posting has re-queued for secondary billing.
         $lhtml .= "<option value=\"" . attr(substr($row['type'],0,1).$row['id']) . "\"";

         if (($count == 0 && !$iter['payer_id']) || $row['id'] == $iter['payer_id']) {
           $lhtml .= " selected";
           if (!is_numeric($default_x12_partner)) $default_x12_partner = $row['ic_x12id'];
         }


         $lhtml .= ">" . text($row['type']) . ": " . text($row['provider']) . "</option>";
       }
       $count++;
     }

     $lhtml .= "<option value='-1'>" . xlt("Unassigned") . "</option>\n";
     $lhtml .= "</select>";
     return array($lhtml, $default_x12_partner);

}

function generateInsurancePartnerTypeSelectionBox($lhtml, $this_encounter_id, $bgcolor, $xname, $default_x12_partner)
{
    $lhtml .= "<select name='claims[" . attr($this_encounter_id) . "][partner]' style='background-color:$bgcolor'>";
        $x = new X12Partner();
        $partners = $x->_utility_array($x->x12_partner_factory());
        foreach ($partners as $xid => $xname) {
          $lhtml .= '<option label="' . attr($xname) . '" value="' . attr($xid) .'"';
          if ($xid == $default_x12_partner) {
            $lhtml .= "selected";
          }
          $lhtml .= '>' . text($xname) . '</option>';
        }
        $lhtml .= "</select>";
        $DivPut='yes';

        return array($lhtml, $DivPut);
}

function generateClaimMessagesBasedOnStatus($lhtml, $divnos, $iter, $raw_encounter_date, $lcount, $code_value, $adjustment_reasons)
{

      global $HIDDEN_DIV_INDEX;


        $lhtml .= "<div class='modal fade' id='claim_messages_$HIDDEN_DIV_INDEX'
        style='padding:10px; line-spacing:1.5em;'>".
        '    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">'.
      text(oeFormatShortDate(substr($iter['date'], 0, 10)))
         . text(substr($iter['date'], 10, 6)) . " " . xlt("Encounter was coded");

       $HIDDEN_DIV_INDEX++;

       $query = "SELECT * FROM claims WHERE " .
         "patient_id = ? AND " .
         "encounter_id = ? " .
         "ORDER BY version";
       $cres = sqlStatement($query, array($iter['enc_pid'],$iter['enc_encounter']) );

       $lastcrow = false;
       while ($crow = sqlFetchArray($cres)) {
         $query = "SELECT id.type, ic.name " .
           "FROM insurance_data AS id, insurance_companies AS ic WHERE " .
           "id.pid = ? AND " .
           "id.provider = ? AND " .
           "id.case_number = ? AND " .
           "id.date <= ? AND " .
           "ic.id = id.provider " .
           "ORDER BY id.type ASC, id.date DESC";

          $irow= sqlQuery($query, array($iter['enc_pid'],$crow['payer_id'],$iter['form_enc_case_number'],$raw_encounter_date) );

         if ($crow['bill_process']) {
           $lhtml .= "<br>\n&nbsp;" .
             text(oeFormatShortDate(substr($crow['bill_time'], 0, 10))) .
             text(substr($crow['bill_time'], 10, 6)) . " " .
             xlt("Queued for") . " " . text($irow['type']) . " " . text($crow['target']) . " " .
             xlt("billing to ") . text($irow['name']);
           ++$lcount;
         }
         else if ($crow['status'] < 6) {
             if ($crow['status'] > 1) {
               $lhtml .= "<br>\n&nbsp;" .
                 text(oeFormatShortDate(substr($crow['bill_time'], 0, 10))) .
                 text(substr($crow['bill_time'], 10, 6)) . " " .
                 htmlspecialchars( xl("Marked as cleared"), ENT_QUOTES);
               ++$lcount;
             }
             else {
               $lhtml .= "<br>\n&nbsp;" .
                 text(oeFormatShortDate(substr($crow['bill_time'], 0, 10))) .
                 text(substr($crow['bill_time'], 10, 6)) . " " .
                 htmlspecialchars( xl("Re-opened"), ENT_QUOTES);
               ++$lcount;
             }
         }
         else if ($crow['status'] == 6) {
           $lhtml .= "<br>\n&nbsp;" .
             text(oeFormatShortDate(substr($crow['bill_time'], 0, 10))) .
             text(substr($crow['bill_time'], 10, 6)) . " " .
             htmlspecialchars( xl("This claim has been forwarded to next level."), ENT_QUOTES);
           ++$lcount;
         }
         else if ($crow['status'] == 7) {
           $lhtml .= "<br>\n&nbsp;" .
             text(oeFormatShortDate(substr($crow['bill_time'], 0, 10))) .
             text(substr($crow['bill_time'], 10, 6)) . " " .
             htmlspecialchars( xl("This claim has been denied.Reason:-"), ENT_QUOTES);
             if($crow['process_file'])
              {
               $code_array=explode(',',$crow['process_file']);
               foreach($code_array as $code_key => $code_value)
                {
                   $lhtml .= "<br>\n&nbsp;&nbsp;&nbsp;";
                   $reason_array=explode('_',$code_value);
                   if(!isset($adjustment_reasons[$reason_array[3]]))
                    {
                       $lhtml .=htmlspecialchars( xl("For code"), ENT_QUOTES).' ['.text($reason_array[0]).'] '.htmlspecialchars( xl("and modifier"), ENT_QUOTES).' ['.text($reason_array[1]).'] '.htmlspecialchars( xl("the Denial code is"), ENT_QUOTES).' ['.text($reason_array[2]).' '.text($reason_array[3]).']';
                    }
                   else
                    {
                       $lhtml .=htmlspecialchars( xl("For code"), ENT_QUOTES).' ['.text($reason_array[0]).'] '.htmlspecialchars( xl("and modifier"), ENT_QUOTES).' ['.text($reason_array[1]).'] '.htmlspecialchars( xl("the Denial Group code is"), ENT_QUOTES).' ['.text($reason_array[2]).'] '.htmlspecialchars( xl("and the Reason is"), ENT_QUOTES).':- '.text($adjustment_reasons[$reason_array[3]]);
                    }
                }
              }
             else
              {
               $lhtml .=htmlspecialchars( xl("Not Specified."), ENT_QUOTES);
              }
           ++$lcount;
         }

         if ($crow['process_time']) {
           $lhtml .= "<br>\n&nbsp;" .
             text(oeFormatShortDate(substr($crow['process_time'], 0, 10))) .
             text(substr($crow['process_time'], 10, 6)) . " " .
             xlt("Claim was generated to file") . " " .
             "<a href='get_claim_file.php?key=" . attr($crow['process_file']) .
             "' onclick='top.restoreSession()'>" .
             text($crow['process_file']) . "</a>";
           ++$lcount;
         }

         $lastcrow = $crow;
       } // end while ($crow = sqlFetchArray($cres))
       return array($lhtml, $lcount, $lastcrow);

}


function generateOptionalClaimMessages($lastcrow, $lhtml, $lcount)
{
            if ($lastcrow && $lastcrow['status'] == 4) {
          $lhtml .= "<br>\n&nbsp;" . xlt("This claim has been closed.");
          ++$lcount;
        }

        if ($lastcrow && $lastcrow['status'] == 5) {
          $lhtml .= "<br>\n&nbsp;" . xlt("This claim has been canceled.");
          ++$lcount;
        }

        return array($lhtml, $lcount);
}


function generateBillingNotesBasedOnSwitch($lhtml, $iter)
{
        if($GLOBALS['notes_to_display_in_Billing'] == 1 || $GLOBALS['notes_to_display_in_Billing'] == 3) {
          $lhtml .= "<br><span>".text($iter['enc_billing_note'])."</span>";
        }
        return $lhtml;
}


function generateAndPrintRightSideEmptyRows($lhtml, $rcount, $lcount, $rhtml, $bgcolor, $missing_mods_only, $mmo_empty_mod, $mmo_num_charges)
{

 if ($lhtml) {
   while ($rcount < $lcount) {
     // $rhtml .= "<tr bgcolor='$bgcolor'><td colspan='8'></td></tr>";
     ++$rcount;
   }
   if (!$missing_mods_only || ($mmo_empty_mod && $mmo_num_charges > 1)) {
     if($DivPut=='yes')
      {
       // $lhtml.='</div>';
       $DivPut='no';
      }
     // echo "<tr bgcolor='$bgcolor'>\n<td rowspan='$rcount' valign='top'>\n$lhtml</td>$rhtml\n";
     // echo "<tr bgcolor='$bgcolor'><td colspan='9' height='5'></td></tr>\n";
   }
 }
 return array($lhtml, $rhtml, $DivPut);
}


function printJustificationText($iter, $code_types, $justify)
{
    if ($iter['id'] && $code_types[$iter['code_type']]['just']) {
      $js = explode(":",$iter['justify']);
      $counter = 0;
      foreach ($js as $j) {
        if(!empty($j)) {
          if ($counter == 0) {
            $justify .= " (<b>" . text($j) . "</b>)";
          }
          else {
            $justify .= " (" . text($j) . ")";
          }
          $counter++;
        }
      }
    }
    return $justify;
}

function generateContentForRightSideHtml($resMoneyGot, $rowcnt, $rhtml, $rhtml2, $bgcolor, $iter, $this_encounter_id, $CheckBoxBilling)
{
          while($rowMoneyGot = sqlFetchArray($resMoneyGot)){
        $rowcnt++;
        $PatientPay=$rowMoneyGot['PatientPay'];
        $date=$rowMoneyGot['date'];
        if($PatientPay > 0){
          if($rhtml){
            $rhtml2 .= "<tr bgcolor='$bgcolor'>\n";
          }
          $rhtml2 .= "<td width='50'>";
          $rhtml2 .= "<span class='text'>".xlt('COPAY').": </span>";
          $rhtml2 .= "</td>\n";
          $rhtml2 .= "<td><span class='text'>".text(oeFormatMoney($PatientPay))."</span><span style='font-size:8pt;'>&nbsp;</span></td>\n";
          $rhtml2 .= '<td align="right"><span style="font-size:8pt;">&nbsp;&nbsp;&nbsp;';
          $rhtml2 .= "</span></td>\n";
          $rhtml2 .= '<td><span style="font-size:8pt;">&nbsp;&nbsp;&nbsp;';
          $rhtml2 .= "</span></td>\n";
          $rhtml2 .= '<td><span style="font-size:8pt;">&nbsp;&nbsp;&nbsp;';
          $rhtml2 .= "</span></td>\n";
          $rhtml2 .= '<td width=100>&nbsp;&nbsp;&nbsp;<span style="font-size:8pt;">';
          $rhtml2 .= text(oeFormatSDFT(strtotime($date)));
          $rhtml2 .= "</span></td>\n";
          if ($iter['id'] && $iter['authorized'] != 1) {
            $rhtml2 .= "<td><span class=alert>".xlt("Note: This copay was entered against billing that has not been authorized. Please review status.")."</span></td>\n";
          }else{
            $rhtml2 .= "<td></td>\n";
          }
          if(!$iter['id'] && $rowcnt == 1){
            $rhtml2 .= "<td><input type='checkbox' value='0' name='claims[" . attr($this_encounter_id) . "][bill]' onclick='set_button_states()' id='CheckBoxBilling" . attr($CheckBoxBilling*1) . "'>&nbsp;</td>\n";
            $CheckBoxBilling++;
          }else{
            $rhtml2 .= "<td></td>\n";
          }
        }
      }
      return $rhtml2;
}


function printIfCurrentEncounterIdIsNotLastEncounterId($last_encounter_id, $this_encounter_id, $iter, $lcount, $rcount, $rhtml, $bgcolor, $CheckBoxBilling)
{
        if($last_encounter_id != $this_encounter_id){
      $rhtml2 = "";
      $rowcnt = 0;
      $resMoneyGot = sqlStatement("SELECT pay_amount as PatientPay,date(post_time) as date FROM ar_activity where ".
        "pid = ? and encounter = ? and payer_type=0 and account_code='PCP'",
        array($iter['enc_pid'],$iter['enc_encounter']));
        //new fees screen copay gives account_code='PCP'
      if(sqlNumRows($resMoneyGot) > 0){
        $lcount += 2;
        $rcount++;
      }
      //checks whether a copay exists for the encounter and if exists displays it.
      $rhtml2 = generateContentForRightSideHtml($resMoneyGot, $rowcnt, $rhtml, $rhtml2, $bgcolor, $iter, $this_encounter_id, $CheckBoxBilling);
      $rhtml .= $rhtml2;
    }

    return array($rhtml, $lcount, $rcount);
}


function printIfCodeIsNotAuthorized($iter, $rhtml)
{
       # This error message is generated if the authorized check box is not checked
   if ($iter['id'] && $iter['authorized'] != 1) {
     $rhtml .= "<td><span class=alert>".xlt("Note: This code has not been authorized.")."</span></td>\n";
   }
   # This will check if an item is excluded and will tell the user if it is the case.
   else if ($iter['id'] && $iter['authorized'] == 1 && $iter['exclude_from_insurance_billing'] == 1) {
     $rhtml .= "<td><span class=alert>".xlt("Note: Excluded from X12 and CMS1500.")."</span></td>\n";
   }
   else {
     $rhtml .= "<td></td>\n";
   }
   return $rhtml;
}


function echoCodeRowTableHeaders($code_type) {

  $rhtml .= "<tr>
            <td><b>$code_type</b></td>
            <td><b>Charge</b></td>
            <td><b>Clinician</b></td>
            <td><b>Date</b></td>
            <td><b>Note</b></td>
            </tr>";


  echo $rhtml;
 }

function printRightSideHtmlByValidations($rhtml, $bgcolor, $iter, $oldcode, $code_types, $last_encounter_id, $this_encounter_id, $CheckBoxBilling)
{
        if ($rhtml) {
        // $rhtml .= "<tr bgcolor='$bgcolor'>\n";
    }

    // $rhtml .= addTableHeaders($rhtml, "");
    // $rhtml .= "<td>";
    // if ($iter['id'] && $oldcode != $iter['code_type']) {
    //     $rhtml .=  text($iter['code_type']);
    // }
    $oldcode = $iter['code_type'];
    //$rhtml .= "</td>\n";
    $justify = "";
    //$justify = printJustificationText($iter, $code_types, $justify);


    $rhtml .= "<td class='code_type'>";


    $justification_text = "";
    if ($iter['justify'] != "") {
      $justification_text = "<b style='color:#888'>(";
      $justification_text .= $iter['justify'];
      $justification_text .= ")</b>";
    }


    if ($iter['code_type'] == 'COPAY') {
      $rhtml .= text(oeFormatMoney($iter['code']));
    }
    else {

      $rhtml .= text($iter['code']).$justification_text;
    }

    if ($iter['modifier']) $rhtml .= ":" . text($iter['modifier']);
    $rhtml .= "$justify</td>\n";


    if ($iter['id'] && $iter['fee'] > 0) {
       $rhtml .= '<td>';
        $rhtml .= text(oeFormatMoney($iter['fee']));
       $rhtml .= "</td>\n";
    }

    $rhtml .= '<td>';
    if ($iter['id']) $rhtml .= getProviderName(empty($iter['provider_id']) ? text($iter['enc_provider_id']) : text($iter['provider_id']));

      $rhtml .= "</td>\n";

    if($GLOBALS['display_units_in_billing'] != 0) {
       $rhtml .= '<td>';
      if ($iter['id']) $rhtml .= xlt("Units") . ":" . text($iter{"units"});
      $rhtml .= "</td>\n";
    }

    $rhtml .= '<td>';
    if ($iter['id']) $rhtml .= text(oeFormatSDFT(strtotime($iter{"date"})));
    $rhtml .= "</td>\n";



    return array($rhtml, $oldcode);
}

function printClaimListCheckBox($iter, $last_encounter_id, $this_encounter_id, $rhtml, $CheckBoxBilling)
{

  if ($iter['id'] && $last_encounter_id != $this_encounter_id) {
    $tmpbpr = $iter['bill_process'];
    if ($tmpbpr == '0' && $iter['billed']) $tmpbpr = '2';
    $rhtml .= "<td><input type='checkbox' value='" . attr($tmpbpr) . "' name='claims[" . attr($this_encounter_id) . "][bill]' onclick='set_button_states()' id='CheckBoxBilling" . attr($CheckBoxBilling*1) . "'>&nbsp;</td>\n";
    $CheckBoxBilling++;
  }
  else {
    $rhtml .= "<td></td>\n";
  }
  return array($rhtml, $CheckBoxBilling);

}


function printIfModifierIsMissing($lhtml, $rcount, $lcount, $rhtml, $bgcolor, $missing_mods_only, $mmo_empty_mod, $mmo_num_charges, $encount)
{

   if ($lhtml) {
        while ($rcount < $lcount) {
          // $rhtml .= "<tr bgcolor='$bgcolor'><td colspan='8'></td></tr>";
          ++$rcount;
        }



   }

      return array($lhtml, $rhtml, $lcount, $rcount);
}


function PrintBillingReport() {
  $divnos=0;
  if ($ret = getBillsBetween("%"))
  {
  if(is_array($ret))
   {
  ?>
  <?php
  }
    $loop = 0;
    $oldcode = "";
    $last_encounter_id = "";
    $lhtml = "";
    $rhtml = "";
    $lcount = 0;
    $rcount = 0;
    $bgcolor = "";
    $skipping = FALSE;
    $mmo_empty_mod = false;
    $mmo_num_charges = 0;

    foreach ($ret as $iter) {
      // We include encounters here that have never been billed.  However
      // if it had no selected billing items but does have non-selected
      // billing items, then it is not of interest.
      checkBillingRecordExistsForCurrentUser($iter);
      $this_encounter_id = $iter['enc_pid'] . "-" . $iter['enc_encounter'];
      if ($last_encounter_id != $this_encounter_id) {
        // This dumps all HTML for the previous encounter.
        list($lhtml, $rhtml, $lcount, $rcount) = printIfModifierIsMissing($lhtml, $rcount, $lcount, $rhtml, $bgcolor, $missing_mods_only, $mmo_empty_mod, $mmo_num_charges, $encount);

      if ($lhtml) {

        // This test handles the case where we are only listing encounters
        // that appear to have a missing "25" modifier.
        if (!$missing_mods_only || ($mmo_empty_mod && $mmo_num_charges > 1)) {
          if($DivPut=='yes')
           {
             $lhtml.='</div>';
            $DivPut='no';
           }
          //echo "<tr bgcolor='#dddddd'>\n<td rowspan='$rcount' valign='top'>\n$lhtml</td>$rhtml\n";
          //echo "<tr bgcolor='$bgcolor'><td colspan='9' height='5'></td></tr>\n\n";
          ++$encount;
        }
      }

        $lhtml = "";
        $rhtml = "";
        $mmo_empty_mod = false;
        $mmo_num_charges = 0;
        // If there are ANY unauthorized items in this encounter and this is
        // the normal case of viewing only authorized billing, then skip the
        // entire encounter.
        //
        $skipping = FALSE;
        if ($my_authorized == '1') {
          $res = sqlQuery("select count(*) as count from billing where " .
            "encounter = ? and " .
            "pid=? and " .
            "activity = 1 and authorized = 0", array($iter['enc_encounter'],$iter['enc_pid']) );
          if ($res['count'] > 0) {
            $skipping = TRUE;
            $last_encounter_id = $this_encounter_id;
            continue;
          }
        }

        $name = getPatientData($iter['enc_pid'], "fname, mname, lname, pid, billing_note, DATE_FORMAT(DOB,'%Y-%m-%d') as DOB_YMD");
        $res = checkPatientHasPrimaryInsurance($iter);

        $missing_field_results = sqlQuery("select * from insurance_data where pid = ? and type='primary'", array($iter['enc_pid']));


        $fieldArray = array("subscriber_relationship", "subscriber_street",
          "subscriber_city", "subscriber_state", "subscriber_sex",
          "subscriber_DOB", "subscriber_fname", "subscriber_lname");


        $missing_field_string = getMissingFieldString($missing_field_results, $fieldArray);

        $blinkingMessage = $missing_field_string;


        $IsNameShouldBeBlinked =  ($res['count'] > 0);
        $namecolor = ($res['count'] > 0) ? "black" : "#ff7777";
        $bgcolor = "#ffffff";

        $lcount = 1;
        $rcount = 0;
        $oldcode = "";
        $ptname = $name['fname'] . " " . $name['lname'];
        $raw_encounter_date = date("Y-m-d", strtotime($iter['enc_date']));
        $billing_note = $name['billing_note'];
        //  Add Encounter Date to display with "To Encounter" button 2/17/09  JCH
        $patient_href=   PrintToPatientButton($iter, $name, $ptname, $raw_encounter_date);
        $encounter_href = PrintToEncounterButton($iter, $name, $ptname, $raw_encounter_date);

        list($tpl_patient_name, $tpl_encounter_id, $tpl_patient_href, $tpl_encounter_href)= returnPatientData($namecolor, "", $ptname, $iter, $encounter_href, $patient_href);

        loadInsuranceDataToJsArray($iter);
        //  Not sure why the next section seems to do nothing except post "To Encounter" button 2/17/09  JCH

        //  Changed "To xxx" buttons to allow room for encounter date display 2/17/09  JCH


        $divnos=$divnos+1;
        // $lhtml .= "<a  onclick='divtoggle(\"spanid_$divnos\",\"divid_$divnos\");' class='small' id='aid_$divnos' href=\"JavaScript:void(0);".
        //   "\">(<span id=spanid_$divnos class=\"indicator\">" . htmlspecialchars( xl('Expand'), ENT_QUOTES) . '</span>)</a>';

        if($GLOBALS['notes_to_display_in_Billing'] == 2 || $GLOBALS['notes_to_display_in_Billing'] == 3){
        $lhtml .= text($billing_note);
        }

        if ($iter['id']) {
          $lcount += 2;
          $default_x12_partner = "";

          list($tpl_payer_type_selection_box, $default_x12_partner) = generateClaimsPayerTypeSelectionBox("", $this_encounter_id, $bgcolor, $iter, $raw_encounter_date);

          list($tpl_partner_type_selection_box, $DivPut) = generateInsurancePartnerTypeSelectionBox("", $this_encounter_id, $bgcolor, $xname, $default_x12_partner);

          $lhtml = generateBillingNotesBasedOnSwitch($lhtml, $iter);
          list($tpl_claim_messages, $lcount, $lastcrow) = generateClaimMessagesBasedOnStatus("", $divnos, $iter, $raw_encounter_date, $lcount, $code_value, $adjustment_reasons);
          list($lhtml, $lcount) = generateOptionalClaimMessages($lastcrow, $lhtml, $lcount);

        } // end if ($iter['id'])

      } // end if ($last_encounter_id != $this_encounter_id)

      if ($last_encounter_id != $this_encounter_id) {
            echoBillingTemplateHeader(
                          $iter['form_enc_id'],
                          $iter['form_enc_coding_done'],
                          $tpl_patient_name,
                          $tpl_encounter_id,
                          $tpl_patient_href,
                          $tpl_encounter_href,
                          $tpl_payer_type_selection_box,
                          $tpl_partner_type_selection_box,
                          $blinkingMessage);

            echoBillingTemplateBody();
      }



      if ($skipping) continue;
      // Collect info related to the missing modifiers test.
      if ($iter['fee'] > 0) {
        ++$mmo_num_charges;
        $tmp = substr($iter['code'], 0, 3);
        if (($tmp == '992' || $tmp == '993') && empty($iter['modifier']))
          $mmo_empty_mod = true;
      }



      ++$rcount;

      if ($oldcode != $iter['code_type']) {
        // it means new section of the table
        //print a new table header
        echoCodeRowTableHeaders($iter['code_type']);
      }

      list($tpl_code_row, $oldcode)  = printRightSideHtmlByValidations("", $bgcolor, $iter, $oldcode, $code_types, $GLOBALS, $last_encounter_id, $this_encounter_id, $CheckBoxBilling);


      echoBillingCodeRow($tpl_code_row.$tpl_claim_messages);


      $rhtml = printIfCodeIsNotAuthorized($iter, $rhtml);

      list($tpl_claim_list, $CheckBoxBilling) = printClaimListCheckBox($iter, $last_encounter_id, $this_encounter_id, $rhtml, $CheckBoxBilling);


      list($tpl_claim_list_print, $lcount, $rcount) = printIfCurrentEncounterIdIsNotLastEncounterId($last_encounter_id, $this_encounter_id, $iter, $lcount, $rcount, $lhtml, $bgcolor, $CheckBoxBilling);


      $last_encounter_id = $this_encounter_id;
    } // end foreach
    echo "</table><br/><br/>";

    list($tpl_right_rows, $rhtml, $DivPut) = generateAndPrintRightSideEmptyRows($lhtml, $rcount, $lcount, $rhtml, $bgcolor, $missing_mods_only, $mmo_empty_mod, $mmo_num_charges);



  }

}




?>