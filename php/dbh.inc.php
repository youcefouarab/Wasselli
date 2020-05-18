<?php 
$serveurname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "projet2cp";
$conn = mysqli_connect($serveurname,$dbusername,$dbpassword,$dbname);//pas de connexion avec le serveur
if (!$conn)
{

	die("connection failed :".mysql_connect_error());	
}