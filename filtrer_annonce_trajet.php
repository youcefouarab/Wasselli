
<?php
session_start();
function affichage($row,$row2,$row3,$reg,$result5){

	$output='
	<div class="rela-block image-grid-container top-container  mt-2 " style="width:660px; padding-top:5px;">
			<div class="floated image-column 1"  >
				<div class="rela-block image">
					<section class="box main">
				</div>
						<div class="wrap-content">
							<div class="first">
								<div class="inner mt-2" >';
								$output.='<a href="profile.php?id='.$row['id_compte'].'&from='.$_POST['from'].'" target="_blank">';
				                 if($row2['photo']){
				                   $output .= '<img  src="img_profiles/'.$row2['photo'].'"  alt="" style="border-radius: 50%; width: 40px;margin-top : 20px;"  class="mb-2"> <span class=" text-body h5">'.$row2["prenom"]." ".$row2["nom"].' </span> </a>' ;
				                 }else{
				                   $output .= '<img  src="img_profiles/unknown-profile.png"  alt="" style="border-radius: 50%; width: 40px;margin-top : 20px;"  class="mb-2"> <span class=" text-body h5">'.$row2["prenom"]." ".$row2["nom"].' </span> </a>';
				                 }

									$output .= '<div style="lign-height:0.5px;">
									 <div class=" text-body " style="font-size:17px; margin-bottom:8px;">
										 '.$row["lieux_depart"].'
										 <i class="fas fa-arrow-right"> </i>
										 '.$row["lieux_arrive"].'
									 </div>';
									 $num_arret = mysqli_num_rows($result5);
									 if( $num_arret > 0 ) {
										 // $row5 = mysqli_fetch_array($result5);
										 $output .= ' <div class="badge badge-pill badge-secondary" data-trigger="hover" data-toggle="popover" title="Arrets" data-content="';
										 $row5 = mysqli_fetch_array($result5);
										 $output .=  $row5['arret'] ;
										 while($row5 = mysqli_fetch_array($result5) ){
											 $output .= ', '.$row5['arret'];
										 }
										$output .= '"style="font-size:15px; margin-bottom:5px;" > Arrets </div> ';
									}

								  if( $reg == true ){
										$output .= '
										<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
 										 Trajet regulier
 									 	</div>
 									 	<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
 											depart : '.$row3["jour"].' | Frequence : '.$row3["frequence"].' fois par semaine
 									 	</div>';

									}
									else{
									$output .= '
									<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
									 Trajet non regulier
									</div>
									<div class=" text-body " style="font-size:17px; margin-bottom:5px;">
										depart : '.$row3["date_depart"].' | retour : '.$row3["date_retour"].'
									</div>';
									}

									$output .='
									 <div class=" text-body " style="font-size:17px; margin-bottom:5px;">
										 Detour max : '.$row["detour_max"].'
									 </div>
									 <div class=" text-body " style="font-size:17px; margin-bottom:5px;">
										 Taille max : '.$row["taille_max"].' | Poid max : '.$row["poids_max"].'
									 </div>
									 <div class=" text-body " style="font-size:17px; margin-bottom:10px;">
										Moyen de transport : '.$row["moyen"].'
									 </div>
									 <div class="text muted mb-3" > publié le  '.$row["date_annonce"].' </div>';
									 if ($_POST['from']=='user') {
											 if ($_SESSION['nom']){
												 $output .= '<a href="choix_colis.php?id_trajet='.$row["id_trajet"].'&id_compte='.$row["id_compte"].' " target="_blank" >
												 <button type="submit" class="btn  button" style="color:#fff; background-color: #218ad4;"> Demander </button>
												 </a>';
											 } else {
												 $output .= '<a href="#" onclick="connecter()" >
												 <button type="submit" class="btn button" style="color:#fff; background-color: #218ad4;"> Demander </button>
												 </a> ';
											 }
									} else if ($_POST['from']=='admin')  {

												 $output .= '<a href="#" onclick="supp(2,'.$row['id_trajet'].')">
                         							 <button class="btn btn-danger button" > Supprimer </button>
												 </a>';


									}
									 $output .='

								 </div>
								</div>
							</div>

						</div>
					</section>
				</div>
	</div>
	';
	return $output;
}
$connect = mysqli_connect("localhost", "root", "", "projet2cp");
    $output =' ';

		if ($_SESSION['nom']){
			$query = "SELECT * FROM `trajet` where (`id_compte` != {$_SESSION['id_compte']}) AND (supp = 0) and ((etat = 'annonce') or (etat='accepte')) and (poids_max != 0)  ";
		} else {
			$query = "SELECT * FROM `trajet` where (supp = 0) and ((etat = 'annonce') or (etat='accepte')) and (poids_max != 0)  ";
		}

    if(!empty($_POST["poid_max"]) ) {
      $query .= " AND  ( `poids_max` >= {$_POST["poid_max"]} ) ";
    }


		    if(!empty($_POST["taille_max"])){
		      if($_POST["taille_max"] == "Petit"){
		          $query .= " AND ( (`taille_max` = 'Petit') OR (`taille_max` = 'Moyen') OR (`taille_max` = 'Grand') OR (`taille_max` = 'Tres Grand') ) ";
		      }
		      elseif($_POST["taille_max"] == "Moyen"){
		          $query .= " AND ( (`taille_max` = 'Moyen') OR (`taille_max` = 'Grand') OR (`taille_max` = 'Tres Grand') ) ";
		      }
		      elseif($_POST["taille_max"] == "Grand"){
		          $query .= " AND ( (`taille_max` = 'Grand') OR (`taille_max` = 'Tres Grand') ) ";
		      }
		      elseif($_POST["taille_max"] == "Tres Grand"){
		          $query .= " AND  (`taille_max` = 'Tres Grand') ";
		      }
		    }

    $query .= " ORDER BY date_annonce desc ";
    $result = mysqli_query($connect, $query);

    	while($row = mysqli_fetch_array($result))
			{
								$id_trajet = $row['id_trajet'];
								$query2 = " SELECT `nom`,`prenom`,`photo`,`prem_accepte`,`supp`,`desactiver` FROM `compte` where `id_compte` = ".$row["id_compte"]." " ;
								$result2 = mysqli_query($connect, $query2);
								$row2 = mysqli_fetch_array($result2);
								if(($row2['supp']!= 1 ) && ($row2['desactiver'] != 1 )){
									if($row2['prem_accepte'] == 1 ){
										if( (!empty($_POST["ville_depart"]) ) && (empty($_POST["ville_arrive"])) ){
											$ville_depart = $_POST['ville_depart'];
											if(!empty($_POST['date_depart'])){
												$date_depart= $_POST['date_depart'];
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet}) ";
												$result3 = mysqli_query($connect, $query3);
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
														$output .= affichage($row,$row2,$row3,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_depart']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
																break;
															}
														}
													}
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
														$output .= affichage($row,$row2,$row4,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_depart']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
																break;
															}
														}
													}
												}
											}

											else{
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
												$result3 = mysqli_query($connect, $query3);
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
														$output .= affichage($row,$row2,$row3,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_depart']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
																break;
															}
														}
													}
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
														$output .= affichage($row,$row2,$row4,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_depart']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
																break;
															}
														}
													}
												}
											}
										}

										elseif( (empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){
											$ville_arrive = $_POST['ville_arrive'];
											if(!empty($_POST['date_depart'])){
												$date_depart= $_POST['date_depart'];
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet})";
												$result3 = mysqli_query($connect, $query3);
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
														$output .= affichage($row,$row2,$row3,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $ville_arrive ) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
																break;
															}
														}
													}
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
														$output .= affichage($row,$row2,$row4,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_arrive']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
																break;
															}
														}
													}
												}
											}
											else{
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
												$result3 = mysqli_query($connect, $query3);
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
														$output .= affichage($row,$row2,$row3,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_arrive']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
																break;
															}
														}
													}
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
														$output .= affichage($row,$row2,$row4,$reg,$result5);
													}else{
														while( $row5 = mysqli_fetch_array($result5)){
															if ($row5['arret'] == $_POST['ville_arrive']) {
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
																break;
															}
														}
													}
												}
											}
										}

										elseif( (!empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){

											$ville_depart = $_POST['ville_depart'];
											$ville_arrive = $_POST['ville_arrive'];
											if(!empty($_POST['date_depart'])){
												$date_depart= $_POST['date_depart'];
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet}) ";
												$result3 = mysqli_query($connect, $query3);
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
														if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
															$result5 = mysqli_query($connect, $query5);
															$output .= affichage($row,$row2,$row3,$reg,$result5);
														}else{
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
															$result5 = mysqli_query($connect, $query5);
															if(mysqli_num_rows($result5) > 0 ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
															}
														}
													}
													else{
														$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
														$result5 = mysqli_query($connect, $query5);
														if(mysqli_num_rows($result5) > 0 ){
															if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
															}else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
																$result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row3,$reg,$result5);
																}
															}
														}
													}
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
														if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
															$result5 = mysqli_query($connect, $query5);
															$output .= affichage($row,$row2,$row4,$reg,$result5);
														}else{
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
															$result5 = mysqli_query($connect, $query5);
															if(mysqli_num_rows($result5) > 0 ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
															}
														}
													}
													else{
														$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
														$result5 = mysqli_query($connect, $query5);
														if(mysqli_num_rows($result5) > 0 ){
															if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
															}else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
																$result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row4,$reg,$result5);
																}
															}
														}
													}
												}
											}
											else{

													$date_depart= $_POST['date_depart'];
													$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE  `id_trajet` = {$id_trajet} ";
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = {$id_trajet}";
													$result3 = mysqli_query($connect, $query3);
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
															if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
															}else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
																$result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row3,$reg,$result5);
																}
															}
														}
														else{
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
															$result5 = mysqli_query($connect, $query5);
															if(mysqli_num_rows($result5) > 0 ){
																if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row3,$reg,$result5);
																}else{
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
																	$result5 = mysqli_query($connect, $query5);
																	if(mysqli_num_rows($result5) > 0 ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																		$result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row3,$reg,$result5);
																	}
																}
															}
														}
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
															if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																$result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
															}else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
																$result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row4,$reg,$result5);
																}
															}
														}
														else{
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
															$result5 = mysqli_query($connect, $query5);
															if(mysqli_num_rows($result5) > 0 ){
																if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row4,$reg,$result5);
																}else{
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
																	$result5 = mysqli_query($connect, $query5);
																	if(mysqli_num_rows($result5) > 0 ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																		$result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row4,$reg,$result5);
																	}
																}
															}
														}
													}
											}


										}

										else{
											if(!empty($_POST['date_depart'])){
												$date_depart= $_POST['date_depart'];
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet}) AND ( `jour` >=  '{$date_depart}' )";
												$result3 = mysqli_query($connect, $query3);
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													$output .= affichage($row,$row2,$row3,$reg,$result5);
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													$output .= affichage($row,$row2,$row4,$reg,$result5);
												}
											}
											else{
												$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
												$result3 = mysqli_query($connect, $query3);
												$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
												$result4 = mysqli_query($connect, $query4);
												if(mysqli_num_rows($result3)>0){
													$reg = 0 ;
													$row3 = mysqli_fetch_array($result3);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													$output .= affichage($row,$row2,$row3,$reg,$result5);
												}
												elseif(mysqli_num_rows($result4)>0){
													$reg = 1 ;
													$row4 = mysqli_fetch_array($result4);
													$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
													$result5 = mysqli_query($connect, $query5);
													$output .= affichage($row,$row2,$row4,$reg,$result5);
												}
											}
										}
									}
								}
			}
      $result = mysqli_query($connect, $query);

			while($row = mysqli_fetch_array($result))
	      {
	                $id_trajet = $row['id_trajet'];
	                $query2 = " SELECT `nom`,`prenom`,`photo`,`prem_accepte`,`supp`,`desactiver` FROM `compte` where `id_compte` = ".$row["id_compte"]." " ;
	                $result2 = mysqli_query($connect, $query2);
	                $row2 = mysqli_fetch_array($result2);
	                if(($row2['supp']!= 1 ) && ($row2['desactiver'] != 1 )){
	                  if($row2['prem_accepte'] != 1 ){
	                    if( (!empty($_POST["ville_depart"]) ) && (empty($_POST["ville_arrive"])) ){
	                      $ville_depart = $_POST['ville_depart'];
												if(!empty($_POST['date_depart'])){
													$date_depart= $_POST['date_depart'];
												  $query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet}) AND ( `jour` >=  '{$date_depart}' )";
													$result3 = mysqli_query($connect, $query3);
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
			                        $output .= affichage($row,$row2,$row3,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_depart']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row3,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
			                        $output .= affichage($row,$row2,$row4,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_depart']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row4,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
												}

												else{
													$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
													$result3 = mysqli_query($connect, $query3);
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
			                        $output .= affichage($row,$row2,$row3,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_depart']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row3,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_depart"] == $_POST["ville_depart"] )  {
			                        $output .= affichage($row,$row2,$row4,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_depart']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row4,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
												}
	                    }

	                    elseif( (empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){
	                      $ville_arrive = $_POST['ville_arrive'];
												if(!empty($_POST['date_depart'])){
													$date_depart= $_POST['date_depart'];
												  $query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet})";
													$result3 = mysqli_query($connect, $query3);
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
			                        $output .= affichage($row,$row2,$row3,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $ville_arrive ) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row3,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
			                        $output .= affichage($row,$row2,$row4,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_arrive']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row4,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
												}
												else{
													$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
													$result3 = mysqli_query($connect, $query3);
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
			                        $output .= affichage($row,$row2,$row3,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_arrive']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row3,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														if ( $row["lieux_arrive"] == $_POST["ville_arrive"] )  {
			                        $output .= affichage($row,$row2,$row4,$reg,$result5);
			                      }else{
			                        while( $row5 = mysqli_fetch_array($result5)){
			                          if ($row5['arret'] == $_POST['ville_arrive']) {
			                            $result5 = mysqli_query($connect, $query5);
			                            $output .= affichage($row,$row2,$row4,$reg,$result5);
			                            break;
			                          }
			                        }
			                      }
													}
												}
	                    }

	                    elseif( (!empty($_POST["ville_depart"]) ) && (!empty($_POST["ville_arrive"])) ){

	                      $ville_depart = $_POST['ville_depart'];
	                      $ville_arrive = $_POST['ville_arrive'];
												if(!empty($_POST['date_depart'])){
													$date_depart= $_POST['date_depart'];
												  $query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet}) ";
													$result3 = mysqli_query($connect, $query3);
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
															if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
					                      $result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row3,$reg,$result5);
															}else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
					                      $result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row3,$reg,$result5);
																}
															}
														}
														else{
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
															$result5 = mysqli_query($connect, $query5);
															if(mysqli_num_rows($result5) > 0 ){
																if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
						                      $result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row3,$reg,$result5);
																}else{
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
						                      $result5 = mysqli_query($connect, $query5);
																	if(mysqli_num_rows($result5) > 0 ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																		$result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row3,$reg,$result5);
																	}
																}
															}
														}
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
															if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
					                      $result5 = mysqli_query($connect, $query5);
																$output .= affichage($row,$row2,$row4,$reg,$result5);
															}else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
					                      $result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																	$result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row4,$reg,$result5);
																}
															}
														}
														else{
															$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
															$result5 = mysqli_query($connect, $query5);
															if(mysqli_num_rows($result5) > 0 ){
																if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
						                      $result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row4,$reg,$result5);
																}else{
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
						                      $result5 = mysqli_query($connect, $query5);
																	if(mysqli_num_rows($result5) > 0 ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																		$result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row4,$reg,$result5);
																	}
																}
															}
														}
													}
												}
												else{

														$date_depart= $_POST['date_depart'];
													  $query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE  `id_trajet` = {$id_trajet} ";
														$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = {$id_trajet}";
														$result3 = mysqli_query($connect, $query3);
														$result4 = mysqli_query($connect, $query4);
														if(mysqli_num_rows($result3)>0){
															$reg = 0 ;
															$row3 = mysqli_fetch_array($result3);
															if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
																if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
						                      $result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row3,$reg,$result5);
																}else{
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
						                      $result5 = mysqli_query($connect, $query5);
																	if(mysqli_num_rows($result5) > 0 ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																		$result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row3,$reg,$result5);
																	}
																}
															}
															else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
																$result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
							                      $result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row3,$reg,$result5);
																	}else{
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
							                      $result5 = mysqli_query($connect, $query5);
																		if(mysqli_num_rows($result5) > 0 ){
																			$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																			$result5 = mysqli_query($connect, $query5);
																			$output .= affichage($row,$row2,$row3,$reg,$result5);
																		}
																	}
																}
															}
														}
														elseif(mysqli_num_rows($result4)>0){
															$reg = 1 ;
															$row4 = mysqli_fetch_array($result4);
															if ($row["lieux_depart"] == $_POST["ville_depart"] )  {
																if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
						                      $result5 = mysqli_query($connect, $query5);
																	$output .= affichage($row,$row2,$row4,$reg,$result5);
																}else{
																	$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
						                      $result5 = mysqli_query($connect, $query5);
																	if(mysqli_num_rows($result5) > 0 ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																		$result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row4,$reg,$result5);
																	}
																}
															}
															else{
																$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_depart}') ";
																$result5 = mysqli_query($connect, $query5);
																if(mysqli_num_rows($result5) > 0 ){
																	if ( $row["lieux_arrive"] == $_POST["ville_arrive"] ){
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
							                      $result5 = mysqli_query($connect, $query5);
																		$output .= affichage($row,$row2,$row4,$reg,$result5);
																	}else{
																		$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) AND (`arret` = '{$ville_arrive}') ";
							                      $result5 = mysqli_query($connect, $query5);
																		if(mysqli_num_rows($result5) > 0 ){
																			$query5 = " SELECT * FROM `arrets` WHERE ( `id_trajet` = {$id_trajet} ) ";
																			$result5 = mysqli_query($connect, $query5);
																			$output .= affichage($row,$row2,$row4,$reg,$result5);
																		}
																	}
																}
															}
														}
												}


	                    }

											else{
												if(!empty($_POST['date_depart'])){
													$date_depart= $_POST['date_depart'];
												  $query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE ( `id_trajet` = {$id_trajet} ) AND ( `date_depart` >= '{$date_depart}' ) ";
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE (`id_trajet` = {$id_trajet})";
													$result3 = mysqli_query($connect, $query3);
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														$output .= affichage($row,$row2,$row3,$reg,$result5);
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														$output .= affichage($row,$row2,$row4,$reg,$result5);
													}
												}
												else{
													$query3 = " SELECT `date_depart` , `date_retour` FROM `trajets_non_reguliers`  WHERE `id_trajet` = {$id_trajet} ";
													$result3 = mysqli_query($connect, $query3);
													$query4 = " SELECT * FROM `trajets_reguliers` WHERE `id_trajet` = ".$id_trajet." ";
													$result4 = mysqli_query($connect, $query4);
													if(mysqli_num_rows($result3)>0){
														$reg = 0 ;
														$row3 = mysqli_fetch_array($result3);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														$output .= affichage($row,$row2,$row3,$reg,$result5);
													}
													elseif(mysqli_num_rows($result4)>0){
														$reg = 1 ;
														$row4 = mysqli_fetch_array($result4);
														$query5=" SELECT * FROM `arrets` WHERE `id_trajet` = ".$id_trajet." ";
														$result5 = mysqli_query($connect, $query5);
														$output .= affichage($row,$row2,$row4,$reg,$result5);
													}
												}
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
