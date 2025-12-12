<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['usuario'])) {
           $errors[] = "Usuario vacío";
        } else if (
			!empty($_POST['usuario'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		include_once "../../lib/Helper/CryptoHelper.php";

		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellidos=mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$status=mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
		// $password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));
		$lat=mysqli_real_escape_string($con,(strip_tags($_POST["lat"],ENT_QUOTES)));
		$long=mysqli_real_escape_string($con,(strip_tags($_POST["long"],ENT_QUOTES)));

		$password = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES))));
		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];

		if (isset($_POST['is_admin'])) {
			$is_admin=1;
		}else{
			$is_admin=0;
		}
		$id=intval($_POST['mod_id']);

		//$usuarios=mysqli_query($con, "select * from user where username='$usuario'");
		//	if (mysqli_num_rows($usuarios)>0) {
		//		$errors []= "El Usuario Ya Existe.";
		//		
		//	}else{
			/*$total=0;
			if(isset($_POST['area'])){
				foreach($_POST['area'] as $areas){
					$usuarios_areas_actuales=mysqli_query($con, "select * from area where id='$areas' and supervisor_id='$id' ");
					$counts_areas=mysqli_num_rows($usuarios_areas_actuales);
					$total+=$counts_areas;
				}
				if($total==0){*/
					// $messages[] = "Usuario actualizado con exito";
					$sql="UPDATE user SET username=\"$usuario\", name=\"$nombre\",lastname=\"$apellidos\",email=\"$email\",is_admin=\"$is_admin\",is_active=\"$status\",latitude=\"$lat\",longitude=\"$long\" WHERE id=$id";
					$query_update = mysqli_query($con,$sql);
						if ($query_update){
							$messages[] = "El usuario ha sido actualizado satisfactoriamente.";
							if(!empty($_POST['area'])){
								$delete_areas_user=mysqli_query($con,"delete from usuarios_areas where user_id=$id");
								if($delete_areas_user){
									if($is_admin==0){
										if(isset($_POST['area'])){	
											foreach($_POST['area'] as $areas){
												$query2=mysqli_query($con,"insert into usuarios_areas (user_id, area_id, created_at) values ($id,$areas,'$created_at')");
											}
										}
									}
								}
							}
							if($_POST['password']!=""){
								$sql_pass=mysqli_query($con, "UPDATE user SET password=\"$password\" WHERE id=$id");
								if($sql_pass){
									$messages[] = " Y su contraseña se ah modificado.";
								}
							}
							print("<script>window.location='./?view=usuarios'</script>");
						} else{
							$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
						}
				/*}else{
					$errors []= "El usuario existe en un Area, por favor vaya a: Areas --> Editar y actualize el supervisor!";
				}*/
			// }
		//}		
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