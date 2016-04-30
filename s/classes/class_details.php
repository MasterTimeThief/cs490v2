<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<?php 
	if(empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . '/s/classes/classes.php' ) ;
	}
	$class_id = $_GET['class_id'];
		$api = Includes_Requests_Factory::create('classes',array());
	if(empty($_GET['class_id'])){
		header('Location: ' . BASE_URL . '/p/classes/classes.php' ) ;
	}
	$class_id = $_GET['class_id'];
	
	$classDetails = $api->getClassById($class_id);
	$classArray = json_decode($classDetails['body'],true);
	//dd($classArray);
	
	$exams = $api->getExamsByClassId($class_id);
	$examsArray = json_decode($exams['body'],true);
?>

<div id="right_wrap">
	<div id="right_content">
		<h2><?=($classArray['data']['title'])?></h2>
		<p>Status: <?=($classArray['data']['status'])?></p>
		<p>Code: <?=($classArray['data']['code'])?></p>
		
		
		<table id="rounded-corner">
				    <thead>
				    	<tr>
				            <th>Title</th>
				            <th>Is Available</th>
				            <th>Actions</th>
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
				            <td><?=$item['title']?></td>
				            <td><?=$item['is_available']?></td>
				            <td>
				            <?php 
				            	if($item['is_available']==1){
				            		echo "<a href='".BASE_URL. "/s/exams/take_exam.php?exam_id=".$item['id']."'>Take</a>";
				            	}
				            ?>
				            
				            
				            </td>
						</tr>
						<?php $counter+=1;?>
				  <?php endforeach; ?>
				        
				    </tbody>
		</table>
		
		
		
		
		
	</div>
</div>
<?php require_once '../../template/footer.php'; ?>

