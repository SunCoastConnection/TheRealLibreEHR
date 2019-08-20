<?php

$fake_register_globals=false;
$sanitize_all_escapes=true;

include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/headers.inc.php");
formHeader("Patient Care Plan Form");
$returnurl = 'encounter_top.php';
<<<<<<< HEAD
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
if ($formid) {
    $sql = "SELECT * FROM `form_patient_care_plan` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));

    for ($iter = 0; $row = sqlFetchArray($res); $iter++)
        $all[$iter] = $row;
    $check_res = $all;
}

$check_res = $formid ? $check_res : array();
=======
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
?>
<html>
	<head>
		<?php html_header_show();?>
		<?php call_required_libraries(['bootstrap', 'jquery-min-1-9-1', 'font-awesome']); ?>
		<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
		<style>
			.col-sm-6 ,.col-md-3{
				padding-left: 3px;
				padding-right: 3px;
			}
<<<<<<< HEAD
			input:focus, textarea:focus, select:focus {
=======
			input type="number":focus, textarea:focus, select:focus {
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
				border-color: #ca1278 !important;
				border-width: 2px !important;
			}
		</style>
	</head>
<<<<<<< HEAD
<body>
	<form class="form-inline" method=post action="<?php echo $rootdir;?>/forms/patient_care_plan/save.php?mode=update&id=<?php echo attr($formid);?>" name="my_form" onsubmit="return top.restoreSession()">
		<div class="row">
			<div class="col-md-4">
				<!-- Save/Cancel buttons -->
				<input type="submit" id="save" class="btn btn-success" value="<?php echo xla('Save'); ?>"> &nbsp;
				<input type="button" id="dontsave" class="deleter btn btn-danger" value="<?php echo xla('Cancel'); ?>"> &nbsp;
			</div>
		</div>
		<div class="form_issue">
			<?php
            if (!empty($check_res)) {
                foreach ($check_res as $key => $obj) {
                    ?>	
				<div style="padding:30px" id="div_<?php echo $key + 1; ?>">
				
					<input type="hidden" name="status[]"  value="1">
					<input type="hidden" class="hidden" name="count[]" value="1">
					<div class="form-group">
					    <label >Key Issue</label>
					    <input type="text" name="Key_issue[]" class="form-control" value="<?php echo text($obj{"Key_issue"}); ?>" placeholder="Key issue">
					</div>
					<div class="form-group">
					    <label  for="Interventions">Interventions</label>
					    <textarea name="Interventions[]" class="form-control"  placeholder="Interventions"><?php echo text($obj{"Interventions"}); ?></textarea>
					</div>
					<div class="form-group">
					    <label >Outcome</label>
					    <textarea name="Outcome[]" class="form-control"  placeholder="Outcome"><?php echo text($obj{"Outcome"}); ?></textarea>
					</div>
					<div class="form-group">
					    <label >Goal</label>
					    <textarea name="Goal[]" class="form-control" placeholder="Goal"><?php echo text($obj{"Goal"}); ?></textarea>

					</div>
					<div class="form-group">
					    <label >Progress</label>
					    <textarea name="Progress[]" class="form-control" placeholder="Progress"><?php echo text($obj{"Progress"}); ?></textarea>
					</div>
					<div>
						<span style="background-color:#5ac3ca;padding: 5px;color: white;border-radius: 20px" onclick="addIssue(this)">Add Issue</span>
						<span style="background-color:#5ac3ca;padding: 5px;color: white;border-radius: 20px" onclick="addIntervention(this)">Add Intervention</span>
	                	<span style="background-color:#750404;padding: 5px;color: white; border-radius: 20px;" onclick="deactivateIssue(this)">de-activate Issue</span>
					</div>
					<hr>
				</div>
		<?php
            }
        }?>
		</div>

	</form>

	<script type="text/javascript">
		var count = 1; 
=======
	<body>
		<?php
			include_once("$srcdir/api.inc");
			$res2 = sqlStatement("SELECT MAX(id) as largestId FROM `form_patient_care_plan`");
    		$getMaxid = sqlFetchArray($res2);
			$obj = formFetch("form_patient_care_plan", $_GET["id"]);

			if ($getMaxid['largestId']) {
				$count = $getMaxid['largestId'] + 1 ;
				$html = "<input type=\"hidden\" id=\"num\" value=" . $count . " />";
				echo $html;
		        
		    } else {
		        // echo "<input type=\"hidden\" id=\"num\" value=\"1\" />";
    		}
		?>
		<form class="form-horizontal" method=post action="<?php echo $rootdir;?>/forms/patient_care_plan/save.php?mode=update&id=<?php echo attr($_GET["id"]);?>" name="my_form" onsubmit="return top.restoreSession()">
			<div class="row">
					<!-- Save/Cancel buttons -->
				<input type="submit" id="save" class='btn btn-success' value="<?php echo xla('Save'); ?>"> &nbsp;
				<input type="button" id="dontsave" class="deleter btn btn-danger" value="<?php echo xla('Cancel'); ?>"> &nbsp;
			</div>
		</form>

		<script type="text/javascript">
		var count = $('#num').val();
		console.log(count); 
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
		function addIntervention(currentIssueNumber ) {
			let intervention = createInterventionHtml(currentIssueNumber);
			$(`.intervention_${currentIssueNumber}`).prepend(intervention);
		}
		
		function addIssue() {
			let newIssue = newIssueHtml();
			$('.addIssue').prepend(newIssue);

		}
		function deactivateIssue(issueNumber) {
			$(`.status_${issueNumber}`).attr("value", "0");
			$(`#row_${issueNumber}`).css("background-color", "#c5c5bc");
			$(`#row_${issueNumber}`).find("input, textarea").attr("readonly","readonly");
		}
		function newIssueHtml() {
			count++;
			return `<tr id="row_${count}">
					  	<td>
					  		<mark>${count}</mark>
					  		<a href="#" ><span style="color: #337ab7" onclick="addIntervention(${count})" class="glyphicon glyphicon-plus-sign" title="Add Interventions"></span> </a>
					  		<a href="#"><span style="color: red" onclick="deactivateIssue(${count})" class="glyphicon glyphicon-ban-circle" title="Deactivate Issue"></span> </a> 
					  	</td>
					  	<td><input type="text" name="issue[]" placeholder="key issue"></td>
					  	<input type="hidden" class="status_${count}" name="status[]" value="1">
					  	<input type="hidden"  name="count[]" value="${count}">
					  	<td>
					      <table>
					      	<thead>
					      		<tr>
								   <th>Intervention</th>
								   <th>Outcome</th> 
								   <th>Goal</th>
								   <th>Progress</th>
								</tr>
					      	</thead>
					      	<tbody class="intervention_${count}">
					      		<tr>
						          	<td><textarea name="intervention_${count}[]"></textarea></td>
								    <td><textarea name="outcome_${count}[]"></textarea></td>
								    <td><textarea name="goal_${count}[]"></textarea></td>
								    <td><textarea name="progress_${count}[]"></textarea></td>   
						        </tr>
					      	</tbody>   
					      </table>
					    </td>
				  </tr>
				  `
		}

		function createInterventionHtml(issue_number){
			return `<tr>
					    <td><textarea name="intervention_${count}[]"></textarea></td>
					    <td><textarea name="outcome_${count}[]"></textarea></td>
					    <td><textarea name="goal_${count}[]"></textarea></td>
					    <td><textarea name="progress_${count}[]"></textarea></td>  
				    </tr>
				 `
		}

		function beforeSubmit() {
			var intervention = new Array();
			var outcome = new Array();
			var goal = new Array();
			var progress = new Array();
			for (var i = 1; i <= count; i++){
				let int = $(`textarea[name='intervention_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	intervention.push(JSON.stringify(int));

              	 let out = $(`textarea[name='outcome_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	outcome.push(JSON.stringify(out));

              	 let gol = $(`textarea[name='goal_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	goal.push(JSON.stringify(gol));

              	 let prog = $(`textarea[name='progress_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	progress.push(JSON.stringify(prog));

			}

			objectIntervention = {"intervention": intervention};
			objectOutcome = {"outcome": outcome};
			objectGoal = {"goal": goal};
			objectProgress = {"progress": progress};
			console.log(JSON.stringify(objectIntervention));

			$('textarea[name="Interventions"]').val(JSON.stringify(objectIntervention));
            $('textarea[name="Outcome"]').val(JSON.stringify(objectOutcome));
            $('textarea[name="Goal"]').val(JSON.stringify(objectGoal));
            $('textarea[name="Progress"]').val(JSON.stringify(objectProgress));

		}
	</script>
<<<<<<< HEAD
</body>
=======

	</body>
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
</html>