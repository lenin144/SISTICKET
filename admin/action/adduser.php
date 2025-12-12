<?php	
	session_start();

	if (empty($_POST['usuario'])) {
           $errors[] = "Usuario vacío";
        } else if (
			!empty($_POST['usuario']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		include "../../lib/send.php";//Contiene funcion que conecta a la base de datos
		include_once "../../lib/Helper/CryptoHelper.php";
		
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellidos=mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));

		$lat=mysqli_real_escape_string($con,(strip_tags($_POST["lat"],ENT_QUOTES)));
		$long=mysqli_real_escape_string($con,(strip_tags($_POST["long"],ENT_QUOTES)));

		//contraseña:
		$pass_email=mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));

		$password = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES))));
		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];
		
		if (isset($_POST['is_admin'])) {
			$is_admin=1;
		}else{
			$is_admin=0;
		}

		$profile_pic="default.png";


		$usuarios=mysqli_query($con, "select * from user where username='$usuario'");
		$emails=mysqli_query($con, "select * from user where email='$email'");
			if (mysqli_num_rows($usuarios)>0) {
				$errors []= "El Usuario Ya existe!";
			}elseif(mysqli_num_rows($emails)>0){
				$errors []= "El Correo Electrónico Ya existe!";
			}else{
				
				$sql="INSERT INTO user (username,name,lastname, email,password, profile_pic, is_active, is_admin, created_at,latitude,longitude) VALUES (\"$usuario\", \"$nombre\", \"$apellidos\", \"$email\", \"$password\",\"$profile_pic\", 1, $is_admin,  \"$created_at\",\"$lat\",\"$long\")";
				$query_new_insert = mysqli_query($con,$sql);

					if ($query_new_insert){
						$messages[] = "El usuario ha sido ingresado satisfactoriamente.";


						$last=mysqli_query($con,"select LAST_INSERT_ID(id) as last from user order by id desc limit 0,1 ");
						$rw=mysqli_fetch_array($last);
						$user_id=$rw['last'];

						//print_r($_POST['area']);
						if($is_admin==0){
							if(isset($_POST['area'])){
								foreach($_POST['area'] as $areas){
									$query2=mysqli_query($con,"insert into usuarios_areas (user_id, area_id, created_at) values ($user_id,$areas,'$created_at')");
								}
							}
						}


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

	//enviar email:
	register_user($email_user,$email_password,$from_name,$Host,$Port,$url_base,     $email,$usuario,$pass_email);



						print("<script>window.location='./?view=usuarios'</script>");
					} else{
						$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
					}
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>