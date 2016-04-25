<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('exams',array());
	if(empty($_GET['exam_id'])){
		header('Location: ' . BASE_URL . '/p/exams/exams.php' ) ;
	}
	$exam_id = $_GET['exam_id'];
	
	$data = $api->getExamById($exam_id);
	$examArray = json_decode($data['body'],true);
	
	
	$api = Includes_Requests_Factory::create('classes',array());
	$data = $api->getClasses();
	$classesArray = json_decode($data['body'],true);
	
	$api = Includes_Requests_Factory::create('questions',array());
	$questions = $api->getQuestions();
	$questionsArray = json_decode($questions['body'],true);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('exams',array());
		$res = $api->updateExam($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>

<div id="right_wrap">
	<div id="right_content">
	<h2>Edit Exam</h2>
	
	<div class="toogle_wrap">
		<div class="trigger">
			<a href="#">Question Bank</a>
		</div>

		<div class="toggle_container">
			<p>
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
			</p>
		</div>
	</div>
	
	<form name="add_exam" method="post" action="">
		<div class="form">
			<div class="form_row">
			<label>Exam Title:</label>
			<input type="text" class="form_input" name="title" id="title" value="<?=$examArray['data']['title']?>"/>
			</div>
			
			<div class="form_row">
				<label>Class:</label>
				<select class="form_select" name="class_id">
					<?php foreach($classesArray['data'] as $id=>$item):?>
					<option value="<?=$item['id']?>" <?=$item['id']==$examArray['data']['class_id'] ? 'selected' : '' ?>><?=$item['code']?> - <?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</div>
			
			<div class="form_row">
				<label>Status:</label>
				<select class="form_select" name="is_available">
					<option value="1"   <?=($examArray['data']['is_available']=='1')   ? 'selected': ''?>>Open</option>
					<option value="0"   <?=($examArray['data']['is_available']=='0')   ? 'selected': ''?>>Closed</option>
				</select>
			</div>

			<div class="form_row">
				<input type="hidden" class="form_input" name="professor_id" id="professor_id" value="1"/> <!-- @todo -->
			</div>
			<div class="form_row">
			<input type="submit" class="form_submit" value="Submit" />
			</div> 
			<div class="clear"></div>
		</div>
	</form>
	
	</div>
</div>

<?php require_once '../../template/footer.php'; ?>

