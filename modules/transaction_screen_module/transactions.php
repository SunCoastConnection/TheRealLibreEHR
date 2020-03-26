<?php

    require_once("../../interface/globals.php");
    require_once("$srcdir/billing.inc");
    require_once("$srcdir/patient.inc");
    require_once "$srcdir/options.inc.php";
    require_once("$srcdir/headers.inc.php");
    require_once("../../custom/code_types.inc.php");
    require_once("$srcdir/global_functions.php");

     if (isset($_GET['set_pid'])) {

             include_once("$srcdir/pid.inc");
             setpid($_GET['set_pid']);
     }
     if (isset($_POST['pid'])) {
         if (!empty($_POST['pid'])) {
             $pid = $_POST['pid'];
         }
     }
?>

<html>
<head>
    <title><?php echo xlt('Transactions'); ?></title>
    <span class="title"><?php echo xlt('Transactions'); ?></span>
    <link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="transactions.css">
    <script src="<?php echo $GLOBALS['webroot'] ?>/assets/js/bootstrap-4-0/js/popper.min.js"></script>
    <!-- Get Bootstrap, jQuery (required for bootstrap), and Datepicker -->
    <?php call_required_libraries(['jquery-min-3-3-1','bootstrap-4-0', 'datepicker', 'font-awesome', 'iziModalToast', 'select2', 'nform-helper', 'vuejs']); ?>
    <script>
        // create a event bus
        const transaction_bus = new Vue()
    </script>
    <style>
        body {
            background-color: #F7F5F4 !important;
        }
        hr {
            height: 2px;
            background-color: #709a37 !important;
        }
        .table td {
           text-align: center;
        }

        #main-row {
            margin: 5px auto !important;
        }
        #first-row {
            background-color: white !important;
            margin-top: -15px !important;
            padding-top: 10px;
        }
        #search-button {
            background-color: #709a37 !important;
            height:35px;
            margin-top:-2px;
            color: white;
            padding: 0.3rem 0.9rem;
        }
        #dropdown {
            margin-left: 15px;
            margin-top: 8px;
            border-color: white;
        }
        .nav .active {
            background-color: white !important;
            color: black !important;
            border-color: white !important;
            border-top: 3px solid #709a37 !important;
        }
        #nav-tabContent {
            margin-bottom: 10px;
        }
        .modal-position {
           position: absolute;
           top: -100px;
           right: -1400px !important;
           bottom: 0;
           left: 0;
           z-index: 10040;
           overflow: auto;
           overflow-y: auto;
        }
        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }
        .modal-content {
             border-top: 3px solid #709a37 !important;
        }
        /* #details-table {
            border-collapse: separate;
            border-spacing: 0.4em;
        } */
        input[type=date]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            display: none;
        }
        .nav-item {
            max-width: 69px;
        }
        .nav-item h6 {
            margin-left: -10px;
            font-size: 14px;
        }
        .nav-tabs {
            max-height: 40px !important;
            border-bottom: 0px !important;
        }
        #payment_method {
            margin-top: -10px;
        }
        .payment_method {
            margin-top: -20px !important;
            margin-bottom: 10px !important;
        }
        /* .table-data { display: table; }
        .table-data>* { display: table-row; }
        .table-data>*>* { display: table-cell; } */
        .underline {
            border-radius: 0px !important;
            border-color: #A9A9A9 !important;
            border-top: 0px !important;
            border-left: 0px !important;
            border-right: 0px !important;
            background-color: #F8F8F8;
        }
        .remove-border {
            background-color: transparent !important;
            border: none !important;
            outline: none !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
        }
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 5px;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row content-background" id="main-row">
            <div class="col-sm-12" id="alert_col"></div>
            <div class="col-sm-12"><hr style="margin-right: 5px; min-width: 100%; margin-left: -15px">
                <div class="row" id="first-row"><hr>
                    <div class="col-sm-5">

                            <div id="search_component">
                                <table class="table table-borderless">

                                    <tr>
                                       <td>
                                            <?php echo xlt('Encounter Date'); ?>:
                                        </td>

                                        <td>
                                            <?php echo xlt('Name'); ?>:
                                        </td>
                                        <td>
                                             <?php echo xlt('Date of Birth'); ?>:

                                        </td>
                                        <td>
                                            &nbsp;
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="date" class="form-control" v-model="encounter_date" @keyup.enter="submitData" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Patient Name" v-model="name" @keyup.enter="submitData" style="width: 200px;" />

                                        </td>
                                        <td>
                                            <input type="date" name="dob" class="form-control" v-model="dob" @keyup.enter="submitData" />

                                        </td>
                                        <td>
                                            <button type="button" href="#" class="btn btn-primary btn-sm" @click="getPatientNames">Search </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                        </td>
                                    </tr>
                                </table>
                                 <div class="dropdown">
                                        <button style="display: none;" class="dropdown-toggle"
                                        data-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">

                                                <table class="table bg-light">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>DOB</th>
                                                        <th>Encounter Date</th>
                                                    </tr>
                                                    <template v-for="(item,index) in patient_items">
                                                        <tr @click="selectPatient(item.pid, item.encounter_list)">
                                                            <td>{{ item.fname }} {{ item.mname }} {{ item.lname }}</td>
                                                            <td>{{ item.DOB }}</td>

                                                            <td>
                                                                <template v-for="date in item.encounter_date_list">
                                                                    {{ date }}<br/>
                                                                </template>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </table>

                                            </ul>
                                </div>
                            </div>




                             </div>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6" style="margin-top: 10px !important">
                                <p id="in_collection" style="font-size:22px; font-weight:bold; color:red; word-wrap: break-word"></p>
                            </div>
                            <div class="col-sm-6">
                                <!-- <label class= "Rectangle-Selected-Case" style="float: right"><?php //echo xlt('Selected Case'); ?>: <br> -->
                                    <!-- <select class="custom-select form-control-sm Rectangle-Selected-Case" name="claim_ins_code" id="select_case">
                                    </select> -->
                                    <div class="dropdown" style="float: right; display: inline !important">
                                        <label class= "Rectangle-Selected-Case" style="float: right"><b><?php echo xlt('Selected Encounter'); ?>: </b><br>
                                      <div id="select_case">
                                        <select class="form-control" v-model="selected_case_number" :disabled="drop_down_data.length == 0">

                                            <template v-if="drop_down_data.length > 0">

                                                <option value="">All Encounters</option>
                                                <template v-for="item in drop_down_data">
                                                    <option :value="item.encounter">{{ item.encounter }}</option>
                                                </template>

                                            </template>
                                        </select>
                                      </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <table class="table table-condensed table-borderless table-no-padding">
                            <tr>
                                <td>
                                   <span class="align-middle badge border border-dark" style="background-color: #ffea004d !important; color: #ffea004d;">&nbsp;</span>
                                </td>

                                <td>
                                     <?php echo xlt(' Primary Open'); ?>
                                </td>

                                <td>
                                    <span class="align-middle badge border border-dark" style="background-color: #ff95004d !important; color: #ff95004d;">&nbsp;</span>
                                </td>

                                <td>
                                    <?php echo xlt('Sec/Tert Open'); ?>
                                </td>
                                <td>
                                    <span class="align-middle badge border border-dark" style="background-color: #6c5bd64d !important; color: #6c5bd64d;">&nbsp;</span>
                                </td>

                                <td>
                                    <?php echo xlt('Ins Payment'); ?>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <span class="align-middle badge border border-dark" style="background-color: #53e7fa4d !important; color: #53e7fa4d;">&nbsp;</span>
                                </td>

                                <td>
                                    <?php echo xlt('Closed'); ?>
                                </td>

                                <td>
                                    <span class="align-middle badge border border-dark" style="background-color: #FFFFFF !important; color: #FFFFFF;">&nbsp;</span>
                                </td>
                                <td>
                                    <?php echo xlt('Charge'); ?>
                                </td>
                                <td>
                                    <span class="align-middle badge border border-dark" style="background-color: #ff3b304d !important; color: #ff3b304d;">&nbsp;</span>
                                </td>
                                <td>
                                    <?php echo xlt('Pat Payment'); ?>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>
                <div class="row" id="second-row" style="margin-top: 5px; margin-left: -30px; margin-right: 0px">
                    <div class="col-sm-2">
                        <div class="Rectangle-overview" style="border-radius: 0px !important" id="overview_section">
                            <h6 class="card-header" style="background-color: #709a37; border-radius: 0px !important; color: white;"><?php echo xlt('Overview'); ?></h6>
                            <div class="card-body" style="background-color: white !important">
                                <h6 class="card-title"><strong><?php echo xlt('Recent Activity'); ?></strong></h6>
                                <ul class="list-group list-group-flush" style="list-style: none;">
                                    <li><?php echo xlt('Charges'); ?>:
                                        <span style="float: right">
                                            <strong>
                                                {{ overview_section_data.charges | formatToCurrency}}
                                            </strong>
                                        </span>
                                    </li><!-- this is from the billing table-->
                                    <li><?php echo xlt('Insurance Unbilled'); ?>: <span style="float: right">

                                        <strong>
                                           {{overview_section_data.unbilled | formatToCurrency}}
                                        </strong>

                                    </span></li><!-- this is billed flag from the billing table-->
                                    <li ><?php echo xlt('Payments'); ?>: <span style="float: right">
                                        <strong>
                                            {{ overview_section_data.payments | formatToCurrency}}
                                        </strong>
                                    </span></li><!-- ar_activity-->


                                    <li><?php echo xlt('Adjustments'); ?>: <span style="float: right">
                                        <strong>
                                            {{ overview_section_data.adjustments | formatToCurrency}}
                                        </strong>
                                    </span></li>

                                    <!-- ar_activity-->
                                    <li><?php echo xlt('Case Collection %'); ?>: <span style="float: right">
                                        <strong>
                                            {{ overview_section_data.case_collection | twoDigitFormat }}
                                        </strong>
                                        </span>
                                    </li>
                                </ul><br>

                                <h6 class="card-title"><strong><?php echo xlt('Balance'); ?></strong></h6>
                                <ul class="list-group list-group-flush" style="list-style: none;">
                                    <li><?php echo xlt('Primary Balance'); ?>: <span style="float: right">
                                        <strong>
                                            {{ overview_section_data.primary_balance | formatToCurrency}}
                                        </strong>
                                    </span></li><!-- this is from the billing table-->
                                    <li><?php echo xlt('Secondary/Tert Balance'); ?>: <span style="float: right">
                                        <strong>
                                          {{ overview_section_data.secondary_balance | formatToCurrency}}
                                        </strong>
                                    </span></li><!-- Math billing minus ar_activity after primary paid -->
                                    <li><?php echo xlt('Patient Balance'); ?>: <span style="float: right">
                                        <strong>
                                            {{ overview_section_data.patient_balance | formatToCurrency}}
                                        </strong>
                                    </span></li><!-- Math billing minus ar_activity -->
                                    <li><?php echo xlt('Unapplied Amount'); ?>: <span style="float: right">

                                        <strong>
                                            {{ overview_section_data.unapplied | formatToCurrency }}
                                        </strong>

                                    </span></li><!-- no good place to get this -->

                                </ul><br>

                                <h6 class="card-title"><strong><?php echo xlt('Total Payments'); ?></strong></h6>
                                <ul class="list-group list-group-flush" style="list-style: none;">

                                    <li><?php echo xlt('Primary Paid'); ?>: <span style="float: right">

                                        <strong>
                                            {{ overview_section_data.primary_paid | formatToCurrency }}
                                        </strong>

                                    </span></li><!-- ar_activity use account_code and payor_type-->
                                    <li><?php echo xlt('Secondary/Tert Paid'); ?>: <span style="float: right">
                                        <strong>
                                            {{ overview_section_data.secondary_paid | formatToCurrency }}
                                        </strong>

                                    </span></li><!-- ar_activity use account_code and payor_type-->
                                    <li><?php echo xlt('Patient Paid'); ?>: <span style="float: right">

                                        <strong>
                                            {{ overview_section_data.patient_paid | formatToCurrency }}
                                        </strong>

                                    </span></li><!-- ar_activity use account_code and payor_type-->
                                </ul><br>

                                <h6 class="card-title"><strong><?php echo xlt('Limitations'); ?></strong></h6>
                                <ul class="list-group list-group-flush" style="list-style: none;">
                                    <li><?php echo xlt('Auth End Date'); ?>: <span style="float: right"><strong>mm/dd/yyyy</strong></span></li><!--from authorizations code-->
                                    <li><?php echo xlt('Authorized Visits'); ?>: <span style="float: right"><strong>0</strong></span></li><!--from authorizations code-->
                                    <li><?php echo xlt('Remaining Visits'); ?>: <span style="float: right"><strong>0</strong></span></li><!--from authorizations code-->
                                    <li><?php echo xlt('Max Annual Visits'); ?>: <span style="float: right"><strong>0</strong></span></li><!--from authorizations code-->
                                    <li><?php echo xlt('Charge Limits'); ?>: <span style="float: right"><strong>0.00</strong></span></li><!--from authorizations code-->
                                </ul><br>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                                <div class="card-header" style="background-color: #709a37; border-radius: 0px !important; color: white; max-height: 45px; min-width: 1250px">
                                    <?php echo xlt('Services'); ?>
                                </div>
                                <table class="table">

                                    <thead class="bg-light">

                                            <th class="bg-light sticky-top expandCollapse collpaseButton">
                                                +/-
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Date
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Description
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Code
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Modifiers
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Units
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Facility
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Amount
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Pat Paid
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Ins Paid
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Adjust
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Reason
                                            </th>
                                            <th class="bg-light sticky-top">
                                                Balance
                                            </th>

                                    </thead>
                                    <tbody class="details-body" id="details-body"></tbody>
                                </table>
                                <hr style="margin-top: -16px; min-width: 101%">
                    </div>
                    <div class="col-sm-2">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a style="border-color: #709a37; border-radius: 0px; color: white; background-color: #709a37;" class="nav-item nav-link active" id="nav-summary-tab" data-toggle="tab" href="#nav-summary" role="tab" aria-controls="nav-summary" aria-selected="true"><h6 style="margin-left: -12px !important"><?php echo xlt('Summary'); ?></h6></a>&nbsp;
                                    <a style="border-color: #709a37; border-radius: 0px; color: white; background-color: #709a37;" class="nav-item nav-link" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false"><h6 style="margin-left: -12px !important"><?php echo xlt('Payment'); ?></h6></a>&nbsp;
                                    <a style="border-color: #709a37; border-radius: 0px; color: white; background-color: #709a37;" class="nav-item nav-link" id="nav-claim-tab" data-toggle="tab" href="#nav-claim" role="tab" aria-controls="nav-claim" aria-selected="false"><h6 style="margin-left: -6px !important"><?php echo xlt('Claim'); ?></h6></a>&nbsp;
                                    <a style="border-color: #709a37; border-radius: 0px; color: white; background-color: #709a37;" class="nav-item nav-link" id="nav-charges-tab" data-toggle="tab" href="#nav-charges" role="tab" aria-controls="nav-charges" aria-selected="false"><h6><?php echo xlt('Charges'); ?></h6></a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="nav-summary" role="tabpanel" aria-labelledby="nav-summary-tab">
                              <div class="card-body" style="background-color: white !important">
                                  <h6 class="card-title"><strong><?php echo xlt('Primary Insurance'); ?></strong></h6><!-- insurance_data using case number -->
                                  <ul class="list-group list-group-flush" style="list-style: none;">
                                      <li><?php echo xlt('Date Paid'); ?>: <span style="float: right"><strong id="Primary_Insurance_Date_Paid">11/22/18</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Amount Paid'); ?>: <span style="float: right"><strong id="Primary_Insurance_Amount_Paid">370.02</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Payment/Ref #'); ?>: <span style="float: right"><strong id="Primary_Insurance_Payment">1008975</strong></span></li><!-- reference from ar_session -->
                                      <li><?php echo xlt('Date Closed'); ?>: <span style="float: right"><strong id="Primary_Insurance_Date_Closed">11/25/18</strong></span></li><!-- No good way to get this yet -->
                                  </ul>
                                  <hr style="background-color: #f8f9fa !important">

                                  <h6 class="card-title"><strong><?php echo xlt('Secondary Insurance'); ?></strong></h6>
                                  <ul class="list-group list-group-flush" style="list-style: none;">
                                      <li><?php echo xlt('Date Paid'); ?>: <span style="float: right"><strong
                                        id="Secondary_Insurance_Date_Paid">11/22/18</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Amount Paid'); ?>: <span style="float: right"><strong id="Secondary_Insurance_Amount_Paid">370.02</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Payment/Ref #'); ?>: <span style="float: right"><strong id="Secondary_Insurance_Payment">1008975</strong></span></li><!-- reference from ar_session -->
                                      <li><?php echo xlt('Date Closed'); ?>: <span style="float: right"><strong id="Secondary_Insurance_Date_Closed">11/25/18</strong></span></li><!-- No good way to get this yet -->
                                  </ul>
                                  <hr style="background-color: #f8f9fa !important">

                                  <h6 class="card-title"><strong><?php echo xlt('Tertiary Insurance'); ?></strong></h6>
                                  <ul class="list-group list-group-flush" style="list-style: none;">
                                      <li><?php echo xlt('Date Paid'); ?>: <span style="float: right"><strong
                                         id="Tertiary_Insurance_Date_Paid">11/22/18</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Amount Paid'); ?>: <span style="float: right"><strong  id="Tertiary_Insurance_Amount_Paid">370.02</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Payment/Ref #'); ?>: <span style="float: right"><strong  id="Tertiary_Insurance_Payment">1008975</strong></span></li><!-- reference from ar_session -->
                                      <li><?php echo xlt('Date Closed'); ?>: <span style="float: right"><strong  id="Tertiary_Insurance_Date_Closed">11/25/18</strong></span></li><!-- No good way to get this yet -->
                                  </ul>
                                  <hr style="background-color: #f8f9fa !important">

                                  <h6 class="card-title"><strong><?php echo xlt('Patient Payment'); ?></strong></h6>
                                  <ul class="list-group list-group-flush" style="list-style: none;">
                                      <li><?php echo xlt('Date Paid'); ?>: <span style="float: right"><strong
                                         id="Patient_Payment_Date_Paid">11/22/18</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Amount Paid'); ?>: <span style="float: right"><strong  id="Patient_Payment_Amount_Paid">.00</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Co-Pay'); ?>: <span style="float: right"><strong id="Patient_Payment_Payment">Yes</strong></span></li><!-- ar_activity -->
                                      <li><?php echo xlt('Payment/Ref #'); ?>: <span style="float: right"><strong  id="Patient_Payment_Date_Closed">567890</strong></span></li><!-- ar_activity -->
                                  </ul><br>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
                              <div class="card-body" style="background-color: white !important">
                                  <div class="prepend-me">
                                      <?php require 'transaction_screen/html/prepend_section.html' ?>
                                  </div><!-- visit details come here form getTabsInfo function in JS section -->
                                      <input type="hidden" name="send_n" id="send_n">
                                      <input type="hidden" name="case_number" id="case_number">
                                      <input type="hidden" name="payment_pid" id="payment_pid">
                                      <input type="hidden" name="payment_encounter" id="payment_encounter">
                                      <input type="hidden" name="payment_billing_id" id="payment_billing_id">
                                      <div class="row">
                                          <div class="col-sm-4">
                                              <h6>Payment Type:</h6>
                                              <h6 id="append_ins_checkboxes"></h6>

                                              <div class="form-check">
                                                  <input class="form-check-input radio" type="radio" name="payment_type" id="payment_patient" value="Patient Payment"
                                                  nform-custom-identifier="payment_type" onclick="changePaymentList('patient')">
                                                  <label class="form-check-label" for="payment_patient">Patient</label>

                                                  <input class="form-check-input radio" type="radio" name="payment_type" id="payment_primary" value="Primary Payment"
                                                  nform-custom-identifier="payment_type" onclick="changePaymentList('primary')">
                                                  <label class="form-check-label" for="payment_primary">Primary Payment</label>


                                                  <input class="form-check-input radio" type="radio" name="payment_type" id="payment_secondary" value="Secondary Payment" nform-custom-identifier="payment_type"  onclick="changePaymentList('secondary')">

                                                  <label class="form-check-label" for="payment_secondary">Secondary Payment</label>                                                                              <input class="form-check-input radio" type="radio" name="payment_type" id="payment_tertiary" value="Tertiary Payment" nform-custom-identifier="payment_type"  onclick="changePaymentList('tertiary')">
                                                  <label class="form-check-label" for="payment_tertiary">Tertiary Payment</label>
                                              </div>
                                          </div>
                                          <div class="col-sm-8">
                                              <h6>Method:</h6>
                                              <input class="form-control form-control-sm payment_section_input_observer" type="text" name="payment_method" value="Check Payment" id="payment_method"  readonly>
                                              <?php
                                                function adjReasonList($name_attr) {
                                                    return generate_select_list($name_attr, 'adjreason', '', xl('Select value'), 'Select adjustment reason', 'adj_reason_list custom-select form-control-sm');
                                                }
                                                $service_adj_reason_list = generate_select_list('_service_adj_reason', 'adjreason', '', xl('Select value'), 'Select adjustment reason', 'adj_reason_list custom-select form-control-sm service_adj_reason', 'updateAdjReason(this);');
                                                $adj_reason_list = generate_select_list('_service_adj_reason', 'adjreason', '', xl('Select value'), 'Select adjustment reason', 'adj_reason_list custom-select form-control-sm service_adj_reason');
                                                ?>
                                              <?php $payment_method_list = generate_select_list('payment_method', 'payment_method', 'check_payment', xl('Select value'), 'Select payment method', 'payment_method_class custom-select form-control-sm payment_section_input_observer'); ?>
                                              <?php $insurance_payment_method_list = generate_select_list('payment_method', 'insurance_payment_method', 'check_payment', xl('Select value'), 'Select payment method', 'payment_method_class custom-select form-control-sm payment_section_input_observer'); ?>

                                              <label for="acct_ref" id="prepend_payment_method" class="col-form-label" style="margin-top: 5px">Acct/Ref#:</label>
                                              <input class="form-control form-control-sm payment_section_input_observer" type="text" name="acct_ref" value="" id="payment_acct_ref" style="margin-top: -10px">
                                              <label for="payment_amount" class="col-form-label" style="margin-top: 5px">Amount:</label>
                                              <input class="form-control form-control-sm payment_section_input_observer" type="number" name="payment_amount" value="0.00" id="payment_amount" style="margin-top: -10px">

                                              <div style="float: right; margin-top: 10px">
                                                  <button id="clear_payment" class="btn btn-sm" style="height: 37px; background-image: linear-gradient(to bottom, #dddddd, #999999)"><label><p style="color: black">Clear</p></label></button>
                                                  <button class="btn-primary btn-sm" style="margin-left: 5px" id="save_payment_button"><label>Save Payment</label></button>
                                              </div>
                                          </div>
                                      </div>

                              </div>
                          </div>
                          <div class="tab-pane fade" id="nav-claim" role="tabpanel" aria-labelledby="nav-claim-tab">
                              <div class="card-body" style="background-color: white !important">
                                  <div class="prepend-me">
                                      <?php require 'transaction_screen/html/prepend_section.html' ?>
                                  </div>
                                      <div class="row">
                                          <div class="col-sm-4">
                                              <h6>Insurance:</h6>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="claim_type" id="primary_radio" value="primary">
                                                  <label class="form-check-label" for="primary_radio">Primary</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="claim_type" id="secondary_radio" value="secondary">
                                                  <label class="form-check-label" for="secondary_radio">Secondary</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="claim_type" id="tertiary_radio" value="tertiary">
                                                  <label class="form-check-label" for="tertiary_radio">Tertiary</label>
                                              </div>

                                          </div>
                                          <div class="col-sm-8">
                                              <label for="claim_ins_code" class="col-form-label" style="margin-top: -10px">Insurance Code:</label>
                                              <select class="custom-select form-control-sm claim_section_input_observer" name="claim_ins_code" id="claim_ins_code" style="margin-top: -10px">
                                                <option selected>ANTBLU</option>
                                                <option value="patient">Payment Method</option>
                                                <option value="insurance">Insurance</option>
                                              </select>
                                              <label for="claim_amount" class="col-form-label" style="margin-top: 5px">Amount:</label>
                                              <input class="form-control form-control-sm claim_section_input_observer observe_header_charges" type="number" name="claim_amount" value="0.00" id="claim_amount" style="margin-top: -10px" disabled>

                                              <div style="float: right; margin-top: 10px">
                                                  <button class="btn btn-sm" style="height: 37px; background-image: linear-gradient(to bottom, #dddddd, #999999)"><label><p style="color: black">Cancel</p></label></button>
                                                  <button class="btn-primary btn-sm" style="margin-left: 5px" id="submit_claim_button"><label>File Claim</label></button>
                                              </div>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                            <style type="text/css">
                            .sticky-header {
                                {
                                    position: sticky;
                                    position: -webkit-sticky;
                                    top: 0;
                                    z-index: 10;
                                }

                            }
                            .select2-selection--single {

                              overflow-y: scroll;

                            }
                            .select2-selection__rendered{
                              word-wrap: break-word !important;
                              text-overflow: inherit !important;
                              white-space: normal !important;
                            }
                            </style>



                          <div class="tab-pane fade" id="nav-charges" role="tabpanel" aria-labelledby="nav-charges-tab">
                              <div class="card-body" style="background-color: white !important">
                            <div class="prepend-me">
                              <?php require 'transaction_screen/html/prepend_section.html' ?>
                            </div>


                              <div id="charge_modal" class=" modal fade" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header" style="background-color: #709a37;">
                                           <h4 class="modal-title text-white">Charge Details</h4>
                                           <div class="text-right"><h2 style="cursor: pointer;"><i class="fa fa-close text-white" data-dismiss="modal"></i></h2></div>
                                         </div>
                                          <div class="modal-body">
                                          </div>
                                          <div class="moda-footer">
                                                   <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                                                    <button type="button" class="btn btn-primary" id="charge_section_modal_add_charge">Add Charge</button>
                                                  </div>
                                          </div>
                                      </div>
                                    </div>
                              </div>

                          <!-- add charge html here -->
                          <?php require 'transaction_screen/html/charge_section.html'; ?>


                        </div>
                        <?php // this needs to be in a for loop to display all the audit changes work needs to be done on the other programs that update this information  ?>
                        <div class="card" style="border-radius: 0px !important">
                            <h6 class="card-header" style="background-color: #709a37; border-radius: 0px !important; color: white;"><?php echo xlt('Transaction Audit'); ?></h6>
                            <div class="card-body" id="audit_trail" style="background-color: white !important; overflow-y: auto; height:335px;">
                                <ul class="list-group list-group-flush" style="list-style: none;">
                                    <li><span  style="float: left">Select transaction to see audit trail.</span></li>
                                </ul><br>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- reverese patient payment modal -->
<div id="reverse-patient-payment-modal">
</div>

<!-- reverse patient payment modal end -->


<!-- service-izi-modal-->
<div id="service_modal" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 90vw !important;
    max-height: 80vh !important;"
     role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #709a37;">
             <h4 class="modal-title text-white">Visit Details</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body" style="
            max-width: 90vw !important;
            max-height: 80vh !important;
            overflow-x: scroll !important;
            overflow-y: scroll !important;">
           </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="saveServiceModal()">Save</button>
        <button type="button" class="btn btn-sm btn-primary" id="service_modal_close_visit">Close Visit</button>
        <!--<button type="button" class="btn btn-sm btn-primary" id="service_modal_add_notes" onclick="transaction_bus.$emit('open-transaction-note-modal')">Transaction Notes</button>-->
    </div>
</div>
</div>
</div>
<!-- service-izi-modal-end -->

<!-- Payment Modal -->
<div class="modal fade modal-position" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Payment</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-sm-4">Case:</div><div class="col-sm-8" id="modal_case"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Description:</div><div class="col-sm-8" id="modal_description"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Service Date:</div><div class="col-sm-8" id="modal_service_date"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Facility:</div><div class="col-sm-8" id="modal_facility"></div>
          </div>
          <hr style="background-color: #f8f9fa !important">
          <div class="row">
              <div class="col-sm-4">Date:</div><div class="col-sm-8"><b id="modal_date"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Type:</div><div class="col-sm-8"><b id="modal_type"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Amount:</div><div class="col-sm-8"><b id="modal_amount"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Method:</div><div class="col-sm-8"><b id="modal_method"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Acct/Ref#:</div><div class="col-sm-8"><b id="modal_acct_ref"></b></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="savePatientPayment()">Save Payment</button>
    </div>
    </div>
  </div>
</div>

<!-- Claim Modal -->
<div class="modal fade modal-position" id="claim-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Claim Details</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-sm-4">Case:</div><div class="col-sm-8" id="claim_modal_case"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Description:</div><div class="col-sm-8" id="claim_modal_description"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Service Date:</div><div class="col-sm-8" id="claim_modal_service_date"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Facility:</div><div class="col-sm-8" id="claim_modal_facility"></div>
          </div>
          <hr style="background-color: #f8f9fa !important">
          <div class="row">
              <div class="col-sm-4">Date:</div><div class="col-sm-8"><b id="claim_modal_date"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Ins Code:</div><div class="col-sm-8"><b id="claim_modal_ins_code"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Amount:</div><div class="col-sm-8"><b id="claim_modal_amount"></b></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="saveClaim()">File Claim</button>
    </div>
    </div>
  </div>
</div>

<!-- Charges Modal -->
<div class="modal fade modal-position" id="charges-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Charge Details</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-sm-4">Case:</div><div class="col-sm-8" id="charges_modal_case"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Description:</div><div class="col-sm-8" id="charges_modal_description"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Service Date:</div><div class="col-sm-8" id="charges_modal_service_date"></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Facility:</div><div class="col-sm-8" id="charges_modal_facility"></div>
          </div>
          <hr style="background-color: #f8f9fa !important">
          <div class="row">
              <div class="col-sm-4">Date:</div><div class="col-sm-8"><b id="charges_modal_date"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">CPT Code:</div><div class="col-sm-8"><b id="charges_modal_cpt_code"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Mod 1:</div><div class="col-sm-8"><b id="charges_modal_mod_1"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Mod 2:</div><div class="col-sm-8"><b id="charges_modal_mod_2"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Units:</div><div class="col-sm-8"><b id="charges_modal_units"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Description:</div><div class="col-sm-8"><b id="charges_modal_cpt_code_description"></b></div>
          </div>
          <div class="row">
              <div class="col-sm-4">Amount:</div><div class="col-sm-8"><b id="charges_modal_amount"></b></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="saveCharges()">Add Charge</button>
    </div>
    </div>
  </div>
</div>


<!-- Confirmation Modal -->
<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Close Visit</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="cv_n" hidden></div>
        <div id="cv_encounter" hidden></div>
        <div class="row">
            <div class="col-sm-4">Remaining Balance:</div>
            <div class="col-sm-8" id ="cv_remaining_balance" style="color: red">.00</div>
        </div>
        <div class="row">
            <div class="col-sm-4">Patient Payment:</div>
            <div class="col-sm-8" id="cv_patient_payment">.00</div>
        </div><br>
        <div class="row"><div class="col-sm-12" id="cv_message">Would you like to apply the patient payment toward the balance and close out the visit?</div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"  style="color:black !important">Cancel</button>
        <button type="button" class="btn btn-outline-secondary" style="color:black !important">Save Visit</button>
        <button type="button" class="btn btn-primary" id="close_visit_button" onclick="closeVisitPostMethod()">Close Visit</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Line Items confirmation modal -->
<div class="modal fade" id="delete-encounter-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete Encounters</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row"><div class="col-sm-12">Are you sure you want to delete these selected encounters?</div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal" style="color:black !important" onclick="unSelectEncounters()">Cancel</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteEncounter()">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Payment Modal -->
<!-- <div class="modal fade" id="edit-payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit payment</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <form method="POST" action="save_payments.php" id="edit_payment_form" style="margin-left: -20px" autocomplete="off">
                <input type="hidden" name="edit_n" id="edit_n">
                <input type="hidden" name="edit_pid" id="edit_pid">
                <input type="hidden" name="edit_encounter" id="edit_encounter">
                <input type="hidden" name="edit_billing_id" id="edit_billing_id">
                <input type="hidden" name="edit_sequence_no" id="edit_sequence_no">
                <input type="hidden" name="old_payment_amount" id="old_payment_amount">
              <div class="col-sm-12">
                  <div class="form-group">
                    <label for="edit_payment_amount" ><?php echo xlt('Payment Amount'); ?>:
                    <input name="edit_payment_amount" class="form-control edit_payment_amount" style='border-color: black' id="edit_payment_amount"></label>
                  </div>
              </div>
              <div class="row" style="margin-left: 1px !important">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="edit_adj_amount" ><?php echo xlt('Adjustment Amount'); ?>:
                        <input name="edit_adj_amount" class="form-control edit_adj_amount" style='border-color: black' id="edit_adj_amount"></label>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="edit_adj_reason" ><?php echo xlt('Adjustment Reason'); ?>:
                        <?php echo adjReasonList('edit_adj_reason'); ?></label>
                      </div>
                  </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="color:black !important">Cancel</button>
            <button type="button" class="btn btn-primary" style="color:black !important" onclick="updatePayment()">Update Payment</button>
          </div>
    </div>
  </div>
</div> -->

    <script type="text/javascript">
        var encounter_overview_data = null
        let MAIN_TABLE_HEADER_DATA = null

        let PAYMENT_SECTION_DATA = null

        const ServiceModalTriggeringLocation = {
            MAIN_TABLE:0,
            PAYMENT_MODAL:1
        }

        const ServiceModalPaymentType = {
            PRIMARY_PAID:0,
            SECONDARY_PAID:1,
            TERTIARY_PAID:2,
            NONE:3
        }

        const ServiceModalPaymentTypeText = {
            0:"primary_paid",
            1:"secondary_paid",
            2:"tertiary_paid"
        }

        var GLOBAL_PID = "";

        // assigned in service_modal.js, used for reversing patient payment
        var SERVICE_MODAL_PATIENT_PAYMENT_CHECKBOX_CLICKED_ROW = null;

        // assigned when service modal is opened, it stores the data which can be posted
        // to save payments,php
        const SERVICE_MODAL_OBJECT = {
            // payment object is supplied when service modal is opened from the payment
            // modal
            paymentObject:null,
            // table object is created when the user presses the save button
            // on the service modal
            tableObject:null,
            // the payment type indicates whethter the primary, secondary, tertiary
            paymentType:null
        }

        // arguments preserved for recreating the service modal in case if it is closed
        var SHOW_SERVICE_MODAL_ARGS = {
            ROW_NUMBER: null,
            PAYMENT_TYPE: null,
            TRIGGERING_LOCATION:null
        }

        // dispatch the event when you add charge, payment, or claim, the observers will be
        // notified
        const DATA_CREATION_EVENT = new Event("DATA_CREATED")
        const SERVICE_MODAL_OPENED_EVENT = new Event("SERVICE_MODAL_OPENED")

        window.addEventListener("DATA_CREATED", function () {


            // when some data is added, it is essential to refresh main table
            const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()
            showDetails(headerDataStorage.tableHeaderRowPid)
            updateAuditTrial(headerDataStorage.tableHeaderRowPid, headerDataStorage.tableHeaderRowEncounter)

        })

        // helper for the payment section, observes data and gives when needed
        const nformPaymentHelperService = new NFormHelperService("payment_section_input_observer")
        const NFORM_PAYMENT_HELPER = new NFormHelper(nformPaymentHelperService, [])

        // helper for claim section
        const nformClaimHelperService = new NFormHelperService("claim_section_input_observer")
        const NFORM_CLAIM_HELPER = new NFormHelper(nformClaimHelperService, [])

        // when some data creation occurs audit trial section update itself
        function updateAuditTrial(audit_pid, audit_encounter) {

            $.post('transaction_details.php', {audit_pid: audit_pid, audit_encounter:audit_encounter}, function(data, textStatus, xhr) {
                $('#audit_trail').html("")
                $('#audit_trail').html(data)
            });
        }


        $(document).ready(function() {

            $(document).on('change', '.billing_date_editable, .ar_activity_date_editable', function() {
                const changed_date = $(this).val()
                const data = $(this).data()

                // find charge row date or ar_activity_row date
                if ($(this).hasClass('ar_activity_date_editable')) {
                    data["type"] = "ar_activity_row"
                }
                else {
                    data["type"] = "billing_table_row"
                }

                data["changed_date"] = changed_date
                $.post('transaction_screen/ajax/ajax_date_edit.php',
                    data, function (response) {
                        // show a success dialog
                })

            })


            // Expand or collapse all rows
            $('.expandCollapse').click(function() {
                var button_id = $('.collpaseButton').attr('id');
                if (button_id === 'expand') {
                    $('.collpaseButton').attr('id', 'collapse');
                    $('.clickable').attr('aria-expanded', 'true').html('-');
                    $('.table-detail-data').addClass('show');
                } else if (button_id === 'collapse') {
                    $('.collpaseButton').attr('id', 'expand');
                    $('.clickable').addClass('collapsed').attr('aria-expanded', 'false').html('+');
                    $('.table-detail-data').removeClass('show');
                } else {
                    $('.table-detail-data').toggle();
                }
            });



            // Select only one radio from a set at a time
            $(".radio").click(function(){
                $(".radio").prop( "checked", false );
                $(this).prop( "checked", true );
            });


        });

        // close the result of the search when the user clicks anywhere on the screen
        $(document).mouseup(function(e) {
            var container = $("#dropdown");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

        // change payment method in payment tab accordingly
        function changePaymentList(list_type) {
            var html = '';
            $('#payment_method').remove();

            // Check the payment tab radios. If payment type is primary or secondary, then payment method is "Check", otherwise use payment_method list
            if (list_type == 'primary' || list_type == 'secondary' || list_type == 'tertiary') {
                if (list_type == 'primary') {
                    $('#payment_secondary, #payment_tertiary, #payment_patient').prop('checked', false);
                }
                if (list_type == 'secondary') {
                    $('#payment_primary, #payment_tertiary, #payment_patient').prop('checked', false);
                }
                if (list_type == 'tertiary') {
                    $('#payment_primary, #payment_secondary, #payment_patient').prop('checked', false);
                }
                html = `<?php echo $insurance_payment_method_list; ?>`;
                console.log("INSURANCE");
            } else if (list_type == 'patient') {
                $('#payment_primary, #payment_secondary, #payment_tertiary').prop('checked', false);
                html = `<?php echo $payment_method_list; ?>`;
                console.log("patient");
            } else {
                html = `<?php echo $insurance_payment_method_list; ?>`;
                console.log("NONE");
            }
            $('#prepend_payment_method').prepend(html);
        }
        function copyObjectProperties(sender, receiver) {
            for (var property in sender) {
                receiver[property.toLowerCase()] = sender[property]
            }
            return receiver
        }
        function getOverviewObject(pid, casenumber="", encounter=null) {
            var queryParams = pid;
             if(casenumber != "") {
                    queryParams += "&case_number=" + casenumber;
             }
             if (encounter != null) {
                queryParams += "&encounter="+encounter;
             }

            //
             $.ajax({
                dataType: 'json',
                url: 'transaction_screen/ajax/ajax_patient_data.php?action=get_overview_object&pid=' + queryParams,
                type: 'GET',
                success: function(data) {
                    transaction_bus.$emit("overview-object-changed", data)

                },
                error: function(message) {
                    console.log("ERROR : " + message);
                }
            });
        }


        function getSummaryObject(pid, encounter) {
             $.ajax({
                dataType: 'json',

                url: 'transaction_screen/ajax/ajax_patient_data.php?action=get_summary_section&pid='
                + pid + "&encounter=" + encounter,

                type: 'GET',
                success: function(data) {
                    let primaryInsurance = data[0];
                    let secondaryInsurance = data[1];
                    let tertiaryInsurance = data[2];
                    let patientPayment = data[3];

                    // PRIMARY INSURANCE OBJECT
                    $('#Primary_Insurance_Date_Paid').html(primaryInsurance.Date_Paid);
                    $('#Primary_Insurance_Amount_Paid').html(primaryInsurance.Amount_Paid);
                    $('#Primary_Insurance_Payment').html(primaryInsurance.Payment);
                    $('#Primary_Insurance_Date_Closed').html(primaryInsurance.Date_Closed);

                    // SECONDARY INSURANCE OBJECT
                    $('#Secondary_Insurance_Date_Paid').html(secondaryInsurance.Date_Paid);
                    $('#Secondary_Insurance_Amount_Paid').html(secondaryInsurance.Amount_Paid);
                    $('#Secondary_Insurance_Payment').html(secondaryInsurance.Payment);
                    $('#Secondary_Insurance_Date_Closed').html(secondaryInsurance.Date_Closed);

                    // TERTIARY INSURANCE OBJECT
                    $('#Tertiary_Insurance_Date_Paid').html(tertiaryInsurance.Date_Paid);
                    $('#Tertiary_Insurance_Amount_Paid').html(tertiaryInsurance.Amount_Paid);
                    $('#Tertiary_Insurance_Payment').html(tertiaryInsurance.Payment);
                    $('#Tertiary_Insurance_Date_Closed').html(tertiaryInsurance.Date_Closed);

                    //PATIENT_PAYMENT_INSURANCE_OBJECT
                    $('#Patient_Payment_Date_Paid').html(patientPayment.Date_Paid);
                    $('#Patient_Payment_Amount_Paid').html(patientPayment.Amount_Paid);
                    $('#Patient_Payment_Payment').html(patientPayment.Payment);
                    $('#Patient_Payment_Date_Closed').html(patientPayment.Date_Closed);
                },
                error: function(message) {
                    console.log("ERROR : " + message);
                }
            });
        }

        // when refreshing the screen because a new row gets added it is necessary to
        // refresh the table and maintain persistence.
        function triggerClickOnTheRowWhichWasSelectedBefore() {
            if (MAIN_TABLE_HEADER_DATA != null && typeof MAIN_TABLE_HEADER_DATA !== 'undefined') {
            let dataStorage = MAIN_TABLE_HEADER_DATA.getData()
            let rowNumber = dataStorage.clickedHeaderRowNumber
                if(rowNumber != null) {

                   $('#header-row-identifier-'+rowNumber).find('td.clickable').trigger('click')
                }
            }
        }

        // This function shows the details of the particular patient clicked on after search
        function showDetails(pid, case_number, case_description="", removeHeaderDataCache=false, encounter="") {

            // removeheaderDataCache - checks if you need to override persistence of header data
            const post_object = {
                    pid: pid,
                    case_number: case_number
            }

            if (encounter != "") {
                console.log("encounter is " + encounter)
                post_object["filter_encounter"] = encounter
            }

            $.ajax({
                dataType: 'json',
                url: 'transaction_details.php',
                type: 'POST',
                data: post_object,
                success: function(data) {
                    $('#details-body').html('');
                    $('#details-body').append(data.result.renderHtml);
                    $('#in_collection').html(data.result.billing_note);
                    window.ins_level = data.result.ins_level;
                    $("#dropdown").hide();
                    $('.detail_row').css('display', 'none');

                    // Show cases depending on selected case from search dropdown
                    if(case_number == '0' || case_number === 0) {
                        $('.' + case_number).css('display', '');
                    } else if (!case_number || case_number == ' ') {
                        $('.detail_row').css('display', '');
                        // Clear select case dropdown list
                        // Update the select case dropdown list
                        var options = '';


                        $('.detail_row').each(function() {
                            var desc = $(this).children('.description').text();
                            var case_number = $(this).find('td.table-header-row-data').data('tableHeaderRowCaseNumber');
                            var case_body_part = desc.substr(desc.indexOf('/')+1);
                            var case_description = case_body_part + ' (' + case_number + ')';


                            options = options + `<span class="dropdown-item" onclick="showDetails(${pid}, ${case_number}, '', true)">${case_description}</span>`;
                        });
                        options = options + `<span class="dropdown-item" onclick="showDetails(${pid})">All Cases</span>`;

                    } else {
                        $('.' + case_number).css('display', '');

                    }

                    GLOBAL_PID = pid;
                    transaction_bus.$emit('global-pid-changed', pid)


                    setMyPatient(pid);
                    getOverviewObject(pid, case_number);

                    //if cache is removed, then previously selected rows
                    //datas are removed eventually
                    if (removeHeaderDataCache) {
                        MAIN_TABLE_HEADER_DATA = null
                    }
                    triggerClickOnTheRowWhichWasSelectedBefore();

                    // need to add additional checks and color displays for if balance is less than 0 and if payer_type greater than 1 and less than or equal 3
                    $('.balance-total').each(function() {
                        const real_balance = $(this).data('realBalance')
                        if (real_balance == 0 || real_balance < 0) {
                            // set the row as closed
                            $(this).parent().css('background-color', '#53e7fa4d');
                        } else {
                            // set the row as open
                            $(this).parent().css('background-color', '#ffea004d');
                        }
                    });

                },
                error: function(message) {
                    console.log("ERROR : " + message);
                }

            });
        }

        // just get the current date
        function getCurrentDate() {
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var output = d.getFullYear() + '-' +
                ((''+month).length<2 ? '0' : '') + month + '-' +
                ((''+day).length<2 ? '0' : '') + day;
            return output;
        }



        function showAdjustmentReasonModal(event, adjustment_reason) {
            event.stopPropagation();
            console.log(adjustment_reason);
        }



        function reversePaymentOnCheckboxClick(encounter,pid,sequence_no) {


          $("#reverse-patient-payment-modal").iziModal({
                     title: '<i class="fa fa-refresh"></i> <?php echo xlt("Reverse Patient Payment"); ?>',
                     subtitle: '<?php echo xlt("Reverse Patient payment by selecting adjustment reason"); ?>',
                     closeOnEscape: true,
                     fullscreen:true,
                     overlayClose: false,
                     closeButton: true,
                     theme: 'dark',  // light
                     iframe: true,
                     width:900,
                     focusInput: true,
                     padding:5,
                     iframeHeight: 200,
                     iframeURL: "<?php echo $GLOBALS['webroot']; ?>/interface/billing/transaction_screen/screens/reverse_patient_payment.php?pid=" + pid + "&encounter=" + encounter + "&sequence_no=" + sequence_no
          });


          $('#reverse-patient-payment-modal').iziModal('open')

        }

        $(document).on('show.bs.modal', '.modal', function () {
          if ($('.modal:visible').length) {
             $('body').addClass('modal-open');
           }
         });





        // this function shows the service details modal, enabling update of the $encounters
        class RowHeaderData {
            constructor(pid, encounter, paymentMethod, paymentAmount, acctRef, caseNumber, ServiceModalTriggeringLocation) {
                this.pid = pid;
                this.encounter = encounter;
                this.paymentMethod = paymentMethod;
                this.paymentAmount = paymentAmount;
                this.acctRef = acctRef;
                this.caseNumber = caseNumber;
                this.ServiceModalTriggeringLocation = ServiceModalTriggeringLocation

                    }
                }



        function showServiceDetails(
            rowNumber,
            paymentType=null,
            serviceModalTriggeringLocation=ServiceModalTriggeringLocation.MAIN_TABLE) {

            SHOW_SERVICE_MODAL_ARGS.ROW_NUMBER = rowNumber
            SHOW_SERVICE_MODAL_ARGS.PAYMENT_TYPE = paymentType
            SHOW_SERVICE_MODAL_ARGS.TRIGGERING_LOCATION = serviceModalTriggeringLocation

            // if this dialog is triggered from main table then disable primary, secondary, tertiary fields

            // once the charge, or any row is clicked from the row number we find all the data in it and construct it in to a object model

            // header storage holds all the clicked header row data
            const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()
            caseNumber = headerDataStorage.tableHeaderRowCaseNumber
            pid = headerDataStorage.tableHeaderRowPid
            encounter = headerDataStorage.tableHeaderRowEncounter

            // payment object holds the ui data of payment section
            const paymentObject = createPaymentObject()

            // assign the payment object to service modal object
            // this is to be used when saving the service modal
            SERVICE_MODAL_OBJECT.paymentObject = paymentObject
            SERVICE_MODAL_OBJECT.paymentType = paymentType

            // these parameters are used to display the data in ui
            paymentMethod = paymentObject.method
            paymentAmount = paymentObject.amount
            acctRef = paymentObject.acct_ref


            let rowHeaderData = new RowHeaderData(pid, encounter, paymentMethod, paymentAmount, acctRef, caseNumber,
                serviceModalTriggeringLocation);

            if (paymentType != null) {
                rowHeaderData.ServiceModalPaymentType = paymentType
            }
            else {
                rowHeaderData.ServiceModalPaymentType = ServiceModalPaymentType.NONE
            }


            rowHeaderData.modalHeaderData = $('#table-header-row-data-'+rowNumber).data();

            // Get all drop down child rows
            let rowElements = []
            $('.td-data-storage-row-'+rowNumber).each(function() {
                 const data = $(this).data()
                 if (data['adjust'] == "") {
                    data['adjust'] = 0
                 }
                 data['adjust'] = Number(parseFloat(data['adjust'])).toFixed(2)
                 rowElements.push(data);
            });

            // row elements is the number of elements present under the header row
            rowHeaderData.rowElements = rowElements;

            $.post('transaction_screen/screens/service_modal.php', {rowData: rowHeaderData}, function(data, textStatus, xhr) {
                 $("#service_modal .modal-body").html("");
                 $("#service_modal .modal-body").html(data);

                 $('#service_modal').modal('show');
                 window.dispatchEvent(SERVICE_MODAL_OPENED_EVENT)

            });
        }



        // This function deletes selected line items in service modal
        function deleteEncounter() {
            var billing_ids = [];
            var del_encounter = [];
            $('.enc_checkbox').each(function() {
                if ($(this).prop("checked")) {
                    billing_ids.push($(this).parent().parent().attr("id"));
                    //del_encounter.push($(this).parent().find('#service_encounter').val());
                    del_encounter = $(this).parent().parent().find('#service_encounter').val();
                }
            });
            if (billing_ids.length === 0) {
                showAlert("No line item was selected for deletion.", 'warning');
                return;
            }
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: 'save_payments.php',
                data: { billing_ids: billing_ids,
                        del_encounter: del_encounter
                 }
            })
            .done(function(data) {
                console.log(data);
                var message = data.result.message;
                var auditHtml = data.result.audit_html;
                billing_ids.forEach(function(id) {
                    $("#table-data").find("tr#"+id).remove(); // remove the tr from service modal table
                    $(".billing_id").each(function() {  // remove the line items from details section
                        if ($(this).text() === id) {
                            console.log("THIS>TEXT: " + $(this).text());
                            $(this).parent().remove();
                        }
                    });
                });
                //alert(message);
                showAlert(message, 'success');
                $('#audit_trail').prepend(auditHtml);
            })
            .fail(function(msg) {
                showAlert("Error deleting line items", 'danger');
                console.log("Error deleting line items: " + msg);
            });
            //console.log("Billing ids: " + billing_ids);
        }

        // This function unselects selected line items
        function unSelectEncounters() {
            $('.table-data').find('.enc_checkbox').each(function() {
                $(this).prop('checked', false);
            });
            console.log("cancelled selected line items");
        }




        // Show edit patient payment modal
        function showPaymentModal(n, pid, encounter, sequence_no, payment_amount, billing_id, adjustment_amount=0, adjustment_reason='') {
            $('#edit_n').val(n);
            $('#edit_pid').val(pid);
            $('#edit_encounter').val(encounter);
            $('#edit_billing_id').val(billing_id);
            $('#edit_sequence_no').val(sequence_no);
            $('#old_payment_amount').val(payment_amount.toFixed(2));
            $('#edit_payment_amount').val(payment_amount.toFixed(2));
            $('#edit_adj_amount').val(adjustment_amount.toFixed(2));
            $('#edit_adj_reason').val(adjustment_reason);
            //console.log("ADJ AMT: " + adjustment_amount + " ADJ REASON: " + adjustment_reason);


            $('#edit-payment-modal').modal('show');
        }

        // Update a patient payment record
        function updatePayment() {
            var form = $('#edit_payment_form');
            var payment_amount = $('#edit_payment_form').find('#edit_payment_amount').val();
            var adjustment_amount = $('#edit_payment_form').find('#edit_adj_amount').val();
            var adjustment_reason = $('#edit_payment_form').find('#edit_adj_reason').val();
            var edit_n = $('#edit_payment_form').find('#edit_n').val();
            $.ajax({
                dataType: 'json',
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize()
            })
            .done(function(data) {
                var sequence_no = data.result.sequence_no;
                if (data.result.failure) {
                    showAlert(data.result.failure, 'warning');
                }
                var auditHtml = data.result.audit_html;

                showAlert("Patient payment updated", "success");
                $('#sequence_no_'+sequence_no).attr(edit_n, )
                var old_pat_paid = $('#sequence_no_'+sequence_no).children('.amount').text();
                old_pat_paid = old_pat_paid.substr(1);

                var old_adj_amount = $('#sequence_no_'+sequence_no).children('.adjusted').text();
                old_adj_amount = old_adj_amount.substr(1);

                var old_total_pat_paid = $('.first_'+edit_n).find('#patient-paid-total-'+edit_n).text();
                old_total_pat_paid = old_total_pat_paid.substr(1);
                old_total_pat_paid = parseFloat(old_total_pat_paid) - parseFloat(old_pat_paid);

                var old_total_adj = $('.first_'+edit_n).find('#adj-total-'+edit_n).text();
                old_total_adj = old_total_adj.substr(1);
                old_total_adj = parseFloat(old_total_adj) - parseFloat(old_adj_amount);

                var old_balance = $('.first_'+edit_n).find('#total-balance-'+edit_n).text();
                old_balance = old_balance.substr(1);
                old_balance = parseFloat(old_balance) + parseFloat(old_pat_paid);

                old_balance = parseFloat(old_balance) - parseFloat(old_adj_amount);

                var new_total_pat_paid = parseFloat(old_total_pat_paid) + parseFloat(payment_amount);
                var new_total_adj = parseFloat(old_total_adj) + parseFloat(adjustment_amount);
                var new_balance = parseFloat(old_balance) - parseFloat(payment_amount);
                new_balance = new_balance - parseFloat(adjustment_amount);

                $('.first_'+edit_n).find('#patient-paid-total-'+edit_n).html('$'+new_total_pat_paid.toFixed(2));
                $('.first_'+edit_n).find('#adj-total-'+edit_n).html('$'+new_total_adj.toFixed(2));
                $('.first_'+edit_n).find('#total-balance-'+edit_n).html('$'+new_balance.toFixed(2));

                $('#sequence_no_'+sequence_no).children('.amount').html('$'+payment_amount);
                $('#sequence_no_'+sequence_no).children('.amount').attr('data-payment-paid',payment_amount);

                $('#sequence_no_'+sequence_no).children('.adjusted').html('$'+adjustment_amount);
                $('#sequence_no_'+sequence_no).children('.adjusted').attr('data-amount',adjustment_amount);

                $('#sequence_no_'+sequence_no).children('.adj-reason').html(adjustment_reason);

                $('#audit_trail').prepend(auditHtml);
                $('#edit-payment-modal').modal('hide');
                $('#edit_payment_form')[0].reset();

            })
            .fail(function(error) {
                console.log(error);
                showAlert("An error occured while updating the payment", 'warning');
            });
        }



     function setEncountersOnAjax(pid) {

            var EncounterDateArray = new Array;
            var CalendarCategoryArray = new Array;
            var EncounterIdArray = new Array;
            var Count = 0;
            $.ajax({
              type: 'GET',
              url: 'transaction_screen/ajax/ajax_patient_data.php?action=get_encounters&pid=' + pid,

              success: function(data){
                 data = JSON.parse(data);

                 for (item of data) {

                    EncounterIdArray[Count] = item.encounter;
                    EncounterDateArray[Count] = item.date;
                    CalendarCategoryArray[Count] = item.pc_catname;
                    //console.log(Count);
                    Count+=1;

                 }

                 parent.left_nav.setPatientEncounter(EncounterIdArray,EncounterDateArray,CalendarCategoryArray);

                    parent.left_nav.setRadio(window.name, 'dem');
                    parent.left_nav.syncRadios();

              },
          });

     }

      // JavaScript stuff to do when a new patient is set.
      //
      function setMyPatient(pid) {

        $.ajax({
              type: "GET",
              url: "transaction_screen/ajax/ajax_patient_data.php?pid=" + pid,

              success: function(data){
                var userData = JSON.parse(data);
                parent.left_nav.setPatient(userData.pname, pid, pid, "", userData.str_dob);
                setEncountersOnAjax(pid);
              },
          });
      }

        function calcTotalBalance(encCount){
            // Initialize all varaibles
            var totalAmount = 0.00;
            var patientPaidAmount = 0.00;
            var insPaidAmount = 0.00;
            var appliedPatientPaid = 0.00;

            var adjAmount = 0.00;
            var totalBalance = 0.00;
            var primaryInsPaid = 0.00
            var secondaryInsPaid = 0.00
            var tertiaryInsPaid = 0.00
            var balance_without_unapplied_patient_payment = 0.00

            var primaryInsuranceTotal = 0.00
            var secondaryInsuranceTotal = 0.00
            var tertiaryInsuranceTotal = 0.00

            // calculate total amount of charges per line item
            $('.amount-detail-' + encCount).each(function(){
                totalAmount += parseFloat($(this).data("amount"));
            })
            $('#amount-total-' + encCount).data("", totalAmount.toFixed(2));
            $('#amount-total-' + encCount).text(`\$${totalAmount.toFixed(2)}`);
            // calculate total of insurance paid
            $('.ins-paid-detail-' + encCount).each(function(){
                insPaidAmount += parseFloat($(this).data("ins-paid"));
            });



            // get all primary paid values of a single clicked table header row

            $('.primary-insurance-payment-paid-detail-' + encCount).each(function() {
                let primInsValue = parseFloat($(this).data('payment-paid'))
                 if (!isNaN(primInsValue)) {
                    primaryInsPaid += primInsValue
                }
            });


            // get all secondary insurance payment

            $('.secondary-insurance-payment-paid-detail-' + encCount).each(function() {
                let secondaryInsValue = parseFloat($(this).data('payment-paid'))
                 if (!isNaN(secondaryInsValue)) {
                    secondaryInsPaid += secondaryInsValue
                }
            });


            // get all tertiary insurance payment

            $('.tertiary-insurance-payment-paid-detail-' + encCount).each(function() {
                let tertiaryInsValue = parseFloat($(this).data('payment-paid'))
                 if (!isNaN(tertiaryInsValue)) {
                    tertiaryInsPaid += tertiaryInsValue
                }
            });



            // calculate total of patient paid
            $('.pat-paid-detail-' + encCount).each(function(){
                patientPaidAmount += parseFloat($(this).data("patient-paid"));
                appliedPatientPaid += parseFloat($(this).data("patientPaymentApplied"));

            });

                // calculate total of adjustment paid
            $('.adj-amount-detail-' + encCount).each(function(){
                adjAmount += parseFloat($(this).data("amount"));
            });

            // calculate the sum of the line item amounts
            $('.balance-detail-' + encCount).each(function(){

                let balance = $(this).data("balance")

                if (balance != "") {
                    totalBalance += parseFloat(balance.toString().replace(",",""));
                }

            });

            var total_balance_without_unapplied_patient_paid = totalAmount - insPaidAmount - adjAmount - appliedPatientPaid

            // //subtract insurance from total balance
            // totalBalance = totalBalance - insPaidAmount;
            // // subtrace patient payments from total balance
            // totalBalance = totalBalance - patientPaidAmount;
            // //subtract adjustments from total balance
            // totalBalance = totalBalance - adjAmount;

            // update the html elements including the data attributes
            $('#patient-paid-total-' + encCount).data("", patientPaidAmount.toFixed(2));
            $('#patient-paid-total-' + encCount).text(`\$${patientPaidAmount.toFixed(2)}`);

            $('#adj-total-' + encCount).data("", adjAmount.toFixed(2));
            $('#adj-total-' + encCount).text(`\$${adjAmount.toFixed(2)}`);

            $('#insurance-total-' + encCount).data("", insPaidAmount.toFixed(2));
            $('#insurance-total-' + encCount).text(`\$${insPaidAmount.toFixed(2)}`);

            $('#total-balance-' + encCount).data("", totalBalance.toFixed(2));
            $('#total-balance-' + encCount).text(`\$${totalBalance.toFixed(2)}`);
            $('#total-balance-' + encCount).data('realBalance', total_balance_without_unapplied_patient_paid.toFixed(2))

            // after updating the fields store it in a common data storage row
            $('#table-header-row-data-' + encCount).data("table-header-row-balance", totalBalance.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-charges", totalAmount.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-patient-paid-amount", patientPaidAmount.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-insurance-paid-amount", insPaidAmount.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-adjustment-amount", adjAmount.toFixed(2));

            $('#table-header-row-data-' + encCount).data("table-header-row-primary-insurance-paid", primaryInsPaid.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-secondary-insurance-paid", secondaryInsPaid.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-tertiary-insurance-paid", tertiaryInsPaid.toFixed(2));

            $('#table-header-row-data-' + encCount).data("table-header-row-real-balance", total_balance_without_unapplied_patient_paid.toFixed(2));

            let secInsAndTertiaryInsSum = secondaryInsPaid + tertiaryInsPaid
            $('#table-header-row-data-' + encCount).data("table-header-row-secondary-and-tertiary-insurance-paid", secInsAndTertiaryInsSum.toFixed(2));

            // primary, secondary, tertiary insurance balance
            let primaryInsuranceBalance = totalAmount - primaryInsPaid
            let secondaryAndTertiaryInsuranceBalance = totalAmount - primaryInsPaid - secondaryInsPaid
            $('#table-header-row-data-' + encCount).data("table-header-row-primary-insurance-balance", primaryInsuranceBalance.toFixed(2));
            $('#table-header-row-data-' + encCount).data("table-header-row-tertiary-and-secondary-insurance-balance", secondaryAndTertiaryInsuranceBalance.toFixed(2));
            return true;
        }

        function calcTotalUnits(encCount){
            var totalUnits = 0;
            $('.units-detail-' + encCount).each(function(){
                totalUnits += $(this).data("units");
            });
            $('#units-total-' + encCount).data("total-units", totalUnits);
            $('#units-total-' + encCount).text(`${totalUnits}`);
            //console.log(`Total units: ${totalUnits}`);
            return true;
        }


        // Show an alert
        function showAlert(message, type) {
            var alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
              <strong>${message}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>`;
            $('#alert_col').html(alertHtml);
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        }

        function showDangerAlert(message) {
            iziToast.error({
                title: 'Error',
                message: message,
            });
        }


        function showSuccessAlert(message) {
            iziToast.success({
                title: 'Success',
                message: message,
            });
        }


    // initialise the service modal


    </script>

<script type="text/javascript" src="transaction_screen/js/service_modal.js"></script>
<script type="text/javascript" src="transaction_screen/js/charge_section.js"></script>
<script type="text/javascript" src="transaction_screen/js/transaction.js"></script>
<script type="text/javascript" src="transaction_screen/js/payment_section.js"></script>
<script type="text/javascript" src="transaction_screen/js/claim_section.js"></script>
<!-- load the vue js component template -->
<?php require 'transaction_screen/html/transaction_note_component.html' ?>
<script type="text/javascript" src="transaction_screen/js/transaction_note_component.js"></script>

<div id="transaction_note_holder">
    <transaction-note-component></transaction-note-component>
</div>

<script type="text/javascript">
    Vue.filter('formatToCurrency', function (value) {

        if (value == null || value == undefined || isNaN(value)) {
            // if a field doesnt have a value for currency
            // then instead of empty show 0.00
            return "$" + new Number(0).toFixed(2)
        }
        else if (typeof value !== "number") {
            if (typeof value === "string") {
                return "$" + Number(parseFloat(value)).toFixed(2)
            }
            return value;
        }
        else {
            return "$" + new Number(value).toFixed(2)
        }

    });

    Vue.filter('twoDigitFormat', function(value) {

        if (value == undefined || value == null || isNaN(value)) {
            return Number(0).toFixed(2)
        }
        else {
            return Number(parseInt(value)).toFixed(2)
        }

    });


    new Vue({

        created() {
            transaction_bus.$on('case_dropdown_data_changed', (data)=> {
                Vue.set(this, "drop_down_data", data)
            })
        },
        el: "#select_case",
        data: {
            drop_down_data: {
                type:Array,
                default:[]
            },

            selected_case_number: "",
        },

        watch: {
            selected_case_number: function(newValue, oldValue) {
                const encounter = newValue;
                const pid = this.drop_down_data[0].pid
                console.log(encounter)
                showDetails(pid, "", "", false, encounter);
            }
        }
    })

    new Vue({
        el: "#transaction_note_holder",
    })

    const PaidType = {
        primary_paid: 1,
        secondary_paid: 2
    }

    function checkIfAllEncountersArePaid(paid_type) {
        var is_all_encounters_paid_for_paid_type = false


        $('.table-header-row-data').each(function(index, object) {
            const row_data = $(object).data()
            if (paid_type == PaidType.primary_paid && parseInt(row_data.tableHeaderRowPrimaryInsurancePaid) > 0) {
                is_all_encounters_paid_for_paid_type = true
            }
            else if (paid_type == PaidType.secondary_paid && parseInt(row_data.tableHeaderRowSecondaryInsurancePaid) > 0) {
                is_all_encounters_paid_for_paid_type = true
            }
            else {
                is_all_encounters_paid_for_paid_type = false
                return false
            }

        })


        return is_all_encounters_paid_for_paid_type
    }



    new Vue({

        created() {
            // on created keep listening for the change
            // to the overview section data
            transaction_bus.$on("overview-object-changed", (overview_object)=> {
                overview_object = this.processOverviewObject(overview_object)
                this.overview_section_data = overview_object
            })
            transaction_bus.$on("overview-object-fetch-from-api", (pid, encounter)=> {

                if (encounter != null) {
                     transaction_bus.$emit("overview-object-changed", encounter_overview_data[encounter])
                }
                else {
                    getOverviewObject(pid, "", encounter)
                }
            })

        },

        el: "#overview_section",
        data: {
            overview_section_data: {
                type: Object,
                default:null
            }
        },

        methods: {

            getParsedValuesForOverviewObject(overview_object) {

                return  {
                    charges: parseFloat(overview_object.charges) || 0,
                    primary_paid: parseFloat(overview_object.primary_paid) || 0,
                    secondary_paid: parseFloat(overview_object.secondary_paid) || 0,
                    adjustments: parseFloat(overview_object.adjustments) || 0,
                    primary_adjustments: parseFloat(overview_object.primary_adjustments) || 0,
                    secondary_adjustments: parseFloat(overview_object.secondary_adjustments) || 0 ,
                    patient_paid: parseFloat(overview_object.patient_paid) || 0
                }

            },

            processSingleEncounterOverviewObject(overview_object) {
                // since it is a single encounter, we need to calculate
                // the balance based on the primary, secondary, patient values
                const parsed_values = this.getParsedValuesForOverviewObject(overview_object)
                if (parsed_values.primary_paid == 0) {
                    // goes to primary balance
                     overview_object.primary_balance = parsed_values.charges - parsed_values.primary_paid - parsed_values.primary_adjustments
                }
                else if (parsed_values.primary_paid != 0 && parsed_values.secondary_paid == 0) {
                        overview_object.secondary_balance = parsed_values.charges - parsed_values.primary_paid - parsed_values.primary_adjustments - parsed_values.secondary_paid - parsed_values.secondary_adjustments
                }
                else if (parsed_values.primary_paid != 0 && parsed_values.secondary_paid != 0) {

                        overview_object.patient_balance = parsed_values.charges - parsed_values.primary_paid - parsed_values.primary_adjustments - parsed_values.secondary_paid - parsed_values.secondary_adjustments - parsed_values.patient_paid

                }
                return overview_object
            },

            processMultipleEncounterOverviewObject(overview_object) {
                const isPrimaryPaidPresentForAllEncounters = checkIfAllEncountersArePaid(PaidType.primary_paid)
                const isSecondaryPaidPresentForAllEncounters = checkIfAllEncountersArePaid(PaidType.secondary_paid)
                const parsed_values = this.getParsedValuesForOverviewObject(overview_object)
                if (isPrimaryPaidPresentForAllEncounters) {

                    if (isSecondaryPaidPresentForAllEncounters) {

                        overview_object.patient_balance = parsed_values.charges - parsed_values.primary_paid - parsed_values.primary_adjustments - parsed_values.secondary_paid - parsed_values.secondary_adjustments - parsed_values.patient_paid

                    }
                    else {

                        overview_object.secondary_balance = parsed_values.charges - parsed_values.primary_paid - parsed_values.primary_adjustments - parsed_values.secondary_paid - parsed_values.secondary_adjustments
                    }

                }
                else {

                     overview_object.primary_balance = parsed_values.charges - parsed_values.primary_paid - parsed_values.primary_adjustments

                }

                return overview_object
            },

            processOverviewObject(overview_object) {
                // set all balance to zero, we may reassign
                // them inside the function, but inital values are
                // always zero
                overview_object.primary_balance = 0
                overview_object.secondary_balance = 0
                overview_object.patient_balance = 0

                // there are currently 2 states, is overview object for single
                // encounter, or for group of encounters

                if (overview_object.encounter != null) {
                    // single encounter
                    return this.processSingleEncounterOverviewObject(overview_object);
                }
                else {
                    // mutliple encounter
                    return this.processMultipleEncounterOverviewObject(overview_object)
                }

            },

            getBalanceWhenMutlipleEncountersPresent(balance_value, paid_type) {
                if (checkIfAllEncountersArePaid(paid_type)) {
                    // if all encounters are paid, then balance is 0
                    return 0
                }
                else {
                    return balance_value
                }
            },


        }
    })


    new Vue({
        el: "#search_component",
        data: {
            name:"",
            dob:"",
            encounter_date:"",
            patient_items:[],
        },
        watch: {
            },

        methods: {
            getPatientNames() {
                this.$http.post('search_transactions.php', {
                    name: this.name,
                    dob:this.dob,
                    encounter_date:this.encounter_date,

                }, {emulateJSON:true}).then(response=> {
                    const server_response = response.body
                    const filtered_items = []
                    for (item of server_response) {
                        if (filtered_items[item.pid] === undefined) {
                            filtered_items[item.pid] = {}
                            filtered_items[item.pid]["pid"] = item.pid
                            filtered_items[item.pid]["fname"] = item.fname
                            filtered_items[item.pid]["lname"] = item.fname
                            filtered_items[item.pid]["mname"] = item.fname
                            filtered_items[item.pid]["encounter_list"] = [item.encounter]
                            filtered_items[item.pid]["DOB"] = item.DOB
                            filtered_items[item.pid]["encounter_date_list"] = [item.date]
                        }
                        else {
                            filtered_items[item.pid]["encounter_list"].push(item.encounter)
                            filtered_items[item.pid]["encounter_date_list"].push(item.date)
                        }
                    }

                    Vue.set(this, "patient_items", Object.values(filtered_items))

                    if (this.patient_items.length > 0) {
                         $(".dropdown-toggle").dropdown("toggle");
                    }
                })
            },

            submitData() {
                this.getPatientNames()
            },

            selectPatient(pid, encounter_list) {

                const altered_encounter_list = []

                for (item of encounter_list) {
                    altered_encounter_list.push({
                        encounter: item,
                        pid: pid
                    })
                }

                transaction_bus.$emit('case_dropdown_data_changed', altered_encounter_list)

                this.name = ""
                this.dob = ""
                this.encounter_date = ""
                showDetails(pid)
            }
        }
    })

</script>

</body>
</html>
