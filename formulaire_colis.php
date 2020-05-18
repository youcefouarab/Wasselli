 
<?php session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Déposer Annonce Colis - Wasselli.dz</title>
      <link rel="icon" href="images/icon.png">
       <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- font awesome css -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--Js file -->
    <!-- bootstrap js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!-- tether.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js"></script>

    <!-- datepicker -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <title></title>
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
    <div class="col-md-4 container  ">

            <h4 class="my-4 text-center align-text-bottom " >
                <b>Annonce Colis</b> <i class="fas fa-box"></i>
            </h4>
            <form class="needs-validation" novalidate method="post" action="php/colis.php" enctype="multipart/form-data" >
                <hr>
                <h4 class="mb-4">Caractéristiques de Colis </h4>

                <div class="form-row ">
                    <div class="col-md-12 form-group">
                        <label for="N_colis">Nom Colis * </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="N_colis" name="N_colis" placeholder="veuillez écrire le nom de colis" required>
                            <div class="invalid-feedback">
                                Nom de colis requis
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 form-group ">
                        <label for="poid">Poid (KG) *</label>
                        <div class="input-group">
                            <input type="number" step="0.1" min="0.1" class="form-control justify-content-center" placeholder="KG" name="poid_colis">
                        <!-- <select type="text" class="form-control text-center" name="poid_colis" id="poid" required>
                            <option value="">Poid </option>
                            <option value="[0,5]"> [0,5] KG </option>
                            <option value="[6,15]"> [6,15] KG </option>
                            <option value="[16,30]"> [16,30] KG </option>
                            <option value="+31"> +31 KG </option>

                        </select> -->

                        <div class="invalid-feedback">
                            veuillez sélectionner le poid
                        </div>
                        </div>
                    </div>

                    <div class="col-9 form-group">
                        <label for="Taille">Taille * </label>
                        <select type="text" class="form-control" name="taille_colis" id="Taille" required >
                            <option value="">Choisir </option>
                            <option value="petit">Petit (Exemple: Téléphone,clés )</option>
                            <option value="moyen">moyen (Exemple: Ordinateur,vêtements)</option>
                            <option value="grand">grand (Exemple: Commode,lit bébé)</option>
                            <option value="tres grand">très grand (Exemple: Plusieurs cartons,matelas)</option>
                        </select>
                        <div class="invalid-feedback">
                            veuillez sélectionner la taille
                        </div>
                    </div>
                </div>


                <hr class="mb-4">
                <div class="row">

                    <div class="custom-control  custom-switch ml-3 mb-2">
                        <input type="checkbox" class="custom-control-input " id="d_s" name="demande_special">
                        <label for="d_s" class="custom-control-label" >Demande Speical</label>
                    </div>
                </div>

                <div class=" mb-2">
                    <div class="input-group">
                    <textarea class="form-control" name="text_demande" id="text_demande" rows="5" id="comment" placeholder="Ecrire votre demande"
                    ></textarea>
                        <div class="invalid-feedback">
                            veuillez érire votre demande
                        </div>
                    </div>
                </div>

                <hr class="mb-4">

                <h4 class="mb-4">Date de d'envoi et dépot  </h4>
                <div class="row">
                    <div class="col">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Date d'envoi *" required=""  />
                        <div class="invalid-feedback">
                                veuillez sélectionner la date d'envoi
                        </div>
                    </div>
                    <div class="col form-group">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Date de dépot *" required/>
                        <div class="invalid-feedback">
                                veuillez sélectionner la date de depot
                        </div>
                    </div>
                </div>
                <br>




                <hr class="mb-4">

                <h4 class="mb-4">L'adresse de départ et d'arrivé  </h4>
                <div class="row">
                    <div class="col form-group ">
                        <label for="willaya_d">Willaya de départ * </label>
                        <select type="text" class="form-control text-center" name="willaya_d" id="willaya_d"
                                 required>
                            <option value="">Choisir</option>
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
                            veuillez sélectionner la willaya de départ
                        </div>
                    </div>

                    <div class="col form-group ">
                        <label for="willaya_a">Willaya d'arrivé * </label>
                        <select type="text" class="form-control text-center" name="willaya_a" id="willaya_a"
                                 required>
                            <option value="">Choisir</option>
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
                            veuillez sélectionner Willaya d'arrivé
                        </div>
                    </div>
                </div>

                    <div>
                        <label for="@_d"> Adresse exacte de départ </label>
                        <input type="text" class="form-control" name="@_d" id="@_d" value="" required >
                    </div>

                    <br>

                    <div >
                        <label for="@_a"> Adresse exacte d'arrivé </label>
                        <input type="text" name="@_a" class="form-control" id="@_a" value="" required >
                    </div>
                     <hr class="mb-4">

                    <div class="row">
                        <div class="col">
                            <h4>Photo de colis </h4>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Importez une photo&hellip; <input type="file" name="photo_colis" style="display: none;" multiple>
                                    </span>
                                </label>
                                <input type="text" name="titre_photo"  class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                     <?php if (isset($_GET['id_trajet'])) {
                        # code...
                    ?>
                    <input type="text" name="id_trajet" value="<?php echo $_GET['id_trajet'] ?> "hidden  >
                    <input type="text" name="id_compte_ann" value="<?php echo $_GET['id_compte'] ?> " hidden >
                    <?php } else {
                        ?>
                    <input type="text" name="id_trajet" value="" hidden  >
                    <input type="text" name="id_compte_ann" value="" hidden >
                <?php } ?>
                    <hr class="mb-4">
                    <div class=" d-flex justify-content-center ">
                        <div class="col-8  ">
                            <button class="btn btn-primary btn-block mb-4" name="submit_colis" type="submit" >Valider</button>
                        </div>
                    </div>
<!--                <hr class="mb-4">-->
<!---->
<!--                <button class="btn btn-primary bt-md btn-block" type="submit" name="submit_colis">Continue</button>-->
<!--                <hr>-->
<!--                <hr>-->

            </form>
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
        $(document).ready(function(){
            $("#d_s").click(function(){
                if(!$("#text_demande").prop('required')){
                $("#text_demande").prop('required',true);
            } else {
                $("#text_demande").prop('required',false);
            }

            });
        });

    </script>
</body>
</html>
