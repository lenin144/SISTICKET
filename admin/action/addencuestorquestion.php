<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	session_start();

	if (empty($_POST['idSurvey'])) {
           $errors[] = "Encuesta vacío";
        }else if (empty($_POST['description'])) {
           $errors[] = "Descripción vacío";
        } else if (
			!empty($_POST['idSurvey']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$idSurvey=intval($_POST["idSurvey"]);
		$description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
		$status=intval($_POST["status"]);
		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];

		$sql="INSERT INTO surveyquestions (idSurvey, Description,Active) VALUES (\"$idSurvey\", \"$description\",$status)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "La pregunta ha sido ingresada satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=encuestor_questions&idsurvey=".$idSurvey."'</script>");
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