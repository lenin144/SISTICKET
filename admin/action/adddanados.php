<?php	
	session_start();

	if (empty($_POST['equipo'])) {
           $errors[] = "Equipo vacío";
        } else if (!empty($_POST['equipo'])){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$equipo=mysqli_real_escape_string($con,(strip_tags($_POST["equipo"],ENT_QUOTES)));
        $responsable=mysqli_real_escape_string($con,(strip_tags($_POST["responsable"],ENT_QUOTES)));
        $departamento=mysqli_real_escape_string($con,(strip_tags($_POST["departamento"],ENT_QUOTES)));
        $sucursal=mysqli_real_escape_string($con,(strip_tags($_POST["sucursal"],ENT_QUOTES)));
        $fechare=mysqli_real_escape_string($con,(strip_tags($_POST["fechare"],ENT_QUOTES)));
        $observacion=mysqli_real_escape_string($con,(strip_tags($_POST["observacion"],ENT_QUOTES)));
        $file=mysqli_real_escape_string($con,(strip_tags($_REQUEST["file"],ENT_QUOTES)));
	
        $sql = "INSERT INTO `danados` (`id`, `equipo`, `responsable`, `departamento`, `sucursal`, `fechare`, `observacion`) VALUES (NULL, \"$equipo\", \"$responsable\", \"$departamento\", \"$sucursal\", \"$fechare\", \"$observacion\")";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El dato ha sido ingresado satisfactoriamente.";
				//sleep(1);

                $last=mysqli_query($con,"SELECT LAST_INSERT_ID(`id`) AS 'last' FROM `danados` order by id desc limit 0,1 ");
				$rw=mysqli_fetch_array($last);
				$iddato=$rw['last'];

                if($file==="true"){
				    if(is_array($_FILES)){
						$cont = 0;
				        foreach($_FILES['imagefile']['name'] as $name => $value)  {  
							$cont++;
							$target_dir="../../Documentos/Datos/";
							$image_name = time()."_".basename($_FILES["imagefile"]["name"][$name]);
							$target_file = $target_dir .$image_name ;
							$imageFileZise=$_FILES["imagefile"]["size"][$name];
							$file_name = explode(".", $_FILES['imagefile']['name'][$name]); 
							$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
				           	if(!in_array($file_name[1], $allowed_extension)){ 
				           		$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
							}else if ($imageFileZise > 10485760) {//10485760 byte=1MB
								$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
							}else{
								if ($imageFileZise>0){
									$new_name = rand() . '.'. $file_name[1];  
					                $sourcePath = $_FILES["imagefile"]["tmp_name"][$name];  
					                $targetPath = "../../Documentos/Datos/".$new_name;  
					                move_uploaded_file($sourcePath, $targetPath);
					                $img_insert="Documentos/Datos/$new_name";
								}else{ 
									$img_insert="";
								}
				            	$sql = "UPDATE `danados` SET `adjunto".$cont."` = \"$img_insert\" WHERE `danados`.`id` = \"$iddato\"";
				            	$query_new_insert = mysqli_query($con,$sql);
				            	if($query_new_insert){ 
									
				            		// $messages[] = "success";
								}else{
				                	$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
				            	}
							}
				        }
				    } 
				}else{
					// $errors[] = "sin archivos ";
				}

				 print("<script>window.location='./?view=danados'</script>");				
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