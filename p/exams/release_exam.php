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
		header('Location: ' . BASE_URL . 'p/exams/exams.php' ) ;
	}
	$exam_id = $_GET['exam_id'];
	
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . 'p/exams/exams.php' ) ;
	}
	$student_id = $_GET['student_id'];

	$data = $api->releaseExamById($exam_id,$student_id);
	$msg->success('Record Updated');
	header('Location: ' . $_SERVER['HTTP_REFERER']);