<?php
	require 'dbh.inc.php';

	$note=$_POST['note'];
	$id=$_POST['id'];

	$ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM compte WHERE id_compte=".$id." limit 1"));

	if ($ligne['fiab_env']==0) mysqli_query($conn, "UPDATE compte SET fiab_env=".$note." WHERE id_compte=".$id);

	else mysqli_query($conn, "UPDATE compte SET fiab_env=".(($ligne['fiab_env']+$note)/2)." WHERE id_compte=".$id);

?>