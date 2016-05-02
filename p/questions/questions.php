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
	$api = Includes_Requests_Factory::create('questions',array());
	$questions = $api->getQuestions();
	$questionsArray = json_decode($questions['body'],true);
	//dd($questionsArray);
?>

<div id="right_wrap">
<?=$msg->display()?>
    <div id="right_content">             
    <h2>Question Bank</h2> 
		<table id="rounded-corner">
			<thead>
				<tr>
					<th>No.</th>
					<th>Question</th>
					<th>Question Type</th>
					<th>Edit</th>
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
					<td><?=$item['id']?></td>
					<td><?=$item['question']?></td>
					<td>
						<?php
								$label='Unknow';
								switch($item['question_type']){
									case 'true_or_false':
										$label='True or False';
										break;
									case 'multiple_choice':
										$label='Multiple Choice';
										break;
									case 'fill_in_the_blanks':
										$label='Fill in the Blanks';
										break;
									case 'short_answer':
										$label='Short Answer';
										break;
									default:
										break;
								}
						?>
						<?=$label?>
					</td>
					<td><a href="<?=BASE_URL?>/p/questions/edit_question.php?question_id=<?=$item['id']?>&question_type=<?=$item['question_type']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a></td>
					<td><a href="<?=BASE_URL?>/p/questions/delete_question.php?question_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/trash.gif" alt="" title="" border="0" /></a></td>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			
			</tbody>
		</table>
	</div>
 </div>








<?php require_once '../../template/footer.php'; ?>
