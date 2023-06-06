



<form action="index.php?page=laboratory.php" method="post">
	
     <div class="d-slider">
     	<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Laboratory</span>
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
            
            <input type="search" name="nameSearch" id="nameSearch" class="d-input-box d-search-box" value="<?php if(isset($_REQUEST["search"])){ echo $_REQUEST["search"];} ?>" placeholder="Search laboratory... "/>
            <input type="submit" name="btnSearch" id="btnSearch" class="d-btnSearch" value="Search"/>
        	</div>
        </div>

      
<div class="row search-result">
	<?php
		if(isset($_POST['btnSearch'])){
			$state=$_POST['state'];
			$city=$_POST['city'];
			$lab=$_POST['nameSearch'];
			$qString="";
			
			if($state != 0 && $city != 0)
			{
				$qString = $qString."&state=".$state."&city=".$city;
			}
			if($lab != "")
			{
				$qString = $qString."&search=".$lab;
			}
			echo "<script>window.location.href='index.php?page=laboratory.php".$qString."'</script>";
		}

$query = "";
if(isset($_REQUEST['state']) && isset($_REQUEST['city']) && isset($_REQUEST['search']))
{
	$query = "select * from lab_master where status=1 and state_id=".$_REQUEST["state"]." and city_id=".$_REQUEST["city"]." and lab_name LIKE %".$_REQUEST["search"]."%";
}
else if(isset($_REQUEST['state']) && isset($_REQUEST['city']))
{
	$query = "select * from lab_master where status=1 and state_id=".$_REQUEST["state"]." and city_id=".$_REQUEST["city"]."";
}
else if(isset($_REQUEST['search']))
{
	$query = "select * from lab_master where status=1 and lab_name like '"."%".$_REQUEST["search"]."%"."'";
}
else
{
	$query = "select * from lab_master where status=1";
}
//echo $query;
	
	$data=mysql_query($query);
	if(mysql_num_rows($data)>0){
	while($results=mysql_fetch_array($data)){

	?>

   	<div class="col-lg-3 d-result">
       	<div class="image"><img src="<?php echo $results['logo'];?>"></div>
	        <div class="d-content">
               	<h4><?php echo $results["lab_name"]; ?></h4>
               	<p><?php echo $results["timing"]; ?></p>
                <p><?php echo $results["dr_name"]; ?></p>
           </div>
                <a href="index.php?page=laboratorydetail.php&view=<?php echo $results["lab_id"];?>">
                	<div class="btnprofile">
               		<span>View Profile</span>
                	</div>
                </a>
        </div>
        
		 <?php
				}
			}
			else{
				echo "No Laboratories Available based on Your Search Results...";
			}
		?>

   </div>

</form>
