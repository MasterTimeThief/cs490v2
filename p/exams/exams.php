<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>
<h2>Exams</h2>
<?php 
	$api = Includes_Requests_Factory::create('exams',array());
	$exams = $api->getExams();
	$examsArray = json_decode($exams['body'],true);
?>
<?php require_once '../../template/footer.php'; ?>

<div id="right_wrap">
    <div id="right_content">             
    <h2>Available Exams</h2> 

<table id="rounded-corner">
    <thead>
    	<tr>
            <th>Class Code</th>
            <th>Exam Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Edit</th>
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
    <?php foreach($examsArray['data'] as $id=>$item):?>
		<?php $class = ($counter % 2) ? 'even' : 'odd';?>
    	<tr class="<?=$class?>">
            <td><?=$item['code']?></td>
            <td><?=$item['title']?></td>
            <td><?=$item['category']?></td>
            <td><?=$item['status']?></td>
            <td><a href="<?=BASE_URL?>p/exams/edit_exam.php?class_id=<?=$item['id']?>"><img src="<?=BASE_URL?>/assets/images/edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#"><img src="<?=BASE_URL?>/assets/images/trash.gif" alt="" title="" border="0" /></a></td>
		</tr>
		<?php $counter+=1;?>
  <?php endforeach; ?>
        
    </tbody>
</table>

      
     </div>
     </div>


<?php require_once '../../template/footer.php'; ?>