<?php
    session_start();
    require 'dbh.inc.php';
 
    
    $result=mysqli_query($conn,"SELECT * FROM compte_administrateur WHERE mail='".$_POST['email']."' AND id_admin!=".$_SESSION['id_admin']);

    if (mysqli_num_rows($result)>0) {
        header('location: ../admin/administration.php?msg=email');
        exit();
    } else {
        $hash=password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql="UPDATE compte_administrateur SET nom = '".$_POST['nom']."', prenom = '".$_POST['prenom']."', mail = '".$_POST['email']."', mot_passe = '".$hash."' WHERE id_admin = ".$_SESSION['id_admin'];

        mysqli_query($conn, $sql);

        $_SESSION['nom_admin']=$_POST['nom'];
        $_SESSION['prenom_admin']=$_POST['prenom'];
        $_SESSION['mail_admin']=$_POST['email'];


        $_SESSION['der_page']=1;

        header("location: ../admin/administration.php");
        exit();
    }
        	
    	
 		
?> 		