<form action="Logout.php" method="post">
<?php
	session_start();
	session_destroy();
	header("Location:index.php?page=login.php");

?>

</form>