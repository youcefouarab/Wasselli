<?php
	session_start();
	require "dbh.inc.php";

	mysqli_query($conn,"DELETE FROM compte_administrateur WHERE id_admin=".$_SESSION['id_admin']);

	header("location: logout_admin.php");
	exit();
?>