<?php 
		if(isset($_POST['btnSave']))
			{
				$t1 = $_POST['txtState'];
				
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
				$dup = mysql_query("select * from state_master where state='".$t1."'");
				$num_rows=mysql_num_rows($dup);
				if($num_rows>0){
					echo "<script>alert('Already on database !!!!!..')</script>";
				}
	 			
				else{
				mysql_query("Insert into state_master values(null,'$t1')");
	
				echo "<script>alert('Your Data is Succssfully Store.')</script>";
				}
			}	

	?>
 <form method="post" action="admin.php?page=pages/stateForm.php">   
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">State</h1>
           <a href="admin.php?page=pages/stateList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a>
        </div>

	
     <div class="panel panel-admin">
        <div class="panel-header">
            Add State
        </div>
        <div class="panel-body">
            <div class="form-vertical">
           
                <div class="form-group">
                    <label>State</label><input type="text" name="txtState" id="txtState" class="form-drop-control"/>
                    
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
            <a href="admin.php?page=pages/stateList.php" class="btn btn-link">Cancel</a>
        </div>
    </div>
    </div>
    </form>