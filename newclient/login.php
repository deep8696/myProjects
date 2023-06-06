<?php

define('doctor','doctor');
define('hospital','hospital');
define('laboratory','laboratory');
define('medicalstore','medicalstore');
define('patient', 'patient');


if(isset($_POST['login'])){
	

$username=$_POST['uname'];
$password=$_POST['password']; 
$utype=$_POST['utype'];

include("mycon.php");


	if($utype=="0"){
			
			echo "<script>alert('please select any user type.......')</script>";
		
		}

	else if($utype!=""){
		
		$rs = mysql_query("Select * from user_master Where email='$username' and password='$password'");

		$rows=mysql_num_rows($rs);
		if($rows>0)
			{
				while($result=mysql_fetch_array($rs)){
					
					$_SESSION['user'] = $result['user_id'];
					$_SESSION['usertypeid'] = $result['utype_id'];
			
				}
				if($utype==doctor){
				echo "<script>window.location.href='index.php?page=dmaster.php&cprofile=dprofile.php';</script>";
				}
				else if($utype==hospital){
				echo "<script>window.location.href='index.php?page=hmaster.php&cprofile=hprofile.php';</script>";
				}
				else if($utype==laboratory){
				echo "<script>window.location.href='index.php?page=lmaster.php&cprofile=lprofile.php';</script>";
				}
				else if($utype==medicalstore){
				echo "<script>window.location.href='index.php?page=mmaster.php&cprofile=mprofile.php';</script>";
				}
				else if($utype==patient){
				echo "<script>window.location.href='index.php?page=pmaster.php&cprofile=pprofile.php';</script>";
				}
		}
		else
			{
				echo "<script>alert('Incorrect UserType or Email or Password!!!!!!')</script>";
		}
	}
}
?>
<form action="index.php?page=login.php" method="post">
<div class="d-slider"> <span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Login</span> </div>
<div class="signin">
  <center>
    <table class="registration">
      <tr>
        <td colspan="3" align="center"><h2>Login here</h2></td>
      </tr>
      <tr>
        <td>User Type</td>
        <td>:</td>
        <td><select name="utype" id="utype"  class="uname-box">
            <option value="0">---Select User type---</option>
            <option value="doctor">Doctor</option>
            <option value="hospital">Hospital</option>
            <option value="medicalstore">Medical</option>
            <option value="laboratory">Laboratory</option>
            <option value="patient">Patient</option>
          </select></td>
      </tr>
      <tr>
        <td>E-mail</td>
        <td>:</td>
        <td><input type="text" name="uname" id="uname" placeholder="Enter Email address" class="uname-box" required></td>
      </tr>
      <tr>
        <td>Password</td>
        <td>:</td>
        <td><input type="password" name="password" id="password" placeholder="Enter Password" class="uname-box" required></td>
      </tr>
      <tr>
        <td colspan="3"><input type="submit" name="login" id="login" class="btnregister" value="Login"></td>
      </tr>
    </table>
  </center>
</div>
</form>