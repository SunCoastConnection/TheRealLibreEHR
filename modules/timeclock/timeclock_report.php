<?php


  require_once("../../interface/globals.php");
  //require_once("$srcdir/acl.inc");
  require_once("$srcdir/formatting.inc.php");
  require_once "$srcdir/options.inc.php";
  require_once "$srcdir/formdata.inc.php";

  //if (! acl_check('acct', 'rep')) die(xl("Unauthorized access."));




  $form_from_date  = fixDate($_POST['form_from_date'], date('Y-m-01'));
  $form_to_date    = fixDate($_POST['form_to_date'], date('Y-m-d'));

?>
<html>
<head>
<style type="text/css">
/* specifically include & exclude from printing */
@media print {
    #report_parameters {
        visibility: hidden;
        display: none;
    }
    #report_parameters_daterange {
        visibility: visible;
        display: inline;
    }
    #report_results {
       margin-top: 30px;
    }
}

/* specifically exclude some from the screen */
@media screen {      N
    #report_parameters_daterange {
        visibility: hidden;
        display: none;
    }
}
</style>
<title><?php xl('Timeclock Report','e')?></title>
</head>

<body class="body_top">


<form method='post' action='timeclock_report.php' id='theform'>

<div id="report_parameters">

<input type='hidden' name='form_refresh' id='form_refresh' value=''/>

<table>
 <tr>
  <td width='660px'>
	<div style='float:left'>

	<table class='text'>
		<tr>

			<td class='label'>
			   <?php xl('Provider','e'); ?>:
			</td>
			<td>
				<?php
				//if (acl_check('acct', 'rep_a')) {
					// Build a drop-down list of providers.
					//
					$query = "select id, lname, fname from users where " .
						"active = 1 AND password ='NoLongerUsed' order by lname, fname";
					$res = sqlStatement($query);
					echo "   &nbsp;<select name='form_doctor'>\n";
					echo "    <option value=''>-- " . xl('All Providers', 'e') . " --\n";
					while ($row = sqlFetchArray($res)) {
						$provid = $row['id'];
						echo "    <option value='$provid'";
						if ($provid == $_POST['form_doctor']) echo " selected";
						echo ">" . $row['lname'] . ", " . $row['fname'] . "\n";
					}
					echo "   </select>\n";
				//} else {
					//echo "<input type='hidden' name='form_doctor' value='" . $_SESSION['authUserID'] . "'>";
				//}
			?>
			</td>

		</tr>
		<tr>
			<td class='label'>
			   <?php xl('From','e'); ?>:
			</td>
			<td>
			   <input type='text' name='form_from_date' id="form_from_date" size='10' value='<?php  echo $form_from_date; ?>'
				title='Start Date' >
			   <img src='../../interface/pic/show_calendar.gif' align='absbottom' width='24' height='22'
				id='img_from_date' border='0' alt='[?]' style='cursor:pointer'
				title='<?php xl('Click here to choose a date','e'); ?>'>
			</td>
			<td class='label'>
			   <?php xl('To','e'); ?>:
			</td>
			<td>
			   <input type='text' name='form_to_date' id="form_to_date" size='10' value='<?php  echo $form_to_date; ?>'
				title='End Date' >
			   <img src='../../interface/pic/show_calendar.gif' align='absbottom' width='24' height='22'
				id='img_to_date' border='0' alt='[?]' style='cursor:pointer'
				title='<?php xl('Click here to choose a date','e'); ?>'>
			</td>
			<td>&nbsp;</td>
		</tr>
		

	</table>

	</div>

  </td>
  <td align='left' valign='middle' height="100%">
	<table style='border-left:1px solid; width:100%; height:100%' >
		<tr>
			<td>
				<div style='margin-left:15px'>
					<a href='#' class='css_button' onclick='$("#form_refresh").attr("value","true"); $("#theform").submit();'>
					<span>
						<?php xl('Submit','e'); ?>
					</span>
					</a>

					<?php if ($_POST['form_refresh']) { ?>
					<a href='#' class='css_button' onclick='window.print()'>
						<span>
							<?php xl('Print','e'); ?>
						</span>
					</a>
					<?php } ?>
				</div>
			</td>
		</tr>
	</table>
  </td>
 </tr>
</table>
</div>

<?php
 if ($_POST['form_refresh']) {
?>
<div id="report_results">
<table border='0' cellpadding='1' cellspacing='2' width='98%'>
 <thead>
  <th>
   <?php xl('Practitioner','e') ?>
  </th>
  <th>
   <?php xl('Punch Time','e') ?>
  </th>
    <th>
   <?php xl('Time Entered','e') ?>
  </th>
  <th>
   <?php xl('Status','e') ?>
  </th>

  <th>
   <?php xl('Notes','e') ?>
  </th>
   <th align='right'>
   <?php xl('Seconds','e') ?>
  </th>
 </thead>
<?php
  if ($_POST['form_refresh']) {
    $form_doctor = $_POST['form_doctor'];
    $arows = array();

      $ids_to_skip = array();
      $irow = 0;

    

    
      $query = "SELECT  t.id,t.user,t.datetime,t.edit,t.status,t.period,t.note FROM timeclock t " .
        "WHERE t.datetime >= '$form_from_date 00:00:00' AND t.datetime <= '$form_to_date 23:59:59'" ;
      if ($form_doctor) {
        $query .= " AND t.user = '$form_doctor' ";
      }
      $query.= "ORDER BY t.user, t.datetime;";
      /**************************************************************/
      //
      $res = sqlStatement($query);
      while ($row = sqlFetchArray($res)) {

        $docid =$row['user'];
        $datetime = $row['datetime'];
        $edit = $row['edit'];
        $status = $row['status'];
        $note = $row['note'];
        $period = $row['period'];

        
        $key = sprintf("%u%s", $docid, $datetime, ++$irow);
        $arows[$key] = array();
        $arows[$key]['docid'] = $docid;
        $arows[$key]['datetime'] = $datetime;
        $arows[$key]['edit'] = $edit;
        $arows[$key]['status'] = $status;
        $arows[$key]['note'] = $row['note'];
        $arows[$key]['period'] = $row['period'];


      } // end while
        $tmp = sqlQuery("SELECT lname, fname FROM users WHERE id = '$docid'");
        $docname =  $tmp['fname'] . ' ' . $tmp['lname'];

    

    ksort($arows);
    $docid = 0;

    foreach ($arows as $row) {
      $docid =0;
      $datetime =0;
      $edit =0;
      $status ="";
      $note="";
      $period =0;

  
        $docid =$row['docid'];
        $datetime = $row['datetime'];
        $edit = $row['edit'];
        $status = $row['status'];
        $note = $row['note'];
        $period = $row['period'];
        
      
       
?>
  <td class="detail">
   <?php echo $docname; ?>
  </td>

  <td class="detail">
   <?php echo $datetime; ?>
  </td>

  <td class="detail">
   <?php echo $edit; ?>
  </td>
    <td class="detail">
   <?php echo $status; ?>
  </td>
    <td class="detail" align="right">
   <?php echo htmlspecialchars(stripslashes($note)); ?>
  </td>
  <td class="detail" align="right">
   <?php echo $period; ?>
  </td>



 </tr>
<?php
     
      $doctotal   += $period;

      

      
    }
    
    
?>

 <tr bgcolor="#ddddff">
  <td class="detail" colspan="5">
   <?php echo 'Totals for &nbsp' . $docname .'&nbsp in minutes:';?>
  </td>
  <td align="right">
   <?php IF ($doctotal > 0){ echo($doctotal/60);}else{echo $doctotal;} ?>
  </td>

 </tr>


<?php
  }

?>

</table>
</div>
<?php } else { ?>
<div class='text'>
 	<?php echo xl('Please input search criteria above, and click Submit to view results.', 'e' ); ?>
</div>
<?php } ?>

</form>
</body>

<!-- stuff for the popup calendar -->
<link rel='stylesheet' href='<?php echo $css_header ?>' type='text/css'>
<style type="text/css">@import url(../../library/dynarch_calendar.css);</style>
<script type="text/javascript" src="../../library/dynarch_calendar.js"></script>
<?php include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php"); ?>
<script type="text/javascript" src="../../library/dynarch_calendar_setup.js"></script>
<script type="text/javascript" src="../../library/js/jquery.1.3.2.js"></script>

<script language="Javascript">
 Calendar.setup({inputField:"form_from_date", ifFormat:"%Y-%m-%d", button:"img_from_date"});
 Calendar.setup({inputField:"form_to_date", ifFormat:"%Y-%m-%d", button:"img_to_date"});
</script>

</html>
