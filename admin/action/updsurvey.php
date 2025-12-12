<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['title'])) {
           $errors[] = "Titulo vacío";
        } else if (
			!empty($_POST['title'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$title=mysqli_real_escape_string($con,(strip_tags($_POST["title"],ENT_QUOTES)));
		$description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
		$status=mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
		$id=intval($_POST['mod_id']);

		$sql="UPDATE survey SET title=\"$title\", description=\"$description\",Active=\"$status\" WHERE idSurvey=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La encuesta ha sido actualizada satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=encuestor_design'</script>");
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