<?php 
		if(isset($_POST['btnSave']))
			{
				$t1 = $_POST['txtCity'];
				
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
				
				
	 
				$dup = mysql_query("select * from city_master where city='".$t1."'");
				$num_rows=mysql_num_rows($dup);
				if($num_rows>0){
					echo "<script>alert('Already on database !!!!!..')</script>";
				}
	 			
				else{
				mysql_query("Insert into city_master values(null,'$t1')");
	
				echo "<script>alert('Your Data is Succssfully Store.')</script>";
				}

			}	

	?>
 <form method="post" action="admin.php?page=pages/cityForm.php">   
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">City</h1>
            <a href="admin.php?page=pages/cityList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a>
        </div>

	
     <div class="panel panel-admin">
        <div class="panel-header">
            Add city
        </div>
        <div class="panel-body">
            <div class="form-vertical">
            
             <div class="form-group">
                    <label>State</label>
                    <select name="state" id="state" class="form-drop-control">
      					<option value="0">---Select State----</option>
                        <?php			
							
							mysql_connect("localhost","root","");
							mysql_select_db("healthinhand_db");
							
							$datas=mysql_query("select * from state_master");
							
							while($results=mysql_fetch_array($datas)){
								
										echo "<option value='".$results["state_id"]."'>".$results["state"]."</option>";
								}
						?>
      				</select>
                    
             </div>   
                <div class="form-group">
                    <label>City</label><input type="text" name="txtCity" id="txtCity" class="form-drop-control"/>
                    
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
            <a href="admin.php?page=pages/cityList.php" class="btn btn-link">Cancel</a>
        </div>
    </div>
    </div>
    </form>