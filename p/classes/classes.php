<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>
<h2>Classes</h2>
<?php 
	$api = Includes_Requests_Factory::create('classes',array());
	var_dump($api);
?>
<?php require_once '../../template/footer.php'; ?>
