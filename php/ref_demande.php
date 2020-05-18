<?php
date_default_timezone_set('Africa/Algiers');
session_start(); require 'dbh.inc.php';
if(isset($_POST['ref']))
{$r = $_SESSION['rr'];
$cau=$_POST['caus'];
$v =0;
$c =7;
$dt = new DateTime();
$dt = $dt->format('Y-m-d H:i:s');
$sql ="INSERT INTO notification (date_temps,id_compte_r,code_notif,vu) VALUES(?,?,?,?)";
$stmt =mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,"sddd",$dt,$r,$c,$v);
mysqli_stmt_execute($stmt);
$ppp = "select * from notification where date_temps = '".$dt."' and id_compte_r='".$r."' ";
$res = mysqli_query($conn,$ppp); 
$rr=$res->fetch_assoc();
$pr=$rr['id_notif'];
echo $pr;
$sql = "INSERT INTO cause_ref (id_notif,cause) VALUES (?,?)";
$stmt =mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,"ds",$pr,$cau);
mysqli_stmt_execute($stmt);
$sql = "DELETE FROM premium where id_compte = '".$r."' limit 1";
$query = mysqli_query($conn,$sql);
echo '<SCRIPT>javascript:window.close()</SCRIPT>';
}
?>
