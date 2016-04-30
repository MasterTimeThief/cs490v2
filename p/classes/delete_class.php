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
	if(empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . 'p/classes/classes.php' ) ;
	}
	$class_id = $_GET['class_id'];

	$data = $api->deleteClassById($class_id);
	$classArray = json_decode($data['body'],true);
	$msg->success('Record Updated');
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
	