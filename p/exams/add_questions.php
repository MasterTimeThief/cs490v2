<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php
	$api = Includes_Requests_Factory::create('questions',array());
	$data = $api->getQuestions();
	$questionsArray = json_decode($data['body'],true);
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('exams',array());
		$res = $api->addQuestionsToExam($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>
<div id="right_wrap">
	<div id="right_content">
	<form name="add_questions_to_exam" method="post" action="">
	<h2>Add Questions</h2>
		<table id="rounded-corner">
			<thead>
				<tr>
					<th></th>
					<th>No.</th>
					<th>Question</th>
					<th>Question Type</th>
				</tr>
			</thead>
				<tfoot>
				<tr>
					<td colspan="12"></td>
				</tr>
			</tfoot>
			<tbody>
			<?php $counter = 0; ?>
			<?php foreach($questionsArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
					<td><input type="checkbox" name="add_question" id="add_question" /></td>
					<td><?=$item['id']?></td>
					<td><?=$item['question']?></td>
					<td><?=$item['question_type']?></td>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			
			</tbody>
		</table>
		
		<br>
		<div class="form_row">
		<input type="submit" align="center" class="form_submit" value="Submit" />
		</div> 
		<div class="clear"></div>
		</form>
	</div>
</div>

<?php require_once '../../template/footer.php'; ?>