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
	$api = Includes_Requests_Factory::create('classes',array());
	$classes = $api->getClassesByStudentId($_SESSION['id']);
	$classesArray = json_decode($classes['body'],true);
?>

<div id="right_wrap">
<?=$msg->display()?>
    <div id="right_content">             
    <h2>Available classes</h2> 
		<table id="rounded-corner">
			<thead>
				<tr>
					<th>Code</th>
					<th>Title</th>
					<th>View Details</th>
				</tr>
			</thead>
				<tfoot>
				<tr>
					<td colspan="12"></td>
				</tr>
			</tfoot>
			<tbody>
			<?php $counter = 0; ?>
			<?php foreach($classesArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
					<td><?=$item['code']?></td>
					<td><?=$item['title']?></td>
					<td>
						<a href="<?=BASE_URL?>/s/classes/class_minimum.php?class_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a>
						<a href="<?=BASE_URL?>/s/classes/class_details.php?class_id=<?=$item['id']?>">Details</a>
					</td>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
 </div>


<?php require_once '../../template/footer.php'; ?>