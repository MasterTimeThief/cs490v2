<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>

<?php require_once '../../template/header.php'; ?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>Add Class</h2>
    		<form name="edit_class" method="post" action="">
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
							<option value="" selected>-- Select-- </option>
							<option value="1" >CS - Computer Science</option>
							<option value="2" >IT - Information Technology</option>
							<option value="3" >CIS - Civil Engineering</option>
							<option value="4" >CHEM - Chemistry</option>
							<option value="5" >ECON - Economics</option>
							<option value="6" >ENG - English</option>
							<option value="7" >HIST - History</option>
							<option value="8" >FIN - Finance</option>
						</select>
		            </div>
		            
		            <div class="form_row">
			            <label>Status:</label>
			            <select class="form_select" name="status">
			            	<option value=""  selected>-- Select-- </option>
							<option value="open"   >Open</option>
			            	<option value="closed">Closed</option>
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
