<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['ruc'])) {
           $errors[] = "RFC vacío";
        } else if (
			!empty($_POST['ruc'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		include "../../lib/send.php";
		include_once "../../lib/Helper/CryptoHelper.php";

		$empresa=mysqli_real_escape_string($con,(strip_tags($_POST["empresa"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellidos=mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
		// $encargado=mysqli_real_escape_string($con,(strip_tags($_POST["encargado"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$ruc=mysqli_real_escape_string($con,(strip_tags($_POST["ruc"],ENT_QUOTES)));
		$phone=mysqli_real_escape_string($con,(strip_tags($_POST["phone"],ENT_QUOTES)));
		$status=mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
		$id=intval($_POST['mod_id']);
		$file=mysqli_real_escape_string($con,(strip_tags($_REQUEST["file"],ENT_QUOTES)));
  

		if($status==1){
			$ban=0;
		}else if($status==0){
			$ban=1;
		}

		$lat=mysqli_real_escape_string($con,(strip_tags($_POST["lat"],ENT_QUOTES)));
		$long=mysqli_real_escape_string($con,(strip_tags($_POST["long"],ENT_QUOTES)));
		
		//contraseña:
		$pass_email=mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));

		//contraseña con hash:
		$password = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES))));
		$confirm_pass = CryptoHelper::encrypt(mysqli_real_escape_string($con,(strip_tags($_POST["confirm_pass"],ENT_QUOTES))));


		// $clientes=mysqli_query($con, "select * from clientes where ruc=\"$ruc\"");

				$sql="UPDATE user SET name=\"$nombre\",lastname=\"$apellidos\",business=\"$empresa\",email=\"$email\",phone=\"$phone\",ruc=\"$ruc\",is_active=\"$status\",ban=\"$ban\",latitude=\"$lat\",longitude=\"$long\" WHERE id=$id";
				$query_update = mysqli_query($con,$sql);
				if ($query_update){
					## Archivos adjuntos
					if($file==="true"){
						if(is_array($_FILES)){
	
							// foreach($_FILES['imagefile']['name'] as $name => $value)  {  
								if($_FILES["imagefile"]["name"] != ""){
	
								
									$target_dir="../../Documentos/Empleados/";
									$image_name = time()."_".basename($_FILES["imagefile"]["name"]);
									$target_file = $target_dir .$image_name ;
									$imageFileZise=$_FILES["imagefile"]["size"];
									$file_name = explode(".", $_FILES['imagefile']['name']); 
									$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
									   if(!in_array($file_name[1], $allowed_extension)){ 
										   $errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
									}else if ($imageFileZise > 104857600) {//10485760 byte=1MB
										$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
									}else{
										if ($imageFileZise>0){
											$new_name = rand() . '.'. $file_name[1];  
											$sourcePath = $_FILES["imagefile"]["tmp_name"];  
											$targetPath = "../../Documentos/Empleados/".$new_name;  
											move_uploaded_file($sourcePath, $targetPath);
											$img_insert="Documentos/Empleados/$new_name";
										}else{ 
											$img_insert="";
										}
										$sql = "UPDATE `user` SET `file1` = \"$img_insert\" WHERE `user`.`id` = \"$id\"";
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
									$target_dir="../../Documentos/Empleados/";
									$image_name = time()."_".basename($_FILES["imagefile2"]["name"]);
									$target_file = $target_dir .$image_name ;
									$imageFileZise=$_FILES["imagefile2"]["size"];
									$file_name = explode(".", $_FILES['imagefile2']['name']); 
									$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
									   if(!in_array($file_name[1], $allowed_extension)){ 
										   $errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
									}else if ($imageFileZise > 104857600) {//10485760 byte=1MB
										$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
									}else{
										if ($imageFileZise>0){
											$new_name = rand() . '.'. $file_name[1];  
											$sourcePath = $_FILES["imagefile2"]["tmp_name"];  
											$targetPath = "../../Documentos/Empleados/".$new_name;  
											move_uploaded_file($sourcePath, $targetPath);
											$img_insert="Documentos/Empleados/$new_name";
										}else{ 
											$img_insert="";
										}
										$sql = "UPDATE `user` SET `file2` = \"$img_insert\" WHERE `user`.`id` = \"$id\"";
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

					$messages[] = "El cliente ha sido actualizado satisfactoriamente.";

//actualizar contraseña: y enviar un email con la actualización
if(!empty($password) && !empty($confirm_pass) && !empty($pass_email)){

	$sql_pass="UPDATE user SET password=\"$password\" WHERE id=$id";
	$query_update_pass = mysqli_query($con,$sql_pass);
	/*if($query_update_pass){
		$messages[] = " Y la contraseña ha sido actualizada correctamente.";
	}else{
		$errors []= "Error: No se pudo actualizar la contraseña!.";
	}*/


	//correo electronico smtp
	$emails_smtp=mysqli_query($con,"select * from configuration where name='email_smtp'");
	$rw_emails_smtp=mysqli_fetch_array($emails_smtp);
	$email_user=$rw_emails_smtp['val'];

	//contraseña smtp
	$password_smtp=mysqli_query($con,"select * from configuration where name='password_smtp'");
	$rw_password_smtp=mysqli_fetch_array($password_smtp);
	$email_password=$rw_password_smtp['val'];

	//nombre empresa smtp
	$name_smtp=mysqli_query($con,"select * from configuration where name='name_smtp'");
	$rw_name_smtp=mysqli_fetch_array($name_smtp);
	$from_name=$rw_name_smtp['val'];

	//HOST smtp
	$host_smtp=mysqli_query($con,"select * from configuration where name='host_smtp'");
	$rw_host_smtp=mysqli_fetch_array($host_smtp);
	$Host=$rw_host_smtp['val'];

	//PORT smtp
	$port_smtp=mysqli_query($con,"select * from configuration where name='port_smtp'");
	$rw_port_smtp=mysqli_fetch_array($port_smtp);
	$Port=$rw_port_smtp['val'];

	//URL BASE
	$url_base_config=mysqli_query($con,"select * from configuration where name='url_base'");
	$rw_url_base=mysqli_fetch_array($url_base_config);
	$url_base=$rw_url_base['val'];

	//enviar email:
	update_client($email_user,$email_password,$from_name,$Host,$Port,$url_base, $email,$pass_email);

}					

					print("<script>window.location='./?view=clientes'</script>");
				}else{
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