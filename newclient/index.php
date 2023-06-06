<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health In Hand</title>
<link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/ResponsiveGrid.css"/>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<script type="text/javascript" src="cacd/jquery.js"></script>
</head>
<?php 
session_start();
?>
<body>
<div class="header">
  <div class="row">
    <?php 
        $dr_name=$hos_name=$lab_name=$medical_name=$patient_name="";
        if(isset($_SESSION['user']) && $_SESSION['usertypeid'])
        {
            $utypeid=$_SESSION['usertypeid'];
            $userid=$_SESSION['user'];

            include("mycon.php");

            $doctor = mysql_query("Select * from doctor_master Where user_id=$userid");
            while($result = mysql_fetch_array($doctor)){
               $dr_name = $result["dr_name"];
           }
           $hospital = mysql_query("Select * from hospital_master Where user_id=$userid");
           while($result = mysql_fetch_array($hospital)){
               $hos_name = $result["hos_name"];
           }
           $laboratory = mysql_query("Select * from lab_master Where user_id=$userid");
           while($result = mysql_fetch_array($laboratory)){
               $lab_name = $result["lab_name"];
           }
           $medical = mysql_query("Select * from medical_master Where user_id=$userid");
           while($result = mysql_fetch_array($medical)){
               $medical_name = $result["medical_name"];
           }
           $patient = mysql_query("Select * from patient_master Where user_id=$userid");
           while($result = mysql_fetch_array($patient)){
            $patient_name = $result["patient_name"];
        }
		
        if($utypeid=='1')
        { 

            ?>
    <div class="col-lg-6 login">
      <h5 style="font-size: 17px;"">WelCome <a href="index.php?page=dmaster.php&cprofile=dprofile.php"><?php echo $dr_name; ?></a>&nbsp;|| <a href="logout.php">Logout</a> </h5>
    </div>
    <div class="col-lg-6 social"></div>
    <?php 
  } 
  else if($utypeid=='2')
  { 
    ?>
    <div class="col-lg-6 login">
      <h5 style="font-size: 17px;">WelCome <a href="index.php?page=hmaster.php&cprofile=hprofile.php"><?php echo $hos_name;  ?></a>&nbsp;|| <a href="logout.php">Logout</a> </h5>
    </div>
    <div class="col-lg-6 social"></div>
    <?php 
}
else if($utypeid=='4')
{ 
    ?>
    <div class="col-lg-6 login">
      <h5 style="font-size: 17px;">WelCome <a href="index.php?page=lmaster.php&cprofile=lprofile.php"><?php echo $lab_name; ?></a>&nbsp;|| <a href="logout.php">Logout</a> </h5>
    </div>
    <div class="col-lg-6 social"> </div>
    <?php 
}
else if($utypeid=='3')
{ 
    ?>
    <div class="col-lg-6 login">
      <h5 style="font-size: 17px;">WelCome <a href="index.php?page=mmaster.php&cprofile=mprofile.php"><?php echo $medical_name;  ?></a>&nbsp;|| <a href="logout.php">Logout</a> </h5>
    </div>
    <div class="col-lg-6 social"> </div>
    <?php 
} 
else if($utypeid=='5')
{ 
    ?>
    <div class="col-lg-6 login">
      <h5 style="font-size: 17px;">WelCome <a href="index.php?page=pmaster.php&cprofile=pprofile.php"><?php echo $patient_name; ?></a>
      &nbsp;||
      <?php
	  	include ("mycon.php");
		$uid=$_SESSION['user'];
		$data=mysql_query("select * from `cart_master` WHERE user_id=$uid");
		//echo $data;
		if (mysql_num_rows($data)>0){
	  ?>
      <a href="index.php?page=mcart.php">Cart</a>&nbsp;|| 
      <?php
		}
	  ?>
      <a href="index.php?page=order.php">Your Orders</a>&nbsp;||
      <a href="logout.php">Logout</a>
	  </h5><br />
    </div>
    <div class="col-lg-6 social"> </div>
    <?php 
}

}
else
{ 
    ?>
    <div class="col-lg-6 login">
      <h5>New User ? <a href="index.php?page=register.php"> Register Here</a></h5>
      <h5>Already member ? <a href="index.php?page=login.php"> Login Here</a></h5>
    </div>
    <div class="col-lg-6 social"> </div>
    <?php 
} 
?>
  </div>
  <div class="row" style="border-top: 3px solid #20a9b7;border-bottom:1px solid #20a9b7;">
    <div class="col-lg-4 logo"></div>
    <div class="col-lg-8 panel-menu">
      <ul class="menu">
        <li><a href="index.php?page=home.php">Home</a></li>
        <li><a href="index.php?page=doctor.php">Doctor</a></li>
        <li><a href="index.php?page=hospital.php">Hospital</a></li>
        <li><a href="index.php?page=laboratory.php">Laboratory</a></li>
        <li><a href="index.php?page=medicines.php">Medicines</a></li>
        <li><a href="index.php?page=about.php">AboutUs</a></li>
        <li><a href="index.php?page=contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</div>
<?php
if(isset($_REQUEST['page'])){
 include($_REQUEST['page']);
}
else{
 include('home.php');
}
?>
<div class="footer">
  <div class="row">
    <div class="col-lg-3 footer-text">
      <ul>
        <li>
          <h4>Health In Hand</h4>
        </li>
        <li><a href="index.php?page=home.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Help</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="col-lg-3 footer-text">
      <ul>
        <li>
          <h4>Search By</h4>
        </li>
        <li><a href="#">Speciality</a></li>
        <li><a href="index.php?page=doctor.php">Doctor</a></li>
        <li><a href="index.php?page=hospital.php">Hospital</a></li>
      </ul>
    </div>
    <div class="col-lg-3 footer-text">
      <ul>
        <li>
          <h4>More</h4>
        </li>
        <li><a href="#">Developers</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms & Conditions</a></li>
      </ul>
    </div>
    <div class="col-lg-3 footer-text">
      <ul>
        <li>
          <h4>Social</h4>
        </li>
        <li><a href="#"><i class="fa fa-user"></i>&nbsp;Facebook</a></li>
        <li><a href="#"><i class="fa fa-twitter"></i>&nbsp;Twitter</a></li>
        <li><a href="#"><i class="fa fa-instagram"></i>&nbsp;Instagram</a></li>
        <li><a href="#"><i class="fa fa-youtube"></i>&nbsp;Youtube</a></li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 copyright"> Copyright &copy; 2017-18 Health In Hand. All rights reserved. </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
    $("#state").change(function(){
    $('#city').find('option').remove().end(); //clear the city ddl
    var country = $(this).find("option:selected").val();
   // alert(country);
    //do the ajax call
    var objData = {
      method:'getCityFun',
      state:country

  };
  $.ajax({
    url:'cacd/ByFunction.php',
    type:'POST',
    data:objData,
    dataType:'json',
    cache:false,
    success:function(data){
    //alert(data);

        //data=JSON.parse(data); //no need if dataType is set to json
        var obj = data;
        var ddl = document.getElementById('city');                      

        for(var c=0;c<obj.length;c++)
        {          
            var data = obj[c].split('/');
            var option = document.createElement('option');
            option.value = data[1];
            option.text  = data[0];                           
            ddl.appendChild(option);
        }
    },
    error:function(jxhr){
        $("#getError").html(jxhr.responseText);
        //alert(jxhr.responseText);

    }
}); 

});
</script>