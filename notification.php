<?php
date_default_timezone_set('Africa/Algiers');
				$temps=date("Y/m/d H:i:s");
	if(isset($_POST["id_trajet"])&&isset($_POST["id_colis"])&& isset($_POST['code_notif']) && isset($_POST['id_notif']))//id : trajet colis
	{

		$conn=mysqli_connect("localhost","root","","projet2cp");
		switch ($_POST["code_notif"]) {
			case 0://notif => compte (colis)
				$sql='SELECT * FROM colis WHERE id_colis='.$_POST["id_colis"];
				//chercher id recepteur de la notif

				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte_e'];
				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];
				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';

    			$stmt2 =mysqli_stmt_init($conn);
    			mysqli_stmt_prepare($stmt2,$sql) ;
        		mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        		mysqli_stmt_execute($stmt2);
        		echo json_encode("ssss");
				
				break;
				case 3:
				$sql='SELECT * FROM trajet WHERE id_trajet='.$_POST["id_trajet"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte'];
				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];

				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';
    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql) ;

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);
        echo json_encode("ssss");
					break;
					case 1: 
									$sql='UPDATE notification SET acc=1 WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);
	
				$sql='SELECT * FROM trajet WHERE id_trajet='.$_POST["id_trajet"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte'];
				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];

				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';

    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql) ;

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);
					break;
			case 12://notif => compte(id_trajet) =>accepte de demande coli
				$sql='UPDATE notification SET acc=3 WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);

								$sql='SELECT * from colis WHERE id_colis='.$_POST['id_colis'];//chercher id recepteur de la notif
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($result);
				$id_trajet_ex=$row['id_trajet'];
				$id_compte_e=$row['id_compte_e'];
	
				
				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];
				$id_notif=$_POST['id_notif'];



				$sql='UPDATE colis SET id_trajet=? ,etat=? WHERE id_colis=?';//relier le coli avec le trajet
				$stmt =mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt,$sql);
				$x='accepte';
				mysqli_stmt_bind_param($stmt,"isi",$id_trajet,$x,$id_colis);
				mysqli_stmt_execute($stmt);
								$sql='UPDATE trajet SET etat=? WHERE id_trajet=?';//relier le coli avec le trajet
				$stmt =mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt,$sql);
				mysqli_stmt_bind_param($stmt,"si",$x,$id_trajet);
				mysqli_stmt_execute($stmt);



				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';
    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql) ;

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);

				$sql="SELECT * FROM trajet WHERE id_trajet=".$_POST["id_trajet"];
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte2=$row['id_compte'];

				$sql='INSERT INTO deverouille(id_compte1,id_compte2) VALUES ('.$id_compte_e.','.$id_compte2.')';
				mysqli_query($conn, $sql);
				

				$sql='DELETE FROM trajet WHERE id_trajet='.$id_trajet_ex;
				mysqli_query($conn,$sql);

				echo json_encode("ssss");
				break;
			case 2://notif => compte(id_trajet) =>refuse de demande coli
				$sql='UPDATE notification SET acc=2 WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);
				$sql='SELECT * FROM trajet WHERE id_trajet='.$_POST["id_trajet"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte'];
				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];
								
				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';
    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql) ;

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);
        echo json_encode("ssss");
				break;
				case 4://notif=> compte (id_colis)=> accepte la demande trajet
								$sql='UPDATE notification SET acc=1 WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);
				$sql='SELECT * FROM colis WHERE id_colis='.$_POST["id_colis"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte_e'];
				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];


				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';
    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql) ;

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);

				break;
			case 11://valid de la demand trajet
				$sql='UPDATE notification SET acc=3 WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);

				$sql='SELECT * FROM trajet WHERE id_trajet='.$_POST["id_trajet"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte'];

				$code =$_POST['code_notif'];
				$id_colis=$_POST['id_colis'];
				$id_trajet=$_POST['id_trajet'];


				$sql='SELECT * from colis WHERE id_colis='.$_POST['id_colis'];
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($result);
				$id_trajet_ex=$row['id_trajet'];
				$id_compte_r=$row['id_compte_e'];
				
				$sql='UPDATE colis SET id_trajet=? ,etat=? WHERE id_colis=?';//relier le coli avec le trajet
				$stmt =mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt,$sql);
				$x='accepte';
				mysqli_stmt_bind_param($stmt,"isi",$id_trajet,$x,$id_colis);
				mysqli_stmt_execute($stmt);

				$sql='UPDATE trajet SET etat=? WHERE id_trajet=?';//relier le coli avec le trajet
				$stmt =mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt,$sql);
				mysqli_stmt_bind_param($stmt,"si",$x,$id_trajet);
				mysqli_stmt_execute($stmt);

				$sql='UPDATE trajet SET etat=? WHERE id_trajet=?';//relier le coli avec le trajet
				$stmt =mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt,$sql);
				$x='accepte';
				mysqli_stmt_bind_param($stmt,"si",$x,$id_trajet);
				mysqli_stmt_execute($stmt);

				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';
    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql);

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);

  


        				$sql='DELETE FROM trajet WHERE id_trajet='.$id_trajet_ex;
				mysqli_query($conn,$sql);
        echo json_encode("ssss");

				$sql="SELECT * FROM trajet WHERE id_trajet=".$_POST["id_trajet"];
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte2=$row['id_compte'];
				$id_notif=$_POST['id_notif'];


				$sql='INSERT INTO deverouille(id_compte1,id_compte2) VALUES ('.$id_compte_e.','.$id_compte_r.')';
				mysqli_query($conn, $sql);

				$sql="UPDATE notification SET close=1 WHERE NOT id_notif=? AND id_compte_r=? AND code_notif=? AND id_colis=? ";// suprimsr les autres notification de validation
				    $stmt2 =mysqli_stmt_init($conn);
    				mysqli_stmt_prepare($stmt2,$sql);
    					$code=4;
        			mysqli_stmt_bind_param($stmt2,"iiii",$id_notif,$id_compte_r,$code,$id_colis);
        			mysqli_stmt_execute($stmt2);


				echo json_encode("ssss");



			break;
			case 5://notif => compte(id_colis) =>refuse de demande trajet 
				$sql='UPDATE notification SET acc=2 WHERE id_notif='.$_POST['id_notif'];

				mysqli_query($conn,$sql);
				$id_colis=$_POST['id_colis'];
							$sql='SELECT * FROM colis WHERE id_colis='.$_POST["id_colis"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte_e'];
				$code =$_POST['code_notif'];
				$id_trajet=$_POST['id_trajet'];
				$sql='INSERT INTO notification(id_compte_r,code_notif,id_colis,id_trajet,date_temps) VALUES (?,?,?,?,?)';
				    $stmt2 =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt2,$sql) ;

        mysqli_stmt_bind_param($stmt2,"iiiis",$id_compte_e,$code,$id_colis,$id_trajet,$temps);
        mysqli_stmt_execute($stmt2);
        echo json_encode("ssss");
				
				break;
			case 6: //accepte demande premium
								$sql='SELECT * FROM colis WHERE id_colis='.$_POST["id_colis"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte_e'];
				
				$sql='INSERT INTO notification (id_compte_r,code_notif)  VALUES ('.$id_compte_e.',6) WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);
				break;
			case 7: //refuse demande premium
				$sql='SELECT * FROM colis WHERE id_colis='.$_POST["id_colis"];
				//chercher id recepteur de la notif
				$result=mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				$id_compte_e=$row['id_compte_e'];
				
				$sql='INSERT INTO notification (id_compte_r,code_notif)  VALUES ('.$id_compte_e.',7) WHERE id_notif='.$_POST['id_notif'];
				mysqli_query($conn,$sql);
				break;
			case 8:

			break;

			
			default:
				# code...
				break;
		}
		function vu($conn,$id_notif)
		{

		}
	}



?>