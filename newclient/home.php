<form action="index.php?page=home.php" method="post">
  <div class="banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 b-image"> <img src="images/banner.jpg" /> </div>
        <div class="col-lg-8 search-panel">
          <div class="search">
          <div class="row">
          	<div class="col-md-6">
            	<select name="state" id="state" class="input-box state">
              <option value="0">-----Select State-----</option>
              <?php			
							
							mysql_connect("localhost","root","");
							mysql_select_db("healthinhand_db");
							
							$datas=mysql_query("select * from state_master");
							
							while($results=mysql_fetch_array($datas)){
								
									echo "<option value='".$results["state_id"]."'>".$results["state"]."</option>";
								}
						?>
            </select>
            </div>
            <div class="col-md-6">
            	<select name="city" id="city" class="input-box city">
              <option value="0">-----Select City-----</option>
            </select>
            </div>
            <div class="col-md-12">
            	<select name="speciality" id="speciality" class="input-box">
              <option value="0">-----Select Speciality-----</option>
              <?php 
					
							mysql_connect("localhost","root","");
							mysql_select_db("healthinhand_db");
							
							$datas=mysql_query("select * from speciality");
							
							while($results=mysql_fetch_array($datas)){
								echo "<option value='".$results["sp_id"]."'>".$results["specialist"]."</option>";
								}
				?>
            </select>
            </div>
            <div class="col-md-12">
            	<input type="search" name="search-box" id="search-box" class="input-box" placeholder="Search doctor , hospital , laboratory ,....."/>
            </div>
          </div>
            
            
          <div class="text-right">
          <a href="index.php?page=search.php" class="btn btn-blue">Search</a>
          
          </div>
            
             </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="col-lg-12 nav-user">
      <div class="row"> <a href="index.php?page=doctor.php">
        <div class="col-lg-3 hvr-nav-user"> <span class="fa fa-user-md"> <br />
          </span>
          <div class="content-user">Doctor</div>
        </div>
        </a> <a href="index.php?page=hospital.php">
        <div class="col-lg-3 hvr-nav-user"> <span class="fa fa-hospital-o"></span>
          <div class="content-user">Hospital</div>
        </div>
        </a> <a href="index.php?page=laboratory.php">
        <div class="col-lg-3 hvr-nav-user"> <span class="fa fa-flask"></span>
          <div class="content-user">Laboratory</div>
        </div>
        </a> <a href="index.php?page=medicines.php">
        <div class="col-lg-3 hvr-nav-user"> <span class="fa fa-medkit"></span>
          <div class="content-user">Medicines</div>
        </div>
        </a> </div>
    </div>
    <div class="col-lg-12 appointment">
      <div class="row">
        <div class="col-lg-6 apmt-left"> <span class="header-apmt">MAKE AN APPOINTMENT</span> <br />
          <br />
          <br />
          <br />
          <p class="apmt-content"><i class="fa fa-check"></i>&nbsp;Book Online Appointment</p>
          <p class="apmt-content"><i class="fa fa-check"></i>&nbsp;Instant appointment with doctors.</p>
          <p class="apmt-content"><i class="fa fa-check"></i>&nbsp;Guaranteed.</p>
          <br />
          <a href="#" style="color:#FFFFFF"><span class="btnbook">Book Now</span></a> </div>
        <div class="col-lg-6 apmt-right"><img src="images/appointment.jpg" /></div>
      </div>
    </div>
  </div>
</form>
