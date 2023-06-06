<?php 
$labtestid=$price="";	
if((isset($_REQUEST['edit'])))
{
	$edit = $_REQUEST['edit'];
	
	include("mycon.php");
	$dup = mysql_query("SELECT * FROM `labtestprice_master` where labtestprice_id=$edit");
	$num_rows=mysql_num_rows($dup);
	if($num_rows>0){
		while($result = mysql_fetch_array($dup))
		{
			$labtestid = $result['labtest_id'];
			$price=$result['price'];
		}
	}
}

if(isset($_POST['submit']))
{
	$labtestid = $_POST['labtestname'];
	$price=$_POST['price'];
	
	include("mycon.php");
	
	$dup = mysql_query("SELECT * FROM `labtestprice_master` WHERE labtest_id=$labtestid");
	$num_rows=mysql_num_rows($dup);
	if($num_rows>0){
		echo "<script>alert('Already on database !!!!!..')</script>";
	}
	
	else{

		if((isset($_REQUEST['edit'])))
		{	
			$edit = $_REQUEST['edit'];
			mysql_query("UPDATE labtestprice_master SET price=$price Where labtestprice_id=$edit");
			echo "<script> alert('Your City is Succesfully Updated.');</script>";

		}
		else
		{
			$labtestid=$_POST['labtestname'];
			$uid=$_SESSION['user'];
			mysql_query("INSERT INTO `labtestprice_master` VALUES('null',$labtestid,$uid,$price,'0')");
			echo "<script>alert('Your Data is Succssfully Store.')</script>";
		}
	}
}	

?>

<div class="cprofile">
	<div class="row">
		<a href="index.php?page=lmaster.php&cprofile=ltestpricelist.php" class="btn btn-blue pull-right">Back</a>
	</div>
	<div class="row">
		<div class="col-lg-8">

			<table cellspacing="10">

				<tr>
					<td>Laboratory Test Name</td>
					<td>


						<select required <?php if(isset($_REQUEST['edit'])){echo "disabled";} ?>  name="labtestname" id="labtestname" class="cform" >
							<option value="">---Select Lab Test Name----</option>
							<?php			

							include("mycon.php");

							$datas=mysql_query("select * from labtest_master");

							while($results=mysql_fetch_array($datas)){
								?>

								<option  <?php if($labtestid == $results["labtest_id"]){echo "selected";} ?>   value="<?php echo $results["labtest_id"]; ?>"><?php echo $results["labtest_name"];?></option>

								<?php 								
							}
							?>
						</select>
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