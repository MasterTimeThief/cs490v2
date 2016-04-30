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
		header('Location: ' . BASE_URL . '/p/questions/questions.php' ) ;
	}
	$questionId = $_GET['question_id'];
	//$questionType = $_GET['question_type'];
	
	$data = $api->getQuestionById($questionId);
	$questionArray = json_decode($data['body'],true);
	//dd($questionArray);
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('questions',array());
		$res = $api->updateQuestion($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
		header('Location: ' . BASE_URL . '/p/questions/questions.php');
	}
?>

<div id="right_wrap">
	<p><?=$msg->display();?></p>
    <div id="right_content">             
    	<h2>Edit Question</h2>
		<?php if(!empty($questionArray['data']) && $questionArray['data']['question_type']=='true_or_false'){
			require_once('forms/true_or_false.php');
		} else if(!empty($questionArray['data']) && $questionArray['data']['question_type']=='short_answer'){
			require_once('forms/short_answer.php');
		} else if(!empty($questionArray['data']) && $questionArray['data']['question_type']=='multiple_choice'){
			require_once('forms/multiple_choice.php');
		}  else if(!empty($questionArray['data']) && $questionArray['data']['question_type']=='fill_in_the_blanks'){
			require_once('forms/fill_in_the_blanks.php');
		}else {
			echo "this is something else";
		}
		?>
    </div>
</div>
<?php require_once '../../template/footer.php'; ?>