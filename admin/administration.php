<?php session_start(); require '../php/dbh.inc.php'; 
if((!isset($_SESSION['nom_admin']))||($_SESSION['nom_admin']=="")) header('location: ../page_inaccessible.php');
if(!isset($_SESSION['der_page'])) $_SESSION['der_page']=1;
if(!isset($_GET['msg'])) $_GET['msg']="";
?>
<!DOCTYPE html>
<html>
<head>
	<!--CSS-->
	<!--CSS Principal--><link rel="stylesheet" href="../css/style.css" type="text/css">
	<!--CSS Admin--><link rel="stylesheet" type="text/css" href="../css/style_admin.css?version=1">
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css">
    <!--JS--><script src="../js/jquery.js" type="text/javascript"></script>
    <!--Bib JQuery--><script src="../js/jquery.min.js" type="text/javascript"></script>
	<script src="../js/monJqueryA.js?version=2" type="text/javascript"></script>
	
    <link rel="icon" href="../images/icon.png">

	<title>Administration - Wasselli.dz</title>
</head>
<body>

	<div id="page_admin" style="display: none;">

    <div class="navbarr">
        <div class="contain">
            <div class="logo">
                <a href="../index.php"><img src="../images/logo.png" alt="WASSELLI.DZ"></a>
            </div>
            <div class="nav" style="left: 30%;">
                <ul>
                    <li><a href="../index.php">ACCUEIL</a></li>
                    <li class="sub"><a href="#">ANNONCES</a>
                      <ul class="sub-content">
                        <li><a href="../affichage_colis.php?from=admin" target="_blank">COLIS</a></li>
                        <li><a href="../affichage_trajet.php?from=admin" target="_blank">TRAJETS</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            <div class="pprof" id="proff">
                <ul>
                    <li style="margin-left: 40px;"><a class="adm" href="../stats/Statistique.php" id="admin">STATISTIQUES</a></li>
                    <li style="margin-left: 40px;"><a class="adm" onclick="der_page(1)" href="" id="admin">ADMINISTRATION</a></li>
                    <li style="margin-left: 40px;"><a href="../php/logout_admin.php" class="dcx" id="decon"><i class="fa fa-sign-out" style="font-size: 14px;"></i>&nbsp;&nbsp;DECONNEXION</a></li>
                </ul>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>

    
    <h2 class="s1" style="margin-top: 20px; margin-bottom: 30px;"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;Administration</h2>

    <div class="container"  >
	<div class="tabs">
        <ul>
        	<li><a href="#" onclick="der_page(1)" id="tab_infos"><i class="fa fa-user"></i>&nbsp;&nbsp;Vos Infos</a></li>
        	<li><a href="#" onclick="der_page(2)" id="tab_notifs" style="display: inline-block;"><i class="fa fa-bell"></i>&nbsp;&nbsp;Notifications
        		<div id="n" style="display: inline-block;">
                                <?php
                                 $e = 0 ;
                                 $sql = "SELECT * FROM notifications_admin WHERE vu = '$e'";
                                 $result = mysqli_query($conn,$sql);
                                $count= mysqli_num_rows($result);
                                if($count!=0) echo "<div class='label label-danger'>$count</div>";?>
                        </div>
                        <form id="v" method="get" action="../php/notif_admin.php" style="display: inline-block;"> 
                        </form>
        	</a></li>
        	<li><a href="#" onclick="der_page(3)" id="tab_ajout"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Ajouter Un Administrateur</a></li>
        	<li><a href="#" onclick="der_page(4)" id="tab_tarifs"><i class="fa fa-money"></i>&nbsp;&nbsp;Gestion Des Tarifs</a></li>
        	
        </ul>
   
    </div>

    <div class="page" id="infos">
    	
    	<div class="right">
    		
    		<div>

    			<form id="form_infos" method="post" action="../php/modif_admin.php">
    				<div><label>Nom:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="nom" value="<?php echo $_SESSION['nom_admin']?>" disabled="true" id="chnom" required/></div>
    				<div><label>Prénom:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="prenom" value="<?php echo $_SESSION['prenom_admin']?>" disabled="true" id="chpre" required/></div>
    				<div><label>E-mail:</label>&nbsp;&nbsp;&nbsp;<input type="email" name="email" value="<?php echo $_SESSION['mail_admin']?>" disabled="true" id="chmail" required/></div>
    				<div><label>Mot de passe:</label>&nbsp;&nbsp;&nbsp;<input type="password" name="password" disabled="true" id="chpas" required/></div>
    				<div id="pass_rep" style="display: none;"><label>Répéter mot de passe:</label>&nbsp;&nbsp;&nbsp;<input type="password" name="conf_password" id="chpass" required/></div>
    				<script type="text/javascript">
               			var password = document.getElementById("chpas")
  						, confirm_password = document.getElementById("chpass");
						function validatePassword(){
  						if(password.value != confirm_password.value) {
   							confirm_password.setCustomValidity("Mot de passe incorrect!");
  						} else {
    						confirm_password.setCustomValidity('');
							}
						}
						password.onchange = validatePassword;
						confirm_password.onkeyup = validatePassword;
          		  </script>
    				<div id="conf" style="display: none;"><input type="submit" id="valid" value="Valider" class="boutton" style="width:145px;height:41px;"/></div>
				</form>
				<a href="#" id="modif" style="float: right;" class="boutton">Modifier</a><br><br><br>
				<a href="#" id="supp" style="float: right;" class="boutton suppr">Supprimer</a>

				<?php
    			$contact = include "../contact.txt";
    			$tel_admin=$contact[0];
    			$email_admin=$contact[1];
    			$fb_admin=$contact[2];
    			$twt_admin=$contact[3];
    			$snp_admin=$contact[4];
    			$ig_admin=$contact[5];
    			?>

    			<h2 class="s1" style="margin-top: 70px;"><i class="fa fa-vcard-o"></i>&nbsp;&nbsp;Infos Contact</h2>
				<form id="form_contact" method="post" action="../php/modif_contact.php" style="margin-top:50px;">
    				<div><label><i class="fa fa-phone"></i>&nbsp;&nbsp;Tél:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="a_tel" value="<?php echo $tel_admin ?>" disabled="true" id="chtel"/></div>
    				<div><label><i class="fa fa-envelope"></i>&nbsp;&nbsp;E-mail:</label>&nbsp;&nbsp;&nbsp;<input type="email" name="a_mail" value="<?php echo $email_admin ?>" disabled="true" id="chema"/></div>
    				<div><label><i class="fa fa-facebook"></i>&nbsp;&nbsp;Facebook:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="a_fb" value="<?php echo $fb_admin ?>" disabled="true" id="chfb"/></div>
    				<div><label><i class="fa fa-twitter"></i>&nbsp;&nbsp;Twitter:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="a_twt" value="<?php echo $twt_admin ?>" disabled="true" id="chtwt"/></div>
    				<div><label><i class="fa fa-instagram"></i>&nbsp;&nbsp;Instagram:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="a_ig" value="<?php echo $ig_admin ?>" disabled="true" id="chig"/></div>
    				<div><label><i class="fa fa-snapchat"></i>&nbsp;&nbsp;Snapchat:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="a_snp" value="<?php echo $snp_admin ?>" disabled="true" id="chsnp"/></div>
    				<div id="conf3" style="display: none;"><input type="submit" id="valid3" value="Valider" class="boutton" style="width:145px;height:41px;margin-bottom: 50px;"/></div>
				</form>
				<a href="#" id="modif3" style="float: right; margin-bottom: 50px;" class="boutton">Modifier</a>
    	
    	</div>
    	</div>
    </div>

    <div class="page" id="notifs" style="display: none; ">
    	<div class="list_notif" style="margin-bottom: 50px;">	
<?php 
	$result_ = mysqli_query($conn, "SELECT * FROM notifications_admin ORDER BY date_temps DESC");
	if (!$result_) {die('Could not query');}
	if (mysqli_num_rows($result_)==0) {echo '<p style="text-align:center;"><i>vous n\'avez aucune notification</i></p>';}
	else { 
    	while ($ligne= mysqli_fetch_array($result_)) {
            $i=$ligne['id_notif_admin'];
        	
        		$sql="select * from compte where id_compte=".$ligne['id_compte_e']." limit 1";
        		$result=mysqli_query($conn,$sql);
        		if (mysqli_num_rows($result)>0) {$ligne2=$result->fetch_assoc();}
        		$sql="select * from compte where id_compte=".$ligne['id_compte_s'];
       			$result=mysqli_query($conn,$sql);
       			if (($result!=NULL)&&(mysqli_num_rows($result)>0)) {$ligne3=$result->fetch_assoc();}
        		if ($ligne['vu']==0) {
    	    		if ($ligne['code']=='premium') {
    	    			echo '	<div class="notif" id="notif'.$i.'">
    	    						<button class="vu" id="vu'.$i.'" onclick="vuu('.$i.')"><img src="../images/vu.png" width="20px"></button>
    	    						<div class="titrep"><i class="fa fa-star"></i>&nbsp;&nbsp;Demande Premium</div>
    	    						<label class="lab">Demandeur:</label><a onclick="vuu('.$i.')" href="../profile.php?id='.$ligne['id_compte_e'].'&from=admin" target="_blank" class="prof">'.$ligne2['prenom'].' '.$ligne2['nom'].'</a>
    	    						<p class="datep">'.$ligne['date_temps'].'</p>
    	    					</div>';
    				} 
    				if ($ligne['code']=='signal') {
    					$sql="select * from compte where id_compte=".$ligne['id_compte_s'];
       					$result=mysqli_query($conn,$sql);
       					if (mysqli_num_rows($result)>0) {$ligne3=$result->fetch_assoc();}
    					echo '	<div class="notif" id="notif'.$i.'">
    	    						<button class="vu" id="vu'.$i.'" onclick="vuu('.$i.')"><img src="../images/vu.png" width="20px"></button>
    	    						<div class="titres"><i class="fa fa-flag"></i>&nbsp;&nbsp;Signal d\'utilisateur</div>
    	    						<label class="lab">Signalé:</label><a onclick="vuu('.$i.')" href="../profile.php?id='.$ligne['id_compte_s'].'&from=admin" target="_blank" class="prof">'.$ligne3['prenom'].' '.$ligne3['nom'].'</a>
    	    						<label class="lab">Par:</label><a onclick="vuu('.$i.')" href="../profile.php?id='.$ligne['id_compte_e'].'&from=admin" target="_blank" class="prof">'.$ligne2['prenom'].' '.$ligne2['nom'].'</a>
    	    						<p class="datep">'.$ligne['date_temps'].'</p><br>
                                    <label class="lab" style="margin-left:232px;">Cause:</label><p style="display:inline; margin-left:5px;">'.$ligne['cause_signale'].'</p>
    	    					</div>';
    				}
    			} else {
    				if ($ligne['code']=='premium') {
    	    			echo '	<div class="notifv" id="notif'.$i.'">
    	    						<button class="vu" id="vu'.$i.'" onclick="vuu('.$i.')" style="right:-118px;"><img src="../images/nonvu.png" width="20px"></button>
    	    						<div class="titreg"><i class="fa fa-star"></i>&nbsp;&nbsp;Demande Premium</div>
    	    						<label class="lab">Demandeur:</label><a href="../profile.php?id='.$ligne['id_compte_e'].'&from=admin" target="_blank" class="prof">'.$ligne2['prenom'].' '.$ligne2['nom'].'</a>
    	    						<p class="datep">'.$ligne['date_temps'].'</p>
    	    					</div>';
    				} 
    				if ($ligne['code']=='signal') {
    					echo '	<div class="notifv" id="notif'.$i.'">
    								<button class="vu" id="vu'.$i.'" onclick="vuu('.$i.')"><img src="../images/nonvu.png" width="20px"></button>
    	    						<div class="titreg"><i class="fa fa-flag"></i>&nbsp;&nbsp;Signal d\'utilisateur</div>
    	    						<label class="lab">Signalé:</label><a href="../profile.php?id='.$ligne['id_compte_s'].'&from=admin" target="_blank" class="prof">'.$ligne3['prenom'].' '.$ligne3['nom'].'</a>
    	    						<label class="lab">Par:</label><a href="../profile.php?id='.$ligne['id_compte_e'].'&from=admin" target="_blank" class="prof">'.$ligne2['prenom'].' '.$ligne2['nom'].'</a>
    	    						<p class="datep">'.$ligne['date_temps'].'</p><br>
                                    <label class="lab" style="margin-left:232px;">Cause:</label><p style="display:inline; margin-left:5px;">'.$ligne['cause_signale'].'</p>
    	    					</div>';
    				}
    			}
            }	
	    }
?>
    	</div>
    </div>



    <div class="page" id="tarifs" style="display: none;">
    	<div class="right" style="position: relative; right: 180px;">
    		
    		<?php
    			$tarif = include "../tarifs.txt";
    		?>
    		<div style="float: left;">
    			<form id="form_tarifs" method="post" action="../php/modif_tarifs.php">
    				<div><label>Par KM:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="km" value="<?php echo $tarif[0]?>" disabled="true" id="chkm" required/>&nbsp;&nbsp;DA</div>
    				<div><label>Par KG:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="kg" value="<?php echo $tarif[1]?>" disabled="true" id="chkg" required/>&nbsp;&nbsp;DA</div>
    				<div><label>Par Taille:</label></div>
                    <div><label>Petit:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="pet" value="<?php echo $tarif[2]?>" disabled="true" id="chpt" required/>&nbsp;&nbsp;DA</div>
                    <div><label>Moyen:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="moy" value="<?php echo $tarif[3]?>" disabled="true" id="chmy" required/>&nbsp;&nbsp;DA</div>
                    <div><label>Grand:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="grd" value="<?php echo $tarif[4]?>" disabled="true" id="chgd" required/>&nbsp;&nbsp;DA</div>
                    <div><label>Très Grand:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="tgrd" value="<?php echo $tarif[5]?>" disabled="true" id="chtg" required/>&nbsp;&nbsp;DA</div>
    				<div><label>Par Difficulté:</label></div>
                    <div><label>Facil:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="fac" value="<?php echo $tarif[6]?>" disabled="true" id="chfac" required/>&nbsp;&nbsp;DA</div>
                    <div><label>Moyen:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="my" value="<?php echo $tarif[7]?>" disabled="true" id="chmoy" required/>&nbsp;&nbsp;DA</div>
                    <div><label>Difficil:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="diff" value="<?php echo $tarif[8]?>" disabled="true" id="chdiff" required/>&nbsp;&nbsp;DA</div>
    				<div><label>Demandes Spéciales:</label>&nbsp;&nbsp;&nbsp;<input type="number" step="0.01" min="0" name="spec" value="<?php echo $tarif[9]?>" disabled="true" id="chspec" required/>&nbsp;&nbsp;DA</div>
    				<div id="conf2" style="display: none;"><input type="submit" id="valid2" value="Valider" class="boutton" style="width:145px;height:41px;margin-bottom: 50px;" /></div>
				</form>
				<a href="#" id="modif2" style="float: right; margin-bottom: 50px;" class="boutton">Modifier</a>
    		
    	</div>
    	</div>
    </div>

    <div class="page" id="ajout" style="display: none;"> 	
    <div class="right" style="position: relative; right: 180px;">
    <div style="float: left;">
    			<form id="form_ajout" method="post" action="../php/ajout_admin.php">
    				<div><label>Nom:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="nom_aj" required/></div>
    				<div><label>Prénom:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="prenom_aj" required/></div>
    				<div><label>E-mail:</label>&nbsp;&nbsp;&nbsp;<input type="email" name="email_aj" required/></div>
    				<div><label>Mot de passe:</label>&nbsp;&nbsp;&nbsp;<input type="password" name="password_aj" required/></div>
    				<div><label>Répéter mot de passe:</label>&nbsp;&nbsp;&nbsp;<input type="password" name="password_per_aj" required/></div>
    				<input type="submit" value="Valider" class="boutton" style="position: relative;right: -70px;width:145px;height:41px;margin-bottom: 50px;" />
				</form>
    		
    	</div>
    </div>

    

    </div>
</div>

<div id="conf_supp" style="display: none; margin-top:-218px; ">
        <div style="position: fixed; height:100%; width: 100%; background: #000; opacity: 0.7;" ></div>
        <div style="width: 400px; height: 190px; background-color: #fff; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);">
            <br><h2 class="s1" style="font-size: 18px;">Voulez-vous vraiment supprimer <br>votre compte?</h2><br>
            <a href="../php/supp_admin.php" class="boutton" style="float: left; margin-left: 40px;">Oui</a>
            <a href="#" class="boutton" id="annul_supp" style="margin-right: 40px;">Non</a>
    </div>

</div>

</div>




	

<script type="text/javascript">
	$(document).ready(function(){	
		var adm="<?php echo $_SESSION['nom_admin'] ?>";
		var clone=$("#page_admin").clone();
		$("#page_admin").remove();
		
		
		if (adm!="") {
			
			$("body").append(clone);
			$("#page_admin").fadeIn(0);
		

		var der="<?php echo $_SESSION['der_page'] ?>";
		var css=".sidebar ul li a{background:#fff;} .sidebar ul li a:hover{background:#187cc2;}";

			if (der==1) {
				document.getElementById("notifs").style.display="none";
				document.getElementById("tarifs").style.display="none";
				document.getElementById("ajout").style.display="none";
				$("#infos").fadeIn();
				document.getElementById("tab_infos").style.background="#187cc2";
                document.getElementById("tab_infos").style.color="#fff";
				document.getElementById("tab_notifs").style=css;
				document.getElementById("tab_tarifs").style=css;
				document.getElementById("tab_ajout").style=css;
			}
			if (der==2) {
				document.getElementById("infos").style.display="none";
				document.getElementById("tarifs").style.display="none";
				document.getElementById("ajout").style.display="none";
				$("#notifs").fadeIn();
				document.getElementById("tab_notifs").style.background="#187cc2";
                document.getElementById("tab_notifs").style.color="#fff";
				document.getElementById("tab_infos").style=css;
				document.getElementById("tab_tarifs").style=css;
				document.getElementById("tab_ajout").style=css;
			}
			if (der==3) {
				document.getElementById("infos").style.display="none";
				document.getElementById("tarifs").style.display="none";
				document.getElementById("notifs").style.display="none";
				$("#ajout").fadeIn();
				document.getElementById("tab_ajout").style.background="#187cc2";
                document.getElementById("tab_ajout").style.color="#fff";
				document.getElementById("tab_notifs").style=css;
				document.getElementById("tab_tarifs").style=css;
				document.getElementById("tab_infos").style=css;
			}
			if (der==4) {
				document.getElementById("infos").style.display="none";
				document.getElementById("notifs").style.display="none";
				document.getElementById("ajout").style.display="none";
				$("#tarifs").fadeIn();
				document.getElementById("tab_tarifs").style.background="#187cc2";
                document.getElementById("tab_tarifs").style.color="#fff";
				document.getElementById("tab_notifs").style=css;
				document.getElementById("tab_infos").style=css;
				document.getElementById("tab_ajout").style=css;
			}
		}
	});

	$(document).ready(function(){
			var css=".sidebar ul li a{background:#fff;} .sidebar ul li a:hover{background:#187cc2;}"

			$("#tab_infos").click(function(event){
				event.preventDefault();
				
					document.getElementById("notifs").style.display="none";
					document.getElementById("tarifs").style.display="none";
					document.getElementById("ajout").style.display="none";
					$("#infos").fadeIn();
					document.getElementById("tab_infos").style.background="#187cc2";
                    document.getElementById("tab_infos").style.color="#fff";
					document.getElementById("tab_notifs").style=css;
					document.getElementById("tab_tarifs").style=css;
					document.getElementById("tab_ajout").style=css;
					
				
			})
			$("#tab_notifs").click(function(event){
				event.preventDefault();
				
					document.getElementById("infos").style.display="none";
					document.getElementById("tarifs").style.display="none";
					document.getElementById("ajout").style.display="none";
					$("#notifs").fadeIn();
					document.getElementById("tab_notifs").style.background="#187cc2";
                    document.getElementById("tab_notifs").style.color="#fff";
					document.getElementById("tab_infos").style=css;
					document.getElementById("tab_tarifs").style=css;
					document.getElementById("tab_ajout").style=css;
					
			
			})
			$("#tab_tarifs").click(function(event){
				event.preventDefault();
				
					document.getElementById("infos").style.display="none";
					document.getElementById("notifs").style.display="none";
					document.getElementById("ajout").style.display="none";
					$("#tarifs").fadeIn();
					document.getElementById("tab_tarifs").style.background="#187cc2";
                    document.getElementById("tab_tarifs").style.color="#fff";
					document.getElementById("tab_notifs").style=css;
					document.getElementById("tab_infos").style=css;
					document.getElementById("tab_ajout").style=css;
				
				
			})
			$("#tab_ajout").click(function(event){
				event.preventDefault();
				
					document.getElementById("notifs").style.display="none";
					document.getElementById("tarifs").style.display="none";
					document.getElementById("infos").style.display="none";
					$("#ajout").fadeIn();
					document.getElementById("tab_ajout").style.background="#187cc2";
                    document.getElementById("tab_ajout").style.color="#fff";
					document.getElementById("tab_notifs").style=css;
					document.getElementById("tab_tarifs").style=css;
					document.getElementById("tab_infos").style=css;
					
				
			})
		});
	


$(document).ready(function(){	
		
			$("#modif").click(function(event){
				event.preventDefault();
				document.getElementById("chnom").disabled=false;
				document.getElementById("chpre").disabled=false;
				document.getElementById("chmail").disabled=false;
				document.getElementById("chpas").disabled=false;
				$("#pass_rep").fadeIn();
				$("#modif").remove();
				$("#conf").fadeIn();
			})
			$("#supp").click(function(event){
				$("#conf_supp").fadeIn();
			})
			$("#annul_supp").click(function(event){
				$("#conf_supp").fadeOut();
			})
			$("#modif2").click(function(event){
				event.preventDefault();
				document.getElementById("chkg").disabled=false;
				document.getElementById("chkm").disabled=false;
				document.getElementById("chpt").disabled=false;
                document.getElementById("chmy").disabled=false;
                document.getElementById("chgd").disabled=false;
                document.getElementById("chtg").disabled=false;
                document.getElementById("chfac").disabled=false;
                document.getElementById("chmoy").disabled=false;
				document.getElementById("chdiff").disabled=false;
				document.getElementById("chspec").disabled=false;
				$("#modif2").remove();
				$("#conf2").fadeIn();
			})
			$("#modif3").click(function(event){
				event.preventDefault();
				document.getElementById("chtel").disabled=false;
				document.getElementById("chema").disabled=false;
				document.getElementById("chfb").disabled=false;
				document.getElementById("chtwt").disabled=false;
				document.getElementById("chig").disabled=false;
				document.getElementById("chsnp").disabled=false;
				$("#modif3").remove();
				$("#conf3").fadeIn();
			})
		});


	function vuu(i){
			$.post("../php/vu.php", { id:i });
			location.reload();
		}

		function der_page(i) {
			$.post("../php/der_page.php", { der : i });
		}

		function profil(i) {
			$.post("../php/vers_profil.php", {id : i});
		}
</script>

<script type="text/javascript">
    if ("<?php echo $_GET['msg'] ?>"=="email") setTimeout(function(){alert("L'email que vous venez de choisir existe déja!");},200);
</script>
<script type="text/javascript">
    if ("<?php echo $_GET['msg'] ?>"=="passe") setTimeout(function(){alert("Erreur mot de passe !");},200);
</script>
</body>
</html>