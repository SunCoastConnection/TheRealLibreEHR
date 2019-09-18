<?php
/**
 * Edit Settings
 *
 * This program allows the editing of the system settings
 *
 * @copyright Copyright (C) 2019 Tigpezeghe Rodrige <tigrodrige@gmail.com>
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
 * @author Tigpezeghe Rodrige <tigrodrige@gmail.com>
 * @link http://LibreEHR.org
 *
 * Please help the overall project by sending changes you make to the author and to the Libre EHR community.
 *
 */

require_once ('../globals.php');
require_once $GLOBALS['srcdir'].'/headers.inc.php';
require_once("../../custom/code_types.inc.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/globals.inc.php");
require_once("$srcdir/user.inc");
require_once("$srcdir/classes/CouchDB.class.php");
require_once("$srcdir/calendar.inc");
require_once("$srcdir/role.php");
require_once("load_edit_settings.php");

if ($_GET['mode'] != "user") {
  // Check authorization.
  $thisauth = acl_check('admin', 'super');
  if (!$thisauth) die(xlt('Not authorized'));
}

?>
<html>
    <head>
        <title><?php echo xlt('Edit Settings'); ?></title>
        <!-- supporting javascript code -->
        <?php
           // Including Bootstrap and Fancybox.
          call_required_libraries(array("jquery-min-3-1-1","bootstrap","fancybox","font-awesome","iziModalToast"));
          resolveFancyboxCompatibility();
           include_js_library("jscolor-1-4-5/jscolor.js");
        ?>
        <link rel='stylesheet' href='<?php echo $css_header ?>' type='text/css'>
        <link href="<?php echo $GLOBALS['webroot'] ?>/interface/main/tabs/js/jsoneditor/jsoneditor.css" rel="stylesheet" type="text/css">
        <script src="<?php echo $GLOBALS['webroot'] ?>/interface/main/tabs/js/jsoneditor/jsoneditor.js"></script>
        <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/common.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery-ui.js"></script>

        <style>
            #jsoneditor {
                width: 500px;
                height: 500px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#edit_menu"><?php echo xlt('Edit Menu');?></a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#manage_roles"><?php echo xlt('Manage Roles'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../interface/usergroup/facilities.php"><?php echo xlt('Facilities'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/usergroup/usergroup_admin.php"><?php echo xlt('Users'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/usergroup/addrbook_list.php"><?php echo xlt('Addr Book'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../controller.php?practice_settings&pharmacy&action=list"><?php echo xlt('Practice'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/patient_file/encounter/superbill_custom_full.php"><?php echo xlt('Codes'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/super/edit_layout.php"><?php echo xlt('Layouts'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/usergroup/adminacl.php"><?php echo xlt('Lists'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/super/manage_site_files.php"><?php echo xlt('Files'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/main/backup.php"><?php echo xlt('Backup'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/super/rules/index.php?action=browse!list"><?php echo xlt('Rules'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/super/rules/index.php?action=alerts!listactmgr"><?php echo xlt('Alerts'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/patient_file/reminder/patient_reminders.php?mode=admin&patient_id="><?php echo xlt('Patient Reminders'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/language/language.php"><?php echo xlt('Language'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/forms_admin/forms_admin.php"><?php echo xlt('Forms'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../modules/calendar/admin.php"><?php echo xlt('Calendar Administration'); ?></a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/logview/logview.php"><?php echo xlt('Logs'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/reports/username_report.php"><?php echo xlt('Users Activity Report'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="##SQL_ADMIN##"><?php echo xlt('Database'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/logview/erx_logview.php"><?php echo xlt('eRx Logs'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/usergroup/ssl_certificates_admin.php"><?php echo xlt('Certificates'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../sql/sql_upgrade.php"><?php echo xlt('Upgrade Database'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/super/load_codes.php"><?php echo xlt('Native Data Loads'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/code_systems/dataloads_ajax.php"><?php echo xlt('External Data Loads'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../modules/merge_encounters/index.php"><?php echo xlt('Merge Encounters'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/patient_file/merge_patients.php"><?php echo xlt('Merge Patients'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../../interface/reports/audit_log_tamper_report.php"><?php echo xlt('Audit Log Tamper'); ?></a>
                </li>
            </ul>

            <div class="tab-content">
                <?php include "../../interface/main/tabs/edit_menu.php"; ?>

                <?php include "../../interface/main/tabs/edit_roles.php"; ?>

                <div id="menu2" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <h3>Menu 3</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
            </div>
        </div>
    </body>
</html>
