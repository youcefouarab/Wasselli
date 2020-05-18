<?php
date_default_timezone_set('Africa/Algiers');
session_start();


$conn=mysqli_connect("localhost","root","","projet2cp");

	# code...
images();
	$id=$_SESSION['id_compte'];

    $file1=$_FILES['img_profile'];
    $file2=$_FILES['img_carte'];
    $file3=$_FILES['contrat'];

    $file1_name=$file1['name'];
    $file2_name=$file2['name'];
	$file3_name=$file3['name'];

	$file1_tmp=$file1['tmp_name'];
	$file2_tmp=$file2['tmp_name'];
	$file3_tmp=$file3['tmp_name'];

	if ($file1_name!='' && $file1_name!=null) {$a=explode('.',$file1_name);$ext1=strtolower(end($a));}
	$a=explode('.',$file2_name);
    $ext2=strtolower(end($a));
    $a=explode('.',$file3_name);
    $ext3=strtolower(end($a));

    if ($file1_name!='' && $file1_name!=null) {$file1newname=uniqid('',true).".".$ext1;}
    $file2newname=uniqid('',true).".".$ext2;
    $file3newname=uniqid('',true).".".$ext3;

    if ($file1_name!='' && $file1_name!=null) {move_uploaded_file($file1_tmp, "img_profiles/".$file1newname);}
    move_uploaded_file($file2_tmp, "cartes_id/".$file2newname);
    move_uploaded_file($file3_tmp, "contrats/".$file3newname); 

    if ($file1_name!='' && $file1_name!=null) {$sql='UPDATE compte SET photo=? WHERE id_compte=?';$stmt =mysqli_stmt_init($conn);mysqli_stmt_prepare($stmt,$sql);mysqli_stmt_bind_param($stmt,"ss",$file1newname,$id);mysqli_stmt_execute($stmt);    $_SESSION['photo'] = $file1newname;
}
    $sql='INSERT INTO premium (id_compte,contrat,identite) VALUES (?,?,?)';
    $stmt =mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"dss",$id,$file3newname,$file2newname);
    mysqli_stmt_execute($stmt);

        $sql2= "INSERT notifications_admin(id_compte_e,code,date_temps) VALUES (?,?,?)";
    $stmt2 =mysqli_stmt_init($conn);
    $temps=date("Y/m/d H:i:s");
    if (mysqli_stmt_prepare($stmt2,$sql2) )
    {
        $w="premium";
        mysqli_stmt_bind_param($stmt2,"dss",$id,$w,$temps);
        mysqli_stmt_execute($stmt2);

    }
    header("location: index.php");

	 function images()
 {
    $file1=$_FILES['img_profile'];
    $file2=$_FILES['img_carte'];
    $file3=$_FILES['contrat'];
    $file_size=$file2['size'];
    if ($file_size>0) {
        $file1_name=$file1['name'];
        $file2_name=$file2['name'];
        $file3_name=$file3['name'];

        $a=explode('.',$file1_name);
        $b=explode('.',$file2_name);
        $c=explode('.',$file3_name);

        $x=end($a);
        $y=end($b);
        $w=end($c);

        $ext1=strtolower($x);
        $ext2=strtolower($y);
        $ext3=strtolower($w);
        $allowed_img=array('jpeg','png','jpg');
        $allowed_contrat=array('pdf');
        if (!in_array($ext1, $allowed_img) || !in_array($ext2, $allowed_img) || !in_array($ext3, $allowed_contrat)) {

           header("location: ../index.php?format_invalid=yes");
        }
    }

 }


?>