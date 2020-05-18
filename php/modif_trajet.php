<?php
session_start();
$id_compte=$_SESSION['id_compte'];
$id_trajet=$_POST['id_trajet'];

         require 'dbh.inc.php';
         $depart = $_POST['depart'];
         $arrive = $_POST['arrive'];
         if (isset($_REQUEST['arret'])) {
         
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
                $trajet=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$id_trajet)); 
                    $ddd=$trajet['date_annonce'];
                

                    //enregistrement dans la base de donnee
         	        $datetime = date("Y-m-d H:i:s");
                    $insertion = "UPDATE trajet SET date_annonce='$datetime',lieux_depart='$depart', lieux_arrive='$arrive', detour_max='$detour_max', moyen='$moy_transport',taille_max='$taille_max',poids_max='$poids',id_compte=$id_compte,etat='annonce' WHERE id_trajet=".$id_trajet;
                    $execute = mysqli_query($conn,$insertion);
                   
                   mysqli_query($conn,"DELETE FROM arrets WHERE id_trajet=".$id_trajet);
                    if (!isset($_POST['arret'])) {
                  }else{
                  for ($i=0;$i<sizeof($arret);$i++){

                    $a=$arret[$i];

                    $insertion2 = "INSERT INTO arrets (id_trajet,arret) VALUES ('$id_trajet','$a')";
                    $execute2 = mysqli_query($conn,$insertion2);
                  }
                   }

                   mysqli_query($conn, "DELETE FROM trajets_reguliers WHERE id_trajet=".$id_trajet);
                   mysqli_query($conn, "DELETE FROM trajets_non_reguliers WHERE id_trajet=".$id_trajet);
                   mysqli_query($conn, "DELETE FROM trajet WHERE id_compte=".$id_compte." AND date_annonce='".$trajet['date_annonce']."' AND lieux_depart='".$trajet['lieux_arrive']."' AND lieux_arrive='".$trajet['lieux_depart']."'");
                    if (!isset($frequence)) {

                        $insertion4 = "INSERT INTO trajets_non_reguliers (id_trajet,date_depart,date_retour) VALUES ('$id_trajet','$date_depart','$date_retour')";
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

                  }else{ $insertion5 = "INSERT INTO trajets_reguliers (id_trajet,frequence,jour) VALUES ('$id_trajet','$frequence','$jour')";
                    $execute5 = mysqli_query($conn,$insertion5); }
                }
            
                header("Location: ../profile.php");
                
    ?>
