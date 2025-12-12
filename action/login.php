<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/

	//Contiene las variables de configuracion para conectar a la base de datos
	include "../admin/config/config.php";
	include_once "../lib/Helper/CryptoHelper.php";
	session_start();

	if (isset($_POST['token']) && $_POST['token']!=='') {
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$rfc=mysqli_real_escape_string($con,(strip_tags($_POST["rfc"],ENT_QUOTES)));
		$password = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES))));

		//query de clientes
		// $query_clientes = mysqli_query($con,"SELECT * FROM user WHERE (email=\"$email\" and password=\"$password\") and is_client=1 ");
		$query_clientes = mysqli_query($con,"SELECT * FROM user WHERE (ruc=\"$rfc\") and is_client=1 ");

	    //query de usuarios:
			$query_user = mysqli_query($con,"SELECT * FROM user WHERE (email=\"$email\" or username=\"$email\") and password=\"$password\"");

	    if(mysqli_num_rows($query_clientes)>0 or mysqli_num_rows($query_user)>0){

		    // login que le corresponde a los clientes
		    if(mysqli_num_rows($query_clientes)>0){
				if($row = mysqli_fetch_array($query_clientes)){
					if ($row['ban']==0) { //comprovamos que el usuario este activo
						$_SESSION['user_id'] = $row['id'];
						$_SESSION['modal'] = true;
						// registrar last_login
						$update = mysqli_query($con,"UPDATE `user` SET `last_login` = NOW() WHERE `user`.`id` = ".$row['id']);
						header("location: ../?view=tickets");
					}else{
						// header("location: ../index.php?ban");
						header("location: ../");
						$_SESSION['data']=array('alert'=>'danger','notice'=>'¡Aviso!', 'msg'=>'Lo sentimos la cuenta fue baneada, contacte al administrador');
					}

				}
			// login que le corresponde a los usuarios	
			}else if(mysqli_num_rows($query_user)>0){
				if ($row = mysqli_fetch_array($query_user)) {
					if ($row['is_active']==1) { //comprovamos que el usuario este activo
						$_SESSION['admin_id'] = $row['id'];
						header("location: ../admin/?view=dashboard");
					}else{
						// header("location: ../index.php?inactive");
						header("location: ../");
						$_SESSION['data']=array('alert'=>'danger','notice'=>'¡Aviso!', 'msg'=>'Lo sentimos la cuenta esta inactiva, contacte al administrador.');
					}
				}
			}
			if ($_POST['session']) {
	    		ini_set('session.cookie_lifetime',time() + (60*60*24*30));
	    	}
	    }else{
	    	//si es igual a cero, ya sea el cliente o usuario no estan en la base de datos!
	    	// header("Location: ../index.php?invalid");
	    	header("Location: ../");
    		$_SESSION['data']=array('alert'=>'danger','notice'=>'¡Aviso!', 'msg'=>'Usuario y/o contraseña incorrecto!');
	    }

	}else{
		header("location: ../");
	}

?>