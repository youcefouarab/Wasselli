<?php
	ob_start();
	session_start();

	$km = $_POST['km'];
	$kg = $_POST['kg'];
	$pet = $_POST['pet'];
	$moy = $_POST['moy'];
	$grd = $_POST['grd'];
	$tgrd = $_POST['tgrd'];
	$fac = $_POST['fac'];
	$my = $_POST['my'];
	$diff = $_POST['diff'];
	$spec = $_POST['spec'];

	$tarifs = array($km, $kg, $pet, $moy, $grd, $tgrd, $fac, $my, $diff, $spec);

	file_put_contents("../tarifs.txt",  "<?php return " . var_export($tarifs, true) . ";");

	$_SESSION['der_page']=4;

	header("location: ../admin/administration.php");
	exit();

?>