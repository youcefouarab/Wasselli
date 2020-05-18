<?php
session_start();
            // require 'php/dbh.inc.php';

        		$connect = mysqli_connect("localhost", "root", "", "projet2cp");
            if($_FILES["photo_profile0"]["name"] != ''){
              $file_ext = explode(".",$_FILES["photo_profile0"]["name"]);
              $actual_ext = end($file_ext);
              $actual_file_name = uniqid("",true);
              $actual_file_name = $actual_file_name.".".$actual_ext ;
              $file_destination ="../img_profiles/".$actual_file_name ;
              move_uploaded_file( $_FILES["photo_profile0"]["tmp_name"] , $file_destination);
            }
            $sql="UPDATE compte SET photo = '".$actual_file_name."' WHERE id_compte = {$_SESSION['id_compte']} ";
            // $sql="UPDATE compte SET photo = '1.jpg' WHERE id_compte = {$_SESSION['id_compte']} " ;
            mysqli_query($connect, $sql);
            $_SESSION['photo'] = $actual_file_name;
            // $output='<img src="./img_profiles/'.$actual_file_name.'" alt="Photo Profil" class="profile-img" style="object-fit:cover;">';
            $output = $actual_file_name;
            echo $output;
          ?>
