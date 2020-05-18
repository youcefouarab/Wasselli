<!DOCTYPE html>
<html>
<head>
	<title>Mot De Passe Oublié - Wasselli.dz </title>
	<link rel="icon" href="images/icon.png">
	<link rel="stylesheet" href="css/style.css" type="text/css">
<style type="text/css">
	form input.submit {
	
	width:140px;
	height:43px;
	cursor:pointer;
	transition:0.5s; -webkit-transition:0.5s;
	border-radius:5px; -webkit-border-radius:5px;
	background:transparent;
	border: 1px solid #187cc2;
	cursor:pointer;
	text-align:center;
	font-size:14px;
	color:#187cc2;
	text-transform:uppercase;
	}
	
	form input.submit:hover {
	background:#187cc2;
	color:#fff;
	}

	form input.text {
	float:left;
	width:330px;
	height:40px;
	background:#fff;
	border:1px solid #e7e7e7;
	transition:0.5s; -webkit-transition:0.5s;
	border-radius:5px; -webkit-border-radius:5px;
	margin:0;
	padding:0 0 0 10px;
	text-align:left;
	font-size:14px;
	color:#333;
	font-weight:normal;
	}
</style>


</head>
<body>

	<div class="navbarr">
        <div class="contain">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="WASSELLI.DZ"></a>
            </div>
            <div class="nav" style="left:90%;">
                <ul>
                    <li><a style="background-color: #187cc2; color: #fff;" href="index.php">ACCUEIL</a></li>
                </ul>
            </div>
        </div>
    </div>

    <br><br><br><br>

    <h2 style="text-align: center; font-size: 24px; margin-top: 100px;" >Vous avez oublié votre mot de passe?</h2>
    <br><br>
    

<?php

function Genere_Password($size)
{
	$password='';
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    for($i=0;$i<$size;$i++)
    {
        $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
    return $password;
}

	require 'php/dbh.inc.php';
	if (!isset($_POST['email'])) 
		echo '<h3 style="text-align: center; font-size: 18px;">Entrez votre email:</h3>
			<form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%); action="oublier.php" method="POST">
		    	<input type="email" class="text" name="email" placeholder="E-mail">&nbsp;&nbsp;&nbsp;
		    	<input type="submit" class="submit" value="Envoyer">
		    </form>';
	else {
		if (!isset($_POST['reponse'])) {
			$email = $_POST['email'];
			$sql = "select * from compte where mail = '".$email."' and supp=0 limit 1";
			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) == 1) {
				$ligne = $result->fetch_assoc();
				echo '<h3 style="text-align: center; font-size: 18px;">Entrez votre réponse à cette question:</h3><br>
				<form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%); action="oublier.php" method="POST">';
				switch ($ligne['question']) {
					case 1:
						echo '<h3 style="text-align: center; font-size: 20px;">Quel est le nom de votre premier enfant?</h3>';
						break;
					case 2:
						echo '<h3 style="text-align: center; font-size: 20px;">Quel est votre plat preferé?</h3>';
						break;
					case 3:
						echo '<h3 style="text-align: center; font-size: 20px;">Quel est la marque de votre premiere voiture?</h3>';
						break;
					case 4:
						echo '<h3 style="text-align: center; font-size: 20px;">Quel est le nom de votre lycée?</h3>';
				}
				echo '<br><br><input type="email" class="text" name="email" placeholder="E-mail" value="'.$email.'" hidden>
			    	<input type="text" class="text" name="reponse" placeholder="Réponse">&nbsp;&nbsp;&nbsp;
			    	<input type="submit" class="submit" value="Envoyer">
			    </form>';
			    
			}
			else {
				echo '<h3 style="text-align: center; font-size: 18px;">Entrez votre email:</h3>
				<form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%); action="oublier.php" method="POST">
			    	<input type="email" class="text" name="email" placeholder="E-mail" value="'.$email.'">&nbsp;&nbsp;&nbsp;
			    	<input type="submit" class="submit" style="margin-bottom:5px;" value="Envoyer">
			    	<br>
			    	<b style="color: #d63031; font-size: 14px; margin-left:10px;">Vérifiez votre e-mail!</b>
			    </form>';		
			}
		} else {
			$email = $_POST['email'];
			$sql = "select * from compte where mail = '".$email."' and supp=0 limit 1";
			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) == 1) {
				$ligne = $result->fetch_assoc();		
				if ($_POST['reponse']== $ligne['reponse']) {
					$passe = Genere_Password(10);
					$hash=password_hash($passe, PASSWORD_DEFAULT);
					$sql="UPDATE compte SET mot_passe = '".$hash."' WHERE id_compte = ".$ligne['id_compte'];
					mysqli_query($conn,$sql);
					echo '<h2 style="text-align: center; font-size: 24px; margin-top: 100px;" >Votre nouveau mot de passe est:<br>'.$passe.'</h2>';
				} else {
					echo '<h3 style="text-align: center; font-size: 18px;">Entrez votre réponse à cette question:</h3><br>
					<form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%); action="oublier.php" method="POST">';
					switch ($ligne['question']) {
						case 0:
							echo '<h3 style="text-align: center; font-size: 20px;">Question?</h3>';
							break;
					}
					echo '<br><br><input type="email" class="text" name="email" placeholder="E-mail" value="'.$email.'" hidden>
				    	<input type="text" class="text" name="reponse" placeholder="Réponse">&nbsp;&nbsp;&nbsp;
				    	<input type="submit" class="submit" value="Envoyer">
				    	<br>
				    	<b style="color: #d63031; font-size: 14px; margin-left:10px;">Réponse incorrecte!</b>
				    </form>';

				}
			}
		}	
	}
?>

    

    






   

</body>
</html>