<?php
if(isset($_SESSION['user']))
{

?>
<form action="index.php?page=dmaster.php&cprofile=<?php 
if(isset($_REQUEST['cprofile']))
{
    echo $_REQUEST['cprofile'];
}
else
{
    echo "dprofile.php";
}

?>" method="post" enctype="multipart/form-data">	 
     <div class="d-slider">
     	<a href="index.php?page=home.php" style="color: #fff;"><i class="fa fa-home"></i>&nbsp; Home  &nbsp; ></a> &nbsp;<span> Doctor Profile</span>
     </div>
     
     <div class="container profile">
     	<div class="row">
        	<div class="col-lg-3 nav-bar-profile">
            		<span>Profile Data</span>
            		<ul>
                    	<li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=dmaster.php&cprofile=dprofile.php">Doctor Information</a></li>
                        <?php 
                            include("mycon.php");
                            $userid=$_SESSION['user'];
                            $data=mysql_query("SELECT status FROM `doctor_master` WHERE user_id=$userid");
                            while($result = mysql_fetch_array($data))
                            {
                                $status=$result['status'];
                            if($status==0){
                        ?>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=dmaster.php&cprofile=proof.php">Proof upload</a></li>
                        <?php }
						else{
						  ?>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=dmaster.php&cprofile=appointment.php">Appointment</a></li>
                        <?php
							}
						}
						?>
                        
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="logout.php">Logout</a></li>

                    </ul>
            </div>
			<div class="col-lg-9">
           
            	<?php
                    
	   				    if(isset($_REQUEST['cprofile']))
                        {
                            include($_REQUEST['cprofile']);
    					}
					    else
                        {
					       include('dprofile.php');
					    }
                    
				?>
            
            
            </div>        
        </div>
     
     </div>
     
</form>
<?php } 
else
{
    echo "<script>window.location.href='index.php?page=login.php';</script>";
}
?>