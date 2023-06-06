<form action="admin.php?page=pages/specialityList.php" method="post">
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">Speciality</h1>
            <a href="admin.php?page=pages/specialityForm.php" class="addbtn pull-right" >+ ADD</a>
        </div>
        
	 <div class="panel panel-admin">
    <div class="panel-header">Speciality List </div>
    <div class="panel-body">
      <table class="table">
        <tr>
          <th style="width:100px">Edit</th>
          <th>Speciality</th>
        </tr>
        <?php 
				mysql_connect("localhost","root","");
				mysql_select_db("healthinhand_db");
			
			$data = mysql_query("Select * from speciality");
			while($result = mysql_fetch_array($data))
			{
			
			
		
		?>
        <tr>
          <td style="width:100px">
          	<a href="admin.php?page=pages/specialityForm.php&edit=<?php echo $result["sp_id"]; ?>">Edit</a>
            
          </td>
          <td><?php echo $result["specialist"]; ?></td>
        </tr>
        <?php 
		}
		?>
      </table>
    </div>
  </div>
	</div>
   </form>