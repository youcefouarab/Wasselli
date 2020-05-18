<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Notification</title>
	<!--CSS Principal--><link rel="stylesheet" href="css/style.css?version=1" type="text/css">
    <!--CSS Slider--><link rel="stylesheet" href="css/layerslider.css" type="text/css">
    <!--JS-->
    <!--Bib JQuery-->
    <!--Bib GreenSock--><script src="js/greensock.js" type="text/javascript"></script>
    <!--Transitions Slider--><script src="js/layerslider.transitions.js" type="text/javascript"></script>
                             <script src="js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>  
                               <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <link rel="stylesheet" href="css/all.css" type="text/css">

  <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="css/animate.css" type="text/css">
  <script src="js/monJquery5.js?version=3" type="text/javascript"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
  <link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="icon" href="images/icon.png">

    <!--JS-->
    <!--Bib JQuery--><script src="js/jquery.min.js" type="text/javascript"></script>
    <!--Bib GreenSock--><script src="js/greensock.js" type="text/javascript"></script>
    <!--Transitions Slider--><script src="js/layerslider.transitions.js" type="text/javascript"></script>
                             <script src="js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script> 
                             <script src="js/wow.js" type="text/javascript"></script>    
                             <style type="text/css">
                             #title 
                             {
                                color: #187cc2;
                                margin: 1vw 0vw 0.5vw  0vw;
                                font-size: 2vw;
                             }
                             	#coli,#trajet
                             	{
                             		float: left;
                             		text-align: left;


                             	}
                             	#coli
                             	{
                             		border-right: 0.1vw solid #187cc2;
                             	}
                             	body
                             	{
                             		font-size: 0.9vw;
                             	}
                             		#container 
                             		{
                             			border:1px solid #187cc2;
                                        margin-top:2vw; 
                                        margin-bottom: 2vw;
                             		}
                             	.label_champs 
                             	{
                             		margin: 0.5vw 0.2vw 0.5vw 1vw;

                             	}
                             	.champs{display: inline-block;}
                             	.btn_notif_accepter
                             	{
                             		background-color: #187cc2;
                             		margin: 1.2vw 1vw 1.2vw 0vw;
                             		font-size: 1.7vw;
                                    padding: 0.2vw 1vw 0.2vw 1vw;
                             	}
                             	.btn_notif_refuser
                             	{
                             		margin: 1.2vw 0vw 1.2vw 1vw;
                             		font-size: 1.7vw;
                                    padding: 0.2vw 1vw 0.2vw 1vw;
                             	}
                             	.btn_notif_valider 
                             	{
                             		margin: 1.2vw 0vw 1.2vw 0vw;
                             		font-size: 1.7vw;
                             	}

                             	.commentaire 
                             	{
                             		margin: 1.5vw 0vw 1vw 0vw;
                                    font-weight: bold;
                             	}
                             	h1
                             	{
                             		text-align: center;
                             		border-bottom: 0.2vw solid #187cc2;
                             	}
                             	#style_prem_refuse 
                             	{
                             		margin:1.5vw 0vw 1vw 2vw;
                             	}
                             	#prem_refuse_cause
                             	{
                             		margin:0.2vw 0vw 1vw 2vw;
                             	}
                             	.hover 
								{
    								color: orange;
								} 
                                .click
                                {
                                        color : yellow;
                                }
                                #lien
                                {
                                    text-shadow: 1px 1px #60b1eb;
                                    font-size: 1.2vw;
                                }
                                .fa-star
                                {
                                       
                                        font-size: 2vw;

                                }
                                #label_note 
                                {
                                    font-size: 1.3vw;
                                }
                                #image
                                {
                                    max-height: 12vw;
                                    max-width: 12vw;
                                }
                                ::-webkit-scrollbar {
                                    width: 8px; 
                                    }
                                ::-webkit-scrollbar-track {
                                    background-color: #e0ebeb;
                                    border-radius: 10px;
                                }

                                ::-webkit-scrollbar-thumb {
                                    border-radius: 10px;
                                    background-color: #a3c2c2;
                                }
                             </style>                
</head>
<body>
<?php 
    if (!isset($_SESSION['nom'])) $_SESSION['nom']="";
    	if (isset($_POST['id_coli'])&&isset($_POST['id_trajet'])&& isset($_POST['id_notif'])&&isset($_POST['code_notif'])&&isset($_POST['vu'])&&isset($_POST['acc'])&&isset($_POST['id'])) {
    		echo " 
    			<script '>

    				$.ajax({
                		url :'voir_plus.php',
                		data :{'id_coli':".$_POST['id_coli'].",'code_notif':".$_POST['code_notif'].",'id_trajet':".$_POST['id_trajet'].",'id_notif':".$_POST['id_notif']."},
                		type:'POST',
                		dataType :'json',
                		success:function(data)
                		{
                			info(data);
                			type_notif(data,".$_POST['id_coli'].",".$_POST['code_notif'].",".$_POST['id_trajet'].",".$_POST['id_notif'].",".$_POST['acc'].",".$_POST['vu'].");
                		},
                		error:function(a,b,c)
                		{
                			alert('error');
                		}
                	});
                	function info(data)
            		{
            		if(data.date_depart!='rien' && data.date_depart!=null)
            		{
            			$('#label_trajet_reg').hide();
            			$('#date_depart').html(data.date_depart);
            			if(data.date_retour=='rien')
            			{
            				$('#label_date_retour').hide();
            			}
            			else
            			{

            				$('#date_retour').html(data.date_retour);
            			}
            		}
            		else
            		{
            			$('#label_trajet_depart').hide();
            			$('#label_date_retour').hide();
                        $('#trajet_reg_jour').html(data.jour);
                        $('#trajet_reg_frequence').html(data.frequence+' fois par semaine.');

            		}
            			$('.table-arrets').html(data.arret);
                        $('#nom_coli').html(data.nom_coli);
                        $('#lieu_depart').html(data.lieu_depart);
                        $('#lieu_arrive').html(data.lieu_arrive);
                        $('#lieu_depart_coli').html(data.lieu_depart_coli);
                        $('#lieu_arrive_coli').html(data.lieu_arrive_coli);                        
                        $('#poids_max').html(data.poids_max);
                        $('#taille_max').html(data.taille_max);
                        $('#table-arrets').html(data.arret);
                        if (data.photo!='' && data.photo!=null ) {
                        $('#image').attr('src',data.photo);}
                        else
                        {
                            $('#image').attr('src','./img_colis/default_img.jpg');
                        }
                        $('#date_annonce_coli').html(data.date_annonce_coli);
                        $('#date_annonce_trajet').html(data.date_annonce_trajet);
                        $('#date_envoi').html(data.date_envoi);
                        $('#date_depot').html(data.date_depot);
                        $('#adr_depart').html(data.adr_depart);
                        $('#adr_arrive').html(data.adr_arrive);
                        $('#poid').html(data.poids);
                        $('#moyen').html(data.moyen);
                        $('#detour_max').html(data.detour_max);
                        $('#taille').html(data.taille);
                        if(data.demande_spec==null || data.demande_spec==''){
                        		$('#demande_spec').html('');
                        		$('.demande_spec').hide();
                   		}
                        else
                        {
                        	$('#demande_spec').html(data.demande_spec);
                    	}
                        $('#tarif').html(data.tarif+'<strong>DA</strong>');

            			}
            		function type_notif(data,id_coli,code_notif,id_trajet,id_notif,acc,vu)
            		{
            			$('.buttons').html('');
            			var accepter_butt='<a class=  \' btn btn-primary btn_notif_accepter  \'>accepter</a>';
	    				var valider_butt='<a class=\'btn_notif_valider btn btn-info \'>valider</a>';
	    				var refuser_butt='<a class=\'  btn btn-danger btn_notif_refuser  \' >refuser</a>';
                        $('#lien').attr('href',' profile.php?from=user&id=".$_POST['id']."');
                        $('#lien').html(data.nom +' '+ data.prenom);
                        $('#stars').hide();
            			if(code_notif==0)
            			{
            				$('#title p').html('Demande colis');
            				$('#titre_coli').html('Mon colis');
            				$('#titre_trajet').html('Le trajet');
            				$('.buttons').html(accepter_butt+refuser_butt);
            				if (acc==1) {
            					$('.buttons').html('');
                    			$('.commentaire').html('<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-ok\'></span>Vous avez accepté cette demande, en attendant la validation par le transporteur</p>');
                    		}else if(acc==2){ $('.buttons').html('');$('.commentaire').html('<p style=\'color:#ff3300;\'><span class=\'glyphicon glyphicon-remove\'></span>Vous avez refusé cette demande</p>');}
                    		else {
                                if(data.accepter=='yes'){                              
                       			$('.commentaire').html('<p >Vous avez accepté une demande pour ce colis</p>');$('.buttons').html('');
                       			}
                            }
                            $(\".btn_notif_accepter \").click(function(){
                               notification(1,data.id_colis,data.id_trajet,id_notif);
                                $('.commentaire').html('<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-ok\'></span>Vous avez accepté cette demande, en attendant la validation par le transporteur</p>');
								$('.buttons').html('');
								window.close();

                            });
                            $(\".btn_notif_refuser \").click(function(){
                                notification(2,data.id_colis,data.id_trajet,id_notif);
                                $('.commentaire').html('<p style=\'color:#ff3300;\'><span class=\'glyphicon glyphicon-remove\'></span>Vous avez refusé cette demande</p>');
								$('.buttons').html('');
								window.close();
                            });
            			}
            			else if(code_notif==1)
            			{
            				$('#title p').html('Votre demande colis a ete accepté');
            				$('#titre_coli').html('Le colis');
            				$('#titre_trajet').html('Mon trajet');
            				$('.buttons').html(valider_butt);
            				if(acc==3)
            				{
                      				$(\".commentaire\").html(\"<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-check\'></span>Validé</p>\");
                      				$('.buttons').html('');
                  			}
                  			$(\" .btn_notif_valider\").click(function(){
                            	notification(12,data.id_colis,data.id_trajet,id_notif);
                            	$('.commentaire').html(\"<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-check\'></span>Validé</p>\");
                            	$('.buttons').html('');
                                
                            	window.close();
                        		});	
            			}
            			else if(code_notif==2)
            			{
            				$('#title p').html('Votre demande colis a ete refué');
            				$('#titre_coli').html('Le colis');
            				$('#titre_trajet').html('Mon trajet');
            			}
            			else if(code_notif==3)
            			{
            				$('#title p').html('Une demande trajet');
            				$('#titre_coli').html('Le colis');
            				$('#titre_trajet').html('Mon trajet');
            				$('.buttons').html(valider_butt);
            				$('.buttons').html(accepter_butt+refuser_butt);
            				$(\".btn_notif_accepter \").click(function(){
                               notification(4,data.id_colis,data.id_trajet,id_notif);
                                $('.commentaire').html('<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-ok\'></span>Vous avez accepté cette demande, en attendant la validation par  le proprietaire</p>');
								$('.buttons').html('');
								window.close();

                            });
                            $(\".btn_notif_refuser \").click(function(){
                                notification(5,data.id_colis,data.id_trajet,id_notif);
                                $('.commentaire').html('<p style=\'color:#ff3300;\'><span class=\'glyphicon glyphicon-remove\'></span>Vous avez refusé cette demande</p>');
								$('.buttons').html('');
								window.close();
                            });
                            if (acc==1) {
            					$('.buttons').html('');
                    			$('.commentaire').html('<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-ok\'></span>Vous avez accepté cette demande, en attendant la validation par le transporteur</p>');
                    		}else if(acc==2){ $('.buttons').html('');$('.commentaire').html('<p style=\'color:#ff3300;\'><span class=\'glyphicon glyphicon-remove\'></span>Vous avez refusé cette demande</p>');}
            			}
            			else if(code_notif==4)
            			{
            				$('#title p').html('Votre demande trajet a ete accepté');
            				$('#titre_coli').html('Mon colis');
            				$('#titre_trajet').html('Le trajet');
            				$('.buttons').html(valider_butt);
            				if(acc==3)
            				{
                      			$(\".commentaire\").html(\"<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-check\'></span>Validé</p>\");
                      			$('.buttons').html('');
                  			}
                  			$(\" .btn_notif_valider\").click(function(){
                            	notification(11,data.id_colis,data.id_trajet,id_notif);
                            	$('.commentaire').html(\"<p style=\'color:#2eb82e;\'><span class=\'glyphicon glyphicon-check\'></span>Validé</p>\");
                            	$('.buttons').html('');
                            	window.close();
                        	});	
            			}
            			else if(code_notif==5)
            			{
            				$('#title p').html('Votre demande trajet a ete refusé');
            				$('#titre_coli').html('Mon colis');
            				$('#titre_trajet').html('Le trajet');
            			}
            			else if(code_notif==7)
            			{
            				
            					$(\"#colis\").hide();
                                $(\"#par\").hide();
            					$(\"#trajet\").hide();
            					$('#title p').html('demande premium refusé');
            					$(\" #prem_refuse\").html(\" <p id=\'style_prem_refuse'\>Nous somme desolé mais vous n'etes pas accepter comme un utilisateur premium</p>\");
            				if(data.no_prem!=\"\" && data.no_prem!=null)
            				{
            					var x=\"<p id=\' style_prem_refuse_cause \'>les causes:\"+ data.no_prem;
            					x+=\"</p>\";
            					$(\" #prem_refuse_cause\").html(x);
            				}
            			}
            			else if(code_notif==8)//colis annulé
            			{
            				$('#title p').html('Votre colis est annulé');
            				$('#titre_coli').html('Mon colis');
            				$('#titre_trajet').html('Le trajet');
                            
            			}
                        else if(code_notif==9)// arrive a la destination
                        {
                            $('#title p').html('Votre colis est a atteint la destination');
                            $('#titre_coli').html('Mon colis');
                            $('#titre_trajet').html('Le trajet');   
                            
                            if(acc==4)
                            {
                                $('.commentaire').html('Vous avez déjas noté cette personne');
                            }    
                            else 
                            {
                                 stars_rating(".$_POST['id_trajet'].",".$_POST['id_notif'].")  ; 
                                 $('.commentaire').html('');
                                 $('#stars').show();
                            }                 
                        }	
                        else if(code_notif==10)//echec
                        {
                            $('#title p').html('Echec de transporter votre colis');
                            $('#titre_coli').html('Mon colis');
                            $('#titre_trajet').html('Le trajet');
                            if(acc==4)
                            {
                                $('.commentaire').html('Vous avez déjas noté cette personne');
                            }    
                            else 
                            {
                                 stars_rating(".$_POST['id_trajet'].",".$_POST['id_notif'].")  ; 
                                 $('.commentaire').html('');
                                 $('#stars').show();
                            }  
                        }
                        else if(code_notif==11)
                        {
                            $('#title p').html('Votre trajet est validé');
                            $('#titre_coli').html('Le colis');
                            $('#titre_trajet').html('Mon trajet');
                        }
                        else if(code_notif==12)
                        {
                            $('#title p').html('Votre colis est validé');
                            $('#titre_coli').html('Le colis');
                            $('#titre_trajet').html('Mon trajet');                            
                        }
                        else if(code_notif==13)
                        {
                            $('#title p').html('Votre trajet est annulé');
                            $('#titre_coli').html('Le colis');
                            $('#titre_trajet').html('Mon trajet');                            
                        }

            		}
					function notification(code,id_coli,id_trajet,id_notif)//insere une notification
					{
        				$.ajax({
            				url :'notification.php',
            				data :{\"code_notif\":code,\"id_colis\":id_coli,\"id_trajet\":id_trajet,\"id_notif\":id_notif},
            				type:'POST'
        				});
					} 
                </script>";
                
    		}
    		else
    		{
    			header('location :./index.php');
    		}
    		
    		



    ?>

    <div class="navbarr">
        <div class="contain">
            <div class="logo">
                <img src="images/logo.png" alt="WASSELLI.DZ">
            </div>
                    </div>
    </div><br><br><br><br><br><br><br>

<div class="container" id="container" >
	<div class="row" id="title"><p style="text-align: center;"></p></div>
    <div class="row" id="par"style="text-align: center;margin:0.5vw 0vw 0.5vw 0vw; "> par</div>
    <div class="row" style="text-align: center;" > <a href="" target="_blank" id="lien" ></a></div>	
	<div class="row" id="prem_refuse"></div>
	<div class="row" id="prem_refuse_cause"></div>
	<div class="row">
		<div id="coli" class="col-md-6 col-sm-6"> 
			<div><h1 id="titre_coli"></h1></div>
            <div class="row" style="text-align: center;"><label class="label_champs">Date d'annonce:</label> <p class="champs"id="date_annonce_coli"></p></div>
			<div class="row"><label class="label_champs">Nom du colis:</label><p class="champs"id="nom_coli"></p></div>
			<div class="row"><label class="label_champs">Date d'envoi:</label><p class="champs" id="date_envoi"></p>
			<label class="label_champs">Date de dépot:</label><p class="champs"id="date_depot"></p></div>
            <div class="row"><label class="label_champs">Lieu départ:</label> <p class="champs"id="lieu_depart_coli"></p><label class="label_champs">Lieu d'arrivé:</label><p class="champs" id="lieu_arrive_coli"></p></div>
			<div class="row"><label class="label_champs">Adresse de départ:</label><p class="champs"id="adr_depart"></p>	</div>							
			<div class="row"><label class="label_champs">Adresse d'arrivée:</label><p class="champs" id="adr_arrive"></p></div>
			<div class="row"><label class="label_champs">Taille:</label><p class="champs"id="taille"></p>
			<label class="label_champs">Poid:</label><p class="champs"id="poid"></p><strong>KG</strong></div>
			<div class="row demande_spec"><label class="label_champs " >Demande spéciale:</label><p class="champs"id="demande_spec"></p></div>
			<div class="row"><label class="label_champs">Tarif:</label><p class="champs"id="tarif"></p></div>
            <div class="row" style="text-align: center;"><img class="champs"id="image" ;"></div>
		</div>
		<div id="trajet" class="col-md-6 col-sm-6">
			<div><h1 id="titre_trajet"></h1></div>
			<div class="row" style="text-align: center;"><label class="label_champs">Date de l'annonce:</label><p class="champs"id="date_annonce_trajet"></p></div>
			<div class="row"><label class="label_champs">Lieu départ:</label> <p class="champs"id="lieu_depart"></p></div>
			<div class="row"><label class="label_champs">Lieu d'arrivé:</label><p class="champs" id="lieu_arrive"></p></div>
			<div class="row"><label class="label_champs">Poid max :</label><p class="champs"id="poids_max"></p><strong>KG</strong><label class="label_champs">Detour max:</label><p class="champs"id="detour_max"></p><label class="label_champs">Taille max:</label><p class="champs"id="taille_max"></p></div>
            <div class="row"><label class="label_champs">Moyen:</label><p class="champs"id="moyen"></p></div>
			<div class="row"id="label_trajet_depart"><label class="label_champs" >Date départ:</label><p class="champs"id="date_depart"></p></div>
			<div class="row"id="label_date_retour"><label class="label_champs">Date retour:</label><p class="champs"id="date_retour"></p></div>
			<div class="row" id="label_trajet_reg"><label class="label_champs" >Trajet régulier:</label><p class="champs"id="trajet_reg_jour"></p><label class="label_champs" >frequence:</label><p class="champs"id="trajet_reg_frequence"></p></div>
			<div class="row"><div class="col-md-6 col-md-offset-3" style="max-height: 5vw;overflow-y: scroll;"><table class="table" ><thead><tr><th style="text-align: center;">Les arréts</th></tr></thead><tbody class="table-arrets"></tbody></table></div> </div>   
		</div>
	</div>
	<div class="row"><div class=" buttons " style="text-align: center;"></div></div>
	<div class="row"><div class="commentaire" style="text-align: center;"></div></div>
    <div class="row"><div id="stars" style="text-align: center;"><span id="label_note" >Veuillez noter le tansporteur </span></br><span class="fa fa-star " id="ss1"></span><span class="fa fa-star "id="ss2"></span><span class="fa fa-star "id="ss3"></span><span class="fa fa-star "id="ss4"></span><span class="fa fa-star "id="ss5"></span></br><label id="valid_rating" class="btn btn-info" style="margin: 1vw 0vw 1.2vw 0vw;">Valider</label></div></div>
</div>
  <script type="text/javascript">

        
        
        function stars_rating(id_trajet,id_notif)
        {
            
            $('#ss1').hover(function(){$(this).addClass('hover');},function(){$(this).removeClass('hover');});
            $('#ss2').hover(function(){$('#ss1 ,#ss2').addClass('hover');},function(){$('#ss1 ,#ss2').removeClass('hover');});
            $('#ss3').hover(function(){$('#ss1 ,#ss2 ,#ss3').addClass('hover');},function(){$('#ss1 ,#ss2 ,#ss3').removeClass('hover');});
            $('#ss4').hover(function(){$('#ss1 ,#ss2 ,#ss3,#ss4').addClass('hover');},function(){$('#ss1 ,#ss2 ,#ss3,#ss4').removeClass('hover');});
            $('#ss5').hover(function(){$('#ss1 ,#ss2 ,#ss3,#ss4,#ss5').addClass('hover');},function(){$('#ss1 ,#ss2 ,#ss3,#ss4,#ss5').removeClass('hover');});


            var x=0;
            $('#ss1').click(function(){$(this).removeClass('hover');$('#ss1').addClass('click');$('#ss2,#ss3 ,#ss4 ,#ss5').removeClass('click');x=1;});
           $('#ss2').click(function(){$('#ss1 , #ss2').removeClass('hover');$('#ss1 , #ss2').addClass('click');$('#ss3 ,#ss4 ,#ss5').removeClass('click');x=2;});
            $('#ss3').click(function(){$('#ss1 , #ss2,#ss3').removeClass('hover');$('#ss1 , #ss2 , #ss3').addClass('click');$('#ss4 ,#ss5').removeClass('click');x=3;});
            $('#ss4').click(function(){$('#ss1 , #ss2,#ss3 ,#ss4').removeClass('hover');$('#ss1 , #ss2 , #ss3 ,#ss4').addClass('click');$('#ss5').removeClass('click');x=4;});
           $('#ss5').click(function(){$('#ss1 , #ss2,#ss3 ,#ss4 ,#ss5').removeClass('hover');$('#ss1 , #ss2 , #ss3 ,#ss4 ,#ss5').addClass('click');x=5;});
           $('#valid_rating').click(function(){
                rating_(x,id_trajet,id_notif);
                $('#commentaire').html('Vous avez déjas noté cette personne');
                window.location.replace("index.php");

           });

        }
        function rating_(note,id_trajet,id_notif)
        {
            $.ajax({
                url:'rating.php',
                type:'POST',
                data:{'note':note,'id_trajet':id_trajet,'id_notif':id_notif},
                error:function(a,b,c)
                {
                   
                }
            });

        }
   </script>
</body>
</html>