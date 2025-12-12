<?php	
	session_start();

	if (empty($_POST['requerimiento'])) {
           $errors[] = "Categoría vacío";
        } else if (
			!empty($_POST['requerimiento']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["requerimiento"],ENT_QUOTES)));
		$area_id=mysqli_real_escape_string($con,(strip_tags($_POST["area_id"],ENT_QUOTES)));
		$impact_id=mysqli_real_escape_string($con,(strip_tags($_POST["impact_id"],ENT_QUOTES)));
		$urgency_id=mysqli_real_escape_string($con,(strip_tags($_POST["urgency_id"],ENT_QUOTES)));
		$priority_id=mysqli_real_escape_string($con,(strip_tags($_POST["priority_id"],ENT_QUOTES)));
		$type=mysqli_real_escape_string($con,(strip_tags($_POST["type"],ENT_QUOTES)));

		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];

		$sql="INSERT INTO tipos_requerimientos (name, area_id,created_at,idType,idImpact,idUrgency,idPriority,Active) VALUES (\"$name\",$area_id, \"$created_at\", \"$type\",\"$impact_id\",\"$urgency_id\",\"$priority_id\",1)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "La Categoría ha sido ingresada satisfactoriamente.";
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