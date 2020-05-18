<?php

	function nb_coli ($i) // annonce colis ajourd'hui 
	{
  		$conn=mysqli_connect("localhost","root","","projet2cp");
  		$sql="SELECT * FROM colis where date_annonce='$i' AND supp=0 ";
  		$rs=mysqli_query($conn,$sql);
  		if ($rs)
  		{
  			$result = mysqli_num_rows($rs);
  			return $result;
  		}
	}

	function nb_trajet ($i) 
	{
  		$conn=mysqli_connect("localhost","root","","projet2cp");
  		$sql="SELECT * FROM trajet where date_annonce='$i' AND poids_max != 0 AND supp=0 ";
  		$rs=mysqli_query($conn,$sql);
  		if ($rs)
  		{
  			$result = mysqli_num_rows($rs);
  			return $result;
  		}
	}

	function nb_ins ($i){ 
		$conn=mysqli_connect("localhost","root","","projet2cp");
		$sql="SELECT * FROM compte where date_insc='$i' AND supp=0 AND desactiver=0 ";
		$rs=mysqli_query($conn,$sql);
		if ($rs)
		{
			$result = mysqli_num_rows($rs);
			return $result;
		}
	}

	function monsc($i,$x){  
		$conn=mysqli_connect("localhost","root","","projet2cp");
		$sql="SELECT * FROM compte where MONTH(date_insc)='$i' and YEAR(date_insc)='$x' AND supp=0 AND desactiver=0 ";
		$rs=mysqli_query($conn,$sql);
		if ($rs)
		{
			$result = mysqli_num_rows($rs);
			return $result;
		}
	}

	function moncol($i,$x){
		$conn=mysqli_connect("localhost","root","","projet2cp");
		$sql="SELECT * FROM colis where MONTH(date_annonce)='$i' and YEAR(date_annonce)='$x' AND supp=0 ";
		$rs=mysqli_query($conn,$sql);
		if ($rs)
		{
			$result = mysqli_num_rows($rs);
			return $result;
		}
	}

	function montrj($i,$x){
		$conn=mysqli_connect("localhost","root","","projet2cp");
		$sql="SELECT * FROM trajet where MONTH(date_annonce)='$i' and YEAR(date_annonce)='$x' AND supp=0 AND poids_max != 0 ";
		$rs=mysqli_query($conn,$sql);
		if ($rs)
		{
			$result = mysqli_num_rows($rs);
			return $result;
		}
	}

	function wlytrj($i)
	{
		$conn=mysqli_connect("localhost","root","","projet2cp");

		switch ($i) {
		case '1':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Adrar' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Adrar' AND ( poids_max != 0 ) " ;
			break;
		
		case '2':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Chlef' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Chlef' AND ( poids_max != 0 ) " ;
			break;

		case '3':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Laghouat' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Laghouat' AND ( poids_max != 0 ) " ;
			break;

		case '4':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Oum El Bouaghi' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Oum El Bouaghi' AND ( poids_max != 0 ) " ;
			break;

		case '5':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Batna' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Batna' AND ( poids_max != 0 ) " ;
			break;

		case '6':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Béjaïa' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Béjaïa' AND ( poids_max != 0 ) " ;
			break;

		case '7':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Biskra' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Biskra' AND ( poids_max != 0 ) " ;
			break;

		case '8':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Béchar' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Béchar' AND ( poids_max != 0 ) " ;
			break;

		case '9':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Blida' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Blida' AND ( poids_max != 0 ) " ;
			break;

		case '10':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Bouira' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Bouira' AND ( poids_max != 0 ) " ;
			break;

		case '11':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tamanrasset' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tamanrasset' AND ( poids_max != 0 ) " ;
			break;
		
		case '12':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tébessa' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tébessa' AND ( poids_max != 0 ) " ;
			break;
		
		case '13':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tlemcen' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tlemcen' AND ( poids_max != 0 ) " ;	    
			break;
		
		case '14':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tiaret' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tiaret' AND ( poids_max != 0 ) " ;
			break;
		
		case '15':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tizi ozou' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tizi ouzou' AND ( poids_max != 0 ) " ;
			break;
		
		case '16':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Alger' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Alger' AND ( poids_max != 0 ) " ;
			break;
		
		case '17':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Djelfa' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Djelfa' AND ( poids_max != 0 ) " ;
			break;
		
		case '18':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Jijel' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Jijel' AND ( poids_max != 0 ) " ;
			break;
		
		case '19':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Sétif' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Sétif' AND ( poids_max != 0 ) " ;
			break;
		
		case '20':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Saïda' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Saïda' AND ( poids_max != 0 ) " ;
			break;	
		
		case '21':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Skikda' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Skikda' AND ( poids_max != 0 ) " ;
			break;	
		
		case '22':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Sidi Bel Abbès' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Sidi Bel Abbès' AND ( poids_max != 0 ) " ;
			break;	
		
		case '23':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Annaba' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Annaba' AND ( poids_max != 0 ) " ;
			break;	
		
		case '24':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Guelma' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Guelma' AND ( poids_max != 0 ) " ;
			break;	
		
		case '25':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Canstantine' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Canstantine' AND ( poids_max != 0 ) " ;
			break;	
		
		case '26':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Médéa' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Médéa' AND ( poids_max != 0 ) " ;
			break;	
		
		case '27':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Mostaganem' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Mostaganem' AND ( poids_max != 0 ) " ;
			break;	
		
		case '28':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='M’Sila' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='M’Sila' AND ( poids_max != 0 ) " ;
			break;	
		
		case '29':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Mascara' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Mascara' AND ( poids_max != 0 ) " ;
			break;	
		
		case '30':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Ouargla' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Ouargla' AND ( poids_max != 0 ) " ;
			break;	
		
		case '31':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Oran' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Oran' AND ( poids_max != 0 ) " ;
			break;	
		
		case '32':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='El Bayadh' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='El Bayadh' AND ( poids_max != 0 ) " ;
			break;	
		
		case '33':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Illizi' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Illizi' AND ( poids_max != 0 ) " ;
			break;	
		
		case '34':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Bordj Bou Arreridj' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Bordj Bou Arreridj' AND ( poids_max != 0 ) " ;
			break;	
		
		case '35':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Boumerdès' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Boumerdès' AND ( poids_max != 0 ) " ;	    
			break;

		case '36':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='El Tarf' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='El Tarf' AND ( poids_max != 0 ) " ;
			break;	
		
		case '37':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tindouf' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tindouf' AND ( poids_max != 0 ) " ;
			break;	
		
		case '38':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tissemsilt' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tissemsilt' AND ( poids_max != 0 ) " ;
			break;	
		
		case '39':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='El Oued' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='El Oued' AND ( poids_max != 0 ) " ;
			break;	
		
		case '40':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Khenchela' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Khenchela' AND ( poids_max != 0 ) " ;
			break;	
		
		case '41':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Souk Ahras' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Souk Ahras' AND ( poids_max != 0 ) " ;
			break;	
		
		case '42':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tipaza' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tipaza' AND ( poids_max != 0 ) " ;
			break;	
		
		case '43':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Mila' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Mila' AND ( poids_max != 0 ) " ;
			break;	
		
		case '44':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Aïn Defla' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Aïn Defla' AND ( poids_max != 0 ) " ;
			break;	
		
		case '45':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Naâma' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Naâma' AND ( poids_max != 0 ) " ;
			break;	
		
		case '46':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Témouchent' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Témouchent' AND ( poids_max != 0 ) " ;
			break;	
		
		case '47':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Ghardaia' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Ghardaia' AND ( poids_max != 0 ) " ;
			break;	
		
		case '48':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Relizane' AND ( poids_max != 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Relizane' AND ( poids_max != 0 ) " ;
			break;	
		
		}

		$resultat_1 = mysqli_query($conn,$requete_1) or die();
		$nombre_1   = mysqli_num_rows($resultat_1);
		$resultat_2 = mysqli_query($conn,$requete_2) or die();
    	$nombre_1   += mysqli_num_rows($resultat_2);
		return $nombre_1;

	}

	function wlycol($i)
	{
		$conn=mysqli_connect("localhost","root","","projet2cp");
		switch ($i) {
		case '1':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Adrar' AND ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Adrar' AND ( poids_max = 0 ) " ;
			break;
		
		case '2':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Chlef' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Chlef' And ( poids_max = 0 ) " ;
			break;

		case '3':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Laghouat' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Laghouat' And ( poids_max = 0 ) " ;
			break;

		case '4':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Oum El Bouaghi' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Oum El Bouaghi' And ( poids_max = 0 ) " ;
			break;

		case '5':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Batna' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Batna' And ( poids_max = 0 ) " ;
			break;

		case '6':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Béjaïa' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Béjaïa' And ( poids_max = 0 ) " ;
			break;

		case '7':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Biskra' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Biskra' And ( poids_max = 0 ) " ;
			break;

		case '8':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Béchar' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Béchar' And ( poids_max = 0 ) " ;
			break;

		case '9':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Blida' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Blida' And ( poids_max = 0 ) " ;
			break;

		case '10':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Bouira' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Bouira' And ( poids_max = 0 ) " ;
			break;

		case '11':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tamanrasset' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tamanrasset' And ( poids_max = 0 ) " ;
			break;
		
		case '12':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tébessa' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tébessa' And ( poids_max = 0 ) " ;
			break;
		
		case '13':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tlemcen' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tlemcen' And ( poids_max = 0 ) " ;	    
			break;
		
		case '14':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tiaret' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tiaret' And ( poids_max = 0 ) " ;
			break;
		
		case '15':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tizi ozou' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tizi ouzou' And ( poids_max = 0 ) " ;
			break;
		
		case '16':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Alger' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Alger' And ( poids_max = 0 ) " ;
			break;
		
		case '17':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Djelfa' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Djelfa' And ( poids_max = 0 ) " ;
			break;
		
		case '18':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Jijel' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Jijel' And ( poids_max = 0 ) " ;
			break;
		
		case '19':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Sétif' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Sétif' And ( poids_max = 0 ) " ;
			break;
		
		case '20':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Saïda' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Saïda' And ( poids_max = 0 ) " ;
			break;	
		
		case '21':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Skikda' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Skikda' And ( poids_max = 0 ) " ;
			break;	
		
		case '22':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Sidi Bel Abbès' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Sidi Bel Abbès' And ( poids_max = 0 ) " ;
			break;	
		
		case '23':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Annaba' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Annaba' And ( poids_max = 0 ) " ;
			break;	
		
		case '24':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Guelma' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Guelma' And ( poids_max = 0 ) " ;
			break;	
		
		case '25':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Canstantine' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Canstantine' And ( poids_max = 0 ) " ;
			break;	
		
		case '26':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Médéa' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Médéa' And ( poids_max = 0 ) " ;
			break;	
		
		case '27':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Mostaganem' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Mostaganem' And ( poids_max = 0 ) " ;
			break;	
		
		case '28':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='M’Sila' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='M’Sila' And ( poids_max = 0 ) " ;
			break;	
		
		case '29':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Mascara' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Mascara' And ( poids_max = 0 ) " ;
			break;	
		
		case '30':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Ouargla' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Ouargla' And ( poids_max = 0 ) " ;
			break;	
		
		case '31':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Oran' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Oran' And ( poids_max = 0 ) " ;
			break;	
		
		case '32':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='El Bayadh' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='El Bayadh' And ( poids_max = 0 ) " ;
			break;	
		
		case '33':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Illizi' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Illizi' And ( poids_max = 0 ) " ;
			break;	
		
		case '34':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Bordj Bou Arreridj' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Bordj Bou Arreridj' And ( poids_max = 0 ) " ;
			break;	
		
		case '35':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Boumerdès' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Boumerdès' And ( poids_max = 0 ) " ;	    
			break;

		case '36':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='El Tarf' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='El Tarf' And ( poids_max = 0 ) " ;
			break;	
		
		case '37':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tindouf' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tindouf' And ( poids_max = 0 ) " ;
			break;	
		
		case '38':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tissemsilt' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tissemsilt' And ( poids_max = 0 ) " ;
			break;	
		
		case '39':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='El Oued' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='El Oued' And ( poids_max = 0 ) " ;
			break;	
		
		case '40':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Khenchela' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Khenchela' And ( poids_max = 0 ) " ;
			break;	
		
		case '41':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Souk Ahras' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Souk Ahras' And ( poids_max = 0 ) " ;
			break;	
		
		case '42':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Tipaza' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Tipaza' And ( poids_max = 0 ) " ;
			break;	
		
		case '43':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Mila' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Mila' And ( poids_max = 0 ) " ;
			break;	
		
		case '44':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Aïn Defla' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Aïn Defla' And ( poids_max = 0 ) " ;
			break;	
		
		case '45':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Naâma' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Naâma' And ( poids_max = 0 ) " ;
			break;	
		
		case '46':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Témouchent' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Témouchent' And ( poids_max = 0 ) " ;
			break;	
		
		case '47':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Ghardaia' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Ghardaia' And ( poids_max = 0 ) " ;
			break;	
		
		case '48':
			$requete_1 = "SELECT * FROM trajet where lieux_arrive='Relizane' And ( poids_max = 0 ) " ;
			$requete_2 = "SELECT * FROM trajet where lieux_depart='Relizane' And ( poids_max = 0 ) " ;
			break;	
		
		}
	
		
		$resultat_1 = mysqli_query($conn,$requete_1) or die();
		$nombre_1   = mysqli_num_rows($resultat_1);
		$resultat_2 = mysqli_query($conn,$requete_2) or die();
    	$nombre_1   += mysqli_num_rows($resultat_2);
		return $nombre_1;

	}

	function totalwly($i){
		$a=wlycol($i)+wlytrj($i);
		return $a;	
	}

?>