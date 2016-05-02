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
	$student_id = $_SESSION['id'];
	$api = Includes_Requests_Factory::create('exams',array());
	$exams = $api->getExamsByStudentId($student_id); // Todo
	$examsArray = json_decode($exams['body'],true);
?>

<div id="right_wrap">
    <div id="right_content">             
    <h2>Available Exams</h2> 
		<table id="rounded-corner">
		    <thead>
		    	<tr>
		            <th>Id</th>
		            <th>Class CODE</th>
		            <th>Class Title</th>
					<th>Exam Title</th>
		            <th>Exam Status</th>
		            <th>Actions</th>
		        </tr>
		    </thead>
		        <tfoot>
		    	<tr>
		        	<td colspan="12"></td>
		        </tr>
		    </tfoot>
		    <tbody>
		    <?php $counter = 0; ?>
		    <?php foreach($examsArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
		    	<tr class="<?=$class?>">
		            <td><?=$item['id']?></td>
		            <td><?=$item['code']?></td>
		            <td><?=$item['class_title']?></td>
		            <td><?=$item['title']?></td>
		            <td><?=($item['is_available']) ? 'Open' : 'Closed'?></td>
		            <td>
						   <?php //dd($item);?>		            
		            	<?php if($item['is_complete']==1): ?>
		            		<a href="<?=BASE_URL?>/s/exams/view_results.php?exam_id=<?=$item['id']?>&class_id=<?=$item['class_id']?>">View</a>
		            	<?php elseif($item['is_available']==0):?>
		            		<span>Not Available</span>
		            	<?php else: ?>
		            		<a href="<?=BASE_URL?>/s/exams/take_exam.php?exam_id=<?=$item['id']?>&class_id=<?=$item['class_id']?>">Take</a>
		            	<?php endif; ?>
		            </td>
				</tr>
				<?php $counter+=1;?>
		  <?php endforeach; ?>
		        
		    </tbody>
		</table>
     </div>
</div>


<?php require_once '../../template/footer.php'; ?>