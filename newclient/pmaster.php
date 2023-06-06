<?php
if(isset($_SESSION['user']))
{

?>
<form action="index.php?page=pmaster.php&cprofile=<?php 
if(isset($_REQUEST['cprofile']))
{
    echo $_REQUEST['cprofile'];
}
else
{
    echo "pprofile.php";
}

?>" method="post" enctype="multipart/form-data">	 
     <div class="d-slider">
     	<a href="index.php?page=home.php" style="color: #fff;"><i class="fa fa-home"></i>&nbsp; Home  &nbsp; ></a> &nbsp;<span> Patient Profile</span>
     </div>
     
     <div class="container profile">
     	<div class="row">
        	<div class="col-lg-3 nav-bar-profile">
            		<span>Profile Data</span>
            		<ul>
                    	<li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=pmaster.php&cprofile=pprofile.php">Patient Information</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=pmaster.php&cprofile=appointment.php">Appointment</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=pmaster.php&cprofile=inquiry.php">Inquiry</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=pmaster.php&cprofile=mcart.php">Cart</a></li>
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
					       include('pprofile.php');
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