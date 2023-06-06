<?php 
if(isset($_POST['btn1']))
{
	$totalA = $_POST['hidTotal'];
	$shipAm = "50";
	$totalAmount = $totalA + 50;
	$uid=$_SESSION['user'];
	$oid = 0;
	$medid=0;
	$data4 = mysql_query("Select DISTINCT(medical_id) from cart_master Where user_id=$uid");
	while($result3 = mysql_fetch_array($data4))
	{
		$medid = $result3["medical_id"];
	}
	
	
	$data = mysql_query("Insert into order_master values(NULL,$uid,$medid,$totalA,$shipAm,$totalAmount,NOW(),'','',0,'Order')");
	$data2 = mysql_query("Select MAX(order_id) as oid from order_master");
	
	while($result = mysql_fetch_array($data2))
	{
		$oid = $result['oid'];
	}
	
	/*echo "<script>console.log('Select * from cart_master as cm Left outer Join medicine_master as mm On cm.medicine_id = mm.medicine_id Where cm.user_id=$uid')</script>";
	*/
	
	$data3 = mysql_query("Select * from cart_master as cm Left outer Join medicine_master as mm On cm.medicine_id = mm.medicine_id Where cm.user_id=$uid");
	while($result = mysql_fetch_array($data3))
	{
		$mid = $result['medicine_id'];
		$price = $result['price'];
		$qty = $result['quantity'];
		$amount = $price * $qty;
		echo "<script>console.log('Insert into order_detail_master values(NULL,$oid,$mid,$price,$qty,$amount)')</script>";
			$data = mysql_query("Insert into order_detail_master values(NULL,$oid,$mid,$price,$qty,$amount)");
	}
	
	// empty cart
	$data = mysql_query("Delete From cart_master Where user_id=$uid");
	
	echo "<script>alert('Successfully Ganarated Order.');window.location.href='index.php?page=ShipingAddress.php&oid=$oid';</script>";
	
	
	
}

?>

<form action="index.php?page=mcart.php" method="post">
<div class="cprofile">
	<div class="row">
		<div class="col-lg-12">
			<table class="table text-center">
				<tr>
					<th style="width:25%">Medical</th>
					<th style="width:25%">Medicine</th>
					<th style="width:25%">Quantity</th>
					<th style="width:25%">Price</th>
					<th style="width:25%">Total</th>
				</tr>
				<?php
					$total=0; 
					$uid=$_SESSION['user'];
					include("mycon.php");
					$data=mysql_query("SELECT healthinhand_db.cart_master.*,healthinhand_db.medical_master.medical_name,healthinhand_db.medicine_master.title,healthinhand_db.medicine_master.price FROM healthinhand_db.cart_master inner join healthinhand_db.medical_master on cart_master.medical_id=medical_master.medical_id inner join healthinhand_db.medicine_master on cart_master.medicine_id=medicine_master.medicine_id WHERE cart_master.user_id=$uid");
					while ($result=mysql_fetch_array($data)) {
						?>
						<tr>
							<td style="width:25%"><?php echo $result['medical_name']; ?></td>
							<td style="width:25%"><?php echo $result['title']; ?></td>
							<td style="width:25%"><?php echo $result['quantity']; ?></td>
							<td style="width:25%"><?php echo $result['price']; ?></td>
                            <td style="width:25%"><?php echo $result['price'] * $result['quantity']; ?></td>
						</tr>
                        
						<?php
						$total += $result['price'] * $result['quantity']; 
					}
				?>
                <tr>
                	<th colspan="3"></th>
                	<th style="text-align:right">Total Payment</th>
                	<th style="text-align:right"><b><?php echo $total; ?> </b>
                    <input type="hidden" name="hidTotal" id="hidTotal" value="<?php echo $total; ?>" />
                    
                    </th>
                </tr>
                 <tr>
                	<th colspan="3"></th>
                	<th style="text-align:right">Shipping Charge</th>
                	<th style="text-align:right"><b>50</b></th>
                </tr>
                 <tr>
                	<th colspan="3"></th>
                	<th style="text-align:right">Total Amount</th>
                	<th style="text-align:right"><b><?php echo $total + 50; ?></b></th>
                </tr>
			</table>
		</div>
        <div class="col-lg-12 text-center">
        	<input type="submit" name="btn1" id="btn1" value="Ganarate Order" />
        </div>
	</div>
</div>
</form>