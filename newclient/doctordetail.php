<?php
$docid=$ap_date=$timeslot=$desc=$date=$uid="";
if(isset($_POST['btnApp']))
{
	$docid=$_REQUEST['view'];
	$ap_date=$_POST['txtDate'];
	$timeslot=$_POST['droptimingSlot'];
	$desc=$_POST['description'];
	$date= date("d/m/Y");
	
    	include("mycon.php");
        $uid=$_SESSION['user'];

		mysql_query("Insert into `appointment_master`(`ap_id`, `doctor_id`, `user_id`, `ap_date`, `timing_slot_id`, `sub_timing_slot_id`, `description`, `date`, `status`) values(null,'$docid','$uid','$ap_date','$timeslot','0','$desc','$date','0')");
		
		echo "<script>alert('Your Appointment is made Succssfully.');window.location.href='index.php?page=doctordetail.php&view=$docid'</script>";
}

?>

<form action="index.php?page=doctordetail.php<?php if((isset($_REQUEST['view']))) { echo "&view=".$_REQUEST['view'];} ?>" method="post">
<input type="hidden" id="hidView" name="hidView"  value="<?php echo $_REQUEST['view']; ?>" />

  <div class="d-slider"> <span><i class="fa fa-home"></i>&nbsp; Home </span> &nbsp; > &nbsp;<span> Doctor Details</span> &nbsp; > &nbsp; <span>
    <?php $t=$_REQUEST['view'];
		include("mycon.php");
		$data=mysql_query("SELECT * FROM `doctor_master` WHERE doctor_id=$t");
		while($result = mysql_fetch_array($data))
			{	
				$name = $result['dr_name'];
				$speciality=$result["sp_id"];   
                $qualification=$result["qua_id"];
                $address=$result["address"];
                $pincode=$result["pin"];
                $mci=$result["mci_no"];
                $website=$result["website"];
                $state=$result["state_id"];
                $city=$result["city_id"];
                $timing=$result["timing"];
                list($timingf, $timingt) = explode('|', $timing);
                $cname=$result["clinic_name"];
                $contact=$result["clinic_contact"];
                $about=$result["about"];
                $logo=$result["logo"];
				 
			?>
    <b>Dr. <?php echo $name ?></b></span> </div>
  <div class="u-detail">
    <div class="row">
      <div class="col-lg-4"> <a target="_blank" href="<?php echo $logo ?>"> <img width="250px" height="250px" border="1px" src='<?php echo $logo ?>' alt='<?php echo $name; ?>'> </a> </div>
      <div class="col-lg-4">
        <h2 class="u-title">Dr. <?php echo $name ?></h2>
        <ul class="u-info" style="border:none;">
          <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Speciality : </span><span><?php echo $speciality; ?></span></li>
          <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Qualification : </span><span><?php echo $qualification; ?></span></li>
          <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Clinic Name : </span><span><?php echo $cname; ?></span></li>
          <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Clinic Time : </span><span><?php echo $timingf.' To '.$timingt; ?></span></li>
          <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Website : </span><span><?php echo $website; ?></span></li>
          <li class="u-info-list"><span><i class="fa fa-angle-right"></i> Address : </span><span><?php echo $address; ?></span></li>
        </ul>
      </div>
      
      <div class="col-lg-4">
        <h2 class="u-title">About Doctor</h2>
        <span class="u-info-list text-center"><?php echo $about; ?></span>
        <?php /*?><?php if(isset($_SESSION['usertypeid'])){
				$utid=$_SESSION['usertypeid'];
				if ($utid == 5){
			
		?><?php */?>
        <a id="btnAppointment" href="#">
        	<div class="btnprofile text-center" style="width:50%;margin-top:25px;">Make Appointment</div>
        </a>
        <?php /*?><?php } }?><?php */?>
      </div>
    </div>
    
    <div class="row" style="margin-top:50px;display:none" id="boxAppointment">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <div class="form-vertical">
          <div class="form-group">
            <label>Date :</label>
            <?php 
			$dt = date('Y-m-d', strtotime(" +1 days"));
			$edt = date('Y-m-d', strtotime(" +1 months"));
			
			?>
            <input type="date" name="txtDate" id="txtDate" required="required" min="<?php echo $dt; ?>" max="<?php echo $edt; ?>" class="form-control"/>
          </div>
        </div>
        <div class="form-vertical">
          <div class="form-group">
            <label>Time Slot :</label>
            <select name="droptimingSlot" id="droptimingSlot" class="form-control">
              <option value="0">-----Available Time Slots-----</option>
              <?php           
                            include("mycon.php");
                            $datas=mysql_query("select * from slot_master");
                            
                            while($results=mysql_fetch_array($datas))
                            {
                                ?>
              <option value="<?php echo $results["timing_slot_id"]; ?>"><?php echo $results["timing"]; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-vertical">
          <div class="form-group">
            <label>Description :</label>
            <textarea name="description" id="description" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-vertical">
          <div class="form-group">
            <input type="submit" name="btnApp" id="btnApp" value="Make Appointment" class="btn btn-blue"/>
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
    
	$("#btnAppointment").click(function(e){
		$("#boxAppointment").slideToggle(1000);
		//$(this).hide(0);
		return false;
		
	});
	
	$("#btncancel").click(function(e){
	$("#boxAppointment").slideUp(1000);
	// $("#btnAppointment").show(0);
	return false;
		
	});
	
	$("#txtDate").change(function(){
    $('#droptimingSlot').find('option').remove().end(); //clear the city ddl
    var dt = $(this).val();
	var did = $('#hidView').val();
	
    //do the ajax call
    var objData = {
      method:'getTimeSlot',
      txtDate :dt,
	  hidView :did

  };
    //do the ajax call
    $.ajax({
         url:'cacd/ByFunction.php',
		 type:'POST',
		 data:objData,
		 dataType:'json',
		 cache:false,
        success:function(data){                     
			var obj = data;
        	var ddl = document.getElementById('droptimingSlot');                      
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
        	console.log(jxhr.responseText);
        

    	}
    }); 

});
	
});


</script> 
