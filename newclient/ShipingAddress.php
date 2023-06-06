<?php
$oid=0;
	if(isset($_POST['shipBtn'])){
		$name = $_POST['name'];
		$mobno = $_POST['mobno'];
		$address = $_POST['address'];
		$oid=$_REQUEST['oid'] ;
		
		if(isset($_SESSION["user"]))
		{
			if($_SESSION['usertypeid']==5)
			{
				$data = mysql_query("UPDATE `order_master` SET `name`='$name',`address`='$address',`contact`='$mobno' WHERE `order_id`=$oid");
				if($data>0)
            	{
					$emptyCart = mysql_query("Delete From cart_master Where user_id=$uid");
                	echo "<script>alert(' Order will be delivered in 5-7 working days...');window.location.href='index.php?mcart.php'</script>";
            	}
            	else{
                	echo "<script>alert('Error in order Update!!!!...');window.location.href='index.php?page=home.php'</script>";
            	}
			}
			else{
				echo "<script>alert('Only Patient Can Buy Medicine...');window.location.href='logout.php';</script>";
			}
		}
		else
		{
			echo "<script>alert('Please First Login.');window.location.href='index.php?page=login.php';</script>";
		}
	}
?>

<form action="index.php?page=ShipingAddress.php<?php if(isset($_REQUEST['oid'])){ echo '&oid='.$_REQUEST['oid'] ;}?>" method="post">
<div class="cprofile">
	<div class="row">
    	<div class="col-lg-3"></div>
        
        <div class="col-lg-6">
        	<div class="form-vertical">
                <div class="form-group">
                    <label style="font-size:19px;margin-bottom:8px">Name :</label>
                    <input type="text" name="name" id="name" class="form-control"/>
                </div>
                <div class="form-group">
                    <label style="font-size:19px;margin-bottom:8px">Mobile No :</label>
                    <input type="number" name="mobno" id="mobno" class="form-control"/>
                </div>
                <div class="form-group">
                    <label style="font-size:19px;margin-bottom:8px">Address :</label>
                    <textarea name="address" id="address" required="required" class="form-control" rows="4" style="height: 65px;"></textarea>
                </div>
                
                <input type="submit" name="shipBtn" id="shipBtn" class="btn btn-blue pull-right">
            </div>
        
        </div>
        
        <div class="col-lg-3"></div>
    
    </div>
</div>
</form>