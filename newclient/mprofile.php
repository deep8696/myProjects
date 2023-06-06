<?php 
$mname=$oname=$address=$pincode=$website=$state=$city=$timing=$contact=$about=$logo="";
$dbMname=$dbCity=$dbState=$dbPincode="";
if(isset($_SESSION['user']))
{
  include("mycon.php");
  $uid=$_SESSION['user'];
  $data=mysql_query("SELECT * FROM `medical_master` WHERE user_id=$uid");
  if(mysql_num_rows($data)>0)
  {
    while($result = mysql_fetch_array($data))
    {
      $mname=$result["medical_name"];
      $dbMname="disabled";
      $oname=$result["owner_name"];
      $address=$result["address"];
      $state=$result["state_id"];
      $dbState="disabled";
      $city=$result["city_id"];
      $dbCity="disabled";
      $pincode=$result["pin"];
      $dbPincode="disabled";
	  $website=$result["website"];
      $contact=$result["contact"];
      $about=$result["about"];
      $logo=$result["logo"];
      $timing=$result["timing"];
      list($timingf, $timingt) = explode('|', $timing);
    }
  }
}

if(isset($_POST['save']))
{

  $oname=$_POST['oname'];
  $address=$_POST['address'];

  $pincode=$_POST['pincode'];
  $website=$_POST['website'];
  $contact=$_POST['contact'];
  $about=$_POST['about'];
  $timingf=$_POST['timingf'];
  $timingt=$_POST['timingt'];
  $timing=$timingf."|".$timingt;


  if(isset($_SESSION['user']))
  {
    include("mycon.php");
    $uid=$_SESSION['user'];
    $data=mysql_query("SELECT * FROM `medical_master` WHERE user_id=$uid");
    if(mysql_num_rows($data)>0)
    {
                    //updatekarvanu coding

      if($_FILES['logo']['error'] > 0)
      {

        $logo=$_POST['logopath'];

      }
      else
      {
        $logo = "images/Medical/".$_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
      }

      $uid=$_SESSION['user'];
      include("mycon.php");
            
      $datas=mysql_query("UPDATE `medical_master` SET `owner_name`='$oname',`address`='$address',`pin`=$pincode,`website`='$website',`timing`='$timing',`contact`=$contact,`about`='$about',`logo`='$logo',`status`='0' WHERE user_id=$uid");

      if($datas>0)
      {
        echo "<script>alert('Profile Update Successfully !!!!...');window.location.href='index.php?page=mmaster.php&cprofile=proof.php'</script>";

      }
      else{
        echo "<script>alert('Error in Profile Update!!!!...');window.location.href='index.php?page=mmaster.php&cprofile=mprofile.php'</script>";

      }
    }
    else
    {
      $mname=$_POST['mname'];
      $state=$_POST['state'];
      $city=$_POST['city'];
                    //insert nu codding
      $logo = "images/Medical/".$_FILES['logo']['name'];
      move_uploaded_file($_FILES['logo']['tmp_name'], $logo);

      $uid=$_SESSION['user'];
      include("mycon.php");
      $datas=mysql_query("INSERT INTO `medical_master`(`medical_id`, `user_id`, `medical_name`, `owner_name`, `address`, `state_id`, `city_id`, `pin`, `website`, `timing`, `contact`, `about`, `logo`, `status`) VALUES ('null',$uid,'$mname','$oname','$address',$state,$city,'$pincode','$website','$timing','$contact','$about','$logo','0')");
      echo "<script>alert('Profile Inserted Successfully !!!!...');window.location.href='index.php?page=mmaster.php&cprofile=proof.php'</script>";

    }
  }
}
?>
<div class="cprofile">
  <div class="row">
    <div class="col-lg-8">
      <table cellspacing="10px">
       <tr>
         <td>Medical Name</td>
         <td><input <?php echo $dbMname; ?> type="text" name="mname" id="mname" required="required" class="cform" value="<?php echo $mname ?>"/></td>
       </tr>

       <tr>
         <td>Owner Name</td>
         <td><input type="text" name="oname" id="oname" required="required" class="cform" value="<?php echo $oname ?>"/></td>
       </tr>

       <tr>
         <td>Address</td>
         <td><textarea name="address" id="address" required="required" class="cform" rows="4" style="height: 65px;"><?php echo $address ?></textarea>
         </td>
       </tr>



       <tr>
         <td>State</td>
         <td>
           <select name="state" id="state" class="cform" <?php echo $dbCity; ?>>
            <option value="0">-----Select State-----</option>
            <?php           
            include("mycon.php");
            $datas=mysql_query("select * from state_master");

            while($results=mysql_fetch_array($datas))
            {
              ?>
              <option  <?php if($state == $results["state_id"]){ echo "selected";} ?> value="<?php echo $results["state_id"]; ?>"><?php echo $results["state"]; ?></option>
              <?php } ?>      
            </select>
          </td>
        </tr>

        <tr>
          <td>City</td>
          <td>
            <select name="city" id="city" class="cform" <?php echo $dbState; ?>>
              <option value="0">-----Select City-----</option>
              <?php           
              include("mycon.php");
              $datas=mysql_query("select * from city_master");

              while($results=mysql_fetch_array($datas))
              {
                ?>
                <option  <?php if($city == $results["city_id"]){ echo "selected";} ?> value="<?php echo $results["city_id"]; ?>"><?php echo $results["city"]; ?></option>
                <?php } ?>      
              </select>
            </td>
          </tr>



          <tr>
           <td>Pincode</td>
           <td><input <?php echo $dbPincode; ?> type="number" name="pincode" id="pincode" required="required" class="cform" value="<?php echo $pincode ?>"/></td>
         </tr>

         <tr>
           <td>Website</td>
           <td><input type="text" name="website" id="website" class="cform" value="<?php echo $website ?>"/></td>
         </tr>      

         <tr>
           <td>From</td>
           <td><input type="time" name="timingf" id="timingf" required="required" class="cformtime" value="<?php echo $timingf ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="time" name="timingt" id="timingt" required="required" class="cformtime" value="<?php echo $timingt ?>"/></td>        </tr> 



            <tr>
             <td>Medical Contact</td>
             <td><input type="number" name="contact" id="contact" required="required" class="cform" value="<?php echo $contact ?>"/></td>
           </tr> 

           <tr>
             <td>About</td>
             <td><textarea name="about" id="about" required="required" class="cform" rows="4" style="height: 65px;"><?php echo $about ?></textarea></td>
           </tr> 

           <tr>
             <td>Logo</td>
             <td><input type="file" name="logo" id="logo" /></td>
             <input type="hidden" name="logopath" id="logopath" value="<?php echo $logo ?>" />
           </tr>

           <tr>
            <td></td>
            <td>
              <input type="submit" name="save" id="save" value="Submit" class="btn btn-blue"/></td>
            </tr>
          </table>
        </div>
        <div class="col-lg-4">
          <a target="_blank" href="<?php echo $logo ?>">
            <img width="200px" height="200px" border="2px" src='<?php echo $logo ?>' alt='<?php echo $mname ?>'>
          </a>
        </div>
      </div>
    </div>