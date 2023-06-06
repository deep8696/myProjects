<?php
if(isset($_REQUEST['delete']))
{
	$id = $_REQUEST['delete'];
	$utypeid=$_SESSION['usertypeid'];
	include("mycon.php");

	$result=mysql_query("SELECT proof_path FROM `proof_master` WHERE proof_id=".$_GET['delete']);
	$row=mysql_fetch_array($result);
	
	$data=mysql_query("DELETE FROM `proof_master` WHERE proof_id=".$_GET['delete']);
	unlink($row['proof_path']);
	
	if ($utypeid=='1') 
	{
		echo "<script> alert('Your Proof is Succesfully Deleted.');window.location.href='index.php?page=dmaster.php&cprofile=proof.php'</script>";
	}
	else if ($utypeid=='2') 
	{
		echo "<script> alert('Your Proof is Succesfully Deleted.');window.location.href='index.php?page=hmaster.php&cprofile=proof.php'</script>";
	}
	else if ($utypeid=='3') 
	{
		echo "<script> alert('Your Proof is Succesfully Deleted.');window.location.href='index.php?page=mmaster.php&cprofile=proof.php'</script>";
	}
	else if($utypeid=='4') 
	{
		echo "<script> alert('Your Proof is Succesfully Deleted.');window.location.href='index.php?page=lmaster.php&cprofile=proof.php'</script>";
	}
	else
	{
		echo "<script>alert('Your User Type Not Found !!!!...');</script>";
	}
	
	
}

if(isset($_POST['save']))
{
	$ppath="";
	if($_FILES['ppath']['error'] > 0)
	{
		echo "Please Select Any File.";
	}
	else
	{	
		$ptitle=$_POST['ptitle'];
		$utypeid=$_SESSION['usertypeid'];
		$uid=$_SESSION['user'];
		include("mycon.php");

		if ($utypeid=='1') 
		{
			$path1 = "images/Proof/Doctor/".$_FILES['ppath']['name'];
			move_uploaded_file($_FILES['ppath']['tmp_name'], $path1);

			$datas=mysql_query("INSERT INTO `proof_master` VALUES(NULL,$uid,'$ptitle','$path1',NOW(),0)");
			if($datas==1)
			{
				echo "<script>alert('Your Proof Upload Successfully !!!!...');</script>";
			}
			else
			{
				echo "<script>alert('Your Proof Not Upload Successfully !!!!...');</script>";
			}
		}
		elseif ($utypeid=='2') 
		{
			$path1 = "images/Proof/Hospital/".$_FILES['ppath']['name'];
			move_uploaded_file($_FILES['ppath']['tmp_name'], $path1);

			$datas=mysql_query("INSERT INTO `proof_master` VALUES(NULL,$uid,'$ptitle','$path1',NOW(),0)");
			if($datas==1)
			{
				echo "<script>alert('Your Proof Upload Successfully !!!!...');</script>";
			}
			else
			{
				echo "<script>alert('Your Proof Not Upload Successfully !!!!...');</script>";
			}
		}
		
		elseif ($utypeid=='3') 
		{
			$path1 = "images/Proof/Medical/".$_FILES['ppath']['name'];
			move_uploaded_file($_FILES['ppath']['tmp_name'], $path1);

			$datas=mysql_query("INSERT INTO `proof_master` VALUES(NULL,$uid,'$ptitle','$path1',NOW(),0)");
			if($datas==1)
			{
				echo "<script>alert('Your Proof Upload Successfully !!!!...');</script>";
			}
			else
			{
				echo "<script>alert('Your Proof Not Upload Successfully !!!!...');</script>";
			}
		}
		elseif ($utypeid=='4') 
		{
			$path1 = "images/Proof/Laboratory/".$_FILES['ppath']['name'];
			move_uploaded_file($_FILES['ppath']['tmp_name'], $path1);

			$datas=mysql_query("INSERT INTO `proof_master` VALUES(NULL,$uid,'$ptitle','$path1',NOW(),0)");
			if($datas==1)
			{
				echo "<script>alert('Your Proof Upload Successfully !!!!...');</script>";
			}
			else
			{
				echo "<script>alert('Your Proof Not Upload Successfully !!!!...');</script>";
			}
		}
		elseif ($utypeid=='5') 
		{
			
		}
		else
		{
			echo "<script>alert('Your User Type Not Fount !!!!...');</script>";
		}
		/* for general save in single folder
		$path1 = "images/Proof/".$_FILES['ppath']['name'];
		move_uploaded_file($_FILES['ppath']['tmp_name'], $path1);


		$uid=$_SESSION['user'];
		include("mycon.php");

		$datas=mysql_query("INSERT INTO `proof_master` VALUES(NULL,$uid,'$ptitle','$path1',NOW(),0)");
		if($datas==1)
		{
			echo "<script>alert('Your Proof Upload Successfully !!!!...');</script>";
		}
		else
		{
			echo "<script>alert('Your Proof Not Upload Successfully !!!!...');</script>";
		}*/
	}
}
?>

<div class="cprofile">

	<div class="row">
		<div class="col-lg-12">
			<table cellspacing="10">
				<tr>
					<td>Proof Title</td>
				</tr>
				<tr>
					<td><input type="text" name="ptitle" id="ptitle" required="required" class="cform"/></td>
				</tr>
				<tr>
					<td><input type="file" name="ppath" id="ppath"/></td>
				</tr>
				<tr>
					<td><input type="submit" name="save" id="save" value="SAVE" class="btn btn-blue"></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php
			if(isset($_SESSION['user']))
			{
				include("mycon.php");
				$uid=$_SESSION['user'];
				$data=mysql_query("SELECT * FROM `proof_master` WHERE user_id=$uid");
				if(mysql_num_rows($data)>0)
					{ ?>
				<table class="table">
					<tr>
						<th style="width:24%">Proof Title</th>
						<th style="width:25%">Proof Path</th>
						<th style="width:21%">Status</th>
						<th style="width:15%">View</th>
						<th style="width:15%">Delete</th>
					</tr>
					<?php
					while($result = mysql_fetch_array($data))
					{
						$imgtitle=$result['proof_title'];
						$imgpath=$result['proof_path']; ?>
						<tr>
							<td style="width:24%"><?php echo $imgtitle ?></td>
							<td style="width:25%"><?php echo $imgpath ?></td>
							<td style="width: 21%">
								<label>
									<?php 
									if($result["proof_status"]==0)
										{?><i class="fa fa-times"></i><?php
									echo "Not Approved";
								}
								else
									{?><i class="fa fa-check"></i><?php
								echo "Approved";
							}
							?>
						</label>
					</td>
					<td style="width:15%">
						<a target="_blank" href="<?php echo $result["proof_path"]; ?>"><i class="fa fa-eye"></i>&nbsp;View
						</a>
					</td>

					<td style="width:15%">
						<a onclick="return confirm('Are you sure you want to delete proof.....???');" href="
                        <?php
						$proofid = $result["proof_id"];
						if ($utypeid=='1')
						{					
							echo "index.php?page=dmaster.php&cprofile=proof.php&delete=$proofid";
						}
						else if ($utypeid=='2')
						{					
							echo "index.php?page=hmaster.php&cprofile=proof.php&delete=$proofid";
						}
						else if ($utypeid=='3')
						{					
							echo "index.php?page=mmaster.php&cprofile=proof.php&delete=$proofid";
						}
						else if ($utypeid=='4')
						{					
							echo "index.php?page=lmaster.php&cprofile=proof.php&delete=$proofid";
						}
						else{
							echo "<script>alert('Your User Type Not Fount !!!!...');</script>";
						}
						 ?>" class="<?php if($result["status"]==1)
							{ echo "not-active";} ?>"><i class="fa fa-trash"></i>&nbsp;Delete
						</a>
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