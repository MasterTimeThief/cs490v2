<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('exams',array());
	if(empty($_GET['exam_id'])){
		header('Location: ' . BASE_URL . '/p/exams/exams.php' ) ;
	}
	$exam_id = $_GET['exam_id'];
	
	$data = $api->getExamById($exam_id);
	$examArray = json_decode($data['body'],true);

	$api = Includes_Requests_Factory::create('classes',array());
	$data = $api->getClasses();
	$classesArray = json_decode($data['body'],true);
	
	$api = Includes_Requests_Factory::create('questions',array());
	$data = $api->getQuestionsByExamId();
	$questionsArray = json_decode($data['body'],true);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('exams',array());
		$res = $api->updateExam($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>

<div id="right_wrap">
	<div id="right_content">
	<h2>Edit Exam</h2>
		<div class="toogle_wrap">
            <div class="trigger"><a href="#">Question Bank</a></div>

            <div class="toggle_container">
				<table id="rounded-corner">
					<thead>
						<tr>
							<th></th>
							<th>No.</th>
							<th>Question</th>
							<th>Question Type</th>
							<!--<th>Edit</th>-->
							<th>Delete</th>
						</tr>
					</thead>
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
							<td><input type="checkbox" name="add_question" id="add_question" /></td>
							<td><?=$item['id']?></td>
							<td><?=$item['question']?></td>
							<td><?=$item['question_type']?></td>
							<!--<td><a href="<?=BASE_URL?>/p/questions/edit_question.php?class_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a></td>-->
							<td><a href="<?=BASE_URL?>/p/questions/delete_question.php?class_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/trash.gif" alt="" title="" border="0" /></a></td>
						</tr>
						<?php $counter+=1;?>
					<?php endforeach; ?>
					
					</tbody>
				</table>
            </div>
        </div>
		
		<form name="edit_exam" method="post" action="">
			<div class="form">
				<div class="form_row">
				<label>Exam Title:</label>
				<input type="text" class="form_input" name="code" id="code" value=""/>
				</div>
				
				<div class="form_row">
					<label>Class:</label>
					<select class="form_select" name="class">
						<?php foreach($classesArray['data'] as $id=>$item):?>
						<!--<option value="<?=$item['id']?>"><?=$item['code']?> - <?=$item['title']?></option>-->
						<option value="<?=$item['id']?>" <?=($item['id']==$examArray['data']['category_id']) ? ' selected' :''?>><?=$item['code']?> - <?=$item['title']?></option>
						
						<?php endforeach;?>
					</select>
				</div>
				
				<div class="form_row">
					<label>Status:</label>
					<select class="form_select" name="status">
						<option value="open"   >Open</option>
						<option value="closed" >Closed</option>
					</select>
				</div>
				<br>
				<br>
				
				<?php if(!empty($examArray['data'])):?>
				
				<div class="form_row">
					<h2>Exam Questions</h2>
					<table id="rounded-corner">
						<tbody>
							<?php $counter = 0; ?>
							<?php foreach($questionsArray['data'] as $id=>$item):?>
								<?php $class = ($counter % 2) ? 'even' : 'odd';?>
								<tr class="<?=$class?>">
								
								
									<?php if($item['question_type']=='short_answer'):?>
									<div class="form">
										<div class="form_row">
										<label>Question: <?=$item['question']?></label>
										</div>
										 
										<div class="form_row">
										<label>Answer:</label>
										<textarea rows="4" cols="50" type="text" class="form_input" name="answer" id="answer" value="<?=$item['answer']?>" readonly></textarea>
										</div>
									</div>
									
									
									<? elseif($item['question_type']=='multiple_choice'): ?>
									<div class="form">
										<div class="form_row">
										<label>Question: <?=$item['question']?></label>
										</div>
										
										<div class="form_row">
										<label><?=$item['choice1']?>:</label>
										<input type="radio" class="form_input" name="correct" <?php $item['answer']==1 ? 'checked' : 'disabled';?>>
										</div>
										
										<div class="form_row">
										<label><?=$item['choice2']?>:</label>
										<input type="radio" class="form_input" name="correct" <?php $item['answer']==2 ? 'checked' : 'disabled';?>>
										</div>
										
										<div class="form_row">
										<label><?=$item['choice3']?>:</label>
										<input type="radio" class="form_input" name="correct" <?php $item['answer']==3 ? 'checked' : 'disabled';?>>
										</div>
										
										<div class="form_row">
										<label><?=$item['choice4']?>:</label>
										<input type="radio" class="form_input" name="correct" <?php $item['answer']==4 ? 'checked' : 'disabled';?>>
										</div>
									</div>
									
									
									<? elseif($item['question_type']=='true_or_false'): ?>
									<div class="form">
										<div class="form_row">
										<label>Question: <?=$item['question']?></label>
										</div>
										
										<div class="form_row">
										<label>True:</label>
										<input type="radio" class="form_input" name="correct" value="T" <?php $item['answer']==1 ? 'checked' : 'disabled';?>>
										</div>
										
										<div class="form_row">
										<label>False:</label>
										<input type="radio" class="form_input" name="correct" value="F" <?php $item['answer']==1 ? 'checked' : 'disabled';?>>
										</div>

									</div>
									
									
									<? elseif($item['question_type']=='fill_in_the_blank'): ?>
									<div class="form">
										<div class="form_row">
										<label>Question: <?=$item['question']?></label>
										</div>
										 
										<div class="form_row">
										<label>Answer:</label>
										<input type="text" class="form_input" name="answer" id="answer" value="" readonly />
										</div>

									</div>
									
									<?php endif?>
								</tr>
								<?php $counter+=1;?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				
				<?php endif?>
				

				<div class="form_row">
					<input type="hidden" class="form_input" name="id" id="id" value="1"/>
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

