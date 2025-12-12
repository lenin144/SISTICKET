<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['area_id'])) {
           $errors[] = "Area vacío";
        } else if (
			!empty($_POST['area_id'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$area_id=intval($_POST["area_id"]);
		$category_id=intval($_POST["category_id"]);
		$survey_id=intval($_POST["survey_id"]);

		$DateStar=mysqli_real_escape_string($con,(strip_tags($_POST["ExpireDateStar"],ENT_QUOTES)));
		$ExpireTimeStar=mysqli_real_escape_string($con,(strip_tags($_POST["ExpireTimeStar"],ENT_QUOTES)));
		$ExpireDateStar=$DateStar." ".$ExpireTimeStar;

		$DateEnd=mysqli_real_escape_string($con,(strip_tags($_POST["ExpireDateEnd"],ENT_QUOTES)));
		$ExpireTimeEnd=mysqli_real_escape_string($con,(strip_tags($_POST["ExpireTimeEnd"],ENT_QUOTES)));
		$ExpireDateEnd=$DateEnd." ".$ExpireTimeEnd;

		$status=intval($_POST["status"]);
		$id=intval($_POST['mod_id']);

		$sql="UPDATE surveycategory SET IdCategory=\"$category_id\",idSurvey=\"$survey_id\",ExpireDateStar=\"$ExpireDateStar\",ExpireDateEnd=\"$ExpireDateEnd\",Active=\"$status\" WHERE idSurveyCategory=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La configuración ha sido actualizada satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=encuestor_configuration'</script>");
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