<?php
$conn=mysqli_connect("localhost","root","","projet2cp");
if (isset($_POST['n'])&& isset($_POST['id_notif'])) {
	# code...

		$conn=mysqli_connect("localhost","root","","projet2cp");
		$x=$_POST['n'];

		$sql='UPDATE notification SET vu='.$x.' WHERE id_notif='.$_POST['id_notif'];
				/*$stmt =mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt,$sql);
				mysqli_stmt_bind_param($stmt,"dd",1,$x);
				mysqli_stmt_execute($stmt);*/
				mysqli_query($conn,$sql);


	}
	if (isset($_POST['close'])&& isset($_POST['id_notif'])) 
	{
		$sql='UPDATE notification SET close='.$_POST['close'].' WHERE id_notif='.$_POST['id_notif'];
		mysqli_query($conn,$sql);
	}
	


?>