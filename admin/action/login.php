<?php
	session_start();

	if (isset($_POST)) {
			
	//Contiene las variables de configuracion para conectar a la base de datos
	include "../config/config.php";

	$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
	$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

    $query = mysqli_query($con,"SELECT * FROM user WHERE email =\"$email\" OR username=\"$email\" AND password = \"$password\";");

		if ($row = mysqli_fetch_array($query)) {
			

				$_SESSION['admin_id'] = $row['id'];
				header("location: ../dashboard.php");
				

		}else{
			header("Location: ../index.php?alert=1");
		}
	}else{
		header("location: ../");
	}

?>