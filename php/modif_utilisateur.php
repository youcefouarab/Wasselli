<?php
    session_start();
    require 'dbh.inc.php';
    $result=mysqli_query($conn,"SELECT * FROM compte WHERE mail='".$_POST['email']."' AND id_compte!=".$_SESSION['id_compte']);

    if (mysqli_num_rows($result)>0) {
        header('location: ../profile.php?msg=email');
        exit();
    } else {

    $hash=password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql="UPDATE compte SET nom = '".$_POST['nom']."', prenom = '".$_POST['prenom']."', mail = '".$_POST['email']."', adresse = '".$_POST['adresse']."', tel = '".$_POST['tel']."', mot_passe = '".$hash."' WHERE id_compte = ".$_SESSION['id_compte'];
    mysqli_query($conn, $sql);
    $_SESSION['nom']=$_POST['nom'];
    $_SESSION['prenom']=$_POST['prenom'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['der_page']=1;
    header("location: ../profile.php");
    exit();		}
?> 		