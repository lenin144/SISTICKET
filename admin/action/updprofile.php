<?php
	session_start();

	if (!isset($_SESSION['admin_id']) && $_SESSION['admin_id']==null) {
		header("location: ../");
	}

	include "../config/config.php";
	include_once "../../lib/Helper/CryptoHelper.php";

	$id = $_SESSION['admin_id'];
	$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
	$nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
	$apellidos = mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
	$email = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));

		$update=mysqli_query($con,"UPDATE user set username=\"$usuario\", name=\"$nombre\", lastname=\"$apellidos\", email=\"$email\" where id=$id");
		if ($update) {

		   // print "Datos Actualizados.";
			header("location: ../?view=profile&success");
		}

		// CHANGE PASSWORD
		if($_POST['new_password']!=""){

			//$password = sha1(md5($_POST['password']));
			$new_password = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["new_password"],ENT_QUOTES))));
			$confirm_new_password = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["confirm_new_password"],ENT_QUOTES))));

			if($new_password==$confirm_new_password){
				$update_passwd=mysqli_query($con,"UPDATE user set password=\"$new_password\" where id=$id");
				if ($update_passwd) {
					//$success_pass=sha1(md5("contrasena actualizada"));
					header("location: ../?view=profile&success_pass");
					//echo "password actualizado". ": ".$new_password;
				}
			}else{
				//$error=sha1(md5("las nuevas  contraseñas no coinciden"));
				header("location: ../?view=profile&error");
			}
		}


?>