<?php
      session_start();
      require '../php/dbh.inc.php';
       if(isset($_POST['email_aj']))
       {
       $nom = $_POST['nom_aj'];
       $prenom = $_POST['prenom_aj'];
       $email = $_POST['email_aj'];
       $password = $_POST['password_aj'];
       $password_per = $_POST['password_per_aj'];
       $sql = "SELECT * FROM compte_administrateur WHERE mail = '$email'";
       $result = mysqli_query($conn,$sql);
       if( mysqli_num_rows($result) == 1) {?>
        <div class="invalid">
        	<?php 
        	header('location: ../admin/administration.php?msg=email');
         exit();
        }
       else
        if ($password !=$password_per)
        { ?>
            <div class="invalid"><?php 
            header('location: ../admin/administration.php?msg=passe');
             exit();
        }
        else
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql ="INSERT INTO compte_administrateur (nom,prenom,mail,mot_passe) VALUES('$nom','$prenom','$email','$hash')";
            $query = mysqli_query($conn,$sql);
              
        }
    }
    $_SESSION['der_page']=3;
    header('location: ../admin/administration.php');

    exit();
?>