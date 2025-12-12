<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	session_start();

	if (empty($_POST['priority_id'])) {
           $errors[] = "Prioridad vacío";
        } else if (
			!empty($_POST['priority_id']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$impact_id=mysqli_real_escape_string($con,(strip_tags($_POST["impact_id"],ENT_QUOTES)));
		$urgency_id=mysqli_real_escape_string($con,(strip_tags($_POST["urgency_id"],ENT_QUOTES)));
		$priority_id=mysqli_real_escape_string($con,(strip_tags($_POST["priority_id"],ENT_QUOTES)));
		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];

		$sql="INSERT INTO prioritymatrix (idImpact, idUrgency,idPriority,Active) VALUES (\"$impact_id\", \"$urgency_id\", \"$priority_id\",1)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "La prioridad ha sido ingresada satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=prioridades'</script>");
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