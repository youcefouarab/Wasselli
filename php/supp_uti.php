<?php
session_start(); require 'dbh.inc.php';
   $s = $_SESSION['ss'];
    $sql = "UPDATE compte SET supp=1 WHERE id_compte = $s";
    $result = mysqli_query($conn,$sql);
    $sql = "UPDATE colis SET supp=1 WHERE id_compte_e = $s";
    $result = mysqli_query($conn,$sql); 
    $sql = "UPDATE trajet SET supp=1 WHERE id_compte = $s";
    $result = mysqli_query($conn,$sql); 
    echo '<SCRIPT>javascript:window.close()</SCRIPT>';

?>