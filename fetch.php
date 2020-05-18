


<?php
	

	/*require 'dbh.inc.php';*/
date_default_timezone_set('Africa/Algiers');
	$conn=mysqli_connect("localhost","root","","projet2cp");
	$temps=date('Y/m/d');
	if (isset($_POST['email']) && isset($_POST['view'])){
		$output='';
		$depasse=false;
		$email=$_POST['email'];
		$sql="SELECT * FROM compte WHERE mail='$email'";
		$result=mysqli_query($conn,$sql);
		$i="5";
		
		if (mysqli_num_rows($result)>0){
			$row=mysqli_fetch_assoc($result);
			$id=$row["id_compte"];
			$sql="SELECT * FROM notification WHERE id_compte_r='$id' AND close=0 ORDER BY date_temps DESC";
			$result=mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0) {
				  mysqli_data_seek($result,0);
				$i=mysqli_num_rows($result);
		
				while($row=mysqli_fetch_assoc($result))
				{

					$vu=$row['vu'];
					$acc=$row['acc'];
					$close=$row['close'];
					if ($vu==1) {
							$color="#808080";
							$icon="glyphicon-eye-open";
					}
					else 
					{
							$color="";
								$icon="glyphicon-eye-close";
					}
					if($close==1)
					{
						$fermer='display:none';
					}
					else
					{
						$fermer='';
					}
					$temps_notif=$row['date_temps'];
					$temps_now=date("Y/m/d");
					$x=explode(' ', $temps_notif);
					$y=explode('-', $x[0]);
					$temps_notif=$y[2].'-'.$y[1].'-'.$y[0].' '.$x[1];
					if((strtotime($x[0])) ==( strtotime($temps_now)))
					{
						$temps_notif=$x[1];
					}
					else 
					{
											$x=explode(' ', $temps_notif);
					$a=$x[0];
					$z=explode('-', $a);
					$temps_now=date("Y");
					if((strtotime($z[2])) ==( strtotime($temps_now)))
					{
						$temps_notif=$z[0].'-'.$z[1].' '.$x[1];
					}

					}
					$y=explode(':', $temps_notif);
					$temps_notif=$y[0].':'.$y[1];
				

					$id_notif=$row['id_notif'];
					$id_colis=$row['id_colis'];
					$id_trajet=$row['id_trajet'];
					$code_notif=$row['code_notif'];

					


						if($code_notif== 0){//demande colis 
						$nom_coli='';
						
							$sql1="SELECT * FROM trajet WHERE id_trajet='$id_trajet'";//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
								$sqlt='SELECT * FROM trajets_non_reguliers WHERE id_trajet='.$id_trajet;
								$resultt=mysqli_query($conn,$sqlt);
								if(mysqli_num_rows($resultt)>0)//trajet non_regulier
								{
									$rowt=mysqli_fetch_assoc($resultt);
									$date_depart=$rowt['date_depart'];
									if (strtotime($date_depart)<strtotime($temps))// la date d'aujourd'hui a depasse la date de depart du tranporteur 
									{
										$fermer='display:none';
										$sql='UPDATE notification SET close=1 WHERE id_notif='.$id_notif;
										$resulta=mysqli_query($conn,$sql);
										$depasse=true;

									}

								}
							}
							$sql2="SELECT * FROM colis WHERE id_colis='$id_colis'";//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}


							$sql3="SELECT * FROM compte WHERE id_compte='$id_compte_e'";//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}								
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." a demande de transporter votre coli ".$nom_coli;
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}


								
								if(!$depasse){
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST' target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";}
							}	
									
							}

							
						elseif($code_notif== 1){//accepte une demande colis ,j ai un trajet je fait une demande coli ,le propreitaire m accepte
							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//cherchons les infos du colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
								$id_compte_e=$row2['id_compte_e'];
							}

							$sqlt='SELECT * FROM colis WHERE id_colis='.$id_colis;
								$resultt=mysqli_query($conn,$sqlt);
								if(mysqli_num_rows($resultt)>0)//trajet non_regulier
								{
									$rowt=mysqli_fetch_assoc($resultt);
									$date_depart=$rowt['date_envoi'];
									if (strtotime($date_depart)<strtotime($temps))// la date d'aujourd'hui a depasse la date de depart du tranporteur 
									{
										$fermer='display:none';
										$sql='UPDATE notification SET close=1 WHERE id_notif='.$id_notif;
										$resulta=mysqli_query($conn,$sql);
										$depasse=true;

									}

								}
								
							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//mon trajet 
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z="Valider la demande coli";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST' target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}	
							}
							
						elseif($code_notif== 2){
							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//cherchons les infos du colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
								$id_compte_e=$row2['id_compte_e'];
							}

							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//mon trajet 
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." a refuser que vous transporte son coli ".$nom_coli;
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}


								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST' target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";;
							}		
							}
							elseif($code_notif== 3){//demande un trajet 
							$sql1="SELECT * FROM colis WHERE id_colis=".$id_colis;//cherchons les infos du colis
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte_e'];
								$nom_coli=$row1['nom'];
								$id_trajet_coli=$row1['id_trajet'];

							}
							

							$sql2="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//mon trajet
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." a demande de transporter son coli ".$nom_coli;
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								$sqlt='SELECT * FROM colis WHERE id_colis='.$id_colis;
								$resultt=mysqli_query($conn,$sqlt);
								if(mysqli_num_rows($resultt)>0)//trajet non_regulier
								{
									$rowt=mysqli_fetch_assoc($resultt);
									$date_depart=$rowt['date_depot'];
									if (strtotime($date_depart)<strtotime($temps))// la date d'aujourd'hui a depasse la date de depart du tranporteur 
									{
										$fermer='display:none';
										$sql='UPDATE notification SET close=1 WHERE id_notif='.$id_notif;
										$resulta=mysqli_query($conn,$sql);
										$depasse=true;

									}

								}
								if(!$depasse){
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";}
							}		
							}
							elseif($code_notif== 4){//accepte une demande trajet ,j ai un colis je fait une demande trajet ,le propreitaire m accepte
							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
							}

							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}
															$sqlt='SELECT * FROM trajets_non_reguliers WHERE id_trajet='.$id_trajet;
								$resultt=mysqli_query($conn,$sqlt);
								if(mysqli_num_rows($resultt)>0)//trajet non_regulier
								{
									$rowt=mysqli_fetch_assoc($resultt);
									$date_depart=$rowt['date_depart'];
									if (strtotime($date_depart)<strtotime($temps))// la date d'aujourd'hui a depasse la date de depart du tranporteur 
									{
										$fermer='display:none';
										$sql='UPDATE notification SET close=1 WHERE id_notif='.$id_notif;
										$resulta=mysqli_query($conn,$sql);
										$depasse=true;

									}

								}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);

								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z="Valider la demande trajet";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")' id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
										
							}
							else if($code_notif== 5){
							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
							}

							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." a refuser de tronsporter vote colis ".$nom_coli;
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}
									}	
							elseif($code_notif== 6){
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br> l'administrateur vous accepte comme un utilisateur premium<br/></li>";
								# code...
								}
							elseif($code_notif== 7){
							$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br> vous étes refusé d'etre un utilisateur premium <br/> <button class='btn btn-default notif-button' onclick='VoirPlus(".$id_colis.",".$code_notif.",".$id_trajet.",".$vu.",".$id_notif.",".$acc.")' id='".$id_notif."'>voir plus</button></li>";
								# code...
								}
							elseif($code_notif== 8){//coli annulé
							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
							}

							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}
															$sqlt='SELECT * FROM trajets_non_reguliers WHERE id_trajet='.$id_trajet;
								$resultt=mysqli_query($conn,$sqlt);
								if(mysqli_num_rows($resultt)>0)//trajet non_regulier
								{
									$rowt=mysqli_fetch_assoc($resultt);
									$date_depart=$rowt['date_depart'];
									if (strtotime($date_depart)<strtotime($temps))// la date d'aujourd'hui a depasse la date de depart du tranporteur 
									{
										$fermer='display:none';
										$sql='UPDATE notification SET close=1 WHERE id_notif='.$id_notif;
										$resulta=mysqli_query($conn,$sql);
										$depasse=true;

									}

								}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);

								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom."a annulé votre coli";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";

							}
							elseif($code_notif== 9){//arrive du colis au destination
														$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
							}

							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." vous indique que votre colis ".$nom_coli." est arrivé au destination";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}

								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}	
								
							}
							elseif($code_notif== 13){//trajet annule
					$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//cherchons les infos du colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
								$id_compte_e=$row2['id_compte_e'];
							}

							$sqlt='SELECT * FROM colis WHERE id_colis='.$id_colis;
								$resultt=mysqli_query($conn,$sqlt);
								if(mysqli_num_rows($resultt)>0)//trajet non_regulier
								{
									$rowt=mysqli_fetch_assoc($resultt);
									$date_depart=$rowt['date_envoi'];
									if (strtotime($date_depart)<strtotime($temps))// la date d'aujourd'hui a depasse la date de depart du tranporteur 
									{
										$fermer='display:none';
										$sql='UPDATE notification SET close=1 WHERE id_notif='.$id_notif;
										$resulta=mysqli_query($conn,$sql);
										$depasse=true;

									}

								}
								
							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//mon trajet 
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." a annulé votre trajet";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}		
								
							}

							elseif($code_notif== 10){//coli endomage
														$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
							}

							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z=$nom." vous indique que votre colis ".$nom_coli." a echoué d'arriver";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}

								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}	
								
							}
							elseif($code_notif==11){
								$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//cherchons les infos du colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
								$id_compte_e=$row2['id_compte_e'];
							}
								
							$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//mon trajet 
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z="Validation terminé";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}
								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}
							}
							else if($code_notif==12)
							{
								$sql1="SELECT * FROM trajet WHERE id_trajet=".$id_trajet;//cherchons les infos du trajets
							$result1=mysqli_query($conn,$sql1);
							if (mysqli_num_rows($result1)>0)
							{
								$row1=mysqli_fetch_assoc($result1);
								$id_compte_e=$row1['id_compte'];
							}

							$sql2="SELECT * FROM colis WHERE id_colis=".$id_colis;//mon colis
							$result2=mysqli_query($conn,$sql2);
							if (mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_assoc($result2);
								$nom_coli=$row2['nom'];
							}

							$sql3="SELECT * FROM compte WHERE id_compte=".$id_compte_e;//les infos de l'utilisateur emitteur
							$result3=mysqli_query($conn,$sql3);
							if (mysqli_num_rows($result3)!=1)
							{
								//erreur soit il ya plusieur utilisateur ayant le meme id ,soit cet utilisateur a ete suprime
							}
							else
							{
								$row3=mysqli_fetch_assoc($result3);$prenom=$row3['prenom'];$nom=$row3['nom'];
								$z="Validation terminé";
								if (strlen($z)>60) {
									$x=str_split($z,56);
									$x[0].='...';
									$z=$x[0];
								}

								
								$output.="<li class='notification-li ".$id_notif."' style='background-color:".$color.";".$fermer.";'><span style='float:left;margin-left:10px;' onclick='vuuu(".$id_notif.")' id='glyphicon".$id_notif."'class='glyphicon ".$icon."  '></span><span class='date'>".$temps_notif."</span><span onclick='Close(".$id_notif.")' class='glyphicon glyphicon-remove' style='float:right;margin-right:10px;'></span></br>".$z." <br/> 	<form class='form' action='voir_plus_affichage.php' method='POST'target='_blank'><input type='number' name='id_coli' value=".$id_colis."><input type='number' name='id_trajet' value='".$id_trajet."'><input type='number' name='vu' value='".$vu."'><input type='number' name='id_notif' value='".$id_notif."'><input type='number' name='id' value='".$id_compte_e."'>
		<input type='number' name='acc' value=".$acc."><input type='number' name='code_notif' value='".$code_notif."'><button onclick='vuuu_voir_plus(".$id_notif.")'id='".$id_notif."btn'class='btn btn-default notif-button' name='".$id_notif."Voir' >Voir Plus</button>
	</form></li>";
							}	

							}


						}
					$data = array('notification' =>$output,'id_colis'=>$id_colis,'id_trajet'=>$id_trajet,"num"=>$i); 
					echo json_encode($data);
				}
				else
				{

					$data = array('notification' =>$output); 
					echo json_encode($data);
				}
		}
				
	
	}
	
	else{		$data = array('notification' => 'abc'); 
		echo json_encode($data);}



?>