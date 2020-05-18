<?php
	session_start();
	require "dbh.inc.php";

	$id=$_GET['id'];
	if ($_GET['type'] === '1') {
		$ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM colis WHERE id_colis=".$id));
		if (($ligne['id_compte_e']===$_SESSION['id_compte'])||((($_GET['from']=="ann_c")||($_GET['from']=="ann_t"))&&($_SESSION['nom_admin']))) mysqli_query($conn,"UPDATE colis SET supp=1 WHERE id_colis=".$id);
		if ($_GET['from']=="ann_c") header("location: ../affichage_colis.php?from=admin");
		if ($_GET['from']=="profiluser") header("location: ../profile.php");
		if ($_GET['from']=="profiladmin") header("location: ../profile.php?id=".$ligne['id_compte_e']."&from=admin");
	} 
	if ($_GET['type'] === '2') {
		$ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$id));
		if (($ligne['id_compte']===$_SESSION['id_compte'])||((($_GET['from']=="ann_c")||($_GET['from']=="ann_t"))&&($_SESSION['nom_admin']))) mysqli_query($conn,"UPDATE trajet SET supp=1 WHERE id_trajet=".$id);
		if ($_GET['from']=="ann_t") header("location: ../affichage_trajet.php?from=admin");
		if ($_GET['from']=="profiluser") header("location: ../profile.php");
		if ($_GET['from']=="profiladmin") header("location: ../profile.php?id=".$ligne['id_compte_e']."&from=admin");
	}
	
	exit();
?>