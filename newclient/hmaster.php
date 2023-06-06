<?php
if(isset($_SESSION['user']))
{

?>
<form action="index.php?page=hmaster.php&cprofile=<?php 
if(isset($_REQUEST['cprofile']))
{
    echo $_REQUEST['cprofile'];
}
else
{
    echo "hprofile.php";
}

?>" method="post" enctype="multipart/form-data">	 
     <div class="d-slider">
     	<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Hospital Profile</span>
     </div>
     
     <div class="container profile">
     	<div class="row">
        	<div class="col-lg-3 nav-bar-profile">
            		<span>Profile Data</span>
            		<ul>
                    	<li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=hmaster.php&cprofile=hprofile.php">Hospital Information</a></li>
                        <?php 
                            include("mycon.php");
                            $userid=$_SESSION['user'];
                            $data=mysql_query("SELECT status FROM `hospital_master` WHERE user_id=$userid");
                            while($result = mysql_fetch_array($data))
                            {
                                $status=$result['status'];
                            if($status==0){
                        ?>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="#">Proof upload</a></li>
                        <?php } } ?>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="#">Update Profile</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="logout.php">Logout</a></li>
                    </ul>
            </div>
			<div class="col-lg-9">
           
            	<?php
					if(isset($_REQUEST['cprofile'])){
						include($_REQUEST['cprofile']);
					}
					else{
					include('hprofile.php');
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