<?php
$labid=$name=$email=$contact=$subject=$msg=$uid="";
if(isset($_POST['btnInquiry']))
{
	$sender_id=$_SESSION['user'];
	$labid=$_REQUEST['view'];
	$labuid=mysql_query("SELECT user_id FROM `lab_master` WHERE lab_id=$labid");
	while($res= mysql_fetch_array($labuid)){
	$receiver= $res['user_id'];
	}
	$name=$_POST['txtName'];
	$email=$_POST['txtEmail'];
	$contact=$_POST['contact'];
	$subject=$_POST['dropSubject'];
	$msg=$_POST['msg'];
	$date= date("d/m/Y");
	
    include("mycon.php");

	mysql_query("Insert into `inquiry_master`(`inq_id`, `sender_id`, `receiver_id`, `name`, `email`, `contact_no`, `subject`, `msg`, `date`, `status`) values(null,'$sender_id','$receiver','$name','$email','$contact','$subject','$msg','$date','0')");
		
	echo "<script>alert('Your Inquiry is made Succssfully.');window.location.href='index.php?page=laboratorydetail.php&view=$labid'</script>";
}

?>


<form action="index.php?page=laboratorydetail.php<?php if((isset($_REQUEST['view']))) { echo "&view=".$_REQUEST['view'];} ?>" method="post">
<input type="hidden" id="hidView" name="hidView"  value="<?php echo $_REQUEST['view']; ?>" />

  <div class="d-slider"> <span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Laboratory Details</span> &nbsp; > &nbsp; <span>
    <?php $t=$_REQUEST['view'];
		include("mycon.php");
		$data=mysql_query("SELECT * FROM `lab_master` WHERE lab_id=$t");
		while($result = mysql_fetch_array($data))
		{	
			$labtype=$result['labtype_id'];    
            $labname=$result['lab_name'];
            $dname=$result['dr_name'];
            $address=$result['address'];
            $state=$result['state'];
            $city=$result['city'];
            $pincode=$result['pin'];
            $mci=$result['mci_no'];
            $speciality=$result['specialization'];
            $timing=$result['timing'];
            list($timingf, $timingt) = explode('|', $timing);
            $contact=$result['lab_contact'];
            $website=$result['website'];
            $about=$result['about'];
            $logo=$result['logo'];
				 
		?>
    <b><?php echo $labname ?></b></span> </div>
  
  <div class="u-detail">
        <div class="row">
              <div class="col-lg-4">
                <a target="_blank" href="<?php echo $logo ?>"> <img width="250px" height="250px" border="1px" src='<?php echo $logo ?>' alt='<?php echo $labname; ?>'> </a> 
              </div>
              
              <div class="col-lg-4">
                <h2 class="u-title"><?php echo $labname ?></h2>
                <ul class="u-info" style="border:none;">
                  <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Speciality : </span><span><?php echo $speciality; ?></span></li>
                  <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Clinic Time : </span><span><?php echo $timingf.' To '.$timingt; ?></span></li>
                  <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Website : </span><span><?php echo $website; ?></span></li>
                  <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Address : </span><span><?php echo $address; ?></span></li>
                </ul>
              </div>
              
              <div class="col-lg-4">
                <h2 class="u-title">About Laboratory</h2>
                <span class="u-info-list text-center"><?php echo $about; ?></span>
                <a id="btnInquiry" href="#">
        			<div class="btnprofile text-center" style="width:50%;margin-top:25px;">Make Inquiry</div>
        		</a>
              </div>
        </div>
        
        <div class="row" style="margin-top:50px;display:none" id="boxAppointment">
      		<div class="col-lg-3"></div>
      		
            <div class="col-lg-6">
        		<div class="form-vertical">
          			<div class="form-group">
                    	<label>Name :</label>
                        <input type="text" name="txtName" id="txtName" class="form-control" required="required"/>
                    </div>
                    
                    <div class="form-group">
                    	<label>E-mail :</label>
                        <input type="text" name="txtEmail" id="txtEmail" class="form-control" required="required"/>
                    </div>
                    
                    <div class="form-group">
                    	<label>Contact No :</label>
                        <input type="text" name="contact" id="contact" class="form-control" required="required"/>
                    </div>
                    
                    <div class="form-group">
                    	<label>Subject :</label>
                        <select name="dropSubject" id="dropSubject" class="form-control">
                            <option value="0">---Select Subject---</option>
                            <option value="Complain">Complain</option>
                            <option value="LabTest">Lab Test</option>
                            <option value="Suggestion">Suggestion</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                    	<label>Message :</label>
                    	<textarea name="msg" id="msg" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                    	<input type="submit" name="btnInquiry" id="btnInquiry" value="Make Inquiry" class="btn btn-blue"/>
            			<input type="button" name="btncancel" id="btncancel" value="Cancel" class="btn btn-blue"/>
                    </div>
                     
                </div>
             </div>
             
             <div class="col-lg-3"></div>
         </div>
   </div>
<?php 
	}
?>
</form>

<script type="text/javascript">

$(document).ready(function() {
    
	$("#btnInquiry").click(function(e){
		$("#boxAppointment").slideToggle(1000);
		//$(this).hide(0);
		return false;
		
	});
	
	$("#btncancel").click(function(e){
	$("#boxAppointment").slideUp(1000);
	// $("#btnAppointment").show(0);
	return false;
		
	});
});
</script>