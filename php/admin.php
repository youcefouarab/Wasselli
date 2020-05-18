<?php
    session_start();
    $_SESSION['der_page']=$_POST['der'];
    header("location: ../admin/administration.php");
    exit();
?> 		