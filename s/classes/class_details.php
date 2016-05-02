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
	if(empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . '/s/classes/classes.php' ) ;
	}
	
	$api = Includes_Requests_Factory::create('classes',array());
	$class_id = $_GET['class_id'];
	
	$classDetails = $api->getClassById($class_id);
	$classArray = json_decode($classDetails['body'],true);
	//dd($classArray);
	
	$exams = $api->getExamsByClassId($class_id);
	$examsArray = json_decode($exams['body'],true);
	
	$questionApi = Includes_Requests_Factory::create('questions',array());
?>

<div id="right_wrap">
	<div id="right_content">
		<h2><?=($classArray['data']['code'])?> - <?=($classArray['data']['title'])?></h2>
		<!--p>Status: <?=($classArray['data']['status'])?></p-->
		<table id="rounded-corner">
		    <thead>
		    	<tr>
		            <th>Title</th>
		            <th>Grade</th>
		            <th>View</th>
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
				<?php if(!empty($gradesArray['data'])): ?>
		    	<tr class="<?=$class?>">
		            <td><?=$item['title']?></td>
		            <td>
		            	<?//=($item['is_available']) ? 'Open' : 'Closed' ?>
		            	<?php 
			            	if(!empty($gradesArray['data']) && $gradesArray['data']['is_complete']==2){
			            		echo $gradesArray['data']['grade'];
			            	} else if($gradesArray['data']['is_complete']==1){
			            		echo "<a href='#'>Not Available</a>";
			            	}
			            ?>
		            </td>
		            <td>
		            <?php 
		            	if(!empty($gradesArray['data']) && $gradesArray['data']['is_complete']==2){
		            		//dd($gradesArray['data']);
		            		echo "<a href='".BASE_URL. "/s/exams/view_results.php?exam_id=".$item['id']."&class_id=".$class_id."'>View</a>";
		            	} else if($gradesArray['data']['is_complete']==1){
		            		echo "<a href='#'>Not Available</a>";
		            	}
		            ?>
		            </td>
				</tr>
				<?php $counter+=1;?>
				<?php endif?>
		  <?php endforeach; ?>
		        
		    </tbody>
		</table>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>

