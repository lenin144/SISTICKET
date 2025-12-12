<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['requerimiento'])) {
           $errors[] = "Categoría vacío";
        } else if (
			!empty($_POST['requerimiento'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["requerimiento"],ENT_QUOTES)));
		$area_id=mysqli_real_escape_string($con,(strip_tags($_POST["area_id"],ENT_QUOTES)));
		$type=mysqli_real_escape_string($con,(strip_tags($_POST["type"],ENT_QUOTES)));
		$impact_id=mysqli_real_escape_string($con,(strip_tags($_POST["impact_id"],ENT_QUOTES)));
		$urgency_id=mysqli_real_escape_string($con,(strip_tags($_POST["urgency_id"],ENT_QUOTES)));
		$priority_id=mysqli_real_escape_string($con,(strip_tags($_POST["priority_id"],ENT_QUOTES)));
		$status=mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
		$id=intval($_POST['mod_id']);

		$sql="UPDATE tipos_requerimientos SET name=\"$name\",area_id=$area_id,idType=\"$type\", idImpact=\"$impact_id\",idUrgency=\"$urgency_id\",idPriority=\"$priority_id\",Active=\"$status\" WHERE id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La categoría ha sido actualizada satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=categorias'</script>");
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