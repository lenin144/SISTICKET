<?php
	require_once ("../admin/config/config.php");
    $output = '';  
    if(is_array($_FILES)){  
        foreach($_FILES['imagefile']['name'] as $name => $value)  {  
           	/*$file_name = explode(".", $_FILES['imagefile']['name'][$name]); 
          	$size= $_FILES['imagefile']['size'][$name];
           	$allowed_extension = array("jpg", "jpeg", "png", "gif");  
           	if(in_array($file_name[1], $allowed_extension)){  
                $new_name = rand() . '.'. $file_name[1];  
                $sourcePath = $_FILES["imagefile"]["tmp_name"][$name];  
                $targetPath = "uploads/".$new_name;  
                move_uploaded_file($sourcePath, $targetPath);  
           	}  */
	    	$id=intval($_REQUEST['id']);
			$target_dir="../Documentos/Tickets/";
			$image_name = time()."_".basename($_FILES["imagefile"]["name"][$name]);
			$target_file = $target_dir .$image_name ;
			// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$imageFileZise=$_FILES["imagefile"]["size"][$name];
			
			/*if(($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" $imageFileType != "DOC" && $imageFileType != "DOCX" && $imageFileType != "XLS" && $imageFileType != "XLSX" && $imageFileType != "PDF" && $imageFileType != "ZIP" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") and $imageFileZise>0){
				$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";*/
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
					// move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
					// $imagen=basename($_FILES["imagefile"]["name"][$name]);
					// $img_update="image='images/ticket/$image_name' ";
					$new_name = rand() . '.'. $file_name[1];  
	                $sourcePath = $_FILES["imagefile"]["tmp_name"][$name];  
	                $targetPath = "../Documentos/Tickets/".$new_name;  
	                move_uploaded_file($sourcePath, $targetPath);
	                $img_insert="Documentos/Tickets/$new_name";
				}else{ 
					$img_insert="";
				}
            	// $sql = "UPDATE tickets SET $img_update WHERE id=$id;";
            	$sql = "INSERT into documentticket (idTicket,name,sizeKB,urlDocument) values (\"$id\",\"$new_name\",\"$imageFileZise\",\"$img_insert\");";
            	$query_new_insert = mysqli_query($con,$sql);
            	if ($query_new_insert) { 
            		// $message[]="Cargados Correctamente";
            		// $files=mysqli_query($con,"select * from documentticket where idTicket=$id");
            		// if(mysqli_num_rows($files)>0){
            			// foreach($files as $file){
            	?>
					<!-- <a href="#" id="btn_del_file" onclick="del_file(<?php echo $file['iddocumentTicket'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a> -->
				<?php 
						// }
					// }
				} else {
                	$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
            	}
			}

	        /*$images = glob("uploads/*.*");  
	        foreach($images as $image){  
	           $output .= '<div class="col-md-2" align="center" ><img src="' . $image .'" width="180px" height="180px" style="border:1px solid #ccc;margin-top:10px;" /></div>
	           size:"'.$size.'" byte
	           ';  
	        }  
	        echo $output;  */
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
									