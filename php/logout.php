<?php
    session_start();

    $_SESSION['nom']="";
    $_SESSION['prenom']="";
    $_SESSION['email']="";
    $_SESSION['id_compte']="";
    $_SESSION['prem']="";
    $_SESSION['photo']="";
    $_SESSION['der_page_']=1;

    header("location: ../index.php");
    exit();
?> 		