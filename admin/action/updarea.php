<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['area'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['area'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["area"],ENT_QUOTES)));
		$supervisor_id=mysqli_real_escape_string($con,(strip_tags($_POST["supervisor_id"],ENT_QUOTES)));
		$status=mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
		$id=$_POST['mod_id'];

		$sql="UPDATE area SET name=\"$name\", supervisor_id=$supervisor_id,Active=\"$status\" WHERE id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El area ha sido actualizado satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=areas'</script>");
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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