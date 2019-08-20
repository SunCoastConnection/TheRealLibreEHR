<?php

$fake_register_globals=false;
$sanitize_all_escapes=true;

include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/headers.inc.php");
formHeader("Education Form");
$returnurl = 'encounter_top.php';
?>
<html>
	<head>
		<?php html_header_show();?>
		<?php call_required_libraries(['bootstrap', 'jquery-min-1-9-1', 'font-awesome']); ?>
		<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
		<style>
			table, th, td {
			  border: 0px;
			  border-collapse: collapse;
			}
			th, td {
			  padding: 5px;
			  text-align: left;    
			}
			.col-sm-6 ,.col-md-3{
				padding-left: 3px;
				padding-right: 3px;
			}
			input:focus, textarea:focus, select:focus {
				border-color: #ca1278 !important;
				border-width: 2px !important;
			}
		</style>
	</head>
<body>
	<form method=post action="<?php echo $rootdir;?>/forms/education/save.php?mode=new" name="my_form" onsubmit="beforeSubmit(); return top.restoreSession()">
		<div class="row">
			<div class="col-md-4">
				<!-- Save/Cancel buttons -->
				<input type="submit" id="save" class="btn btn-success" value="<?php echo xla('Save'); ?>"> &nbsp;
				<input type="button" id="dontsave" class="deleter btn btn-danger" value="<?php echo xla('Cancel'); ?>"> &nbsp;
			</div>
		</div>
		
		<table style="width:100%">
			<thead>
				<tr>
				    <th>Topic #</th>
<<<<<<< HEAD
				    <th>Education Topic <span><a href="#" ><span title="add topic" onclick="addIssue()" style="color: #337ab7" class="glyphicon glyphicon-plus-sign"></span></a></span></th> 
=======
				    <th>Education Topic <span><a href="#" ><span title="add topic" onclick="addTopic()" style="color: #337ab7" class="glyphicon glyphicon-plus-sign"></span></a></span></th> 
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
				    <th>Learners </th> 
				    <th>Remarks </th> 
		 	 	</tr>
			</thead>

<<<<<<< HEAD
			<tbody class="addIssue">
				<tr id="row_1">
				  	<td>
				  		<mark>1</mark>
				  		<a href="#" ><span style="color: #337ab7" onclick="addIntervention(1)" class="glyphicon glyphicon-plus-sign" title="Add Learner"></span> </a>
=======
			<tbody class="addTopic">
				<tr id="row_1">
				  	<td>
				  		<mark>1</mark>
				  		<a href="#" ><span style="color: #337ab7" onclick="addLearner(1)" class="glyphicon glyphicon-plus-sign" title="Add Learner"></span> </a>
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
				  		<a href="#"><span style="color: red" onclick="inactivateLearner(1)" class="glyphicon glyphicon-ban-circle" title="inactivate learner"></span> </a> 
				  	</td>
				  	<td><input type="text" name="topic[]" placeholder="Education topic"></td>
				  	<input type="hidden" class="status_1" name="status[]" value="1">
				  	<input type="hidden"  name="count[]" value="1">
				  	<td>
				      <table>
				      	<thead>
				      		<tr>
							   <th>Learners</th>
							   <th>Learner's Readiness for Education</th> 
							   <th>Method of Education</th>
							   <th>Response to Eduction</th>
							   <th>Further interventions Needed</th>
							</tr>
				      	</thead>
<<<<<<< HEAD
				      	<tbody class="intervention_1">
				      		<tr>
					          <td><textarea name="intervention_1[]"></textarea></td>
					          <td><textarea name="outcome_1[]"></textarea></td>
					          <td><textarea name="goal_1[]"></textarea></td>
					          <td><textarea name="progress_1[]"></textarea></td>  
					          <td><textarea name="progress_1[]"></textarea></td>  
=======
				      	<tbody class="learner_1">
				      		<tr>
					          <td><textarea name="learners_1[]"></textarea></td>
					          <td><textarea name="readiness_1[]"></textarea></td>
					          <td><textarea name="response_1[]"></textarea></td>
					          <td><textarea name="method_1[]"></textarea></td>  
					          <td><textarea name="interventions_1[]"></textarea></td>  
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
					        </tr>
				      	</tbody>   
				      </table>
				    </td>  
				    <td><textarea name="remark[]"></textarea></td>  
			  </tr>
			</tbody>
		  
		</table>
<<<<<<< HEAD
		<textarea hidden="hidden"   name="Interventions"></textarea>
		<textarea hidden="hidden" name="Outcome"></textarea>
		<textarea hidden="hidden" name="Goal"></textarea>
		<textarea hidden="hidden"  name="Progress" ></textarea>
=======
		<textarea hidden="hidden"   name="learners"></textarea>
		<textarea hidden="hidden" name="readiness"></textarea>
		<textarea hidden="hidden" name="response"></textarea>
		<textarea hidden="hidden"  name="method" ></textarea>
		<textarea hidden="hidden"  name="interventions" ></textarea>
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848

	</form>

	<script type="text/javascript">
		var count = 1; 
<<<<<<< HEAD
		function addIntervention(currentIssueNumber ) {
=======
		function addLearner(currentIssueNumber ) {
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
			let intervention = createInterventionHtml(currentIssueNumber);
			$(`.intervention_${currentIssueNumber}`).prepend(intervention);
		}
		
<<<<<<< HEAD
		function addIssue() {
			let newIssue = newIssueHtml();
			$('.addIssue').prepend(newIssue);

		}
		function deactivateIssue(issueNumber) {
=======
		function addTopic() {
			let newIssue = newIssueHtml();
			$('.addTopic').prepend(newIssue);

		}
		function inactivateLearner(issueNumber) {
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
			$(`.status_${issueNumber}`).attr("value", "0");
			$(`#row_${issueNumber}`).css("background-color", "#c5c5bc");
			$(`#row_${issueNumber}`).find("input, textarea").attr("readonly","readonly");
		}
		function newIssueHtml() {
			count++;
			return `<tr id="row_${count}">
					  	<td>
					  		<mark>${count}</mark>
<<<<<<< HEAD
					  		<a href="#" ><span style="color: #337ab7" onclick="addIntervention(${count})" class="glyphicon glyphicon-plus-sign" title="Add Interventions"></span> </a>
					  		<a href="#"><span style="color: red" onclick="deactivateIssue(${count})" class="glyphicon glyphicon-ban-circle" title="Deactivate Issue"></span> </a> 
					  	</td>
					  	<td><input type="text" name="issue[]" placeholder="key issue"></td>
=======
					  		<a href="#" ><span style="color: #337ab7" onclick="addLearner(${count})" class="glyphicon glyphicon-plus-sign" title="Add Learners"></span> </a>
					  		<a href="#"><span style="color: red" onclick="deactivateIssue(${count})" class="glyphicon glyphicon-ban-circle" title="Deactivate Topic"></span> </a> 
					  	</td>
					  	<td><input type="text" name="topic[]" placeholder="Education topic"></td>
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
					  	<input type="hidden" class="status_${count}" name="status[]" value="1">
					  	<input type="hidden"  name="count[]" value="${count}">
					  	<td>
					      <table>
					      	<thead>
					      		<tr>
<<<<<<< HEAD
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
=======
								   <th>Learners</th>
								   <th>Learner's Readiness for Education</th> 
								   <th>Method of Education</th>
								   <th>Response to Eduction</th>
								   <th>Further interventions Needed</th>
								</tr>
					      	</thead>
					      	<tbody class="learner_${count}">
					      		<tr>
						          	<td><textarea name="learners_${count}[]"></textarea></td>
								    <td><textarea name="readiness_${count}[]"></textarea></td>
								    <td><textarea name="response_${count}[]"></textarea></td>
								    <td><textarea name="method_${count}[]"></textarea></td>   
								    <td><textarea name="interventions_${count}[]"></textarea></td>   
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
						        </tr>
					      	</tbody>   
					      </table>
					    </td>
<<<<<<< HEAD
=======
					    <td><textarea name="remark[]"></textarea></td>  
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
				  </tr>
				  `
		}

		function createInterventionHtml(issue_number){
			return `<tr>
<<<<<<< HEAD
					    <td><textarea name="intervention_${count}[]"></textarea></td>
					    <td><textarea name="outcome_${count}[]"></textarea></td>
					    <td><textarea name="goal_${count}[]"></textarea></td>
					    <td><textarea name="progress_${count}[]"></textarea></td>  
				    </tr>
=======
			          	<td><textarea name="learners_${count}[]"></textarea></td>
					    <td><textarea name="readiness_${count}[]"></textarea></td>
					    <td><textarea name="response_${count}[]"></textarea></td>
					    <td><textarea name="method_${count}[]"></textarea></td>   
					    <td><textarea name="interventions_${count}[]"></textarea></td>   
			        </tr>
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848
				 `
		}

		function beforeSubmit() {
<<<<<<< HEAD
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
=======
			var learner = new Array();
			var readiness = new Array();
			var response = new Array();
			var method = new Array();
			var intervention = new Array();
			for (var i = 1; i <= count; i++){
				let value = $(`textarea[name='learners_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	learner.push(JSON.stringify(value));

             	value = $(`textarea[name='interventions_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	intervention.push(JSON.stringify(value));

              	value = $(`textarea[name='readiness_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	readiness.push(JSON.stringify(value));

              	value = $(`textarea[name='response_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	response.push(JSON.stringify(value));

              	value = $(`textarea[name='method_${i}[]']`)
              					.map(function(){return $(this).val();}).get();
              	method.push(JSON.stringify(value));

			}

			objectLearner = {"learner": learner};
			objectReadiness = {"readiness": readiness};
			objectResponse = {"response": response};
			objectMethod = {"method": method};
			objectIntervention = {"intervention": intervention};

			$('textarea[name="learners"]').val(JSON.stringify(objectLearner));
            $('textarea[name="readiness"]').val(JSON.stringify(objectReadiness));
            $('textarea[name="response"]').val(JSON.stringify(objectResponse));
            $('textarea[name="method"]').val(JSON.stringify(objectMethod));
            $('textarea[name="interventions"]').val(JSON.stringify(objectIntervention));
>>>>>>> 5b32339d05d752556de33636d1011f1c7a90b848

		}
	</script>
</body>
</html>