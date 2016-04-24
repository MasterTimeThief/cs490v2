<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('classes',array());
	if(empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . '/p/classes/classes.php' ) ;
	}
	$class_id = $_GET['class_id'];
	
	$data = $api->getClassById($class_id);
	$classArray = json_decode($data['body'],true);

	$api = Includes_Requests_Factory::create('categories',array());
	$data = $api->getCategories();
	$categoriesArray = json_decode($data['body'],true);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('classes',array());
		$res = $api->updateClass($_POST);
		$resArray = json_decode($res['body'],true);
		$msg->success('Record Updated');
	}
?>

<div id="right_wrap">
	<p><?=$msg->display();?></p>
    <div id="right_content">             
    	<h2>Edit Class</h2>
    		<form name="edit_class" method="post" action="">
		    	<div class="form">
		            <div class="form_row">
		            <label>Code:</label>
		            <input type="text" class="form_input" name="code" id="code" value="<?=$classArray['data']['code']?>"/>
		            </div>
		             
		            <div class="form_row">
		            <label>Title:</label>
		            <input type="text" class="form_input" name="title" id="title" value="<?=$classArray['data']['title']?>"/>
		            </div>
		            
		            <div class="form_row">
			            <label>Category:</label>
			            <select class="form_select" name="category_id">
			            	<?php foreach($categoriesArray['data'] as $id=>$item):?>
			            	<option value="<?=$item['id']?>" <?=($item['id']==$classArray['data']['category_id']) ? ' selected' :''?>><?=$item['code']?> - <?=$item['title']?></option>
			            	<?php endforeach;?>
			            </select>
		            </div>
		            
		            <div class="form_row">
			            <label>Status:</label>
			            <select class="form_select" name="status">
			            	<option value="open"   <?=($classArray['data']['status']=='open')   ? ' selected': ''?>>Open</option>
			            	<option value="closed" <?=($classArray['data']['status']=='closed') ? ' selected': ''?>>Closed</option>
			            </select>
		            </div>

		            <div class="form_row">
		            	<input type="hidden" class="form_input" name="id" id="id" value="<?=$classArray['data']['id']?>"/>
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