<?php
	ob_start();
	session_start();

	$a_tel = $_POST['a_tel'];
	$a_mail = $_POST['a_mail'];
	$fb = $_POST['a_fb'];
	$twt = $_POST['a_twt'];
	$ig = $_POST['a_ig'];
	$snp = $_POST['a_snp'];

	$contact = array($a_tel, $a_mail, $fb, $twt, $ig, $snp);

	file_put_contents("../contact.txt",  "<?php return " . var_export($contact, true) . ";");

	$_SESSION['der_page']=1;

	header("location: ../admin/administration.php");
	exit();

?>