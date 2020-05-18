<?php
    session_start();
    require 'dbh.inc.php';

   
    $_SESSION['id_admin']="";
    $_SESSION['nom_admin']="";
    $_SESSION['prenom_admin']="";
    $_SESSION['mail_admin']="";
    $_SESSION['der_page']=1;

    header("location: ../admin.php");
    exit();
?> 		