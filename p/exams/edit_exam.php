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

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('exams',array());
		$res = $api->updateExam($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
		header('Location: ' . BASE_URL . '/p/exams/exams.php');
	}
?>

<div id="right_wrap">
	<div id="right_content">
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
				<select class="form_select_short" name="is_available">
					<option value="1"   <?=($examArray['data']['is_available']=='1')   ? 'selected': ''?>>Open</option>
					<option value="0"   <?=($examArray['data']['is_available']=='0')   ? 'selected': ''?>>Closed</option>
				</select>
			</div>
			
			<!--div class="form_row">
			<label>Weight:</label>
			<select class="form_select_short" name="is_available">
				<option value="1"  <?=($examArray['data']['weight']=='1')   ? 'selected': ''?>>1</option>
				<option value="5"  <?=($examArray['data']['weight']=='5')   ? 'selected': ''?>>5</option>
				<option value="10" <?=($examArray['data']['weight']=='10')   ? 'selected': ''?>>10</option>
				<option value="20" <?=($examArray['data']['weight']=='20')   ? 'selected': ''?>>20</option>
			</select>
		</div-->

			<div class="form_row">
				<input type="hidden" class="form_input" name="professor_id" id="professor_id" value="1"/> <!-- @todo -->
				<input type="hidden" class="form_input" name="id" id="id" value="<?=$_GET['exam_id']?>"/>
			</div>
			<div class="form_row">
			<input type="submit" class="form_submit" value="Update" />
			</div> 
			<div class="clear"></div>
		</div>
	</form>
	
	</div>
</div>

<?php require_once '../../template/footer.php'; ?>

