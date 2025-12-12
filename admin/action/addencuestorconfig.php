<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	session_start();

	if (empty($_POST['area_id'])) {
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
		$DateRegister=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];

		$sql="INSERT INTO surveycategory (IdCategory, idSurvey,DateRegister,ExpireDateStar,ExpireDateEnd,Active) VALUES ($category_id,$survey_id,\"$DateRegister\", \"$ExpireDateStar\", \"$ExpireDateEnd\",$status)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "La configuración ha sido ingresada satisfactoriamente.";
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