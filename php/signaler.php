<?php
date_default_timezone_set('Africa/Algiers');
session_start(); require 'dbh.inc.php';
if(isset($_POST['sign']))
{   $p= $_SESSION['si'];
    $v =0;
    $c ='signal';
    $r=$_SESSION['id_compte'];
    $causeS=$_POST['ca'];

    $dt = new DateTime();
    $dt = $dt->format('Y-m-d H:i:s');
    $sql =" INSERT INTO notifications_admin (date_temps,code,id_compte_e,id_compte_s,cause_signale,vu) VALUES (?,?,?,?,?,?)";

   $stmt =mysqli_stmt_init($conn);
   mysqli_stmt_prepare($stmt,$sql);
   mysqli_stmt_bind_param($stmt,"ssddsd",$dt,$c,$r,$p,$causeS,$v);
   mysqli_stmt_execute($stmt);
   header("location: ../index.php");
}
?>

