<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('exams',array());
	if(empty($_GET['exam_id'])){
		header('Location: ' . BASE_URL . '/p/exams/exams.php' ) ;
	}
	$exam_id = $_GET['exam_id'];
	
	$data = $api->getStudentById($exam_id);
	$studentArray = json_decode($data['body'],true);

	$api = Includes_Requests_Factory::create('classes',array());
	$data = $api->getClasses();
	$classesArray = json_decode($data['body'],true);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('exams',array());
		$res = $api->updateStudent($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>


<h2>Edit Exam</h2>
<?php require_once '../../template/footer.php'; ?>

