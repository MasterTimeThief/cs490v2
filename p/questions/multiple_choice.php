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
		$msg->success('Record Updated');
		header('Location: ' .BASE_URL . '/p/questions/questions.php');
	}
?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>Fill In The Blank</h2>
		<form name="add_multiple_choice" id="multiple_choice" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>Question:</label>
				<input type="text" class="form_input" name="question" id="question" value=""/>
				</div>
				
				<div class="form_row">
				<label>Choice 1:</label>
				<input type="text" class="form_input" name="answer_1" id="answer_1" value=""/>
				<input type="radio" class="form_input" name="which_is_correct" value="1">
				</div>
				
				<div class="form_row">
				<label>Choice 2:</label>
				<input type="text" class="form_input" name="answer_2" id="answer_2" value=""/>
				<input type="radio" class="form_input" name="which_is_correct" value="2">
				</div>
				
				<div class="form_row">
				<label>Choice 3:</label>
				<input type="text" class="form_input" name="answer_3" id="answer_3" value=""/>
				<input type="radio" class="form_input" name="which_is_correct" value="3">
				</div>
				
				<div class="form_row">
				<label>Choice 4:</label>
				<input type="text" class="form_input" name="answer_4" id="answer_4" value=""/>
				<input type="radio" class="form_input" name="which_is_correct" value="4">
				</div>
				
				<div class="form_row">
				<label>Choice 5:</label>
				<input type="text" class="form_input" name="answer_5" id="answer_5" value=""/>
				<input type="radio" class="form_input" name="which_is_correct" value="5">
				</div>

				<div class="form_sub_buttons">
				<input type="hidden" name="question_type" id="question_type" value="multiple_choice"> 
				<input type="hidden" name="professor_id" id="professor_id" value="1"> <!--  todo -->
				<input type="submit" class="form_submit" value="Submit" />
				</div> 
				<div class="clear"></div>
			</div>
		</form>
    </div>
</div>

<?php require_once '../../template/footer.php'; ?>
