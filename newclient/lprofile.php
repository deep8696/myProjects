<?php 

$labtype=$lname=$dname=$address=$state=$city=$pincod=$mci=$specialization=$timing=$contact=$website=$about=$logo="";
$dbLname=$dbDname=$dbCity=$dbState=$dbMci=$dbPincode="";
if(isset($_SESSION['user']))
{
    include("mycon.php");
    $uid=$_SESSION['user'];
    $data=mysql_query("SELECT * FROM `lab_master` WHERE user_id=$uid");
    if(mysql_num_rows($data)>0)
    {
        while($result = mysql_fetch_array($data))
        {
            $labtype=$result['labtype_id'];    
            $lname=$result['lab_name'];
            $dbLname="disabled";
            $dname=$result['dr_name'];
            $dbDname="disabled";
            $address=$result['address'];
            $state=$result['state'];
            $dbState="disabled";
            $city=$result['city'];
            $dbCity="disabled";
            $pincode=$result['pin'];
            $dbPincode="disabled";
			$mci=$result['mci_no'];
            $dbMci="disabled";
            $specialization=$result['specialization'];
            $timing=$result['timing'];
            list($timingf, $timingt) = explode('|', $timing);
            $contact=$result['lab_contact'];
            $website=$result['website'];
            $about=$result['about'];
            $logo=$result['logo'];

        }
    }
}

if(isset($_POST['save'])){
    $labtype=$_POST['labtype'];
    $address=$_POST['address'];
    $pincode=$_POST['pincode'];
    $specialization=$_POST['specialization'];
    $timingf=$_POST['timingf'];
    $timingt=$_POST['timingt'];
    $timing=$timingf."|".$timingt;
    $contact=$_POST['contact'];
    $website=$_POST['website'];
    $about=$_POST['about'];
    //$logo=$_POST['logo'];

    if(isset($_SESSION['user']))
    {
        include("mycon.php");
        $uid=$_SESSION['user'];
        $data=mysql_query("SELECT * FROM `lab_master` WHERE user_id=$uid");
        if(mysql_num_rows($data)>0)
        {
                    //updatekarvanu coding

            if($_FILES['logo']['error'] > 0)
            {
                $logo=$_POST['logopath'];
            }
            else
            {
                $logo = "images/Laboratory/".$_FILES['logo']['name'];
                move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
            }

            $uid=$_SESSION['user'];
            include("mycon.php");
            $datas=mysql_query("UPDATE `lab_master` SET `labtype_id`=$labtype,`address`='$address',`pin`=$pincode,`specialization`='$specialization',`timing`='$timing',`lab_contact`='$contact',`website`='$website',`about`='$about',`logo`='$logo',`status`='0' WHERE user_id=$uid");

            if($datas>0)
            {
                echo "<script>alert('Profile Update Successfully !!!!...');window.location.href='index.php?page=lmaster.php&cprofile=proof.php'</script>";
                
            }
            else{
                echo "<script>alert('Error in Profile Update!!!!...');window.location.href='index.php?page=lmaster.php&cprofile=dprofile.php'</script>";
                
            }
        }
        else
        {
            $lname=$_POST['lname'];
            $dname=$_POST['dname'];
            $state=$_POST['state'];
            $city=$_POST['city'];
            $mci=$_POST['mci'];
                    //insert nu codding
            $logo = "images/Laboratory/".$_FILES['logo']['name'];
            move_uploaded_file($_FILES['logo']['tmp_name'], $logo);

            $uid=$_SESSION['user'];
            include("mycon.php");

            $datas=mysql_query("INSERT INTO `lab_master`(`lab_id`, `user_id`, `labtype_id`, `lab_name`, `dr_name`, `address`, `city`, `state`, `pin`, `mci_no`, `specialization`, `timing`, `lab_contact`, `website`, `about`, `logo`, `status`) VALUES ('null',$uid,$labtype,'$lname','$dname','$address','$city','$state',$pincode,'$mci','$specialization','$timing','$contact','$website','$about','$logo','0')");
            echo "<script>alert('Profile Inserted Successfully !!!!...');window.location.href='index.php?page=lmaster.php&cprofile=proof.php'</script>";
            
        }
    }
}

?>



<div class="cprofile">
    <div class="row">
        <div class="col-lg-8">

            <table cellspacing="10">

                <tr>
                    <td>Laboratory Type</td>
                    <td>
                        <select name="labtype" id="labtype" class="cform">
                            <option value="0">-----Select Labtype-----</option>
                            <?php           
                            include("mycon.php");
                            $datas=mysql_query("select * from labtype_master");

                            while($results=mysql_fetch_array($datas))
                            {
                                ?>
                                <option  <?php if($labtype == $results["labtype_id"]){ echo "selected";} ?> value="<?php echo $results["labtype_id"]; ?>"><?php echo $results["labtype_name"]; ?></option>
                                <?php } ?>      
                            </select>
                        </td>
                    </tr>
                    <tr>
                       <td>Laboratory Name</td>
                       <td>
                           <input <?php echo $dbLname; ?> type="text" name="lname" id="lname" required="required" class="cform" value="<?php echo $lname ?>" />
                       </td>
                   </tr>

                   <tr>
                       <td>Doctor Name</td>
                       <td><input <?php echo $dbDname; ?> type="text" name="dname" id="dname" required="required" class="cform" value="<?php echo $dname ?>" /></td>
                   </tr>




                   <tr>
                    <td>State</td>
                    <td>

                        <select name="state" id="state" class="cform" <?php echo $dbState; ?>>
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
                        <select name="city" id="city" class="cform" <?php echo $dbCity; ?>>
                            <option value="0">-----Select State-----</option>
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
                           <td><input <?php echo $dbMci; ?> type="text" name="mci" id="mci" required="required" class="cform" value="<?php echo $mci ?>" /></td>
                       </tr>

                       <tr>
                           <td>Specialization</td>
                           <td><input type="text" name="specialization" id="specialization" required="required" class="cform" value="<?php echo $specialization ?>" /></td>
                       </tr> 

                       <tr>
                        <td>From</td>
                        <td><input type="time" name="timingf" id="timingf" required="required" class="cformtime" value="<?php echo $timingf ?>"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="time" name="timingt" id="timingt" required="required" class="cformtime" value="<?php echo $timingt ?>"/></td>

                        </tr> 

                        <tr>
                           <td>Laboratory Contact</td>
                           <td><input type="number" name="contact" id="contact" required="required" class="cform" value="<?php echo $contact ?>"/></td>
                       </tr> 

                       <tr>
                           <td>Website</td>
                           <td><input type="text" name="website" id="website" class="cform" value="<?php echo $website ?>"/></td>
                       </tr>      

                       <tr>
                        <td>About</td>
                        <td>
                            <textarea name="about" id="about" required="required" class="cform" rows="4" style="height: 65px;" ><?php echo $about ?></textarea></td>
                        </tr> 

                        <tr>
                            <td>Logo</td>
                            <td>
                                <input type="file" name="logo" id="logo" />
                            </td>
                            <input type="hidden" name="logopath" id="logopath" value="<?php echo $logo ?>" />
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="save" id="save" value="Submit" class="btn btn-blue"/>
                            </td>
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