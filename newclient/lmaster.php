<?php
if(isset($_SESSION['user']))
{

?>
<form action="index.php?page=lmaster.php&cprofile=<?php 
if(isset($_REQUEST['cprofile']))
{
    echo $_REQUEST['cprofile'];
}
else
{
    echo "lprofile.php";
}
if(isset($_REQUEST['edit']))
{
    echo "&edit=".$_REQUEST['edit'];
}


?>" method="post" enctype="multipart/form-data">
	 
     <div class="d-slider">
     	<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Laboratory Profile</span>
     </div>
     
    <div class="container profile">
     	<div class="row">
        	<div class="col-lg-3 nav-bar-profile">
            		<span>Profile Data</span>
            		<ul>
                    	<li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=lmaster.php&cprofile=lprofile.php">Laboratory Information</a></li>
                        <?php 
                            include("mycon.php");
                            $userid=$_SESSION['user'];
                            $data=mysql_query("SELECT status FROM `lab_master` WHERE user_id=$userid");
                            while($result = mysql_fetch_array($data))
                            {
                                $status=$result['status'];
                            if($status==0){
                        ?>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=lmaster.php&cprofile=proof.php">Proof upload</a></li>
                        <?php }
                        else{
                            ?>
                            <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=lmaster.php&cprofile=ltestpricelist.php">Lab Test And Price</a></li>
                            <?php
                            } } ?>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="index.php?page=lmaster.php&cprofile=inquiry.php">View Inquiry</a></li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;<a href="logout.php">Logout</a></li>
                    </ul>
            </div>
			<div class="col-lg-9">
                <?php 
					if(isset($_REQUEST['cprofile'])){
						include($_REQUEST['cprofile']);
					}
					else
                    {
					include('lprofile.php');
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