<form name="add_fill_in_the_blank" id="fill_in_the_blank" method="post" action="">
	<div class="form">
		<div class="form_row">
		<label>Question:</label>
		<input type="text" class="form_input" name="question" id="question" value="<?= $questionArray['data']['question']?>"/>
		</div>
		 
		<div class="form_row">
		<label>Answer:</label>
		<input type="text" class="form_input" name="answer_1" id="answer_1" value="<?= $questionArray['data']['answer_1']?>"/>
		</div>

		<div class="form_sub_buttons">
			<input type="hidden" name="id" id="id" value="<?=$questionId?>">
			<input type="submit" class="form_submit" value="Update"/>
		</div> 
		<div class="clear"></div>
	</div>
</form>