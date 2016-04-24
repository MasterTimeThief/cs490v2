<?php session_start();?>
<?php require_once '../../bootstrap.php'; ?>
<?php require_once '../../template/header.php'; ?>

<div id="right_wrap">
    <div id="right_content">             
    	<h2>Edit Class</h2>
    		<form name="edit_class" method="post" action="">
		    	<div class="form">
		            
		            <div class="form_row">
		            <label>Code:</label>
		            <input type="text" class="form_input" name="code" id="code" value="CS100"/>
		            </div>
		             
		            <div class="form_row">
		            <label>Title:</label>
		            <input type="text" class="form_input" name="title" id="title" value="ROADMAP TO COMPUTING"/>
		            </div>
		            
		            <div class="form_row">
			            <label>Category:</label>
			            <select class="form_select" name="category_id">
			            				            	<option value="1"  selected>CS - Computer Science</option>
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
			            	<option value="open"    selected>Open</option>
			            	<option value="closed" >Closed</option>
			            </select>
		            </div>

		            <div class="form_row">
		            	<input type="hidden" class="form_input" name="class_id" id="class_id" value="1"/>
		            </div>
		            <div class="form_row">
		            <input type="submit" class="form_submit" value="Submit" />
		            </div> 
		            <div class="clear"></div>
		        </div>
        	</form>
    </div>
</div>


<div class="clear"></div>
    </div> <!--end of center_content-->
    
    <div class="footer">
			<center><p><strong>2016</strong></p></center>
</div>

</div>

    	
</body>
</html>