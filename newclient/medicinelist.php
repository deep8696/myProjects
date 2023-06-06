<?php 
if(isset($_REQUEST['delete']))
{
	$id = $_REQUEST['delete'];
	
	include("mycon.php");
	
	mysql_query("DELETE FROM `medicine_master` Where medicine_id=$id");
	echo "<script> alert('Your Medicine is Succesfully Deleted.');window.location.href='index.php?page=mmaster.php&cprofile=medicinelist.php'</script>";
}

?>

<div class="cprofile">
	<div class="row">
    <div class="col-lg-12">
		<a href="index.php?page=mmaster.php&cprofile=medicineform.php" class="btn btn-blue pull-right">Add Medicine</a>
	</div>
    </div><br>
	<div class="row">
    <div class="col-lg-12" style="overflow:scroll">
		
			<?php

			if(isset($_SESSION['user']))
			{
				include("mycon.php");
				$uid=$_SESSION['user'];
				$data=mysql_query("SELECT healthinhand_db.medicine_master.*,healthinhand_db.medicinetype_master.medicine_type,healthinhand_db.medicine_generic_master.generic_name FROM healthinhand_db.medicine_master left outer join healthinhand_db.medicinetype_master on healthinhand_db.medicine_master.id_medicinetype=healthinhand_db.medicinetype_master.id_medicinetype left outer join healthinhand_db.medicine_generic_master on healthinhand_db.medicine_master.generic_id=healthinhand_db.medicine_generic_master.generic_id where medicine_master.user_id=$uid");
				if(mysql_num_rows($data)>0)
					{ ?>
				<table class="table">
					<tr>
						<th style="width:10%;">Type</th>
						<th style="width:15%;">Generic Name</th>
						<th style="width:15%;">Title</th>
						<th style="width:15%;">Contains</th>
						<th style="width:10%;">Color</th>
						<th style="width:10%;">Manufacture</th>
                        <th style="width:5%;">Price</th>
						<th style="width:10%;">Edit</th>
						<th style="width:10%;">Delete</th>
					</tr><?php

					while($result = mysql_fetch_array($data))
					{
						include("mycon.php");

						$medicine_id=$result['medicine_id'];
						$medicine_type=$result['medicine_type'];
						$generic_name=$result['generic_name'];
						$title=$result['title'];
						$contains=$result['contains'];
						$color=$result['color'];
						$mfg=$result['mfg'];
						$price=$result['price'];
						 ?>
						<tr>
							<td style="width:10%;"><?php echo $medicine_type; ?></td>
							<td style="width:15%;"><?php echo $generic_name; ?></td>
							<td style="width:20%;"><?php echo $title; ?></td>
							<td style="width:15%;"><?php echo $contains; ?></td>
							<td style="width:10%;"><?php echo $color; ?></td>
							<td style="width:10%;"><?php echo $mfg; ?></td>
							<td style="width:5%;"><?php echo $price; ?></th>
                            <td style="width:10%;">
							<a href="index.php?page=lmaster.php&cprofile=medicineform.php&edit=<?php echo $medicine_id; ?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
							</td>

							<td style="width:10%;">
								<a onclick="return confirm('Are You Sure Want to Delete Medicine?');" href="index.php?page=mmaster.php&cprofile=medicinelist.php&delete=<?php echo $medicine_id; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
</div>