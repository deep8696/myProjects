<?php 
$patientname=$gender=$dob=$age=$address=$pincode=$qualification=$working=$about=$img="";
$dbPname=$dbGender=$dbDob=$dbPincode="";
if(isset($_SESSION['user']))
{
    include("mycon.php");
    $uid=$_SESSION['user'];
    $data=mysql_query("SELECT * FROM `patient_master` WHERE user_id=$uid");
    if(mysql_num_rows($data)>0)
    {
        while($result = mysql_fetch_array($data))
        {
            $patientname=$result["patient_name"];
            $dbPname="disabled";
            $gender=$result["gender"];
            $dbGender="disabled";
            $dob=$result["dob"];
            $dbDob="disabled";
            $age=$result["age"];
            
            $address=$result["address"];
            $pincode=$result["pin"];
			$dbPincode="disabled";
            $qualification=$result["qualification"];
            $working=$result["working"];
            $about=$result["about"];
            $img=$result["img"];


        }
    }
}

if(isset($_POST['save']))
{

    $age=$_POST["age"];
    $address=$_POST["address"];
    $pincode=$_POST["pin"];
    $qualification=$_POST["qualification"];
    $working=$_POST["working"];
    $about=$_POST["about"];
    $img=$_POST["img"];

    if(isset($_SESSION['user']))
    {
        include("mycon.php");
        $uid=$_SESSION['user'];
        $data=mysql_query("SELECT * FROM `patient_master` WHERE user_id=$uid");
        if(mysql_num_rows($data)>0)
        {
                    //updatekarvanu coding

            if($_FILES['img']['error'] > 0)
            {

                $img=$_POST['imgpath'];

            }
            else
            {
                $img = "images/Patient/".$_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], $img);
            }


            $datas=mysql_query("UPDATE `patient_master` SET age=$age,`address`='$address',`pin`=$pincode,`qualification`='$qualification',`working`='$working',`about`='$about',`img`='$img' WHERE user_id=$uid");



            if($datas>0)
            {
                echo "<script>alert('Profile Update Successfully !!!!...');window.location.href='index.php?page=dmaster.php&cprofile=proof.php';</script>";
                
            }
            else{
                echo "<script>alert('Error in Profile Update!!!!...');window.location.href='index.php?page=pmaster.php&cprofile=pprofile.php';</script>";
                
            }
        }
        else
        {
            $patientname=$_POST["patientname"];
            $gender=$_POST["gender"];
            $dob=$_POST["dob"];
                    //insert nu codding
            $img = "images/Patient/".$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $img);

            $uid=$_SESSION['user'];
            include("mycon.php");
            $datas=mysql_query("INSERT INTO `patient_master`(`patient_id`, `user_id`, `patient_name`, `gender`, `dob`, `age`, `address`, `pin`, `qualification`, `working`, `about`, `img`) VALUES ('null',$uid,'$patientname','$gender','$dob',$age,'$address',$pincode,'$qualification','$working','$about','$img')");

            
            echo "<script>alert('Profile Inserted Successfully !!!!...');</script>";
            /*window.location.href='index.php?page=dmaster.php&cprofile=proof.php'*/
        }
    }
}

?>
<div class="cprofile">
    <div class="row">
        <div class="col-lg-8">
            <table cellspacing="10px">
                <tr>
                    <td>Patient Name</td>
                    <td><input <?php echo $dbPname; ?> type="text" name="patientname" id="patientname" required="required" class="cform" value="<?php echo $patientname ?>" /></td>
                </tr>

                <tr>
                    <td>Gender</td>
                    <td><input <?php echo $dbGender; ?> type="radio" <?php if($gender == "male"){ echo "checked";} ?> name="gender" value="male" />Male
                        <input <?php echo $dbGender; ?> type="radio" name="gender" <?php if($gender == "female"){ echo "checked";} ?> value="female" />Female</td>
                    </tr>

                    <tr>    
                        <td>Date Of Birth</td>
                        <td><input <?php echo $dbDob; ?> type="date" name="dob" id="dob" required="required" class="cform" value="<?php echo $dob ?>"/></td>
                    </tr>

                    <tr>    
                        <td>Age</td>
                        <td>

                            <input type="text" name="age" id="age" required="required" class="cform" value="<?php echo $age ?>"/>

                        </tr>


                        <tr>
                            <td>Address</td>
                            <td><textarea name="address" id="address" required="required" class="cform" rows="4" style="height: 65px;" 
                                ><?php echo $address ?></textarea></td>
                            </tr>

                            <tr>
                                <td>Pincode</td>
                                <td><input <?php echo $dbPincode; ?> type="number" name="pin" id="pin" required="required" class="cform" value="<?php echo $pincode ?>"/></td>
                            </tr>


                            <tr>
                                <td>Qualification</td>
                                <td><input type="text" name="qualification" id="qualification" class="cform" value="<?php echo $qualification ?>"/></td>
                            </tr>      
                            <tr>
                                <td>Working</td>
                                <td><input type="text" name="working" id="working" required="required" class="cform" value="<?php echo $working ?>"/></td>
                            </tr> 

                            <tr>
                                <td>About</td>
                                <td><textarea name="about" id="about" required="required" class="cform" rows="4" style="height: 65px;" ><?php echo $about ?></textarea></td>
                            </tr> 

                            <tr>
                                <td>Image</td>
                                <td><input type="file" name="img" id="img" /></td>
                                <input type="hidden" name="imgpath" id="imgpath" value="<?php echo $img ?>" />
                            </tr>

                            <tr>
                                <td></td>
                                <td><input type="submit" name="save" id="save" value="Submit" class="btn btn-blue"/></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <a target="_blank" href="<?php echo $img ?>">
                            <img width="200px" height="200px" border="2px" src='<?php echo $img ?>' alt='<?php echo $patientname ?>'>
                        </a>
                    </div>
                </div>


            </div>