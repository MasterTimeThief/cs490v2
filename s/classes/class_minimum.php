<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	if(empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . '/s/classes/classes.php' ) ;
	}
	$class_id = $_GET['class_id'];
	$api = Includes_Requests_Factory::create('exams',array());
	$exams = $api->getGradedExamsByClassId($class_id);
	$examsArray = json_decode($exams['body'],true);
	
	$examTotal = 0;
	$examCount = 1;
	foreach($examsArray['data'] as $id=>$item){
		$examTotal += $item['grade'];
		$examCount += 1;
	}
	
	$currentGrade = $examTotal / ($examCount - 1);
	$gradeAA = (100*$examCount) - $examTotal;
	$gradeA = (90*$examCount) - $examTotal;
	$gradeB = (80*$examCount) - $examTotal;
	$gradeC = (70*$examCount) - $examTotal;
?>

<div id="right_wrap">
	<div id="right_content">
	<h2>Add Exam</h2>
		<form name="add_exam" method="post" action="">
			<div class="form">
				
				<div class="form_row">
				<label>Current Grade: <?=$currentGrade?></label>
				</div>
				
				<div class="form_row">
				<label>Grade Required for A+:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?$gradeAA?>" readonly/>
				</div>
				
				<div class="form_row">
				<label>Grade Required for A:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?$gradeA?>" readonly/>
				</div>
				
				<div class="form_row">
				<label>Grade Required for B:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?$gradeB?>" readonly/>
				</div>
				
				<div class="form_row">
				<label>Grade Required for C:</label>
				<input type="text" class="form_input_short" name="title" id="title" value="<?$gradeC?>" readonly/>
				</div>
				 
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>

