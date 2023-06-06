<form action="admin.php?page=pages/timingslotsList.php" method="post">
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">Timing Slots</h1>
            <a href="admin.php?page=pages/timingslotsForm.php" class="addbtn pull-right" >+ ADD</a>
        </div>
        
	 <div class="panel panel-admin">
    <div class="panel-header">Timing Slots List </div>
    <div class="panel-body">
      <table class="table">
        <tr>
          <th style="width:100px">Edit</th>
          <th>Timing Slots</th>
        </tr>
        <?php 
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
			
			$data = mysql_query("Select * from slot_master");
			while($result = mysql_fetch_array($data))
			{
			
			
		
		?>
        <tr>
          <td style="width:100px">
          	<a href="admin.php?page=pages/timingslotsForm.php">Edit</a>
          </td>
          <td><?php echo $result["timing"]; ?></td>
        </tr>
        <?php 
		}
		?>
      </table>
    </div>
  </div>
	</div>
   </form>