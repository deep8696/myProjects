<?php 
if(isset($_REQUEST['delete']))
{
	$id = $_REQUEST['delete'];
	
	include("mycon.php");
	
	mysql_query("DELETE FROM `labtestprice_master` Where labtestprice_id=$id");
	echo "<script> alert('Your Labtest is Succesfully Deleted.');window.location.href='index.php?page=lmaster.php&cprofile=ltestpricelist.php'</script>";
}

?>

<div class="cprofile">
	<div class="row">
		<a href="index.php?page=lmaster.php&cprofile=ltestpriceform.php" class="btn btn-blue pull-right">Add</a>
	</div><br>
	<div class="row">
		
			<?php

			if(isset($_SESSION['user']))
			{
				include("mycon.php");
				$uid=$_SESSION['user'];
				$data=mysql_query("SELECT * FROM `labtestprice_master` WHERE user_id=$uid");
				if(mysql_num_rows($data)>0)
					{ ?>
				<table class="table">
					<tr>
						<th style="width:">ID</th>
						<th style="width:">Lab Test</th>
						<th style="width:">Price</th>
						<th style="width:">Edit</th>
						<th style="width:">Delete</th>
					</tr><?php

					while($result = mysql_fetch_array($data))
					{
						include("mycon.php");

						$labtestprice_id=$result['labtestprice_id'];
						$labtest_id=$result['labtest_id'];
						$userid=$result['user_id'];
						$price=$result['price'];
						$labname=mysql_query("SELECT * FROM `labtest_master` WHERE labtest_id=$labtest_id");
						$result=mysql_fetch_array($labname);
						$labtestname=$result['labtest_name'];

						 ?>
						<tr>
							<td style="width:"><?php echo $labtestprice_id; ?></td>
							<td style="width:"><?php echo $labtestname; ?></td>
							<td style="width:"><?php echo $price; ?></td>
							<td style="width:">
							<a href="index.php?page=lmaster.php&cprofile=ltestpriceform.php&edit=<?php echo $labtestprice_id; ?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
							</td>

							<td style="width:">
								<a onclick="return confirm('Are You Sure Want to Delete Labtest?');" href="index.php?page=lmaster.php&cprofile=ltestpricelist.php&delete=<?php echo $labtestprice_id; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
							</td>
						</tr>
						<?php 
					}
					?></table><?php
				}
			} 
			?>
			
	</div>
</div>