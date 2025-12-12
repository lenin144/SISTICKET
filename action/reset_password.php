<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
	session_start();

	if (isset($_POST['token']) && $_POST['token']!=='') {
			
		//Contiene las variables de configuracion para conectar a la base de datos
		include "../admin/config/config.php";
		include_once "../lib/Helper/CryptoHelper.php";
		include_once "../lib/send.php";





//correo electronico smtp
$emails_smtp=mysqli_query($con,"select * from configuration where name='email_smtp'");
$rw_emails_smtp=mysqli_fetch_array($emails_smtp);
$email_user=$rw_emails_smtp['val'];

//contraseña smtp
$password_smtp=mysqli_query($con,"select * from configuration where name='password_smtp'");
$rw_password_smtp=mysqli_fetch_array($password_smtp);
$email_password=$rw_password_smtp['val'];

//nombre empresa smtp
$name_smtp=mysqli_query($con,"select * from configuration where name='name_smtp'");
$rw_name_smtp=mysqli_fetch_array($name_smtp);
$from_name=$rw_name_smtp['val'];

//HOST smtp
$host_smtp=mysqli_query($con,"select * from configuration where name='host_smtp'");
$rw_host_smtp=mysqli_fetch_array($host_smtp);
$Host=$rw_host_smtp['val'];

//PORT smtp
$port_smtp=mysqli_query($con,"select * from configuration where name='port_smtp'");
$rw_port_smtp=mysqli_fetch_array($port_smtp);
$Port=$rw_port_smtp['val'];

//URL BASE
$url_base_config=mysqli_query($con,"select * from configuration where name='url_base'");
$rw_url_base=mysqli_fetch_array($url_base_config);
$url_base=$rw_url_base['val'];

		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		//query de clientes
		$query_clientes = mysqli_query($con,"SELECT * FROM user WHERE (email=\"$email\") and is_client=1");
	    //query de usuarios:
		$query_user = mysqli_query($con,"SELECT * FROM user WHERE (email=\"$email\") and is_client=0");

	    if(mysqli_num_rows($query_clientes)>0 or mysqli_num_rows($query_user)>0){

		    // login que le corresponde a los clientes
		    if(mysqli_num_rows($query_clientes)>0){
				if($row = mysqli_fetch_array($query_clientes)){
					if ($row['ban']==0) { //comprovamos que el usuario este activo
						//mail de recuperacion de cuenta
							// $password = CryptoHelper::decrypt($row['password']);
							$email_user_reset = $row['email'];
							$user_id = $row['id'];
							$id_code = CryptoHelper::encrypt($row['id']);
								$str = "abcdefghijklmopqrstuvwxyz1234567890";
								$code = "";
								for ($i=0; $i < 6; $i++) { 
									$code .= $str[rand(0,strlen($str)-1)];
								}
								$code = $code;
						//fin email	
						//enviar email:
						$sql = "insert into recover (user_id,code,is_used,created_at) ";
						$sql .= "value ($user_id,\"$code\",0,NOW())";
						mysqli_query($con,$sql);
						reset_password($email_user,$email_password,$from_name,$Host,$Port,$url_base,     $email_user_reset,$id_code,$code);
						// header("location: ../?view=reset_password&success&cl");
						header("location: ../?view=reset_password");
						$_SESSION['data']=array('alert'=>'success','notice'=>'¡Aviso!', 'msg'=>'Le hemos enviado un Correo Electrónico con los pasos para recuperar su cuenta!');

					}else{
						// header("location: ../?view=reset_password&ban");
						header("location: ../?view=reset_password");
						$_SESSION['data']=array('alert'=>'danger','notice'=>'¡Error!', 'msg'=>'Lo sentimos la cuenta fue baneada, contacte al administrador.');
					}

				}
			// login que le corresponde a los usuarios	
			}else if(mysqli_num_rows($query_user)>0){
				if ($row2 = mysqli_fetch_array($query_user)) {
					//mail de recuperacion de cuenta
						// $password = CryptoHelper::decrypt($row2['password']);
						$email_user_reset = $row2['email'];
						$user_id = $row2['id'];
						$id_code = CryptoHelper::encrypt($row2['id']);
								$str = "abcdefghijklmopqrstuvwxyz1234567890";
								$code = "";
								for ($i=0; $i < 6; $i++) { 
									$code .= $str[rand(0,strlen($str)-1)];
								}
								$code = $code;
						$sql = "insert into recover (user_id,code,is_used,created_at) value ($user_id,\"$code\",0,NOW())";
						mysqli_query($con,$sql);		
						reset_password($email_user,$email_password,$from_name,$Host,$Port,$url_base,     $email_user_reset,$id_code,$code);
					//fin email	
					// header("location: ../?view=reset_password&success&us");
					header("location: ../?view=reset_password");
					$_SESSION['data']=array('alert'=>'success','notice'=>'¡Aviso!', 'msg'=>'Le hemos enviado un Correo Electrónico con los pasos para recuperar su cuenta!');
				}
			}

	    }else{
	    	//si es igual a cero, ya sea el cliente o usuario no estan en la base de datos!
	    	// header("Location: ../?view=reset_password&invalid");
	    	header("Location: ../?view=reset_password&invalid");
	    	$_SESSION['data']=array('alert'=>'danger','notice'=>'¡Error!', 'msg'=>'El Correo Electrónico ingresado no esta registrado en nuestro sistema, vuelva a intentarlo!.');
	    }

	}else{
		header("location: ../");
	}

?>