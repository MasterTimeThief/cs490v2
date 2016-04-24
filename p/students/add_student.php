<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('classes',array());
	$classes = $api->getClasses();
	$classesArray = json_decode($classes['body'],true);
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('students',array());
		$res = $api->addStudent($_POST);
		$msg->success('Record Updated');
		header('Location: ' .BASE_URL . '/p/students/students.php');
	}
	
?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>Add Students</h2>
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
		            <input type="submit" class="form_submit" value="Submit" />
		            </div> 
		            <div class="clear"></div>
		        </div>
        	</form>
    </div>
</div>
<?php require_once '../../template/footer.php'; ?>
