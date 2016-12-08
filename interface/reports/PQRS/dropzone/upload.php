<?php
$sanitize_all_escapes = true;
$fake_register_globals = false;

require_once '../../../globals.php';
require_once($GLOBALS['srcdir'].'/acl.inc');

$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = '837s';   //2
if !is_dir($OE_SITE_DIR . $ds. $storeFolder){
	mkdir($OE_SITE_DIR . $ds. $storeFolder,0775,true)
}
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = $OE_SITE_DIR . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
     
}
?>