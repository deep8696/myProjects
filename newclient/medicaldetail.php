<form action="index.php?page=medicaldetail.php<?php if((isset($_REQUEST['view']))) { echo "&view=".$_REQUEST['view'];} ?>" method="post">
	<?php 
	if(isset($_POST['btnAddCart']))
	{
		if(isset($_SESSION["user"]))
		{
			if($_SESSION['usertypeid']==5){
				if(isset($_POST['chkCart']))
				{
					$mid = $_REQUEST["view"];
					$data = mysql_query("Select * from `cart_master` where user_id=$uid and medical_id !=$mid");
					if(mysql_num_rows($data) > 0)
					{
						echo "<script>alert('Another Medical Medicine is allready added in your cart!!!!...')</script>";
					}
					else
					{
						foreach($_POST['chkCart'] as $selected){
							
								//echo "<br>".$_POST["txtCartText".$selected];
							$uid=$_SESSION["user"];
							$mid=$_REQUEST["view"];
							$quat=$_POST["txtCartText".$selected];
							
							$data = mysql_query("Select * from `cart_master` where user_id=$uid and medicine_id=$selected");
							if(mysql_num_rows($data) > 0)
							{
								echo "<script>alert('Medicine is already added in your cart!!!!...')</script>";
							}
							else
							{


								$data=mysql_query("INSERT INTO `cart_master` VALUES (NULL,$uid,$mid,$selected,$quat)");
								echo "<script>alert('Medicine Added in Your Cart Successfully !!!!...');window.location.href='index.php?page=medicaldetail.php&view=$mid'</script>";
							}
							
						}
						
					}
					
				}
				else
				{
					echo "<script>alert('Please Selected Checkbox of Add Cart.')</script>";
				}
			}
			else{
				echo "<script>alert('Only Patient Can Buy Medicine...');window.location.href='logout.php';</script>";
			}
		}
		else
		{
			echo "<script>alert('Please First Login.');window.location.href='index.php?page=login.php';</script>";
		}
	}
	
	?>


	<div class="d-slider">
		<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Medical Details</span> &nbsp; > &nbsp;
		<span><?php $t=$_REQUEST['view'];
			include("mycon.php");
			$data=mysql_query("SELECT * FROM `medical_master` WHERE medical_id=$t");
			
			while($result = mysql_fetch_array($data))
			{	
				$mname=$result["medical_name"];
				$oname=$result["owner_name"];
				$address=$result["address"];
				$state=$result["state_id"];
				$city=$result["city_id"];
				$pincode=$result["pin"];
				$website=$result["website"];
				$contact=$result["contact"];
				$about=$result["about"];
				$logo=$result["logo"];
				$timing=$result["timing"];
				list($timingf, $timingt) = explode('|', $timing);
				
				?>	
				<b><?php echo $mname ?></b></span>
			</div>

			<div class="u-detail">
				<div class="row">
					<div class="col-lg-4">
						<a target="_blank" href="<?php echo $logo ?>">
							<img width="250px" height="250px" border="1px" src='<?php echo $logo ?>' alt='<?php echo $mname; ?>'>
						</a>
					</div>
					
					<div class="col-lg-4">
						<h2 class="u-title"><?php echo $mname ?></h2>
						<ul class="u-info" style="border:none;">
							<li class="u-info-list"><span><i class="fa fa-angle-right"></i> Owner : </span><span><?php echo $oname; ?></span></li>
							<li class="u-info-list"><span><i class="fa fa-angle-right"></i> Medical Time : </span><span><?php echo $timingf.' To '.$timingt; ?></span></li>
							<li class="u-info-list"><span><i class="fa fa-angle-right"></i> Medical Contact Number : </span><span><?php echo $contact; ?></span></li>
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
										<h2 class="u-title">About Medical</h2>
										<span class="u-info-list text-center"><?php echo $about; ?></span>
										
										
									</div>
								</div>
								
								<div class="row" style="margin:50px 0px;">
									<div class="col-lg-12">
										<div style="background-color: #3083a5;padding: 10px 0px 10px 20px;color: #fff;font-weight: bold;font-family: arial;font-size: 16px;">Medicine List</div>
									</div>
									<div class="col-lg-12">
										<table class="table text-center">
											<tr>
												<th style="width:10%;">Type</th>
												<th style="width:20%;">Ganeric Name</th>
												<th style="width:15%;">Title</th>
												<th style="width:5%;">Contains</th>
												<th style="width:10%;">Color</th>
												<th style="width:15%;">Manufactures</th>
												<th style="width:5%;">Price</th>
												<th style="width:5%;">Quantity</th>
												<th style="width:5%;"></th>
											</tr>
											<?php 
											include("mycon.php");
											$mid=$_REQUEST['view'];
											$dat=mysql_query("SELECT medicine_master.* , medical_master.medical_id, medicinetype_master.medicine_type, medicine_generic_master.generic_name FROM medicine_master LEFT OUTER JOIN medical_master ON medicine_master.user_id = medical_master.user_id LEFT OUTER JOIN medicinetype_master ON medicine_master.id_medicinetype = medicinetype_master.id_medicinetype LEFT OUTER JOIN medicine_generic_master ON medicine_master.generic_id = medicine_generic_master.generic_id WHERE medical_master.medical_id =$mid");
											while($res=mysql_fetch_array($dat)){ ?>
											<tr>
												<td style="width:10%;"><?php echo $res['medicine_type']; ?></td>
												<td style="width:20%;"><?php echo $res['generic_name']; ?></td>
												<td style="width:15%;"><?php echo $res['title']; ?></td>
												<td style="width:15%;"><?php echo $res['contains']; ?></td>
												<td style="width:10%;"><?php echo $res['color']; ?></td>
												<td style="width:20%;"><?php echo $res['mfg']; ?></td>
												<td style="width:5%;"><?php echo $res['price']; ?></td>
												<td style="width:5%;"><input type="text" name="txtCartText<?php echo $res['medicine_id']; ?>" id="txtCartText" value="" style="padding:4px;border-radius:6px;" /></td>
												<td style="width:5%;"><input type="checkbox" name="chkCart[]" id="chkCart" value="<?php echo $res['medicine_id']; ?>"/></td>
											</tr>
											<?php
										}
										?>
									</table>
									
									<button class="btnprofile text-center pull-right" style="width:12%;margin-top:25px;" type="submit" id="btnAddCart" name="btnAddCart">Add To Cart</button>
									
									

								</div>
							</div>
							
						</div>
						<?php 
					}
					?>

				</form>
