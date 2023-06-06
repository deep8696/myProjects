<?php
$edit="";
	if(isset($_POST['oStatus']))
	{
		$oid = $_POST['oid'];
		$val = $_POST['oStatus'];
		if($val == "OrderGenerated"){
			$status = 1;
		}
		elseif($val == "InProcess"){
			$status = 2;;
		}
		else{
			$status = 3;
		}
		include("mycon.php");
		
			$data = mysql_query("Update order_master set order_status=$status where order_id=".$oid."");
			if($data > 0){
				
			}
			else{
				
			}
	}

?>

<div class="cprofile">
	<div class="row">
    	<div class="col-lg-12">
        <h2 style="margin-bottom:10px;text-align:center;">Your Orders</h2>
        	
			<?php
				// Patient Order View
				 
				$utypeid=$_SESSION['usertypeid'];
				if($utypeid == 5){
			
            ?>
            <table class="table text-center">
            	<tr>
                	<th style="width:10%">Order No</th>
                    <th style="width:20%">Medical Name</th>
                    <th style="width:15%">Total Amount</th>
                    <th style="width:25%">Order Date</th>
                    <th style="width:20%">Status</th>
                    <th style="width:10%">View</th>
                </tr>
                <?php
                	include("mycon.php");
					$uid=$_SESSION['user'];
					$data= mysql_query("select order_master.*,medical_master.medical_name FROM order_master left outer join medical_master on order_master.medical_id=medical_master.medical_id where order_master.user_id=$uid");
					while($result=mysql_fetch_array($data)){
						$ostatus= $result['order_status'];
				?>
                <tr>
                	<td style="width:10%"><?php echo $result['order_id'];?></td>
                    <td style="width:20%"><?php echo $result['medical_name'];?></td>
                    <td style="width:15%"><?php echo $result['total_amount'];?></td>
                    <td style="width:25%"><?php echo $result['order_date'];?></td>
                    <td style="width:20%"><?php if($ostatus==0){ echo "Order Generated";} elseif($ostatus==1){ echo "In process";} else{ echo "Delivered";}?></td>
                    <td style="width:10%"><a target="_blank" href="orderDetail.php?orderid=<?php echo $result['order_id'];?>">View</a></td>
                </tr>
                <?php
					}
				?>
            </table>
            <?php
				}
				
				// Medical Order View
				if($utypeid == 3){
			?>
            <table class="table text-center">
            	<tr>
                	<th style="width:10%">Order No</th>
                    <th style="width:20%">Patient Name</th>
                    <th style="width:15%">Total Amount</th>
                    <th style="width:25%">Order Date</th>
                    <th style="width:10%">View</th>
                    <th style="width:20%">Status</th>
                </tr>
                <?php
                	include("mycon.php");
					$uid=$_SESSION['user'];
					$medical=mysql_query("select * from medical_master where user_id=$uid");
					while($res=mysql_fetch_array($medical)){
						$mid=$res['medical_id'];
					}
					
					$data= mysql_query("select order_master.*,patient_master.patient_name FROM order_master left outer join patient_master on order_master.user_id=patient_master.user_id where order_master.medical_id=$mid");
					while($result=mysql_fetch_array($data)){
						$ostatus= $result['order_status'];
						$oid= $result['order_id'];
				?>
                <tr>
                	<td style="width:10%"><?php echo $result['order_id'];?></td>
                    <td style="width:20%"><?php echo $result['patient_name'];?></td>
                    <td style="width:15%"><?php echo $result['total_amount'];?></td>
                    <td style="width:25%"><?php echo $result['order_date'];?></td>
                    <td style="width:10%"><a target="_blank" href="orderDetail.php?orderid=<?php echo $result['order_id'];?>">View</a></td>
                	<td style="width:20%"><input type="submit" id="oStatus" name="oStatus" class="btn btn-blue" value="<?php if($ostatus==0){ echo "OrderGenerated";} elseif($ostatus==1){ echo "InProcess";} else{ echo "Delivered";}?>" /></td>
                    <input type="hidden" id="oid" name="oid" value="<?php echo $oid;?>"/>
                </tr>
                <?php
					}
				?>
            
            </table>
            <?php
				}
			?>
        </div>
    </div>
</div>