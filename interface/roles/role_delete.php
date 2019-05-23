<?php

/**
 *  Role Deleter
 *
 *  This program deletes a specified role and displays the relevant result
 *
 * Copyright (C) 2018 Anirudh Singh
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0 and the following
 * Healthcare Disclaimer
 *
 * In the United States, or any other jurisdictions where they may apply, the following additional disclaimer of
 * warranty and limitation of liability are hereby incorporated into the terms and conditions of MPL 2.0:
 *
 * No warranties of any kind whatsoever are made as to the results that You will obtain from relying upon the covered code
 *(or any information or content obtained by way of the covered code), including but not limited to compliance with privacy
 * laws or regulations or clinical care industry standards and protocols. Use of the covered code is not a substitute for a
 * health care provider’s standard practice or professional judgment. Any decision with regard to the appropriateness of treatment,
 * or the validity or reliability of information or content made available by the covered code, is the sole responsibility
 * of the health care provider. Consequently, it is incumbent upon each health care provider to verify all medical history
 * and treatment plans with each patient.
 *
 * Under no circumstances and under no legal theory, whether tort (including negligence), contract, or otherwise,
 * shall any Contributor, or anyone who distributes Covered Software as permitted by the license,
 * be liable to You for any indirect, special, incidental, consequential damages of any character including,
 * without limitation, damages for loss of goodwill, work stoppage, computer failure or malfunction,
 * or any and all other damages or losses, of any nature whatsoever (direct or otherwise)
 * on account of or associated with the use or inability to use the covered content (including, without limitation,
 * the use of information or content made available by the covered code, all documentation associated therewith,
 * and the failure of the covered code to comply with privacy laws and regulations or clinical care industry
 * standards and protocols), even if such party shall have been informed of the possibility of such damages.
 *
 * See the Mozilla Public License for more details.
 *
 * @package Libre EHR 
 * @author Anirudh (anirudh.s.c.96@hotmail.com)
 * @link http://LibreEHR.org
 *
 * Please help the overall project by sending changes you make to the author and to the Libre EHR community.
 *
 *
 */

 /* Include our required headers */
 require_once('../globals.php');
 require_once("$srcdir/acl.inc");
 require_once("$srcdir/headers.inc.php");
 require_once("$srcdir/role.php");


 if (!acl_check('admin', 'super')) die(xl('Not authorized','','','!'));

$role = new Role();
$menu_data = file_get_contents( $GLOBALS['OE_SITE_DIR'] . "/menu_data.json");
$json_data = json_decode($menu_data, true);

if (!isset($_GET['title']) || $_GET['title'] == '') {
    echo "Invalid title";
}

if ($role->getRole($_GET['title'])) {
    if ($role->deleteRole($_GET['title'])) {
        echo " Role " . $_GET['title'] . " successfully deleted!";
    } else {
        echo " Role " . $_GET['title'] . " could not be deleted. ";
    }
} else {
    echo "Invalid title";
}
