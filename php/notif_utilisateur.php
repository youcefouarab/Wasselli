<?php
session_start();
    require 'dbh.inc.php';
    $e = 0 ;
    $i = $_SESSION['id_compte'];
    $sql = "SELECT * FROM notification WHERE close = '$e' and vu = '$e' and id_compte_r='$i'";
    $result = mysqli_query($conn,$sql);
    $count= mysqli_num_rows($result);
    if($count!=0) echo "<div class='label label-danger'>$count</div>";
?>

