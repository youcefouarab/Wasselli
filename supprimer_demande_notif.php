<?php 
session_start();
 
$connect = mysqli_connect("localhost", "root", "", "projet2cp");
date_default_timezone_set('Africa/Algiers');

$date_demande = date('Y-m-d H:i:s'); 
$id_compte_e = $_SESSION['id_compte'];
$id_trajet = $_POST['id_trajet'] ;
$id_colis = $_POST['id_colis'] ;

$requet = " DELETE FROM `notification` where ( `id_colis`={$id_colis} ) AND (`id_trajet` = {$id_trajet}) ";

mysqli_query($connect,$requet);

?>