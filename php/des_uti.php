<?php
session_start(); require 'dbh.inc.php';
   $s = $_SESSION['id_compte'];
    $sql = "UPDATE compte SET desactiver=1 WHERE id_compte = $s";
    $result = mysqli_query($conn,$sql); 
    header("location: logout.php");
	exit();

?>


