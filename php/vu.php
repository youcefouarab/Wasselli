<?php
    session_start();
    require 'dbh.inc.php';
    $sql="select * from notifications_admin where id_notif_admin=".$_POST['id'];
    $result=mysqli_query($conn,$sql);
    $ligne = $result->fetch_assoc();
    if ($ligne['vu']==1) {
        $sql='UPDATE notifications_admin SET vu=0 where id_notif_admin='.$_POST['id'];

    }
    if ($ligne['vu']==0) {
        $sql='UPDATE notifications_admin SET vu=1 where id_notif_admin='.$_POST['id'];
        
    }
    $result=mysqli_query($conn,$sql);
    $_SESSION['der_page']=2;

    header("Location: ../admin/administration.php");
    exit();
?> 		