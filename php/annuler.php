<?php
date_default_timezone_set('Africa/Algiers');
	session_start();
	require 'dbh.inc.php';

	$ic=$_GET['id_colis'];
	$it=$_GET['id_trajet'];
	$ligne_t=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$it));
	$ligne_c=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM colis WHERE id_colis=".$ic));
	if (($ligne_t['id_compte']===$_SESSION['id_compte'])||($ligne_c['id_compte_e']===$_SESSION['id_compte'])) {
		mysqli_query($conn,"INSERT INTO trajet (lieux_depart, lieux_arrive) VALUES ('".$ligne_t['lieux_depart']."','".$ligne_t['lieux_arrive']."')");
		mysqli_query($conn,"UPDATE colis SET etat='annonce', id_trajet=LAST_INSERT_ID() WHERE id_colis=".$ic);
		if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM colis WHERE id_trajet=".$it))==0) mysqli_query($conn,"UPDATE trajet SET etat='annonce' WHERE id_trajet=".$it);
		if ($_GET['cas']=='1') {
			$id=$ligne_c['id_compte_e'];
			$code=8;
		} else if ($_GET['cas']=='2') {
			$id=$ligne_t['id_compte'];
			$code=13;
		}
		mysqli_query($conn,"DELETE FROM deverouille WHERE (id_compte1=".$ligne_c['id_compte_e']." AND id_compte2=".$ligne_t['id_compte'].") OR (id_compte2=".$ligne_c['id_compte_e']." AND id_compte1=".$ligne_t['id_compte'].")");
		mysqli_query($conn,"INSERT INTO notification (date_temps,id_compte_r,code_notif,id_colis,id_trajet,vu,acc,close) VALUES ('".date("Y-m-d H:i:s")."',".$id.",".$code.",".$ic.",".$it.",0,0,0)");
	}
	header("location: ../profile.php");
	exit();
?>