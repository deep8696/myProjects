<?php 
$dname=$gender=$dob=$speciality=$qualification=$address=$pincode=$mci=$website=$state=$city=$timing=$cname=$contact=$about=$logo="";
$dbDname=$dbGender=$dbDob=$dbSpeciality=$dbQualification=$dbmci=$dbcname=$dbcity=$dbstate=$dbPincode="";
if(isset($_SESSION['user']))
{
    include("mycon.php");
    $uid=$_SESSION['user'];
    $data=mysql_query("SELECT * FROM `doctor_master` WHERE user_id=$uid");
    if(mysql_num_rows($data)>0)
    {
        while($result = mysql_fetch_array($data))
        {
            $dname=$result["dr_name"];
            $dbDname="disabled";
            $gender=$result["gender"];
            $dbGender="disabled";
            $dob=$result["dob"];
            $dbDob="disabled";
            $speciality=$result["sp_id"];
            $dbSpeciality="disabled";
            $qualification=$result["qua_id"];
            $dbQualification="disabled";
            $address=$result["address"];
            $pincode=$result["pin"];
			$dbPincode="disabled";
            $mci=$result["mci_no"];
            $dbmci="disabled";
            $website=$result["website"];
            $state=$result["state_id"];
            $dbstate="disabled";
            $city=$result["city_id"];
            $dbcity="disabled";
            $timing=$result["timing"];
            list($timingf, $timingt) = explode('|', $timing);
            $cname=$result["clinic_name"];
            $dbcname="disabled";
            $contact=$result["clinic_contact"];
            $about=$result["about"];
            $logo=$result["logo"];

        }
    }
}

if(isset($_POST['save']))
{
    $address=$_POST['address'];
    $pincode=$_POST['pincode'];
    $website=$_POST['website'];
    $timingf=$_POST['timingf'];
    $timingt=$_POST['timingt'];
    $timing=$timingf."|".$timingt;
    $contact=$_POST['contact'];
    $about=$_POST['about'];

    if(isset($_SESSION['user']))
    {
        include("mycon.php");
        $uid=$_SESSION['user'];
        $data=mysql_query("SELECT * FROM `doctor_master` WHERE user_id=$uid");
        if(mysql_num_rows($data)>0)
        {
                    //updatekarvanu coding

            if($_FILES['logo']['error'] > 0)
            {

                $logo=$_POST['logopath'];

            }
            else
            {
                $logo = "images/Doctor/".$_FILES['logo']['name'];
                move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
            }

            $uid=$_SESSION['user'];
            include("mycon.php");
            $datas=mysql_query("UPDATE `doctor_master` SET `address`='$address',`pin`=$pincode,`website`='$website',`timing`='$timing',`clinic_contact`=$contact,`about`='$about',`logo`='$logo',`status`='0' WHERE user_id=$uid");
            if($datas>0)
            {
                       echo "<script>alert('Profile Update Successfully !!!!...');window.location.href='index.php?page=dmaster.php&cprofile=proof.php'</script>";
                   }
                   else{
                    echo "<script>alert('Error in Profile Update!!!!...');window.location.href='index.php?page=dmaster.php&cprofile=dprofile.php'</script>";

                }
            }
            else
            {
               $dname=$_POST['dname'];
               $gender=$_POST['gender'];
               $dob=$_POST['dob'];
               $speciality=$_POST['speciality'];   
               $qualification=$_POST['qualification'];
               $state=$_POST['state'];
               $city=$_POST['city'];
               $cname=$_POST['cname'];
               $mci=$_POST['mci'];
                    //insert nu codding
               $logo = "images/Doctor/".$_FILES['logo']['name'];
               move_uploaded_file($_FILES['logo']['tmp_name'], $logo);

               $uid=$_SESSION['user'];
               include("mycon.php");
               $datas=mysql_query("INSERT INTO `doctor_master`(`doctor_id`, `user_id`, `dr_name`, `gender`, `dob`, `sp_id`, `qua_id`, `address`, `pin`, `mci_no`, `website`, `state_id`, `city_id` , `timing`, `clinic_name`, `clinic_contact`, `about`, `logo`, `status`) VALUES ('null',$uid,'$dname','$gender','$dob',$speciality,'$qualification','$address',$pincode,'$mci','$website',$state,$city,'$timing','$cname',$contact,'$about','$logo','0')");
               echo "<script>alert('Profile Inserted Successfully !!!!...');window.location.href='index.php?page=dmaster.php&cprofile=proof.php'</script>";

           }
       }
   }




   ?>
   <div class="cprofile">
    <div class="row">
        <div class="col-lg-8">
            <table cellspacing="10px">
                <tr>
                    <td>Doctor Name</td>
                    <td><input <?php echo $dbDname; ?> type="text" name="dname" id="dname" required="required" class="cform" value="<?php echo $dname ?>" /></td>
                </tr>

                <tr>
                    <td>Gender</td>
                    <td><input type="radio" <?php if($gender == "male"){ echo "checked";} ?> name="gender" value="male" <?php echo $dbGender; ?> />Male
                        <input type="radio" name="gender" <?php if($gender == "female"){ echo "checked";} ?> value="female" <?php echo $dbGender; ?> />Female</td>
                    </tr>

                    <tr>    
                        <td>Date Of Birth</td>
                        <td><input <?php echo $dbDob; ?> type="date" name="dob" id="dob" required="required" class="cform" value="<?php echo $dob ?>"/></td>
                    </tr>

                    <tr>
                        <td>Speciality</td>
                        <td><select name="speciality" class="cform" <?php echo $dbSpeciality;?>>
                            <option value="">---Select Speciality---</option>
                            <?php 

                            include("mycon.php");
                            $datas=mysql_query("select * from speciality");
                            
                            while($results=mysql_fetch_array($datas)){
                                ?>
                                <option  <?php if($speciality == $results["sp_id"]){ echo "selected";} ?> value="<?php echo $results["sp_id"]; ?>"><?php echo $results["specialist"]; ?></option>
                                <?php
                            }
                            ?>      
                        </select></td>
                    </tr>

                    <tr>
                        <td>Qualification</td>
                        <td><input <?php echo $dbQualification; ?> type="text" name="qualification" id="qualification" required="required" class="cform" value="<?php echo $qualification ?>"/></td>
                    </tr>

                    <tr>
                        <td>State</td>
                        <td>

                            <select name="state" id="state" class="cform" <?php echo $dbstate; ?>>
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
                                <select name="city" id="city" class="cform" <?php echo $dbcity; ?>>
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
                                <td>Address</td>
                                <td><textarea name="address" id="address" required="required" class="cform" rows="4" style="height: 65px;" 
                                    ><?php echo $address ?></textarea></td>
                                </tr>

                                <tr>
                                    <td>Pincode</td>
                                    <td><input <?php echo $dbPincode; ?> type="number" name="pincode" id="pincode" required="required" class="cform" value="<?php echo $pincode ?>"/></td>
                                </tr>

                                <tr>
                                    <td>MCI-No</td>
                                    <td><input <?php echo $dbmci; ?> type="text" name="mci" id="mci" required="required" class="cform" value="<?php echo $mci ?>"/></td>
                                </tr>

                                <tr>
                                    <td>Website</td>
                                    <td><input type="text" name="website" id="website" class="cform" value="<?php echo $website ?>"/></td>
                                </tr>      



                                <tr>
                                    <td>From</td>
                                    <td><input type="time" name="timingf" id="timingf" required="required" class="cformtime" value="<?php echo $timingf ?>"/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="time" name="timingt" id="timingt" required="required" class="cformtime" value="<?php echo $timingt ?>"/></td>

                                    </tr> 

                                    <tr>
                                        <td>Clinic Name</td>
                                        <td><input <?php echo $dbcname; ?> type="text" name="cname" id="cname" required="required" class="cform" value="<?php echo $cname ?>"/></td>
                                    </tr>  

                                    <tr>
                                        <td>Clinic Contact</td>
                                        <td><input type="number" name="contact" id="contact" required="required" class="cform" value="<?php echo $contact ?>"/></td>
                                    </tr> 

                                    <tr>
                                        <td>About</td>
                                        <td><textarea name="about" id="about" required="required" class="cform" rows="4" style="height: 65px;" ><?php echo $about ?></textarea></td>
                                    </tr> 

                                    <tr>
                                        <td>Logo</td>
                                        <td><input type="file" name="logo" id="logo" /></td>
                                        <input type="hidden" name="logopath" id="logopath" value="<?php echo $logo ?>" />
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="save" id="save" value="Submit" class="btn btn-blue"/></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <a target="_blank" href="<?php echo $logo ?>">
                                    <img width="200px" height="200px" border="2px" src='<?php echo $logo ?>' alt='<?php echo $dname ?>'>
                                </a>
                            </div>
                        </div>


                    </div>