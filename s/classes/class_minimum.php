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
	$class_id = $_GET['class_id'];
	$api = Includes_Requests_Factory::create('exams',array());
	//$exams = $api->getExamsByClassId($class_id);
	$exams = $api->getExamsByStudentId($_SESSION['id']);
	$examsArray = json_decode($exams['body'],true);
	//dd($examsArray);
	
	$questionApi = Includes_Requests_Factory::create('questions',array());
	
	$examTotal = 0;
	$examCount = 0;
	foreach($examsArray['data'] as $id=>$item){
		$grades = $questionApi->getStudentGrade($item['id'],$_SESSION['id']);
		$gradesArray = json_decode($grades['body'],true);
		if (!empty($gradesArray['data']) && $item['is_available']==2)
		{
			if($item['class_id']==$class_id)
			{
				$examTotal += $gradesArray['data']['grade'];
				$examCount += 1;
			}
		}
	}
	
	if ($examCount==0){
		$currentGrade = 0;
	}
	else {
		$currentGrade = round($examTotal / $examCount);
	}
	$gradeAA = round((100*($examCount+1)) - $examTotal);
	$gradeA = round((90*($examCount+1)) - $examTotal);
	$gradeB = round((80*($examCount+1)) - $examTotal);
	$gradeC = round((70*($examCount+1)) - $examTotal);
?>

<div id="right_wrap">
	<div id="right_content">
	<h2>What Do I Need?</h2>
		<form name="add_exam" method="post" action="">
			<div class="form">
				
				<div class="form_row">
				<label>Current Grade: <?=$currentGrade?></label>
				</div>
				
				<div class="form_row">
				<label>Grade Required for A+:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?=$gradeAA?>" readonly/>
				</div>
				
				<div class="form_row">
				<label>Grade Required for A:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?=$gradeA?>" readonly/>
				</div>
				
				<div class="form_row">
				<label>Grade Required for B:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?=$gradeB?>" readonly/>
				</div>
				
				<div class="form_row">
				<label>Grade Required for C:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?=$gradeC?>" readonly/>
				</div>
				 
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>

