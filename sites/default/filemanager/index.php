<?php
/*
 * File Manager Interface
 *
 * Copyright (C) 2015 - 2017      Suncoast Connection
 * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */
require_once '../../../interface/globals.php';
require_once($GLOBALS['modules_dir'].'ACL/acl.inc.php');
?>
<html>
 
<head>  
<span class='title' visibility: hidden><?php echo 'File Manager'; ?></span> 
 	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href="assets/css/dropzone.css" type="text/css" rel="stylesheet" />
<link href="assets/css/styles.css" rel="stylesheet"/> 

<script src="assets/js/dropzone.js"></script>

 <h1> Drag and drop your file below or click below to browse for files.</h1>
</head>
 
<body>
 

<form action="upload.php" class="dropzone"></form>

 	<div class="filemanager">

		<div class="search">
			<input type="search" placeholder="Find a file/folder.." />
		</div>

		<div class="breadcrumbs"></div>

		<ul class="data"></ul>

		<div class="nothingfound">
			<div class="nofiles"></div>
			<span>No files found.</span>
		</div>

	</div>  
		<script src="assets/js/jquerycurrent.js"></script>
	<script src="assets/js/script.js"></script>
</body>
 
</html> 
