<?php
	session_start();
	require 'dbh.inc.php';

	$id=$_GET['id'];

	if ($ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$id." AND id_compte=".$_SESSION['id_compte']))) {
		if ($reg=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajets_reguliers WHERE id_trajet=".$id))) {
			mysqli_query($conn,"UPDATE trajet SET etat='arrive' WHERE id_trajet=".$id);
		}
	}

	header("location: ../profile.php");
?>