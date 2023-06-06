<?php 

if(isset($_POST['register'])){
	
	$utype=$_POST['utype'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$state=$_POST['state'];
	$city=$_POST['city'];
	$contact=$_POST['contact'];
	$otp=rand(100000,999999);
	
	include("mycon.php");
	
	$data = mysql_query("SELECT * FROM `user_master` WHERE email='$email'");
	if(mysql_num_rows($data) > 0)
	{
		echo "<script>alert('Email Id Already Exist in Database')</script>";
	}
	else
	{
		$data = mysql_query("INSERT INTO user_master(`user_id`, `utype_id`, `email`, `password`, `state_id`, `city_id`, `contact`, `otp`) VALUES ('null','$utype','$email','$password','$state','$city','$contact','$otp')");
		echo "<script>alert('Register Successful !!!!...');</script>";
		echo "<script>window.location.href='index.php?page=login.php'</script>";
	}
	
}

?> 

<form action="index.php?page=register.php" method="post">
<div class="d-slider">
     	<span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Registration</span>
     </div>
<div class="container k-register">
<center><h2 style="margin-bottom:30px;">Registration Form</h2></center>
	<div class="row">
		<div class="col-lg-6">
			
				<div class="form-group">
					<label>User Type</label>
					<select class="form-register" name="utype">
  						<option value="0">-----Select Type-----</option>
                 <?php			
							
							mysql_connect("localhost","root","");
							mysql_select_db("healthinhand_db");
							
							$datas=mysql_query("select * from usertype_master");
							
							while($results=mysql_fetch_array($datas)){
								
									echo "<option value='".$results["utype_id"]."'>".$results["user_type"]."</option>";
								}
						?>
  					</select>
				</div>

				
  				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-register" placeholder="Email">
  				</div>
  				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-register" placeholder="Password">
  				</div>
  				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" name="cpassword" class="form-register" placeholder="Confirm Password">
  				</div>
			
		</div>
		<div class="col-lg-6">
			<div class="form-group">
            <label>State</label>
            <select class="form-register" name="state" id="state">
            <option value="0">-----Select State-----</option>
                 <?php			
							
							mysql_connect("localhost","root","");
							mysql_select_db("healthinhand_db");
							
							$datas=mysql_query("select * from state_master");
							
							
							while($results=mysql_fetch_array($datas)){
                                ?>
                                 <option value="<?php echo $results["state_id"]; ?>"><?php echo $results["state"]; ?></option>
                                 <?php
                                }

						?>
            </select>
            </div>
            
            <div class="form-group">
            <label>City</label>
            <select class="form-register" name="city" id="city">
            <option value="0">-----Select City-----</option>
                 <?php			
							
							mysql_connect("localhost","root","");
							mysql_select_db("healthinhand_db");
							
							$datas=mysql_query("select * from city_master");
							
							while($results=mysql_fetch_array($datas)){
                                ?>
                                 <option value="<?php echo $results["city_id"]; ?>"><?php echo $results["city"]; ?></option>
                                 <?php
                                }
						?>
            </select>
            </div>
            
			<div class="form-group">
				<label>Contact No</label>
				<input type="number" name="contact" class="form-register" placeholder="Contact Number">
			</div>
			
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-lg-12">
			<input type="submit" name="register" id="register" class="btnregister" value="Register"/>
	</div>
	
</div>
</div>
</form>