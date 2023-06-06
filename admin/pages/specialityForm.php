<?php 
$edit= $t1 ="";
		if(isset($_REQUEST['edit']))
		{
			$edit = $_REQUEST['edit'];
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
	 			$dup = mysql_query("select * from speciality where sp_id=".$edit."");
				$num_rows=mysql_num_rows($dup);
				if($num_rows>0){
					while($result = mysql_fetch_array($dup))
					{
						$t1 = $result["specialist"];
					}
				}
		}
		
		if(isset($_POST['btnSave']))
			{
				$t1 = strtoupper(trim($_POST['txtSpeciality']));
				$hidval = $_POST['hidEdit'];
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
				
				if($hidval != "")
					{
				
					
							mysql_query("Update speciality set specialist='$t1' Where sp_id=".$hidval."");
							echo "<script>window.location.href='admin.php?page=pages/specialityList.php';</script>";
					
					}
					else
					{
						$dup = mysql_query("select * from speciality where specialist='".$t1."'");
						$num_rows=mysql_num_rows($dup);
						if($num_rows>0){
							echo "<script>alert('Already on database !!!!!..')</script>";
						}
	 			
						else{
							
							
						mysql_query("Insert into speciality values(null,'$t1')");
							
							$t1="";
						echo "<script>alert('Your Data is Succssfully Store.')</script>";
						}
					}
			}	

	?>

<form method="post" action="admin.php?page=pages/specialityForm.php">
  <input type="hidden" id="hidEdit" name="hidEdit"  value="<?php echo $edit; ?>" />
  <div class="content-box">
    <div class="site-title clear">
      <h1 class="hside pull-left">Create Speciality</h1>
      <a href="admin.php?page=pages/specialityList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a> </div>
    <div class="panel panel-admin">
      <div class="panel-header"> Create Speciality </div>
      <div class="panel-body">
        <div class="form-vertical">
          <div class="form-group">
            <label>Speciality</label>
            <input type="text" name="txtSpeciality" id="txtSpeciality" class="form-control" value="<?php echo $t1; ?>"/>
          </div>
        </div>
      </div>
      <div class="panel-footer text-center">
        <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
        <a href="admin.php?page=pages/specialityList.php" class="btn btn-link">Cancel</a> </div>
    </div>
  </div>
</form>
