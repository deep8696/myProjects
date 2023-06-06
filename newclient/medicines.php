

<form action="index.php?page=medicines.php" method="post">
	
     <div class="d-slider">
     	<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Medical Store</span>
     </div>
     
     <div class="d-serch-panel">
        	<div class="d-search">
        	<select name="state" id="state" class="d-input-box">
            	<option value="0">-----Select State-----</option>
                <?php           
                            include("mycon.php");
                            $datas=mysql_query("select * from state_master");
							while($results=mysql_fetch_array($datas))
                            {
                                ?>
                                <option  <?php if(isset($_REQUEST["state"])){ if($_REQUEST['state'] == $results["state_id"]){echo "selected";}} ?>  value="<?php echo $results["state_id"]; ?>"><?php echo $results["state"]; ?></option>
                            <?php } ?>               
            </select>
            
            <select name="city" id="city" class="d-input-box">
            	<option value="0">-----Select City-----</option>
                  <?php 
				   if(isset($_REQUEST["city"]))
				   {
					   include("mycon.php");
                       $datas=mysql_query("select * from city_master Where state_id=".$_REQUEST["state"]."");
					   while($results=mysql_fetch_array($datas))
                       {
                       ?>
                       <option  <?php if(isset($_REQUEST["city"])){ if($_REQUEST['city'] == $results["city_id"]){echo "selected";}} ?>  value="<?php echo $results["city_id"]; ?>"><?php echo $results["city"]; ?></option>
                       <?php }
						  }
						?>              
            </select>
        
            
            <input type="search" name="medicineSearch" id="medicineSearch" class="d-input-box d-search-box" value="<?php if((isset($_REQUEST['medicine']))) { echo $_REQUEST['medicine'];} ?>" placeholder="Search Medicines... "/>
            <input type="search" name="medicalSearch" id="medicalSearch" class="d-input-box d-search-box" value="<?php if((isset($_REQUEST['medical']))) { echo $_REQUEST['medical'];} ?>" placeholder="Search Medical... "/>
            <input type="submit" name="btnSearch" id="btnSearch" class="d-btnSearch" value="Search"/>
        	</div>
        </div>

      
<div class="row search-result">
<?php
		if(isset($_POST['btnSearch'])){
			$state=$_POST['state'];
			$city=$_POST['city'];
			$medicine=$_POST['medicineSearch'];
			$medical=$_POST['medicalSearch'];
			$qString="";
			
			if($state != 0 && $city != 0)
			{
				$qString = $qString."&state=".$state."&city=".$city;
			}
			if($medicine != "")
			{
				$qString = $qString."&medicine=".$medicine;
			}
			if($medical != "")
			{
				$qString = $qString."&medical=".$medical;
			}
			echo "<script>window.location.href='index.php?page=medicines.php".$qString."'</script>";
		}           

$query = "";
if(isset($_REQUEST['state']) && isset($_REQUEST['city']) && isset($_REQUEST['medicine']) && isset($_REQUEST['medical']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and state_id=".$_REQUEST["state"]." and city_id=".$_REQUEST["city"]." and title LIKE '%".$_REQUEST["medicine"]."%' and medical_name LIKE '%".$_REQUEST["medical"]."%'";
}
else if(isset($_REQUEST['state']) && isset($_REQUEST['city']) && isset($_REQUEST['medicine']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and state_id=".$_REQUEST["state"]." and city_id=".$_REQUEST["city"]." and title LIKE '%".$_REQUEST["medicine"]."%'";
}
else if(isset($_REQUEST['state']) && isset($_REQUEST['city']) && isset($_REQUEST['medical']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and state_id=".$_REQUEST["state"]." and city_id=".$_REQUEST["city"]." and medical_name LIKE '%".$_REQUEST["medical"]."%'";
}
else if(isset($_REQUEST['state']) && isset($_REQUEST['city']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and state_id=".$_REQUEST["state"]." and city_id=".$_REQUEST["city"]."";
}
else if(isset($_REQUEST['medicine']) && isset($_REQUEST['medical']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and title LIKE '%".$_REQUEST["medicine"]."%' and medical_name like '"."%".$_REQUEST["medical"]."%"."'";
}
else if(isset($_REQUEST['medicine']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and title LIKE '%".$_REQUEST["medicine"]."%'";
}
else if(isset($_REQUEST['medical']))
{
	$query = "select medical_master.*,medicine_master.title from medical_master left outer join medicine_master on medicine_master.user_id=medical_master.user_id where status=1 and medical_name like '"."%".$_REQUEST["medical"]."%"."'";
}
else
{
	$query = "select * from medical_master where status=1";
}
//echo $query;
	include('mycon.php');
	$data=mysql_query($query);
	//$d_avail=mysql_num_rows($data);
	
	if(mysql_num_rows($data)>0){
	//echo $d_avail;
	while($results=mysql_fetch_array($data)){

	?>

       	<div class="col-lg-3 d-result">
           	<div class="image"><img src="<?php echo $results['logo'];?>"></div>
	            <div class="d-content">
                   	<h4><?php echo $results["medical_name"]; ?></h4>
                   	<p><?php echo $results["timing"]; ?></p>
                    <p><?php echo $results["contact"]; ?></p>
                </div>
    
                <a href="index.php?page=medicaldetail.php&view=<?php echo $results["medical_id"];?>"><div class="btnprofile">
                   	<span>View Profile</span>
                    </div></a>
        </div>
		<?php
				}
			}
			else{
				echo "No Medicals Available based on Your Search Results...";
			}
		?>           
                
                
                
              
       </div>

</form>

