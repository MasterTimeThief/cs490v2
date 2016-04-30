<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php 
if(!isLoggedIn('professor')){
	$msg->error('No direct access allowed. Login Please');
	header('Location: ' . BASE_URL . '/login.php');
	exit;
}
?>
<?php require_once '../../template/header.php'; ?>

<?php
	$api = Includes_Requests_Factory::create('questions',array());
	$data = $api->getQuestions();
	$questionsArray = json_decode($data['body'],true);

	$currentQuetionsData = $api->getQuestionsByExamId($_GET['exam_id']);
	$currentQuestionsDataArray = json_decode($currentQuetionsData['body'],true);
	
	$currentIds = array();
	if(!empty($currentQuestionsDataArray['data'])){
		foreach($currentQuestionsDataArray['data'] as $value){
			$currentIds[] = $value['id'];
		}
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(empty($_POST['add_question']) || empty($_POST['exam_id'])){
			$msg->error('Please, select questions to add');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		$api = Includes_Requests_Factory::create('exams',array());

		foreach($_POST['add_question'] as $question_id){
			$res[] = $api->addQuestionsToExam(array(
												'exam_id'=>$_POST['exam_id'],
												'question_id'=>$question_id
										));
		}
		$resArray = isset($res[0]['body']) ? json_decode($res[0]['body'],true) :json_decode($res['body'],true);
		if($resArray['code']==200){
			$msg->success('Record Updated');
		} else{
			$msg->error('Something went wrong');
		}
		header('Location: ' . BASE_URL . '/p/exams/view_questions.php?exam_id=' . $_GET['exam_id']);
	}
	
?>
<div id="right_wrap">
	<p><?=$msg->display();?></p>
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
					<td><input type="checkbox" name="add_question[]" id="add_question" value="<?=$item['id']?>" <?=(in_array($item['id'],$currentIds)) ? ' checked disabled' : ''?>/></td>
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
		<input type="hidden" name="exam_id" id="exam_id" value="<?=$_GET['exam_id']?>"/>
		<input type="submit" align="center" class="form_submit" value="Submit" />
		</div>
		<div class="clear"></div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>