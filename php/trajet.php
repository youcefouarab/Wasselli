<?php

session_start();
date_default_timezone_set('Africa/Algiers');
$id_compte=$_SESSION['id_compte'];

         require 'dbh.inc.php';
         $depart = $_POST['depart'];
         $arrive = $_POST['arrive'];
         if (!isset($_REQUEST['arret'])) {
         }else{
         $arret = $_REQUEST['arret'];

         }
         $detour_max = $_POST['detour_max'];
         $moy_transport = $_POST['moy_transport'];
         $taille_max = $_POST['taille_max'];
         $poids = $_POST['poids'];
         $date_depart = $_POST['date_depart'];
         $date_retour = $_POST['date_retour'];
         $jour = $_POST['jour'];
         if (!isset($_POST['frequence'])) {
         }else{
         $frequence = $_POST['frequence'];
         }
         $freq = $_POST['freq'];
        // $sql = " INSERT INTO trajet SET lieux_depart=$depart, lieux_arrive=$arrive, id_arret=$arrets, moyen=$moy_transport, taille_max=$format, poids_max=$poids ";
         $pdo = null;

         if(isset($_POST['envoyer'])){  //si le bouton envoyer a ete enclencher


                    //enregistrement dans la base de donnee
         	        $datetime = date("Y-m-d H:i:s");
                    $insertion = "INSERT INTO trajet (date_annonce,lieux_depart,lieux_arrive,detour_max,moyen,taille_max,poids_max,id_compte,etat) VALUES ('$datetime','$depart','$arrive','$detour_max','$moy_transport','$taille_max',
                    '$poids',$id_compte,'annonce')";
                    $execute = mysqli_query($conn,$insertion);

                   $sql = "select * from trajet where date_annonce = '".$datetime."' and lieux_arrive ='".$arrive."' limit 1";
                   $result = mysqli_query($conn,$sql);
                   $ligne = $result->fetch_assoc();
                   $id = $ligne['id_trajet'];
                    if (!isset($_POST['arret'])) {
                  }else{
                  for ($i=0;$i<sizeof($arret);$i++){

                    $a=$arret[$i];

                    $insertion2 = "INSERT INTO arrets (id_trajet,arret) VALUES ('$id','$a')";
                    $execute2 = mysqli_query($conn,$insertion2);
                  }
                   }
                    if (!isset($frequence)) {$insertion4 = "INSERT INTO trajets_non_reguliers (id_trajet,date_depart,date_retour) VALUES ('$id','$date_depart','$date_retour')";

                    $execute4 = mysqli_query($conn,$insertion4);

                    if ($_POST['date_retour']!=strtotime("0000-00-00") ){
                            $insertion = "INSERT INTO trajet (date_annonce,lieux_arrive,lieux_depart,detour_max,moyen,taille_max,poids_max,id_compte,etat) VALUES ('$datetime','$depart','$arrive','$detour_max','$moy_transport','$taille_max',
                        '$poids',$id_compte,'annonce')";
                        $execute = mysqli_query($conn,$insertion);

                        $sql = "select * from trajet where date_annonce = '".$datetime."' and lieux_arrive ='".$depart."' limit 1";
                   $result = mysqli_query($conn,$sql);
                   $ligne = $result->fetch_assoc();
                   $id = $ligne['id_trajet'];
                    if (!isset($_POST['arret'])) {
                  }else{
                  for ($i=0;$i<sizeof($arret);$i++){

                    $a=$arret[$i];

                    $insertion2 = "INSERT INTO arrets (id_trajet,arret) VALUES ('$id','$a')";
                    $execute2 = mysqli_query($conn,$insertion2);
                  }
                   }

                   $insertion4 = "INSERT INTO trajets_non_reguliers (id_trajet,date_depart) VALUES ('$id','$date_retour')";

                    $execute4 = mysqli_query($conn,$insertion4);

                    }

                  }else{ $insertion5 = "INSERT INTO trajets_reguliers (id_trajet,frequence,jour) VALUES ('$id','$frequence','$jour')";
                    $execute5 = mysqli_query($conn,$insertion5); }
                }
            if(!empty($_POST['id_colis'])){
                    header("Location: ../choix_trajet.php?id_colis=".$_POST['id_colis']."&id_compte=".$_POST['id_compte_ann']."");
                }else{
                header("Location: ../index.php?annonce=success");
                }
    ?>
