
<?php 
$medicinetype=$medicinegeneric=$title=$color=$contains=$mfg=$price="";	
if((isset($_REQUEST['edit'])))
{
	$edit = $_REQUEST['edit'];
	
	include("mycon.php");
	$dup = mysql_query("SELECT * FROM `medicine_master` where medicine_id=$edit");
	$num_rows=mysql_num_rows($dup);
	if($num_rows>0){
		while($result = mysql_fetch_array($dup))
		{
			
			$medicinetype = $result['id_medicinetype'];
			$medicinegeneric= $result['generic_id'];
			$title= $result['title'];
			$color= $result['color'];
			$contains= $result['contains'];
			$mfg=$result['mfg'];
			$price=$result['price'];
		}
	}
}

if(isset($_POST['submit']))
{
	$medicinetype = $_POST['medicinetype'];
	$medicinegeneric = $_POST['medicinegeneric'];
	$title=$_POST['title'];
	$color=$_POST['color'];
	$contains=$_POST['contains'];
	$mfg=$_POST['mfg'];
	$price=$_POST['price'];
	
	include("mycon.php");
	
	$dup = mysql_query("SELECT * FROM `medicine_master` WHERE title=$title");
	//$num_rows=mysql_num_rows($dup);
	if($dup>0){
		echo "<script>alert('Already on database !!!!!..')</script>";
	}
	
	else{

		if((isset($_REQUEST['edit'])))
		{	
			$edit = $_REQUEST['edit'];
			mysql_query("UPDATE medicine_master SET `id_medicinetype`=$medicinetype,`generic_id`=$medicinegeneric,`title`='$title',`contains`='$contains',`color`='$color',`mfg`='$mfg',`price`='$price' Where medicine_id=$edit");
			echo "<script> alert('Your Medicine is Succesfully Updated.');</script>";

		}
		else
		{
			$uid=$_SESSION['user'];
			mysql_query("INSERT INTO `medicine_master` VALUES('null','null',$uid,$medicinetype,$medicinegeneric,'$title','$contains','$color','$mfg','$price')");
			echo "<script>alert('Your Data is Succssfully Store.')</script>";
		}
	}
}	

?>

<div class="cprofile">
	<div class="row">
		<a href="index.php?page=mmaster.php&cprofile=medicinelist.php" class="btn btn-blue pull-right">Back</a>
	</div>
	<div class="row">
		<div class="col-lg-8">

			<table cellspacing="10">

				<tr>
					<td>Medicine Type</td>
					<td>
						<select required <?php if(isset($_REQUEST['edit'])){echo "disabled";} ?>  name="medicinetype" id="medicinetype" class="cform" >
							<option value="">---Select Medicine Type----</option>
							<?php			

							include("mycon.php");

							$datas=mysql_query("select * from medicinetype_master");

							while($results=mysql_fetch_array($datas)){
								?>

								<option  <?php if($medicinetype == $results["id_medicinetype"]){echo "selected";} ?>   value="<?php echo $results["id_medicinetype"]; ?>"><?php echo $results["medicine_type"];?></option>

								<?php 								
							}
							?>
						</select>
					</td>

				</tr>
				<tr>
					<td>Medicine Ganeric</td>
					<td>
						<select required <?php if(isset($_REQUEST['edit'])){echo "disabled";} ?>  name="medicinegeneric" id="medicinegeneric" class="cform" >
							<option value="">---Select Medicine Ganeric----</option>
							<?php			

							include("mycon.php");

							$datas=mysql_query("select * from medicine_generic_master");

							while($results=mysql_fetch_array($datas)){
								?>

								<option  <?php if($medicinegeneric == $results["generic_id"]){echo "selected";} ?>   value="<?php echo $results["generic_id"]; ?>"><?php echo $results["generic_name"];?></option>

								<?php 								
							}
							?>
						</select>
					</td>

				</tr>

				<tr>
					<td>Title</td>
					<td>
						<input type="text" name="title" id="title" class="cform"  value="<?php echo $title ?>"/>
					</td>
				</tr>

				
				<tr>
					<td>Color</td>
					<td>
						<input type="text" name="color" id="color" class="cform"  value="<?php echo $color ?>"/>
					</td>
				</tr>

				<tr>
					<td>Contains</td>
					<td>
						<input type="text" name="contains" id="contains" class="cform"  value="<?php echo $contains ?>"/>
					</td>
				</tr>

				<tr>
					<td>Manufacture</td>
					<td>
						<input type="text" name="mfg" id="mfg" class="cform"  value="<?php echo $mfg ?>"/>
					</td>
				</tr>
                
                <tr>
					<td>Price</td>
					<td>
						<input type="text" name="price" id="price" class="cform"  value="<?php echo $price ?>"/>
					</td>
				</tr>

				<tr></tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" id="submit" class="btn btn-blue" value="Submit">
						<input type="reset" name="Cancel" id="Cancel" class="btn btn-blue" value="Cancel">
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>