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
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('students',array());
		$_POST['password'] = md5($_POST['password']);
		$res = $api->addStudent($_POST);
		$msg->success('Record Updated');
		header('Location: ' .BASE_URL . '/p/students/students.php');
	}
?>

<div id="right_wrap">
	<div id="right_content">             
	<h2>Add Students</h2>
		<form name="add_class" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>First Name:</label>
				<input type="text" class="form_input_short" name="first_name" id="first_name" value=""/>
				</div>

				<div class="form_row">
				<label>Last Name:</label>
				<input type="text" class="form_input_short" name="last_name" id="last_name" value=""/>
				</div>
				 
				<div class="form_row">
				<label>Email:</label>
				<input type="text" class="form_input_short" name="email" id="email" value=""/>
				</div>
				
				<div class="form_row">
				<label>Password:</label>
				<input type="password" class="form_input_short" name="password" id="password" value=""/>
				</div>

				<div class="form_row">
				<input type="hidden" class="form_submit" name="role" id="role" value="student" />
				<input type="hidden" class="form_submit" name="active" id="active" value="1" />
				<input type="submit" class="form_submit" value="Submit" />
				</div> 
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>
