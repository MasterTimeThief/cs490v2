<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../../assets/css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
<!-- jQuery file -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var $ = jQuery.noConflict();
$(function() {
$('#tabsmenu').tabify();
$(".toggle_container").hide(); 
$(".trigger").click(function(){
	$(this).toggleClass("active").next().slideToggle("slow");
	return false;
});
});
</script>
</head>
<body>
<?php
$current_page =  basename($_SERVER['PHP_SELF']);
$page = substr($current_page,0,strpos($current_page,"."));
$parent = $menuObject->get_parent($page);
?>
<div id="panelwrap">
  	
	<div class="header">
    <div class="title"><a href="/~wad3/p/index/index.php">Online Exam System</a></div>
    
    <div class="header_right">Welcome Admin, <a href="~wad3/p/index/settings.php" class="settings">Settings</a> <a href="#" class="logout">Logout</a> </div>
    <?php if(!empty($menu)):?>
	<div class="menu">
    	<ul>
    	<?php foreach($menu as $index=>$item):?>
    	<?php $p = basename($item['url']);?>
    	<?php $p = substr($p,0, strpos($p,'.'));?>
			 <li><a href="<?=$item['url']?>" <?=($p==$parent) ? 'class="selected"' : '' ?>><?=$item['name']?></a></li>
    	<?php endforeach; ?>
    	</ul>

    </div> </div><!-- Menu ends Here -->
    <?php if(isset($menu[$parent]['links'])):?>
    		<div class="submenu">
			    <ul>
			    <?php foreach($menu[$parent]['links'] as $subindex=>$item):?>
			    	<?php $p = basename($item['url']);?>
			    	<li><a href="<?=$item['url']?>" <?=($p==$current_page) ? 'class="selected"' : '' ?>><?=$item['name']?></a></li>
			    <?php endforeach;?>
			    </ul>
			    </div>
    <?php endif;?>
    <!-- <div class="menu">
    <ul>
    <li><a href="#" class="selected">Main page</a></li>
    <li><a href="#">Classes</a></li>
    <li><a href="#">Students</a></li>
    <li><a href="#">Exams</a></li>
    <li><a href="#">Categories</a></li>
    <li><a href="#">Options</a></li>
    <li><a href="#">Admin settings</a></li>
    <li><a href="#">Help</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
    <li><a href="#" class="selected">settings</a></li>
    <li><a href="#">users</a></li>
    <li><a href="#">categories</a></li>
    <li><a href="#">edit section</a></li>
    <li><a href="#">templates</a></li>
    </ul>
    </div>     -->     
	<?php endif;?>
    <div class="center_content"> 