<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	session_start();

	
	include "../admin/config/config.php";//Contiene funcion que conecta a la base de datos
	// print_r($_POST);
	if (empty($_POST)) {
           $errors[] = "Selecciona alguna opción.";
        } else if (
			!empty($_POST) 
		){
			$idSurveyTicket = intval($_REQUEST['idSurveyTicket']);
			$porcentaje = 0;
			foreach ($_POST as $key => $value) {
				$sql="UPDATE surveyticketresponse SET Selected=1 WHERE idResponse=$value";
				$query_new_insert = mysqli_query($con,$sql);
				$sql =mysqli_query($con,"select Porcentage from surveyticketresponse where idResponse=$value");
				$rw = mysqli_fetch_array($sql);
				$porcentaje += $rw['Porcentage'];
			}

			$Porcentage = $porcentaje/count($_POST);

			if ($query_new_insert){
				#actualizo la tabla surveyticket
				mysqli_query($con,"UPDATE surveyticket SET DateCompleted=NOW(),Porcentage=$Porcentage WHERE idSurveyTicket=$idSurveyTicket");
				$messages[] = "Encuesta completada correctamente...";
				// $messages[] = "<br> Ahora te redireccionaremos...";
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