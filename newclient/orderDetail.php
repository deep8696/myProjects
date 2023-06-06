<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/ResponsiveGrid.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="font-size: 16px;">
	<div style="text-align: center;font-size: 24px;">Order Detail</div>
	
	<hr>
	<br>
	<div style="background-color: #fff;">
		<?php  
		include("mycon.php");
		$orderid=$_REQUEST['orderid'];
		$data=mysql_query("SELECT order_master.*,medical_master.medical_name,medical_master.address,medical_master.city_id,medical_master.state_id,medical_master.pin,medical_master.contact,medical_master.logo FROM `order_master` left outer join medical_master on order_master.medical_id=medical_master.medical_id WHERE order_id=$orderid");
		while ($result=mysql_fetch_array($data)) {
			?>
			<div class="row">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-1">
							<img width="100px;" src="<?php echo $result['logo']; ?>">
						</div>
						<div class="col-lg-11">
							<p style="font-size: 22px; padding-top: 10px;"><?php echo $result['medical_name']; ?></p>
							<p><?php echo $result['address']; ?></p>
							<p><?php echo $result['city_id']; ?> <?php echo $result['state_id']; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $result['pin']; ?></p>
							
						</div>
					</div>
				</div>
				<div class="col-lg-6 pull-right">
					<div style="padding-top: 25px;">
						<b><label>Order No . <?php echo $_REQUEST['orderid']; ?></label></b><br>
						<label>Order Date & Time . <?php echo $result['order_date']; ?></label>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<br>
	<hr>
	<br>

	<div class="row">
	<div class="col-lg-1">
		<p>Order To.:</p>
	</div>
		<div class="col-lg-11">
		<?php 
		include("mycon.php");
		$orderid=$_REQUEST['orderid'];
		$data4=mysql_query("SELECT * FROM `order_master` WHERE order_id=$orderid");
		while ($resu=mysql_fetch_array($data4)) {
			?>
				<b><p style="margin-bottom: 6px;"><?php echo $resu['name']; ?></p></b>
				<p style="margin-bottom: 6px;"><?php echo $resu['address']; ?></p>
				<p><?php echo $resu['contact']; ?></p>
			<?php
		}
		?>
		</div>
	</div>
	<br>
	<hr>
	<br>

	<table class="table">
		<tr>
			<th style="width: 10%;text-align: center;"">No.</th>
			<th style="width: 60%;text-align: center;"">Particulrs</th>
			<th style="width: 10%;text-align: center;"">Price</th>
			<th style="width: 10%;text-align: center;"">Quantity</th>
			<th style="width: 10%;text-align: center;"">Amount</th>

		</tr>

		<?php
		include("mycon.php");
		$orderid=$_REQUEST['orderid'];
		$data1=mysql_query("SELECT order_detail_master.*,medicine_master.title FROM `order_detail_master` left outer join medicine_master on order_detail_master.medicine_id=medicine_master.medicine_id WHERE order_id=$orderid");
		$count=1;
		while ($resul=mysql_fetch_array($data1)) {
			?>
			<tr>
				<td style="width: 10%;text-align: center;"><?php echo $count;?></td>
				<td style="width: 60%;"><?php echo $resul['title']; ?></td>
				<td style="width: 10%;text-align: center;"><?php echo $resul['price']; ?></td>
				<td style="width: 10%;text-align: center;""><?php echo $resul['quantity']; ?></td>
				<td style="width: 10%;text-align: center;""><?php echo $resul['amount']; ?></td>

			</tr>

			<?php
		}
		?>
	</table>
	
	<div class="pull-right">
		<?php 
		include("mycon.php");
		$orderid=$_REQUEST['orderid'];
		$data3=mysql_query("SELECT * FROM `order_master` WHERE order_id=$orderid");
		while ($res=mysql_fetch_array($data3)) {
			?>
			<p style="padding-top: 10px;padding-bottom: 8px;">Shipping Charge .: <?php echo $res['shiping_charge'];?>&nbsp;<i class="fa fa-rupee"></i></p>
			<p class="pull-right">Total Amount .: <?php echo $res['total_amount'];?>&nbsp;<i class="fa fa-rupee"></i></p>
			<?php
		}
		?>
	</div>

	<script type="text/javascript">
		window.print();
		window.onfocus=function(){ window.close();}
	</script>
	
</body>
</html>