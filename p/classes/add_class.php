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
	$api = Includes_Requests_Factory::create('categories',array());
	$data = $api->getCategories();
	$categoriesArray = json_decode($data['body'],true);
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$api = Includes_Requests_Factory::create('classes',array());
		$res = $api->addClass($_POST);
		$msg->success('Record Updated');
		header('Location: ' .BASE_URL . '/p/classes/classes.php');
	}
	
?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>Add Class</h2>
    		<form name="add_class" method="post" action="">
		    	<div class="form">
		            <div class="form_row">
		            <label>Code:</label>
		            <input type="text" class="form_input" name="code" id="code" value=""/>
		            </div>
		             
		            <div class="form_row">
		            <label>Title:</label>
		            <input type="text" class="form_input" name="title" id="title" value=""/>
		            </div>
		            
		            <div class="form_row">
			            <label>Category:</label>
			            <select class="form_select" name="category_id">
			            	<?php foreach($categoriesArray['data'] as $id=>$item):?>
			            	<option value="<?=$item['id']?>"><?=$item['code']?> - <?=$item['title']?></option>
			            	<?php endforeach;?>
			            </select>
		            </div>
		            
		            <div class="form_row">
			            <label>Status:</label>
			            <select class="form_select" name="status">
							<option value="open">Open</option>
			            	<option value="closed">Closed</option>
			            </select>
		            </div>
		            <div class="form_row">
		            <input type="submit" class="form_submit" value="Add" />
		            </div> 
		            <div class="clear"></div>
		        </div>
        	</form>
    </div>
</div>
<?php require_once '../../template/footer.php'; ?>
