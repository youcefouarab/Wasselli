<?php
date_default_timezone_set('Africa/Algiers');
	session_start();
	require "dbh.inc.php";
	$id=$_GET['id'];
	$date=date("Y-m-d H:i:s");
	if ($_GET['vers'] === '2') {
		$etat="arrive";
		$code=9;
	}
	else if ($_GET['vers'] === '3') {
		$etat="echec";
		$code=10;
	}
	else
	{
		header("location: ../page_inaccessible.php?i=1");
	}
	
	if ($ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM colis WHERE id_colis=".$id." limit 1"))) {
		$t=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$ligne['id_trajet']." limit 1"));
		if ($t['id_compte']==$_SESSION['id_compte']){
			mysqli_query($conn,"UPDATE colis SET etat='".$etat."' WHERE id_colis=".$id);
			mysqli_query($conn,"INSERT INTO notification (date_temps,id_compte_r,code_notif,id_colis,id_trajet,vu,acc,close) VALUES ('".$date."',".$ligne['id_compte_e'].",".$code.",".$ligne['id_colis'].",".$ligne['id_trajet'].",0,0,0)");
			mysqli_query($conn,"DELETE FROM deverouille WHERE (id_compte1=".$ligne['id_compte_e']." AND id_compte2=".$t['id_compte'].") OR (id_compte2=".$ligne['id_compte_e']." AND id_compte1=".$t['id_compte'].")");
			if (!mysqli_num_rows(mysqli_query($conn,"SELECT * FROM colis WHERE etat='accepte' AND id_trajet=".$t['id_trajet']))) {
				if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$t['id_trajet']))) {
					mysqli_query($conn,"UPDATE trajet SET etat='arrive' WHERE id_trajet=".$t['id_trajet']);
				}
			}
			header("location: ../profile.php?noter=1&id_noter=".$id);
		} else {
			header("location: ../page_inaccessible.php");	
		}
	} else {
		header("location: ../page_inaccessible.php?i=3");
	}

	
?>