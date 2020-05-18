<?php session_start(); 

if ((isset($_SESSION['nom_admin']))&&($_SESSION['nom_admin']!="")) {
    header("location: admin/administration.php");
}

?>

<!DOCTYPE html>
<html>
<head>	
	<title>Administration - Wasselli.dz</title>
	<link rel="stylesheet" a href="css/stylev2.css?version=1">
	<link rel="stylesheet" a href="css/font-awesome.min.css">
    <link rel="icon" href="images/icon.png">
	
</head>
<body>
    
	<div class="formulaire">
		<img src="images/profile.png"/>
		<form method="POST" action="#">
			<div class="form-input">
				<input type="text" name="email" required="required" placeholder="E-mail" autofocus required></input>
			</div>
			<div class="form-input">
				<input type="password" name="password" required="required" placeholder="Mot de Passe" required></input>
			</div>
			<input type="submit" value="Se Connecter" class="boutton-log-in"></input>

		</form>
        <?php
    
    require 'php/dbh.inc.php';
    if(isset($_POST['email']))
    {
    $exist = 0;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['nom_admin']="";
    $sql = "SELECT * FROM compte_administrateur WHERE mail = '$email'";
    $result = mysqli_query($conn,$sql);
    if( mysqli_num_rows($result) == 1) {
        $ligne = $result->fetch_assoc();
        $hash = $ligne['mot_passe'];
        if (password_verify($password,$hash))
        {
        $exist = 1; 
        $_SESSION['id_admin']=$ligne['id_admin'];
        $_SESSION['nom_admin']=$ligne['nom'];
        $_SESSION['prenom_admin']=$ligne['prenom'];
        $_SESSION['mail_admin']=$ligne['mail'];
        $_SESSION['der_page']=1;
        header("location: admin/administration.php");
        exit();
        }
        else
        { ?>
             <div class="invalid"><?php echo'mot de passe ou email incorrect';
           exit;
        }           
    }
    else
        { ?>
             <div class="invalid"><?php echo'mot de passe ou email incorrect';
           exit;
        }
    }
?>  
	</div>
</body>
</html>