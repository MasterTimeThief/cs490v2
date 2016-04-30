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
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . 'p/exams/exams.php' ) ;
	}
	$api = Includes_Requests_Factory::create('students',array());
	$student_id = $_GET['student_id'];
	$response = $api->deleteStudentById($student_id);
	$msg->success('Record Deleted');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
	
	