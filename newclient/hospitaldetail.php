<form action="index.php?page=hospitaldetail.php<?php if((isset($_REQUEST['view']))) { echo "&view=".$_REQUEST['view'];} ?>" method="post">

<div class="d-slider">
   	<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> hospitaldetail Details</span> &nbsp; > &nbsp;
    <span><?php $t=$_REQUEST['view'];
		include("mycon.php");
		$data=mysql_query("SELECT * FROM `hospital_master` WHERE hos_id=$t");
		while($result = mysql_fetch_array($data))
			{	
				$name = $result['hos_name'];
				$state=$result["state_id"];   
                $city=$result["city_id"];
                $address=$result["address"];
                $pincode=$result["pin"];
                $mci=$result["mci_no"];
                $specialization=$result["specialization"];
                $contactno=$result["contact_no"];
                $website=$result["website"];
                $timing=$result["timing"];
                 list($timingf, $timingt) = explode('|', $timing);
                $establishmentyear=$result["establishment_year"];
                $about=$result["about"];
                $logo=$result["logo"];
				 
			?>	
	<b><?php echo $name ?></b></span>
</div>

<div class="u-detail">
    <div class="row">
        <div class="col-lg-4">
            <a target="_blank" href="<?php echo $logo ?>">
            <img width="250px" height="250px" border="1px" src='<?php echo $logo ?>' alt='<?php echo $name; ?>'>
            </a>
        </div>
        
        <div class="col-lg-4">
            <h2 class="u-title"><?php echo $name ?></h2>
            <ul class="u-info" style="border:none;">
                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Speciality : </span><span><?php echo $specialization; ?></span></li>
                
                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Establishment Year : </span><span><?php echo $establishmentyear; ?></span></li>
                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Hospital Time : </span><span><?php echo $timingf.' To '.$timingt; ?></span></li>
                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Hospital Contact Number : </span><span><?php echo $contactno; ?></span></li>
                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Website : </span><span><?php echo $website; ?></span></li>
                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Address : </span><span><?php echo $address; ?></span></li>

<li class="u-info-list"><span><i class="fa fa-angle-right"></i> City : </span><span><?php 
                include("mycon.php"); 
                $qu=mysql_query("SELECT * FROM city_master where city_id=$city");
                while($st=mysql_fetch_array($qu)){
                echo $st['city']; } ?></span></li>

                <li class="u-info-list"><span><i class="fa fa-angle-right"></i> State : </span><span><?php 
                include("mycon.php"); 
                $qu=mysql_query("SELECT * FROM state_master where state_id=$state");
                while($st=mysql_fetch_array($qu)){
                echo $st['state']; } ?></span></li>

                
                
            </ul>
        </div>
        
        <div class="col-lg-4">
            <h2 class="u-title">About Hospital</h2>
            <span class="u-info-list text-center"><?php echo $about; ?></span>
            
        
        </div>
    </div>
	
    
</div>
<?php 
	}
?>

</form>
