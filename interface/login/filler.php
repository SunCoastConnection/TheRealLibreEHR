<?php
$ignoreAuth=true;
include_once("../globals.php");
?>
<html>
<head>
<?php html_header_show(); ?>
<title>Navigation</title>
<link rel=stylesheet href="<?php echo $css_header;?>" type="text/css">
<link rel=stylesheet href="../themes/login.css" type="text/css">
</head>
<body class="logobar">
<?php
<img style="position:absolute;top:0;left:20;"src=" <?php echo $GLOBALS['webroot']?>/interface/pic/mycatalyst.png" />
<?php } else {?>
<img style="position:absolute;top:0;left:20;"src=" <?php echo $GLOBALS['webroot']?>/interface/pic/logo.png" /> 
<?php }?>   
</body>
</html>
