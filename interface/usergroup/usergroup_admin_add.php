<?php
/*
 *  usergroup_admin_add.php for the adding of the user information
 *
 *  This program is used to add the users
 *
 * Copyright (C) 2016-2017
 *
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
 * along with this program. If not, see http://opensource.org/licenses/gpl-license.php.
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package LibreEHR
 *
 * @link http://LibreEHR.org
 *
 * Please help the overall project by sending changes you make to the author and to the LibreEHR community.
 *
 */


$fake_register_globals=false;
$sanitize_all_escapes=true;

require_once("../globals.php");
require_once("../../library/acl.inc");
require_once("$srcdir/sql.inc");
require_once("$srcdir/formdata.inc.php");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/erx_javascript.inc.php");
require_once("$srcdir/headers.inc.php");
require_once("$srcdir/role.php");

$alertmsg = '';

?>
<html>
<head>

<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">

<?php call_required_libraries(array("jquery-min-3-1-1", "bootstrap-3-3-7", "common", "select2")); ?>

<script src="checkpwd_validation.js" type="text/javascript"></script>

<script language="JavaScript">
function trimAll(sString)
{
    while (sString.substring(0,1) == ' ')
    {
        sString = sString.substring(1, sString.length);
    }
    while (sString.substring(sString.length-1, sString.length) == ' ')
    {
        sString = sString.substring(0,sString.length-1);
    }
    return sString;
}

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#prof_img').attr('src', e.target.result).width(64).height(64).css("display", "block");
                $('#file_input_button').text("Edit Profile Picture");
            };
            reader.readAsDataURL(input.files[0]);
        }
}

function submitform() {
    console.log(document.forms[0]);
    if (document.forms[0].rumple1.value.length>0 && document.forms[0].stiltskin.value.length>0 && document.getElementById('fname').value.length >0 && document.getElementById('lname').value.length >0) {
       top.restoreSession();

       //Checking if secure password is enabled or disabled.
       //If it is enabled and entered password is a weak password, alert the user to enter strong password.
       if(document.new_user.secure_pwd.value == 1){
          var password = trim(document.new_user.stiltskin.value);
          if(password != "") {
             var pwdresult = passwordvalidate(password);
             if(pwdresult == 0){
                alert("<?php echo xl('The password must be at least eight characters, and should'); echo '\n'; echo xl('contain at least three of the four following items:'); echo '\n'; echo xl('A number'); echo '\n'; echo xl('A lowercase letter'); echo '\n'; echo xl('An uppercase letter'); echo '\n'; echo xl('A special character');echo '('; echo xl('not a letter or number'); echo ').'; echo '\n'; echo xl('For example:'); echo ' healthCare@09'; ?>");
                return false;
             }
          }
       } //secure_pwd if ends here

       <?php if($GLOBALS['erx_enable']){ ?>
       let alertMsg='';
       f = document.forms[0];
       for(i=0; i<f.length; i++){
          if(f[i].type=='text' && f[i].value)
          {
             if(f[i].name == 'rumple')
             {
                alertMsg += checkLength(f[i].name,f[i].value,35);
                alertMsg += checkUsername(f[i].name,f[i].value);
             }
             else if(f[i].name == 'fname' || f[i].name == 'mname' || f[i].name == 'lname')
             {
                alertMsg += checkLength(f[i].name,f[i].value,35);
                alertMsg += checkUsername(f[i].name,f[i].value);
             }
             else if(f[i].name == 'federaltaxid')
             {
                alertMsg += checkLength(f[i].name,f[i].value,10);
                alertMsg += checkFederalEin(f[i].name,f[i].value);
             }
             else if(f[i].name == 'state_license_number')
             {
                alertMsg += checkLength(f[i].name,f[i].value,10);
                alertMsg += checkStateLicenseNumber(f[i].name,f[i].value);
             }
             else if(f[i].name == 'npi')
             {
                alertMsg += checkLength(f[i].name,f[i].value,35);
                alertMsg += checkTaxNpiDea(f[i].name,f[i].value);
             }
             else if(f[i].name == 'federaldrugid')
             {
                alertMsg += checkLength(f[i].name,f[i].value,30);
                alertMsg += checkAlphaNumeric(f[i].name,f[i].value);
             }

          }
       }
       if(alertMsg) {
          alert(alertMsg);
          return false;
       }
       <?php } // End erx_enable only include block ?>

        document.forms[0].submit();
        parent.$('#addUser-iframe').iziModal('close');

    } else {
       if (document.forms[0].rumple.value.length<=0)
       {
          document.forms[0].rumple.style.backgroundColor="red";
          alert("<?php xl('Required field missing: Please enter the User Name','e');?>");
          document.forms[0].rumple.focus();
          return false;
       }
       if (document.forms[0].stiltskin.value.length<=0)
       {
          document.forms[0].stiltskin.style.backgroundColor="red";
          alert("<?php echo xl('Please enter the pass phrase'); ?>");
          document.forms[0].stiltskin.focus();
          return false;
       }
       if(trimAll(document.getElementById('fname').value) == ""){
          document.getElementById('fname').style.backgroundColor="red";
          alert("<?php echo xl('Required field missing: Please enter the First name');?>");
          document.getElementById('fname').focus();
          return false;
       }
       if(trimAll(document.getElementById('lname').value) == ""){
          document.getElementById('lname').style.backgroundColor="red";
          alert("<?php echo xl('Required field missing: Please enter the Last name');?>");
          document.getElementById('lname').focus();
          return false;
       }
    }
}

</script>
<style type="text/css">
  .physician_type_class{
    width: 120px !important;
  }
    input.form-control, select.form-control{
        border-radius: 0px !important;
        height: 24px !important;
        font-size: 13px;
        border: 1px solid lightslategray;
    }

    .form-group > label{
        font-size: 13.5px;
        height: 22px !important;
    }

</style>
</head>
<body class="body_top">
    <div class="container-fluid">
        <div class="row">
            <form id="addNewUser" name="new_user" method='post'  target="_parent" action="usergroup_admin.php" enctype="multipart/form-data">
                <div class="col-sm-6 form-horizontal">
                    <div class="form-group">
                        <label for="username" class="col-sm-4"><?php echo xlt('Username'); ?> <sup class="text-danger">*</sup>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username">
                        </div>
                    </div>
                    <div class="form-group <?php if ($GLOBALS['disable_non_default_groups']) echo "hidden"; ?>">
                        <label for="groupname" class="col-sm-4"><?php echo xlt('Groupname'); ?>:</label>
                        <div class="col-sm-8">
                            <select name="groupname" id="groupname" class="form-control">
                                <?php
                                $res = sqlStatement("select distinct name from groups");
                                $result2 = array();
                                for ($iter = 0;$row = sqlFetchArray($res);$iter++)
                                    $result2[$iter] = $row;
                                foreach ($result2 as $iter) {
                                    print "<option value='".$iter{"name"}."'>" . $iter{"name"} . "</option>\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class="col-sm-4"><?php echo xlt('First Name'); ?> <sup class="text-danger">*</sup>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="fname" name="fname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="col-sm-4"><?php echo xlt('Last Name'); ?> <sup class="text-danger">*</sup>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lname" name="lname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="suffix" class="col-sm-4"><?php echo xlt('Suffix'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="suffix" name="suffix">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="federaldrugid" class="col-sm-4"><?php echo xlt('DEA Number'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="federaldrugid" name="federaldrugid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="npi" class="col-sm-4"><?php echo xlt('NPI'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="npi" name="npi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="default_facility" class="col-sm-4"><?php echo xlt('Clinician Type'); ?>:</label>
                        <div class="col-sm-8">
                            <?php echo generate_select_list("physician_type", "physician_type", '', '', xl('Select Type'),'form-control','','', array('style'=>'width:100%;display:block;')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taxonomy" class="col-sm-4"><?php echo xlt('Taxonomy'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" name="taxonomy" id="taxonomy" class="form-control" value="207Q00000X">
                        </div>
                    </div>
                    <?php if ($GLOBALS['erx_enable']) { ?>
                    <div class="form-group">
                        <label for="state_license_number" class="col-sm-4"><?php echo xlt('State License Number'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" name="state_license_number" id="state_license_number" class="form-control">
                        </div>
                    </div>
                    <?php } ?>
                    <?php // List the access control groups if phpgacl installed
                    if (isset($phpgacl_location) && acl_check('admin', 'acl')) { ?>
                    <div class="form-group">
                        <label for="access_group" class="col-sm-4"><?php echo xlt('Access Control'); ?>:</label>
                        <div class="col-sm-8">
                            <select name="access_group[]" id="access_group" multiple class="form-control">
                                <?php
                                $list_acl_groups = acl_get_group_title_list();
                                $default_acl_group = 'Administrators';
                                foreach ($list_acl_groups as $value) {
                                    if ($default_acl_group == $value) {
                                        // Modified 6-2009 by BM - Translate group name if applicable
                                        echo " <option value='$value' selected>" . xl_gacl_group($value) . "</option>\n";
                                    }
                                    else {
                                        // Modified 6-2009 by BM - Translate group name if applicable
                                        echo " <option value='$value'>" . xl_gacl_group($value) . "</option>\n";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_role" class="col-sm-4"><?php echo xlt('Menu Role'); ?>:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="menu_role" id="menu_role">
                                <?php
                                $role = new Role();
                                $role_list = $role->getRoleList();
                                foreach($role_list as $role_title) { ?>
                                    <option value="<?php echo $role_title; ?>"><?php echo xlt($role_title); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="provider" class="col-sm-4">Full Screen Page Enabled:</label>
                        <div class="col-sm-8">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="fullscreen_enable" name="fullscreen_enable">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fullscreen_page" class="col-sm-4"><?php echo xlt('Full screen page'); ?>:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fullscreen_page" id="fullscreen_page">
                                <option value="Calendar|/interface/main/main_info.php">Calendar</option>
                                <option value="Flow Board|/interface/patient_tracker/patient_tracker.php">Flow Board</option>
                            </select>
                        </div>
                    </div>
                        <?php do_action( 'usergroup_admin_add' ); ?>
                    <?php } ?>
                </div>
                <div class="col-sm-6 form-horizontal">
                    <div class="form-group">
                        <label for="stiltskin" class="col-sm-4"><?php echo xlt('Pass Phrase'); ?> <sup class="text-danger">*</sup>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="stiltskin" name="stiltskin">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adminPass" class="col-sm-4"><?php echo xlt('Your Pass Phrase'); ?> <sup class="text-danger">*</sup>:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="adminPass" name="adminPass" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="authorized" class="col-sm-4"><?php echo xlt('Provider'); ?>:</label>
                        <div class="col-sm-8">
                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="authorized" name="authorized" value="1"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Calendar &nbsp;&nbsp;&nbsp;<input type="checkbox" id="calendar" name="calendar" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mname" class="col-sm-4"><?php echo xlt('Middle Name'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mname" name="mname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facility_id" class="col-sm-4"><?php echo xlt('Default Facility'); ?>:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="facility_id" name="facility_id">
                                <?php
                                $fres = sqlStatement("select * from facility where service_location != 0 order by name");
                                if ($fres) {
                                    for ($iter = 0;$frow = sqlFetchArray($fres);$iter++)
                                        $result[$iter] = $frow;
                                    foreach($result as $iter) {
                                        ?>
                                        <option value="<?php echo $iter{'id'};?>"><?php echo $iter{'name'};?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="federaltaxid" class="col-sm-4"><?php echo xlt('Federal Tax ID'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="federaltaxid" name="federaltaxid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specialty" class="col-sm-4"><?php echo xlt('Job Description'); ?>:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="specialty" name="specialty">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="see_auth" class="col-sm-4"><?php echo xlt('See Authorizations'); ?>:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="see_auth" name="see_auth">
                                <?php
                                foreach (array(1 => xl('None'), 2 => xl('Only Mine'), 3 => xl('All')) as $key => $value) {
                                    echo " <option value='$key'>$value</option>\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php if ($GLOBALS['inhouse_pharmacy']) { ?>
                        <div class="form-group">
                            <label for="see_auth" class="col-sm-4"><?php echo xlt('Default Warehouse'); ?>:</label>
                            <div class="col-sm-8">
                                <?php echo generate_select_list('default_warehouse', 'warehouse', '', ''); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="see_auth" class="col-sm-4"><?php echo xlt('Invoice Refno Pool'); ?>:</label>
                            <div class="col-sm-8">
                                <?php echo generate_select_list('irnpool', 'irnpool', '', xl('Invoice reference number pool, if used')); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="cal_ui" class="col-sm-4"><?php echo xlt('Calendar UI'); ?>:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="cal_ui" name="cal_ui">
                                <?php
                                foreach (array(3 => xl('Outlook'), 1 => xl('Original'), 2 => xl('Fancy')) as $key => $value) {
                                    echo " <option value='$key'>$value</option>\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php if ($GLOBALS['erx_enable']) { ?>
                        <div class="form-group">
                            <label for="newcrop_erx_role" class="col-sm-4"><?php echo xlt('NewCrop eRX Role'); ?>:</label>
                            <div class="col-sm-8">
                                <?php echo generate_select_list("erxrole", "newcrop_erx_role", '','','--Select Role--','form-control','','',array('style'=>'width:100%;display:block;')); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php // List the access control groups if phpgacl installed
                    if (isset($phpgacl_location) && acl_check('admin', 'acl')) { ?>
                        <div class="form-group">
                            <label for="info" class="col-sm-4">Additional Info:</label>
                            <div class="col-sm-8">
                                <textarea rows="6" class="form-control" name="info" id="info" wrap="hard"></textarea>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="files" class="css_button cp-positive" id="file_input_button"><?php echo xlt('Add Profile Picture'); ?>
                            <input type="file" name="profile_picture" id="files"  class="hidden" style="display: none;" onchange="readURL(this);" />
                        </label>
                        <div class="col-sm-8">
                            <img id="prof_img" src="" class="hidden img-responsive img-circle" style="border-radius: 100%; border: 1px solid lightskyblue;">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="newauthPass">
                <input type='hidden' name='mode' value='new_user'>
                <input type='hidden' name='secure_pwd' value="<?php echo $GLOBALS['secure_password']; ?>">
            </form>
        </div>

                <div class="row">
                    <div class="col-sm-12 <?php if ($GLOBALS['disable_non_default_groups']) echo "hidden"; ?>">
                        <table class="table table-responsive table-hover">
                            <form name='new_group' method='post' action="usergroup_admin.php">
                                <input type="hidden" name="mode" value="new_group">
                            <tr>
                                <td><span class="bold"><?php echo xlt('New Group'); ?>:</span></td>
                                <td><span class="bold"><?php echo xlt('Groupname'); ?>: </span><input type="text" name=groupname size=10></td>
                                <td><label for="rumple1" class="text"><?php echo xlt('Initial User'); ?>: </label>
                                    <select name="rumple" id="rumple1">
                                        <?php
                                        $res = sqlStatement("select distinct username from users where username != ''");
                                        for ($iter = 0;$row = sqlFetchArray($res);$iter++)
                                            $result[$iter] = $row;
                                        foreach ($result as $iter) {
                                            print "<option value='".$iter{"username"}."'>" . $iter{"username"} . "</option>\n";
                                        }
                                        ?>
                                    </select></td>
                                <td><input type="submit" class="btn btn-sm btn-default" value=<?php echo xlt('Save'); ?>></td>
                            </tr>
                            </form>
                            <form name='new_group' method='post' action="usergroup_admin.php">
                                <input type="hidden" name="mode" value="new_group">
                                <tr>
                                    <td><span class="bold"><?php echo xlt('Add User To Group'); ?>:</span></td>
                                    <td><label for="rumple2" class="bold"><?php echo xlt('User'); ?>: </label>
                                        <select name=rumple id="rumple2">
                                        <?php
                                        $res = sqlStatement("select distinct username from users where username != ''");
                                        for ($iter = 0;$row = sqlFetchArray($res);$iter++)
                                            $result3[$iter] = $row;
                                        foreach ($result3 as $iter) {
                                            print "<option value='".$iter{"username"}."'>" . $iter{"username"} . "</option>\n";
                                        }
                                        ?>
                                        </select>
                                    </td>
                                    <td><label class="bold" for="groupname"><?php echo xlt('Groupname'); ?>: </label>
                                        <select name="groupname" id="groupname">
                                        <?php
                                        $res = sqlStatement("select distinct name from groups");
                                        $result2 = array();
                                        for ($iter = 0;$row = sqlFetchArray($res);$iter++)
                                            $result2[$iter] = $row;
                                        foreach ($result2 as $iter) {
                                            print "<option value='".$iter{"name"}."'>" . $iter{"name"} . "</option>\n";
                                        }
                                        ?>
                                        </select>
                                    </td>
                                <td><input type="submit" class="btn btn-sm btn-success" value=<?php echo xlt('Add User To Group'); ?>></td>
                            </tr>
                            </form>
                        </table>
                    </div>
                </div>

                <div class="row">
                        <?php
                        if (empty($GLOBALS['disable_non_default_groups'])) {
                            $res = sqlStatement("select * from groups order by name");
                            for ($iter = 0;$row = sqlFetchArray($res);$iter++)
                                $result5[$iter] = $row;

                            foreach ($result5 as $iter) {
                                $grouplist{$iter{"name"}} .= $iter{"user"} .
                                    "(<a class='link_submit' href='usergroup_admin.php?mode=delete_group&id=" .
                                    $iter{"id"} . "' onclick='top.restoreSession()'>Remove</a>), ";
                            }

                            foreach ($grouplist as $groupname => $list) {
                                print "<span class='bold'>" . $groupname . "</span><br>\n<span class='text'>" .
                                    substr($list,0,strlen($list)-2) . "</span><br>\n";
                            }
                        }
                        ?>
                </div>

        <div class="row">
            <div class="container text-center">
                <a class="css_button cp-submit" name='form_save' id='form_save' href='#' onclick="return submitform()">
                    <span><?php echo xlt('Save');?></span></a>
                <a class="css_button large_button cp-negative" id='cancel' href='#'>
                    <span class='css_button_span large_button_span'><?php echo xlt('Cancel');?></span>
                </a>
            </div>
        </div>
    </div>

    <script language="JavaScript">
        <?php
        if ($alertmsg = trim($alertmsg)) {
            echo "alert('$alertmsg');\n";
        }
        ?>
        $(document).ready(function(){

            $("#cancel").click(function() {
                parent.$('#addUser-iframe').iziModal('close');
            });

            $("#access_group").select2({
                placeholder: "Select Access control group"
            });

            // check and uncheck calendar when provider is clicked
            $("#authorized").click(function () {
                $("#calendar").attr({
                    "disabled": !$(this).is(':checked'),
                    "checked": $(this).is(':checked')
                });
            });

            /*
               $("#role_name").on('change', function(e) {
                  $.ajax({
                    "url": '../../library/ajax/get_fullscreen_pages.php',
                    "method": "POST",
                    "data" : {
                       "role_name": $("#role_name").val()
                    },
                    success: function(data) {
                      obj = JSON.parse(data);
                      $("#fullscreen_page").empty();
                      obj.forEach(function(item) {
                        option = document.createElement('option');
                        option.text = item.label;
                        option.value = item.id;
                        $("#fullscreen_page").append(option);

                      });

                    },
                    error: function(err) {
                      console.log(err);
                    }
                    });

                 }); */
        });
    </script>
</body>
</html>
