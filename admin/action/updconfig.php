<?php
	session_start();
	if (!isset($_SESSION['admin_id']) && $_SESSION['admin_id']==null) {
		header("location: ../");
	}

	include "../config/config.php";

	if(isset($_SESSION["admin_id"]) && !empty($_POST)){
		if (isset($_POST['token'])) {
			foreach ($_POST as $name => $value) {
				$sql = mysqli_query($con,"UPDATE configuration set val=\"$value\" where name=\"$name\"");
		   		// echo $value."=>".$name."<br>";
			}
			if ($sql) {
		   			// $msj=sha1(md5("actualizado correctamente"));
					header("location: ../?view=configuracion&succes");
		   	}
		} 
		
		// echo "actualizado correectamente";
	}else{

		// echo "hubo un error";
		header("location: ../configuracion?error");
	}
?>

