<?php
/*
 *  HCC_RAF Encounters report. (/interface/reports/raf_enc_report.php
 *  
 *
 *  This report shows past encounters with filtering and sorting, 
 *  Added filtering to show encounters not e-signed, encounters e-signed and forms e-signed.
 * 
 * Copyright (C) 2015-2017 Terry Hill <teryhill@yahoo.com> 
 * Copyright (C) 2007-2010 Rod Roark <rod@sunsetsystems.com>
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
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;. 
 * 
 * @package Libre EHR 
 * @author Terry Hill <teryhill@yahoo.com> 
 * @author Rod Roark <rod@sunsetsystems.com>
 * @link http://LibreEHR.org
 *
 */

require_once "reports_controllers/RAF_HCC_Controller.php";

?>
<html>
<head>
  <?php html_header_show();?>

  <title><?php echo xlt('Encounter/Provider RAF Report'); ?></title>

  <style type="text/css">
    /* specifically include & exclude from printing */
    @media print {
      #report_parameters {
        visibility: hidden;
        display: none;
      }
      #report_parameters_daterange {
        visibility: visible;
        display: inline;
      }
      #report_results table {
        margin-top: 0px;
      }
    }

    /* specifically exclude some from the screen */
    @media screen {
      #report_parameters_daterange {
        visibility: hidden;
        display: none;
      }
    }
  </style>

  <?php
    include_css_library("tablesorter-master/dist/css/theme.blue.min.css");
    include_css_library("jquery-datetimepicker/jquery.datetimepicker.css");
    include_js_library("jquery-min-3-1-1/index.js");
    include_js_library("jquery-datetimepicker/jquery.datetimepicker.full.min.js");
    include_js_library("tablesorter-master/dist/js/jquery.tablesorter.min.js");
    include_js_library("tablesorter-master/dist/js/jquery.tablesorter.widgets.min.js");
  ?>
  <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/report_helper.js"></script>

  <script LANGUAGE="JavaScript">

    $(document).ready(function() {
      oeFixedHeaderSetup(document.getElementById('mymaintable'));
      var win = top.printLogSetup ? top : opener.top;
      win.printLogSetup(document.getElementById('printbutton'));
    });

    $(document).ready(function() {
      $("#mymaintable").tablesorter();
    });

    function refreshme() {
      document.forms[0].submit();
    }

  </script>
</head>
<body class="body_top">
  <!-- Required for the popup date selectors -->
  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

  <span class='title' hidden="hidden">RAF Encounters</span>

  <?php reportParametersDaterange(); #TRK ?>

  <form method='post' name='theform' id='theform' action='raf_enc_report.php'>
    <div id="report_parameters">
      <table>
        <tr>
          <td width='550px'>
            <div style='float:left'>
              <table class='text'>
                <tr>
                  <td class='label'>
                    <?php echo xlt('Facility'); ?>:
                  </td>
                  <td>
                    <?php dropdown_facility($form_facility, 'form_facility', true); ?>
                  </td>
                  <td class='label'>
                    <?php echo xlt('Provider'); ?>:
                  </td>
                  <td>
                    <?php // Build a drop-down list of providers.
                      dropDownProviders();
                    ?>
                  </td>

 
                </tr>
                <tr>
                  <?php // Show From and To dates fields. (TRK)
                    showFromAndToDates(); ?>
                  <td>
                    <label><input type='checkbox' name='form_details'<?php  if ($form_details) echo ' checked'; ?>>
                      <?php echo xlt('Details'); ?></label>
                  </td>

                </tr>
              </table>
            </div>
          </td>
          <?php // Show print and export buttons. (TRK)
            showSubmitPrintButtons(); ?>
        </tr>
      </table>
    </div> <!-- end report_parameters -->

    <?php
    if ($_POST['form_refresh']) {
    ?>
    <div id="report_results">
      <table id='mymaintable' class="tablesorter">
        <thead>
          <?php if ($form_details) { ?>
            <th><?php echo xlt('Provider'); ?></th>
            <th><?php echo xlt('Date'); ?></th>
            <th><?php echo xlt('Patient'); ?></th>
            <th><?php echo xlt('PID'); ?></th>
            <th><?php echo xlt('RAF'); ?></th>
            <th><?php echo xlt('Age'); ?></th>
            <th><?php echo xlt('Gender'); ?></th>
            <th><?php echo xlt('Facility'); ?></th>
            <?php /*
            <th><?php echo xlt('Status'); ?></th>
            <th><?php echo xlt('Encounter'); ?></th>
            */?>
            <th><?php echo xlt('Encounter Number'); ?></th>
            <?php /*
            <th><?php echo xlt('Form'); ?></th>
            */?>
            <th><?php echo xlt('Coding'); ?></th>
          <?php } else { ?>
            <th><?php echo xlt('Provider'); ?></td>
            <th><?php echo xlt('Encounters'); ?></td>
          <?php } ?>
        </thead>
        <tbody>
          <?php // Show the results. (TRK)
            showResults();
          ?>
        </tbody>
      </table>
    </div>  <!-- end encresults -->
    <?php } else { ?>
    <div class='text'>
        <?php echo xlt('Please input search criteria above, and click Submit to view results.' ); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo xlt('Column headers can be clicked to change sort order') ?>
    </div>
    <?php } ?>

    <input type='hidden' name='form_refresh' id='form_refresh' value=''/>
  </form>
</body>

<script language='JavaScript'>

<?php if ($alertmsg) { echo " alert('$alertmsg');\n"; } ?>

</script>
<script>
    $(function() {
        $("#form_from_date").datetimepicker({
            timepicker: false,
            format: "<?= $DateFormat; ?>"
        });
        $("#form_to_date").datetimepicker({
            timepicker: false,
            format: "<?= $DateFormat; ?>"
        });
        $.datetimepicker.setLocale('<?= $DateLocale; ?>');
    });

</script>

</html>
