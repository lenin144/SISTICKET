<?php
	if (empty($_POST['password'])) {
           $errors[] = "Contraseña Vacío";
        }else if (empty($_POST['uid'])) {
           $errors[] = "Error desconocido";
        } else if (
			!empty($_POST['password'])
		){

		include "../admin/config/config.php";//Contiene funcion que conecta a la base de datos
		include_once "../lib/Helper/CryptoHelper.php";

		$password=CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES))));
		$uid=intval($_POST["uid"]);
		$idrc=intval($_POST["idrc"]);

		$sql="UPDATE user SET password=\"$password\" WHERE id=$uid";
		$query_update = mysqli_query($con,$sql);
		$query_update_recover = mysqli_query($con,"UPDATE recover SET is_used=1 WHERE id=$idrc");
			if ($query_update){
				$messages[] = "Su Contraseña ha sido actualizada satisfactoriamente. Ya puede iniciar sesión <strong><a style='color: #3c763d;' href='index.php'>Aqui!</a></strong>";
				//sleep(1);
				// print("<script>window.location='./?view=areas'</script>");
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
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