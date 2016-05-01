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
	$api = Includes_Requests_Factory::create('classes',array());
	$data = $api->getClasses();
	$classesArray = json_decode($data['body'],true);

	$currentClassesData = $api->getClassesByStudentId($_GET['student_id']);
	$currentClassesDataArray = json_decode($currentClassesData['body'],true);
	
	$currentIds = array();
	if(!empty($currentClassesDataArray['data'])){
		foreach($currentClassesDataArray['data'] as $value){
			$currentIds[] = $value['id'];
		}
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(empty($_POST['add_class']) || empty($_POST['student_id'])){
			$msg->error('Please, select classes to add');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		$api = Includes_Requests_Factory::create('students',array());

		foreach($_POST['add_class'] as $class_id){
			$res[] = $api->addClassesToStudent(array(
												'student_id'=>$_POST['student_id'],
												'class_id'=>$class_id
										));
		}
		$resArray = isset($res[0]['body']) ? json_decode($res[0]['body'],true) :json_decode($res['body'],true);
		if($resArray['code']==200){
			$msg->success('Record Updated');
		} else{
			$msg->error('Something went wrong');
		}
		header('Location: ' . BASE_URL . '/p/students/students.php');
	}
	
?>
<div id="right_wrap">
	<p><?=$msg->display();?></p>
	<div id="right_content">
	<form name="add_classes_to_student" method="post" action="">
	<h2>Add Questions</h2>
		<table id="rounded-corner">
			<thead>
				<tr>
					<th></th>
					<th>Code</th>
					<th>Title</th>
					<th>Category</th>
				</tr>
			</thead>
				<tfoot>
				<tr>
					<td colspan="12"></td>
				</tr>
			</tfoot>
			<tbody>
			<?php $counter = 0; ?>
			<?php foreach($classesArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
					<td><input type="checkbox" name="add_class[]" id="add_class" value="<?=$item['id']?>" <?=(in_array($item['id'],$currentIds)) ? ' checked disabled' : ''?>/></td>
					<td><?=$item['code']?></td>
					<td><?=$item['title']?></td>
					<td><?=$item['category']?></td>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			
			</tbody>
		</table>
		
		<br>
		<div class="form_row">
		<input type="hidden" name="class_id" id="class_id" value="<?=$_GET['class_id']?>"/>
		<input type="submit" align="center" class="form_submit" value="Submit" />
		</div>
		<div class="clear"></div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>