<?php
        session_start();
        require "php/dbh.inc.php";
        
        if (isset($_GET['id'])) {
            $ligne=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajet WHERE id_trajet=".$_GET['id']." AND supp=0 limit 1"));
            if ((!isset($_SESSION['id_compte']))||($ligne['id_compte']!==$_SESSION['id_compte'])) {
                header('location: page_inaccessible.php');
            }
        } else {
            header('location: page_introuvable.php');
        }
        
    ?>

<!DOCTYPE html>
<html>
<head>
	<title>Modifier Annonce Trajet - Wasselli.dz</title>
  <link rel="icon" href="images/icon.png">
  <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

	<link rel="stylesheet" href="css/form_trajet_css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8">


   <?php 
    $wilayas = include 'wilayas.txt';
    $i = 0;
    echo '<script type="text/javascript">

                         function addField()
                         {
                           var holder = document.getElementById("inputs"),
                           div = document.createElement("div"),
                           label = document.createElement("label"),
                           select = document.createElement("select");

      label.innerText = ""; // texte du label
      select.type = "text"; // type text
      select.className = "form-control"; // class
      select.name = "arret[]"; // nom du champ
      var option = document.createElement("option");
        select.appendChild(option);';
      
      for($i=0;$i<48;$i++) {
        echo 'option = document.createElement("option");
        select.appendChild(option);
      option.text="'.$wilayas[$i].'";
        option.value="'.$wilayas[$i].'";';

      
      }

echo '
      div.appendChild(label);
      div.appendChild(select);
      holder.appendChild(div);

      return false;
}

    </script>';?>



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

		<div class="col-md-4 container bg-default">


			<h4 class="my-4 text-center align-text-bottom " >
					<b>Modifier Annonce Trajet</b> &nbsp;&nbsp;<i class="fas fa-road"></i>
			</h4>

			<form method="POST" action='php/modif_trajet.php'>
				<hr class="mb-4">
			<div class="row">
					<h5 class="my-3">
						<label for="country">Départ</label>
					</h5>
			</div>
				<div class="form-group">
					<div class="form-group">
						<label for="country">Wilaya *</label>
						<select type="text" class="form-control" name="depart" required>
                            <option value="<?php echo $ligne['lieux_depart'] ?>"><?php echo $ligne['lieux_depart'] ?></option>
							              <option disabled></option>
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
							Veuillez Choisir une wilaya.
						</div>
                    </div>


					<div class="row">
					<h5 class="my-3">
						<label for="country">Arrivé</label>
					</div>
		           	</div>


				<div class="form-group">
					<div class="form-group">
						<label for="country">Wilaya *</label>
						<select type="text" class="form-control" name="arrive" required>
							             <option value="<?php echo $ligne['lieux_arrive'] ?>"><?php echo $ligne['lieux_arrive'] ?></option>
                            <option disabled></option>
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
							Veuillez Choisir une wilaya.
						</div>
					</div>


                    <div class="row">
                    <h5 class="my-3">
                        <label for="country">Arrets</label>
                    </div>

                <div class="form-group">
						<label for="text" name="arrets">"Augumenter vos chances de trouver un colis en ajoutant des villes de passage !"</label>
						<div id="inputs">
              <?php
                            $arrets=mysqli_query($conn,"SELECT * FROM arrets WHERE id_trajet=".$ligne['id_trajet']);
                            while ($arret=mysqli_fetch_array($arrets)) {
                                echo '<select type="text" class="form-control" name="arret[]" required>
                            <option value="'.$arret['arret'].'">'.$arret['arret'].'</option>
                            <option disabled></option>
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
            </select>';
                        }
                    ?> 

                </div>

                <div class="my-3">
                  <input class="form-control" type="button" value="Ajouter un champ" onclick="addField();">
			        	</div>

				<div class="row">
					<h5 class="my-3">
						<label for="country">Détour max*</label>
				</div>

				<div class="form-group">
                    <div class="form-group">
                        <select type="text" class="form-control" name="detour_max" required>
                          <option><?php echo $ligne['detour_max']?></option>
                            <option disabled></option>
                            <option>00 -50  km</option>
                            <option>50 -80  km</option>
                            <option>80 -100  km</option>
                            <option>100 -150  km</option>
                            <option>Plus 150  km</option>
                        </select>
                        <div class="invalid-feedback">
                            Veuillez Choisir un champ.
                        </div>
                    </div>

				<div class="row">
					<h5 class="my-3">
						<label for="country">Moyen de transport*</label>
				</div>

				<div class="form-group" >
						              <div class="form-check">
                             <input type="radio" class="form-check-input"  name="moy_transport" value="Avion" id="Avion" required>
                             <i class="fa fa-1"> &#9992;&#65039;  </i>
                             <label for="Avion" class="form-check-label">Avion</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="moy_transport" value="Voiture" id="Voiture" required>
                             <i class="fa fa-1"> &#128664;  </i>
                             <label for="Voiture" class="form-check-label">Voiture</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="moy_transport" value="Camionette/camion" id="Camionette/camion" required>
                             <i class="fa fa-1"> &#128656;  </i>
                             <label for="Camionette/camion" class="form-check-label">Camionette/camion</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="moy_transport" value="Train" id="Train" required>
                             <i class="fa fa-1"> &#128642;  </i>
                             <label for="Train" class="form-check-label">Train</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="moy_transport" value="Bus" id="Bus" required>
                             <i class="fa fa-1"> &#128652;  </i>
                             <label for="Bus" class="form-check-label">Bus</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="moy_transport" value="Bâteau" id="Bateau" required>
                             <i class="fa fa-1"> &#128674;  </i>
                             <label for="Bâteau" class="form-check-label">Bâteau</label>
                          </div>

				</div>

        <script type="text/javascript">
                    var moyen="<?php echo $ligne['moyen'] ?>";
                    if (moyen=="Avion") document.getElementById("Avion").checked=true;
                    if (moyen=="Voiture") document.getElementById("Voiture").checked=true;
                    if (moyen=="Camionette/camion") document.getElementById("Camionette/camion").checked=true;
                    if (moyen=="Train") document.getElementById("Train").checked=true;
                    if (moyen=="Bus") document.getElementById("Bus").checked=true;
                    if (moyen=="Bateau") document.getElementById("Bateau").checked=true;
                </script>

			<div class="row">
					<h5 class="my-3">
						<label for="country">Taille de colis*</label>
			</div>

			<div class="row">
					<div class="col-md-4 form-group">

						<i class="fa fa-1"> &#9993;&#65039;</i>

						<label for="country">Petit</label>

					  <div class="form-check">
					        <input type="checkbox" class="form-check-input" name="taille_max" value="Petit" id="Petit">
						           Téléphone, clés...
					        <label for="shipping-adress" class="form-check-label"></label>
			     	  </div>
			     	</div>

			        <div class="col-md-4 form-group">
			        	<i class="fa fa-1"> &#128187;</i>
                    <label for="country">Moyen</label>
					<div class="form-check">
					        <input type="checkbox" class="form-check-input" name="taille_max" value="Moyen" id="Moyen">
						           Ordinateur, livres, vêtements...
					        <label for="shipping-adress" class="form-check-label"></label>
			     	</div>
			     	</div>

			</div>



      <div class="row" >
					<div class="col-md-4 form-group">

						<i class="fa fa-1"> &#128452;&#65039;  </i>

						<label for="country">Grand</label>

					  <div class="form-check">
					        <input type="checkbox" class="form-check-input" name="taille_max" value="Grand" id="Grand">
						           Commode, chaise, lit bébé...
					        <label for="shipping-adress" class="form-check-label"></label>
			     	  </div>
			     	</div>

			        <div class="col-md-4 form-group">
			        	<i class="fa fa-1"> &#128230;  </i>
                    <label for="country">Trés Grand</label>
					<div class="form-check">
					        <input type="checkbox" class="form-check-input" name="taille_max" value="Tres Grand" id="Tres_Grand">
						           Plusieurs cartons, matelas, canapé...
					        <label for="shipping-adress" class="form-check-label"></label>
			     	</div>
			     	</div>

			</div>

      <script type="text/javascript">
                    var taille="<?php echo $ligne['taille_max'] ?>";
                    if (taille=="Petit") document.getElementById("Petit").checked=true;
                    if (taille=="Moyen") document.getElementById("Moyen").checked=true;
                    if (taille=="Grand") document.getElementById("Grand").checked=true;
                    if (taille=="Tres Grand") document.getElementById("Tres_Grand").checked=true;
                </script>

			<div class="row">
					<h5 class="my-3">
						<label for="country">Poids</label>
			</div>

            <div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">(kg)</span>
							</div>
							<input type="number" min="0" step="1" class="form-control" name="poids" value="<?php echo $ligne['poids_max']?>" placeholder="Poids max que vous pouvez transporté" required>
							<div class="invalid-feedback">
								Veuillez entrez le poids.
							</div>
						</div>

            <?php
                $result=mysqli_query($conn,"SELECT * FROM trajets_reguliers WHERE id_trajet=".$ligne['id_trajet']);
                if (mysqli_num_rows($result)!=0) {
                    $reg=mysqli_fetch_array($result);
                    $nonreg = array('date_depart' => '','date_retour' => '');
                } else {
                    $nonreg=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM trajets_non_reguliers WHERE id_trajet=".$ligne['id_trajet']));
                    $reg = array('jour' => '','frequence' => '');
                }
             ?>


			<div class="row">
					<h5 class="my-3">
					<label for="country">Fréquences*</label>
			</div>

            <label for="text">Voyagez vous régulièrement ?*</label>

            <hr>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="freq" value="non" id="non_reg" required>
                             <label for="non" class="form-check-label">Non, je ne fais pas des voyages réguliers</label>
                          </div>

            <hr>

            <div class="col-md-6 form-group">
                        <label for="dateofbirth">Départ*</label>
                        <input type="date" id="date_depart" name="date_depart" class="form-control" maxlength="10" value="<?php echo $nonreg['date_depart'] ?>" >
                        <span class="input-group-addon"><span class="fa" style="cursor:pointer" id="date_depart" name="date_depart" required ></span>
                        </span>
                        <span class="fa " style="cursor:pointer" id="date_depart" name="date_depart"></span>

                        <div class="invalid-feedback">
                            Veuillez Choisir une date.
                        </div>
            </div>


            <div class="col-md-6 form-group">
                        <label for="dateofbirth">Retour (optionnel)</label>
                        <input type="date" id="date_retour" name="date_retour" class="form-control" maxlength="10" value="<?php echo $nonreg['date_retour'] ?>" >
                        <span class="input-group-addon" id="date_retour" name="date_retour" required></span>
                        <span class="fa" style="cursor:pointer" id="date_retour" name="date_retour"></span>

                        <div class="invalid-feedback">
                            Veuillez Choisir une date.
                        </div>
            </div>


           <hr>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="freq" value="oui" id="regul" required>
                             <label for="oui" class="form-check-label">Oui, je voyage régulièrement</label>
                          </div>

             <hr><p>Départ*</p>

             <div class="my-3">

             <div class="col-md-6 form-group">
                        <input type="date" id="jour" name="jour" class="form-control" maxlength="10" value="<?php echo $reg['jour'] ?>">
                        <span class="input-group-addon" id="jour" name="jour"><span class="fa " style="cursor:pointer" id="jour" name="jour"></span></span>
                        <span class="fa " style="cursor:pointer" id="jour" name="jour"></span>

                        <div class="invalid-feedback">
                            Veuillez Choisir une date.
                        </div>
            </div>

            </div>


             <div class="my-3">

             <label for="dateofbirth">Fréquence de voyage*</label>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="1" id="1f">
                             <label for="Voiture" class="form-check-label">1 fois par semaine</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="2" id="2f">
                             <label for="Camionette/camion" class="form-check-label">2 fois par semaine</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="3" id="3f">
                             <label for="Train" class="form-check-label">3 fois par semaine</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="4" id="4f">
                             <label for="Bus" class="form-check-label">4 fois par semaine</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="5" id="5f">
                             <label for="Bâteau" class="form-check-label">5 fois par semaine</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="6" id="6f">
                             <label for="Voiture" class="form-check-label">6 fois par semaine</label>
                          </div>

                          <div class="form-check">
                             <input type="radio" class="form-check-input"  name="frequence" value="7" id="7f">
                             <label for="Camionette/camion" class="form-check-label">7 fois par semaine</label>
                          </div>

                        <div class="invalid-feedback">
                            Veuillez Choisir un champ.
                        </div>

             </div>

             <?php
                if (mysqli_num_rows($result)!=0) {
                  
                    echo '<script type="text/javascript">
                        document.getElementById("regul").checked=true;
                        var freq="'.$reg['frequence'].'";
                        if (freq==1) document.getElementById("1f").checked=true;
                        if (freq==2) document.getElementById("2f").checked=true;
                        if (freq==3) document.getElementById("3f").checked=true;
                        if (freq==4) document.getElementById("4f").checked=true;
                        if (freq==5) document.getElementById("5f").checked=true;
                        if (freq==6) document.getElementById("6f").checked=true;
                        if (freq==7) document.getElementById("7f").checked=true;
                    </script>';
                } else {

                    echo '<script type="text/javascript">
                        document.getElementById("non_reg").checked=true;
                    </script>';
                }
             ?>



           </div>

           <input type="number" name="id_trajet" value="<?php echo $ligne['id_trajet']?>" hidden>
      		<div class="form-group">
			     <button class="btn btn-primary bt-lg btn-block" type="submit" name="envoyer">Continue</button>
          </div>

		    </form>
		</div>

  



</body>
</html>
