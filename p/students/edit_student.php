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
	$api = Includes_Requests_Factory::create('students',array());
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . '/p/students/students.php' ) ;
	}
	$student_id = $_GET['student_id'];
	
	$data = $api->getStudentById($student_id);
	$studentArray = json_decode($data['body'],true);
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('students',array());
		$res = $api->updateStudent($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
		header('Location: ' . BASE_URL . '/p/students/students.php' ) ;
	}
?>

<div id="right_wrap">
	<div id="right_content">             
	<h2>Edit Student</h2>
		<form name="add_class" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>First Name:</label>
				<input type="text" class="form_input_short" name="first_name" id="first_name" value="<?=$studentArray['data']['first_name']?>"/>
				</div>

				<div class="form_row">
				<label>Last Name:</label>
				<input type="text" class="form_input_short" name="last_name" id="last_name" value="<?=$studentArray['data']['last_name']?>"/>
				</div>

				<div class="form_sub_buttons">
				<input type="hidden" class="form_input" name="id" id="id" value="<?=$student_id?>"/>
				<input type="submit" class="form_submit" value="Update" />
				</div> 
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>
