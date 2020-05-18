<?php 
session_start();
 
$connect = mysqli_connect("localhost", "root", "", "projet2cp");
date_default_timezone_set('Africa/Algiers');

$date_demande = date('Y-m-d H:i:s'); 
$id_compte_e = $_POST['id_compte'];
$id_trajet = $_POST['id_trajet'] ;
$id_colis = $_POST['id_colis'] ;
$code_notif = $_POST['code'] ; 
$requet = " INSERT INTO `notification`( `date_temps`, `id_compte_r`, `code_notif`,`id_colis`, `id_trajet`) VALUES ('{$date_demande}',{$id_compte_e},{$code_notif},{$id_colis},{$id_trajet}) ";

mysqli_query($connect,$requet);

?>