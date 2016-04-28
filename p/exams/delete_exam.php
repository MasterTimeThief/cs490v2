<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('exams',array());
	if(empty($_GET['exam_id'])){
		header('Location: ' . BASE_URL . 'p/exams/exams.php' ) ;
	}
	$exam_id = $_GET['exam_id'];

	$data = $api->deleteExamById($exam_id);
	$examArray = json_decode($data['body'],true);
	$msg->success('Record Updated');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
	