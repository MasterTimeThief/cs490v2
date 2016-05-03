<form name="add_short_answer" id="short_answer" method="post" action="">
	<div class="form">
		<div class="form_row">
		<label>Question:</label>
		<input type="text" class="form_input" name="question" id="question" value="<?= $questionArray['data']['question']?>"/>
		</div>
		
		<div class="form_row">
		<label>Input:</label>
		<textarea rows="5" cols="50" class="form_input_tall" name="answer_1" id="answer_1"><?= $questionArray['data']['answer_1']?></textarea>
		</div>
		
		<div class="form_row">
		<label>Suggested function:</label>
		<textarea rows="5" cols="50" class="form_input_tall" name="answer_2" id="answer_2"><?= $questionArray['data']['answer_2']?></textarea>
		</div>
		
		<div class="form_row">
		<label>Desired Output:</label>
		<input type="text" class="form_input_short" name="answer_3" id="answer_3" value="<?= $questionArray['data']['answer_3']?>"/>
		</div>


		<div class="form_row">
		<div class="form_row">
			<input type="hidden" name="id" id="id" value="<?=$questionId?>">
			<input type="submit" class="form_submit" value="Update" />
		</div> 
		</div>
		<div class="clear"></div>
	</div>
</form>