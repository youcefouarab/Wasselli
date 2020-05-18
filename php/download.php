<?php

if (isset($_POST['download']) && isset($_POST["type"])) {
  if ($_POST["type"]==1) {
    # code...
  
      header("Content-type:application/pdf");


// It will be called downloaded.pdf
header("Content-Disposition:attachment;filename=../contrat.pdf");
readfile("../contrat.pdf");
header("location : index.php");}
else 
{
        header("Content-type:application/pdf");


// It will be called downloaded.pdf
header("Content-Disposition:attachment;filename=../CGU.pdf");
readfile("../CGU.pdf");
header("location : index.php");

}

}

 
?>