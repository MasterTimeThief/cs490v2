<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('students',array());
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . '/p/students/students.php' ) ;
	}
	$student_id = $_GET['student_id'];
	
	$data = $api->getStudentById($student_id);
	$studentArray = json_decode($data['body'],true);
	dd($studentArray);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('students',array());
		$res = $api->updateStudent($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>

<div id="right_wrap">
	<div id="right_content">             
	<h2>Add Students</h2>
		<form name="add_class" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>First Name:</label>
				<input type="text" class="form_input" name="first_name" id="first_name" value="<?//=$studentArray['first_name']?>"/>
				</div>

				<div class="form_row">
				<label>Last Name:</label>
				<input type="text" class="form_input" name="last_name" id="last_name" value=""/>
				</div>
				 
				<div class="form_row">
				<label>Email:</label>
				<input type="text" class="form_input" name="email" id="email" value=""/>
				</div>
				
				<div class="form_row">
				<label>Password:</label>
				<input type="password" class="form_input" name="password" id="password" value=""/>
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
