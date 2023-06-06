<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/ResponsiveGrid.css"/>
<link rel="stylesheet" type="text/css" href="css/maincss.css"/>
<title>Health In Hand</title>
</head>

<body>
<form method="post">
<div class="header clear">
	<a href="admin.php?page=pages/dashboard.php" class="logo">Health In Hand</a>
    <div class="head-menu">
    
    	<ul class="h-nav clear">
              	<li><i class="fa fa-user"></i>&emsp;UserName
            	<ul class="h-nav-submenu">
                	<li><a href="admin.php?page=pages/profile.php"><i class="fa fa-list"></i>Profile</a></li>
                    <li><a href="admin.php?page=pages/changepassword.php"><i class="fa fa-key"></i>Change Password</a></li>
                    <li><a href="login.php"><i class="fa fa-power-off"></i>Log Out</a></li>
                </ul>
            </li>                
        </ul>
   				
    </div>
     
</div>


<div class="content">
	<div class="sidebar">
    	<div class="user-box">
            <img src="images/user.png" width="48" height="48" />
        	<h4>Deep Patel</h4>
            <h6>Admin</h6>	
        </div>
        
       <ul class="sidebar-nav">
                    <li><a href="admin.php?page=pages/dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></i></li>
                    <li><a href="#"><i class="fa fa-tasks"></i>Masters&emsp;<i class="fa fa-angle-down"></i></a>
                        <ul class="sidebar-subnav">
                            <li><a href="admin.php?page=pages/specialityList.php"><i class="fa fa-angle-right"></i>Speciality</a></li>
                            <li><a href="admin.php?page=pages/userroleList.php"><i class="fa fa-angle-right"></i>User Role</a></li>
                            <li><a href="admin.php?page=pages/timingslotsList.php"><i class="fa fa-angle-right"></i>Timing Slots</a></li>
                            <li><a href="admin.php?page=pages/laboratorytypesList.php"><i class="fa fa-angle-right"></i>Laboratory Types</a></li>
                            
                            <li><a href="admin.php?page=pages/stateList.php"><i class="fa fa-angle-right"></i>State</a></li>
                            <li><a href="admin.php?page=pages/cityList.php"><i class="fa fa-angle-right"></i>City</a></li>
                            <li><a href="admin.php?page=pages/areaList.php"><i class="fa fa-angle-right"></i>Area</a></li>
                            <li><a href="admin.php?page=pages/medicinetypeList.php"><i class="fa fa-angle-right"></i>Medicine Type</a></li>
                            <li><a href="admin.php?page=pages/medicinesubtypesList.php"><i class="fa fa-angle-right"></i>Medicine Subtype</a></li>
                            <li><a href="admin.php?page=pages/medicinegenericList.php"><i class="fa fa-angle-right"></i>Medicine Generic</a></li>
                            <li><a href="admin.php?page=pages/hospitalserviceList.php"><i class="fa fa-angle-right"></i>Hospital Service</a></li>
                            <li><a href="admin.php?page=pages/faqsList.php"><i class="fa fa-angle-right"></i>FAQs</a></li>
                        </ul>

                    </li>
                    <li><a href="#"><i class="fa fa-users"></i>User Management&emsp;<i class="fa fa-angle-down"></i></a>
                    	<ul class="sidebar-subnav">
                            <li><a href="admin.php?page=pages/doctorList.php"><i class="fa fa-angle-right"></i>Doctor</a></li>
                            <li><a href="admin.php?page=pages/hospitalList.php"><i class="fa fa-angle-right"></i>Hospital</a></li>
                            <li><a href="admin.php?page=pages/patientList.php"><i class="fa fa-angle-right"></i>Patient</a></li>
                            <li><a href="admin.php?page=pages/medicalstoreList.php"><i class="fa fa-angle-right"></i>Medical Store</a></li>
                            <li><a href="admin.php?page=pages/laboratoryList.php"><i class="fa fa-angle-right"></i>Laboratory</a></li>
                        </ul>

                    </li>
                    <li><a href="admin.php?page=pages/newsList.php"><i class="fa fa-newspaper-o"></i>News</a></li>
                    <li><a href="admin.php?page=pages/inquiryList.php"><i class="fa fa-phone"></i>Inquiry</a></li>
                    <li><a href="admin.php?page=pages/feedbackList.php"><i class="fa fa-book"></i>Feedback</a></li>      
        </ul>  
    </div>
	
    <?php 
					if(isset($_REQUEST['page']))
					{
						include($_REQUEST['page']);
						}				
					else{
						include('pages/dashboard.php');
					}			
				
				?>
    

</div>
</form>

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $(".h-nav > li").click(function () {
                $(".h-nav-submenu").not($(this).children(".h-nav-submenu")).slideUp(300);
                $(this).children(".h-nav-submenu").slideToggle();
            }); 
			$(".sidebar-nav > li").click(function () {
				$(".sidebar-subnav").not($(this).children(".sidebar-subnav")).slideUp(300);
                $(this).children(".sidebar-subnav").slideToggle();
            });
		});
</script>






</body>
</html>