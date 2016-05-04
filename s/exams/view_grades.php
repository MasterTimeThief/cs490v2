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
	$api = Includes_Requests_Factory::create('students',array());
	$student_id = $_SESSION['id'];
	$exams = $api->getGradedExamsByStudentId($student_id); // Todo
	$examsArray = json_decode($exams['body'],true);
	//dd($examsArray);
?>

<div id="right_wrap">
    <div id="right_content">             
    <h2>Graded Exams</h2> 
		<table id="rounded-corner">
		    <thead>
		    	<tr>
		            <th>Id</th>
		            <th>Class CODE</th>
		            <th>Class Title</th>
					<th>Exam Title</th>
		            <th>Exam Grade</th>
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
		    	<?php //if($item['is_complete']==2):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
		    	<tr class="<?=$class?>">
		            <td><?=$item['id']?></td>
		            <td><?=$item['code']?></td>
		            <td><?=$item['class_title']?></td>
		            <td><?=$item['title']?></td>
		            <td><?=($item['grade'])?></td>
				</tr>
				<?php $counter+=1;?>
				<?php //endif?>
		  <?php endforeach; ?>
		        
		    </tbody>
		</table>
     </div>
     </div>


<?php require_once '../../template/footer.php'; ?>