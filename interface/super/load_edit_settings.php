<?php
// Load Disk file for Edit Menu
require_once "../../interface/main/tabs/menu/menu_data.php";
$menu_json_fixed = preg_replace("/\r|\n/", "", $menu_temp);


// Load stuff for Manage Role
$role = new Role();
$role_list = $role->getRoleList();


// Load stuff for Facilities
$alertmsg = '';


// Load stuff for Users


