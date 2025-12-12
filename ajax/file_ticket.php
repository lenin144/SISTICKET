<?php
	require_once ("../admin/config/config.php");
    $output = '';  
    if(is_array($_FILES)){  
        foreach($_FILES['imagefile']['name'] as $name => $value)  {  
	    	$id=intval($_REQUEST['id']);
			$imageFileZise=$_FILES["imagefile"]["size"][$name];
			$file_name = explode(".", $_FILES['imagefile']['name'][$name]); 
			$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");  
           	if(!in_array($file_name[1], $allowed_extension)){ 
           		$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
			}else if ($imageFileZise > 10485760) {//10485760 byte=1MB
				$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
			}else if (empty($id)){
				$errors[]= "<p>ID del ticket está vacío.</p>";
			}else{
				if ($imageFileZise>0){ 
					$new_name = $_FILES["imagefile"]["name"][$name];
	                $sourcePath = $_FILES["imagefile"]["tmp_name"][$name];  
	                $targetPath = "../Documentos/Tickets/".$new_name;  
	                move_uploaded_file($sourcePath, $targetPath);
	                $img_insert="Documentos/Tickets/$new_name";
				}else{ 
					$img_insert="";
				}
            	$sql = "INSERT into documentticket (idTicket,name,sizeKB,urlDocument) values (\"$id\",\"$new_name\",\"$imageFileZise\",\"$img_insert\");";
            	$query_new_insert = mysqli_query($con,$sql);
            	if ($query_new_insert) { 
            	?>
					<!-- <a href="#" id="btn_del_file" onclick="del_file(<?php echo $file['iddocumentTicket'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a> -->
				<?php 
				} else {
                	$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
            	}
			}
        }
    } 

	?>
	
	<?php if (isset($errors)){ ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error! </strong>
				<?php
				foreach ($errors as $error){
						echo $error;
					}
				?>
			</div>	
	<?php } ?>
	<?php if (isset($messages)){ ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Aviso! </strong>
			<?php
			foreach ($messages as $message){
					echo $message;
				}
			?>
		</div>	
	<?php } ?>
									