<?php	
	session_start();

	if (empty($_POST['numcom'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['numcom']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$numcom=mysqli_real_escape_string($con,(strip_tags($_POST["numcom"],ENT_QUOTES)));
        $tipo=mysqli_real_escape_string($con,(strip_tags($_POST["tipo"],ENT_QUOTES)));
        $numero=mysqli_real_escape_string($con,(strip_tags($_POST["numero"],ENT_QUOTES)));
        $razon=mysqli_real_escape_string($con,(strip_tags($_POST["razon"],ENT_QUOTES)));
        $fecha=mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
        $bienservicio=mysqli_real_escape_string($con,(strip_tags($_POST["bienservicio"],ENT_QUOTES)));
        $total=mysqli_real_escape_string($con,(strip_tags($_POST["total"],ENT_QUOTES)));
        $file=mysqli_real_escape_string($con,(strip_tags($_REQUEST["file"],ENT_QUOTES)));
        $iddato=$_POST['id'];
	
        $sql = "UPDATE `compras` SET `numcom` = \"$numcom\", `tipo` = \"$tipo\" , `numero` = \"$numero\", `razon` = \"$razon\", `fecha` = \"$fecha\", `bienservicio` = \"$bienservicio\", `total` = \"$total\" WHERE `compras`.`id` = \"$iddato\"";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El dato ha sido actualizado satisfactoriamente.";
				//sleep(1);


				

                if($file==="true"){
				    if(is_array($_FILES)){

				        // foreach($_FILES['imagefile']['name'] as $name => $value)  {  
							if($_FILES["imagefile"]["name"] != ""){

							
								$target_dir="../../Documentos/Datos/";
								$image_name = time()."_".basename($_FILES["imagefile"]["name"]);
								$target_file = $target_dir .$image_name ;
								$imageFileZise=$_FILES["imagefile"]["size"];
								$file_name = explode(".", $_FILES['imagefile']['name']); 
								$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
								   if(!in_array($file_name[1], $allowed_extension)){ 
									   $errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
								}else if ($imageFileZise > 10485760) {//10485760 byte=1MB
									$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
								}else{
									if ($imageFileZise>0){
										$new_name = rand() . '.'. $file_name[1];  
										$sourcePath = $_FILES["imagefile"]["tmp_name"];  
										$targetPath = "../../Documentos/Datos/".$new_name;  
										move_uploaded_file($sourcePath, $targetPath);
										$img_insert="Documentos/Datos/$new_name";
									}else{ 
										$img_insert="";
									}
									$sql = "UPDATE `compras` SET `adjunto1` = \"$img_insert\" WHERE `compras`.`id` = \"$iddato\"";
									$query_new_insert = mysqli_query($con,$sql);
									if($query_new_insert){ 
										// $messages[] = "success";
									}else{
										$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
									}
								}
							}
							# Archivo 2
					
							if($_FILES["imagefile2"]["name"] != ""){
								$target_dir="../../Documentos/Datos/";
								$image_name = time()."_".basename($_FILES["imagefile2"]["name"]);
								$target_file = $target_dir .$image_name ;
								$imageFileZise=$_FILES["imagefile2"]["size"];
								$file_name = explode(".", $_FILES['imagefile2']['name']); 
								$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
								   if(!in_array($file_name[1], $allowed_extension)){ 
									   $errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
								}else if ($imageFileZise > 10485760) {//10485760 byte=1MB
									$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
								}else{
									if ($imageFileZise>0){
										$new_name = rand() . '.'. $file_name[1];  
										$sourcePath = $_FILES["imagefile2"]["tmp_name"];  
										$targetPath = "../../Documentos/Datos/".$new_name;  
										move_uploaded_file($sourcePath, $targetPath);
										$img_insert="Documentos/Datos/$new_name";
									}else{ 
										$img_insert="";
									}
									$sql = "UPDATE `compras` SET `adjunto2` = \"$img_insert\" WHERE `compras`.`id` = \"$iddato\"";
									$query_new_insert = mysqli_query($con,$sql);
									if($query_new_insert){ 
										// $messages[] = "success";
									}else{
										$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
									}
								}
							}

							# Archivo 3
							if($_FILES["imagefile3"]["name"] != ""){
								$target_dir="../../Documentos/Datos/";
								$image_name = time()."_".basename($_FILES["imagefile3"]["name"]);
								$target_file = $target_dir .$image_name ;
								$imageFileZise=$_FILES["imagefile3"]["size"];
								$file_name = explode(".", $_FILES['imagefile3']['name']); 
								$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
								   if(!in_array($file_name[1], $allowed_extension)){ 
									   $errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
								}else if ($imageFileZise > 10485760) {//10485760 byte=1MB
									$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
								}else{
									if ($imageFileZise>0){
										$new_name = rand() . '.'. $file_name[1];  
										$sourcePath = $_FILES["imagefile3"]["tmp_name"];  
										$targetPath = "../../Documentos/Datos/".$new_name;  
										move_uploaded_file($sourcePath, $targetPath);
										$img_insert="Documentos/Datos/$new_name";
									}else{ 
										$img_insert="";
									}
									$sql = "UPDATE `compras` SET `adjunto3` = \"$img_insert\" WHERE `compras`.`id` = \"$iddato\"";
									$query_new_insert = mysqli_query($con,$sql);
									if($query_new_insert){ 
										// $messages[] = "success";
									}else{
										$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
									}
								}
							}
				        // }
				    } 
				}else{
					// $errors[] = "sin archivos ";
				}

				print("<script>window.location='./?view=compras'</script>");				
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