<?php
        session_start();
        require "php/dbh.inc.php";
        
        if (isset($_GET['id'])) {
            $ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM colis WHERE id_colis=".$_GET['id']." AND etat='annonce' AND supp=0 limit 1"));
            if ((!isset($_SESSION['id_compte']))||($ligne['id_compte_e']!==$_SESSION['id_compte'])) {
                header('location: page_inaccessible.php?i=0');
            } else {
                $ligne2=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$ligne['id_trajet']." limit 1"));
                /*if ($ligne2['id_compte']!=$ligne['id_compte_e']) {
                    header('location: page_inaccessible.php?i=1');
                }*/
            }
        } else {
            header('location: page_introuvable.php');
        }
        
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modifier Annonce Colis - Wasselli.dz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="css/bootstrap.min.4.3.1.css" type="text/css">



    <link rel="stylesheet" href="css/all.css" type="text/css">

    
    
    <script src="js/bootstrap.min.4.3.1.js" type="text/javascript"></script>
  

    <script src="js/jquery.min.3.1.0.js" type="text/javascript"></script>


    <script src="js/tether.js" type="text/javascript"></script>

   
    <script src="js/jquery-ui.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="css/style.css?version=14" type="text/css">
<link rel="icon" href="images/icon.png">


</head>
<body>

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

    <br><br><br><br><br>


<div id="formulaire" >
    <div class="col-md-4 container  " style="width: 600px;">


            
            <h4 class="my-4 text-center align-text-bottom " >
                <b>Modifier Annonce Colis</b> &nbsp;&nbsp;<i class="fas fa-box"></i>
            </h4>
            <form class="needs-validation" novalidate method="post" action="php/modif_colis.php" enctype="multipart/form-data" >
                <hr>
                <h4 class="mb-4">Caractéristiques du Colis </h4>
            
                <div class="form-row ">
                    <div class="col-md-12 form-group">
                        <label for="N_colis">Nom du Colis * </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="N_colis" name="N_colis" value="<?php echo $ligne['nom'] ?>" required>
                            <div class="invalid-feedback">
                                Nom du Colis Requis
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 form-group ">
                        <label for="poid">Poids (KG) *</label>
                        <div class="input-group">
                            <input type="number" step="0.1" min="0" class="form-control justify-content-center" value="<?php echo $ligne['poids'] ?>" name="poid_colis" required>
                        <!-- <select type="text" class="form-control text-center" name="poid_colis" id="poid" required>
                            <option value="">Poid </option>
                            <option value="[0,5]"> [0,5] KG </option>
                            <option value="[6,15]"> [6,15] KG </option>
                            <option value="[16,30]"> [16,30] KG </option>
                            <option value="+31"> +31 KG </option>
                            
                        </select> -->

                        <div class="invalid-feedback">
                            Poids du Colis Requis
                        </div>
                        </div>
                    </div>

                    <div class="col-9 form-group">
                        <label for="Taille">Taille * </label>
                        <select type="text" class="form-control" name="taille_colis" id="Taille" required >
                            <option value="<?php echo $ligne['taille'] ?>">
                                <?php
                                    if ($ligne['taille']=='petit') echo "Petit (Exemples: Téléphone, clés...)";
                                    if ($ligne['taille']=='moyen') echo "Moyen (Exemples: Ordinateur, vêtements...)";
                                    if ($ligne['taille']=='grand') echo "Grand (Exemples: Commode, lit bébé...)";
                                    if ($ligne['taille']=='tres grand') echo "Très Grand (Exemples: Plusieurs cartons, matelas...)";
                                ?>
                            </option>
                            <option disabled="true"></option>
                            <option value="petit">Petit (Exemples: Téléphone, clés...)</option>
                            <option value="moyen">Moyen (Exemples: Ordinateur, vêtements...)</option>
                            <option value="grand">Grand (Exemples: Commode, lit bébé...)</option>
                            <option value="tres grand">Très Grand (Exemples: Plusieurs cartons, matelas...)</option>
                        </select>
                        <div class="invalid-feedback">
                            Taille du Colis Requise
                        </div>
                    </div>
                </div>


                

                <hr class="mb-4">

                <h4 class="mb-4">Dates d'Envoi et du Dépôt  </h4>
                <div class="row">
                    <div class="col">
                        <input type="text" name="from_date" id="from_date" class="form-control" value="<?php echo $ligne['date_envoi'] ?>" required=""  />
                        <div class="invalid-feedback">
                                Date d'Envoi Requise
                        </div>
                    </div>
                    <div class="col form-group">
                        <input type="text" name="to_date" id="to_date" class="form-control" value="<?php echo $ligne['date_depot'] ?>" required/>
                        <div class="invalid-feedback">
                                Date du Dépôt Requise
                        </div>
                    </div>
                </div>
                <br>




                <hr class="mb-4">

                <h4 class="mb-4">Adresses du Départ et d'Arrivée  </h4>
                <div class="row">
                    <div class="col form-group ">
                        <label for="willaya_d">Wilaya du Départ * </label>
                        <select type="text" class="form-control text-center" name="willaya_d" id="willaya_d"
                                 required>
                            <option value="<?php echo $ligne2['lieux_depart'] ?>"><?php echo $ligne2['lieux_depart'] ?></option>
                            <option disabled="true"></option>
                            <option value="Adrar">01  Adrar</option>
                            <option value="Chlef">02  Chlef</option>
                            <option value="Laghouat">03  Laghouat</option>
                            <option value="Oum El Bouaghi">04  Oum El Bouaghi</option>
                            <option value="Batna">05  Batna</option>
                            <option value="Béjaïa">06  Béjaïa</option>
                            <option value="Biskra">07  Biskra</option>
                            <option value="Béchar">08  Béchar</option>
                            <option value="Blida">09  Blida</option>
                            <option value="Bouira">10  Bouira</option>
                            <option value="Tamanrasset">11  Tamanrasset</option>
                            <option value="Tébessa">12  Tébessa</option>
                            <option value="Tlemcen">13  Tlemcen</option>
                            <option value="Tiaret">14  Tiaret</option>
                            <option value="Tizi Ouzou">15  Tizi Ouzou</option>
                            <option value="Alger">16  Alger</option>
                            <option value="Djelfa">17  Djelfa  </option>
                            <option value="Jijel">18  Jijel</option>
                            <option value="Sétif">19  Sétif</option>
                            <option value="Saïda">20  Saïda</option>
                            <option value="Skikda">21  Skikda</option>
                            <option value="Sidi Bel Abbès">22  Sidi Bel Abbès</option>
                            <option value="Annaba">23  Annaba</option>
                            <option value="Guelma">24  Guelma</option>
                            <option value="Constantine">25  Constantine</option>
                            <option value="Médéa">26  Médéa</option>
                            <option value="Mostaganem">27  Mostaganem</option>
                            <option value="M’Sila">28  M’Sila</option>
                            <option value="Mascara">29  Mascara</option>
                            <option value="Ouargla">30  Ouargla</option>
                            <option value="Oran">31  Oran</option>
                            <option value="El Bayadh">32  El Bayadh</option>
                            <option value="Illizi">33  Illizi</option>
                            <option value="Bordj Bou Arreridj">34  Bordj Bou Arreridj</option>
                            <option value="Boumerdès">35  Boumerdès</option>
                            <option value="El Tarf">36  El Tarf</option>
                            <option value="Tindouf">37  Tindouf</option>
                            <option value="Tissemsilt">38  Tissemsilt</option>
                            <option value="El Oued">39  El Oued</option>
                            <option value="Khenchela">40  Khenchela</option>
                            <option value="Souk Ahras">41  Souk Ahras</option>
                            <option value="Tipaza">42  Tipaza</option>
                            <option value="Mila">43  Mila</option>
                            <option value="Aïn Defla">44  Aïn Defla  </option>
                            <option value="Naâma">45  Naâma</option>
                            <option value="Témouchent">46  Témouchent</option>
                            <option value="Ghardaia">47  Ghardaia</option>
                            <option value="Relizane">48  Relizane</option> 
                        </select>
                        <div class="invalid-feedback">
                            Wilaya du Départ Requise
                        </div>
                    </div>

                    <div class="col form-group ">
                        <label for="willaya_a">Wilaya d'Arrivée * </label>
                        <select type="text" class="form-control text-center" name="willaya_a" id="willaya_a"
                                 required>
                            <option value="<?php echo $ligne2['lieux_arrive'] ?>"><?php echo $ligne2['lieux_arrive'] ?></option>
                            <option disabled="true"></option>
                            <option value="Adrar">01  Adrar</option>
                            <option value="Chlef">02  Chlef</option>
                            <option value="Laghouat">03  Laghouat</option>
                            <option value="Oum El Bouaghi">04  Oum El Bouaghi</option>
                            <option value="Batna">05  Batna</option>
                            <option value="Béjaïa">06  Béjaïa</option>
                            <option value="Biskra">07  Biskra</option>
                            <option value="Béchar">08  Béchar</option>
                            <option value="Blida">09  Blida</option>
                            <option value="Bouira">10  Bouira</option>
                            <option value="Tamanrasset">11  Tamanrasset</option>
                            <option value="Tébessa">12  Tébessa</option>
                            <option value="Tlemcen">13  Tlemcen</option>
                            <option value="Tiaret">14  Tiaret</option>
                            <option value="Tizi Ouzou">15  Tizi Ouzou</option>
                            <option value="Alger">16  Alger</option>
                            <option value="Djelfa">17  Djelfa  </option>
                            <option value="Jijel">18  Jijel</option>
                            <option value="Sétif">19  Sétif</option>
                            <option value="Saïda">20  Saïda</option>
                            <option value="Skikda">21  Skikda</option>
                            <option value="Sidi Bel Abbès">22  Sidi Bel Abbès</option>
                            <option value="Annaba">23  Annaba</option>
                            <option value="Guelma">24  Guelma</option>
                            <option value="Constantine">25  Constantine</option>
                            <option value="Médéa">26  Médéa</option>
                            <option value="Mostaganem">27  Mostaganem</option>
                            <option value="M’Sila">28  M’Sila</option>
                            <option value="Mascara">29  Mascara</option>
                            <option value="Ouargla">30  Ouargla</option>
                            <option value="Oran">31  Oran</option>
                            <option value="El Bayadh">32  El Bayadh</option>
                            <option value="Illizi">33  Illizi</option>
                            <option value="Bordj Bou Arreridj">34  Bordj Bou Arreridj</option>
                            <option value="Boumerdès">35  Boumerdès</option>
                            <option value="El Tarf">36  El Tarf</option>
                            <option value="Tindouf">37  Tindouf</option>
                            <option value="Tissemsilt">38  Tissemsilt</option>
                            <option value="El Oued">39  El Oued</option>
                            <option value="Khenchela">40  Khenchela</option>
                            <option value="Souk Ahras">41  Souk Ahras</option>
                            <option value="Tipaza">42  Tipaza</option>
                            <option value="Mila">43  Mila</option>
                            <option value="Aïn Defla">44  Aïn Defla  </option>
                            <option value="Naâma">45  Naâma</option>
                            <option value="Témouchent">46  Témouchent</option>
                            <option value="Ghardaia">47  Ghardaia</option>
                            <option value="Relizane">48  Relizane</option> 
                        </select>
                        <div class="invalid-feedback">
                            Wilaya d'Arrivée Requise
                        </div>
                    </div>
                </div>

                    <div>
                        <label for="@_d"> Adresse Exacte du Départ *</label>
                        <input type="text" class="form-control" name="@_d" id="@_d" value="<?php echo $ligne['adr_depart'] ?>" required>
                    </div>

                    <br>

                    <div >
                        <label for="@_a"> Adresse Exacte d'Arrivée *</label>
                        <input type="text" name="@_a" class="form-control" id="@_a" value="<?php echo $ligne['adr_arrive'] ?>" required>
                    </div>
                     <hr class="mb-4">

                    <div class="row">
                        <div class="col">
                            <h4>Photo du Colis </h4>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Importez une photo&hellip; <input type="file" name="photo_colis" style="display: none;" multiple>
                                    </span>
                                </label>
                                <input type="text" name="titre_photo" value="<?php echo $ligne['photo'] ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">
                <div class="row">

                    <div class="custom-control">
                        
                        <label >Demande Speicale</label>
                    </div>
                </div>


                <div class=" mb-2" id="dms">
                    <div class="input-group">
                    <textarea class="form-control" name="text_demande" id="text_demande" rows="5" id="comment"
                    ><?php echo $ligne['demande_spec'] ?></textarea>
                        <div class="invalid-feedback">
                            Demande Spéciale Requise
                        </div>
                    </div>
                </div>

                <input type="number" name="id_colis" value="<?php echo $ligne['id_colis'] ?>" hidden>
                <input type="number" name="id_trajet" value="<?php echo $ligne['id_trajet'] ?>" hidden>

                    <hr class="mb-4">
                    <div class=" d-flex justify-content-center ">
                        <div class="col-8  ">
                            <button class="btn btn-primary btn-block mb-4" name="submit_colis" type="submit" >Continuer</button>
                        </div>
                    </div>
<!--                <hr class="mb-4">-->
<!---->
<!--                <button class="btn btn-primary bt-md btn-block" type="submit" name="submit_colis">Continue</button>-->
<!--                <hr>-->
<!--                <hr>-->

            </form>
        </div>

    </div>

    <script type="text/javascript">
        $(function() {

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
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
        $(document).ready(function(){
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function(){
                $("#from_date").datepicker();
                $("#to_date").datepicker();
            });
        });
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        

    </script>



</body>
</html>
