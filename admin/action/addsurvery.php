<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	session_start();

	if (empty($_POST['title'])) {
           $errors[] = "Titulo vacío";
        } else if (
			!empty($_POST['title']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$title=mysqli_real_escape_string($con,(strip_tags($_POST["title"],ENT_QUOTES)));
		$description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
		$status=intval($_POST["status"]);
		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];

		$sql="INSERT INTO survey (Title, Description,Active) VALUES (\"$title\", \"$description\",$status)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "La encuesta ha sido ingresado satisfactoriamente.";
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