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
		$api = Includes_Requests_Factory::create('questions',array());
		$res = $api->addQuestion($_POST);
		$msg->success('Question Created');
		header('Location: ' .BASE_URL . '/p/questions/questions.php');
	}
?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>New "True Or False" Question</h2>
		<form name="add_true_or_false" id="true_or_false" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>Question:</label>
				<input type="text" class="form_input" name="question" id="question" value=""/>
				</div>
				
				<div class="form_row">
				<label>True:</label>
				<input type="radio" class="form_input" name="is_true" value="1">
				</div>
				
				<div class="form_row">
				<label>False:</label>
				<input type="radio" class="form_input" name="is_true" value="0">
				</div>

				<div class="form_row">
				<input type="hidden" name="question_type" id="question_type" value="true_or_false"> 
				<input type="hidden" name="professor_id" id="professor_id" value="1"> <!--  todo -->
				<input type="submit" class="form_submit" value="Submit" />
				</div> 
				<div class="clear"></div>
			</div>
		</form>
    </div>
</div>

<?php require_once '../../template/footer.php'; ?>