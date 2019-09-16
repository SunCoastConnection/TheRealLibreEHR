<?php
// Process POST / Save changes
if (!empty($_POST['menuEdits'])) {
    // save a backup copy
    $today = date('Y-m-d');
    //$usermenufile = "../../interface/main/tabs/menu/menu_data.json";
    $usermenufile = "../../sites/default/menu_data.json";
    $usermenubackup = $usermenufile . ".bkup-$today";
    copy($usermenufile, $usermenubackup);
    //Pretty up the output
    $menu_json_pretty =  json_encode(json_decode($_POST['menuEdits']), JSON_PRETTY_PRINT);
    // save the new file
    file_put_contents($usermenufile,$menu_json_pretty);

    echo "$usermenufile and $usermenubackup saved";
    $menu_json_fixed = preg_replace("/\r|\n/", "", $menu_json_pretty);
}





