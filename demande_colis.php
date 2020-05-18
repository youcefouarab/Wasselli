<?php session_start(); 
    $connect = mysqli_connect("localhost", "root", "", "projet2cp");
    $id_colis = $_GET['id_colis'];
    $id_compte = $_GET['id_compte'];
    $id_trajet_ann = $_GET['id_trajet'];

    $query1 = "SELECT * FROM colis WHERE `id_colis` = ".$id_colis." ";

    $result1 = mysqli_query($connect, $query1);
    $row1 = mysqli_fetch_array($result1);

    $query2 = " SELECT * FROM `trajet` WHERE (`supp`= 0) AND (`poids_max` != 0 ) ";
    $result2 = mysqli_query($connect, $query2);

    $query3 = " SELECT * FROM `compte` WHERE `id_compte` = ".$id_compte." ";
    $result3 = mysqli_query($connect, $query3);
    $row3 = mysqli_fetch_array($result3);


    $query4 = " SELECT * FROM `trajet` WHERE `id_trajet` = {$id_trajet_ann}  ";
    $result4 = mysqli_query($connect, $query4);
    $row4 = mysqli_fetch_array($result4);
?> 
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<title>Demande Colis</title>
</head>
<body>

<div class="container">
  <br>
  <!-- Nav tabs -->
  <ul class="nav  nav-tabs nav-pills justify-content-center" role="tablist">
    <li class="nav-item">
      <a class="nav-link justify-content-center " data-toggle="tab" href="#home" style="width: 200px;">Son Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " data-toggle="tab" href="#menu1" style="width: 200px;">L'annonce de colis</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " data-toggle="tab" href="#menu2" style="width: 200px;">Vos annonces de trajet</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " data-toggle="tab" href="#menu3" style="width: 200px;">l'etat d'operation</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container col-5 tab-pane active"><br>
    <div class="">
        <div class="image-flip">
                    <div class="card">
                        <div class="card-body text-center">
                            <p><img class=" img-fluid" src="<?php echo $row3['photo'] ?>" alt="card image" style="border-radius: 50%; width: 200px;"></p>
                            <h4 class="card-title"><?php echo $row3['nom']." ".$row3['prenom'] ?> </h4>
                            <h5 class="card-title">Compte non-premieum</h5>
                        </div>
                    </div>
        </div>
    </div>
      <!-- <h3>HOME</h3> -->
      <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
    </div>
    
    <div id="menu1" class="container col-8 tab-pane fade"><br>
      <div class="">
        <div class="image-flip">
                    <div class="card">
                        <div class="card-body text-center">
                            <p>
                              <img class=" img-fluid" src="<?php echo $row1['photo'] ?>" alt="card image" style="width: 200px;">
                            </p>
                            <h4 class="card-title "> <span class="font-weight-bold"> Nom de colis </span> : <?php echo $row1['nom'] ?> 
                            </h4>
                            <h4 class="card-title "> <span class="font-weight-bold"> Date d'envoi </span> : <?php echo $row1['date_envoi'] ?> 
                            </h4>
                            <h4 class="card-title "> <span class="font-weight-bold"> Date dépot </span> : <?php echo $row1['date_depot'] ?> 
                            </h4>
                            <h4 class="card-title "> <span class="font-weight-bold"> Willaya de depart </span> : <?php echo $row4['lieux_depart'] ?> 
                            </h4>
                            <h4 class="card-title "> <span class="font-weight-bold"> Willaya d'arrive </span> : <?php echo $row4['lieux_arrive'] ?> 
                            </h4>
                                  <input type="button" name="demander" id="demander" class="btn btn-primary" value="Demander">

                        </div>
                    </div>
        </div>
    </div>
      
    </div>
    <div id="menu2" class="container col-12 tab-pane fade"><br>
        <div class="row d-flex justify-content-around mb-3">
        <?php while ($row2 = mysqli_fetch_array($result2)) {
      
        ?>
        <div id="<?php echo $row2['id_trajet']?>" class="card col-4 m-4 border-primary text-primary">
            
            <div class="card-body text-center ">
              <input type="number" id="id_trajet" value="<?php echo $row2['id_trajet'] ?>" hidden  >
                <h5 class="card-title"><?php echo $row2['lieux_depart']." à ".$row2['lieux_arrive'] ?> </h5>
                <?php if ($row2['reg'] = 1 ) { 
                  $requet_reg = "SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = {$row2['id_trajet']} ";
                  $result_reg = mysqli_query($connect,$requet_reg);
                  $row_reg = mysqli_fetch_array($result_reg);
                  ?> 
                <h5 class="card-title">Date de depart : <?php echo $row_reg['date_depart'] ?> </h5>
              <?php } else { 
                $requet_nn_reg = "SELECT * FROM `trajets_non_reguliers` WHERE `id_trajet` = {$row2['id_trajet']} ";
                  $result_nn_reg = mysqli_query($connect,$requet_nn_reg);
                  $row_nn_reg = mysqli_fetch_array($result_nn_reg);
                ?>
                <h5 class="card-title">Date de depart : <?php echo $row_nn_reg['date_depart'] ?> </h5> 
                 <?php } ?> 
                <h5 class="card-title"> </h5>
                <h5 class="card-title">Moyene de transport : <?php echo $row2['moyen'] ?></h5>
                <h5 class="card-title">Poid max : <?php echo $row2['poids_max'] ?> KG </h5>
                <h5 class="card-title">taille max : <?php echo $row2['taille_max'] ?></h5>
                <input type="button" name="Choisir" id="Choisir" class="btn btn-primary trajet" value="Choisir" >
            </div> 
        </div>
      <?php  } ?>
        <div class=" col-4 m-4 d-flex justify-content-around  align-self-center " ">
                    
          <?php 
                  echo ' <a href="formulaire_trajet.php?id_compte='.$id_compte.'&id_colis='.$id_colis.'&id_trajet='.$id_trajet_ann.' " > 
                  <button type="button" class="btn btn-lg btn-primary align-self-center btn-block " style="padding: 1.5em "> Ajouer une annonce de trajet </button>
                  </a>
                  '; 
          ?>
                  
        </div>
        </div>
    </div>
    <div id="menu3" class="container tab-pane fade "><br>
      <h3>Menu 2</h3>
                <input type="button" name="" id="col" class="btn btn-primary" value="Choisir">
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
 var id_trajet =0;
 var id_colis =<?php echo $_GET['id_colis'] ?> ;
  $(document).ready(function(){ 
    // $('[data-toggle="popover"]').popover();
   
  
  $(".trajet").click(function(){
        
      if ( $(this).val() == "Choisir" ){
        
         $(".trajet").parent().parent().removeClass("border-success text-success");    
         $(".trajet").removeClass("btn-success");
         $(".trajet").val("Choisir") ;
        
        $(this).parent().parent().addClass("border-success text-success");    
         $(this).addClass("btn-success");
         $(this).val("Choisi") ;
         id_trajet = $(this).parent().parent().attr("id");
      }
      else{
        $(this).parent().parent().removeClass("border-success text-success");    
         $(this).removeClass("btn-success");
         $(this).val("Choisir") ;
         id_trajet =0; 
      } 
    
  });  
           $('#demander').click(function(){   
            if ( id_trajet != 0 ) {
                    if( $(this).val() == "Demander" ) {
                     $.ajax({  
                          url:"ajouter_demande_notif.php",  
                          method:"POST",  
                          data:{id_colis:id_colis , id_trajet:id_trajet},  
                          success:function(data)  
                          {  
                               $('#demander').val("Demandé") ; 
                               $('.trajet').prop('disabled',true);
                          }  
                     }); } else {
                      $.ajax({  
                          url:"supprimer_demande_notif.php",  
                          method:"POST",  
                          data:{id_colis:id_colis , id_trajet:id_trajet},  
                          success:function(data)  
                          {  
                               $('#demander').val("Demander") ; 
                               $('.trajet').prop('disabled',false);
                          }  
                     });
                    } 
                 } else {
                  alert("Choisissez un trajet");
                 }
           });  
            
      });
    
</script>
</html>