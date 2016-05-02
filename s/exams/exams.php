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
	
	$questionApi = Includes_Requests_Factory::create('questions',array());
	//dd($examsArray);
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
		            <th>Take</th>
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
		    <?php 
			    $grades = $questionApi->getStudentGrade($item['id'],$_SESSION['id']);
			    $gradesArray = json_decode($grades['body'],true);
			    //dd($gradesArray['data']);
		    ?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<?php if($item['is_complete']==0 && $item['is_available']==1 && empty($gradesArray['data'])): ?>
		    	<tr class="<?=$class?>">
		            <td><?=$item['id']?></td>
		            <td><?=$item['code']?></td>
		            <td><?=$item['class_title']?></td>
		            <td><?=$item['title']?></td>
		            <td><a href="<?=BASE_URL?>/s/exams/take_exam.php?exam_id=<?=$item['id']?>&class_id=<?=$item['class_id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png"/></a></td>
				</tr>
				<?php $counter+=1;?>
				<?php endif?>
		  <?php endforeach; ?>
		        
		    </tbody>
		</table>
     </div>
</div>


<?php require_once '../../template/footer.php'; ?>