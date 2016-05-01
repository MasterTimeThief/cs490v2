<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php
	$api = Includes_Requests_Factory::create('exams',array());
	if(empty($_GET['exam_id'])){
		header('Location: ' . BASE_URL . '/s/exams/exams.php' ) ;
	}
	$examId = $_GET['exam_id'];
	
	$api = Includes_Requests_Factory::create('questions',array());
	$data = $api->getQuestionsByExamId($examId);
	$questionsArray = json_decode($data['body'],true);

	$studentAnswers = $api->getStudentAnswers($examId,$_SESSION['id']);

	$studentAnswersArray = json_decode($studentAnswers['body'],true);
	//dd($studentAnswersArray);
?>
<div id="right_wrap">
	<div id="right_content">
	<h2>View Questions</h2>
	<form name="add_multiple_choice" id="multiple_choice" method="post" action="">
		<table id="rounded-corner">
			<tfoot>
				<tr>
					<td colspan="12"></td>
				</tr>
			</tfoot>
			<tbody>
			<?php $counter = 0; ?>
			<?php $numberOfQuestions=0;?>
			<?php $numberOfCorrectAnswers=0;?>
			
			<?php foreach($questionsArray['data'] as $id=>$item):?>
				<?php $numberOfQuestions+=1;?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
				<div>
					<?php if($item['question_type']=='short_answer'):?>
						<td>
							<?php 
								$studentAnswer = $studentAnswersArray['data'][$item['id']]['answer'];
								$isCorrect = ($studentAnswersArray['data'][$item['id']]['is_correct']==1) ?  true: false;
								
								if($isCorrect){
									$numberOfCorrectAnswers+=1;
								}
							?>
							<div class="form_row">
							<p><font size="3" color="#535E66" ><b>Question <?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
							
							<p>You Answer is: <?=($isCorrect) ? ' CORRECT' : 'INCORRECT'?></p>
							<p>Possible Correct Answer Is: <?=$item['answer_1']?></p>
							
							<div class="form_row">
							<label>Answer:</label>
							<textarea rows="4" cols="50" type="text" class="form_input" name="student_answer[<?=$item['id']?>]"><?=$studentAnswer?></textarea>
							</div>
						</td>
					<?php elseif($item['question_type']=='multiple_choice'): ?>
						<td>
							<?php 
								$studentAnswer = $studentAnswersArray['data'][$item['id']]['answer'];
								$correctAnswer = $item['which_is_correct'];
							?>
							<div>
							<p><font size="3" color="#535E66" ><b>Question <?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>

							<p>You Answer is: <?=($studentAnswer==$correctAnswer) ? ' CORRECT' : 'INCORRECT'?></p>
							<p>Correct Answer Is: <?=($item['answer_'. $correctAnswer])?></p>
							
							<?php 
								if($studentAnswer==$correctAnswer){
									$numberOfCorrectAnswers+=1;
								}
							?>
							

							<div class="form_row">
							<label><?=$item['answer_1']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="1" <?=($studentAnswer==1) ? ' checked': ''?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_2']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="2" <?=($studentAnswer==2) ? ' checked': ''?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_3']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="3" <?=($studentAnswer==3) ? ' checked': ''?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_4']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="4" <?=($studentAnswer==4) ? ' checked': ''?>>
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_5']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="5" <?=($studentAnswer==5) ? ' checked': ''?>>
							</div>
						</td>
					<?php elseif($item['question_type']=='true_or_false'): ?>
						<td>
							<?php 
								$isCorrect = ($studentAnswersArray['data'][$item['id']]['is_correct']==1) ?  true: false;
								
								
								if($isCorrect){
									$numberOfCorrectAnswers+=1;
								}
							?>
							<div>
							<p><font size="3" color="#535E66" ><b>Question <?=$item['id']?><?php //$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
								<p>You Answer is: <?=($isCorrect) ? ' CORRECT' : 'INCORRECT'?></p>
								<p>Correct Answer Is: <?=($item['is_true']) ? 'TRUE' : 'FALSE'?>
							<div class="form_row">
							<label>True:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="1" <?=($studentAnswersArray['data'][$item['id']]['answer']==1)? ' checked' : ''?>>
							<label>False:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="0" <?=($studentAnswersArray['data'][$item['id']]['answer']==0)? ' checked' : ''?>>
							</div>
						</td>
					<?php elseif($item['question_type']=='fill_in_the_blanks'): ?>
						<td>
							<?php 
								$answer = $studentAnswersArray['data'][$item['id']]['answer'];
							?>
							<div class="form_row">
							<p><font size="3" color="#535E66" ><b>Question <?//=$item['id']?><?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
							<p>You Answer is: <?=($item['answer_1'] == $answer) ? ' CORRECT' : 'INCORRECT'?></p>
							<p>Correct Answer Is: <?=($item['answer_1'])?>
							<?php 
								if($item['answer_1'] == $answer){
									$numberOfCorrectAnswers+=1;
								}
							?>
							<div class="form_row">
							<label>Answer:</label>
							<input type="text" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="<?=$studentAnswersArray['data'][$item['id']]['answer']?>"/>
							</div>
						</td>
					<?php endif;?>
				</div>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			</tbody>
		</table>
		<br>
		<div class="form_row">
			<p><?="Number of Questions: $numberOfQuestions"?></p>
			<p><?="Correct Answers: $numberOfCorrectAnswers"?></p>
			<?php 
				$grade = ($numberOfCorrectAnswers==0) ? 0 : ($numberOfQuestions/$numberOfCorrectAnswers) * 100;
			?>
			<p><?="Your Grade is: $grade"?></p>
			
			<?php 
			$grades = $api->getStudentGrade($examId,$_SESSION['id']);
			$gradesArray = json_decode($grades['body'],true);
			if(empty($gradesArray)){
				$data = array(
					'exam_id'=>$examId,
					'student_id'=>$_SESSION['id'],
					'grade'=>$grade,
					'notes'=>''
				);
				$response = $api->addStudentGrade($data);
			}
			?>
		</div>
		<div class="clear"></div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>