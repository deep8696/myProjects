<div class="cprofile">
	<div class="row">
		<div class="col-lg-12">
        
			<?php
			
			//echo $_SESSION['user'];
			
			if(isset($_SESSION['user']))
			{
				// lab inquiry view
				
				if(($_SESSION['usertypeid'])==4){
				include("mycon.php");
				$uid=$_SESSION['user'];
				$data=mysql_query("SELECT * FROM `inquiry_master` WHERE receiver_id=$uid");
				if(mysql_num_rows($data)>0)
				{ 
			?>
			
            	<table class="table">
					<tr>
						<th style="width:24%">Name</th>
						<th style="width:25%">E-mail</th>
						<th style="width:21%">Contact</th>
						<th style="width:15%">Subject</th>
						<th style="width:15%">Message</th>
						<th style="width:15%">Date</th>
					</tr>
                    <?php
					while($result = mysql_fetch_array($data))
						{
							$name=$result['name'];
							$email=$result['email'];
							$contact=$result['contact_no'];
							$subject=$result['subject'];
							$msg=$result['msg'];
							$date=$result['date']; 
					?>
                    <tr>
                    	<td style="width:24%"><?php echo $name ?></td>
						<td style="width:25%"><?php echo $email ?></td>
						<td style="width:25%"><?php echo $contact ?></td>
						<td style="width:25%"><?php echo $subject ?></td>
						<td style="width:25%"><?php echo $msg ?></td>
						<td style="width:25%"><?php echo $date ?></td>
    				</tr>
                    <?php
						}
					?>
                 </table>
                 <?php
                 	}
				  }
				
				// patient inquiry view
				  
				if(($_SESSION['usertypeid'])==5){
				include("mycon.php");
				$uid=$_SESSION['user'];
				$data=mysql_query("SELECT inquiry_master.*,lab_master.lab_name FROM inquiry_master LEFT OUTER JOIN lab_master on inquiry_master.receiver_id=lab_master.user_id where sender_id=$uid");
				if(mysql_num_rows($data)>0)
				{ 
			?>
			
            	<table class="table">
					<tr>
						<th style="width:24%">Lab Name</th>
						<th style="width:15%">Subject</th>
						<th style="width:15%">Message</th>
						<th style="width:15%">Date</th>
					</tr>
                    <?php
					while($result = mysql_fetch_array($data))
						{
							$name=$result['lab_name'];
							$subject=$result['subject'];
							$msg=$result['msg'];
							$date=$result['date']; 
					?>
                    <tr>
                    	<td style="width:24%"><?php echo $name ?></td>
						<td style="width:25%"><?php echo $subject ?></td>
						<td style="width:25%"><?php echo $msg ?></td>
						<td style="width:25%"><?php echo $date ?></td>
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