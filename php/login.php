<?php
    session_start();
    require 'dbh.inc.php';

 	$email = $_POST['email'];
 	$password = $_POST['password'];

    $_SESSION['nom']="";
    $_SESSION['prem']="false";
    $sql = "select * from compte where mail = '".$email."' and supp=0 limit 1";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) == 1) {
    	$ligne = $result->fetch_assoc();
    	$hash = $ligne['mot_passe'];
    	if (password_verify($password,$hash))
    	{
        if ($ligne['desactiver'] == 1)
        {
            $s = $ligne['id_compte'];
             $sql = "UPDATE compte SET desactiver=0 WHERE id_compte = $s";
             $result = mysqli_query($conn,$sql); 
        }
    	$_SESSION['nom']=$ligne['nom'];
 		$_SESSION['prenom']=$ligne['prenom'];
        $_SESSION['email']=$email;
        $_SESSION['id_compte']=$ligne['id_compte'];
        $_SESSION['photo']=$ligne['photo'];
        $id=$ligne['id_compte'];
        $sql = "select * from premium where id_compte = '".$id."' limit 1";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1) {
            $_SESSION['prem']="true";
        }
 		header("location: ../index.php");
 		exit();
    	}
    	else
    	{
    		header("location: ../index.php?message=mdp");
    		exit;
    	}
    }
    else
    	{
    		header("location: ../index.php?message=eml");
    		exit;
    	}
?> 		