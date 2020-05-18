<?php
 session_start();



 function affichage($row , $row2 ,$row3){
  $output =
  '<div class="rela-block image-grid-container top-container  mt-2 " style="width:630px; padding-top:5px;">
      <div class="floated image-column 1"  >
        <div class="rela-block image">
          <section class="box main">
        </div>
            <div class="wrap-content">
              <div class="first">
                <div style="display:flex; flex-direction:row;" >
                  <div style="display: flex ; flex-direction: column ;margin-left: 10px ; width: 250px;">';
                  if($row['photo']){
                    $output .= '<img src="'.$row['photo'].'" style="width: 200px; height: 200px;border-radius: 3%; ">' ;
                  }else{
                    $output .= '<img src="img_colis/unkonwn-colis.jpg" style="width: 200px; height: 200px;border-radius: 3%; ">';
                  }
                   $output .= ' <h4 class="text-danger" style=" display: flex ; justify-content: center;margin-top : 20px;">Prix : '.$row["tarif"].' DA </h3>
                  </div>
                <div style="width:440px;"> ';
                if($row3['photo']){
                  $output .= '<a href="profile.php" target="_blank"> <img  src="img_profiles/'.$row3['photo'].'"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row3["prenom"]." ".$row3["nom"].' </span> </a>' ;
                }else{
                  $output .= '<a href="profile.php" target="_blank"> <img  src="./images/profile.png"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row3["prenom"]." ".$row3["nom"].' </span> </a>';
                }
               $output .= '

                  <div style="lign-height:0.5px;">
                    <div class=" text-body " style="font-size:17px; margin-bottom:8px;">
                      Nom de colis : '.$row["nom"].'
                    </div>
                   <div class=" text-body " style="font-size:17px; margin-bottom:8px;">
                     '.$row2["lieux_depart"].'
                     <i class="fas fa-arrow-right"> </i>
                     '.$row2["lieux_arrive"].'
                   </div>';
                   if($row["adr_depart"]){
                     $output .= ' <div class="badge badge-pill " data-trigger="hover" data-html="true" data-toggle="popover" title="Adresse exacte" data-content="Adresse de depart : '.$row["adr_depart"].' <br /> ' ;
                   }else {
                     $output .= ' <div class="badge badge-pill " data-trigger="hover" data-html="true" data-toggle="popover" title="Adresse exacte" data-content="Adresse de depart : il n\'existe pas <br /> ' ;
                   }
                   if($row["adr_arrive"]){
                       $output .= 'Adresse d\'arrivée : '.$row["adr_arrive"].' "
                       style="font-size:15px; margin-bottom:5px;" > Addresse exacte </div> ';
                   }else{
                       $output .= 'Adresse d\'arrivée : il n\'existe pas "
                       style="font-size:15px; margin-bottom:5px;" > Addresse exacte </div> ';
                   }
                   $output .= '
                    <div class=" text-body " style="font-size:17px; margin-bottom:5px;">
                      Envoi : '.$row["date_envoi"].' | Depot : '.$row["date_depot"].'
                    </div>
                   <div class=" text-body " style="font-size:17px; margin-bottom:5px;">
                     Taille : '.$row["taille"].' | Poid : '.$row["poids"].' KG
                   </div> ';
                   if( !empty($row["demande_spec"]) ){
                    $output .= ' <div class="badge badge-pill " data-trigger="hover" data-toggle="popover" title="Demande speical" data-content="'.$row["demande_spec"].'"
                    style="font-size:15px; margin-bottom:5px;" > Demande Special </div> ';
                    }else{
                      $output .= ' <div class="badge badge-pill " style="font-size:15px; margin-bottom:5px;" > </div> ';
                    }
                   $output .= '<div class="text muted mb-3" > publié le '.$row["date_annonce"].'  </div> ';
                   $connect = mysqli_connect("localhost", "root", "", "projet2cp") ;

                   // $choisir = " SELECT `id_compte_r`,`code_notif`,`id_colis`,`id_trajet` FROM ( `id_compte_r` = {$_GET['id_compte']} ) " ;

                   $choisir = " SELECT id_compte_r,code_notif,id_colis,id_trajet FROM notification where (id_compte_r={$_GET['id_compte']}) AND (code_notif=3) AND (id_trajet={$_GET['id_trajet']}) AND (id_colis={$row['id_colis']}) " ;
                   $result_choisir = mysqli_query($connect, $choisir);
                   if(mysqli_num_rows($result_choisir)>0){
                     $output .= '<input type="button" name="demander" id="'.$row['id_colis'].'" class="btn btn-primary demander mb-3" style ="color:#fff; background-color: #218ad4; " value="Choisi déja">';
                   }else{
                     $output .= '<input type="button" name="demander" id="'.$row['id_colis'].'" class="btn btn-primary demander mb-3" style ="color:#fff; background-color: #218ad4; " value="Choisir">';
                   } $output .= '
                 </div>
               </div>
                </div>
              </div>

            </div>
          </section>
        </div>
  </div> ';
return $output;
      }

 $connect = mysqli_connect("localhost", "root", "", "projet2cp");
 date_default_timezone_set('Africa/Algiers');
    $date_jour =  date('Y-m-d');
 $connect = mysqli_connect("localhost", "root", "", "projet2cp");
 $echec = ' SELECT * FROM colis where `date_depot` < \''.$date_jour.'\' ';
 $result_echec = mysqli_query($connect,$echec);
 if(mysqli_num_rows($result_echec)>0){
   while($row_echec = mysqli_fetch_array($result_echec) ){
     $ss = 'UPDATE `colis` SET `etat`=\'echec\' WHERE `id_colis` = '.$row_echec['id_colis'].' AND etat="annonce" ';
     $s = mysqli_query($connect,$ss);
   }
 }
 $query = "SELECT * FROM colis where (supp = 0) and (etat = 'annonce') and (id_compte_e = ".$_SESSION['id_compte'].") ORDER BY date_annonce desc  ";
 $result = mysqli_query($connect, $query);
 ?>

<!DOCTYPE html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<!-- Site Title -->

	<title>Choisir Un Colis - Wasselli.dz</title><!--
            CSS
            ============================================= -->
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
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
    <link rel="icon" href="images/icon.png">

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
  color: #000;
  font-size: 35px;
  text-align: center;
  font-family: 'Raleway';
}
</style>
</head>

<body id="category">

  <div class="row">
   <div id="choi2" style="display: none; z-index: 50;">
      <div style="position: fixed; height:100%; width:100%; background: #000; opacity: 0.7;"></div>
      <div style="width: 400px; height: 190px; background-color: #fff; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);">
          <br><br><h2 class="s1" style="font-size: 18px; "><b style="color: #000;">Voulez-vous choisir <br>un autre colis?</b></h2><br>
          <a href="#" class="boutton" id="conf_choi" style="float: left; margin-left: 40px;">Oui</a>
          <a href="#" class="boutton" id="annul_choi" style="margin-right: 40px;">Non</a>
  </div>

  </div>
  </div>

  <div class="row">


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
  </div>
<br><br><br><br><br>

  <div style="z-index: 3;">
	<div class="container-fluid" >


		<div class="row">

	<div class="col-12">
		<div class="rela-block top-container" style="margin-top: 20px; ">
      <div class="rela-block top-center-container">
        <div class="inner-container top-text-container">
            <h2 class="rela-block top-main-text">CHOISIR VOS COLIS</h2>
            <?php echo ' <a href="formulaire_colis.php?id_trajet='.$_GET['id_trajet'].'&id_compte='.$_GET['id_compte'].' " >
                  <button type="button" class="mt-4 btn btn-primary align-self-center " style="padding: 1em "> Ajouter une annonce de colis </button>
                  </a> ' ; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  			<!-- Start Best Seller -->
				<!-- <section class="lattest-product-area pb-40 category-list"> -->
					<!-- <form action="demande_colis.php" method="GET" target="_blank"> -->
          <div class="col-12" >
					<div class="row" id="annonce_filtrer" style="display: flex;justify-content: around; ">

						<?php
            $result = mysqli_query($connect, $query);

          while($row = mysqli_fetch_array($result))
            {
            $id_trajet = $row["id_trajet"];

                      $query3 = " SELECT `nom`,`prenom`,`photo`,`prem_accepte`,`supp`,`desactiver` FROM `compte` where `id_compte` = ".$row["id_compte_e"]." " ;
                      $result3 = mysqli_query($connect, $query3);
                      $row3 = mysqli_fetch_array($result3);

                          $query2 = " SELECT `lieux_depart`,`lieux_arrive` FROM `trajet` WHERE `id_trajet` = ".$id_trajet." ";
                          $result2 = mysqli_query($connect, $query2);
                          $row2 = mysqli_fetch_array($result2);
                          echo affichage($row,$row2,$row3);

            }
            ?>



					</div>
					<!-- </form> -->
				<!-- </section> -->
      </div>
				<!-- End Best Seller -->

			</div>
		</div>
	</div>




<script type="text/javascript">
    function connecter() {
      alert('Veuillez connecter');
    }
</script>


	<!-- <script src="js/vendor/jquery-2.2.4.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="affichage-colis/js/vendor/bootstrap.min.js"></script>

	<!-- <script src="js/jquery.ajaxchimp.min.js"></script> -->
	<script src="affichage-colis/js/jquery.nice-select.min.js"></script>
	<!-- <script src="js/jquery.sticky.js"></script> -->
	<!-- <script src="js/nouislider.min.js"></script> -->
	<!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
	<!-- <script src="js/owl.carousel.min.js"></script> -->
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="affichage-colis/js/gmaps.min.js"></script>
	<script src="affichage-colis/js/main.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script type="text/javascript">
   $(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
  </script>




  <script type="text/javascript">
  $('.demander').click(function(){
    if( $(this).val() == "Choisir" ){
      id_colis = $(this).attr("id") ;
      id_trajet = <?php echo $_GET['id_trajet']; ?>;
      id_compte = <?php echo $_GET['id_compte']; ?>;
      code_notif = 3 ;
      $.ajax({
                        url:"ajouter_demande_notif.php",
                        method:"POST",
                        data:{id_colis: id_colis, id_trajet:id_trajet, id_compte:id_compte, code:code_notif},
                        success:function()
                        {
                             $('#'+id_colis).val("Choisi déja") ;
                             document.getElementById("annul_choi").href="index.php";
                              $("#choi2").fadeIn();
                              $("#conf_choi").click(function(){
                              $("#choi2").fadeOut();
                          });

                        }
                   });

    }
  });
</script>
</body>

</html>
