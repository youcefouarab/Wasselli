

<?php

function distance($lat1, $lng1, $lat2, $lng2) 
{
        $unit = 'k';
        $earth_radius = 6378137;   
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $meter = ($earth_radius * $d);
         return ceil($meter / 1000);
    }

    $distance = array
(
 'Adrar' => array (
  'latitude' => 27.8733807,
  'longitude' => -0.2874884 
),
 'Chlef' => array (
  'latitude' => 36.164592,
  'longitude' => 1.331499 
),
  'Laghouat' => array (
  'latitude' => 33.8063518,
  'longitude' => 2.8808616  
),
  'Oum El Bouaghi' => array (
  'latitude' => 35.8105805,
  'longitude' => 7.0184178 
),
  'Batna' => array (
  'latitude' => 35.554404,
  'longitude' => 6.1767453 
),
  'Béjaïa' => array (
  'latitude' => 36.750756,
  'longitude' => 5.0647 
),
  'Biskra' => array (
  'latitude' => 34.8508508,
  'longitude' => 5.7286878 
),
  'Béchar' => array (
  'latitude' => 31.6170177,
  'longitude' => -2.2171276 
),
  'Blida' => array (
  'latitude' => 36.4701645,
  'longitude' => 2.8287985 
),
  'Bouira' => array (
  'latitude' => 36.3739012,
  'longitude' => 3.9007007 
),
  'Tamanrasset' => array (
  'latitude' => 22.2701245,
  'longitude' => 5.8095684 
),
  'Tébessa' => array (
  'latitude' => 35.4044483,
  'longitude' => 8.1198984 
),
  'Tlemcen' => array (
  'latitude' => 34.881789,
  'longitude' => -1.316699 
),
  'Tiaret' => array (
  'latitude' => 35.3661448,
  'longitude' => 1.3194687 
),
  'Tizi Ouzou' => array (
  'latitude' => 36.7137843,
  'longitude' => 4.0493919 
),
  'Alger' => array (
  'latitude' => 36.775348,
  'longitude' => 3.060065 
),
  'Djelfa' => array (
  'latitude' => 34.671359,
  'longitude' => 3.254037 
),
  'Jijel' => array (
  'latitude' => 36.8167305,
  'longitude' => 5.771494 
),
  'Sétif' => array (
  'latitude' => 36.1894747,
  'longitude' => 5.4046663 
),
  'Saïda' => array (
  'latitude' => 33.5614232,
  'longitude' => 35.3766095 
),
  'Skikda' => array (
  'latitude' => 36.879882,
  'longitude' => 6.907485 
),
  'Sidi Bel Abbès' => array (
  'latitude' => 34.682268,
  'longitude' => -0.4357555 
),
  'Annaba' => array (
  'latitude' => 36.8982165,
  'longitude' => 7.7549272 
),
  'Guelma' => array (
  'latitude' => 36.465084,
  'longitude' => 7.430647 
),
  'Constantine' => array (
  'latitude' => 36.364519,
  'longitude' => 6.60826 
),
  'Médéa' => array (
  'latitude' => 36.265344,
  'longitude' => 2.766957 
),
  'Mostaganem' => array (
  'latitude' => 35.928808,
  'longitude' => 0.089978 
),
  'M’Sila' => array (
  'latitude' => 35.7087553,
  'longitude' => 4.5371552 
),
  'Mascara' => array (
  'latitude' => 35.3978385,
  'longitude' => 0.2430195 
),
  'Ouargla' => array (
  'latitude' => 31.94467,
  'longitude' => 5.320958 
),
  'Oran' => array (
  'latitude' => 35.7032751,
  'longitude' => -0.6492976 
),
  'El Bayadh' => array (
  'latitude' => 32.570303,
  'longitude' => 1.1259581 
),
  'Illizi' => array (
  'latitude' => 26.528031,
  'longitude' => 8.0815775 
),
  'Bordj Bou Arreridj' => array (
  'latitude' => 36.095506,
  'longitude' => 4.6611002 
),
  'Boumerdès' => array (
  'latitude' => 36.7359187,
  'longitude' => 3.6163387 
),
  'El Tarf' => array (
  'latitude' => 36.6713563,
  'longitude' => 8.070134 
),
  'Tindouf' => array (
  'latitude' => 27.6718402,
  'longitude' => -8.1397297 
),
  'Tissemsilt' => array (
  'latitude' => 35.7858975,
  'longitude' => 1.8340957 
),
  'El Oued' => array (
  'latitude' => 33.256018,
  'longitude' => 7.1369394 
),
  'Khenchela' => array (
  'latitude' => 35.430154,
  'longitude' => 7.145711 
),
  'Souk Ahras' => array (
  'latitude' => 36.1378681,
  'longitude' => 7.8262426 
),
  'Tipaza' => array (
  'latitude' => 36.5918179,
  'longitude' => 2.4482509 
),
  'Mila' => array (
  'latitude' => 36.2502135,
  'longitude' => 6.1652163  
),
  'Aïn Defla' => array (
  'latitude' => 36.1586843,
  'longitude' => 2.0842817 
),
  'Naâma' => array (
  'latitude' => 33.2336851,
  'longitude' => -0.8151958 
),
  'Témouchent' => array (
  'latitude' => 35.3650471,
  'longitude' => -0.9452807 
),
  'Ghardaia' => array (
  'latitude' => 32.485855,
  'longitude' => 3.677104 
),
  'Relizane' => array (
  'latitude' => 35.7381193,
  'longitude' => 0.5547673 
),
);

session_start();

if(isset($_POST['submit_colis'])) {
    $Host = "localhost";
    $Host_user = "root";
    $Host_pswd = "";
    $database = "projet2cp";

    $connect = mysqli_connect($Host, $Host_user, $Host_pswd, $database);

    if (!$connect) {
        die("la connexion a échoué" . mysqli_connect_error());
        exit();
    } else{
        date_default_timezone_set('Africa/Algiers');

        $id_compte_e = $_SESSION['id_compte'];
        $nom_colis = $_POST['N_colis'];
        $taille_colis = $_POST['taille_colis'];
        $poid_colis = $_POST['poid_colis'];
        $text_demande = $_POST['text_demande'];
        $date_annonce = date('Y-m-d H:i:s');
        $date_depart = $_POST['from_date'];
        $date_arrive = $_POST['to_date'];
        $adr_depart = $_POST['@_d'];
        $adr_arrive = $_POST['@_a'];
        $willaya_d = $_POST['willaya_d'];
        $willaya_a = $_POST['willaya_a'];
        $demande_special = $_POST['text_demande'];
        $etat = "annonce";

        $d = distance($distance[$willaya_d]['latitude'],$distance[$willaya_d]['longitude'],$distance[$willaya_a]['latitude'],$distance[$willaya_a]['longitude']);

        
    $facil=300;
    $difficil=1000;

        if ($d<=$facil) $diff='facil';
        if (($d>$facil)&&($d<$difficil)) $diff='moyen';
        if ($d>=$difficil) $diff='difficil';

                

                $tarifs = include "../tarifs.txt";
                $parkm = $tarifs[0] * $d;
                $parkg = $tarifs[1] * $poid_colis;
                if ($taille_colis == 'petit') $partaille = $tarifs[2];
                if ($taille_colis == 'moyen') $partaille = $tarifs[3];
                if ($taille_colis == 'grand') $partaille = $tarifs[4];
                if ($taille_colis == 'tres grand') $partaille = $tarifs[5];
                if ($diff == 'facil') $pardiff = $tarifs[6];
                if ($diff == 'moyen') $pardiff = $tarifs[7];
                if ($diff == 'difficil') $pardiff = $tarifs[8];
                if ($demande_special) $pards = $tarifs[9]; else $pards = 0;

                $prix = $parkm + $parkg + $partaille + $pardiff + $pards;

        $requet_trajet= "INSERT INTO `trajet`(`date_annonce`, `id_compte`, `lieux_depart`, `lieux_arrive`)
        VALUES (?,?,?,?)";

        $stmt =mysqli_stmt_init($connect);
        mysqli_stmt_prepare($stmt,$requet_trajet);
        mysqli_stmt_bind_param($stmt,"sdss",$date_annonce,$id_compte_e,$willaya_d,$willaya_a);       
        if (mysqli_stmt_execute($stmt)) {
            $id_trajet = mysqli_insert_id($connect);
            $file_Name = $_FILES['photo_colis']['name'];
            $file_Tmp = $_FILES['photo_colis']['tmp_name'];
            $file_size = $_FILES['photo_colis']['size'];
            $file_error = $_FILES['photo_colis']['error'];
            $file_type = $_FILES['photo_colis']['type'];
            $file_ext = explode(".",$file_Name);
            $actual_ext = strtolower(end($file_ext));
            $allowed = array('jpg','jpeg','png');
            if(in_array($actual_ext,$allowed)){
                if ($file_error===0){
                    if($file_size <1000000000  ){
                        $actual_file_name = uniqid("",true);
                        $actual_file_name = $actual_file_name.".".$actual_ext ;
                        $file_destination ="../img_colis/".$actual_file_name ;
                        $path="img_colis/".$actual_file_name;
                        move_uploaded_file($file_Tmp , $file_destination);
                    }
                }
            }
            $requet_colis= "INSERT INTO `colis`(`date_annonce`, `nom`, `id_compte_e`, `id_trajet`, `date_envoi`, `date_depot`,`adr_depart`,`adr_arrive`, `taille`, `poids`, `demande_spec` , `photo` , `etat`, `tarif`)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt =mysqli_stmt_init($connect);
            mysqli_stmt_prepare($stmt,$requet_colis);
            mysqli_stmt_bind_param($stmt,"ssddsssssssssd",$date_annonce,$nom_colis,$id_compte_e,$id_trajet,$date_depart,$date_arrive,$adr_depart,$adr_arrive,$taille_colis,$poid_colis,$demande_special,$path,$etat, $prix);
            if (mysqli_stmt_execute($stmt)) {
                if(!empty($_POST['id_trajet'])){
                    header("Location: ../choix_colis.php?id_trajet=".$_POST['id_trajet']."&id_compte=".$_POST['id_compte_ann']."");
                }else{
                header("Location: ../index.php?annonce=success");
                }
            } else {
                echo "Error: " .$requet_colis. "<br>" . mysqli_error($connect);
            }
        } else {
            echo "Error: " . $requet_trajet . "<br>" . mysqli_error($connect);
        }
    }
    mysqli_close($connect);

}
