<?php 
		if(isset($_POST['btnSave']))
			{
				$t1 = $_POST['txtLaboratorytype'];
				
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
				
	 			$dup = mysql_query("select * from labtype_master where labtype_name='".$t1."'");
				$num_rows=mysql_num_rows($dup);
				if($num_rows>0){
					echo "<script>alert('Already on database !!!!!..')</script>";
				}
	 			
				else{
				mysql_query("Insert into labtype_master values(null,'$t1')");
	
				echo "<script>alert('Your Data is Succssfully Store.')</script>";
				}
			}	

	?>
 <form method="post" action="admin.php?page=pages/laboratorytypesForm.php">   
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">Laboratory Types</h1>
           <a href="admin.php?page=pages/laboratorytypesList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a>
        </div>

	
     <div class="panel panel-admin">
        <div class="panel-header">
            Add Laboratory Type
        </div>
        <div class="panel-body">
            <div class="form-vertical">
                <div class="form-group">
                    <label>Laboratory Type</label>
                    <input type="text" name="txtLaboratorytype" id="txtLaboratorytype" class="form-control" />
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
            <a href="admin.php?page=pages/laboratorytypesList.php" class="btn btn-link">Cancel</a>
        </div>
    </div>
    </div>
    </form>