<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('students',array());
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . '/p/students/students.php' ) ;
	}
	$student_id = $_GET['student_id'];
	
	$data = $api->getStudentById($student_id);
	$studentArray = json_decode($data['body'],true);

	$api = Includes_Requests_Factory::create('classes',array());
	$data = $api->getClasses();
	$classesArray = json_decode($data['body'],true);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('students',array());
		$res = $api->updateStudent($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>Edit Students</h2>
    		<form name="add_class" method="post" action="">
		    	<div class="form">
		            <div class="form_row">
		            <label>Student Name:</label>
		            <input type="text" class="form_input" name="name" id="name" value=""/>
		            </div>
		             
		            <div class="form_row">
		            <label>UCID:</label>
		            <input type="text" class="form_input" name="ucid" id="ucid" value=""/>
		            </div>
		            
		            <div class="form_row">
						<label>Class:</label>
						<select class="form_select" name="class">
							<?php foreach($classesArray['data'] as $id=>$item):?>
							<option value="<?=$item['id']?>"><?=$item['code']?> - <?=$item['title']?></option>
							<?php endforeach;?>
						</select>
					</div>
		            
		            <div class="form_row">
		            <input type="submit" class="form_submit" value="Update" />
		            </div> 
		            <div class="clear"></div>
		        </div>
        	</form>
    </div>
</div>
<?php require_once '../../template/footer.php'; ?>
