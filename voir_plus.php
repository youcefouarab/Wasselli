<?php
date_default_timezone_set('Africa/Algiers');
$arrets='';
$data="";
$date_depart="rien";
$date_retour="rien";
$jour="rien";
$frequence="rien";
if (isset($_POST["id_coli"]) && isset($_POST["code_notif"]) && isset($_POST["id_trajet"]) && isset($_POST['id_notif'])) {
	$conn=mysqli_connect("localhost","root","","projet2cp");
	
	$data="sss";
	if ( $_POST["code_notif"]!=7 &&  $_POST["code_notif"]!=6) {
		$sql="SELECT * FROM colis WHERE id_colis=".$_POST["id_coli"];//recuperer les infos de mon colis
		$resultat=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($resultat);
		$id_trajet=$row['id_trajet'];
		$sql='SELECT * FROM  trajet where id_trajet='.$id_trajet;
		$resultat=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($resultat);

		$lieu_depart_coli=$row['lieux_depart'];
		$lieu_arrive_coli=$row['lieux_arrive'];
	}			

	
		if( $_POST["code_notif"]==0){//moi colis lui trajet
			$sql='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du trajet
			$date_annonce_trajet=$row["date_annonce"];
			$lieu_depart=$row['lieux_depart'];
			$lieu_arrive=$row['lieux_arrive'];
			$taille_max=$row['taille_max'];
			$poids_max=$row['poids_max'];
			$id=$row['id_compte'];
			$moyen=$row['moyen'];
			$detour_max=$row['detour_max'];

				// trajet regulier ou pas 
			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
			
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}
				
			
			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant un trajet
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			
			$note=$row1['fiab_tran'];

			$sql2="SELECT * FROM colis WHERE id_colis=".$_POST["id_coli"];//recuperer les infos de mon colis
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);
			$date_annonce_coli=$row2["date_annonce"];
			$date_envoi=$row2['date_envoi'];
			$date_depot=$row2['date_depot'];
			$taille=$row2['taille'];
			$poids=$row2['poids'];
			$demande_spec=$row2['demande_spec'];
			$tarif=$row2["tarif"];
			$nom_coli=$row2['nom'];
			$id_compte_r=$row2['id_compte_e'];
			$adr_depart=$row2['adr_depart'];
			$adr_arrive=$row2['adr_arrive'];
			$photo=$row2['photo'];

			$sql11='SELECT * FROM notification WHERE code_notif=0 AND id_compte_r='.$id_compte_r.' AND id_colis='.$_POST["id_coli"]." AND acc=1";
			$resultat11=mysqli_query($conn,$sql11);
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";
			if (mysqli_num_rows($resultat11)==0) {
				$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
				$result10=mysqli_query($conn,$sql10);
				$num_arret=mysqli_num_rows($result10);
				if ($num_arret!=0) {
					$arrets='';
					$sql3='SELECT *FROM arrets where id_trajet='.$_POST["id_trajet"];
					$resultat3=mysqli_query($conn,$sql3);
					$i=1;
					while($row2=mysqli_fetch_assoc($resultat3))//recuperer les arrets					
					{
						$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
						$i++;
					}
				}
				$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
			}
			else//le propritaire de ce coli a dejas accepter une demande
			{
				$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'yes','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);	
			}
		}
		elseif($_POST["code_notif"]==12){//moi colis lui trajet
			$sql='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du trajet
			$date_annonce_trajet=$row["date_annonce"];
			$lieu_depart=$row['lieux_depart'];
			$lieu_arrive=$row['lieux_arrive'];
			$taille_max=$row['taille_max'];
			$poids_max=$row['poids_max'];
			$id=$row['id_compte'];
			$moyen=$row['moyen'];
			$detour_max=$row['detour_max'];

			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}

			
			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant un trajet
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			
			$note=$row1['fiab_tran'];

			$sql2="SELECT * FROM colis WHERE id_colis=".$_POST["id_coli"];//recuperer les infos de mon colis
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);
			$date_annonce_coli=$row2["date_annonce"];
			$date_envoi=$row2['date_envoi'];
			$date_depot=$row2['date_depot'];
			$taille=$row2['taille'];
			$poids=$row2['poids'];
			$demande_spec=$row2['demande_spec'];
			$tarif=$row2["tarif"];
			$nom_coli=$row2['nom'];
			$id_compte_r=$row2['id_compte_e'];
						$adr_depart=$row2['adr_depart'];
			$adr_arrive=$row2['adr_arrive'];
			$photo=$row2['photo'];


			$sql11='SELECT * FROM notification WHERE code_notif=0 AND id_compte_r='.$id_compte_r.' AND id_colis='.$_POST["id_coli"];
			$resultat11=mysqli_query($conn,$sql11);
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";
			if (mysqli_num_rows($resultat11)==1) 
			{
				$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
				$result10=mysqli_query($conn,$sql10);
				$num_arret=mysqli_num_rows($result10);
				if ($num_arret!=0) 
				{
					$arrets='';
					$sql3='SELECT *FROM arrets where id_trajet='.$_POST["id_trajet"];
					$resultat3=mysqli_query($conn,$sql3);
					$i=1;
					while($row2=mysqli_fetch_assoc($resultat3))//recuperer les arrets					
					{
							$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
								$i++;
					}
				}
							
				$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
			}
			else//le propritaire de ce coli a dejas accepter une demande
			{
				$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'yes','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);	
			}
		}
		elseif($_POST["code_notif"]==1 || $_POST["code_notif"]==13){// moi trajet lui colis accepte
			$sql='SELECT * FROM  colis where id_colis='.$_POST["id_coli"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du coli
			$nom_coli=$row['nom'];
			$date_annonce_coli=$row["date_annonce"];
			$date_envoi=$row['date_envoi'];
			$date_depot=$row['date_depot'];
			$taille=$row['taille'];
			$poids=$row['poids'];
			$demande_spec=$row['demande_spec'];
			$tarif=$row["tarif"];
			$id=$row['id_compte_e'];
			$adr_depart=$row['adr_depart'];
			$adr_arrive=$row['adr_arrive'];
			$photo=$row['photo'];

			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant une annonce coli
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			$note=$row1['fiab_env'];

			$sql2='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);//recuperer les infos de mon trajet

			$date_annonce_trajet=$row2["date_annonce"];
			$lieu_depart=$row2['lieux_depart'];
			$lieu_arrive=$row2['lieux_arrive'];
			$taille_max=$row2['taille_max'];
			$poids_max=$row2['poids_max'];
			$moyen=$row2['moyen'];
			$detour_max=$row2['detour_max'];

			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}
			$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
			$result10=mysqli_query($conn,$sql10);
			$num_arret=mysqli_num_rows($result10);


			
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";
			if ($num_arret!=0) {
				$arrets='';
				$sql3='SELECT *FROM arrets where id_trajet='.$_POST['id_trajet'];
				$resultat3=mysqli_query($conn,$sql3);
				$i=1;
			while($row2=mysqli_fetch_assoc($resultat3))//recuperer mes arrets					
				{
					$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
					$i++;
				}
			}
				
			$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
		}
		elseif($_POST["code_notif"]==2){// moi trajet lui colis refuse
			$sql='SELECT * FROM  colis where id_colis='.$_POST["id_coli"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du coli
			$nom_coli=$row['nom'];
			$date_annonce_coli=$row["date_annonce"];
			$date_envoi=$row['date_envoi'];
			$date_depot=$row['date_depot'];
			$taille=$row['taille'];
			$poids=$row['poids'];
			$demande_spec=$row['demande_spec'];
			$tarif=$row["tarif"];
			$id=$row['id_compte_e'];
			$adr_depart=$row['adr_depart'];
			$adr_arrive=$row['adr_arrive'];
			$photo=$row['photo'];


			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant une annonce coli
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			$note=$row1['fiab_env'];

			$sql2='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);//recuperer les infos de mon trajet
			$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
			$result10=mysqli_query($conn,$sql10);
			$num_arret=mysqli_num_rows($result10);
			$date_annonce_trajet=$row2["date_annonce"];
			$lieu_depart=$row2['lieux_depart'];
			$lieu_arrive=$row2['lieux_arrive'];
			$taille_max=$row2['taille_max'];
			$poids_max=$row2['poids_max'];
			$moyen=$row2['moyen'];
			$detour_max=$row2['detour_max'];

			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";
			if ($num_arret!=0) 
			{
				$arrets='';
				$sql3='SELECT *FROM arrets where id_trajet='.$_POST['id_trajet'];
				$resultat3=mysqli_query($conn,$sql3);
				$i=1;
				while($row2=mysqli_fetch_assoc($resultat3))//recuperer mes arrets					
				{
					$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
					$i++;
				}
			}
				
		$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
		}
		elseif($_POST["code_notif"]==4){//moi colis lui trajet accepte de transporter mon coli
			$sql='SELECT * FROM  colis where id_colis='.$_POST["id_coli"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du coli
			$nom_coli=$row['nom'];
			$date_annonce_coli=$row["date_annonce"];
			$date_envoi=$row['date_envoi'];
			$date_depot=$row['date_depot'];
			$taille=$row['taille'];
			$poids=$row['poids'];
			$demande_spec=$row['demande_spec'];
			$tarif=$row["tarif"];
			$adr_depart=$row['adr_depart'];
			$adr_arrive=$row['adr_arrive'];
			$photo=$row['photo'];

			
			$sql2='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);//recuperer les infos de mon coli
			$id=$row2['id_compte'];
			$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
			$result10=mysqli_query($conn,$sql10);
			$num_arret=mysqli_num_rows($result10);
			$date_annonce_trajet=$row2["date_annonce"];
			$lieu_depart=$row2['lieux_depart'];
			$lieu_arrive=$row2['lieux_arrive'];
			$taille_max=$row2['taille_max'];
			$poids_max=$row2['poids_max'];
			$moyen=$row2['moyen'];
			$detour_max=$row2['detour_max'];
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";

			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}

			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant une annonce trajet
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			$note=$row1['fiab_tran'];

			if ($num_arret!=0) {
				$arrets='';
				$sql3='SELECT *FROM arrets where id_trajet='.$_POST['id_trajet'];
				$resultat3=mysqli_query($conn,$sql3);
				$i=1;
				while($row2=mysqli_fetch_assoc($resultat3))//recuperer mes arrets					
				{
					$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
					$i++;
				}
			}
				
		$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
		}
		elseif($_POST["code_notif"]==3 || $_POST["code_notif"]==11){//moi trajet lui coli demande 
			$sql='SELECT * FROM  colis where id_colis='.$_POST["id_coli"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du coli
			$nom_coli=$row['nom'];
			$date_annonce_coli=$row["date_annonce"];
			$date_envoi=$row['date_envoi'];
			$date_depot=$row['date_depot'];
			$taille=$row['taille'];
			$poids=$row['poids'];
			$demande_spec=$row['demande_spec'];
			$tarif=$row["tarif"];
			$id=$row['id_compte_e'];
			$adr_depart=$row['adr_depart'];
			$adr_arrive=$row['adr_arrive'];
			$photo=$row['photo'];


			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant une annonce coli
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			$note=$row1['fiab_env'];

			$sql2='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);//recuperer les infos de mon trajet
			$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
			$result10=mysqli_query($conn,$sql10);
			$num_arret=mysqli_num_rows($result10);
			$date_annonce_trajet=$row2["date_annonce"];
			$lieu_depart=$row2['lieux_depart'];
			$lieu_arrive=$row2['lieux_arrive'];
			$taille_max=$row2['taille_max'];
			$poids_max=$row2['poids_max'];
			$moyen=$row2['moyen'];
			$detour_max=$row2['detour_max'];
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";

			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}
			if ($num_arret!=0) {
				$arrets='';
				$sql3='SELECT *FROM arrets where id_trajet='.$_POST['id_trajet'];
				$resultat3=mysqli_query($conn,$sql3);
				$i=1;
			while($row2=mysqli_fetch_assoc($resultat3))//recuperer mes arrets					
				{
					$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
					$i++;
				}
			}
			$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
		}
		elseif($_POST["code_notif"]==5){
			$sql='SELECT * FROM  colis where id_colis='.$_POST["id_coli"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du coli
			$nom_coli=$row['nom'];
			$date_annonce_coli=$row["date_annonce"];
			$date_envoi=$row['date_envoi'];
			$date_depot=$row['date_depot'];
			$taille=$row['taille'];
			$poids=$row['poids'];
			$demande_spec=$row['demande_spec'];
			$tarif=$row["tarif"];
			$adr_depart=$row['adr_depart'];
			$adr_arrive=$row['adr_arrive'];
			$photo=$row['photo'];


			$sql2='SELECT * FROM  trajet WHERE id_trajet='.$_POST["id_trajet"];
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);//recuperer les infos de mon trajet
			$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
			$result10=mysqli_query($conn,$sql10);
			$num_arret=mysqli_num_rows($result10);
			$date_annonce_trajet=$row2["date_annonce"];
			$lieu_depart=$row2['lieux_depart'];
			$lieu_arrive=$row2['lieux_arrive'];
			$taille_max=$row2['taille_max'];
			$poids_max=$row2['poids_max'];
			$moyen=$row2['moyen'];
			$detour_max=$row2['detour_max'];
			$id=$row2['id_compte'];
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";


			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant une annonce coli
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			$note=$row1['fiab_tran'];

			$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
			
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}
			if ($num_arret!=0) {
				$arrets='';
				$sql3='SELECT *FROM arrets where id_trajet='.$_POST['id_trajet'];
				$resultat3=mysqli_query($conn,$sql3);
				$i=1;
			while($row2=mysqli_fetch_assoc($resultat3))//recuperer mes arrets					
				{
					$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
					$i++;
				}
			}
				
				$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);	
		}
		elseif($_POST["code_notif"]==7){//refuse premium 
			$sql2='SELECT * FROM  cause_ref WHERE id_notif='.$_POST["id_notif"];
			$resultat2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_assoc($resultat2);
				if (mysqli_num_rows($resultat2)>0) {
				$text=$row2['cause'];

				$data=array('no_prem'=>$text);
			}
			else {$data=array('no_prem'=>'');}
		}
		elseif($_POST["code_notif"]==8 || $_POST["code_notif"]==9 || $_POST["code_notif"]==10 ){
				$sql='SELECT * FROM  colis where id_colis='.$_POST["id_coli"];
			$resultat=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($resultat);//recuperer les infos du coli
			$nom_coli=$row['nom'];
			$date_annonce_coli=$row["date_annonce"];
			$date_envoi=$row['date_envoi'];
			$date_depot=$row['date_depot'];
			$taille=$row['taille'];
			$poids=$row['poids'];
			$demande_spec=$row['demande_spec'];
			$tarif=$row["tarif"];
						$adr_depart=$row['adr_depart'];
			$adr_arrive=$row['adr_arrive'];
			$photo=$row['photo'];

			
			$sql2='SELECT * FROM  trajet where id_trajet='.$_POST["id_trajet"];
			$resultat2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($resultat2);//recuperer les infos de mon coli
			$id=$row2['id_compte'];
			$sql10="SELECT * FROM arrets WHERE id_trajet=".$_POST['id_trajet'];
			$result10=mysqli_query($conn,$sql10);
			$num_arret=mysqli_num_rows($result10);
			$date_annonce_trajet=$row2["date_annonce"];
			$lieu_depart=$row2['lieux_depart'];
			$lieu_arrive=$row2['lieux_arrive'];
			$taille_max=$row2['taille_max'];
			$poids_max=$row2['poids_max'];
			$moyen=$row2['moyen'];
			$detour_max=$row2['detour_max'];
			$arrets="<tr > <td style='text-align: center;'>pas d'arrets</td></tr>";

						$sql_trajet='SELECT * FROM  trajets_non_reguliers where id_trajet='.$_POST["id_trajet"];
			$resultat_trajet=mysqli_query($conn,$sql_trajet);
			
			if (mysqli_num_rows($resultat_trajet)>0) {// trajet non regulier
				$row_trajet=mysqli_fetch_assoc($resultat_trajet);
				$date_depart=$row_trajet['date_depart'];
				$date_retour=$row_trajet['date_retour'];
				if ($date_retour=="0000-00-00") {
					$date_retour="rien";
				}
			}
			else
			{
				$sql_trajet='SELECT * FROM  trajets_reguliers where id_trajet='.$_POST["id_trajet"];
				$resultat_trajet=mysqli_query($conn,$sql_trajet);
				if (mysqli_num_rows($resultat_trajet)>0) {
					$row_trajet=mysqli_fetch_assoc($resultat_trajet);
					$jour=$row_trajet['jour'];
					$frequence=$row_trajet['frequence'];	
				}
			}

			$sql1='SELECT *FROM compte where id_compte='.$id;
			$resultat1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($resultat1);//recuperer les info d'utilisateur deposant une annonce trajet
			$nom=$row1['nom'];
			$prenom=$row1['prenom'];
			$note=$row1['fiab_tran'];

			if ($num_arret!=0) {
				$arrets='';
				$sql3='SELECT *FROM arrets where id_trajet='.$_POST['id_trajet'];
				$resultat3=mysqli_query($conn,$sql3);
				$i=1;
				while($row2=mysqli_fetch_assoc($resultat3))//recuperer mes arrets					
				{
					$arrets.="<tr > <td style='text-align: center;'>".$row2['arret']."</td></tr>";
					$i++;
				}
			}
				
				$data = array('date_annonce_coli'=> $date_annonce_coli,'lieu_depart'=>$lieu_depart,'lieu_arrive'=>$lieu_arrive,'taille_max'=>$taille_max,'poids_max'=>$poids_max,'date_annonce_trajet'=>$date_annonce_trajet,'date_envoi'=>$date_envoi,'date_depot'=>$date_depot,'taille'=>$taille,'poids'=>$poids,'demande_spec'=>$demande_spec,'tarif'=>$tarif,'nom_coli'=>$nom_coli,'nom'=>$nom,'prenom'=>$prenom,'arret'=>$arrets,'id_colis'=>$_POST["id_coli"],'id_trajet'=>$_POST["id_trajet"],'note'=>$note,'accepter'=>'','adr_depart'=>$adr_depart,'adr_arrive'=>$adr_arrive,"frequence"=>$frequence,"date_depart"=>$date_depart,"date_retour"=>$date_retour,"jour"=>$jour,"moyen"=>$moyen,"detour_max"=>$detour_max,"lieu_depart_coli"=>$lieu_depart_coli,"lieu_arrive_coli"=>$lieu_arrive_coli,"photo"=>$photo);
		}		
		else{
			$data="  ";
		
		}
	
		echo json_encode($data);
	}
	else
	{
		$data=' ';
		echo json_encode($data);	
	}
?>