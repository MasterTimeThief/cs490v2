<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('multiple_choice',array());
		$res = $api->addMultipleChoice($_POST);
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
				<input type="text" class="form_input" name="choice_1" id="choice_1" value=""/>
				<input type="radio" class="form_input" name="correct" value="1">
				</div>
				
				<div class="form_row">
				<label>Choice 2:</label>
				<input type="text" class="form_input" name="choice_2" id="choice_2" value=""/>
				<input type="radio" class="form_input" name="correct" value="2">
				</div>
				
				<div class="form_row">
				<label>Choice 3:</label>
				<input type="text" class="form_input" name="choice_3" id="choice_3" value=""/>
				<input type="radio" class="form_input" name="correct" value="3">
				</div>
				
				<div class="form_row">
				<label>Choice 4:</label>
				<input type="text" class="form_input" name="choice_4" id="choice_4" value=""/>
				<input type="radio" class="form_input" name="correct" value="4">
				</div>

				<div class="form_row">
				<input type="submit" class="form_submit" value="Submit" />
				</div> 
				<div class="clear"></div>
			</div>
		</form>
    </div>
</div>

<?php require_once '../../template/footer.php'; ?>
