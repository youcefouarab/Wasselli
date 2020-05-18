<!DOCTYPE html>
<html>
<head>  
    <!--CSS Principal--><link rel="stylesheet" href="css/style.css?version=1" type="text/css">
    <!--CSS Slider--><link rel="stylesheet" href="css/layerslider.css" type="text/css">
    <!--JS-->
    <!--Bib JQuery-->
    <!--Bib GreenSock--><script src="js/greensock.js" type="text/javascript"></script>
    <!--Transitions Slider--><script src="js/layerslider.transitions.js" type="text/javascript"></script>
                             <script src="js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>  
                               <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <link rel="stylesheet" href="css/all.css" type="text/css">

  <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="css/animate.css" type="text/css">
  <script src="js/monJquery5.js?version=3" type="text/javascript"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   

    <!--JS-->
    <!--Bib JQuery--><script src="js/jquery.min.js" type="text/javascript"></script>
    <!--Bib GreenSock--><script src="js/greensock.js" type="text/javascript"></script>
    <!--Transitions Slider--><script src="js/layerslider.transitions.js" type="text/javascript"></script>
                             <script src="js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script> 
                             <script src="js/wow.js" type="text/javascript"></script>                          
    <title>Accueil - Wasselli.dz</title>
    <link rel="icon" href="images/icon.png">
    <?php session_start();
    if (!isset($_SESSION['nom'])) $_SESSION['nom']="";
    ?>

<style type="text/css"> 

    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }
    .form input {display: none;}

    
        .notification-ul
        {
            background-color:white;
            width:21.875vw;
            color:black;
            text-align: center;
            border: 1px solid #b3cccc;
            border-radius: 5px ;
            position: absolute;
            left: -8.854166vw;
            top:3vw;
            max-height: 25vw;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .notification-li:hover
        {
            background-color:#00ace6;
            color:white;
            text-align: center;
            width:100%;
            padding-bottom: 1%;
            padding-top: 1%;
            border-bottom: 1px solid #b3cccc;
            transition: 1s;
        }
        .notification-li 
        {
            background-color:white;
            color:black;
            text-align: center;
            width:100%;
            padding-bottom: 1%;
            padding-top: 1%;
            border-bottom: 1px solid #b3cccc;
            transition: 1s;
        }
        .notif-button:hover
        {
            background-color:white;
            
        }
        .notif-button
        {
              cursor: pointer;
           display: inline-block;
             background-color:transparent;
            color: inherit;
            margin: 5px;


        }
        ::-webkit-scrollbar {
            width: 8px; 
            }

            ::-webkit-scrollbar-track {
                background-color: #e0ebeb;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                border-radius: 10px;
                background-color: #a3c2c2;
            }

        #nonotif
        {
            cursor: alias;
        }
        #insc_premium
        {
            position: fixed;
            top:7%;
            width: 30%;
            height: 90%;
            background-color: white;
            border: 1px solid #80ccff;
            border-radius: 10px;
            font-family: "Times New Roman", Times, serif;
            font-size: 150%; 
          display: none;
          
           z-index: 100;
        }
        #voir_plus_notif_refuse{            position: fixed;
            top:25%;
            background-color: white;
            border: 1px solid #80ccff;
            border-radius: 10px;
            font-family: "Times New Roman", Times, serif;
            font-size: 150%; 
          display: none;
          
           z-index: 100;}
        #insc_premium
        {height: 65%;
}

        .ho
        {
            color: yellow;
        }

        #down
{
    font-size: 1vw;
      background-color:#187cc2;
  border: none;
  color: white;
  padding: 0.7vw 0.7vw;
  cursor: pointer;
  border-radius: 8px;
    -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  position: relative;
  left: 2vw;

 
}
.error_premium
{
    color: red;
    font-size: 0.9vw;
    font-family: "Raleway";
    position: relative;
   
    bottom: 0.8vw;
}
        #premium_inc:hover ,#remove:hover
        {
            background-color: #ff1a1a;
            color: white; 
        }
        .y/*les champs nom ....*/
{ 
    margin-bottom: 1vw;
     margin-top: 1vw;
}
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
#down:hover{background-color: #4dd2ff;}

#img-upload1 #img-upload2 #img-upload3{
    width: 100%;
}
#label_down {
     
     font-size: 1vw;
     padding-left: 1vw;
     padding-right: 1vw;
     margin-left: 2vw;
     font-style: italic;
} 

.titre{
    font-size: 100%;
    text-align: center;
    color: #187cc2;
text-transform: capitalize;
    text-shadow: 1px 1px #60b1eb;

}
</style>
<script type="text/javascript">
    $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#img-upload1').attr('src', e.target.result);
                    $('#img-upload1').attr('style'," max-height:20vw; max-width :10vw;", e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img_profile").change(function(){
            readURL(this);
        });     
    });
        $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#img-upload2').attr('src', e.target.result);
                    $('#img-upload2').attr('style'," max-height:20vw; max-width :10vw;", e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img_carte").change(function(){
            readURL(this);
        });     
    });


</script>
</head>

<body>
    
    <div id="xs">

    <div class="navbarr">
        <div class="contain">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="WASSELLI.DZ"></a>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="index.php">ACCUEIL</a></li>
                    <li class="sub"><a href="#">ANNONCES</a>
                      <ul class="sub-content">
                        <li><a href="affichage_colis.php?from=user" >COLIS</a></li>
                        <li><a href="affichage_trajet.php?from=user">TRAJETS</a></li>
                      </ul>
                    </li>
                    <li><a href="#aid">AIDE</a></li>
                    <li><a href="#propo">A PROPOS</a></li>
                    <li><a href="#contct">CONTACT</a></li>
                </ul>
            </div>
            <?php 
            if ($_SESSION['nom']=="")
            echo '<div class="conx">
                <ul>
                    <li style="margin-left: 40px;"><a href="#" id="conx">CONNEXION</a></li>
                    <li style="margin-left: 40px;"><a href="inscription.php">INSCRIPTION</a></li>
                </ul>
            </div>';
            else {
            echo '<div class="pprof" id="proff">
                <ul>
                    <li style="margin-left: 40px;"><a title="Profil" id="prof" href="profile.php"><img src="images/profile.png"></a></li>
                    <li style="margin-left: 20px;"><a id="notifs" href="#"></a></li>
                    <li id="nottiff" class="not_st" style="position: relative; top:20px;left: -5px;"><a href="#" >
                    <div id="n">';
                            require "php/dbh.inc.php";
                            $e = 0 ;
                            $ii =$_SESSION["id_compte"];
                            $sql = "SELECT * FROM notification WHERE close = '$e' and vu = '$e' and id_compte_r='$ii'";
                            $result = mysqli_query($conn,$sql);
                            $count= mysqli_num_rows($result);
                            if($count!=0) echo "<div class='label label-danger'>$count</div>";
                        echo'</div>
                        <form id="v" method="get" action="php/notif_utilisateur.php">
                        </form></a></li>
                    <li style="margin-left: 40px;"><a href="php/logout.php" class="dcx"><i class="fas fa-sign-out-alt" style="font-size: 14px;"></i>&nbsp;&nbsp;DECONNEXION</a></li>
                </ul>
            </div>'; } ?>
        </div>
    </div>
 
    
    

    <div class="cnx" style="z-index: 53;"><!--Connexion-->
        <h2 class="l3" style="color: #fff; padding-top: 40px;"><b>Connexion</b></h2> 
        <form method="post" class="connex" action="php/login.php">
            <p id="eml" class="msg_err" style="color: #fff; font-size: 12px; margin-left: 30px; margin-top:-15px;display: none;">Veuillez vérifier votre e-mail!</p>
            <p id="mdp" class="msg_err" style="color: #fff; font-size: 12px; margin-left: 30px; margin-top:-15px; display: none;">Veuillez vérifier votre mot de passe!</p>
            <input type="email" name="email" placeholder="E-mail" id="mail" required />
            <input type="password" name="password" placeholder="Mot de passe" required />
            <input type="submit" id="sct" value="Se connecter" />
        </form>
        <br>
        <p id="msg_psd"></p>
        <br><br><br><br><br><a href="oublier.php" style="color: #fff;margin-left: 35px;">Mot de passe oublié?</a>
        <div><p class="insc">Vous n'avez pas de compte? <a href="inscription.php"><strong>Inscrivez-vous</strong></a></p></div>
    </div>
    <div class="arrow"></div>


</div>

    <div class="slider_main" style="margin-top: 120px;"><!--Slider-->
    <div id="full-slider-wrapper">
    <div id="layerslider" style="width:100%;height:473px;">
        <!--Slide 1-->
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
            <img src="images/slide-bg1.jpg" class="ls-bg" alt="Slide background"/>
            
            <div class="ls-l videopreview" style="top:75px;left:-30px;white-space: nowrap;" data-ls="offsetxin:-200;durationin:2000;offsetxout:-200;">
            <img src="images/image.png" alt="" />
            </div>
                                
            <div class="ls-l" id="tt1" style="top:105px;left:70%;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l1" id="t1">Transportation des colis <br> entre particuliers</h2>
            </div>
                                
            <div class="ls-l" id="dpart" style="top:225px;left:70%;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" id="part"><b>PARTOUT EN ALGERIE!</b></h2>
            </div>
                                
            <div class="ls-l"  style="top:305px;left:540px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l3" id="quest">Vous voulez déposer une annonce?</h2>
            </div>                      
                                
            <div class="ls-l" id="dconx2" style="top:318px;left:960px;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <a href="#" class="boutton1" id="conx2">Connectez-vous</a>
            </div>

            <div class="ls-l" id="dtra" style="top:340px;left:70%;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <a href="form_trajet.php" class="boutton1" id="depotra" style="display: none;">J'ai un trajet</a>
            </div>

        </div>
        <!--Slide 2-->
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
            <img src="images/slide-bg2.jpg" class="ls-bg" alt="Slide background"/>

            <div class="ls-l" style="top:15px;left:50%;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l1"><b>Découvrez nos services</b></h2>
            </div>
            
            <img src="images/services.png" alt="" class="ls-l videopreview" style="width: 1000px;top:110px;left:50%;white-space: nowrap;" data-ls="offsetxin:-200;durationin:2000;offsetxout:-200;"/>

            <div class="ls-l" style="top:200px;left:35px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 32px;">Sécurisé</h2>
            </div>
            <div class="ls-l" style="top:200px;left:350px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 32px;">Assuré</h2>
            </div>
            <div class="ls-l" style="top:200px;left:645px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 32px;">Efficace</h2>
            </div>
            <div class="ls-l" style="top:200px;left:940px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 24px;">Demandes<br>Spéciales</h2>
            </div>

            <div class="ls-l" style="top:270px;left:12px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1500;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 16px;">Vos informations<br>ne s'afficheront que<br>pour les personnes<br>que vous choisissez via<br>demande/acceptation</h2>
            </div>
            <div class="ls-l" style="top:270px;left:335px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1500;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 16px;">Assurance<br>pour vos colis<br>en cas de perte<br>ou de destruction</h2>
            </div>
            <div class="ls-l" style="top:270px;left:600px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1500;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 16px;">Economisez votre<br>temps et votre<br>argent en utilisant<br>le service de transportation<br>entre particuliers</h2>
            </div>
            <div class="ls-l" style="top:270px;left:915px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1500;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2" style="font-size: 16px;">Votre colis demande<br>un maniement spécial?<br>Communiquez cela<br>à votre transporteur<br>dans vos annonces<br></h2>
            </div>
            
        </div>
        <!--Slide 3-->
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;" id="slideprem">
            <img src="images/slide-bg3.jpg" class="ls-bg" alt="Slide background"/>

            <div class="ls-l" style="top:50px;left:50%;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <h2 class="l2">Obtenez plus de services exclusivement avec notre offre</h2>
            </div>
                                
            <div class="ls-l" style="top:55%;left:50%;white-space: nowrap;" data-ls="offsetxin:0;delayin:1500;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <img src="images/prem.png" style="width:900px;">
            </div>

            <div class="ls-l" style="top:340px;left:50%;" data-ls="offsetxin:0;delayin:2000;easingin:easeInOutQuart;scalexin:0.7;scaleyin:0.7;offsetxout:-800;durationout:1000;">
            <a href="#prem" class="boutton1">En savoir plus</a>
            </div>
        </div>
    </div>
    </div> 
    </div>

    <div class="aide"><!--Comment ca marche?-->
    <div id="aid"></div>
    <br><br>
    <div class="container">

        <h2 style="text-align: center;"><b>Comment ça marche?</b></h2><br><br>

        <div class="gauche">
        <img src="images/t_1.png" height="400px" style="margin-top: 50px;" alt=""  class="wow bounceInLeft animated" data-wow-duration="1.5s" data-wow-offset="100" />
        </div>


        <div class="droite">
            
            <h3 style="color: #187cc2;">En tant qu'envoyeur de colis</h3>
            <h4 style="color: #187cc2;"><i class="fas fa-box"></i>&nbsp;&nbsp;Déposez votre annonce de colis:</h4> <p style="margin-left: 30px;">Remplissez un formulaire avec les informations nécessaires sur votre colis (lieux et dates d'envoie et du depôt, poids, taille... etc). Votre annonce s'affichera alors sur le site.</p>
            <h4 style="color: #187cc2;"><i class="fas fa-road"></i>&nbsp;&nbsp;Demandez des trajets:</h4> <p style="margin-left: 30px;">Recherchez et demandez les trajets que vous conviennent dans la page des annonces de trajets et attendez que votre transporteur accepte votre demande.</p>
            <h4 style="color: #187cc2;"><i class="fas fa-bell"></i>&nbsp;&nbsp;Recevez des demandes:</h4> <p style="margin-left: 30px;">Recevez des notifications et acceptez/refusez les demandes des transporteur pour transporter votre colis. Prenez garde de consulter la fiabilité de votre transporteur.</p>
            <h4 style="color: #187cc2;"><i class="fas fa-star"></i>&nbsp;&nbsp;Donnez un avis:</h4> <p style="margin-left: 30px;">Notez vos transporteurs et donnez votre avis sur votre experience sur le site.</p>

        </div>

        <div class="droite" style="width:390px;">
        <img src="images/t_2.png" height="400px" style="margin-top: 130px;" alt=""  class="wow bounceInRight animated" data-wow-duration="1.5s" data-wow-offset="100"  />
    </div>

        <div class="gauche" style="width:650px; margin-top: 50px;">
            <h3 style="color: #149210;">En tant que transporteur</h3>
            <h4 style="color: #149210;"><i class="fas fa-road"></i>&nbsp;&nbsp;Déposez votre annonce de trajet:</h4> <p style="margin-left: 30px;">Remplissez un formulaire avec les informations nécessaires sur votre trajet (lieux et dates du départ et d'arrivée, moyen de transport, arrêts, détour, poids et taille maximums... etc). Votre annonce s'affichera alors sur le site.</p>
            <h4 style="color: #149210;"><i class="fas fa-box"></i>&nbsp;&nbsp;Demandez des colis:</h4> <p style="margin-left: 30px;">Recherchez et demandez des colis pour transporter dans la page des annonces de colis et attendez que vos clients acceptent vos demandes.</p>
            <h4 style="color: #149210;"><i class="fas fa-bell"></i>&nbsp;&nbsp;Recevez des demandes:</h4> <p style="margin-left: 30px;">Recevez des notifications et acceptez/refusez les demandes de transportation de colis. Prenez garde de consulter la fiabilité de vos clients.</p>
            <h4 style="color: #149210;"><i class="fas fa-star"></i>&nbsp;&nbsp;Donnez un avis:</h4> <p style="margin-left: 30px;">Notez vos clients et donnez votre avis sur votre experience sur le site.</p>
        </div>  
    </div>
    </div>

    <div class="aide propos"><!--A propos-->
    <div id="propo"></div>
    <div class="container">
        <div class="droite" style="width:390px;">
        <img src="images/image.png" height="200px" style="margin-top: 30px;" alt=""  class="wow bounceInRight animated" data-wow-duration="1.5s" data-wow-offset="100"  />
    </div>
        <div class="gauche">
            <h2><b>à propos</b></h2>

            <h4 style="color: #000; font-size: 22px;">TRANSPORTATION DES COLIS ENTRE PARTICULIERS</h4>
            <p style="margin-left: 30px; font-size: 16px;">Ce service était la première forme de livraision des colis. Il est devenue encore plus efficace grâce aux moyens de transports et de communication d'aujourd'hui. Wasselli met en contact les voyageurs qui veulent rentabiliser leurs trajets avec les expéditeurs des colis avec le même trajet.</p>
            </div>

        </div><br><br>
        <div class="container">
            <h3 style="text-align: center;"><b>QUI SOMMES-NOUS?</b></h3>
            <p style="text-align: center; font-size: 16px;">Nous sommes des étudiants de l'Ecole Nationale Supérieure de l'Informatique (ESI, ex INI)</p><br>
                    
                   
                        <div class="g">
                        <span><img src="images/profile.png" width="100px" class="wow bounceInDown animated" data-wow-duration="1.5s" data-wow-offset="100"></span>
                        <h3 style="margin-bottom: 5px;">Imane BOUSDIRA</h3><p style="font-size: 16px;">(Chef du projet)</p>
                        <p style="font-size: 16px;">hi_bousdira@esi.dz</p>
                        
                        </div>
                        
                        <div class="m" style="top:127px;">
                        <span><img src="images/profile.png" width="100px" class="wow bounceInDown animated" data-wow-delay="0.2s" data-wow-duration="1.5s" data-wow-offset="100"></span>
                        <h3>Youcef OUARAB</h3><p style="font-size: 16px;">hy_ouarab@esi.dz</p>
                   
                        </div>
                        
                        <div class="d" style="margin-right: -50px;">
                        <span><img src="images/profile.png" width="100px" class="wow bounceInDown animated" data-wow-delay="0.4s" data-wow-duration="1.5s" data-wow-offset="100"></span>
                        <h3>Mohamed BENMAIZA</h3><p style="font-size: 16px;">hm_benmaiza@esi.dz</p>
             
                        </div>

        
       
        </div><br>
        <div class="container">
            
                        <div class="g">
                        <span><img src="images/profile.png" width="100px" class="wow bounceInDown animated" data-wow-delay="0.6s" data-wow-duration="1.5s" data-wow-offset="0"></span>
                        <h3>Younes BENICHOU</h3><p style="font-size: 16px;">hy_benichou@esi.dz</p>
                       
                        </div>
                        
                        <div class="m" style="top:0;">
                        <span><img src="images/profile.png" width="100px" class="wow bounceInDown animated" data-wow-delay="0.8s" data-wow-duration="1.5s" data-wow-offset="0"></span>
                        <h3>Ikram ABIDAT</h3><p style="font-size: 16px;">hi_abidat@esi.dz</p>
                   
                        </div>
                        
                        <div class="d">
                        <span><img src="images/profile.png" width="100px" class="wow bounceInDown animated" data-wow-delay="1s" data-wow-duration="1.5s" data-wow-offset="0"></span>
                        <h3>Yacine ADJAL</h3><p style="font-size: 16px;">hy_adjal@esi.dz</p>
             
                        </div>

        
       
        </div>
                  
    </div>
    

    <div class="table" id="comp" style="background-image: linear-gradient(to bottom right, #379ee6, #bce4ff);"><!--Table comparaison simple/premium-->
    <div id="prem"></div>
    <div class="container">
            <h2 style="color: #fff;"><b>Découvrez notre offre Premium</b></h2><br><br><br>
            <div class="inter">
            <div class="block wow bounceInLeft animated" data-wow-duration="1.5s" data-wow-offset="80">
                <div class="entete">
                    <h2>Simple</h2>
                </div>
                <ul>
                    <li>Sécurité<span><img src="images/i8.png"></span></li>
                    <li>Dépôt d'annonces<span><img src="images/i8.png"></span></li>
                    <li>Recevoir des demandes<span><img src="images/i8.png"></span></li>
                    <li>Priorité<span><img src="images/i9.png"></span></li>
                    <li id="inc1"><a href="inscription.php" class="boutton2">INSCRIRE</a></li>
                </ul>
                </div>
                    
                <div class="block wow bounceInRight animated" data-wow-duration="1.5s" data-wow-offset="80">
                <div class="entete">
                    <h2>Premium</h2>
                </div>
                <ul>
                    <li>Sécurité<span><img src="images/i8.png"></span></li>
                    <li>Dépôt d'annonces<span><img src="images/i8.png"></span></li>
                    <li>Recevoir des demandes<span><img src="images/i8.png"></span></li>
                    <li>Priorité<span><img src="images/i8.png"></span></li>
                    <li ><a id="inc2" href="inscription.php?prema=1" class="boutton2 boutton3">INSCRIRE</a></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $contact = include "contact.txt";
        $tel=$contact[0];
        $_mail=$contact[1];
        $fb=$contact[2];
        $twt=$contact[3];
        $ig=$contact[4];
        $snap=$contact[5];
    ?>
    

    <div class="contact" id="contact"><!--Contact-->
    <div id="contct"></div>
    <div class="container" >
        <h2><b>Contactez-nous</b></h2><br><br><br>
       
       <div class="gc">
            <img src="images/telephone.png" alt="Numero Tel.:"><span><?php echo $tel ?><br><br></span>
            <img src="images/email.png" alt="E-mail:"><span><?php echo $_mail ?><br><br></span>
        </div>
        <div class="mc">
            <img src="images/facebook.png" alt="Facebook:"><span><?php echo $fb ?><br><br></span>
            <img src="images/twitter.png" alt="Twitter:"><span><?php echo $twt ?><br><br></span>
       </div>
       <div class="dc">
            <img src="images/ig.png" alt="Instagram:"><span><?php echo $ig ?><br><br></span>
            <img src="images/snap.png" alt="Snapchat:"><span><?php echo $snap ?><br><br></span>
        </div>

    </div>
    </div>

    <div class="copy">
        <div class="container">
        
            
                    <a href="index.php" class="footer_logo"><img src="images/logo.png" alt="" height="50px" /></a>
                   
                    <div class="copyright">Copyright © 2019 - <a href="index.php">Wasselli.dz</a> </div>                     
        
        </div>
        </div>
    
</div>

    <div id="voir_plus_notif_refuse" style="width: 20vw;max-height: 20vw;z-index: 50;height: 20vw;" class="col-md-4 col-md-offset-4" >

        <span onclick='Closee()' class='glyphicon glyphicon-remove' id='remove'style='float:right;margin-right:1vw;'></span>
                </br>

        <div style="overflow-y: scroll;text-align: center;">
        <p style="text-align: center; ">Nous vous informe que votre demande premium a ete refusé</p>
        </br>
        <span id="cause" style="text-align: center;"></span></p>  
    </div>
    </div>
     <script type="text/javascript">
         function Closee()
         {
            $('#voir_plus_notif_refuse').hide(500);
            $('#insc_premium').hide(500);
            $('#xx').hide(500);
            $('#xs').css('opacity','1');

         }
     </script>
<script type="text/javascript">
                var x="<?php echo $_GET['format_invalid'] ?>"
                if (x=='yes')
                {
                    $('#insc_premium').show(500);
                    $('#format_invalid').text('Veuillez respecter le format des fichiers a importer');
                }
            </script>

<div id="insc_premium" class="col-md-4 col-md-offset-4" style="height:70%;"  >

                <span id='premium_inc' class='glyphicon glyphicon-remove' style='float:right;'></span>

        <div style="text-align: center;">
    <p id="format_invalid" class="col-md-offset-1" style="color: red;"></p>

    
    
    <form action="./premium.php" method="POST" id='form' enctype="multipart/form-data"  >
        <h1 style="text-shadow:2px -1px 2px rgba(33,75,206,0.67);text-align: center;font-size: 200%;">Inscription premium</h1>
            <?php
    if (isset($_SESSION['photo'])) {
        if ($_SESSION['photo']=="" || $_SESSION['photo']==null) {
            echo '        <div class="col-11  premium y ">
    <div class="form-group">
        <label class="label_champs">*Veuillez choisir une photo de profile</label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" name="img_profile" accept=".gif,.jpg,.jpeg,.png"id="img_profile"  >
                </span>
            </span>
            <input type="text" class="form-control prm_txt" readonly >
        </div>
    </div>
    <p id="profile_img" class=" error_premium "></p>
</div>';

            
        }
    }
    ?>

<div class="col-11 ">
    <div class="form-group">
        <label class="label_champs">*Veuillez metttre une photo de votre carte identité</label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file" >
                    Browse… <input type="file"name="img_carte" accept=".gif,.jpg,.jpeg,.png"id="img_carte" class="premium" >
                </span>
            </span>
            <input type="text" class="form-control prm_txt" readonly>
        </div>
         
    </div>
    <p id="carte_img" class="error_premium"></p>

</div>
<div class="input-group col-md-offset-3" >
                        <input type="button"  onclick="download(1)"name="s"id="down" style="left:20px;" value="Telecharger le contrat" >
                       
                    </div>

<div class="col-11 " >
    <div class="form-group">
        <label class="label_champs">*Veuillez metttre le contrat sous form d'un <strong>PDF</strong></label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file" >
                    Browse… <input type="file"name="contrat" accept=".pdf" class="premium"  id ="contrat" >
                </span>
            </span>
            <input type="text" class="form-control prm_txt" readonly>
        </div>
    </div>
    <p id="contrat_pdf" class="error_premium"></p>
</div>
        <div class="row y">
          <button type="submit" name="signup" id="signup"  style="background-color: #187cc2;"  class="center-block btn btn-primary btn-lg">Inscrire</button>
           
        </div>
         </form>
    </div>
</div>

    <script type="text/javascript"> 
        
        
        var nom="<?php echo $_SESSION['nom'] ?>";
        if (nom!=""){
           
            if ("<?php echo $_SESSION['photo'] ?>"!="") document.getElementById("prof").innerHTML="<img src='./img_profiles/<?php echo $_SESSION['photo']; ?>' >";
            
            $(".cnx").remove();

            document.getElementById("notifs").innerHTML="<li class='dropdown'> <img id='icon_notif' title='Notifications' src='images/notifs.png' style='height:35px;width:35px;' class='dropdown-toggle' data-toggle ='dropdown'><ul class='dropdown-menu notification-ul' ><li id='nonotif' class='notification-li'></li></ul></li>";


            var prenom="<?php echo $_SESSION['prenom'] ?>";
            var text = "Bienvenue<br><br><b>";
            
            document.getElementById("t1").innerHTML=text.concat(nom," ",prenom,"</b>");
            document.getElementById("tt1").style.top="50px";
            document.getElementById("tt1").style.left="70%";
            document.getElementById("conx2").innerHTML="J'ai un colis";
            document.getElementById("part").innerHTML="Déposez votre annonce maintenant!";
            document.getElementById("dpart").style.left="70%";
            document.getElementById("dpart").style.top="200px";
            document.getElementById("quest").innerHTML="";
            document.getElementById("dconx2").style.left="70%";
            document.getElementById("dconx2").style.top="280px";

            $("#conx2").attr({
                "id" : "depoco",
                "href" : "formulaire_colis.php"
            });
            $("#depotra").fadeIn();

            $("#inc1").fadeOut();
            document.getElementById("inc2").innerHTML="inscrire";


            $("#inc2").attr({
                "href":"#"
            });

        } 
    </script>
        <script >
        $('#signup').click(function(){    
                        var img_profile = document.getElementById("img_profile");
                var img_cart=document.getElementById("img_carte");
                var contra =document.getElementById("contrat");                   
            if (img_profile.value=='') {$('#form').submit(false);$("#profile_img").text("Veuillez choisir une photo de profile");}
            else 
            {
                if (img_cart.value=='') {$('#form').submit(false);$("#carte_img").text("Veuillez inserer une photo de votre carte d'identité");}
                else 
                {
                    if(contra.value==''){$('#form').submit(false);$("#contrat_pdf").text("Veuillez inserer le contrat rempli");}
                    else{  
                           $(document).ready(function(){
                             $("#form").submit();
});
                                             
                        }
                }
            }  
             });
    </script>
<script  >
    function download(x){
                   var button = $("input[type=button]").val();
                $.post("php/download.php", { download : button ,type:x},
                function(data) {             
                
            });}

                   
            </script>
    <script type="text/javascript">
$('#inc2').click(function(){
    var x ="<?php echo $_SESSION['email'] ?>";
    if (x!=''){
    $('#insc_premium').show(500);}
    else 
    {
        
    }
});
$('#premium_inc').click(function(){
    $('#insc_premium').hide(500);
    $('#img-upload1').attr('src','');
    $('#img_profile').val('');
    $('.prm_txt').val('');
     $('#img-upload2').attr('src','');
    $('#img_carte').val('');
    $('.prm_txt').val('');
    $('#contrat').val('');
    $('.prm_txt').val('');
});

    </script>

    <!--Scrtipts-->
    <script>
        $('#sct').click(function(){

                var email =document.getElementById("email");
                
                var password =document.getElementById("password");

                email.setCustomValidity('');
               
                 password.setCustomValidity('');
                
                if (email.value =='') {email.setCustomValidity('Veuillez remplir ce champs');  }
                else
                { email.setCustomValidity('');
                    if(password.value==''){password.setCustomValidity('Veuillez remplir ce champs');}
                    else {
                        password.setCustomValidity('');
                        

                                        }
                                }
                                
                
           });
    </script>

<script type="text/javascript">
        $(function() {
            $(window).scroll(function() {
                if($(this).scrollTop() >= 200) {
                    $('.navbarr').addClass("fixx");    
                } else {
                   $('.navbarr').removeClass("fixx");
                }
            }); 
        });
    </script> 
    



    <script type="text/javascript">
        $('.dropdown-menu').click(function(e){
                e.stopPropagation();
   

        });
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 132
                        }, 2000);
                    return false;
                    }
                }
            });
        });
    </script>
        
    <script type="text/javascript">
        $(document).ready(function() {
            if($(window).width() <= 1200){
                $(function() {
                    $('a[href*=#]:not([href=#])').click(function() {
                        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                            var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                            if (target.length) {
                                $('html,body').animate({
                                    scrollTop: target.offset().top - 132
                                }, 2000);
                            return false;
                            }
                        }
                    });
                });
            }
        });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        var emai="<?php  echo $_SESSION['email'] ?>";
 if(emai!=''){
    function load(view,email){
            $.ajax({
            url :"fetch.php",
            data :{'view':view,'email':email},
            type:'POST',
            dataType :"json",
            success:function(data)
            {
                if (data.notification=="")
                {
                     $(".dropdown-menu").html();
                    $("#nonotif").html("pas de notification");   
                }
               else{
                $("#nonotif").attr("style","display:none");
             $(".dropdown-menu").html(data.notification);

                }
            }
        });
        }
        load('',emai);
        var intervalID = setInterval(function(){


            view='';
            email=emai;
        $.ajax({
            url :"fetch.php",
            data :{'view':view,'email':email},
            type:'POST',
            dataType :"json",
            success:function(data)
            {

                if (data.notification=="")
                {

                    $(".dropdown-menu").html();
                    $("#nonotif").html("pas de notification");   
                }
               else{
                $("#nonotif").attr("style","display:none");
             $(".dropdown-menu").html(data.notification);

                }
            },
    error: function (request, status, error) {
        alert(error);alert('0');
    }
        }); 
      
  },2000);
    }
    });
    function vuuu(id_notif)
    {
        var x="."+id_notif;
        if($('#glyphicon'+id_notif).hasClass('glyphicon-eye-open'))
        {
            $('#glyphicon'+id_notif).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            $("."+id_notif).css('background-color','');
           // vuuus(id_notif,1);
               $.ajax({
        url:'vu.php',
        type:'POST',
        data:{'id_notif':id_notif,'n':0},

    error: function (request, status, error) {
        alert(status);alert('4');
    }
    });

        }
        else 
        {
        $('#glyphicon'+id_notif).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            $("."+id_notif).css('background-color','#808080');
                           $.ajax({
        url:'vu.php',
        type:'POST',
        data:{'id_notif':id_notif,'n':1},

    error: function (request, status, error) {
        alert(status);alert('4');
    }
    });

        }
    }
    function vuuu_voir_plus(id_notif)
    {
        var x="."+id_notif;
        $('#glyphicon'+id_notif).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            $("."+id_notif).css('background-color','#808080');
                           $.ajax({
        url:'vu.php',
        type:'POST',
        data:{'id_notif':id_notif,'n':1},

    error: function (request, status, error) {
        alert(status);alert('4');
    }
    });s

        
    }


    </script>
    <script type="text/javascript">
        function VoirPlus(id_colis,code_notif,id_trajet,vu,id_notif,acc)
        {
                $.ajax({
                        url :'voir_plus.php',
                        data :{'id_coli':id_colis,'code_notif':code_notif,'id_trajet':id_trajet,'id_notif':id_notif},
                        type:'POST',
                        dataType :'json',
                        success:function(data)
                        {
                            $('#voir_plus_notif_refuse').show();
                            $('#cause').html('Les causes: </br>'+data.no_prem);
                            
                        },
                        error:function(a,b,c)
                        {
                            alert('error');
                        }
                    });
                            vuuu_voir_plus(id_notif);

        }
    </script>

    <script type="text/javascript">    function Close(id_notif)
    {
        
       $('.'+id_notif).attr('style','display:none;');
        $.ajax({
        url:'vu.php',
        type:'POST',
        data:{'id_notif':id_notif,'close':1},

    error: function (request, status, error) {
        alert(status);alert('5');
    }
    });}
    
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            var arrow = $(".arrow");
            var form = $(".cnx");
            var stat = false;
            $("#conx").click(function(event){
                event.preventDefault();
                if(stat==false){
                    arrow.fadeIn();
                    form.fadeIn();
                    stat=true;
                }else{
                    arrow.fadeOut();
                    form.fadeOut();
                    stat=false;
                }
            })
            $("#conx2").click(function(event){
                event.preventDefault();
                if(stat==false){
                    arrow.fadeIn();
                    form.fadeIn();
                    stat=true;
                }else{
                    arrow.fadeOut();
                    form.fadeOut();
                    stat=false;
                }
            })
        })
    </script>
             
        
    <script>
        jQuery("#layerslider").layerSlider({
            responsive: false,
            responsiveUnder: 1100,
            layersContainer: 1100,
            skin: 'fullwidth',
            hoverPrevNext: false,
            skinsPath: 'layerslider/skins/'
        });
    </script>   

    <script type="text/javascript">
        var message="<?php echo $_GET['message'] ?>"; 
        var arrow = $(".arrow");
        var form = $(".cnx");
        if (message!=""){
            arrow.fadeIn();
            form.fadeIn();
            if (message=="eml"){
                $("#eml").fadeIn();
            }
            if (message=="mdp"){
                $("#mdp").fadeIn();
            }
        }
    </script>

    <script type="text/javascript">
        var prem="<?php echo $_SESSION['prem'] ?>";
        if(prem=="true"){
            $("#slideprem").remove();
            $("#comp").remove();           
        }
    </script>

    <script>
        wow = new WOW(
          {
            animateClass: 'animated',
            offset:       100
          }
        );
        wow.init();
        document.getElementById('moar').onclick = function() {
          var section = document.createElement('section');
          section.className = 'section--purple wow fadeInDown';
          this.parentNode.insertBefore(section, this);
        };
        </script>
</body>
</html>
