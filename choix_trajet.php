<?php



function affichage($row,$row2,$result3,$result4,$result5){
	$output='
	<div class="rela-block image-grid-container top-container  mt-2 " style="width:500px; padding-top:5px;">
			<div class="floated image-column 1"  >
				<div class="rela-block image">
					<section class="box main">
				</div>
						<div class="wrap-content">
							<div class="first">
								<div class="inner mt-2" >';
								$output.='<a href="profile.php" target="_blank">';
				                 if($row2['photo']){
				                   $output .= '<img  src="img_profiles/'.$row2['photo'].'"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row2["prenom"]." ".$row2["nom"].' </span> </a>' ;
				                 }else{
				                   $output .= '<img  src="img_profiles/unknown-profile.png"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row2["prenom"]." ".$row2["nom"].' </span> </a>';
				                 }
									/*<a href="#"> <img  src="img_profiles/'.$row2['photo'].'"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row2["prenom"]." ".$row2["nom"].' </span> </a>*/
									$output .= '<div style="lign-height:0.5px;">
									 <div class=" text-body " style="font-size:17px; margin-bottom:8px;">
										 '.$row["lieux_depart"].'
										 <i class="fas fa-arrow-right"> </i>
										 '.$row["lieux_arrive"].'
									 </div>';
									 $num_arret = mysqli_num_rows($result5);
									 if( $num_arret > 0 ) {
										 // $row5 = mysqli_fetch_array($result5);
										 $output .= ' <div class="badge badge-pill badge-secondary" data-trigger="hover" data-toggle="popover" title="Arrets" data-content="';
										 $row5 = mysqli_fetch_array($result5);
										 $output .=  $row5['arret'] ;
										 while($row5 = mysqli_fetch_array($result5) ){
											 $output .= ', '.$row5['arret'];
										 }
										$output .= '"style="font-size:15px; margin-bottom:5px;" > Arrets </div> ';
									}

								  if(mysqli_num_rows($result3)>0){
										$row3 = mysqli_fetch_array($result3);
										$output .= '
										<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
 										 Trajet non regulier
 									 	</div>
 									 	<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
 											depart : '.$row3["date_depart"].' | retour : '.$row3["date_retour"].'
 									 	</div>';
									}else{
										$row4 = mysqli_fetch_array($result4);
										$output .= '
										<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
 										 Trajet regulier
 									 	</div>
 									 	<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
 											depart : '.$row4["jour"].' | Frequence : '.$row4["frequence"].' fois par semaine
 									 	</div>';
									}
									$output .='
									 <div class=" text-body " style="font-size:17px; margin-bottom:5px;">
										 Detour max : '.$row["detour_max"].'
									 </div>
									 <div class=" text-body " style="font-size:17px; margin-bottom:5px;">
										 Taille max : '.$row["taille_max"].' | Poid max : '.$row["poids_max"].'
									 </div>
									 <div class=" text-body " style="font-size:17px; margin-bottom:10px;">
										Moyen de transport : '.$row["moyen"].'
									 </div>
									 <div class="text muted mb-3" > publié le  '.$row["date_annonce"].' </div>';
									 $connect = mysqli_connect("localhost", "root", "", "projet2cp") ;
                   $choisir = " SELECT id_compte_r,code_notif,id_colis,id_trajet FROM notification where (id_compte_r={$_GET['id_compte']}) AND (code_notif=0) AND (id_colis={$_GET['id_colis']}) AND (id_trajet={$row['id_trajet']}) " ;
                   $result_choisir = mysqli_query($connect, $choisir);
									 if(mysqli_num_rows($result_choisir)>0){
										 $output .= '<input type="button" name="demander" id="'.$row['id_trajet'].'" class="btn btn-primary demander mb-3" value="Choisi déja">';
									 }else{
									 	 $output .= '<input type="button" name="demander" id="'.$row['id_trajet'].'" class="btn btn-primary demander mb-3" value="Choisir"> ';
									 }
									 $output .= '
									 </div>
								</div>
							</div>

						</div>
					</section>
				</div>
	</div>
	';
	return $output;
}
 ?>
<!DOCTYPE html>
<html>
<head>
	 <link rel="icon" href="images/icon.png">
	<title>Choisir Un Trajet - Wasselli.dz</title>

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/wow.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="affichage-colis/css/linearicons.css">
    <!-- <link rel="stylesheet" href="affichage-colis/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="affichage-colis/css/nice-select.css">
    <link rel="stylesheet" href="affichage-colis/css/bootstrap.css">
    <link rel="stylesheet" href="affichage-colis/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php
    session_start();
		$connect = mysqli_connect("localhost", "root", "", "projet2cp");
		date_default_timezone_set('Africa/Algiers');
    $date_jour  = date('Y-m-d');
		$echec = ' SELECT * FROM trajets_non_reguliers where `date_depart` < \''.$date_jour.'\' ';
	  $result_echec = mysqli_query($connect,$echec);
	  if(mysqli_num_rows($result_echec)>0){
	    while($row_echec = mysqli_fetch_array($result_echec) ){
	      $ss = 'UPDATE `trajet` SET `etat`=\'echec\' WHERE `id_trajet` = '.$row_echec['id_trajet'].' AND etat="annonce" ';
	      $s = mysqli_query($connect,$ss);
	    }
	  }
    ?>
    <style type="text/css">
  .boutton{
  float:right;
  width:145px;
  height:41px;
  border:1px solid #11598b;
  text-align:center;
  font-size:14px;
  color:#187cc2;
  font-weight:normal;
  text-transform:uppercase;
  line-height:41px;
  margin:0 0 0 0;
  border: 1px solid #187cc2;
  border-radius:5px; -webkit-border-radius:5px;
  transition:0.5s; -webkit-transition:0.5s;
  background:#fff;
  text-decoration:none;
  }

.boutton:hover{
  text-decoration:none;
  background: #187cc2;
  border:1px solid #187cc2;
  color:#fff;
  }
h2.s1{

  font-size: 35px;
  text-align: center;
  font-family: 'Raleway';

}
</style>

</head>

<body  id="category" style="background-color: #fff;">
    <div class="navbarr">
        <div class="contain">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="WASSELLI.DZ"></a>
            </div>
            <div class="nav" style="left:91%;">
                <ul>
                    <li><a style="background-color: #187cc2; color: #fff;" href="index.php">ACCUEIL</a></li>
                </ul>
            </div>
        </div>
    </div>

    <br><br><br>
		<div class="container-fluid">
			<div class="row" style="margin-top: -73px;">
     <div id="choi2" style="display: none; z-index: 51;">
        <div style="position: fixed; height: 100%; width: 100%; background: #000; opacity: 0.7;"></div>
        <div style="width: 400px; height: 190px; background-color: #fff; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);">
            <br><br><h2 class="s1" style="font-size: 18px;  "><b style="color: #000;">Voulez-vous choisir <br>un autre trajet?</b></h2><br>
            <a href="#" class="boutton" id="conf_choi" style="float: left; margin-left: 40px;">Oui</a>
            <a href="#" class="boutton" id="annul_choi" style="margin-right: 40px;">Non</a>
    </div>

</div>
</div>
<br><br><br><br>
			<div class="row">
				<div class="col-12">
					<div class=" mt-5  rela-block top-container ">
	          <div class="rela-block top-center-container">
	              <div class="inner-container top-text-container">
									<h2 class="rela-block top-main-text">CHOISIR VOS Trajet</h2>
								 <?php echo ' <a href="form_trajet.php?id_colis='.$_GET['id_colis'].'&id_compte='.$_GET['id_compte'].' " >
												<button type="button" class="mt-4 btn btn-primary align-self-center " style="padding: 1em "> Ajouter une annonce de trajet </button>
												</a> ' ; ?>
	              </div>
	          </div>
	        </div>
				</div>
			</div>
			<div class="row">
				<?php
				$query = "SELECT * FROM trajet where (poids_max != 0) and (supp = 0) and ((etat = 'annonce') or (etat='accepte')) and (id_compte = ".$_SESSION['id_compte'].") ORDER BY date_annonce desc  ";

				?>
	      <div class="col-12">
	          <div class="row " id="annonce_filtrer" style="display: flex;justify-content: around; ">
								<?php
								$result = mysqli_query($connect, $query);

								while($row = mysqli_fetch_array($result))
									{
														$id_trajet = $row['id_trajet'];
														$query2 = " SELECT `nom`,`prenom`,`photo`,`prem_accepte`,`supp`,`desactiver` FROM `compte` where `id_compte` = ".$row["id_compte"]." " ;
														$result2 = mysqli_query($connect, $query2);
														$row2 = mysqli_fetch_array($result2);
														if(($row2['supp']!= 1 ) && ($row2['desactiver'] != 1 )){

																$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
																$result3 = mysqli_query($connect, $query3);

																$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
																$result4 = mysqli_query($connect, $query4);
																$query5 = " SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
																$result5 = mysqli_query($connect, $query5);
																echo affichage($row,$row2,$result3,$result4,$result5);

														}
									}

								?>
						</div>


	      </div>
	    </div>
	  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
     crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="affichage-colis/js/vendor/bootstrap.min.js"></script>

    <script src="affichage-colis/js/jquery.nice-select.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="affichage-colis/js/gmaps.min.js"></script>
    <script src="affichage-colis/js/main.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script type="text/javascript">
    function connecter() {
      alert('Veuillez connecter');
    }
</script>

    <script type="text/javascript">
        $(document).ready(function(){

					$('.demander').click(function(){
						if( $(this).val() == "Choisir" ){
							id_colis = <?php echo $_GET['id_colis']; ?>;

							id_trajet = $(this).attr("id") ;
							id_compte = <?php echo $_GET['id_compte']; ?>;
							code_notif = 0 ;
							$.ajax({
																url:"ajouter_demande_notif.php",
																method:"POST",
																data:{id_colis: id_colis, id_trajet:id_trajet, id_compte:id_compte, code:code_notif},
																success:function()
																{
																		 $('#'+id_trajet).val("Choisi déja") ;
																		 document.getElementById("annul_choi").href="index.php";
											                              $("#choi2").fadeIn();
											                               $("#conf_choi").click(function(){
											                              $("#choi2").fadeOut();
											                          });
																}
													 });

						}

					});


      });

 </script>
 <script type="text/javascript">
	$(document).ready(function(){
 $('[data-toggle="popover"]').popover();
});
 </script>
</body>
</html>
