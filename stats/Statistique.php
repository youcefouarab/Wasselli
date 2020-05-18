<?php

	$conn=mysqli_connect("localhost","root","","projet2cp");
	require "Functions.php";
	$j1 = date("Y-m-d");
	$j11 = date("l");
	$j2 = date('Y-m-d', ( time() - 86400) );
	$j3 = date('Y-m-d', ( time() - 2*86400) );
	$j4 = date('Y-m-d', ( time() - 3*86400) );
	$j5 = date('Y-m-d', ( time() - 4*86400) );
	$j6 = date('Y-m-d', ( time() - 5*86400) );
	$j7 = date('Y-m-d', ( time() - 6*86400) );

	$m1 = date('m');
	$m2 = date('m', strtotime('-1 month'));
	$m3 = date('m', strtotime('-2 month'));
	$m4 = date('m', strtotime('-3 month'));
	$m5 = date('m', strtotime('-4 month'));
	$m6 = date('m', strtotime('-5 month'));
	$m7 = date('m', strtotime('-6 month'));
	$m8 = date('m', strtotime('-7 month'));
	$m9 = date('m', strtotime('-8 month'));
	$m10 = date('m', strtotime('-9 month'));
	$m11 = date('m', strtotime('-10 month'));
	$m12 = date('m', strtotime('-11 month'));

	$y1=$y2=$y3=$y4=$y5=$y6=$y7=$y8=$y9=$y10=$y11=$y12= date('Y');
	$y = date('Y',strtotime('-1 year'));

	switch ($m2) {
		case '01':
			$y2=$y3=$y4=$y5=$y6=$y7=$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '02':
			$y3=$y4=$y5=$y6=$y7=$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '03':
			$y4=$y5=$y6=$y7=$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '04':
			$y5=$y6=$y7=$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '05':
			$y6=$y7=$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '06':
			$y7=$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '07':
			$y8=$y9=$y10=$y11=$y12=$y;
			break;

		case '08':
			$y9=$y10=$y11=$y12=$y;
			break;

		case '09':
			$y10=$y11=$y12=$y;
			break;

		case '10':
			$y11=$y12=$y;
			break;

		case '11':
			$y12=$y;
			break;

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistiques</title>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<!-- <link rel="stylesheet" href="./css/bootstrap.css" type="text/css"> -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<!-- <link rel="stylesheet" href="./css/bootstrap.min.css"> -->
  	<!-- <link rel="stylesheet" href="./css/bootstrap.css"> -->
  	<!-- <link rel="stylesheet" href="./css/bootstrap.min4.css"> -->
    <script type="text/javascript "src="./js/jquery.js"> </script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	 <link rel="stylesheet" href="css/wow.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="../images/icon.png">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<style type="text/css">
		ul li a{
			float:left;
			text-decoration:none;
			text-align:center;
			font-size:13px;
			color:#333;
			font-weight:normal;
			margin:0 0 0 0;
			padding:10px 25px 10px 25px;
			text-transform:uppercase;
			margin:0 0 0 0;
			transition:0.5s; -webkit-transition:0.5s;
		}
		div{
			background-color: #fff;
			margin: auto;
		}
		body{
			background-color: #fff;
		}
		h1,h2,hr{
			color: #187cc2;
			margin: auto;
		}
		h1{
			text-align: center;
		}
		img{
			display: block;
    		margin-left: auto;
	    	margin-right: auto;
		}
	</style>
	<script type="text/javascript">
    	google.charts.load("current", {packages:["corechart"]});
    	google.charts.setOnLoadCallback(drawChart);
    	google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawMultSeries);
		google.charts.load('current', {'packages':['corechart']});
      	google.charts.setOnLoadCallback(drawChart);
    	function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Type', 'Nombre annonces'],
        <?php
        $requete_1  = "SELECT * FROM colis where supp=0 ";
		$resultat_1 = mysqli_query($conn,$requete_1) or die();
	 	$nombre_1   = mysqli_num_rows($resultat_1);
	 	$requete_2  = "SELECT * FROM trajet where supp=0 and poids_max!=0 ";
		$resultat_2 = mysqli_query($conn,$requete_2) or die();
		$nombre_2   = mysqli_num_rows($resultat_2);
        echo "['Colis',".$nombre_1."],";
        echo "['Trajets',".$nombre_2."],";
        ?>
        ]);
 		var options = {
    		title: 'Comparaison Colis/Trajets',
  			pieHole: 0.4,
  			colors: ['#187cc2','#149210'],
  			backgroundColor: {
        	fill: '#ffffff'
    		}
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut1'));
        chart.draw(data, options);

        var data1 = google.visualization.arrayToDataTable([
        ['Type', 'Nombre'],
        <?php
        	$requete1  = "SELECT * FROM compte where prem_accepte=1 and supp=0 and desactiver=0";
 			$resultat1 = mysqli_query($conn,$requete1) or die();
 			$nombre1   = mysqli_num_rows($resultat1);
 			$requete2  = "SELECT * FROM compte where prem_accepte=0 and supp=0 and desactiver=0";
 			$resultat2 = mysqli_query($conn,$requete2) or die();
	 		$nombre2   = mysqli_num_rows($resultat2);
          	echo "['Premium',".$nombre1."],";
         	echo "['Simple',".$nombre2."],";
        ?>
        ]);

        var options1 = {
          	title: 'Utilisateurs Simple/Premium',
          	pieHole: 0.4,//is3D: true,
          	colors: ['#187cc2','#149210'],
          	backgroundColor: {
        	fill: '#fff'
    		}
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('pie1'));

        chart1.draw(data1, options1);

        var data2 = google.visualization.arrayToDataTable([
          ['Type', 'Nombre de demandes'],
          <?php
           	$requet1  = "SELECT * FROM notification WHERE code_notif=0";
 		  	$result1 = mysqli_query($conn,$requet1) or die();
 		  	$nomb1   = mysqli_num_rows($result1);
 		  	$requet2  = "SELECT * FROM notification WHERE code_notif=3";
 		  	$result2 = mysqli_query($conn,$requet2) or die();
 		  	$nomb2   = mysqli_num_rows($result2);
          	echo "['Colis',".$nomb1."],";
          	echo "['Trajets',".$nomb2."],";
          ?>
        ]);

        var options2 = {
          title: 'Demandes Colis/Trajets',
          pieHole: 0.4,
          colors: ['#187cc2','#149210'],
          backgroundColor: {
        	fill: '#ffffff'
    		}
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart2.draw(data2, options2);

        var data3 = google.visualization.arrayToDataTable([
        ['Type', 'Nombre annonces'],
        <?php
        $rqt1  = "SELECT * FROM trajets_reguliers";
        $rst1 = mysqli_query($conn,$rqt1) or die();
        $nmb1 = 0;
        while( $row = mysqli_fetch_array($rst1)){
          $rqt_trajet  = "SELECT * FROM trajet where id_trajet = ".$row['id_trajet']." AND supp=0 ";
          $rst_query = mysqli_query($conn,$rqt_trajet);
          if($rst_query){
            if (mysqli_num_rows($rst_query) > 0 ){
              $nmb1++;
            }
          }
        }
        $rqt2  = "SELECT * FROM trajets_non_reguliers";
        $rst2 = mysqli_query($conn,$rqt2) or die();
        $nmb2 = 0;
        while( $row = mysqli_fetch_array($rst2)){
          $rqt_trajet  = "SELECT * FROM trajet where id_trajet = ".$row['id_trajet']." AND supp=0 ";
          $rst_query = mysqli_query($conn,$rqt_trajet);
          if($rst_query){
            if (mysqli_num_rows($rst_query) > 0 ){
              $nmb2++;
            }
          }
        }
        // $rqt1  = "SELECT * FROM trajets_reguliers";
        // $rst1 = mysqli_query($conn,$rqt1) or die();
        // $nmb1   = mysqli_num_rows($rst1);
        // $rqt2  = "SELECT * FROM trajets_non_reguliers";
        // $rst2 = mysqli_query($conn,$rqt2) or die();
        // $nmb2   = mysqli_num_rows($rst2);
        echo "['trajet reguliers',".$nmb1."],";
        echo "['trajet non reguliers',".$nmb2."],";
        ?>
        ]);
      	var options3 = {
        title: 'Comparaison Trajets(Réguliers ou non)',
        pieHole: 0.4,
        colors: ['#187cc2','#149210'],
        backgroundColor: {
        	fill: '#ffffff'
    		}
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('dnt'));
        chart3.draw(data3, options3);

        var data11 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
          	echo "['Adrar',".totalwly(1)."],";
          	echo "['Chlef',".totalwly(2)."],";
          	echo "['Laghouat',".totalwly(3)."],";
          	echo "['Oum El Bouaghi',".totalwly(4)."],";
          	echo "['Batna',".totalwly(5)."],";
          	echo "['Bejaia',".totalwly(6)."],";
          	echo "['Biskra',".totalwly(7)."],";
          	echo "['Beshar',".totalwly(8)."],";
        	echo "['Blida',".totalwly(9)."],";
        	echo "['Bouira',".totalwly(10)."],";
        	echo "['Tamanrasset',".totalwly(11)."],";
        	echo "['Tebessa',".totalwly(12)."],";
        	echo "['Tlemcen',".totalwly(13)."],";
        	echo "['Tiaret',".totalwly(14)."],";
        	echo "['Tizi Ouzou',".totalwly(15)."],";
        	echo "['Alger',".totalwly(16)."],";
        	echo "['Djelfa',".totalwly(17)."],";
        	echo "['Jijel',".totalwly(18)."],";
        	echo "['Setif',".totalwly(19)."],";
        	echo "['Saida',".totalwly(20)."],";
        	echo "['Skikda',".totalwly(21)."],";
        	echo "['Sidi Bel Abbes',".totalwly(22)."],";
        	echo "['Annaba',".totalwly(23)."],";
        	echo "['Guelma',".totalwly(24)."],";
        	echo "['Canstantine',".totalwly(25)."],";
        	echo "['Medea',".totalwly(26)."],";
        	echo "['Mostaganem',".totalwly(27)."],";
        	echo "['Msila',".totalwly(28)."],";
        	echo "['Mascara',".totalwly(29)."],";
        	echo "['Ouargla',".totalwly(30)."],";
            echo "['Oran',".totalwly(31)."],";
            echo "['El bayadh',".totalwly(32)."],";
            echo "['Illizi',".totalwly(33)."],";
            echo "['Bordj Bou Arreridj',".totalwly(34)."],";
            echo "['Boumerdes',".totalwly(35)."],";
            echo "['El Tarf',".totalwly(36)."],";
			echo "['Tindouf',".totalwly(37)."],";
			echo "['Tissemsilt',".totalwly(38)."],";
			echo "['El Oued',".totalwly(39)."],";
			echo "['Khenchla',".totalwly(40)."],";
			echo "['Souk Ahras',".totalwly(41)."],";
			echo "['Tipaza',".totalwly(42)."],";
			echo "['Mila',".totalwly(43)."],";
			echo "['Ain Defla',".totalwly(44)."],";
			echo "['Naama',".totalwly(45)."],";
			echo "['Temouchent',".totalwly(46)."],";
			echo "['Ghardaia',".totalwly(47)."],";
			echo "['Relizane',".totalwly(48)."],";
          ?>
        ]);

        var options11 = {
          title: 'Total des annonces colis/trajets',
          backgroundColor: {
        	fill: '#ffffff',
      			},
    	}

        var chart11 = new google.visualization.PieChart(document.getElementById('piechart11'));

        chart11.draw(data11, options11);


        var data12 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
          	echo "['Adrar',".wlycol(1)."],";
          	echo "['Chlef',".wlycol(2)."],";
          	echo "['Laghouat',".wlycol(3)."],";
          	echo "['Oum El Bouaghi',".wlycol(4)."],";
          	echo "['Batna',".wlycol(5)."],";
          	echo "['Bejaia',".wlycol(6)."],";
          	echo "['Biskra',".wlycol(7)."],";
          	echo "['Beshar',".wlycol(8)."],";
        	echo "['Blida',".wlycol(9)."],";
        	echo "['Bouira',".wlycol(10)."],";
        	echo "['Tamanrasset',".wlycol(11)."],";
        	echo "['Tebessa',".wlycol(12)."],";
        	echo "['Tlemcen',".wlycol(13)."],";
        	echo "['Tiaret',".wlycol(14)."],";
        	echo "['Tizi Ouzou',".wlycol(15)."],";
        	echo "['Alger',".wlycol(16)."],";
        	echo "['Djelfa',".wlycol(17)."],";
        	echo "['Jijel',".wlycol(18)."],";
        	echo "['Setif',".wlycol(19)."],";
        	echo "['Saida',".wlycol(20)."],";
        	echo "['Skikda',".wlycol(21)."],";
        	echo "['Sidi Bel Abbes',".wlycol(22)."],";
        	echo "['Annaba',".wlycol(23)."],";
        	echo "['Guelma',".wlycol(24)."],";
        	echo "['Canstantine',".wlycol(25)."],";
        	echo "['Medea',".wlycol(26)."],";
        	echo "['Mostaganem',".wlycol(27)."],";
        	echo "['Msila',".wlycol(28)."],";
        	echo "['Mascara',".wlycol(29)."],";
        	echo "['Ouargla',".wlycol(30)."],";
            echo "['Oran',".wlycol(31)."],";
            echo "['El bayadh',".wlycol(32)."],";
            echo "['Illizi',".wlycol(33)."],";
            echo "['Bordj Bou Arreridj',".wlycol(34)."],";
            echo "['Boumerdes',".wlycol(35)."],";
            echo "['El Tarf',".wlycol(36)."],";
			echo "['Tindouf',".wlycol(37)."],";
			echo "['Tissemsilt',".wlycol(38)."],";
			echo "['El Oued',".wlycol(39)."],";
			echo "['Khenchla',".wlycol(40)."],";
			echo "['Souk Ahras',".wlycol(41)."],";
			echo "['Tipaza',".wlycol(42)."],";
			echo "['Mila',".wlycol(43)."],";
			echo "['Ain Defla',".wlycol(44)."],";
			echo "['Naama',".wlycol(45)."],";
			echo "['Temouchent',".wlycol(46)."],";
			echo "['Ghardaia',".wlycol(47)."],";
			echo "['Relizane',".wlycol(48)."],";
          ?>
        ]);

        var options12 = {
          title: 'Total des annonces colis',
          backgroundColor: {
        	fill: '#ffffff',
      			},
    	}

        var chart12 = new google.visualization.PieChart(document.getElementById('piechart12'));

        chart12.draw(data12, options12);


        var data21 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
            echo "['Adrar',".wlytrj(1)."],";
            echo "['Chlef',".wlytrj(2)."],";
            echo "['Laghouat',".wlytrj(3)."],";
            echo "['Oum El Bouaghi',".wlytrj(4)."],";
            echo "['Batna',".wlytrj(5)."],";
            echo "['Bejaia',".wlytrj(6)."],";
            echo "['Biskra',".wlytrj(7)."],";
            echo "['Beshar',".wlytrj(8)."],";
          	echo "['Blida',".wlytrj(9)."],";
          	echo "['Bouira',".wlytrj(10)."],";
          	echo "['Tamanrasset',".wlytrj(11)."],";
          	echo "['Tebessa',".wlytrj(12)."],";
          	echo "['Tlemcen',".wlytrj(13)."],";
          	echo "['Tiaret',".wlytrj(14)."],";
          	echo "['Tizi Ouzou',".wlytrj(15)."],";
          	echo "['Alger',".wlytrj(16)."],";
          	echo "['Djelfa',".wlytrj(17)."],";
          	echo "['Jijel',".wlytrj(18)."],";
         	echo "['Setif',".wlytrj(19)."],";
         	echo "['Saida',".wlytrj(20)."],";
          	echo "['Skikda',".wlytrj(21)."],";
          	echo "['Sidi Bel Abbes',".wlytrj(22)."],";
          	echo "['Annaba',".wlytrj(23)."],";
          	echo "['Guelma',".wlytrj(24)."],";
          	echo "['Canstantine',".wlytrj(25)."],";
          	echo "['Medea',".wlytrj(26)."],";
          	echo "['Mostaganem',".wlytrj(27)."],";
          	echo "['Msila',".wlytrj(28)."],";
          	echo "['Mascara',".wlytrj(29)."],";
          	echo "['Ouargla',".wlytrj(30)."],";
            echo "['Oran',".wlytrj(31)."],";
            echo "['El bayadh',".wlytrj(32)."],";
            echo "['Illizi',".wlytrj(33)."],";
            echo "['Bordj Bou Arreridj',".wlytrj(34)."],";
            echo "['Boumerdes',".wlytrj(35)."],";
            echo "['El Tarf',".wlytrj(36)."],";
      		echo "['Tindouf',".wlytrj(37)."],";
      		echo "['Tissemsilt',".wlytrj(38)."],";
      		echo "['El Oued',".wlytrj(39)."],";
      		echo "['Khenchla',".wlytrj(40)."],";
      		echo "['Souk Ahras',".wlytrj(41)."],";
      		echo "['Tipaza',".wlytrj(42)."],";
      		echo "['Mila',".wlytrj(43)."],";
      		echo "['Ain Defla',".wlytrj(44)."],";
      		echo "['Naama',".wlytrj(45)."],";
      		echo "['Temouchent',".wlytrj(46)."],";
      		echo "['Ghardaia',".wlytrj(47)."],";
      		echo "['Relizane',".wlytrj(48)."],";
          ?>
        ]);

        var options21 = {
          title: 'Total des annonces trajets',
          backgroundColor: {
          fill: '#ffffff',
            },
      	}

        var chart21 = new google.visualization.PieChart(document.getElementById('piechart21'));

        chart21.draw(data21, options21);


      	}

    	function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Wilaya', 'Inscriptions', 'Annonces colis', 'Annonces trajet'],
        <?php
            echo "['J-6',".nb_ins($j7).",".nb_coli($j7).",".nb_trajet($j7)."],";
            echo "['J-5',".nb_ins($j6).",".nb_coli($j6).",".nb_trajet($j6)."],";
            echo "['J-4',".nb_ins($j5).",".nb_coli($j5).",".nb_trajet($j5)."],";
            echo "['J-3',".nb_ins($j4).",".nb_coli($j4).",".nb_trajet($j4)."],";
            echo "['J-2',".nb_ins($j3).",".nb_coli($j3).",".nb_trajet($j3)."],";
            echo "['J-1',".nb_ins($j2).",".nb_coli($j2).",".nb_trajet($j2)."],";
            echo "['J',".nb_ins($j1).",".nb_coli($j1).",".nb_trajet($j1)."],";

        ?>
      ]);

      var options = {
        title: 'Traffic du site cette semaine',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total annonces',
          minValue: 0
        },
        vAxis: {
          title: 'Jours',
        },
        colors: ['#187cc2','#149210','#b0120a'],
        backgroundColor: {
        	fill: '#ffffff'
    		}
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);

      var data1 = google.visualization.arrayToDataTable([
          ['Mois', 'Inscriptions', 'Annonces colis', 'Annonces trajet'],
          <?php
            echo "['-11 mois',".monsc($m12,$y12).",".moncol($m12,$y12).",".montrj($m12,$y12)."],";
			echo "['-10 mois',".monsc($m11,$y11).",".moncol($m11,$y11).",".montrj($m11,$y11)."],";
            echo "['-9 mois',".monsc($m10,$y10).",".moncol($m10,$y10).",".montrj($m10,$y10)."],";
            echo "['-8 mois',".monsc($m9,$y9).",".moncol($m9,$y9).",".montrj($m9,$y9)."],";
            echo "['-7 mois',".monsc($m8,$y8).",".moncol($m8,$y8).",".montrj($m8,$y8)."],";
            echo "['-6 mois',".monsc($m7,$y7).",".moncol($m7,$y7).",".montrj($m7,$y7)."],";
            echo "['-5 mois',".monsc($m6,$y6).",".moncol($m6,$y6).",".montrj($m6,$y6)."],";
            echo "['-4 mois',".monsc($m5,$y5).",".moncol($m5,$y5).",".montrj($m5,$y5)."],";
            echo "['-3 mois',".monsc($m4,$y4).",".moncol($m4,$y4).",".montrj($m4,$y4)."],";
            echo "['-2 mois',".monsc($m3,$y3).",".moncol($m3,$y3).",".montrj($m3,$y3)."],";
            echo "['-1 mois',".monsc($m2,$y2).",".moncol($m2,$y2).",".montrj($m2,$y2)."],";
            echo "['ce mois',".monsc($m1,$y1).",".moncol($m1,$y1).",".montrj($m1,$y1)."],";

          ?>
        ]);

        var options1 = {
        title: 'Traffic du site par mois',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total annonces',
          minValue: 0
        },
        vAxis: {
          title: 'Wilaya',
        },
        colors: ['#187cc2','#149210','#b0120a'],
        backgroundColor: {
        	fill: '#ffffff'
    		}
      };

      var chart = new google.visualization.BarChart(document.getElementById('barchart_material'));
      chart.draw(data1, options1);


    }



    </script>
</head>
<body style="width:100%; ">
<div class="container">
	<div class="row">
		<div class="col-2">

			<a href="index.php"><img src="../images/logo.png" alt="WASSELLI.DZ" style="height:50px; margin-top:20px;"></a>
		</div>
		<div class="col-8" style="display: flex ; justify-content:center; align-items:center; width:30px; height: 80px;margin-top:20px; margin-bottom: 20px;text-align: center; box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div class="h2" style="color : #2b2b2b ; margin:0px; "> Statistiques </div>
		<div style="margin:3px 0px 0px 5px;"> <img style="width:20px;" src="https://img.icons8.com/ios-glyphs/50/000000/statistics.png"></div>
		</div>
	</div>
	<div class="row">
	<div class="grp col-6" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div id="donut1" style="height: 300px; color: rgb(0,0,0);" >
		</div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-lg mb-5" style="position: relative; right: 60px;">Make PDF</button></div> -->
	</div>
	<div class="grp col-6" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div id="donutchart" style="height: 300px;">
		</div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf1" class="btn btn-danger btn-lg mb-5" style="position: relative; right: 60px;">Make PDF</button></div> -->
	</div>

	<div class="grp col-6" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);" >
		<div id="pie1" style="height: 300px;">
		</div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf2" class="btn btn-danger btn-lg" style="position: relative; right: 60px;">Make PDF</button></div> -->
	</div>

	<div class="grp col-6" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div id="dnt" style="height: 300px;">
		</div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf3" class="btn btn-danger btn-lg" style="position: relative; right: 60px;">Make PDF</button></div> -->
	</div>
		<hr>
		<br>
	<div class="grp col-12" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div id="chart_div" style="height: 600px;"></div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf4" class="btn btn-danger btn-lg">Make PDF</button></div> -->
	</div>

	<div class="grp col-12" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);" >
		<div id="barchart_material" style="height: 800px;"></div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf5" class="btn btn-danger btn-lg">Make PDF</button></div> -->
	</div>
		<hr>
		<br>
		<div class="grp col-12" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
			<div id="piechart11" style="width: 900px; height: 500px;"></div>
			<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf8" class="btn btn-danger btn-lg mb-4">Make PDF</button></div> -->
		</div>
	<div class="grp col-6" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div id="piechart21" style="width: 700px; height: 500px;"></div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf6" class="btn btn-danger btn-lg">Make PDF</button></div> -->
	</div>
		<br>
	<div class="grp col-6" style="box-shadow : 0px 3px 12px 0px rgba(0,0,0,0.2);">
		<div id="piechart12" style="width: 700px; height: 500px;"></div>
		<!-- <div align="center"><button type="button" name="create_pdf" id="create_pdf7" class="btn btn-danger btn-lg">Make PDF</button></div> -->
	</div>
		<br>

</div>
</div>
<form method="post" id="make_pdf" action="create_pdf.php">
<input type="hidden" name="hidden_html" id="hidden_html" />
</form>
</body>
</html>

<script>
$(document).ready(function(){
 $('#create_pdf').click(function(){
  $('#hidden_html').val($('#donut1').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf1').click(function(){
  $('#hidden_html').val($('#donutchart').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf2').click(function(){
  $('#hidden_html').val($('#pie1').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf3').click(function(){
  $('#hidden_html').val($('#dnt').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf4').click(function(){
  $('#hidden_html').val($('#chart_div').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf5').click(function(){
  $('#hidden_html').val($('#barchart_material').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf6').click(function(){
  $('#hidden_html').val($('#piechart21').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf7').click(function(){
  $('#hidden_html').val($('#piechart12').html());
  $('#make_pdf').submit();
 });
 $('#create_pdf8').click(function(){
  $('#hidden_html').val($('#piechart11').html());
  $('#make_pdf').submit();
 });
});
</script>
