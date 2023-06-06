<?php 
		if(isset($_POST['btnSave']))
			{
				$t1 = $_POST['txtQuestion'];
				$t2 = $_POST['txtAnswer'];
				
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
				
	 
				mysql_query("Insert into faq_master values(null,'$t1','$t2')");
				
	
				echo "<script>alert('Your Data is Succssfully Store.')</script>";

			}	

	?>
 <form method="post" action="admin.php?page=pages/faqsForm.php">   
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">FAQs</h1>
            <a href="admin.php?page=pages/faqsList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a>
        </div>

	
     <div class="panel panel-admin">
        <div class="panel-header">
            Create FAQs
        </div>
        <div class="panel-body">
            <div class="form-vertical">
                <div class="form-group">
                    <label>Question</label>
                    <input type="text" name="txtQuestion" id="txtQuestion" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Answer</label>
                    <textarea rows="5" name="txtAnswer" id="txtAnswer" class="form-control" ></textarea>
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
            <a href="admin.php?page=pages/faqsList.php" class="btn btn-link">Cancel</a>
        </div>
    </div>
    </div>
    </form>