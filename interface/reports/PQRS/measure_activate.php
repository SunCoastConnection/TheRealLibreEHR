
<?php
require_once("../../globals.php");
include_once("$srcdir/sql.inc");
?>	
	
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
  
  <style>
 
#ros {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#ros td, #ros th {
    font-size: 1em;
    padding: 3px 0 2px 7px;
}

#ros th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#ros tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}

.checkbox-button {
	border: 1px solid #333333;
  margin: 1pt 1pt 2pt 1pt;
  XXpadding: 0 1pt 0 1pt;
  display: inline-block;
  border-radius: 4px;
  
  background-color: gray;
  color: white;
}
.checkbox-button input[type=checkbox] {
	display: none;
}
.checkbox-button label {
	text-size: 16pt;
	XXbackground-color: gray;
  XXcolor: white;
  margin: 1pt;
 	padding: 0 1pt 0 1px;
  XXwhite-space: nowrap;
}
XX.checkbox-button input[type=checkbox]:checked + label {
 	color: black;
	background-color: white;
}
XX.checkbox-button input[type=checkbox]:checked  {
 	color: black;
	background-color: blue;
}
.checkbox-button input[type=checkbox]:checked + label {
 	color: #333333;
	background-color: white;
}

label {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
} 
  </style>
<body>

<span class='title'><?php xl('Measure Toggles','e'); ?> - <?php xl('PQRS Measure Toggles','e'); ?></span>
<form method='post' action='measure_activate.php' id='theform'>
<input type='hidden' name='form_refresh' id='form_refresh' value=''/>

				<div style='margin-left:15px'>
					<a href='#' class='css_button' onclick='$("#form_refresh").attr("value","true"); $("#theform").submit();'>
					<span>
						<?php xl('Submit','e'); ?>
					</span>
					</a>
<?php
 if ($_POST['form_refresh']) {
	 require_once("measure_activate_save.php");}
?>
				</div>

<table style="width:100%">
 <TR>
  <TD>
 <span class= 'checkbox-button'>
<input id= 'PQRS_0001' name='PQRS_0001' type='checkbox' value='1' >
<label for='PQRS_0001' > PQRS_0001 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0005' name='PQRS_0005' type='checkbox' value='1' >
<label for='PQRS_0005' > PQRS_0005 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0006' name='PQRS_0006' type='checkbox' value='1' >
<label for='PQRS_0006' > PQRS_0006 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0007' name='PQRS_0007' type='checkbox' value='1' >
<label for='PQRS_0007' > PQRS_0007 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0008' name='PQRS_0008' type='checkbox' value='1' >
<label for='PQRS_0008' > PQRS_0008 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0012' name='PQRS_0012' type='checkbox' value='1' >
<label for='PQRS_0012' > PQRS_0012 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0014' name='PQRS_0014' type='checkbox' value='1' >
<label for='PQRS_0014' > PQRS_0014 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0019' name='PQRS_0019' type='checkbox' value='1' >
<label for='PQRS_0019' > PQRS_0019 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0021' name='PQRS_0021' type='checkbox' value='1' >
<label for='PQRS_0021' > PQRS_0021 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0022' name='PQRS_0022' type='checkbox' value='1' >
<label for='PQRS_0022' > PQRS_0022 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0023' name='PQRS_0023' type='checkbox' value='1' >
<label for='PQRS_0023' > PQRS_0023 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0024' name='PQRS_0024' type='checkbox' value='1' >
<label for='PQRS_0024' > PQRS_0024 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0032' name='PQRS_0032' type='checkbox' value='1' >
<label for='PQRS_0032' > PQRS_0032 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0033' name='PQRS_0033' type='checkbox' value='1' >
<label for='PQRS_0033' > PQRS_0033 </label>
</span>
  
<span class= 'checkbox-button'>
<input id= 'PQRS_0039' name='PQRS_0039' type='checkbox' value='1' >
<label for='PQRS_0039' > PQRS_0039 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0040' name='PQRS_0040' type='checkbox' value='1' >
<label for='PQRS_0040' > PQRS_0040 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0041' name='PQRS_0041' type='checkbox' value='1' >
<label for='PQRS_0041' > PQRS_0041 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0043' name='PQRS_0043' type='checkbox' value='1' >
<label for='PQRS_0043' > PQRS_0043 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0044' name='PQRS_0044' type='checkbox' value='1' >
<label for='PQRS_0044' > PQRS_0044 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0046' name='PQRS_0046' type='checkbox' value='1' >
<label for='PQRS_0046' > PQRS_0046 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0047' name='PQRS_0047' type='checkbox' value='1' >
<label for='PQRS_0047' > PQRS_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0048' name='PQRS_0048' type='checkbox' value='1' >
<label for='PQRS_0048' > PQRS_0048 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0050' name='PQRS_0050' type='checkbox' value='1' >
<label for='PQRS_0050' > PQRS_0050 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0051' name='PQRS_0051' type='checkbox' value='1' >
<label for='PQRS_0051' > PQRS_0051 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0052' name='PQRS_0052' type='checkbox' value='1' >
<label for='PQRS_0052' > PQRS_0052 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0053' name='PQRS_0053' type='checkbox' value='1' >
<label for='PQRS_0053' > PQRS_0053 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0054' name='PQRS_0054' type='checkbox' value='1' >
<label for='PQRS_0054' > PQRS_0054 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0065' name='PQRS_0065' type='checkbox' value='1' >
<label for='PQRS_0065' > PQRS_0065 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0066' name='PQRS_0066' type='checkbox' value='1' >
<label for='PQRS_0066' > PQRS_0066 </label>
</span>
 
<span class= 'checkbox-button'>
<input id= 'PQRS_0067' name='PQRS_0067' type='checkbox' value='1' >
<label for='PQRS_0067' > PQRS_0067 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0068' name='PQRS_0068' type='checkbox' value='1' >
<label for='PQRS_0068' > PQRS_0068 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0069' name='PQRS_0069' type='checkbox' value='1' >
<label for='PQRS_0069' > PQRS_0069 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0070' name='PQRS_0070' type='checkbox' value='1' >
<label for='PQRS_0070' > PQRS_0070 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0071' name='PQRS_0071' type='checkbox' value='1' >
<label for='PQRS_0071' > PQRS_0071 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0072' name='PQRS_0072' type='checkbox' value='1' >
<label for='PQRS_0072' > PQRS_0072 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0076' name='PQRS_0076' type='checkbox' value='1' >
<label for='PQRS_0076' > PQRS_0076 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0081' name='PQRS_0081' type='checkbox' value='1' >
<label for='PQRS_0081' > PQRS_0081 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0082' name='PQRS_0082' type='checkbox' value='1' >
<label for='PQRS_0082' > PQRS_0082 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0091' name='PQRS_0091' type='checkbox' value='1' >
<label for='PQRS_0091' > PQRS_0091 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0093' name='PQRS_0093' type='checkbox' value='1' >
<label for='PQRS_0093' > PQRS_0093 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0099' name='PQRS_0099' type='checkbox' value='1' >
<label for='PQRS_0099' > PQRS_0099 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0100' name='PQRS_0100' type='checkbox' value='1' >
<label for='PQRS_0100' > PQRS_0100 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0102' name='PQRS_0102' type='checkbox' value='1' >
<label for='PQRS_0102' > PQRS_0102 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0104' name='PQRS_0104' type='checkbox' value='1' >
<label for='PQRS_0104' > PQRS_0104 </label>
</span>
 
<span class= 'checkbox-button'>
<input id= 'PQRS_0109' name='PQRS_0109' type='checkbox' value='1' >
<label for='PQRS_0109' > PQRS_0109 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0110' name='PQRS_0110' type='checkbox' value='1' >
<label for='PQRS_0110' > PQRS_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0111' name='PQRS_0111' type='checkbox' value='1' >
<label for='PQRS_0111' > PQRS_0111 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0112' name='PQRS_0112' type='checkbox' value='1' >
<label for='PQRS_0112' > PQRS_0112 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0113' name='PQRS_0113' type='checkbox' value='1' >
<label for='PQRS_0113' > PQRS_0113 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0116' name='PQRS_0116' type='checkbox' value='1' >
<label for='PQRS_0116' > PQRS_0116 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0117' name='PQRS_0117' type='checkbox' value='1' >
<label for='PQRS_0117' > PQRS_0117 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0118' name='PQRS_0118' type='checkbox' value='1' >
<label for='PQRS_0118' > PQRS_0118 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0119' name='PQRS_0119' type='checkbox' value='1' >
<label for='PQRS_0119' > PQRS_0119 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0121' name='PQRS_0121' type='checkbox' value='1' >
<label for='PQRS_0121' > PQRS_0121 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0122' name='PQRS_0122' type='checkbox' value='1' >
<label for='PQRS_0122' > PQRS_0122 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0126' name='PQRS_0126' type='checkbox' value='1' >
<label for='PQRS_0126' > PQRS_0126 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0127' name='PQRS_0127' type='checkbox' value='1' >
<label for='PQRS_0127' > PQRS_0127 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0128' name='PQRS_0128' type='checkbox' value='1' >
<label for='PQRS_0128' > PQRS_0128 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0130' name='PQRS_0130' type='checkbox' value='1' >
<label for='PQRS_0130' > PQRS_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0131' name='PQRS_0131' type='checkbox' value='1' >
<label for='PQRS_0131' > PQRS_0131 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0134' name='PQRS_0134' type='checkbox' value='1' >
<label for='PQRS_0134' > PQRS_0134 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0137' name='PQRS_0137' type='checkbox' value='1' >
<label for='PQRS_0137' > PQRS_0137 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0138' name='PQRS_0138' type='checkbox' value='1' >
<label for='PQRS_0138' > PQRS_0138 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0140' name='PQRS_0140' type='checkbox' value='1' >
<label for='PQRS_0140' > PQRS_0140 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0141' name='PQRS_0141' type='checkbox' value='1' >
<label for='PQRS_0141' > PQRS_0141 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0143' name='PQRS_0143' type='checkbox' value='1' >
<label for='PQRS_0143' > PQRS_0143 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0144' name='PQRS_0144' type='checkbox' value='1' >
<label for='PQRS_0144' > PQRS_0144 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0145' name='PQRS_0145' type='checkbox' value='1' >
<label for='PQRS_0145' > PQRS_0145 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0146' name='PQRS_0146' type='checkbox' value='1' >
<label for='PQRS_0146' > PQRS_0146 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0147' name='PQRS_0147' type='checkbox' value='1' >
<label for='PQRS_0147' > PQRS_0147 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0154' name='PQRS_0154' type='checkbox' value='1' >
<label for='PQRS_0154' > PQRS_0154 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0155' name='PQRS_0155' type='checkbox' value='1' >
<label for='PQRS_0155' > PQRS_0155 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0156' name='PQRS_0156' type='checkbox' value='1' >
<label for='PQRS_0156' > PQRS_0156 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0163' name='PQRS_0163' type='checkbox' value='1' >
<label for='PQRS_0163' > PQRS_0163 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0164' name='PQRS_0164' type='checkbox' value='1' >
<label for='PQRS_0164' > PQRS_0164 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0165' name='PQRS_0165' type='checkbox' value='1' >
<label for='PQRS_0165' > PQRS_0165 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0166' name='PQRS_0166' type='checkbox' value='1' >
<label for='PQRS_0166' > PQRS_0166 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0167' name='PQRS_0167' type='checkbox' value='1' >
<label for='PQRS_0167' > PQRS_0167 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0168' name='PQRS_0168' type='checkbox' value='1' >
<label for='PQRS_0168' > PQRS_0168 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0172' name='PQRS_0172' type='checkbox' value='1' >
<label for='PQRS_0172' > PQRS_0172 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0173' name='PQRS_0173' type='checkbox' value='1' >
<label for='PQRS_0173' > PQRS_0173 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0178' name='PQRS_0178' type='checkbox' value='1' >
<label for='PQRS_0178' > PQRS_0178 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0181' name='PQRS_0181' type='checkbox' value='1' >
<label for='PQRS_0181' > PQRS_0181 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0182' name='PQRS_0182' type='checkbox' value='1' >
<label for='PQRS_0182' > PQRS_0182 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0185' name='PQRS_0185' type='checkbox' value='1' >
<label for='PQRS_0185' > PQRS_0185 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0187' name='PQRS_0187' type='checkbox' value='1' >
<label for='PQRS_0187' > PQRS_0187 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0191' name='PQRS_0191' type='checkbox' value='1' >
<label for='PQRS_0191' > PQRS_0191 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0192' name='PQRS_0192' type='checkbox' value='1' >
<label for='PQRS_0192' > PQRS_0192 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0193' name='PQRS_0193' type='checkbox' value='1' >
<label for='PQRS_0193' > PQRS_0193 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0194' name='PQRS_0194' type='checkbox' value='1' >
<label for='PQRS_0194' > PQRS_0194 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0195' name='PQRS_0195' type='checkbox' value='1' >
<label for='PQRS_0195' > PQRS_0195 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0204' name='PQRS_0204' type='checkbox' value='1' >
<label for='PQRS_0204' > PQRS_0204 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0205' name='PQRS_0205' type='checkbox' value='1' >
<label for='PQRS_0205' > PQRS_0205 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0217' name='PQRS_0217' type='checkbox' value='1' >
<label for='PQRS_0217' > PQRS_0217 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0218' name='PQRS_0218' type='checkbox' value='1' >
<label for='PQRS_0218' > PQRS_0218 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0219' name='PQRS_0219' type='checkbox' value='1' >
<label for='PQRS_0219' > PQRS_0219 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0220' name='PQRS_0220' type='checkbox' value='1' >
<label for='PQRS_0220' > PQRS_0220 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0221' name='PQRS_0221' type='checkbox' value='1' >
<label for='PQRS_0221' > PQRS_0221 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0222' name='PQRS_0222' type='checkbox' value='1' >
<label for='PQRS_0222' > PQRS_0222 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0223' name='PQRS_0223' type='checkbox' value='1' >
<label for='PQRS_0223' > PQRS_0223 </label>
</span>
  </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0224' name='PQRS_0224' type='checkbox' value='1' >
<label for='PQRS_0224' > PQRS_0224 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0225' name='PQRS_0225' type='checkbox' value='1' >
<label for='PQRS_0225' > PQRS_0225 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0226' name='PQRS_0226' type='checkbox' value='1' >
<label for='PQRS_0226' > PQRS_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0236' name='PQRS_0236' type='checkbox' value='1' >
<label for='PQRS_0236' > PQRS_0236 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0238' name='PQRS_0238' type='checkbox' value='1' >
<label for='PQRS_0238' > PQRS_0238 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0242' name='PQRS_0242' type='checkbox' value='1' >
<label for='PQRS_0242' > PQRS_0242 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0243' name='PQRS_0243' type='checkbox' value='1' >
<label for='PQRS_0243' > PQRS_0243 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0249' name='PQRS_0249' type='checkbox' value='1' >
<label for='PQRS_0249' > PQRS_0249 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0250' name='PQRS_0250' type='checkbox' value='1' >
<label for='PQRS_0250' > PQRS_0250 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0251' name='PQRS_0251' type='checkbox' value='1' >
<label for='PQRS_0251' > PQRS_0251 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0254' name='PQRS_0254' type='checkbox' value='1' >
<label for='PQRS_0254' > PQRS_0254 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0255' name='PQRS_0255' type='checkbox' value='1' >
<label for='PQRS_0255' > PQRS_0255 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0257' name='PQRS_0257' type='checkbox' value='1' >
<label for='PQRS_0257' > PQRS_0257 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0258' name='PQRS_0258' type='checkbox' value='1' >
<label for='PQRS_0258' > PQRS_0258 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0259' name='PQRS_0259' type='checkbox' value='1' >
<label for='PQRS_0259' > PQRS_0259 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0260' name='PQRS_0260' type='checkbox' value='1' >
<label for='PQRS_0260' > PQRS_0260 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0261' name='PQRS_0261' type='checkbox' value='1' >
<label for='PQRS_0261' > PQRS_0261 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0262' name='PQRS_0262' type='checkbox' value='1' >
<label for='PQRS_0262' > PQRS_0262 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0263' name='PQRS_0263' type='checkbox' value='1' >
<label for='PQRS_0263' > PQRS_0263 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0264' name='PQRS_0264' type='checkbox' value='1' >
<label for='PQRS_0264' > PQRS_0264 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0265' name='PQRS_0265' type='checkbox' value='1' >
<label for='PQRS_0265' > PQRS_0265 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0268' name='PQRS_0268' type='checkbox' value='1' >
<label for='PQRS_0268' > PQRS_0268 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0270' name='PQRS_0270' type='checkbox' value='1' >
<label for='PQRS_0270' > PQRS_0270 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0271' name='PQRS_0271' type='checkbox' value='1' >
<label for='PQRS_0271' > PQRS_0271 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0274' name='PQRS_0274' type='checkbox' value='1' >
<label for='PQRS_0274' > PQRS_0274 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0275' name='PQRS_0275' type='checkbox' value='1' >
<label for='PQRS_0275' > PQRS_0275 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0303' name='PQRS_0303' type='checkbox' value='1' >
<label for='PQRS_0303' > PQRS_0303 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0304' name='PQRS_0304' type='checkbox' value='1' >
<label for='PQRS_0304' > PQRS_0304 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0317' name='PQRS_0317' type='checkbox' value='1' >
<label for='PQRS_0317' > PQRS_0317 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0320' name='PQRS_0320' type='checkbox' value='1' >
<label for='PQRS_0320' > PQRS_0320 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0322' name='PQRS_0322' type='checkbox' value='1' >
<label for='PQRS_0322' > PQRS_0322 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0323' name='PQRS_0323' type='checkbox' value='1' >
<label for='PQRS_0323' > PQRS_0323 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0324' name='PQRS_0324' type='checkbox' value='1' >
<label for='PQRS_0324' > PQRS_0324 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0325' name='PQRS_0325' type='checkbox' value='1' >
<label for='PQRS_0325' > PQRS_0325 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0326' name='PQRS_0326' type='checkbox' value='1' >
<label for='PQRS_0326' > PQRS_0326 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0327' name='PQRS_0327' type='checkbox' value='1' >
<label for='PQRS_0327' > PQRS_0327 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0328' name='PQRS_0328' type='checkbox' value='1' >
<label for='PQRS_0328' > PQRS_0328 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0329' name='PQRS_0329' type='checkbox' value='1' >
<label for='PQRS_0329' > PQRS_0329 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0330' name='PQRS_0330' type='checkbox' value='1' >
<label for='PQRS_0330' > PQRS_0330 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0331' name='PQRS_0331' type='checkbox' value='1' >
<label for='PQRS_0331' > PQRS_0331 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0332' name='PQRS_0332' type='checkbox' value='1' >
<label for='PQRS_0332' > PQRS_0332 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0333' name='PQRS_0333' type='checkbox' value='1' >
<label for='PQRS_0333' > PQRS_0333 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0334' name='PQRS_0334' type='checkbox' value='1' >
<label for='PQRS_0334' > PQRS_0334 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0335' name='PQRS_0335' type='checkbox' value='1' >
<label for='PQRS_0335' > PQRS_0335 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0336' name='PQRS_0336' type='checkbox' value='1' >
<label for='PQRS_0336' > PQRS_0336 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0337' name='PQRS_0337' type='checkbox' value='1' >
<label for='PQRS_0337' > PQRS_0337 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0342' name='PQRS_0342' type='checkbox' value='1' >
<label for='PQRS_0342' > PQRS_0342 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0343' name='PQRS_0343' type='checkbox' value='1' >
<label for='PQRS_0343' > PQRS_0343 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0344' name='PQRS_0344' type='checkbox' value='1' >
<label for='PQRS_0344' > PQRS_0344 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0345' name='PQRS_0345' type='checkbox' value='1' >
<label for='PQRS_0345' > PQRS_0345 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0346' name='PQRS_0346' type='checkbox' value='1' >
<label for='PQRS_0346' > PQRS_0346 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0347' name='PQRS_0347' type='checkbox' value='1' >
<label for='PQRS_0347' > PQRS_0347 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0348' name='PQRS_0348' type='checkbox' value='1' >
<label for='PQRS_0348' > PQRS_0348 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0349' name='PQRS_0349' type='checkbox' value='1' >
<label for='PQRS_0349' > PQRS_0349 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0358' name='PQRS_0358' type='checkbox' value='1' >
<label for='PQRS_0358' > PQRS_0358 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0383' name='PQRS_0383' type='checkbox' value='1' >
<label for='PQRS_0383' > PQRS_0383 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0384' name='PQRS_0384' type='checkbox' value='1' >
<label for='PQRS_0384' > PQRS_0384 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0385' name='PQRS_0385' type='checkbox' value='1' >
<label for='PQRS_0385' > PQRS_0385 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0386' name='PQRS_0386' type='checkbox' value='1' >
<label for='PQRS_0386' > PQRS_0386 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0387' name='PQRS_0387' type='checkbox' value='1' >
<label for='PQRS_0387' > PQRS_0387 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0388' name='PQRS_0388' type='checkbox' value='1' >
<label for='PQRS_0388' > PQRS_0388 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0389' name='PQRS_0389' type='checkbox' value='1' >
<label for='PQRS_0389' > PQRS_0389 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0390' name='PQRS_0390' type='checkbox' value='1' >
<label for='PQRS_0390' > PQRS_0390 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0391' name='PQRS_0391' type='checkbox' value='1' >
<label for='PQRS_0391' > PQRS_0391 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0392' name='PQRS_0392' type='checkbox' value='1' >
<label for='PQRS_0392' > PQRS_0392 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0393' name='PQRS_0393' type='checkbox' value='1' >
<label for='PQRS_0393' > PQRS_0393 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0394' name='PQRS_0394' type='checkbox' value='1' >
<label for='PQRS_0394' > PQRS_0394 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0395' name='PQRS_0395' type='checkbox' value='1' >
<label for='PQRS_0395' > PQRS_0395 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0396' name='PQRS_0396' type='checkbox' value='1' >
<label for='PQRS_0396' > PQRS_0396 </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_0397' name='PQRS_0397' type='checkbox' value='1' >
<label for='PQRS_0397' > PQRS_0397 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0398' name='PQRS_0398' type='checkbox' value='1' >
<label for='PQRS_0398' > PQRS_0398 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0399' name='PQRS_0399' type='checkbox' value='1' >
<label for='PQRS_0399' > PQRS_0399 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0400' name='PQRS_0400' type='checkbox' value='1' >
<label for='PQRS_0400' > PQRS_0400 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0401' name='PQRS_0401' type='checkbox' value='1' >
<label for='PQRS_0401' > PQRS_0401 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_0402' name='PQRS_0402' type='checkbox' value='1' >
<label for='PQRS_0402' > PQRS_0402 </label>
</span>
  </TD>
 </TR>
 <TR>
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_always_met' name='PQRS_always_met' type='checkbox' value='1' >
<label for='PQRS_always_met' > PQRS_always_met </label>
</span>
 </TD>
  </TR>
  <TR>
 <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0091' name='PQRS_Group_AOE_0091' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0091' > PQRS_Group_AOE_0091 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0093' name='PQRS_Group_AOE_0093' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0093' > PQRS_Group_AOE_0093 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0130' name='PQRS_Group_AOE_0130' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0130' > PQRS_Group_AOE_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0131' name='PQRS_Group_AOE_0131' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0131' > PQRS_Group_AOE_0131 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0154' name='PQRS_Group_AOE_0154' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0154' > PQRS_Group_AOE_0154 </label>
</span>
 
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0155' name='PQRS_Group_AOE_0155' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0155' > PQRS_Group_AOE_0155 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0226' name='PQRS_Group_AOE_0226' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0226' > PQRS_Group_AOE_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_AOE_0317' name='PQRS_Group_AOE_0317' type='checkbox' value='1' >
<label for='PQRS_Group_AOE_0317' > PQRS_Group_AOE_0317 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Asthma_0053' name='PQRS_Group_Asthma_0053' type='checkbox' value='1' >
<label for='PQRS_Group_Asthma_0053' > PQRS_Group_Asthma_0053 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Asthma_0110' name='PQRS_Group_Asthma_0110' type='checkbox' value='1' >
<label for='PQRS_Group_Asthma_0110' > PQRS_Group_Asthma_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Asthma_0128' name='PQRS_Group_Asthma_0128' type='checkbox' value='1' >
<label for='PQRS_Group_Asthma_0128' > PQRS_Group_Asthma_0128 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Asthma_0130' name='PQRS_Group_Asthma_0130' type='checkbox' value='1' >
<label for='PQRS_Group_Asthma_0130' > PQRS_Group_Asthma_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Asthma_0226' name='PQRS_Group_Asthma_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Asthma_0226' > PQRS_Group_Asthma_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Asthma_0402' name='PQRS_Group_Asthma_0402' type='checkbox' value='1' >
<label for='PQRS_Group_Asthma_0402' > PQRS_Group_Asthma_0402 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0043' name='PQRS_Group_CABG_0043' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0043' > PQRS_Group_CABG_0043 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0044' name='PQRS_Group_CABG_0044' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0044' > PQRS_Group_CABG_0044 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0164' name='PQRS_Group_CABG_0164' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0164' > PQRS_Group_CABG_0164 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0165' name='PQRS_Group_CABG_0165' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0165' > PQRS_Group_CABG_0165 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0166' name='PQRS_Group_CABG_0166' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0166' > PQRS_Group_CABG_0166 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0167' name='PQRS_Group_CABG_0167' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0167' > PQRS_Group_CABG_0167 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CABG_0168' name='PQRS_Group_CABG_0168' type='checkbox' value='1' >
<label for='PQRS_Group_CABG_0168' > PQRS_Group_CABG_0168 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CAD_0006' name='PQRS_Group_CAD_0006' type='checkbox' value='1' >
<label for='PQRS_Group_CAD_0006' > PQRS_Group_CAD_0006 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CAD_0007' name='PQRS_Group_CAD_0007' type='checkbox' value='1' >
<label for='PQRS_Group_CAD_0007' > PQRS_Group_CAD_0007 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CAD_0128' name='PQRS_Group_CAD_0128' type='checkbox' value='1' >
<label for='PQRS_Group_CAD_0128' > PQRS_Group_CAD_0128 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CAD_0130' name='PQRS_Group_CAD_0130' type='checkbox' value='1' >
<label for='PQRS_Group_CAD_0130' > PQRS_Group_CAD_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CAD_0226' name='PQRS_Group_CAD_0226' type='checkbox' value='1' >
<label for='PQRS_Group_CAD_0226' > PQRS_Group_CAD_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CAD_0242' name='PQRS_Group_CAD_0242' type='checkbox' value='1' >
<label for='PQRS_Group_CAD_0242' > PQRS_Group_CAD_0242 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0130' name='PQRS_Group_Cataracts_0130' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0130' > PQRS_Group_Cataracts_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0191' name='PQRS_Group_Cataracts_0191' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0191' > PQRS_Group_Cataracts_0191 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0192' name='PQRS_Group_Cataracts_0192' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0192' > PQRS_Group_Cataracts_0192 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0226' name='PQRS_Group_Cataracts_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0226' > PQRS_Group_Cataracts_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0303' name='PQRS_Group_Cataracts_0303' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0303' > PQRS_Group_Cataracts_0303 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0304' name='PQRS_Group_Cataracts_0304' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0304' > PQRS_Group_Cataracts_0304 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0388' name='PQRS_Group_Cataracts_0388' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0388' > PQRS_Group_Cataracts_0388 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Cataracts_0389' name='PQRS_Group_Cataracts_0389' type='checkbox' value='1' >
<label for='PQRS_Group_Cataracts_0389' > PQRS_Group_Cataracts_0389 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CKD_0047' name='PQRS_Group_CKD_0047' type='checkbox' value='1' >
<label for='PQRS_Group_CKD_0047' > PQRS_Group_CKD_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CKD_0110' name='PQRS_Group_CKD_0110' type='checkbox' value='1' >
<label for='PQRS_Group_CKD_0110' > PQRS_Group_CKD_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CKD_0121' name='PQRS_Group_CKD_0121' type='checkbox' value='1' >
<label for='PQRS_Group_CKD_0121' > PQRS_Group_CKD_0121 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CKD_0122' name='PQRS_Group_CKD_0122' type='checkbox' value='1' >
<label for='PQRS_Group_CKD_0122' > PQRS_Group_CKD_0122 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CKD_0130' name='PQRS_Group_CKD_0130' type='checkbox' value='1' >
<label for='PQRS_Group_CKD_0130' > PQRS_Group_CKD_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_CKD_0226' name='PQRS_Group_CKD_0226' type='checkbox' value='1' >
<label for='PQRS_Group_CKD_0226' > PQRS_Group_CKD_0226 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0047' name='PQRS_Group_COPD_0047' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0047' > PQRS_Group_COPD_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0051' name='PQRS_Group_COPD_0051' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0051' > PQRS_Group_COPD_0051 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0052' name='PQRS_Group_COPD_0052' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0052' > PQRS_Group_COPD_0052 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0110' name='PQRS_Group_COPD_0110' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0110' > PQRS_Group_COPD_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0111' name='PQRS_Group_COPD_0111' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0111' > PQRS_Group_COPD_0111 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0130' name='PQRS_Group_COPD_0130' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0130' > PQRS_Group_COPD_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_COPD_0226' name='PQRS_Group_COPD_0226' type='checkbox' value='1' >
<label for='PQRS_Group_COPD_0226' > PQRS_Group_COPD_0226 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0047' name='PQRS_Group_Dementia_0047' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0047' > PQRS_Group_Dementia_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0280' name='PQRS_Group_Dementia_0280' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0280' > PQRS_Group_Dementia_0280 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0281' name='PQRS_Group_Dementia_0281' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0281' > PQRS_Group_Dementia_0281 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0282' name='PQRS_Group_Dementia_0282' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0282' > PQRS_Group_Dementia_0282 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0283' name='PQRS_Group_Dementia_0283' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0283' > PQRS_Group_Dementia_0283 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0284' name='PQRS_Group_Dementia_0284' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0284' > PQRS_Group_Dementia_0284 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0285' name='PQRS_Group_Dementia_0285' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0285' > PQRS_Group_Dementia_0285 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0286' name='PQRS_Group_Dementia_0286' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0286' > PQRS_Group_Dementia_0286 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0287' name='PQRS_Group_Dementia_0287' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0287' > PQRS_Group_Dementia_0287 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Dementia_0288' name='PQRS_Group_Dementia_0288' type='checkbox' value='1' >
<label for='PQRS_Group_Dementia_0288' > PQRS_Group_Dementia_0288 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Diabetes_0001' name='PQRS_Group_Diabetes_0001' type='checkbox' value='1' >
<label for='PQRS_Group_Diabetes_0001' > PQRS_Group_Diabetes_0001 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Diabetes_0110' name='PQRS_Group_Diabetes_0110' type='checkbox' value='1' >
<label for='PQRS_Group_Diabetes_0110' > PQRS_Group_Diabetes_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Diabetes_0117' name='PQRS_Group_Diabetes_0117' type='checkbox' value='1' >
<label for='PQRS_Group_Diabetes_0117' > PQRS_Group_Diabetes_0117 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Diabetes_0119' name='PQRS_Group_Diabetes_0119' type='checkbox' value='1' >
<label for='PQRS_Group_Diabetes_0119' > PQRS_Group_Diabetes_0119 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Diabetes_0163' name='PQRS_Group_Diabetes_0163' type='checkbox' value='1' >
<label for='PQRS_Group_Diabetes_0163' > PQRS_Group_Diabetes_0163 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Diabetes_0226' name='PQRS_Group_Diabetes_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Diabetes_0226' > PQRS_Group_Diabetes_0226 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0130' name='PQRS_Group_General_Surgery_0130' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0130' > PQRS_Group_General_Surgery_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0226' name='PQRS_Group_General_Surgery_0226' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0226' > PQRS_Group_General_Surgery_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0354' name='PQRS_Group_General_Surgery_0354' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0354' > PQRS_Group_General_Surgery_0354 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0355' name='PQRS_Group_General_Surgery_0355' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0355' > PQRS_Group_General_Surgery_0355 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0356' name='PQRS_Group_General_Surgery_0356' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0356' > PQRS_Group_General_Surgery_0356 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0357' name='PQRS_Group_General_Surgery_0357' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0357' > PQRS_Group_General_Surgery_0357 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_General_Surgery_0358' name='PQRS_Group_General_Surgery_0358' type='checkbox' value='1' >
<label for='PQRS_Group_General_Surgery_0358' > PQRS_Group_General_Surgery_0358 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0084' name='PQRS_Group_HepatitisC_0084' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0084' > PQRS_Group_HepatitisC_0084 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0085' name='PQRS_Group_HepatitisC_0085' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0085' > PQRS_Group_HepatitisC_0085 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0087' name='PQRS_Group_HepatitisC_0087' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0087' > PQRS_Group_HepatitisC_0087 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0130' name='PQRS_Group_HepatitisC_0130' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0130' > PQRS_Group_HepatitisC_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0183' name='PQRS_Group_HepatitisC_0183' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0183' > PQRS_Group_HepatitisC_0183 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0226' name='PQRS_Group_HepatitisC_0226' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0226' > PQRS_Group_HepatitisC_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0390' name='PQRS_Group_HepatitisC_0390' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0390' > PQRS_Group_HepatitisC_0390 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HepatitisC_0401' name='PQRS_Group_HepatitisC_0401' type='checkbox' value='1' >
<label for='PQRS_Group_HepatitisC_0401' > PQRS_Group_HepatitisC_0401 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HF_0005' name='PQRS_Group_HF_0005' type='checkbox' value='1' >
<label for='PQRS_Group_HF_0005' > PQRS_Group_HF_0005 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HF_0008' name='PQRS_Group_HF_0008' type='checkbox' value='1' >
<label for='PQRS_Group_HF_0008' > PQRS_Group_HF_0008 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HF_0047' name='PQRS_Group_HF_0047' type='checkbox' value='1' >
<label for='PQRS_Group_HF_0047' > PQRS_Group_HF_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HF_0110' name='PQRS_Group_HF_0110' type='checkbox' value='1' >
<label for='PQRS_Group_HF_0110' > PQRS_Group_HF_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HF_0130' name='PQRS_Group_HF_0130' type='checkbox' value='1' >
<label for='PQRS_Group_HF_0130' > PQRS_Group_HF_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HF_0226' name='PQRS_Group_HF_0226' type='checkbox' value='1' >
<label for='PQRS_Group_HF_0226' > PQRS_Group_HF_0226 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0047' name='PQRS_Group_HIVAIDS_0047' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0047' > PQRS_Group_HIVAIDS_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0134' name='PQRS_Group_HIVAIDS_0134' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0134' > PQRS_Group_HIVAIDS_0134 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0160' name='PQRS_Group_HIVAIDS_0160' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0160' > PQRS_Group_HIVAIDS_0160 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0205' name='PQRS_Group_HIVAIDS_0205' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0205' > PQRS_Group_HIVAIDS_0205 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0226' name='PQRS_Group_HIVAIDS_0226' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0226' > PQRS_Group_HIVAIDS_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0338' name='PQRS_Group_HIVAIDS_0338' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0338' > PQRS_Group_HIVAIDS_0338 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0339' name='PQRS_Group_HIVAIDS_0339' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0339' > PQRS_Group_HIVAIDS_0339 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_HIVAIDS_0340' name='PQRS_Group_HIVAIDS_0340' type='checkbox' value='1' >
<label for='PQRS_Group_HIVAIDS_0340' > PQRS_Group_HIVAIDS_0340 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0110' name='PQRS_Group_IBD_0110' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0110' > PQRS_Group_IBD_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0111' name='PQRS_Group_IBD_0111' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0111' > PQRS_Group_IBD_0111 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0226' name='PQRS_Group_IBD_0226' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0226' > PQRS_Group_IBD_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0270' name='PQRS_Group_IBD_0270' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0270' > PQRS_Group_IBD_0270 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0271' name='PQRS_Group_IBD_0271' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0271' > PQRS_Group_IBD_0271 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0274' name='PQRS_Group_IBD_0274' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0274' > PQRS_Group_IBD_0274 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_IBD_0275' name='PQRS_Group_IBD_0275' type='checkbox' value='1' >
<label for='PQRS_Group_IBD_0275' > PQRS_Group_IBD_0275 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0071' name='PQRS_Group_Oncology_0071' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0071' > PQRS_Group_Oncology_0071 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0072' name='PQRS_Group_Oncology_0072' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0072' > PQRS_Group_Oncology_0072 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0110' name='PQRS_Group_Oncology_0110' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0110' > PQRS_Group_Oncology_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0130' name='PQRS_Group_Oncology_0130' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0130' > PQRS_Group_Oncology_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0143' name='PQRS_Group_Oncology_0143' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0143' > PQRS_Group_Oncology_0143 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0144' name='PQRS_Group_Oncology_0144' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0144' > PQRS_Group_Oncology_0144 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Oncology_0226' name='PQRS_Group_Oncology_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Oncology_0226' > PQRS_Group_Oncology_0226 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_OPEIR_0359' name='PQRS_Group_OPEIR_0359' type='checkbox' value='1' >
<label for='PQRS_Group_OPEIR_0359' > PQRS_Group_OPEIR_0359 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_OPEIR_0360' name='PQRS_Group_OPEIR_0360' type='checkbox' value='1' >
<label for='PQRS_Group_OPEIR_0360' > PQRS_Group_OPEIR_0360 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_OPEIR_0361' name='PQRS_Group_OPEIR_0361' type='checkbox' value='1' >
<label for='PQRS_Group_OPEIR_0361' > PQRS_Group_OPEIR_0361 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_OPEIR_0362' name='PQRS_Group_OPEIR_0362' type='checkbox' value='1' >
<label for='PQRS_Group_OPEIR_0362' > PQRS_Group_OPEIR_0362 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_OPEIR_0363' name='PQRS_Group_OPEIR_0363' type='checkbox' value='1' >
<label for='PQRS_Group_OPEIR_0363' > PQRS_Group_OPEIR_0363 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_OPEIR_0364' name='PQRS_Group_OPEIR_0364' type='checkbox' value='1' >
<label for='PQRS_Group_OPEIR_0364' > PQRS_Group_OPEIR_0364 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0047' name='PQRS_Group_Parkinsons_0047' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0047' > PQRS_Group_Parkinsons_0047 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0289' name='PQRS_Group_Parkinsons_0289' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0289' > PQRS_Group_Parkinsons_0289 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0290' name='PQRS_Group_Parkinsons_0290' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0290' > PQRS_Group_Parkinsons_0290 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0291' name='PQRS_Group_Parkinsons_0291' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0291' > PQRS_Group_Parkinsons_0291 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0292' name='PQRS_Group_Parkinsons_0292' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0292' > PQRS_Group_Parkinsons_0292 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0293' name='PQRS_Group_Parkinsons_0293' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0293' > PQRS_Group_Parkinsons_0293 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Parkinsons_0294' name='PQRS_Group_Parkinsons_0294' type='checkbox' value='1' >
<label for='PQRS_Group_Parkinsons_0294' > PQRS_Group_Parkinsons_0294 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0039' name='PQRS_Group_Preventive_0039' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0039' > PQRS_Group_Preventive_0039 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0048' name='PQRS_Group_Preventive_0048' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0048' > PQRS_Group_Preventive_0048 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0110' name='PQRS_Group_Preventive_0110' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0110' > PQRS_Group_Preventive_0110 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0111' name='PQRS_Group_Preventive_0111' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0111' > PQRS_Group_Preventive_0111 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0112' name='PQRS_Group_Preventive_0112' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0112' > PQRS_Group_Preventive_0112 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0113' name='PQRS_Group_Preventive_0113' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0113' > PQRS_Group_Preventive_0113 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0128' name='PQRS_Group_Preventive_0128' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0128' > PQRS_Group_Preventive_0128 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0134' name='PQRS_Group_Preventive_0134' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0134' > PQRS_Group_Preventive_0134 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Preventive_0226' name='PQRS_Group_Preventive_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Preventive_0226' > PQRS_Group_Preventive_0226 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0108' name='PQRS_Group_RA_0108' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0108' > PQRS_Group_RA_0108 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0128' name='PQRS_Group_RA_0128' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0128' > PQRS_Group_RA_0128 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0131' name='PQRS_Group_RA_0131' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0131' > PQRS_Group_RA_0131 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0176' name='PQRS_Group_RA_0176' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0176' > PQRS_Group_RA_0176 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0177' name='PQRS_Group_RA_0177' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0177' > PQRS_Group_RA_0177 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0178' name='PQRS_Group_RA_0178' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0178' > PQRS_Group_RA_0178 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0179' name='PQRS_Group_RA_0179' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0179' > PQRS_Group_RA_0179 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_RA_0180' name='PQRS_Group_RA_0180' type='checkbox' value='1' >
<label for='PQRS_Group_RA_0180' > PQRS_Group_RA_0180 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sinusitis_0130' name='PQRS_Group_Sinusitis_0130' type='checkbox' value='1' >
<label for='PQRS_Group_Sinusitis_0130' > PQRS_Group_Sinusitis_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sinusitis_0131' name='PQRS_Group_Sinusitis_0131' type='checkbox' value='1' >
<label for='PQRS_Group_Sinusitis_0131' > PQRS_Group_Sinusitis_0131 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sinusitis_0226' name='PQRS_Group_Sinusitis_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Sinusitis_0226' > PQRS_Group_Sinusitis_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sinusitis_0331' name='PQRS_Group_Sinusitis_0331' type='checkbox' value='1' >
<label for='PQRS_Group_Sinusitis_0331' > PQRS_Group_Sinusitis_0331 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sinusitis_0332' name='PQRS_Group_Sinusitis_0332' type='checkbox' value='1' >
<label for='PQRS_Group_Sinusitis_0332' > PQRS_Group_Sinusitis_0332 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sinusitis_0333' name='PQRS_Group_Sinusitis_0333' type='checkbox' value='1' >
<label for='PQRS_Group_Sinusitis_0333' > PQRS_Group_Sinusitis_0333 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0128' name='PQRS_Group_Sleep_Apnea_0128' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0128' > PQRS_Group_Sleep_Apnea_0128 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0130' name='PQRS_Group_Sleep_Apnea_0130' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0130' > PQRS_Group_Sleep_Apnea_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0226' name='PQRS_Group_Sleep_Apnea_0226' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0226' > PQRS_Group_Sleep_Apnea_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0276' name='PQRS_Group_Sleep_Apnea_0276' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0276' > PQRS_Group_Sleep_Apnea_0276 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0277' name='PQRS_Group_Sleep_Apnea_0277' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0277' > PQRS_Group_Sleep_Apnea_0277 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0278' name='PQRS_Group_Sleep_Apnea_0278' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0278' > PQRS_Group_Sleep_Apnea_0278 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_Sleep_Apnea_0279' name='PQRS_Group_Sleep_Apnea_0279' type='checkbox' value='1' >
<label for='PQRS_Group_Sleep_Apnea_0279' > PQRS_Group_Sleep_Apnea_0279 </label>
</span>
  </TD
 </TR>
 <TR> 
  <TD>
<span class= 'checkbox-button'>
<input id= 'PQRS_Group_TKR_0130' name='PQRS_Group_TKR_0130' type='checkbox' value='1' >
<label for='PQRS_Group_TKR_0130' > PQRS_Group_TKR_0130 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_TKR_0226' name='PQRS_Group_TKR_0226' type='checkbox' value='1' >
<label for='PQRS_Group_TKR_0226' > PQRS_Group_TKR_0226 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_TKR_0350' name='PQRS_Group_TKR_0350' type='checkbox' value='1' >
<label for='PQRS_Group_TKR_0350' > PQRS_Group_TKR_0350 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_TKR_0351' name='PQRS_Group_TKR_0351' type='checkbox' value='1' >
<label for='PQRS_Group_TKR_0351' > PQRS_Group_TKR_0351 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_TKR_0352' name='PQRS_Group_TKR_0352' type='checkbox' value='1' >
<label for='PQRS_Group_TKR_0352' > PQRS_Group_TKR_0352 </label>
</span>

<span class= 'checkbox-button'>
<input id= 'PQRS_Group_TKR_0353' name='PQRS_Group_TKR_0353' type='checkbox' value='1' >
<label for='PQRS_Group_TKR_0353' > PQRS_Group_TKR_0353 </label>
</span>
  </TD
 </TR>
</table>
</body
</html>