<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<div id="right_wrap"><div id="right_content">
<h2>Add Exam</h2>



<!--







<div class="form">
<form class="create_exam" id="create_exam" name="create_exam" method="post" action="">
	<div class="form_row">
	<label for="title">Title <span class="required">*</span></label>
	<input type="text" id="title" name="title" value="" required="required" autofocus="autofocus"/>
	</div>
	 
	<div class="form_row">
	<label for="enquiry">Class: <span class="required">*</span></label>
	<select name="classes" class="classes" id="classes">
		<option value="">-- Select-- </option>
	</select>
	</div>
	<input type="hidden" name="professor_id" class="professor_id" id="professor_id" value="<?=$_SESSION['id']?>"/>
	<input type="hidden" name="method" class="method" id="method" value="create_exam"/>
	<span id="loading"></span>
	<input type="submit" class="form_submit" value="Create" id="submit-button" />
	<p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
</form>
</div>


-->









<form name="add_exam" method="post" action="">
	<div class="form">
		<div class="form_row">
		<label>Exam Title:</label>
		<input type="text" class="form_input" name="code" id="code" value=""/>
		</div>
		
		<div class="form_row">
			<label>Class:</label>
			<select name="classes" class="classes" id="classes">
				<option value="">-- Select-- </option>
			</select>
		</div>
		
		<div class="form_row">
			<label>Status:</label>
			<select class="form_select" name="status">
				<option value="open"   >Open</option>
				<option value="closed"  selected>Closed</option>
			</select>
		</div>

		<div class="form_row">
			<input type="hidden" class="form_input" name="id" id="id" value="1"/>
		</div>
		<div class="form_row">
		<input type="submit" class="form_submit" value="Submit" />
		</div> 
		<div class="clear"></div>
	</div>
</form>
</div>
</div>
<?php require_once '../../template/footer.php'; ?>

