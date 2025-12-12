<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	session_start();


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$area=mysqli_real_escape_string($con,(strip_tags($_POST["area"],ENT_QUOTES)));
        $tarea=mysqli_real_escape_string($con,(strip_tags($_POST["tarea"],ENT_QUOTES)));
        $manual=mysqli_real_escape_string($con,(strip_tags($_POST["manual"],ENT_QUOTES)));
        $tiempo=mysqli_real_escape_string($con,(strip_tags($_POST["tiempo"],ENT_QUOTES)));
        $frecuencia=mysqli_real_escape_string($con,(strip_tags($_POST["frecuencia"],ENT_QUOTES)));
        $tipo=mysqli_real_escape_string($con,(strip_tags($_POST["tipo"],ENT_QUOTES)));
        $inicio=mysqli_real_escape_string($con,(strip_tags($_POST["inicio"],ENT_QUOTES)));
        $responsable=mysqli_real_escape_string($con,(strip_tags($_POST["responsable"],ENT_QUOTES)));
		$empleado=mysqli_real_escape_string($con,(strip_tags($_POST["empleado"],ENT_QUOTES)));


		$sql="INSERT INTO `mantenimiento` (`Id`, `Oficina`, `Tarea`, `Manual`, `Tiempo`, `Frecuencia`, `Inicio`, `Area`, `Tipo`, `Ocultar`, Empleado) VALUES (NULL, \"$area\", \"$tarea\", \"$manual\", \"$tiempo\", \"$frecuencia\", \"$inicio\", \"$responsable\", \"$tipo\", '0000', $empleado)";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El mantenimiento ha sido ingresado satisfactoriamente.";
				//sleep(1);
				print("<script>window.location='./?view=mantenimiento'</script>");
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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