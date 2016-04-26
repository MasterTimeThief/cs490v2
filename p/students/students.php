<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('students',array());
	$students = $api->getStudents();
	$studentsArray = json_decode($students['body'],true);
?>

<div id="right_wrap">
<?=$msg->display()?>
    <div id="right_content">             
    <h2>Students</h2> 
		<table id="rounded-corner">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Edit</th>
					<th>View Exams</th>
					<th>Delete</th>
				</tr>
			</thead>
				<tfoot>
				<tr>
					<td colspan="12"></td>
				</tr>
			</tfoot>
			<tbody>
			<?php $counter = 0; ?>
			<?php foreach($studentsArray['data'] as $id=>$item):?>
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
					<td><?=$item['first_name']?></td>
					<td><?=$item['last_name']?></td>
					<td><?=$item['email']?></td>
					<td><a href="<?=BASE_URL?>/p/students/edit_student.php?students_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a></td>
					<td><a href="<?=BASE_URL?>/p/students/view_exams.php?students_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a></td>
					<td><a href="<?=BASE_URL?>/p/students/delete_student.php?students_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/trash.gif" alt="" title="" border="0" /></a></td>
				</tr>
				<?php $counter+=1;?>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
 </div>
<?php require_once '../../template/footer.php'; ?>
