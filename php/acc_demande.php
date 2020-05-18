<?php
date_default_timezone_set('Africa/Algiers');
session_start(); require 'dbh.inc.php';
if(isset($_POST['acc']))
{   $a = $_SESSION['aa'];
    $sql = "UPDATE compte SET prem_accepte=1 WHERE id_compte=$a";
    $result = mysqli_query($conn,$sql);
    $v =0;
    $c =6;
    $dt = new DateTime();
    $dt = $dt->format('Y-m-d H:i:s');
    $sqll ="INSERT INTO notification (date_temps,id_compte_r,code_notif,vu) VALUES('$dt','$a','$c','$v')";
    $query = mysqli_query($conn,$sqll);
    echo '<SCRIPT>javascript:window.close()</SCRIPT>';
}
?>