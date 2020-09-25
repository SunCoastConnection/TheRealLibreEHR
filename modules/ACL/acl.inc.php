<?php
/**
 * modules/ACL/acl.inc.php 
 * @author  Art Eaton <art@suncoastconnection.com>
 */

  function acl_check($feature) {
    if (!isset($user)){ $user = $_SESSION['authUser'];}
    $query = "SELECT feature from users_acl where user = $user and feature = $feature";
    $acl_res = sqlQuery($query);

    IF ($acl_res){
                 return TRUE;
             }else{
                 return FALSE;
             }

  }
?>
