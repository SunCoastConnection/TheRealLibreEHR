
<?php
include_once("../../interface/globals.php");
include_once("$srcdir/api.inc");

$user_id=$_SESSION['authUserID'];
$currenttime = date("Y-m-d H:i:s");

$Query = "SELECT MAX(datetime)as timelast from timeclock where user = '$user_id';"; 
$lastres =sqlQuery($Query);
$lasttime = $lastres['timelast'];

IF ($lasttime!=''){
$Query = "SELECT * from timeclock where user = '$user_id' and datetime = '$lasttime';";
$punchrow = sqlStatement($Query);

$row = SqlFetchArray($punchrow);
$lastdatetime = $row['datetime'];
$laststatus = $row['status'];
echo "Your last punchtime was at &nbsp;".$lastdatetime."&nbsp;and you punched &nbsp;<b>".$laststatus."</b><BR>";
}
?>
<html>
<title>TimeClock Punch</title>
<BR>
<BR>

<form method="post" action="time.php" name="theform">

<input type='hidden' name='form_refresh' id='form_refresh' value='save'/>
    <?php if ($row['status']=="IN"){?>
    <label for='date'>Punch OUT:</label>
    <input id="date" type="date" name="date" value='<?php echo date("Y-m-d");?>'>
    <input id="time" type="time" name="time" value='<?php echo date("H:i:s");?>'>
    <BR>
    <BR>

    <textarea id="note" name="note" rows="4" cols="50" placeholder="Notes:"></textarea>
    <input type='hidden' name='status' id='status' value='OUT'>
    <?php }else{ ?>
           <label for='date'>Punch IN:</label>
    <input id="date" type="date" name="date" value='<?php echo date("Y-m-d");?>'>
    <input id="time" type="time" name="time" value='<?php echo date("H:i:s");?>'>
    <BR>
    <BR>
    <textarea id="note" name="note" rows="4" cols="50" placeholder="Notes:"></textarea>
    <input type='hidden' name='status' id='status' value='IN'>
    <BR>

    <?php
    }
    ?>

  <div style='margin-left:15px'>
	<input type="submit" value="Punch IT!">
	</span>
	</a>
<BR>
	</div>
<?php
  if ($_POST['form_refresh']) {
      $newdatetime = $_POST['date'].' '.$_POST['time'];
      $status =$_POST['status'];
      $note = addslashes($_POST['note']);
      IF ($laststatus == 'IN'){
             $date1 = new DateTime($lastdatetime);
             $date2   = new DateTime($newdatetime); 
             $elapsedtime = $date2->getTimestamp() - $date1->getTimestamp();
             //echo $elapsedtime;
      }
      else{$elapsedtime = 0;}  
   $insert = "INSERT INTO timeclock (user,datetime,status,period,note) VALUES ('".$user_id."','".$newdatetime."','".$status."','".$elapsedtime."','".$note."');";
   sqlStatement($insert);
   echo "Punched &nbsp;". $_POST['status']."&nbsp; at &nbsp;".$newdatetime; 

      }
?>
  </form>