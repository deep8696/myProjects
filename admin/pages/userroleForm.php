<?php 
		if(isset($_POST['btnSave']))
			{
				$t1 = $_POST['txtUserrole'];
				
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
	 
	 			$dup = mysql_query("select * from usertype_master where user_type='".$t1."'");
				$num_rows=mysql_num_rows($dup);
				if($num_rows>0){
					echo "<script>alert('Already on database !!!!!..')</script>";
				}
	 			
				else{
				mysql_query("Insert into usertype_master values(null,'$t1')");
	
				echo "<script>alert('Your Data is Succssfully Store.')</script>";
				}
			}	

	?>
 <form method="post" action="admin.php?page=pages/userroleForm.php">   
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">User Role</h1>
             	<a href="admin.php?page=pages/userroleList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a>
        </div>

	
     <div class="panel panel-admin">
        <div class="panel-header">
            Create UserRole
        </div>
        <div class="panel-body">
            <div class="form-vertical">
                <div class="form-group">
                    <label>User Role</label>
                    <input type="text" name="txtUserrole" id="txtUserrole" class="form-control" />
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
            <a href="admin.php?page=pages/userroleList.php" class="btn btn-link">Cancel</a>
        </div>
    </div>
    </div>
    
    
    
</form>