<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('classes',array());
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . '/s/index.php' ) ;
	}
	$student_id = $_GET['student_id'];
	$classes = $api->getClassesBy StudentId($student_id);
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
					<th>Category</th>
					<th>Status</th>
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
					<td><?=$item['category']?></td>
					<td><?=$item['status']?></td>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
 </div>


<?php require_once '../../template/footer.php'; ?>