<form action="admin.php?page=pages/medicinetypeList.php" method="post">
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">Medicine Types</h1>
            <a href="admin.php?page=pages/medicinetypeForm.php" class="addbtn pull-right" >+ ADD</a>
        </div>
        
	 <div class="panel panel-admin">
    <div class="panel-header">Medicine Types List </div>
    <div class="panel-body">
      <table class="table">
        <tr>
          <th style="width:100px">Edit</th>
          <th>Medicine types</th>
        </tr>
        <?php 
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
			
			$data = mysql_query("Select * from medicinetype_master");
			while($result = mysql_fetch_array($data))
			{
			
			
		
		?>
        <tr>
          <td style="width:100px">
          	<a href="admin.php?page=pages/medicinetypeForm.php">Edit</a>
          </td>
          <td><?php echo $result["medicine_type"]; ?></td>
        </tr>
        <?php 
		}
		?>
      </table>
    </div>
  </div>
	</div>
   </form>