<?php
session_start();

function affichage($row , $row2 ,$row3){
   $output =
   '<div class="rela-block image-grid-container top-container  mt-2 " style="width:700px;  height:350px; padding-top:5px;">
       <div class="floated image-column 1"  >
         <div class="rela-block image">
           <section class="box main">
         </div>
             <div class="wrap-content">
               <div class="first">
                 <div style="display:flex; flex-direction:row;" >
                 <div style="display: flex ; flex-direction: column ;margin-left: 10px ; width: 250px;">';
                 if($row['photo']){
                   $output .= '<img src="'.$row['photo'].'" style="width: 240px; height: 240px;border-radius: 3%;margin-bottom : 20px; ">' ;
                 }else{
                   $output .= '<img src="img_colis/unkonwn-colis.jpg" style="width: 230px; height: 230px;border-radius: 3%; margin-bottom : 20px; ">';
                 }
                  $output .= ' <h4 class="badge badge-pill" style=" display: flex ; justify-content: center; font-size:20px;">Prix : '.$row["tarif"].' DA </h3>
                   </div>
                 <div style="width:440px;">
                  <a href="profile.php?id='.$row['id_compte_e'].'&from='.$_POST['from'].'" target="_blank">';
                 if($row3['photo']){
                   $output .= '<img  src="img_profiles/'.$row3['photo'].'"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row3["prenom"]." ".$row3["nom"].' </span> </a>' ;
                 }else{
                   $output .= '<img  src="./images/profile.png"  alt="" style="border-radius: 50%; width: 40px;"  class="mb-2"> <span class=" text-body h5">'.$row3["prenom"]." ".$row3["nom"].' </span> </a>';
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
                    if ($_POST['from']=='user') {
                        if ($_SESSION['nom']){
                          $output .= '<a href="choix_trajet.php?id_colis='.$row["id_colis"].'&id_compte='.$row["id_compte_e"].' " target="_blank" >
                          <button type="submit" class="btn btn-primary button" style ="color:#fff; background-color: #218ad4; "> Demander </button>
                          </a>';
                        } else {
                          $output .= '<a href="#" onclick="connecter()" >
                          <button type="submit" class="btn btn-primary button" style ="color:#fff; background-color: #218ad4; "> Demander </button>
                          </a> ';
                        }
                    } else if ($_POST['from']=='admin') {

                          $output .= '<a href="#" onclick="supp(1,'.$row['id_colis'].')">
                          <button class="btn btn-danger button" > Supprimer </button>
                          </a>';

                    }
                    $output .= '
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
 // $date_depot ='2000-12-31';
 // $date_depart = date('Y-m-d');
  if(!empty($_POST["to_date"]) ) {
      $date_depart = $_POST["to_date"] ;
  }

    $output = '';
    if ($_SESSION['nom']){
    $query = "SELECT * FROM colis where (`id_compte_e` != {$_SESSION['id_compte']}) AND (supp = 0) and (etat = 'annonce') ";
    } else {
    $query = "SELECT * FROM colis where (supp = 0) and (etat = 'annonce') ";
    }
    if(!empty($_POST["to_date"]) ) {
      $date_depart = $_POST["to_date"] ;
      $query .= " AND ( `date_envoi` <=  '{$date_depart}' ) AND ( `date_depot` >=  '{$date_depart}' )";
    }

    if(!empty($_POST["poid_max"]) ) {
      $query .= " AND  ( `poids` <= {$_POST["poid_max"]} ) ";
    }

    if(!empty($_POST["taille_max"])){
      if($_POST["taille_max"] == "petit"){
          $query .= " AND (`taille` = 'petit')";
      }
      elseif($_POST["taille_max"] == "moyen"){
          $query .= " AND ( (`taille` = 'petit') OR (`taille` = 'moyen') ) ";
      }
      elseif($_POST["taille_max"] == "grand"){
          $query .= " AND ( (`taille` = 'petit') OR (`taille` = 'moyen') OR (`taille` = 'grand') ) ";
      }
      elseif($_POST["taille_max"] == "tres grand"){
          $query .= " AND ( (`taille` = 'petit') OR (`taille` = 'moyen') OR (`taille` = 'grand') OR (`taille` = 'tres grand') ) ";
      }
    }

    $query .= " ORDER BY `date_annonce` desc";
    $result = mysqli_query($connect, $query);

          while($row = mysqli_fetch_array($result))
            {
            $id_trajet = $row["id_trajet"];
                      $query3 = " SELECT `nom`,`prenom`,`photo`,`prem_accepte`,`supp`,`desactiver` FROM `compte` where `id_compte` = ".$row["id_compte_e"]." " ;
                      $result3 = mysqli_query($connect, $query3);
                      $row3 = mysqli_fetch_array($result3);
                      if(($row3['supp']!= 1 ) && ($row3['desactiver'] != 1 )){
                        if($row3['prem_accepte'] == 1 ){

                            $query2 = " SELECT `lieux_depart`,`lieux_arrive` FROM `trajet` WHERE `id_trajet` = ".$id_trajet." ";
                            $result2 = mysqli_query($connect, $query2);
                            $row2 = mysqli_fetch_array($result2);

                            if( (!empty($_POST["ville_depart"]) ) && (empty($_POST["ville_arrive"])) ){
                              if(($row2["lieux_depart"] == $_POST["ville_depart"] )){
                                $output .= affichage($row,$row2,$row3);
                              }
                            }

                            elseif( (empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){
                              if ( $row2["lieux_arrive"] == $_POST["ville_arrive"] ) {
                              $output .= affichage($row,$row2,$row3);
                              }
                            }

                            elseif( (!empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){
                              if ( ($row2["lieux_depart"] == $_POST["ville_depart"] ) && ( $row2["lieux_arrive"] == $_POST["ville_arrive"] ) ) {
                                $output .= affichage($row,$row2,$row3);
                              }
                            }
                            else{
                              $output .= affichage($row,$row2,$row3);
                            }

                        }
                    }
            }
    $result = mysqli_query($connect, $query);

          while($row = mysqli_fetch_array($result))
            {
            $id_trajet = $row["id_trajet"];
                      $query3 = " SELECT `nom`,`prenom`,`photo`,`prem_accepte`,`supp`,`desactiver` FROM `compte` where `id_compte` = ".$row["id_compte_e"]." " ;
                      $result3 = mysqli_query($connect, $query3);
                      $row3 = mysqli_fetch_array($result3);
                      if(($row3['supp']!= 1 ) && ($row3['desactiver'] != 1 )){
                        if($row3['prem_accepte'] != 1 ){

                            $query2 = " SELECT `lieux_depart`,`lieux_arrive` FROM `trajet` WHERE `id_trajet` = ".$id_trajet." ";
                            $result2 = mysqli_query($connect, $query2);
                            $row2 = mysqli_fetch_array($result2);

                            if( (!empty($_POST["ville_depart"]) ) && (empty($_POST["ville_arrive"])) ){
                              if(($row2["lieux_depart"] == $_POST["ville_depart"] )){
                                $output .= affichage($row,$row2,$row3);
                              }
                            }

                            elseif( (empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){
                              if ( $row2["lieux_arrive"] == $_POST["ville_arrive"] ) {
                              $output .= affichage($row,$row2,$row3);
                              }
                            }

                            elseif( (!empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){
                              if ( ($row2["lieux_depart"] == $_POST["ville_depart"] ) && ( $row2["lieux_arrive"] == $_POST["ville_arrive"] ) ) {
                                $output .= affichage($row,$row2,$row3);
                              }
                            }
                            else{
                              $output .= affichage($row,$row2,$row3);
                            }

                        }

            }

          }
    echo $output;


 ?>

<script type="text/javascript">
   $(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
  </script>
