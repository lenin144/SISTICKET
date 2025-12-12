<?php	
	session_start();

	if (empty($_POST['area'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['area']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$area=mysqli_real_escape_string($con,(strip_tags($_POST["area"],ENT_QUOTES)));
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
        $numero=mysqli_real_escape_string($con,(strip_tags($_POST["numero"],ENT_QUOTES)));
        $proveedor=mysqli_real_escape_string($con,(strip_tags($_POST["proveedor"],ENT_QUOTES)));
        $fecha=mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
        $bienservicio=mysqli_real_escape_string($con,(strip_tags($_POST["bienservicio"],ENT_QUOTES)));
        $categoria=mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
        $marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
        $descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
        $cantidad=mysqli_real_escape_string($con,(strip_tags($_POST["cantidad"],ENT_QUOTES)));
        $ptsoles=mysqli_real_escape_string($con,(strip_tags($_POST["ptsoles"],ENT_QUOTES)));
        $ptdolares=mysqli_real_escape_string($con,(strip_tags($_POST["ptdolares"],ENT_QUOTES)));
     
        $file=mysqli_real_escape_string($con,(strip_tags($_REQUEST["file"],ENT_QUOTES)));
	
        $sql = "INSERT INTO `ordendecompra` (`id`, `area`, `usuario`, `numero`, `proveedor`, `fecha`, `bienservicio`, `categoria`, `marca`, `descripcion`, `cantidad`, `ptsoles`, `ptdolares`) VALUES (NULL, \"$area\", \"$usuario\", \"$numero\", \"$proveedor\", \"$fecha\", \"$bienservicio\", \"$categoria\", \"$marca\", \"$descripcion\", \"$cantidad\", \"$ptsoles\", \"$ptdolares\")";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El dato ha sido ingresado satisfactoriamente.";
				//sleep(1);

                $last=mysqli_query($con,"SELECT LAST_INSERT_ID(`id`) AS 'last' FROM `ordendecompra` order by id desc limit 0,1 ");
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
					                $img_insert="https://ticket.calidraperu.com.pe/"."Documentos/Datos/$new_name";
								}else{ 
									$img_insert="";
								}
				            	$sql = "UPDATE `ordendecompra` SET `adjunto".$cont."` = \"$img_insert\" WHERE `ordendecompra`.`id` = \"$iddato\"";
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

				 print("<script>window.location='./?view=ordendecompra'</script>");				
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