
<?php

require_once "../config/config.php";

$email = mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['email'])))));
$password = sha1(md5(mysqli_real_escape_string($con, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password'])))))));

if (!ctype_alnum($email) OR !ctype_alnum($password)) {
	header("Location: ../index.php?alert=1");
}
else {

	$query = mysqli_query($con, "SELECT * FROM user WHERE username='$email' OR email='$email' AND password='$password'")
									or die('error'.mysqli_error($con));
	$rows  = mysqli_num_rows($query);

	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		session_start();
		$_SESSION['admin_id']   = $data['id'];
		//$_SESSION['username']  = $data['username'];
		//$_SESSION['password']  = $data['password'];
		//$_SESSION['name_user'] = $data['name_user'];
		//$_SESSION['permisos_acceso'] = $data['permisos_acceso'];
	
		header("Location: ../dashboard.php?start=start");
	}


	else {
		header("Location: ../index.php?alert=1");
		
	}
}
?>