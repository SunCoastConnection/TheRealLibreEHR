<?php
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/patient.inc");
include_once("$srcdir/pid.inc");
require_once("$srcdir/classes/class.TransactionOverview.php");



function setUpNullCheckFilter($array) {
  foreach ($array as $key => $value) {
      if (empty($value)) {
         $array[$key] = "0.00";
      }
  }

 return $array;

}

class InsuranceClass {
  public $Date_Paid = "-";
  public $Amount_Paid = "0.00";
  public $Payment = "-";
  public $Date_Closed = "-";
}



function getSessionRowData($bindingArray) {
    $data = sqlFetchArray(sqlStatement("SELECT deposit_date, reference, pay_total FROM `ar_session` WHERE session_id = ?", $bindingArray));
    return $data;
}

if (isset($_GET['pid']) && !isset($_GET['action'])) {
    if (!empty($_GET['pid']) && !isset($_GET['action'])) {
        $pid = $_GET['pid'];
        $result  = getPatientData($pid, "*, DATE_FORMAT(DOB,'%Y-%m-%d') as DOB_YMD");
        $resultArray = array();
        $resultArray['pname']  = htmlspecialchars(($result['fname']) . " " . ($result['lname']),ENT_QUOTES);
        $resultArray['str_dob'] =  htmlspecialchars(xl('DOB') . ": " . oeFormatShortDate($result['DOB_YMD']) . " " . xl('Age') . ": " . getPatientAgeDisplay($result['DOB_YMD']), ENT_QUOTES);
        echo json_encode($resultArray);
    }
}

if (isset($_GET['pid']) && isset($_GET['action'])) {
    if (!empty($_GET['pid']) && !empty($_GET['action'])) {
    $pid = $_GET['pid'];
    setpid($pid);
    $action = $_GET['action'];
        if ($_GET['action'] == "get_encounters") {
              $result4 = sqlStatement("SELECT fe.encounter,fe.date,libreehr_postcalendar_categories.pc_catname FROM form_encounter AS fe ".
                  " left join libreehr_postcalendar_categories on fe.pc_catid=libreehr_postcalendar_categories.pc_catid  WHERE fe.pid = ? order by fe.date desc", array($pid));
              $resultArray = array();
              if(sqlNumRows($result4)>0) {
                  while($rowresult4 = sqlFetchArray($result4)) {
                      $result = array();
                      $result['encounter'] = htmlspecialchars($rowresult4['encounter'], ENT_QUOTES);
                      $result['date'] = htmlspecialchars(oeFormatShortDate(date("Y-m-d", strtotime($rowresult4['date']))), ENT_QUOTES);
                      $result['pc_catname'] = htmlspecialchars(xl_appt_category($rowresult4['pc_catname']), ENT_QUOTES);
                      array_push($resultArray, $result);
                  }
                echo json_encode($resultArray);
              }
        }

    if ($_GET['action'] == "get_overview_object") {

      $transaction_overview = new TransactionOverview($pid, $_GET['encounter']);


      if (!empty($_GET['case_number'])) {
        $transaction_overview = new TransactionOverview($pid, "", $_GET['case_number']);
      }


      if (!empty($_GET['encounter'])) {
        $transaction_overview = new TransactionOverview($pid, $_GET['encounter']);
      }
        // just replacing the unbilled and charges for now
        
        $transaction_overview_data = $transaction_overview->getData();
        echo json_encode($transaction_overview_data);
      }

    if ($_GET['action'] == "get_summary_section") {
      $pid = $_GET['pid'];

      $encounter = $_GET['encounter'];
      //construct the binding array here
      $extraQuery = "";

      $bindingArray = array($pid, $encounter);

            //gets the summary right sidebar
      $primaryInsurance = new InsuranceClass();
      $secondaryInsurance = new InsuranceClass();
      $tertiaryInsurance = new InsuranceClass();

      //gets the summary right sidebar
      $patientPayment = new InsuranceClass();
      $primary_result = sqlStatement("SELECT post_time, session_id, payer_type from ar_activity WHERE pid = ? and encounter = ? AND account_code = 'IPP' AND payer_type = 1 ORDER BY post_time DESC LIMIT 1",$bindingArray);
      $secondary_result = sqlStatement("SELECT post_time, session_id, payer_type from ar_activity WHERE pid = ? and encounter = ? AND account_code = 'IPP' AND payer_type = 2 ORDER BY post_time DESC LIMIT 1",$bindingArray);
      $tertiary_result = sqlStatement("SELECT post_time, session_id, payer_type from ar_activity WHERE pid = ? and encounter = ? AND account_code = 'IPP' AND payer_type = 3 ORDER BY post_time DESC LIMIT 1",$bindingArray);
      $patient_payment_result = sqlStatement("SELECT post_time, session_id, payer_type from ar_activity WHERE pid = ? and encounter = ? AND (account_code = 'PP' OR account_code='PCP') AND payer_type = 0 ORDER BY post_time DESC LIMIT 1",$bindingArray);

      $primary_array = sqlFetchArray($primary_result);
      $secondary_array = sqlFetchArray($secondary_result);
      $tertiary_array = sqlFetchArray($tertiary_result);
      $patient_payment_array  = sqlFetchArray($patient_payment_result);

      if (!empty($primary_array["session_id"])) {
        $bindingArray = array($primary_array['session_id']);
        $primaryData = getSessionRowData($bindingArray);
        $primaryInsurance->Date_Paid = $primaryData['deposit_date'];
        $primaryInsurance->Amount_Paid =  $primaryData['pay_total'];
        $primaryInsurance->Payment = $primaryData['reference'];
        $primaryInsurance->Date_Closed = substr($primary_array['post_time'],0,10);
      }

      if (!empty($secondary_array["session_id"])) {
        $bindingArray = array($secondary_array['session_id']);
        $secondaryData = getSessionRowData($bindingArray);
        $secondaryInsurance->Date_Paid = $secondaryData['deposit_date'];
        $secondaryInsurance->Amount_Paid =  $secondaryData['pay_total'];
        $secondaryInsurance->Payment = $secondaryData['reference'];
        $secondaryInsurance->Date_Closed = substr($secondary_array['post_time'],0,10);
      }

      if (!empty($tertiary_array["session_id"])) {
        $bindingArray = array($tertiary_array['session_id']);
        $tertiaryData = getSessionRowData($bindingArray);
        $tertiaryInsurance->Date_Paid = $tertiaryData['deposit_date'];
        $tertiaryInsurance->Amount_Paid =  $tertiaryData['pay_total'];
        $tertiaryInsurance->Payment = $tertiaryData['reference'];
        $tertiaryInsurance->Date_Closed = substr($tertiary_array['post_time'],0,10);
      }

      if (!empty($patient_payment_array["session_id"])) {
        $bindingArray = array($patient_payment_array['session_id']);
        $patientPaymentData = getSessionRowData($bindingArray);
        $patientPayment->Date_Paid = $patientPaymentData['deposit_date'];
        $patientPayment->Amount_Paid =  $patientPaymentData['pay_total'];
        $patientPayment->Payment = $patientPaymentData['reference'];
        $patientPayment->Date_Closed = $patientPaymentData['post_time'];
      }

      // we have case numbers and billing ids in array, time to determine whether they are
      // primary, secondary, tertiary

      $bindingArray = array($pid);


      // primary
      // secondary
      // tertiary

      $result = array($primaryInsurance, $secondaryInsurance, $tertiaryInsurance, $patientPayment);
      echo json_encode($result);

    }

    }
}
?>