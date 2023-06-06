<div class="cprofile">
	<div class="row">
		<div class="col-lg-12">
			
            <?php
				if(isset($_SESSION['user']))
				{
					// doctor appointment view
					
					if(($_SESSION['usertypeid'])==1)
					{
						include("mycon.php");
						$uid=$_SESSION['user'];
						$data=mysql_query("SELECT appointment_master.ap_id,appointment_master.doctor_id,appointment_master.user_id,appointment_master.ap_date,appointment_master.timing_slot_id,appointment_master.sub_timing_slot_id,appointment_master.description,appointment_master.date,appointment_master.status,doctor_master.doctor_id,patient_master.patient_name,slot_master.timing FROM appointment_master INNER JOIN doctor_master ON appointment_master.doctor_id = doctor_master.doctor_id INNER JOIN patient_master ON appointment_master.user_id=patient_master.user_id INNER JOIN slot_master ON appointment_master.timing_slot_id = slot_master.timing_slot_id WHERE doctor_master.user_id=$uid");
						if(mysql_num_rows($data)>0)
					{ 
					
				?>

			<table class="table">
				<tr>
					<th style="width:10%">View</th>
					<th style="width:10%">AppointmentNo</th>
					<th style="width:10%">Patient</th>
					<th style="width:20%">Time</th>
					<th style="width:15%">AppointmentDate</th>
					<th style="width:25%">Description</th>
					<th style="width:10%">Date</th>
				</tr>
				<?php
					while($result = mysql_fetch_array($data))
					{
						$appoimentno=$result['ap_id'];
						$patientname=$result['patient_name'];
						$time=$result['timing'];
						$appoimentdate=$result['ap_date'];
						$discription=$result['description'];
						$date=$result['date']; 
				?>
            	<tr>
					<td style="width:10%"><a href="#"><i class="fa fa-eye"></i>&nbsp;View</a></td>
					<td style="width:10%"><?php echo $appoimentno; ?></td>
					<td style="width:10%"><?php echo $patientname; ?></td>
					<td style="width:20%"><?php echo $time; ?></td>
					<td style="width:15%"><?php echo $appoimentdate; ?></td>
					<td style="width:25%"><?php echo $discription; ?></td>
					<td style="width:10%"><?php echo $date; ?></td>
				</tr>
				<?php 
					}
				?>
            </table>
			<?php
					}
            	  	}
				  
				   // Patient appointment view
				  if(($_SESSION['usertypeid'])==5)
				  {
					  include("mycon.php");
					  $uid=$_SESSION['user'];
					  $data=mysql_query("SELECT appointment_master.ap_id,appointment_master.doctor_id,appointment_master.user_id,appointment_master.ap_date,appointment_master.timing_slot_id,appointment_master.sub_timing_slot_id,appointment_master.description,appointment_master.date,appointment_master.status,doctor_master.doctor_id,doctor_master.dr_name,patient_master.patient_name,slot_master.timing FROM appointment_master INNER JOIN doctor_master ON appointment_master.doctor_id = doctor_master.doctor_id INNER JOIN patient_master ON appointment_master.user_id=patient_master.user_id INNER JOIN slot_master ON appointment_master.timing_slot_id = slot_master.timing_slot_id WHERE patient_master.user_id=$uid");
					  if(mysql_num_rows($data)>0)
					{ 
					
				?>

			<table class="table">
				<tr>
					<th style="width:10%">AppointmentNo</th>
					<th style="width:20%">Doctor</th>
					<th style="width:20%">Time</th>
					<th style="width:15%">AppointmentDate</th>
					<th style="width:25%">Description</th>
					<th style="width:10%">Date</th>
				</tr>
				<?php
					while($result = mysql_fetch_array($data))
					{
						$appoimentno=$result['ap_id'];
						$docname=$result['dr_name'];
						$time=$result['timing'];
						$appoimentdate=$result['ap_date'];
						$discription=$result['description'];
						$date=$result['date']; 
				?>
            	<tr>
					<td style="width:10%"><?php echo $appoimentno; ?></td>
					<td style="width:20%"><?php echo $docname; ?></td>
					<td style="width:20%"><?php echo $time; ?></td>
					<td style="width:15%"><?php echo $appoimentdate; ?></td>
					<td style="width:25%"><?php echo $discription; ?></td>
					<td style="width:10%"><?php echo $date; ?></td>
				</tr>
				<?php 
					}
				?>
            </table>
			<?php
					}
            	  }
				  
				}
				?>
			
		</div>
	</div>
</div>