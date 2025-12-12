<?php
session_start();

if (empty($_POST['ruc'])) {
    $errors[] = "RFC vacío";
} else if (
    !empty($_POST['ruc'])
) {

    include "../config/config.php"; //Contiene funcion que conecta a la base de datos
    include "../../lib/send.php";
    include_once "../../lib/Helper/CryptoHelper.php";

    $empresa = mysqli_real_escape_string($con, (strip_tags($_POST["empresa"], ENT_QUOTES)));
    $nombre = mysqli_real_escape_string($con, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    $apellidos = mysqli_real_escape_string($con, (strip_tags($_POST["apellidos"], ENT_QUOTES)));

    // $encargado=$nombre." ".$apellidos;
    $email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));
    $ruc = mysqli_real_escape_string($con, (strip_tags($_POST["ruc"], ENT_QUOTES)));
    $phone = mysqli_real_escape_string($con, (strip_tags($_POST["phone"], ENT_QUOTES)));

    $lat = mysqli_real_escape_string($con, (strip_tags($_POST["lat"], ENT_QUOTES)));
    $long = mysqli_real_escape_string($con, (strip_tags($_POST["long"], ENT_QUOTES)));

    //contraseña:
    $pass_email = mysqli_real_escape_string($con, (strip_tags($_POST["password"], ENT_QUOTES)));

    //contraseña con hash:
    $password = CryptoHelper::encrypt(mysqli_real_escape_string($con, (strip_tags($_POST["password"], ENT_QUOTES))));
    $confirm_pass = CryptoHelper::encrypt(mysqli_real_escape_string($con, (strip_tags($_POST["confirm_pass"], ENT_QUOTES))));

    $created_at = date("Y-m-d H:i:s");
    //$user_id=$_SESSION['user_id'];

    $file = mysqli_real_escape_string($con, (strip_tags($_REQUEST["file"], ENT_QUOTES)));

    $clientes = mysqli_query($con, "SELECT * from user where ruc=\"$ruc\"");
    $user_email = mysqli_query($con, "SELECT * from user where email=\"$email\"");
    if (mysqli_num_rows($clientes) > 0) {
        $errors[] = "Ya existe un cliente con el mismo RFC";
    } else if (mysqli_num_rows($user_email) > 0) {
        $errors[] = "Ya existe un cliente con el mismo Correo Electrónico.";
    } else {
        if ($password == $confirm_pass) {
            $sql = "INSERT INTO user (name,lastname,business, email,phone, password, ruc, created_at,is_client,latitude,longitude) VALUES (\"$nombre\", \"$apellidos\", \"$empresa\", \"$email\", \"$phone\", \"$password\", \"$ruc\", \"$created_at\",1,\"$lat\",\"$long\")";
            $query_new_insert = mysqli_query($con, $sql);
            if ($query_new_insert) {
                $messages[] = "El cliente ha sido ingresado satisfactoriamente.";
				## Archivo adjunto
				$last=mysqli_query($con,"SELECT LAST_INSERT_ID(`id`) AS 'last' FROM `user` order by id desc limit 0,1 ");
				$rw=mysqli_fetch_array($last);
				$iduser=$rw['last'];

				if($file==="true"){
				    if(is_array($_FILES)){
						$cont = 0;
				        foreach($_FILES['imagefile']['name'] as $name => $value)  {  
							$cont++;
							$target_dir="../../Documentos/Empleados/";
							$image_name = time()."_".basename($_FILES["imagefile"]["name"][$name]);
							$target_file = $target_dir .$image_name ;
							$imageFileZise=$_FILES["imagefile"]["size"][$name];
							$file_name = explode(".", $_FILES['imagefile']['name'][$name]); 
							$allowed_extension = array("doc","docx","xls","xlsx","pdf","zip","jpg","png","jpeg","DOC","DOCX","XLS","XLSX","ZIP","JPG","PNG","JPEG","PDF");
				           	if(!in_array($file_name[1], $allowed_extension)){ 
				           		$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF, DOC, DOCX, XLS ,XLSX, PDF, ZIP.</p>";
							}else if ($imageFileZise > 104857600) {//10485760 byte=1MB
								$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona archivo de menos de 1MB</p>";
							}else{
								if ($imageFileZise>0){
									$new_name = rand() . '.'. $file_name[1];  
					                $sourcePath = $_FILES["imagefile"]["tmp_name"][$name];  
					                $targetPath = "../../Documentos/Empleados/".$new_name;  
					                move_uploaded_file($sourcePath, $targetPath);
					                $img_insert="Documentos/Empleados/$new_name";
								}else{ 
									$img_insert="";
								}
				            	$sql = "UPDATE `user` SET `file".$cont."` = \"$img_insert\" WHERE `user`.`id` = \"$iduser\"";
				            	$query_new_insert = mysqli_query($con,$sql);
				            	if($query_new_insert){ 
									
				            		// $messages[] = "success";
								}else{
				                	$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";
				            	}
							}
				        }
				    } 
				}
				

                //correo electronico smtp
                $emails_smtp = mysqli_query($con, "select * from configuration where name='email_smtp'");
                $rw_emails_smtp = mysqli_fetch_array($emails_smtp);
                $email_user = $rw_emails_smtp['val'];

                //contraseña smtp
                $password_smtp = mysqli_query($con, "select * from configuration where name='password_smtp'");
                $rw_password_smtp = mysqli_fetch_array($password_smtp);
                $email_password = $rw_password_smtp['val'];

                //nombre empresa smtp
                $name_smtp = mysqli_query($con, "select * from configuration where name='name_smtp'");
                $rw_name_smtp = mysqli_fetch_array($name_smtp);
                $from_name = $rw_name_smtp['val'];

                //HOST smtp
                $host_smtp = mysqli_query($con, "select * from configuration where name='host_smtp'");
                $rw_host_smtp = mysqli_fetch_array($host_smtp);
                $Host = $rw_host_smtp['val'];

                //PORT smtp
                $port_smtp = mysqli_query($con, "select * from configuration where name='port_smtp'");
                $rw_port_smtp = mysqli_fetch_array($port_smtp);
                $Port = $rw_port_smtp['val'];

                //URL BASE
                $url_base_config = mysqli_query($con, "select * from configuration where name='url_base'");
                $rw_url_base = mysqli_fetch_array($url_base_config);
                $url_base = $rw_url_base['val'];

                //enviar email:
                register_client($email_user, $email_password, $from_name, $Host, $Port, $url_base, $email, $pass_email);

                print("<script>window.location='./?view=clientes'</script>");
            } else {
                $errors[] = "Lo siento algo ha salido mal intenta nuevamente.";
            }
        } else {
            $errors[] = "La contraseñas no coinciden, vuele a intentarlo!.";
        }

    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {

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
if (isset($messages)) {

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