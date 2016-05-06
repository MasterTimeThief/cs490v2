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
	$api = Includes_Requests_Factory::create('exams',array());
	$exams = $api->getExamsByProfessorId($_SESSION['id']); // Todo
	$examsArray = json_decode($exams['body'],true);
	
	$api = Includes_Requests_Factory::create('students',array());
	$students = $api->getStudents();
	$studentsArray = json_decode($students['body'],true);
	
	$questionApi = Includes_Requests_Factory::create('questions',array());
?>

<div id="right_wrap">
	<p><?=$msg->display();?></p>
    <div id="right_content">             
    <h2>Taken Exams</h2> 
		<table id="rounded-corner">
		    <thead>
		    	<tr>
		            <th>First Name</th>
		            <th>Last Name</th>
		            <th>Exam Title</th>
					<th>Grade</th>
		        </tr>
		    </thead>
		        <tfoot>
		    	<tr>
		        	<td colspan="12"></td>
		        </tr>
		    </tfoot>
		    <tbody>
		    <?php $counter = 0; ?>
		    <?php foreach($studentsArray['data'] as $id=>$studentItem):?>
			    <?php foreach($examsArray['data'] as $id=>$examItem):?>
			    	<?php //dd($examItem);?>
			    	<?php 
					    $grades = $questionApi->getStudentGrade($examItem['id'],$studentItem['id']);
					    $gradesArray = json_decode($grades['body'],true);
					    //dd($gradesArray);
				    ?>
		    		<?php if(!empty($gradesArray['data']) && $gradesArray['data']['is_complete']==1):?>
			    		<?php 
			    		foreach($studentsArray['data'] as $id=>$studentItem2)
			    		{
			    			if ($studentItem2['id']===$gradesArray['data']['student_id'])
			    			{
			    				$firstName = $studentItem2['first_name'];
								$lastName = $studentItem2['last_name'];
			    				break;
			    			}
			    		}
			    		foreach($examsArray['data'] as $id=>$examItem2)
			    		{
			    			if ($examItem2['id']===$gradesArray['data']['exam_id'])
			    			{
			    				$examTitle = $examItem2['title'];
			    				break;
			    			}
			    		}?>
			    		<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				    	<tr class="<?=$class?>">
				            <td><?=$firstName?></td>
				            <td><?=$lastName?></td>
				            <td><?=$examTitle?></td>
				            <td><?=$gradesArray['data']['grade']?></td>
						</tr>
						<?php $counter+=1;?>
		    		<?php endif?>
		    	<?php endforeach; ?>
		    <?php endforeach; ?>
		    <!--
		    <?php foreach($examsArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
			    	<tr class="<?=$class?>">
			            <td><?=$item['id']?></td>
			            <td><?=$item['code']?></td>
			            <td><?=$item['class_title']?></td>
			            <td><?=$item['title']?></td>
			            <td><a href="<?=BASE_URL?>/p/exams/release_exam.php?exam_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a></td>
					</tr>
					<?php $counter+=1;?>
			  <?php endforeach; ?>
			  -->
		    </tbody>
		</table>
     </div>
     </div>


<?php require_once '../../template/footer.php'; ?>