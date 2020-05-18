<?php
if (isset($_POST['email'])){
	$conn=mysqli_connect("localhost","root","","projet2cp");
$sql="SELECT mail FROM compte WHERE mail=?";
                $stmt =mysqli_stmt_init($conn);//not yet
                if (!mysqli_stmt_prepare($stmt,$sql)) {//preparer une instruc SQL pour l'exe
                    # code...
                header("Location: ../signup.php?error=sqlerror");
                exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt,"s",$email);//not yet
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);//stocker , elle est utilisee pour les requetes qui produisent un jeu de resultats (select,show,describe,explain)
                    $result=mysqli_stmt_num_rows($stmt);
                    if ($result>0) {
                    	echo "yes";
                    }
                    else
                    {
                    	echo "no";
                    }
                }
    }

?>