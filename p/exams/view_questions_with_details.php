<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php
	$api = Includes_Requests_Factory::create('exams',array());
	if(empty($_GET['exam_id'])){
		header('Location: ' . BASE_URL . '/p/exams/exams.php' ) ;
	}
	$examId = $_GET['exam_id'];
	$api = Includes_Requests_Factory::create('questions',array());
	$data = $api->getQuestionsByExamId($examId);
	$questionsArray = json_decode($data['body'],true);
	//dd($questionsArray);
	//exit;
?>
<div id="right_wrap">
	<div id="right_content">
	<h2>View Questions</h2>
		<table id="rounded-corner">
			<tfoot>
				<tr>
					<td colspan="12"></td>
				</tr>
			</tfoot>
			<tbody>
			<?php $counter = 0; ?>
			<?php foreach($questionsArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
				<div>
					<?php if($item['question_type']=='short_answer'):?>
						<td>
							<div class="form_row">
							<p><font size="3" color="#535E66" ><b>Question <?=$item['id']?>: <?=$item['question']?></b></font></p>
							</div>
							
							<br>
							
							<div class="form_row">
							<label>Answer:</label>
							<textarea rows="4" cols="50" type="text" class="form_input" name="answer" id="answer" readonly><?=$item['answer_1']?></textarea>
							</div>
						</td>
					<?php //continue; ?>
					
					<?php elseif($item['question_type']=='multiple_choice'): ?>
						<td>
							<div>
							<p><font size="3" color="#535E66" ><b>Question <?=$item['id']?>: <?=$item['question']?></b></font></p>
							</div>
							
							<br>
							
							<div class="form_row">
							<label><?=$item['answer_1']?>:</label>
							<input type="radio" class="form_input" <?=$item['which_is_correct']=='1' ? 'checked' : 'disabled';?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_2']?>:</label>
							<input type="radio" class="form_input" <?=$item['which_is_correct']=='2' ? 'checked' : 'disabled';?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_3']?>:</label>
							<input type="radio" class="form_input" <?=$item['which_is_correct']=='3' ? 'checked' : 'disabled';?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_4']?>:</label>
							<input type="radio" class="form_input" <?=$item['which_is_correct']=='4' ? 'checked' : 'disabled';?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_5']?>:</label>
							<input type="radio" class="form_input" <?=$item['which_is_correct']=='5' ? 'checked' : 'disabled';?>>
							</div>
						</td>
					
					<?php //continue; ?>
					<?php elseif($item['question_type']=='true_or_false'): ?>
						<td>
							<div>
							<p><font size="3" color="#535E66" ><b>Question <?=$item['id']?>: <?=$item['question']?></b></font></p>
							</div>
							<br>
							
							<div class="form_row">
							<label>True:</label>
							<input type="radio" class="form_input" <?=$item['is_true']=='1' ? 'checked' : 'disabled';?>>
							</div>
							
							<div class="form_row">
							<label>False:</label>
							<input type="radio" class="form_input" <?=$item['is_true']=='0' ? 'checked' : 'disabled';?>>
							</div>
						</td>
					
					<?php //continue; ?>
					<?php elseif($item['question_type']=='fill_in_the_blanks'): ?>
						<td>
							<div class="form_row">
							<p><font size="3" color="#535E66" ><b>Question <?=$item['id']?>: <?=$item['question']?></b></font></p>
							</div>
							<br>
							<div class="form_row">
							<label>Answer:</label>
							<input type="text" class="form_input" name="answer" id="answer" value="<?=$item['answer_1']?>" readonly />
							</div>
						</td>

					<?php //continue; ?>
					<?php endif;?>
				</div>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			
			</tbody>
		</table>
		
		<div class="clear"></div>
	</div>
</div>

<?php require_once '../../template/footer.php'; ?>