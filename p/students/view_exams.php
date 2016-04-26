<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	$api = Includes_Requests_Factory::create('students',array());
	if(empty($_GET['student_id'])){
		header('Location: ' . BASE_URL . '/p/students/students.php' ) ;
	}
	$student_id = $_GET['student_id'];
	
	$exams = $api->getExamsByStudentId($student_id); // Todo
	$examsArray = json_decode($exams['body'],true);
?>

<div id="right_wrap">
    <div id="right_content">             
    <h2>Available Exams</h2> 
		<table id="rounded-corner">
			<thead>
				<tr>
					<th>Id</th>
					<th>Class CODE</th>
					<th>Class Title</th>
					<th>Exam Title</th>
					<th>Exam Status</th>
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
				<?php $class = ($counter % 2) ? 'even' : 'odd';?>
				<tr class="<?=$class?>">
					<td><?=$item['id']?></td>
					<td><?=$item['code']?></td>
					<td><?=$item['class_title']?></td>
					<td><?=$item['title']?></td>
					<td><?=($item['is_available']) ? 'Open' : 'Closed'?></td>
				</tr>
				<?php $counter+=1;?>
		  <?php endforeach; ?>
				
			</tbody>
		</table>
     </div>
     </div>


<?php require_once '../../template/footer.php'; ?>