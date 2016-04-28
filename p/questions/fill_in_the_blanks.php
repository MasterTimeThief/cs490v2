<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
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
		<form name="add_fill_in_the_blank" id="fill_in_the_blank" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>Question:</label>
				<input type="text" class="form_input" name="question" id="question" value=""/>
				</div>
				 
				<div class="form_row">
				<label>Answer:</label>
				<input type="text" class="form_input" name="answer_1" id="answer_1" value=""/>
				<input type="hidden" name="question_type" id="question_type" value="fill_in_the_blanks"/>
				<input type="hidden" name="professor_id" id="professor_id" value="1"/> <!--  todo  -->
				</div>

				<div class="form_sub_buttons">
				<input type="submit" class="form_submit" value="Submit" />
				</div> 
				<div class="clear"></div>
			</div>
		</form>
    </div>
</div>

<?php require_once '../../template/footer.php'; ?>