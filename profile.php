<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

<?php session_start(); require 'php/dbh.inc.php';

    if (!isset($_SESSION['der_page_'])) $_SESSION['der_page_']=1;
    if (!isset($_SESSION['id_compte'])) $_SESSION['id_compte']=NULL;
    if(!isset($_GET['msg'])) $_GET['msg']="";

    $dev=0;
    $from="user";

    if ((!isset($_GET['id']))&&(!isset($_GET['from']))) {
        if ($_SESSION['id_compte']) {
            $id_profil=$_SESSION['id_compte'];
            $nom_profil=$_SESSION['nom'];
            $prenom_profil=$_SESSION['prenom'];
        } else {
            header('location: page_introuvable.php');
        }
    } else if ((isset($_GET['id']))&&(isset($_GET['from']))) {
        $id_profil=$_GET['id'];
        if (($_GET['from']=="admin")||($_GET['from']=="user")) $from=$_GET['from']; else header('location: page_introuvable.php');
        if ($ligne=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM compte WHERE id_compte=".$id_profil." AND supp=0"))) {
            $nom_profil=$ligne['nom'];
            $prenom_profil=$ligne['prenom'];
            if (($from=="user")&&($_SESSION['id_compte'])&&(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM deverouille WHERE (id_compte1=".$id_profil." AND id_compte2=".$_SESSION['id_compte'].") OR (id_compte2=".$id_profil." AND id_compte1=".$_SESSION['id_compte'].") limit 1"))>0)) $dev=1;
            if (($from=="admin")&&((!isset($_SESSION['nom_admin']))||($_SESSION['nom_admin']==""))) $from="user";
        } else {
            header('location: page_introuvable.php');
        }
    } else {
        header('location: page_introuvable.php');
    }

?>

	<!--CSS-->
    <!--CSS Principal--><link rel="stylesheet" href="css/style.css" type="text/css">
    <!--CSS Profil--><link rel="stylesheet" type="text/css" href="css/style_profil2.css?version=1">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="css/all.css" type="text/css">
     <link rel="stylesheet" href="css/font-awesome.css" type="text/css">

    <link rel="stylesheet" type="text/css" href="css/profil.css?version=4" />
    <!--JS--><script src="js/jquery.js" type="text/javascript"></script>
    <!--Bib JQuery--><script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/monJqueryA.js?version=2" type="text/javascript"></script>
    <link rel="icon" href="images/icon.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<title><?php echo $nom_profil.' '.$prenom_profil ?> - Wasselli.dz</title>

    <style type="text/css">
        .adm {
            text-decoration: none;
            padding: 10px 25px;
            background-color: #187cc2;
            color: #fff;
            font-size: 13px;
            transition: 0.5s; -webkit-transition:0.5s;
        }
        .adm:hover {
            text-decoration: none;
            background-color: #666;
            color: #fff;
            transition: 0.5s; -webkit-transition:0.5s;
        }

        .dmd{
            float:right;
            width:120px;
            height:25px;
            text-align:center;
            font-size:13px;
            color:#187cc2;
            font-weight:normal;
            text-transform:uppercase;
            line-height:25px;
            margin:0 0 0 0;
            border: 1px solid #187cc2;
            border-radius:5px; -webkit-border-radius:5px;
            transition:0.5s; -webkit-transition:0.5s;
            background:transparent;
            text-decoration:none;
            margin-right: 10px;
            margin-top: 10px;
            }

        .dmdtrajet {
            border: 1px solid #149210;
            color: #149210;
        }

        .dmdsupp {
            border: 1px solid #d63031;
            color: #d63031;
        }

        .dmd:hover{
            text-decoration:none;
            background: #187cc2;
            border:1px solid #187cc2;
            color:#fff;
            }

        .dmdtrajet:hover {
            text-decoration:none;
            background: #149210;
            border:1px solid #149210;
            color:#fff;
        }

        .dmdsupp:hover {
            text-decoration:none;
            background: #d63031;
            border:1px solid #d63031;
            color:#fff;
        }

        .droite {
        float: right;
        width:200px;
        height: 100%;
        text-align: left;
    }

    .milieu {
        display: inline-block;
        text-align: center;
        margin-top: -15px;
        margin-left: 70px;
    }

    .gauche {
        float: left;
        width:200px;
        height: 100%;
        text-align: right;
    }

    .depart {
        font-size: 24px;
        text-transform: uppercase;
        text-align: right;
        display: inline-block;
    }

    .moyen {
        width: 300px;

    }

    .arrivee {
        font-size: 24px;
        text-transform: uppercase;

    }
    </style>

</head>
<body>
<?php
                            require "php/dbh.inc.php";
                            date_default_timezone_set('Africa/Algiers');
                                $date_jour =  date('Y-m-d');

                             $echec = ' SELECT * FROM colis where `date_depot` < \''.$date_jour.'\' ';
                             $result_echec = mysqli_query($conn,$echec);
                             if(mysqli_num_rows($result_echec)>0){
                               while($row_echec = mysqli_fetch_array($result_echec) ){
                                 $ss = 'UPDATE `colis` SET `etat`=\'echec\' WHERE `id_colis` = '.$row_echec['id_colis'].' AND etat="annonce" ';
                                 $s = mysqli_query($conn,$ss);
                               }
                             }
                            $echec = ' SELECT * FROM trajets_non_reguliers where `date_depart` < \''.$date_jour.'\' ';
                              $result_echec = mysqli_query($conn,$echec);
                              if(mysqli_num_rows($result_echec)>0){
                                while($row_echec = mysqli_fetch_array($result_echec) ){
                                  $ss = 'UPDATE `trajet` SET `etat`=\'echec\' WHERE `id_trajet` = '.$row_echec['id_trajet'].' AND etat="annonce" ';
                                  $s = mysqli_query($conn,$ss);
                                }
                              }
?>


<div id="banieres" style="position: absolute; top:0; left:50%; transform: translate(-50%,0);">
	<div class="navbarr" id="ban_norm">
        <div class="contain">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="WASSELLI.DZ"></a>
            </div>
            <?php
            if (!$_SESSION['id_compte']) echo'<div class="nav" style="left: 50%;">';
            else echo'<div class="nav" style="left: 55%;">';
            ?>
                <ul>
                    <li><a href="index.php">ACCUEIL</a></li>
                    <li class="sub"><a href="#">ANNONCES</a>
                      <ul class="sub-content">
                        <li><a href="affichage_colis.php?from=user" target="_blank">COLIS</a></li>
                        <li><a href="affichage_trajet.php?from=user" target="_blank">TRAJETS</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            <?php
            if (!$_SESSION['id_compte'])
            echo '<div class="conx">
                <ul>
                    <li style="margin-left: 40px;"><a href="#" id="conx">CONNEXION</a></li>
                    <li style="margin-left: 40px;"><a href="inscription.php">INSCRIPTION</a></li>
                </ul>
            </div>';
            else {
            echo '<div class="pprof" id="proff">
                <ul>
                    <li style="margin-left: 40px;"><a id="prof" onclick="der_page(1)" href="profile.php"><img src="images/profile.png"></a></li>
                    
                    <li style="margin-left: 40px;"><a href="php/logout.php" class="dcx"><i class="fas fa-sign-out-alt" style="font-size: 14px;"></i>&nbsp;&nbsp;DECONNEXION</a></li>
                </ul>
            </div>'; } ?>
        </div>
    </div>

    <div class="navbarr" style="display: none;" id="ban_admin"><!--Baniere admin-->
        <div class="contain">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="WASSELLI.DZ"></a>
            </div>
            <div class="nav" style="left: 48%;">
                <ul>
                    <li><a href="index.php">ACCUEIL</a></li>
                    <li><a href="#">ANNONCES</a>
                    <ul class="sub-content">
                        <li><a href="affichage_colis.php?from=admin" target="_blank">COLIS</a></li>
                        <li><a href="affichage_trajet.php?from=admin" target="_blank">TRAJETS</a></li>
                      </ul>
                  </li>
                </ul>
            </div>
            <div class="pprof" id="proff">
                <ul>
                    <li style="margin-left: 40px;"><a class="adm" onclick="der_page(1)" href="admin/administration.php" id="admin">ADMINISTRATION</a></li>
                    <li style="margin-left: 40px;"><a href="php/logout_admin.php" class="dcx" id="decon"><i class="fa fa-sign-out" style="font-size: 14px;"></i>&nbsp;&nbsp;DECONNEXION</a></li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="cnx" style="z-index: 53;"><!--Connexion-->
        <h2 class="l3" style="color: #fff; padding-top: 40px;">Connexion</h2>
        <form method="post" class="connex" action="php/login.php">
            <p id="eml" class="msg_err" style="color: #fff; font-size: 12px; margin-left: 30px; margin-top:-15px;display: none;">Veuillez vérifier votre e-mail!</p>
            <p id="mdp" class="msg_err" style="color: #fff; font-size: 12px; margin-left: 30px; margin-top:-15px; display: none;">Veuillez vérifier votre mot de passe!</p>
            <input type="email" name="email" placeholder="E-mail" id="mail" required />
            <input type="password" name="password" placeholder="Mot de passe" required />
            <input type="submit" id="sct" value="Se connecter" />
        </form>
        <br>
        <p id="msg_psd"></p>
        <div><p class="insc">Vous n'avez pas de compte? <a href="inscription.php"><strong>Inscrivez-vous</strong></a></p></div>
    </div>
    <div class="arrow"></div>


<div id="page_profil" style="position: absolute; top:160px; left:50%; transform: translate(-50%,0);">


<div id="hist" style="position: absolute; top: -100px; left: 300px; display: none;">
 <div class="list" style="margin-bottom: 50px; width: 600px;margin-top:120px;">
 <h2 style="margin-bottom: 20px; margin-left: -50px;">Historique de <b><?php echo $nom_profil.' '.$prenom_profil ?>:</b></h2>
<?php
    $result_c = mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND (etat='arrive' OR etat='echec') AND supp=0 ORDER BY date_annonce DESC");
    $result_t = mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND (etat='arrive' OR etat='echec') AND supp=0 ORDER BY date_annonce DESC");
    $ligne_c=NULL; $ligne_t=NULL;
    if (mysqli_num_rows($result_c)>0) $ligne_c=mysqli_fetch_array($result_c);
    if (mysqli_num_rows($result_t)>0) $ligne_t=mysqli_fetch_array($result_t);
    if (($ligne_c==NULL)&&($ligne_t==NULL)) echo "<p style='text-align:center;'><i>cette personne n'a aucune historique</i></p>";
    else {
        $arrive_c=mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='arrive' AND supp=0");
        $echec_c=mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='echec' AND supp=0");
        $arrive_t=mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='arrive' AND supp=0");
        $echec_t=mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='echec' AND supp=0");
        echo '
        <h4>'.$prenom_profil.' a envoyé:</h4>
        <p style="font-size:16px; margin-left:50px;"><b>'.mysqli_num_rows($result_c).'</b> colis dont: <b>'.mysqli_num_rows($arrive_c).'</b> ont arrivé avec succès et <b>'.mysqli_num_rows($echec_c).'</b> ont échoué d\'arriver</p>';
        echo '<h4>'.$prenom_profil.' a fait:</h4>
        <p style="font-size:16px; margin-left:50px;"><b>'.mysqli_num_rows($result_t).'</b> trajets dont: <b>'.mysqli_num_rows($arrive_t).'</b> ont terminé avec succès et <b>'.mysqli_num_rows($echec_t).'</b> ont terminé avec échec</p><br><br>';
    }
?>
</div>
</div>

<div id="anns" style="position: absolute; top: 200px; left: 300px; display: none;">
<div class="list" style="margin-bottom: 50px; width: 600px;">
<h2 style="margin-bottom: 20px; margin-left: -50px;">Annonces par <b><?php echo $nom_profil.' '.$prenom_profil ?>:</b></h2>
<?php
    $result_c = mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='annonce' AND supp=0 ORDER BY date_annonce DESC");
    $result_t = mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='annonce' AND supp=0 ORDER BY date_annonce DESC");
    $ligne_c=NULL; $ligne_t=NULL;
    if (mysqli_num_rows($result_c)>0) $ligne_c=mysqli_fetch_array($result_c);
    if (mysqli_num_rows($result_t)>0) $ligne_t=mysqli_fetch_array($result_t);
    if (($ligne_c==NULL)&&($ligne_t==NULL)) echo "<p style='text-align:center;'><i>cette personne n'a aucune annonce</i></p>";
    while (($ligne_c)||($ligne_t)) {
        if ($ligne_c['date_annonce']>$ligne_t['date_annonce']) {
            $result = mysqli_query($conn, "SELECT * FROM trajet WHERE id_trajet=".$ligne_c['id_trajet']." limit 1");
            if (!$result) die('Could not query');
            else {
                $ligne=mysqli_fetch_array($result);
                echo '<div class="annonce" style="width:550px;">
                        <div class="titrec"><i class="fas fa-box"></i>&nbsp;&nbsp;Annonce Colis</div>
                            <p class="datep">Déposée le: '.$ligne_c['date_annonce'].'</p>';
                            if ((isset($_SESSION['nom']))&&($_SESSION['nom'])&&($from=="user"))
                                echo '<a class="dmd" href="choix_trajet.php?id_colis='.$ligne_c["id_colis"].'&id_compte='.$ligne_c["id_compte_e"].' " target="_blank" >Demander</a>';
                            else if ((isset($_SESSION['nom_admin']))&&($_SESSION['nom_admin'])&&($from="admin"))
                                echo '<a class="dmd dmdsupp" href="#" onclick="supp(1,'.$ligne_c['id_colis'].',\'profiladmin\')">Supprimer</a>';
                            else
                                echo '<a class="dmd" href="#" onclick="connecter()" >Demander</a> ';

                            echo '<br><p class="ann_nom" href="#"><b>'.$ligne_c['nom'].'</b></p><br>';
                            if (!$ligne_c['photo']) echo '<img src="images/colis.png" class="img_colis" style="width:140px; height:140px;">';
                            else echo '<img src="'.$ligne_c['photo'].'" class="img_colis" style="width:140px; height:140px;">';
                            echo '<label class="lab">Date d\'envoi:</label><p class="contenu">'.$ligne_c['date_envoi'].'</p>
                            <label class="lab">Date de dépôt:</label><p class="contenu">'.$ligne_c['date_depot'].'</p><br>
                            <label class="lab">Wilaya de départ:</label><p class="contenu">'.$ligne['lieux_depart'].'</p>
                            <label class="lab">Wilaya d\'arrivée:</label><p class="contenu">'.$ligne['lieux_arrive'].'</p><br>
                            <label class="lab">Adresse de départ:</label><p class="contenu">'.$ligne_c['adr_depart'].'</p><br>
                            <label class="lab">Adresse d\'arrivée:</label><p class="contenu">'.$ligne_c['adr_arrive'].'</p><br>
                            <label class="lab">Taille:</label><p class="contenu">'.$ligne_c['taille'].'</p>
                            <label class="lab">Poids:</label><p class="contenu">'.$ligne_c['poids'].' KG</p><br>';
                if ($ligne_c['demande_spec']) echo '<label class="lab">Demande speciale:</label><p class="contenu">'.$ligne_c['demande_spec'].'</p><br>';
                            echo '<label class="lab2">Prix: '.$ligne_c['tarif'].' DA</label><br><br></div>';
            }
            $ligne_c=mysqli_fetch_array($result_c);
        } else {
            echo '<div class="annonce" style="width:550px;">
                    <div class="titret"><i class="fas fa-road"></i>&nbsp;&nbsp;Annonce Trajet</div>
                    <p class="datep">Déposée le: '.$ligne_t['date_annonce'].'</p>';
                    if ((isset($_SESSION['nom']))&&($_SESSION['nom'])&&($from=="user"))
                                echo '<a class="dmd dmdtrajet" href="choix_colis.php?id_trajet='.$ligne_t["id_trajet"].'&id_compte='.$ligne_t["id_compte"].' " target="_blank" >Demander</a>';
                            else if ((isset($_SESSION['nom_admin']))&&($_SESSION['nom_admin'])&&($from="admin"))
                                echo '<a class="dmd dmdsupp" href="#" onclick="supp(2,'.$ligne_t['id_trajet'].',\'profiladmin\')">Supprimer</a>';
                            else
                                echo '<a class="dmd dmdtrajet" href="#" onclick="connecter()" >Demander</a> ';
                            echo '<br>';
                    $ligner=NULL; $lignenr=NULL;
                    $result = mysqli_query($conn, "SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
                    if (mysqli_num_rows($result)!=0) {
                        $lignenr=mysqli_fetch_array($result);
                        echo '<p class="ann_nom"><b>Trajet non régulier</b></p><br>';
                    } else {
                        $result = mysqli_query($conn, "SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
                        $ligner=mysqli_fetch_array($result);
                        echo '<p class="ann_nom"><b>Trajet régulier</b></p><br>';
                    }
                    echo '<div class="gauche" style="width:120px;"><p class="depart" style="font-size:18px;"><b>'.$ligne_t['lieux_depart'].'</b></p></div>
                    <div class="milieu" style="margin-left:30px; margin-top:-10px;"><img style="width:250px;" class="moyen" src="images/';
                        if ($ligne_t['moyen']=="Avion") echo 'avion2.png';
                        if ($ligne_t['moyen']=="Voiture") echo 'voiture2.png';
                        if ($ligne_t['moyen']=="Camionette/camion") echo 'camion2.png';
                        if ($ligne_t['moyen']=="Train") echo 'train2.png';
                        if ($ligne_t['moyen']=="Bateau") echo 'bateau2.png';
                    echo '" alt="Par '.$ligne_t['moyen'].'"></div>
                    <div class="droite" style="width:120px;"><p class="arrivee" style="font-size:18px;"><b>'.$ligne_t['lieux_arrive'].'</b></p></div>';

            echo '<br><br>';
            if ($lignenr) {
                echo '<div class="gauche" style="width:120px;"><label class="tlab" style="margin-left:0;">Départ:</label><br><p class="contenu">'.$lignenr['date_depart'].'</p></div>';
                if ($lignenr['date_retour']!="0000-00-00") echo '<div class="droite" style="width:120px;"><label class="tlab" style="margin-left:0;">Retour:</label><br><p class="contenu">'.$lignenr['date_retour'].'</p></div>';
            } else if ($ligner) {
                echo '<div class="gauche" style="width:120px;"><label class="tlab" style="margin-left:0;">Frequence:</label><br><p class="contenu">'.$ligner['frequence'].' fois par semaine</p><br>
                        <label class="tlab" style="margin-left:0;">Jour:</label><br><p class="contenu">'.$ligner['jour'].'</p></div><br><br>';
            }

            echo '<div class="milieu" style="margin-top:';
            if ($lignenr) echo '0';
            if ($ligner) echo '-40px';
            echo '; margin-left:10px;"><label class="tlab">Détour max:</label><p class="contenu">'.$ligne_t['detour_max'].'</p><br>';

            $arrets= mysqli_query($conn, "SELECT * FROM arrets WHERE id_trajet=".$ligne_t['id_trajet']);
            if (($arrets)&&(mysqli_num_rows($arrets)>0)) {
                echo '<label class="tlab">Arrêts:</label>';
                while ($arret=mysqli_fetch_array($arrets))
                    echo '<p class="contenu">'.$arret['arret'].';</p>';
                echo '<br>';
            }
            echo '<label class="tlab">Taille Max:</label><p class="contenu">'.$ligne_t['taille_max'].'</p>
                    <label class="tlab">Poids Max:</label><p class="contenu">'.$ligne_t['poids_max'].' KG</p></div>';
                    if ($ligner) echo '<br>';
                                echo '<br><br></div>';
            $ligne_t=mysqli_fetch_array($result_t);
        }
    }
?>

</div>
</div>

<div id="leprofil" style="position: absolute; top: 0; left: -550px;">

<div id="profil_reduit" style="display: none;">

   <?php
   $sql = "SELECT * from compte where id_compte = '".$id_profil."' limit 1";
   $result = mysqli_query($conn,$sql);
   $ligne = $result->fetch_assoc();
   if ($ligne['prem_accepte']==1) echo '<img src="./images/premium.png" alt="Premium" width="25px;" title="Utilisateur Premium" style="border-radius:50%;z-index:53;position:relative;top:100px;left:220px;">';

   ?>
   <div class="prof">
        <div class="prof-header">
            <?php
                if ($ligne['photo']!="") echo '<img src="./img_profiles/'.$ligne["photo"].'" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';
                else echo '<img src="./images/profile.png" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';
            ?>
        </div>
        <div class="prof-body">
            <p class="full-name"><?php echo $ligne['nom'].' '.$ligne['prenom'] ; ?></p>
        </div>
        <div class="prof-footer">
            <div class="col vr">
                <p><span class="count"><?php echo(makeRating($ligne['fiab_tran']));?></span> Fiabilité en tant que transporteur</p>
            </div>
            <div class="col">
                <p><span class="count"><?php echo(makeRating($ligne['fiab_env']));?></span> Fiabilité en tant qu’envoyeur</p>
            </div>
        </div>
    </div>

</div>




<div id="signaler" style="display: none;">
        <div class="prof">
    <div class="prof-footer">
            <div class="col vr">
                <form method="POST" action="php/signaler.php">
                <input type="text" name="ca" required="required" placeholder="cause du signale" autofocus required></input>
                <input type="submit" name="sign" value="signaler" class="boutton-demonde"></input>
                </form>
                <?php $_SESSION['si'] = $id_profil ?>
            </div>
        </div>
    </div>

</div>

<div id="profil_complet" style="display: none;">

   <?php

   $sql = "SELECT * from compte where id_compte = '".$id_profil."' limit 1";
   $result = mysqli_query($conn,$sql);
   $ligne = $result->fetch_assoc();

   $datet = $ligne['date_insc'];

   if ($ligne['prem_accepte']==1) echo '<img src="./images/premium.png" alt="Premium" width="25px;" title="Utilisateur Premium" style="border-radius:50%;z-index:53;position:relative;top:100px;left:220px;">';
   ?>
   <div class="prof">
        <div class="prof-header">
            <?php
                if ($ligne['photo']!="") echo '<img src="./img_profiles/'.$ligne["photo"].'" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';
                else echo '<img src="./images/profile.png" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';

            ?>
        </div>
        <div class="prof-body">
            <p class="full-name"><?php echo $ligne['nom'].' '.$ligne['prenom'] ; ?></p>

            <p class="username"><?php echo'Date d\'inscription :  '; echo $datet;?></p>
            <p><br/><a class="social-icon mail"><i class="fas fa-envelope-square"></i></a><?php echo $ligne['mail']; ?></p>
            <p><a class="social-icon tel"><i class="fas fa-phone-volume"></i></a>0<?php echo $ligne['tel']; ?></p>
            <p><a class="social-icon adresse"><i class="fas fa-home"></i></a><?php echo $ligne['adresse']; ?></p>

        </div>
        <div class="prof-footer">
            <div class="col vr">
                <p><span class="count"><?php echo(makeRating($ligne['fiab_tran']));?></span> Fiabilité en tant que transporteur</p>
            </div>
            <div class="col">
                <p><span class="count"><?php echo(makeRating($ligne['fiab_env']));?></span> Fiabilité en tant qu’envoyeur</p>
            </div>
        </div>
    </div>

</div>

<div id="don_prem" style="display: none;">
    <?php

   $sql = "SELECT * from premium where id_compte = '".$id_profil."' limit 1";
   $result = mysqli_query($conn,$sql);
   $ligne = $result->fetch_assoc();
   ?>
   <div class="prof">

        <div class="prof-footer">
            <div class="col vr">
                 <p>La carte d'identite</p>
                 <a href="./cartes_id/<?php echo $ligne['identite']; ?>"target=_blank>
                 <img src="./cartes_id/<?php echo $ligne['identite']; ?>" alt="Profile Image" style=" width: 50px; height: 50px;">
                  </a>
            </div>
            <div class="col">
                <p>Le contrat</p>
                <a href="./contrats/<?php echo $ligne['contrat']; ?>" target="_blank">PDF</a>

            </div>
        </div>
    </div>
</div>

<div class="prof" id="accref" style="display: none;">
        <div class="prof-body">
            <p>Demande Premium</p>
        </div>
        <div class="prof-footer">
            <div class="col vr">
               <form method="POST" action="php/acc_demande.php">
               	<input type="text" name="caus" Style='padding:5px;'></input>
                <input type="submit" name="acc" value="accepter" class="boutton-demonde"></input>
                </form>
                <?php $_SESSION['aa'] = $id_profil ?>
            </div>
            <div class="col">
                <form method="POST" action="php/ref_demande.php">
                <input type="text" name="caus" required="required" placeholder="Veuillez entrer la cause" autofocus required Style='padding:5px;'></input>
                <input type="submit" name="ref" value="refuser" class="boutton-demonde"></input>
                </form>
                <?php $_SESSION['rr'] = $id_profil ?>
            </div>
        </div>
</div>



<div id="supprimer" style="display: none;">
    <div class="prof">
    <div class="prof-footer">
            <div class="col vr">
                <a href="#" id="sup" class="boutton-supprimer">Supprimer</a>
                 <?php $_SESSION['ss'] = $id_profil ?>
            </div>
        </div>
    </div>
    <div id="conf_sup" style="display: none; margin-top:-218px; ">
        <div style="width: 400px; height: 190px; background-color: #000; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);opacity: 0.9">
            <br><h2 class="s1" style="font-size: 18px;color: #fff;opacity: 1;">Voulez-vous vraiment supprimer <br>ce compte?</h2><br>
            <a href="php/supp_uti.php" class="boutton" style="float: left; margin-left: 40px;opacity: 1;">Oui</a>
            <a href="#" class="boutton" id="annul_sup" style="margin-right: 40px;opacity: 1;">Non</a>
    </div>
</div>
       <script type="text/javascript">
    $(document).ready(function(){
    $("#sup").click(function(event){
                $("#conf_sup").fadeIn();
            })
            $("#annul_sup").click(function(event){
                $("#conf_sup").fadeOut();
            })
});
</script>
</div>

</div>

<div id="moi" style="display: none;">

    <div class="tabs">
        <ul>
            <li><a href="#" onclick="der_page(1)" id="tab_infos"><i class="fas fa-user"></i>&nbsp;&nbsp;Mon Profil</a></li>
            <li><a href="#" onclick="der_page(2)" id="tab_annonces"><i class="fas fa-box"></i>&nbsp;&nbsp;Mes Annonces</a></li>
            <li><a href="#" onclick="der_page(3)" id="tab_demandes"><i class="fas fa-road"></i>&nbsp;&nbsp;Mes Opérations</a></li>
            <li><a href="#" onclick="der_page(4)" id="tab_historique"><i class="fas fa-history"></i>&nbsp;&nbsp;Historique</a></li>

        </ul>

    </div>

    <div id="infos" class="page" style="display: none;">
        <div class="right2">
            <div>
                <?php
                $id= $_SESSION['id_compte'] ;
                $sql = "SELECT * from compte where id_compte = '".$id."' limit 1";
                $result = mysqli_query($conn,$sql);
                $ligne = $result->fetch_assoc();

                $datet = $ligne['date_insc'];


                if ($ligne['prem_accepte']==1) echo '<img src="./images/premium.png" alt="Premium" width="25px;" title="Utilisateur Premium" style="border-radius:50%;z-index:53;position:relative;top:100px;left:220px;">';

                ?>
                <div class="prof">
                  <div class="prof-header" id="photo_profile1" style="z-index:51;">
                     <?php
                        if ($ligne['photo']!="") echo '<img src="./img_profiles/'.$ligne["photo"].'" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';
                        else echo '<img src="./images/profile.png" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';

                    ?>
                  </div>

                <div class="prof-body">
                    <!-- <form action="php/photo.php" method="POST" enctype="multipart/form-data" >
                    <label class="input-group-btn">
                                    <span class="btn btn-success" style="float: right; margin-right:-60px; margin-top: -2px;background-color: #0984e3;">
                                        modifier la photo&hellip; <input type="file" name="photo" style="display: none;" >
                                    </span>
                                </label>
                                      <input type="submit" name="sphoto" value="valider" class="boutton" style=" margin-top: -5px;height: 40px;width: 120px;margin-right:10px;font-size: 12px;">

                            </form> -->
                            <form method="POST" enctype="multipart/form-data" >
                    <!-- <div class="input-group" style="display:flex; justify-content:center;">
                    <label class="input-group-btn">
                                    <span class="btn btn-success" style="float: right; margin-right:-60px; margin-top: -2px;background-color: #0984e3;">
                                        modifier la photo&hellip; <input type="file" name="photo" style="display: none;" >
                                    </span>
                                </label> -->
                                      <!-- <input type="submit" name="sphoto" value="valider" class="boutton" style=" margin-top: -5px;height: 40px;width: 120px;margin-right:10px;font-size: 12px;"> -->
                                    <!-- </div> -->

<!-- style="display:flex ; justify-content:center; position:relative; left:50px;" -->
                                    <div class="input-group " >
                                        <label class="input-group-btn" >
                                            <span class="btn btn-success btn-sm" style="float:right; margin-right:-115px; margin-top : -2px;background-color:#0984e3;border-color:#0984e3;">
                                                Modifier la photo&hellip; <input type="file" id="photo_profile0" name="photo_profile0" style="display: none;" multiple />
                                            </span>
                                        </label>
                                        <input type="text" id="titre_photo" name="titre_photo" value="" onchange="photo()" hidden >
                                    </div>
                    </form>
                    <p class="username"><?php echo'Date d\'inscription :  '; echo $datet;?></p>
                 </div>

    			<form id="form_infos" method="post" action="php/modif_utilisateur.php">
    				<div><label>Nom:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="nom" value="<?php echo $_SESSION['nom']?>" disabled="true" id="chnom" required/></div>
    				<div><label>Prénom:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="prenom" value="<?php echo $_SESSION['prenom']?>" disabled="true" id="chpre" required/></div>
    				<div><label>E-mail:</label>&nbsp;&nbsp;&nbsp;<input type="email" name="email" value="<?php echo $_SESSION['email']?>" disabled="true" id="chmail" required/></div>
                    <div><label>Adresse:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="adresse" value="<?php echo $ligne['adresse']?>" disabled="true" id="chadresse" /></div>
                    <div><label>Telephone: </label>&nbsp;&nbsp;&nbsp;<input type="number" min="0" max="999999999" placeholder="0550...." pattern ="[0-9]{9,10}" step="1" name="tel" value="0<?php echo $ligne['tel']?>" disabled="true" id="chtel" required/></div>
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
    				<div id="conf" style="display: none;"><input type="submit" id="valid" value="Valider" class="boutton" style="margin-right:120px; margin-top: 35px;width:145px;height:41px;"/></div>
				</form>

            </div>
				<a href="#" id="modif" style="float: right; margin-right:120px; margin-top: 35px;" class="boutton">Modifier</a><br><br><br>

                <div id="donn_prem">

            </div>

            <div class="prof">
            <div class="prof-footer">
            <div class="col vr">
                <p><span class="count"><?php echo(makeRating($ligne['fiab_tran']));?></span> Fiabilité en tant que transporteur</p>
            </div>
            <div class="col">
                <p><span class="count"><?php echo(makeRating($ligne['fiab_env']));?></span> Fiabilité en tant qu’envoyeur</p>
            </div>
            </div>
            </div>

        <div id="sssup">
        <div class="prof">
        <div class="prof-footer">
            <div class="col vr">
                <a href="#" id="sup" class="boutton-supprimer">desactiver</a>
            </div>
        </div>
        </div>
        <br><br>
        <div id="conf_sup" style="display: none; margin-top:-218px; ">
        <div style="width: 400px; height: 190px; background-color: #000; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);opacity: 0.9">
            <br><h2 class="s1" style="font-size: 18px;color: #fff;opacity: 1;">Voulez-vous vraiment desactiver <br>votre compte?</h2><br>
            <a href="php/des_uti.php" class="boutton" style="float: left; margin-left: 40px;opacity: 1;">Oui</a>
            <a href="#" class="boutton" id="annul_sup" style="margin-right: 40px;opacity: 1;">Non</a>
        </div>
</div>

</div>

            </div>
        </div>


    </div>


<div id="annonces" class="page" style="display: none;">
<div class="list" style="margin-bottom: 50px;">
<?php
    $result_c = mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='annonce' AND supp=0 ORDER BY date_annonce DESC");
    $result_t = mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='annonce' AND poids_max != 0  AND supp=0 ORDER BY date_annonce DESC");
    $ligne_c=NULL; $ligne_t=NULL;
    if (mysqli_num_rows($result_c)>0) $ligne_c=mysqli_fetch_array($result_c);
    if (mysqli_num_rows($result_t)>0) $ligne_t=mysqli_fetch_array($result_t);
    if (($ligne_c==NULL)&&($ligne_t==NULL)) echo "<p style='text-align:center;'><i>vous n'avez aucune annonce</i></p>";
    while (($ligne_c)||($ligne_t)) {
        if ($ligne_c['date_annonce']>$ligne_t['date_annonce']) {
            $result = mysqli_query($conn, "SELECT * FROM trajet WHERE id_trajet=".$ligne_c['id_trajet']." limit 1");
            if (!$result) die('Could not query');
            else {
                $ligne=mysqli_fetch_array($result);
                echo '<div class="annonce">
                        <div class="titrec"><i class="fas fa-box"></i>&nbsp;&nbsp;Annonce Colis</div>
                            <p class="ann_nom"><b>'.$ligne_c['nom'].'</b></p>
                            <p class="datep">Déposée le: '.$ligne_c['date_annonce'].'</p>
                            <a class="but" href="#" onclick="supp(1,'.$ligne_c['id_colis'].',\'profiluser\')" style="float:right;margin:10px; " title="Supprimer"><img src="images/del.png" width="20px;"></a>
                            <a class="but" href="modif_colis.php?id='.$ligne_c['id_colis'].'" style="float:right;margin-top:10px;" title="Modifier"><img src="images/edit.png" width="20px;"></a><br>';
                            if (!$ligne_c['photo']) echo '<img src="images/colis.png" class="img_colis">';
                            else echo '<img src="'.$ligne_c['photo'].'" class="img_colis">';
                            echo '<label class="lab">Date d\'envoi:</label><p class="contenu">'.$ligne_c['date_envoi'].'</p><br>
                            <label class="lab">Date de dépôt:</label><p class="contenu">'.$ligne_c['date_depot'].'</p><br>
                            <label class="lab">Wilaya de départ:</label><p class="contenu">'.$ligne['lieux_depart'].'</p>
                            <label class="lab">Adresse de départ:</label><p class="contenu">'.$ligne_c['adr_depart'].'</p><br>
                            <label class="lab">Wilaya d\'arrivée:</label><p class="contenu">'.$ligne['lieux_arrive'].'</p>
                            <label class="lab">Adresse d\'arrivée:</label><p class="contenu">'.$ligne_c['adr_arrive'].'</p><br>
                            <label class="lab">Taille:</label><p class="contenu">'.$ligne_c['taille'].'</p><br>
                            <label class="lab">Poids:</label><p class="contenu">'.$ligne_c['poids'].' KG</p><br>';
                if ($ligne_c['demande_spec']) echo '<label class="lab">Demande speciale:</label><p class="contenu">'.$ligne_c['demande_spec'].'</p><br>';
                echo '<label class="lab2">Prix: '.$ligne_c['tarif'].' DA</label><br><br>';
                $r=mysqli_query($conn,"SELECT * FROM notification WHERE id_colis=".$ligne_c['id_colis']." AND id_compte_r=".$id_profil." AND code_notif='0' AND close=0");
                if (mysqli_num_rows($r)>0) echo '<b style="margin-left:20px; color:#187cc2;">Ce colis a été demandé par quelqu\'un. Vérifiez vos notifications pour en savoir plus.</b><br><br>';
                echo '</div>';
            }
            $ligne_c=mysqli_fetch_array($result_c);
        } else {
            echo '<div class="annonce">
                    <div class="titret"><i class="fas fa-road"></i>&nbsp;&nbsp;Annonce Trajet</div>
                    <p class="datep">Déposée le: '.$ligne_t['date_annonce'].'</p>
                    <a class="but" href="#" onclick="supp(2,'.$ligne_t['id_trajet'].',\'profiluser\')" style="float:right;margin:10px; " title="Supprimer"><img src="images/del.png" width="20px;"></a>
                    <a class="but" href="modif_trajet.php?id='.$ligne_t['id_trajet'].'" style="float:right;margin-top:10px;" title="Modifier"><img src="images/edit.png" width="20px;"></a><br>';
                    $ligner=NULL; $lignenr=NULL;
                    $result = mysqli_query($conn, "SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
                    if (mysqli_num_rows($result)!=0) {
                        $lignenr=mysqli_fetch_array($result);
                        echo '<p class="ann_nom"><b>Trajet non régulier</b></p><br>';
                    } else {
                        $result = mysqli_query($conn, "SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
                        $ligner=mysqli_fetch_array($result);
                        echo '<p class="ann_nom"><b>Trajet régulier</b></p><br>';
                    }
                    echo '<div class="gauche"><p class="depart"><b>'.$ligne_t['lieux_depart'].'</b></p></div>
                    <div class="milieu"><img class="moyen" src="images/';
                        if ($ligne_t['moyen']=="Avion") echo 'avion2.png';
                        if ($ligne_t['moyen']=="Voiture") echo 'voiture2.png';
                        if ($ligne_t['moyen']=="Camionette/camion") echo 'camion2.png';
                        if ($ligne_t['moyen']=="Train") echo 'train2.png';
                        if ($ligne_t['moyen']=="Bateau") echo 'bateau2.png';
                    echo '" alt="Par '.$ligne_t['moyen'].'"></div>
                    <div class="droite"><p class="arrivee"><b>'.$ligne_t['lieux_arrive'].'</b></p></div>';

            echo '<br><br><br>';
            if ($lignenr) {
                echo '<div class="gauche"><label class="tlab" style="margin-left:0;">Départ:</label><p class="contenu">'.$lignenr['date_depart'].'</p></div>';
                if ($lignenr['date_retour']!="0000-00-00") echo '<div class="droite"><label class="tlab" style="margin-left:0;">Retour:</label><p class="contenu">'.$lignenr['date_retour'].'</p></div>';
            } else if ($ligner) {
                echo '<div class="gauche"><label class="tlab" style="margin-left:0;">Frequence:</label><p class="contenu">'.$ligner['frequence'].' fois par semaine</p><br>
                        <label class="tlab" style="margin-left:0;">Jour:</label><p class="contenu">'.$ligner['jour'].'</p></div>';
            }

            echo '<div class="milieu" style="margin-top:0;"><label class="tlab">Détour max:</label><p class="contenu">'.$ligne_t['detour_max'].'</p><br>';

            $arrets= mysqli_query($conn, "SELECT * FROM arrets WHERE id_trajet=".$ligne_t['id_trajet']);
            if (($arrets)&&(mysqli_num_rows($arrets)>0)) {
                echo '<label class="tlab">Arrêts:</label>';
                while ($arret=mysqli_fetch_array($arrets))
                    echo '<p class="contenu">'.$arret['arret'].';</p>';
                echo '<br>';
            }
            echo '<label class="tlab">Taille Max:</label><p class="contenu">'.$ligne_t['taille_max'].'</p>
                    <label class="tlab">Poids Max:</label><p class="contenu">'.$ligne_t['poids_max'].' KG</p></div><br>';
                    $r=mysqli_query($conn,"SELECT * FROM notification WHERE id_trajet=".$ligne_t['id_trajet']." AND id_compte_r=".$id_profil." AND code_notif='3' AND close=0");
                if (mysqli_num_rows($r)>0) echo '<b style="margin-left:10px; color:#149210;">Ce trajet a été demandé par quelqu\'un. Vérifiez vos notifications pour en savoir plus.</b><br>';
            echo '<br></div>';

            $ligne_t=mysqli_fetch_array($result_t);

        }
    }
?>
</div>
</div>



<div id="demandes" class="page" style="display: none;">
<div class="list" style="margin-bottom: 50px;">
<?php
    $result_c = mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='accepte' AND supp=0 ORDER BY date_annonce DESC");
    $result_t = mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='accepte' AND supp=0 ORDER BY date_annonce DESC");
    $ligne_c=NULL; $ligne_t=NULL;
    if (mysqli_num_rows($result_c)>0) $ligne_c=mysqli_fetch_array($result_c);
    if (mysqli_num_rows($result_t)>0) $ligne_t=mysqli_fetch_array($result_t);
    if (($ligne_c==NULL)&&($ligne_t==NULL)) echo "<p style='text-align:center;'><i>vous n'avez aucune opération</i></p>";
    while (($ligne_c)||($ligne_t)) {
        if ($ligne_c['date_annonce']>$ligne_t['date_annonce']) {
            $result = mysqli_query($conn, "SELECT * FROM trajet WHERE id_trajet=".$ligne_c['id_trajet']." limit 1");

                $ligne=mysqli_fetch_array($result);
                echo '<div class="annonce">
                        <div class="titrec"><i class="fas fa-box"></i>&nbsp;&nbsp;Suivre Mon Colis</div>
                            <p class="ann_nom"><b>'.$ligne_c['nom'].'</b></p>
                            <p class="datep">Déposée le: '.$ligne_c['date_annonce'].'</p><br>';
                            if (!$ligne_c['photo']) echo '<img src="images/colis.png" class="img_colis">';
                            else echo '<img src="'.$ligne_c['photo'].'" class="img_colis">';
                            echo '<label class="lab">Date d\'envoi:</label><p class="contenu">'.$ligne_c['date_envoi'].'</p><br>
                            <label class="lab">Date de dépôt:</label><p class="contenu">'.$ligne_c['date_depot'].'</p><br>
                            <label class="lab">Adresse de départ:</label><p class="contenu">'.$ligne_c['adr_depart'].'</p><br>
                            <label class="lab">Adresse d\'arrivée:</label><p class="contenu">'.$ligne_c['adr_arrive'].'</p><br>
                            <label class="lab">Taille:</label><p class="contenu">'.$ligne_c['taille'].'</p><br>
                            <label class="lab">Poids:</label><p class="contenu">'.$ligne_c['poids'].' KG</p><br>';
                if ($ligne_c['demande_spec']) echo '<label class="lab">Demande speciale:</label><p class="contenu">'.$ligne_c['demande_spec'].'</p><br>';
                echo '<label class="lab2">Prix: '.$ligne_c['tarif'].' DA</label><br><br>
                    <div class="titret"><i class="fas fa-road"></i>&nbsp;&nbsp;Son Trajet</div>
                        <p class="ann_nom">De <b>'.$ligne['lieux_depart'].'</b> vers <b>'.$ligne['lieux_arrive'].'</b></p>';
                
                $result3 = mysqli_query($conn, "SELECT * FROM compte WHERE id_compte=".$ligne['id_compte']." limit 1");
                $ligne3=mysqli_fetch_array($result3);
                $result2 = mysqli_query($conn, "SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne['id_trajet']." limit 1");
                if (mysqli_num_rows($result2)!=0) {
                    $ligne2=mysqli_fetch_array($result2);

                    date_default_timezone_set("Africa/Algiers");
                    $ddd=date("Y-m-d H:i:s");
                    if ($ddd<$ligne2['date_depart'])  echo '<a href="#" onclick="ann(2,'.$ligne_c['id_colis'].','.$ligne_c['id_trajet'].')" class="annul">Annuler ce trajet</a>'; echo '<br>'; 
                        
                    echo '<p class="ann_nom"><b>Trajet non régulier</b></p>
                        <label class="lab">Par:</label><a class="profi" href="profile.php?id='.$ligne3['id_compte'].'&from=user" target="_blank">&nbsp;'.$ligne3['prenom'].' '.$ligne3['nom'].'</a><br>
                        <label class="tlab">Date de départ:<p class="contenu">'.$ligne2['date_depart'].'</p></label>';
                if ($ligne2['date_retour']!="0000-00-00") echo '<label class="tlab">Date de retour:<p class="contenu">'.$ligne2['date_retour'].'</p></label>';
                } else {
                $result2 = mysqli_query($conn, "SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne['id_trajet']." limit 1");
                $ligne2=mysqli_fetch_array($result2);

                echo '<a href="#" onclick="ann(2,'.$ligne_c['id_colis'].','.$ligne_c['id_trajet'].')" class="annul">Annuler ce trajet</a><br>
                    <p class="ann_nom"><b>Trajet régulier</b></p>
                        <label class="lab">Par:</label><a class="profi" href="profile.php?id='.$ligne3['id_compte'].'&from=user" target="_blank">&nbsp;'.$ligne3['prenom'].' '.$ligne3['nom'].'</a><br>
                        <label class="tlab">Frequence:<p class="contenu">'.$ligne2['frequence'].' fois par semaine</p></label>
                        <label class="tlab">Jour:<p class="contenu">'.$ligne2['jour'].'</p></label>';
                }

            echo '<label class="tlab">Moyen De Transport:<p class="contenu">'.$ligne['moyen'].'</p></label>
            <label class="tlab">Détour Max:<p class="contenu">'.$ligne['detour_max'].'</p></label>';

                $arrets= mysqli_query($conn, "SELECT * FROM arrets WHERE id_trajet=".$ligne['id_trajet']);
                if (($arrets)&&(mysqli_num_rows($arrets)>0)) {
                    echo '<label class="tlab">Arrêts:';
                    while ($arret=mysqli_fetch_array($arrets))
                        echo '<p class="contenu">'.$arret['arret'].';</p>';
                    echo '</label>';
                }
                        echo '<label class="tlab">Taille Max:<p class="contenu">'.$ligne['taille_max'].'</p></label>
                        <label class="tlab">Poids Max:<p class="contenu">'.$ligne['poids_max'].' KG</p></label><br><br></div>';


            $ligne_c=mysqli_fetch_array($result_c);
        } else {

            echo '<div class="annonce">
                    <div class="titret"><i class="fas fa-road"></i>&nbsp;&nbsp;Suivre Mon Trajet</div>
                        <p class="ann_nom">De <b>'.$ligne_t['lieux_depart'].'</b> vers <b>'.$ligne_t['lieux_arrive'].'</b></p>
                        <p class="datep">Déposée le: '.$ligne_t['date_annonce'].'</p><br>';
            $result = mysqli_query($conn, "SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
            
            if (mysqli_num_rows($result)!=0) {
                $reg=0;
                $ligne=mysqli_fetch_array($result);
                $dd=$ligne['date_depart'];
                echo '<p class="ann_nom"><b>Trajet non régulier</b></p><br>
                        <label class="tlab">Date De Départ:<p class="contenu">'.$ligne['date_depart'].'</p></label>';
                if ($ligne['date_retour']!="0000-00-00") echo '<label class="tlab">Date De Retour:<p class="contenu">'.$ligne['date_retour'].'</p></label>';
            } else {
                $reg=1;
                $result = mysqli_query($conn, "SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
                $ligne=mysqli_fetch_array($result);
                $dd=$ligne['jour'];
                echo '<p class="ann_nom"><b>Trajet régulier</b></p><br>
                        <label class="tlab">Frequence:<p class="contenu">'.$ligne['frequence'].' fois par semaine</p></label>
                        <label class="tlab">Jour:<p class="contenu">'.$ligne['jour'].'</p></label>';
            }
            echo '<label class="tlab">Moyen De Transport:<p class="contenu" style="font-weight:normal;">'.$ligne_t['moyen'].'</p></label>
            <label class="tlab">Détour Max:<p class="contenu">'.$ligne_t['detour_max'].'</p></label>';

            $arrets= mysqli_query($conn, "SELECT * FROM arrets WHERE id_trajet=".$ligne['id_trajet']);
            if (($arrets)&&(mysqli_num_rows($arrets)>0)) {
                echo '<label class="tlab">Arrêts:';
                while ($arret=mysqli_fetch_array($arrets))
                    echo '<p class="contenu">'.$arret['arret'].';</p>';
                echo '</label>';
            }
            echo '<label class="tlab">Taille Max:<p class="contenu">'.$ligne_t['taille_max'].'</p></label>
                    <label class="tlab">Poids Max:<p class="contenu">'.$ligne_t['poids_max'].' KG</p></label><br><br>';



            $result=mysqli_query($conn, "SELECT * FROM colis WHERE id_trajet=".$ligne_t['id_trajet']." AND etat='accepte'");
            if (mysqli_num_rows($result)==0) {
                if ($reg) {
                    echo '<label class="tlab" style="float:right;"><a href="php/reg_fin.php?id='.$ligne_t['id_trajet'].'" class="ett ech">Terminer Trajet</a></label><br><br>';
                }
            }
            
            while ($ligne=mysqli_fetch_array($result)) {
                $result3 = mysqli_query($conn, "SELECT * FROM compte WHERE id_compte=".$ligne['id_compte_e']." limit 1");
                $ligne3=mysqli_fetch_array($result3);
                echo '<div class="titrec"><i class="fas fa-box"></i>&nbsp;&nbsp;Colis A Transporter</div>
                            <p class="ann_nom"><b>'.$ligne['nom'].'</b></p>
                            <label class="lab">Par:</label><a class="profi" href="profile.php?id='.$ligne3['id_compte'].'&from=user" target="_blank">&nbsp;'.$ligne3['prenom'].' '.$ligne3['nom'].'</a>';
                
                
                     

                date_default_timezone_set("Africa/Algiers");
                    $ddd=date("Y-m-d H:i:s");
            
                if ($ddd<$dd) echo '<label class="tlab" style="float:right;margin-top:100px;"><a href="#" onclick="ann(1,'.$ligne['id_colis'].','.$ligne['id_trajet'].')" class="ett ech">Annuler ce colis</a></label><br>';
                else echo '<label class="tlab" style="float:right;margin-top:100px;"><a href="php/modif_etat.php?id='.$ligne['id_colis'].'&vers=2" class="ett">Arrivé</a><a href="php/modif_etat.php?id='.$ligne['id_colis'].'&vers=3" class="ett ech">Echec</a></label><br>';
                
           
                
                
                if (!$ligne['photo']) echo '<img src="images/colis.png" class="img_colis">';
                            else echo '<img src="'.$ligne['photo'].'" class="img_colis">';
                echo '<label class="lab">Date d\'envoi:</label><p class="contenu">'.$ligne['date_envoi'].'</p><br>
                            <label class="lab">Date de dépôt:</label><p class="contenu">'.$ligne['date_depot'].'</p><br>
                            <label class="lab">Adresse de départ:</label><p class="contenu">'.$ligne['adr_depart'].'</p><br>
                            <label class="lab">Adresse d\'arrivée:</label><p class="contenu">'.$ligne['adr_arrive'].'</p><br>
                            <label class="lab">Taille:</label><p class="contenu">'.$ligne['taille'].'</p><br>
                            <label class="lab">Poids:</label><p class="contenu">'.$ligne['poids'].' KG</p><br>';
                if ($ligne['demande_spec']) echo '<label class="lab">Demande speciale:</label><p class="contenu">'.$ligne['demande_spec'].'</p><br>';
                echo '<label class="lab2">Prix: '.$ligne['tarif'].' DA</label><br><br>';
            }
            echo '</div>';
            $ligne_t=mysqli_fetch_array($result_t);
        }
    }
?>
</div>
</div>

    <div id="historique" class="page" style="display: none;">

        <div class="list" style="margin-bottom: 50px;">
<?php
    $result_c = mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND (etat='arrive' OR etat='echec') AND supp=0 ORDER BY date_annonce DESC");
    $result_t = mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND (etat='arrive' OR etat='echec') AND supp=0 ORDER BY date_annonce DESC");
    $ligne_c=NULL; $ligne_t=NULL;
    if (mysqli_num_rows($result_c)>0) $ligne_c=mysqli_fetch_array($result_c);
    if (mysqli_num_rows($result_t)>0) $ligne_t=mysqli_fetch_array($result_t);
    if (($ligne_c==NULL)&&($ligne_t==NULL)) echo "<p style='text-align:center;'><i>vous n'avez aucune historique</i></p>";
    else {
        $arrive_c=mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='arrive' AND supp=0");
        $echec_c=mysqli_query($conn, "SELECT * FROM colis WHERE id_compte_e=".$id_profil." AND etat='echec' AND supp=0");
        $arrive_t=mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='arrive' AND supp=0");
        $echec_t=mysqli_query($conn, "SELECT * FROM trajet WHERE id_compte=".$id_profil." AND etat='echec' AND supp=0");
        echo '<div id="resume" style="position:absolute;top:0;left:50%;transform:translate(-50%,0%);">
        <h4>Vous avez envoyé:</h4>
        <p style="font-size:16px; margin-left:50px;"><b>'.mysqli_num_rows($result_c).'</b> colis dont: <b>'.mysqli_num_rows($arrive_c).'</b> ont arrivé avec succès et <b>'.mysqli_num_rows($echec_c).'</b> ont échoué d\'arriver</p>';
        echo '<h4>Vous avez fait:</h4>
        <p style="font-size:16px; margin-left:50px;"><b>'.mysqli_num_rows($result_t).'</b> trajets dont: <b>'.mysqli_num_rows($arrive_t).'</b> ont terminé avec succès et <b>'.mysqli_num_rows($echec_t).'</b> ont terminé avec échec</p><br><br>';

        echo '<a href="#" id="detail" onclick="document.getElementById(\'histo\').style.display=\'\'; this.style.display=\'none\'">Afficher l\'historique en détailles</a></div>';
    }
?>

<div id="histo" style="display: none;margin-top: 200px;">

   <?php while (($ligne_c)||($ligne_t)) {
        if ($ligne_c['date_annonce']>$ligne_t['date_annonce']) {
            $result = mysqli_query($conn, "SELECT * FROM trajet WHERE id_trajet=".$ligne_c['id_trajet']." limit 1");

                $ligne=mysqli_fetch_array($result);
                echo '<div class="annonce">
                        <div class="titreg"><i class="fas fa-box"></i>&nbsp;&nbsp;Mon Colis</div>
                            <p class="ann_nom"><b>'.$ligne_c['nom'].'</b></p>
                            <p class="datep">Déposée le: '.$ligne_c['date_annonce'].'</p>
                            <label class="lab2" style="margin-top:10px;">Etat: '.$ligne_c['etat'].'</label><br>';
                            if (!$ligne_c['photo']) echo '<img src="images/colis.png" class="img_colis">';
                            else echo '<img src="'.$ligne_c['photo'].'" class="img_colis">';
                            echo '<label class="lab">Date d\'envoi:</label><p class="contenu">'.$ligne_c['date_envoi'].'</p><br>
                            <label class="lab">Date de dépôt:</label><p class="contenu">'.$ligne_c['date_depot'].'</p><br>
                            <label class="lab">Adresse de départ:</label><p class="contenu">'.$ligne_c['adr_depart'].'</p><br>
                            <label class="lab">Adresse d\'arrivée:</label><p class="contenu">'.$ligne_c['adr_arrive'].'</p><br>
                            <label class="lab">Taille:</label><p class="contenu">'.$ligne_c['taille'].'</p><br>
                            <label class="lab">Poids:</label><p class="contenu">'.$ligne_c['poids'].' KG</p><br>';
                if ($ligne_c['demande_spec']) echo '<label class="lab">Demande speciale:</label><p class="contenu">'.$ligne_c['demande_spec'].'</p><br>';
                echo '<label class="lab2">Prix: '.$ligne_c['tarif'].' DA</label><br><br>';
                if ($ligne['moyen']) {
                    echo '<div class="titreg"><i class="fas fa-road"></i>&nbsp;&nbsp;Son Trajet</div>
                        <p class="ann_nom">De <b>'.$ligne['lieux_depart'].'</b> vers <b>'.$ligne['lieux_arrive'].'</b></p><br>';
                $result3 = mysqli_query($conn, "SELECT * FROM compte WHERE id_compte=".$ligne['id_compte']." limit 1");
                $ligne3=mysqli_fetch_array($result3);
            $result2 = mysqli_query($conn, "SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne['id_trajet']." limit 1");
            if (mysqli_num_rows($result2)!=0) {
                $ligne2=mysqli_fetch_array($result2);
                echo '<p class="ann_nom"><b>Trajet non régulier</b></p>
                        <label class="lab">Par:</label><a class="profi" href="profile.php?id='.$ligne3['id_compte'].'&from=user" target="_blank">&nbsp;'.$ligne3['prenom'].' '.$ligne3['nom'].'</a><br>
                        <label class="tlab">Date de départ:<p class="contenu">'.$ligne2['date_depart'].'</p></label>';
                if ($ligne2['date_retour']!="0000-00-00") echo '<label class="tlab">Date de retour:<p class="contenu">'.$ligne2['date_retour'].'</p></label>';
            } else {
                $result2 = mysqli_query($conn, "SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne['id_trajet']." limit 1");
                $ligne2=mysqli_fetch_array($result2);
                echo '<p class="ann_nom"><b>Trajet régulier</b></p>
                        <label class="lab">Par:</label><a class="profi" href="profile.php?id='.$ligne3['id_compte'].'&from=user" target="_blank">&nbsp;'.$ligne3['prenom'].' '.$ligne3['nom'].'</a><br>
                        <label class="tlab">Fréquence:<p class="contenu">'.$ligne2['frequence'].' fois par semaine</p></label>
                        <label class="tlab">Jour:<p class="contenu">'.$ligne2['jour'].'</p></label>';
            }
            echo '<label class="tlab">Moyen De Transport:<p class="contenu">'.$ligne['moyen'].'</p></label>
            <label class="tlab">Détour Max:<p class="contenu">'.$ligne['detour_max'].'</p></label>';

                $arrets= mysqli_query($conn, "SELECT * FROM arrets WHERE id_trajet=".$ligne['id_trajet']);
                if (($arrets)&&(mysqli_num_rows($arrets)>0)) {
                    echo '<label class="tlab">Arrêts:';
                    while ($arret=mysqli_fetch_array($arrets))
                        echo '<p class="contenu">'.$arret['arret'].';</p>';
                    echo '</label>';
                }
                        echo '<label class="tlab">Taille Max:<p class="contenu">'.$ligne['taille_max'].'</p></label>
                        <label class="tlab">Poids Max:<p class="contenu">'.$ligne['poids_max'].' KG</p></label><br><br></div>';
                    }

            $ligne_c=mysqli_fetch_array($result_c);
        } else {
            echo '<div class="annonce">
                    <div class="titreg"><i class="fas fa-road"></i>&nbsp;&nbsp;Mon Trajet</div>
                        <p class="ann_nom">De <b>'.$ligne_t['lieux_depart'].'</b> vers <b>'.$ligne_t['lieux_arrive'].'</b></p>
                        <p class="datep">Déposée le: '.$ligne_t['date_annonce'].'</p>
                        <label class="lab2" style="margin-top:10px;">Etat: '.$ligne_t['etat'].'</label><br>';
            $result = mysqli_query($conn, "SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
            if (mysqli_num_rows($result)!=0) {
                $ligne=mysqli_fetch_array($result);
                echo '<p class="ann_nom"><b>Trajet non régulier</b></p><br>
                        <label class="tlab">Date de départ:<p class="contenu">'.$ligne['date_depart'].'</p></label>';
                if ($ligne['date_retour']!="0000-00-00") echo '<label class="tlab">Date de retour:<p class="contenu">'.$ligne['date_retour'].'</p></label>';
            } else {
                $result = mysqli_query($conn, "SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne_t['id_trajet']." limit 1");
                $ligne=mysqli_fetch_array($result);
                echo '<p class="ann_nom"><b>Trajet régulier</b></p><br>
                        <label class="tlab">Fréquence:<p class="contenu">'.$ligne['frequence'].' fois par semaine</p></label>
                        <label class="tlab">Jour:<p class="contenu">'.$ligne['jour'].'</p></label>';
            }
            echo '<label class="tlab">Moyen De Transport:<p class="contenu">'.$ligne_t['moyen'].'</p></label>
            <label class="tlab">Détour Max:<p class="contenu">'.$ligne_t['detour_max'].'</p></label>';

            $arrets= mysqli_query($conn, "SELECT * FROM arrets WHERE id_trajet=".$ligne['id_trajet']);
            if (($arrets)&&(mysqli_num_rows($arrets)>0)) {
                echo '<label class="tlab">Arrêts:';
                while ($arret=mysqli_fetch_array($arrets))
                    echo '<p class="contenu">'.$arret['arret'].';</p>';
                echo '</label>';
            }
            echo '<label class="tlab">Taille Max:<p class="contenu">'.$ligne_t['taille_max'].'</p></label>
                    <label class="tlab">Poids Max:<p class="contenu">'.$ligne_t['poids_max'].' KG</p></label><br>';
            $result=mysqli_query($conn, "SELECT * FROM colis WHERE id_trajet=".$ligne_t['id_trajet']);
            while ($ligne=mysqli_fetch_array($result)) {
                $result3 = mysqli_query($conn, "SELECT * FROM compte WHERE id_compte=".$ligne['id_compte_e']." limit 1");
                $ligne3=mysqli_fetch_array($result3);
                echo '<div class="titreg"><i class="fas fa-box"></i>&nbsp;&nbsp;Colis A Transporter</div>
                            <p class="ann_nom"><b>'.$ligne['nom'].'</b></p>
                            <label class="lab">Par:</label><a class="profi" href="profile.php?id='.$ligne3['id_compte'].'&from=user" target="_blank">&nbsp;'.$ligne3['prenom'].' '.$ligne3['nom'].'</a><br>';
                            if (!$ligne['photo']) echo '<img src="images/colis.png" class="img_colis">';
                            else echo '<img src="'.$ligne['photo'].'" class="img_colis">';
                            echo '<label class="lab">Date d\'envoi:</label><p class="contenu">'.$ligne['date_envoi'].'</p><br>
                            <label class="lab">Date de dépôt:</label><p class="contenu">'.$ligne['date_depot'].'</p><br>
                            <label class="lab">Adresse de départ:</label><p class="contenu">'.$ligne['adr_depart'].'</p><br>
                            <label class="lab">Adresse d\'arrivée:</label><p class="contenu">'.$ligne['adr_arrive'].'</p><br>
                            <label class="lab">Taille:</label><p class="contenu">'.$ligne['taille'].'</p><br>
                            <label class="lab">Poids:</label><p class="contenu">'.$ligne['poids'].' KG</p><br>';
                if ($ligne['demande_spec']) echo '<label class="lab">Demande speciale:</label><p class="contenu">'.$ligne['demande_spec'].'</p><br>';
                echo '<label class="lab2">Prix: '.$ligne['tarif'].' DA</label><br><br>';
            }
            echo '</div>';
            $ligne_t=mysqli_fetch_array($result_t);
        }
    }
?>
</div>
    </div>


</div>
</div>


</div>

<div id="supp_ann" style="display: none; z-index: 101;">
        <div style="position: fixed; height:100%; width: 100%; background: #000; opacity: 0.7;" ></div>
        <div style="width: 400px; height: 190px; background-color: #fff; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);">
            <br><h2 class="s1" style="font-size: 18px;">Voulez-vous vraiment supprimer cette annonce?</h2><br>
            <a href="#" class="boutton" id="conf_supp" style="float: left; margin-left: 40px;">Oui</a>
            <a href="#" class="boutton" id="annul_supp" style="margin-right: 40px;">Non</a>
    </div>

</div>

<div id="annul_ann" style="display: none; z-index: 101;">
        <div style="position: fixed; height: 100%; width: 100%; background: #000; opacity: 0.7;"></div>
        <div style="width: 400px; height: 190px; background-color: #fff; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%);">
            <br><h2 class="s1" style="font-size: 18px; ">Voulez-vous vraiment annuler <br>votre association avec ce <span style="font-size: 18px;" id="ct"></span>?</h2><br>
            <a href="#" class="boutton" id="conf_ann" style="float: left; margin-left: 40px;">Oui</a>
            <a href="#" class="boutton" id="annul_n" style="margin-right: 40px;">Non</a>
    </div>

</div>



<?php
    if (isset($_GET['noter'])) {
        if ($_GET['noter']==='1') {
            if (isset($_GET['id_noter'])) {
                $idn=$_GET['id_noter'];
                if ($lignen=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM colis WHERE id_colis=".$idn))) {
                    $t=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$lignen['id_trajet']." limit 1"));
                    if ($t['id_compte']==$_SESSION['id_compte']){
                        $ligneu=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM compte WHERE id_compte=".$lignen['id_compte_e']));
                        echo '<div id="noir" style="position: fixed; height:100%; width: 100%; background: #000; opacity: 0.7; z-index:1;"></div>';
                        echo '<div id="n'.$ligneu['id_compte'].'" style="width: 400px; height: 250px; background-color: #fff; border-radius: 20px; position: fixed; top:50%;left:50%; transform: translate(-50%,-50%); z-index:3;">
                            <br><h2 class="s1" style="font-size: 18px;">Prenez un moment pour noter<br><div style="padding-bottom:10px;"></div>'.$ligneu['prenom'].' '.$ligneu['nom'].'</h2>
                            <div style="float:left; margin-left:75px; margin-top:10px;">
                                <a href="#" class="star" onmouseover="star(5,'.$ligneu['id_compte'].')" onmouseout="nostar(5,'.$ligneu['id_compte'].')" onclick="fix(5,'.$ligneu['id_compte'].')" id="star'.$ligneu['id_compte'].'5"><img src="images/star.png"></a>
                                <a href="#" class="star" onmouseover="star(4,'.$ligneu['id_compte'].')" onmouseout="nostar(4,'.$ligneu['id_compte'].')" onclick="fix(4,'.$ligneu['id_compte'].')" id="star'.$ligneu['id_compte'].'4"><img src="images/star.png"></a>
                                <a href="#" class="star" onmouseover="star(3,'.$ligneu['id_compte'].')" onmouseout="nostar(3,'.$ligneu['id_compte'].')" onclick="fix(3,'.$ligneu['id_compte'].')" id="star'.$ligneu['id_compte'].'3"><img src="images/star.png"></a>
                                <a href="#" class="star" onmouseover="star(2,'.$ligneu['id_compte'].')" onmouseout="nostar(2,'.$ligneu['id_compte'].')" onclick="fix(2,'.$ligneu['id_compte'].')" id="star'.$ligneu['id_compte'].'2"><img src="images/star.png"></a>
                                <a href="#" class="star" onmouseover="star(1,'.$ligneu['id_compte'].')" onmouseout="nostar(1,'.$ligneu['id_compte'].')" onclick="fix(1,'.$ligneu['id_compte'].')" id="star'.$ligneu['id_compte'].'1"><img src="images/star.png"></a>
                                </div><br><br><br><br>
                                <a href="#" onclick="nn('.$ligneu['id_compte'].')" style="color:#187cc2; margin-left:70px;">Non, je ne veux pas noter cette personne.</a>
                        </div>';
                    }
                }
            }
        }
    }
?>


<script type="text/javascript">
    function supp(type, i, from) {
        document.getElementById("conf_supp").href="php/supp_ann.php?id=".concat(String(i),"&type=",String(type),"&from=",from);
        $("#supp_ann").fadeIn();

    }

    $("#annul_supp").click(function(){
        $("#supp_ann").fadeOut();
    });





    function ann(cas, ic, it) {
        if (cas===1) {document.getElementById("ct").innerHTML="colis";} else { document.getElementById("ct").innerHTML="trajet";}
        document.getElementById("conf_ann").href="php/annuler.php?cas=".concat(String(cas),"&id_colis=",String(ic),"&id_trajet=",String(it));
        $("#annul_ann").fadeIn();

    }

    $("#annul_n").click(function(event){
        $("#annul_ann").fadeOut();
    });



</script>



<script type="text/javascript">
    function fix(i,k) {
            for (var j=1;j<=i;j++) {
                document.getElementById("star".concat(String(k),String(j))).style.filter="grayscale(0%)";
            }
            for (j=1;j<=5;j++) {
                document.getElementById("star".concat(String(k),String(j))).setAttribute("onmouseover","");
                document.getElementById("star".concat(String(k),String(j))).setAttribute("onmouseout","");
                document.getElementById("star".concat(String(k),String(j))).setAttribute("onclick","");
            }
            $.post("php/noter.php", {note:i, id:k});
            setTimeout(function(){
                $("#n".concat(String(k))).fadeOut();
            },1000);

            setTimeout(function(){
                window.location="profile.php";
            },1000);

        }


        function star(i,k) {
            for (var j=1;j<=i;j++) {
                document.getElementById("star".concat(String(k),String(j))).style.filter="grayscale(0%)";
            }
        }

        function nostar(i,k) {
            for (var j=i;j>=1;j--) {
                document.getElementById("star".concat(String(k),String(j))).style.filter="grayscale(100%)";
            }
        }


        function nn(i) {
            $("#n".concat(String(i))).fadeOut();
            window.location="profile.php";
        }


    </script>





<script type="text/javascript">
	$(document).ready(function(){
			$("#modif").click(function(event){
				event.preventDefault();
				document.getElementById("chnom").disabled=false;
				document.getElementById("chpre").disabled=false;
				document.getElementById("chmail").disabled=false;
                document.getElementById("chadresse").disabled=false;
                document.getElementById("chtel").disabled=false;
				document.getElementById("chpas").disabled=false;
				$("#pass_rep").fadeIn();
				$("#modif").remove();
				$("#conf").fadeIn();
			})
			});
</script>




<script type="text/javascript">
        var nom="<?php echo $_SESSION['nom'] ?>";
        if (nom!=""){

            if ("<?php echo $_SESSION['photo'] ?>"!="") document.getElementById("prof").innerHTML="<img src='./img_profiles/<?php echo $_SESSION['photo']; ?>' >";

            document.getElementById("notifs").innerHTML="<li class='dropdown'> <img img id='icon_notif' title='Notifications' style='height:35px;width:35px;' src='images/notifs.png' class='dropdown-toggle' data-toggle ='dropdown'><ul class='dropdown-menu notification-ul' ><li id='nonotif' class='notification-li'></li></ul></li>";

        }
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
<script type="text/javascript">
    $(document).ready(function page(){
        var der="<?php echo $_SESSION['der_page_'] ?>";
        var css=".tabs ul li a{background:#187cc2;} .tabs ul li a:hover{background:#fff;}";
            if (der==1) {
                document.getElementById("annonces").style.display="none";
                document.getElementById("demandes").style.display="none";
                document.getElementById("historique").style.display="none";
                $("#infos").fadeIn();
                document.getElementById("tab_infos").style="background: #fff; color: #187cc2; border-bottom: 3px solid #187cc2;";
                document.getElementById("tab_annonces").style=css;
                document.getElementById("tab_demandes").style=css;
                document.getElementById("tab_historique").style=css;
            }
            if (der==2) {
                document.getElementById("infos").style.display="none";
                document.getElementById("demandes").style.display="none";
                document.getElementById("historique").style.display="none";
                $("#annonces").fadeIn();
                document.getElementById("tab_annonces").style.background="#fff";
                document.getElementById("tab_annonces").style.color="#187cc2";
                document.getElementById("tab_infos").style=css;
                document.getElementById("tab_demandes").style=css;
                document.getElementById("tab_historique").style=css;
            }
            if (der==3) {
                document.getElementById("infos").style.display="none";
                document.getElementById("historique").style.display="none";
                document.getElementById("annonces").style.display="none";
                $("#demandes").fadeIn();
                document.getElementById("tab_demandes").style.background="#fff";
                document.getElementById("tab_demandes").style.color="#187cc2";
                document.getElementById("tab_annonces").style=css;
                document.getElementById("tab_historique").style=css;
                document.getElementById("tab_infos").style=css;
            }
            if (der==4) {
                document.getElementById("infos").style.display="none";
                document.getElementById("annonces").style.display="none";
                document.getElementById("demandes").style.display="none";
                $("#historique").fadeIn();
                document.getElementById("tab_historique").style.background="#fff";
                document.getElementById("tab_historique").style.color="#187cc2";
                document.getElementById("tab_annonces").style=css;
                document.getElementById("tab_infos").style=css;
                document.getElementById("tab_demandes").style=css;
            }
        });
        </script>

<script type="text/javascript">
    $(document).ready(function(){


            $("#tab_infos").click(function(event){
                event.preventDefault();

                document.getElementById("annonces").style.display="none";
                document.getElementById("demandes").style.display="none";
                document.getElementById("historique").style.display="none";
                $("#infos").fadeIn();
                var css=".tabs ul li a{background:#187cc2;} .tabs ul li a:hover{background:#fff;}";
                document.getElementById("tab_infos").style="background: #fff; color: #187cc2; border-bottom: 3px solid #187cc2;";
                document.getElementById("tab_annonces").style=css;
                document.getElementById("tab_demandes").style=css;
                document.getElementById("tab_historique").style=css;


            })
            $("#tab_annonces").click(function(event){
                event.preventDefault();

                document.getElementById("infos").style.display="none";
                document.getElementById("demandes").style.display="none";
                document.getElementById("historique").style.display="none";
                $("#annonces").fadeIn();
                var css=".tabs ul li a{background:#187cc2;} .tabs ul li a:hover{background:#fff;}";
                document.getElementById("tab_annonces").style.background="#fff";
                document.getElementById("tab_annonces").style.color="#187cc2";
                document.getElementById("tab_infos").style=css;
                document.getElementById("tab_demandes").style=css;
                document.getElementById("tab_historique").style=css;


            })
            $("#tab_demandes").click(function(event){
                event.preventDefault();

                document.getElementById("infos").style.display="none";
                document.getElementById("historique").style.display="none";
                document.getElementById("annonces").style.display="none";
                $("#demandes").fadeIn();
                var css=".tabs ul li a{background:#187cc2;} .tabs ul li a:hover{background:#fff;}";
                document.getElementById("tab_demandes").style.background="#fff";
                document.getElementById("tab_demandes").style.color="#187cc2";
                document.getElementById("tab_annonces").style=css;
                document.getElementById("tab_historique").style=css;
                document.getElementById("tab_infos").style=css;


            })
            $("#tab_historique").click(function(event){
                event.preventDefault();

                document.getElementById("infos").style.display="none";
                document.getElementById("annonces").style.display="none";
                document.getElementById("demandes").style.display="none";
                $("#historique").fadeIn();
                var css=".tabs ul li a{background:#187cc2;} .tabs ul li a:hover{background:#fff;}";
                document.getElementById("tab_historique").style.background="#fff";
                document.getElementById("tab_historique").style.color="#187cc2";
                document.getElementById("tab_annonces").style=css;
                document.getElementById("tab_infos").style=css;
                document.getElementById("tab_demandes").style=css;


            })
        });
function der_page(i) {
            $.post("php/der_page_.php", { der : i });
        }

</script>


<script type="text/javascript">
    if ("<?php echo $_GET['msg'] ?>"=="email") setTimeout(function(){alert("L'email que vous venez de choisir existe déja!");},200);
</script>

<?php
function makeRating($rate, $bestvalue = 5) {
    $intrate=intval($rate);
    $decrate=(floatval($rate) - $intrate) * 100;
    $ratingBox  = '<!-- item AggregateRating -->' . PHP_EOL;
    $ratingBox .= '<p class="ratingBox" itemprop="aggregateRating" itemscope itemtype="http://schema.xyz/AggregateRating">' . PHP_EOL;
    $ratingBox .= '<span title="'. $rate .' / '. $bestvalue .'">' . PHP_EOL;
    for($i=0; $i<$bestvalue; ++$i) {
    $ratingBox .= '<svg height="16" width="16">' . PHP_EOL;
      if($i<$intrate) {
        $ratingBox .= '<polygon points="8,0 10.5,5 16,6 12,10 13,16 8,13 3,16 4,10 0,6 5.5,5" fill="Yellow" stroke="DarkKhaki" stroke-width=".5" />' . PHP_EOL;}
      elseif($i==$intrate && $decrate>0 ) {
        $ratingBox .= '<defs>' . PHP_EOL;
        $ratingBox .= '<linearGradient id="starGradient">' . PHP_EOL;
        $ratingBox .= '<stop offset="'. $decrate .'%" stop-color="Yellow"/>' . PHP_EOL;
        $ratingBox .= '<stop offset="'. $decrate .'%" stop-color="LightGrey"/>' . PHP_EOL;
        $ratingBox .= '</linearGradient>' . PHP_EOL;
        $ratingBox .= '</defs>' . PHP_EOL;
        $ratingBox .= '<polygon points="8,0 10.5,5 16,6 12,10 13,16 8,13 3,16 4,10 0,6 5.5,5" fill="url(#starGradient)" stroke="DarkKhaki" stroke-width=".5" />' . PHP_EOL;
      }
      else {
        $ratingBox .= '<polygon points="8,0 10.5,5 16,6 12,10 13,16 8,13 3,16 4,10 0,6 5.5,5"  fill="LightGrey" stroke="DimGray" stroke-width=".5" />' . PHP_EOL;}
    $ratingBox .= '</svg>' . PHP_EOL;}
    $ratingBox .= '</span>' . PHP_EOL;
    $ratingBox .= '<span style="display:none;"><span itemprop="ratingValue" class="rating" title="'. $rate .'">'. $rate .'</span>';
    $ratingBox .= '<span > / </span><span itemprop="bestRating">'. $bestvalue .'</span></span>' . PHP_EOL;
    $ratingBox .= '</p>' . PHP_EOL;
    $ratingBox .= '<!-- end of item -->' . PHP_EOL;
    return $ratingBox;
  }
?>


<?php

$prema="false";
$prema=0;
    $sql = "select * from premium where id_compte = '".$id_profil."' limit 1";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1) {
            $prema="true";
        }

    $sql = "select * from compte where id_compte = '".$id_profil."' limit 1";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1) {
            $l=mysqli_fetch_array($result);
            $premb=$l['prem_accepte'];
        }

?>

<script type="text/javascript">
    function connecter() {
      alert('Veuillez connecter');
    }
</script>

<script type="text/javascript">

        var profil="<?php echo $id_profil ?>";
        var visiteur="<?php echo $_SESSION['id_compte'] ?>";
        var prema="<?php echo $prema ?>";
        var premb="<?php echo $premb ?>";
        var dev="<?php echo $dev ?>";
        var from="<?php echo $from ?>";


        var ban_admin=$("#ban_admin").clone(); $("#ban_admin").remove();
        var profil_complet=$("#profil_complet").clone(); $("#profil_complet").remove();
        var signaler=$("#signaler").clone(); $("#signaler").remove();
        var supprimer=$("#supprimer").clone(); $("#supprimer").remove();
        var don_prem=$("#don_prem").clone(); $("#don_prem").remove();
        var accref=$("#accref").clone(); $("#accref").remove();
        var moi=$("#moi").clone(); $("#moi").remove();

       if (from==="admin") {
                $("#ban_norm").remove();
                $("#banieres").append(ban_admin);
                $("#ban_admin").fadeIn(0);
                $("#leprofil").append(profil_complet);
                $("#profil_complet").fadeIn();
                if (prema=="true") {
                    $("#leprofil").append(don_prem);
                    $("#don_prem").fadeIn();
                    if (premb==0) {
                        $("#leprofil").append(accref);
                        $("#accref").fadeIn();
                    }
                }
                $("#leprofil").append(supprimer);
                $("#supprimer").fadeIn();
                $("#hist").fadeIn();
                $("#anns").fadeIn();

        } else if (from==="user") {
                if (profil===visiteur) {
                    $("#page_profil").append(moi);
                    $("#moi").fadeIn();
                    if (prema=="true") {
                        $("#donn_prem").append(don_prem);
                        $("#don_prem").fadeIn();
                    }
                } else {
                    if (dev==1) {
                        $("#leprofil").append(profil_complet);
                        $("#profil_complet").fadeIn();
                    } else if (dev==0) {
                        $("#profil_reduit").fadeIn();
                    }
                    if (visiteur) {
                        $("#leprofil").append(signaler);
                        $("#signaler").fadeIn();
                    }
                    $("#hist").fadeIn();
                    $("#anns").fadeIn();
                }
            }



</script>
</script>
<script type="text/javascript">

$(document).ready(function() {


  $("#photo_profile0").change(function() {
    var property = document.getElementById("photo_profile0").files[0];
    var image_name = property.name ;
    var image_ext = image_name.split(".").pop().toLowerCase();
    var image_size = property.size ;

    if($.inArray(image_ext , ['png','jpg','jpeg']) == -1  ){
      alert("Invalide");
    }
    else{
      var from_date = new FormData();
      from_date.append("photo_profile0",property);
      $.ajax({
                  url: 'php/photo.php',
                  method: "POST",
                  data: from_date,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (returndata) {
                    // aler/t(returndata);
                    $('#photo_profile1').html("<img src='./img_profiles/"+returndata+"' alt='Photo Profil' class='profile-img' style='object-fit:cover;'>");
                    $('#prof').html('<img src="img_profiles/'+returndata+'">');
                  }
                });
    }

  })
});

$(function() {

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);

            } else {
                if( log ) alert(log);
            }

        });
    });

});


</script>

</body>
</html>
