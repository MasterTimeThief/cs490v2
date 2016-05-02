<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php 
if(!isLoggedIn('student')){
	$msg->error('No direct access allowed. Login Please');
	header('Location: ' . BASE_URL . '/login.php');
	exit;
}
?>
<?php require_once '../../template/header.php'; ?>

<?php
	if(empty($_GET['exam_id']) || empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . '/s/exams/exams.php' ) ;
	}
	$examId = $_GET['exam_id'];
	$classId = $_GET['class_id'];
	
	$api = Includes_Requests_Factory::create('questions',array());
	
	$grades = $api->getStudentGrade($examId,$_SESSION['id']);
	$gradesArray = json_decode($grades['body'],true);
	//dd($gradesArray);
	$isExamAvailable=true;
	if(!empty($gradesArray['data'])){
		dd($gradesArray['data']);
		$msg->error("This exam has been taken already");
		$isExamAvailable=false;
	}
	$data = $api->getQuestionsByExamId($examId);
	$questionsArray = json_decode($data['body'],true);
	//dd($questionsArray['data']);
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$studentId = $_POST['student_id'];
		$numberOfQuestions=count($questionsArray['data']);
		$numberOfCorrectAnswers=0;
		foreach($questionsArray['data'] as $question){
			$questionId= $question['id'];
			//dd($_POST['student_answer'][$questionId]);
			if(isset($_POST['student_answer'][$questionId])){
				// Answer match
				//dd($question);
				$studentAnswer = $_POST['student_answer'][$questionId];
				
				$data = array(
					'exam_id'		=> $examId,
					'student_id'	=> $studentId,
					'question_id'	=> $questionId,
					'class_id'		=> $classId
				);
				// True or False
				if($question['question_type'] == 'true_or_false')
				{
					$correctAnswer = $question['is_true'];
					
					$data['question_type'] = 'true_or_false';
					
					if($studentAnswer == $correctAnswer){
						//echo "question $questionId is Correct";
						$data['answer'] = 1;
						$data['is_correct'] = 1;
						$numberOfCorrectAnswers+=1;
						
					} else {
						//echo "question $questionId is NOT Correct";
						$data['answer'] 		= 0;
						$data['is_correct'] 	= 0;
					}
					$response = $api->insertStudentAnswer($data);

				}else if($question['question_type']=='fill_in_the_blanks'){
					$correctAnswer = trim(strtolower($question['answer_1']));
					$data['question_type'] = 'fill_in_the_blanks';
					$data['answer']= trim(strtolower($studentAnswer));
					if($studentAnswer == $correctAnswer){
						//echo "question $questionId is Correct";
						$data['is_correct']	= 1;
						$numberOfCorrectAnswers+=1;
					} else {
						//echo "question $questionId is NOT Correct";
						$data['is_correct']	= 0;
					}
					$response = $api->insertStudentAnswer($data);
					
				}else if($question['question_type']=='multiple_choice'){
					//dd($_POST);
					$which = $question['which_is_correct'];
					$data['question_type'] = 'multiple_choice';
					//var_dump($which);
					$data['answer'] =$studentAnswer; 
					if($studentAnswer == $which){
						//echo "question $questionId is Correct";
						$data['is_correct']	= 1;
						$numberOfCorrectAnswers+=1;
					} else {
						//echo "question $questionId is NOT Correct";
						$data['is_correct']	= 0;
					}
					$response = $api->insertStudentAnswer($data);

				} else if($question['question_type']=='short_answer') {
					$correctAnswer = trim(strtolower($question['answer_1']));
					$data['question_type'] = 'short_answer';
					$data['answer']= trim(strtolower($studentAnswer));
					
					// Do PHP unit here
					$data['is_correct']	= 0;
					$numberOfCorrectAnswers+=0;
					$response = $api->insertStudentAnswer($data);
				} else{
					// nothing here for now
				}
		
			
			} else {
				// Not found in the answers. Set it as failed
				echo "not found<br/>";

			}
		}
		
		// Insert statistics and redirect
		$grades = $api->getStudentGrade($examId,$_SESSION['id']);
		$gradesArray = json_decode($grades['body'],true);
		$grade = ($numberOfCorrectAnswers==0) ? 0 : ($numberOfCorrectAnswers/$numberOfQuestions) * 100;

		if(empty($gradesArray['data'])){
			 $data = array(
				 'class_id'=>$classId,
				 'exam_id'=>$examId,
				 'student_id'=>$_SESSION['id'],
				 'grade'=>$grade,
				 'is_complete'=>1,
				 'notes'=>''
			 );
			 $response = $api->addStudentGrade($data);
		 }
		header("Location: " .BASE_URL . "/s/exams/exams.php");
		exit;
	}
?>
<div id="right_wrap">
	<p><?=$msg->display()?></p>
	<div id="right_content">
	<h2>Take Exam ""</h2>
	<form name="add_multiple_choice" id="multiple_choice" method="post" action="">
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
							<p><font size="3" color="#535E66" ><b>Question <?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
							
							<br>
							
							<div class="form_row">
							<label>Answer:</label>
							<textarea rows="4" cols="50" type="text" class="form_input_tall" name="student_answer[<?=$item['id']?>]"></textarea>
							</div>
						</td>
					<?php elseif($item['question_type']=='multiple_choice'): ?>
						<td>
							<div>
							<p><font size="3" color="#535E66" ><b>Question <?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
							
							<br>
							
							<div class="form_row">
							<label><?=$item['answer_1']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="1">
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_2']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="2">
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_3']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="3">
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_4']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="4">
							</div>
							
							<div class="form_row">
							<label><?=$item['answer_5']?>:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="5">
							</div>
						</td>
					<?php elseif($item['question_type']=='true_or_false'): ?>
						<td>
							<div>
							<p><font size="3" color="#535E66" ><b>Question <?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
							
							<br>
							
							<div class="form_row">
							<label>True:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="1">
							</div>
							
							<div class="form_row">
							<label>False:</label>
							<input type="radio" class="form_input" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value="0">
							</div>
						</td>
					<?php elseif($item['question_type']=='fill_in_the_blanks'): ?>
						<td>
							<div class="form_row">
							<p><font size="3" color="#535E66" ><b>Question <?=$counter+1?>: <?=$item['question']?></b></font></p>
							</div>
							
							<br>
							
							<div class="form_row">
							<label>Answer:</label>
							<input type="text" class="form_input_short" name="student_answer[<?=$item['id']?>]" id="student_answer[<?=$item['id']?>]" value=""/>
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
		<div class="form_sub_buttons">
		<input type="hidden" name="exam_id" id="exam_id" value="<?=$_GET['exam_id']?>"/>
		<input type="hidden" name="student_id" id="student_id" value="<?=$_SESSION['id']?>"/>
		<?php if($isExamAvailable):?>
			<input type="submit" align="center" class="form_submit" value="Submit"/>
		<?php endif;?>
		</div>
		<div class="clear"></div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>