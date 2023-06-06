<?php
$hname=$state=$city=$address=$oincode=$specialization=$mci=$timing=$website=$contact=$eyear=$about=$logo="";
$dbHname=$dbState=$dbCity=$dbMci=$dbEyear=$dbPincode="";
if(isset($_SESSION['user']))
        {
            include("mycon.php");
            $uid=$_SESSION['user'];
            $data=mysql_query("SELECT * FROM `hospital_master` WHERE user_id=$uid");
            if(mysql_num_rows($data)>0)
            {
                while($result = mysql_fetch_array($data))
                {
                    $hname=$result["hos_name"];
                    $dbHname="disabled";
                    $state=$result["state_id"];
                    $dbState="disabled";
                    $city=$result["city_id"];
                    $dbCity="disabled";
                    $address=$result["address"];   
                    $pincode=$result["pin"];
					$dbPincode="disabled";
                    $mci=$result["mci_no"];
                    $dbMci="disabled";
                    $specialization=$result["specialization"];
                    $timing=$result["timing"];
                    list($timingf, $timingt) = explode('|', $timing);
                    $website=$result["website"];
                    $contact=$result["contact_no"];
                    $eyear=$result["establishment_year"];
                    $dbEyear="disabled";
                    $about=$result["about"];
                    $logo=$result["logo"];
                }
            }
        }
            
        if(isset($_POST['save']))
        {
            
                    $address=$_POST["address"];   
                    $pincode=$_POST["pincode"];
                    
                    $specialization=$_POST["specialization"];
                    $timingf=$_POST['timingf'];
                    $timingt=$_POST['timingt'];
                    $timing=$timingf."|".$timingt;
                    $website=$_POST["website"];
                    $contact=$_POST["contact"];
                   
                    $about=$_POST["about"];
                    

            
            

            if(isset($_SESSION['user']))
            {
                include("mycon.php");
                $uid=$_SESSION['user'];
                $data=mysql_query("SELECT * FROM `hospital_master` WHERE user_id=$uid");
                if(mysql_num_rows($data)>0)
                {
                    //updatekarvanu coding

                    if($_FILES['logo']['error'] > 0)
                    {
                        
                        $logo=$_POST['logopath'];

                    }
                    else
                    {
                        $logo = "images/Hospital/".$_FILES['logo']['name'];
                        move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
                    }


                    $uid=$_SESSION['user'];
                    include("mycon.php");

                    $datas=mysql_query("UPDATE `hospital_master` SET `address`='$address',`pin`='$pincode',`specialization`='$specialization',`timing`='$timing',`website`='$website',`contact_no`=$contact,`about`='$about',`logo`='$logo',`status`='0' WHERE user_id=$uid");
                    if($datas>0)
                    {
                        echo "<script>alert('Profile Update Successfully !!!!...');window.location.href='index.php?page=hmaster.php&cprofile=proof.php'</script>";
                        
                    }
                    else{
                        echo "<script>alert('Error in Profile Update!!!!...');window.location.href='index.php?page=hmaster.php&cprofile=dprofile.php'</script>";
                        
                    }
                }
                else
                {
                    $hname=$_POST["hname"];
                    $state=$_POST["state"];
                    $city=$_POST["city"];
                    $mci=$_POST["mci"];
                    $eyear=$_POST["eyear"];
                    //insert nu codding
                    $logo = "images/Hospital/".$_FILES['logo']['name'];
                    move_uploaded_file($_FILES['logo']['tmp_name'], $logo);

                    $uid=$_SESSION['user'];
                    include("mycon.php");
                    $datas=mysql_query("INSERT INTO `hospital_master`(`hos_id`, `user_id`, `hos_name`, `state_id`, `city_id`, `address`, `pin`, `mci_no`, `specialization`, `timing`, `website`, `contact_no`, `establishment_year`, `about`, `logo`, `status`) VALUES ('null',$uid,'$hname',$state,$city,'$address',$pincode,'$mci','$specialization','$timing','$website',$contact,$eyear,'$about','$logo','0')");
           
                    echo "<script>alert('Profile Inserted Successfully !!!!...');window.location.href='index.php?page=hmaster.php&cprofile=proof.php'</script>";
                    
                }
            }
        }
?>
<div class="cprofile">
<div class="row">
    <div class="col-lg-8">
        <table cellspacing="10px">
        <tr>
            <td>Hospital Name</td>
            <td><input <?php echo $dbHname; ?> type="text" name="hname" id="hname" required="required" class="cform" value="<?php echo $hname ?>" /></td>
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
            <td><textarea name="address" id="address" required="required" class="cform" rows="4" style="height: 65px;"><?php echo $address ?></textarea></td>
        </tr>
        
        <tr>
            <td>Pincode</td>
            <td><input <?php echo $dbPincode; ?> type="number" name="pincode" id="pincode" required="required" class="cform" value="<?php echo $pincode ?>"/></td>
        </tr>
        
        <tr>
            <td>MCI-No</td>
            <td><input <?php echo $dbMci; ?> type="text" name="mci" id="mci" required="required" class="cform" value="<?php echo $mci ?>"/></td>
        </tr>
        <tr>
            <td>Specialization</td>
            <td><input type="text" name="specialization" id="specialization" required="required" class="cform" value="<?php echo $specialization ?>"/></td>
        </tr>
        <tr>
            <td>From</td>
            <td><input type="time" name="timingf" id="timingf" required="required" class="cformtime" value="<?php echo $timingf ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="time" name="timingt" id="timingt" required="required" class="cformtime" value="<?php echo $timingt ?>"/></td>
            
        </tr> 
         <tr>
            <td>Website</td>
            <td><input type="text" name="website" id="website" class="cform" value="<?php echo $website ?>"/></td>
        </tr> 
        
        <tr>
            <td>Hospital Contact</td>
            <td><input type="number" name="contact" id="contact" required="required" class="cform" value="<?php echo $contact ?>"/></td>
        </tr> 
        <tr>
            <td>Establishment Year</td>
            <td><input <?php echo $dbEyear; ?> type="number" name="eyear" id="eyear" required="required" class="cform" value="<?php echo $eyear ?>"/></td>
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
        <img width="200px" height="200px" border="2px" src='<?php echo $logo ?>' alt='<?php echo $hname ?>'>
        </a>
    </div>
</div>
</div>