<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['idquestion'])) {
           $errors[] = "Pregunta vacía";
        } else if (
			!empty($_POST['idquestion'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$idsurvey=intval($_POST['idsurvey']);
		$idquestion=intval($_POST['idquestion']);
		$description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
		$SatisfactionPorcentage=mysqli_real_escape_string($con,(strip_tags($_POST["SatisfactionPorcentage"],ENT_QUOTES)));
		$status=intval($_POST['status']);
		$id=intval($_POST['mod_id']);

		$sql="UPDATE surveyresponse SET Description=\"$description\", SatisfactionPorcentage=\"$SatisfactionPorcentage\",Active=\"$status\" WHERE idResponse=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La respuesta ha sido actualizada satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=encuestor_response&idsurvey=".$idsurvey."&idquestion=".$idquestion."'</script>");
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