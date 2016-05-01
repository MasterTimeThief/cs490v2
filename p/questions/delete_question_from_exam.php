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
	if(empty($_GET['question_id'])){
		header('Location: ' . BASE_URL . 'p/questions/questions.php' ) ;
	}
	$question_id = $_GET['question_id'];
	$data = $api->deleteQuestionFromExam($question_id);
	$questionArray = json_decode($data['body'],true);
	$msg->success('Record Updated');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	