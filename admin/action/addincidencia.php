<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID Ticket vacío";
        }else if (empty($_POST['incidencia'])) {
           $errors[] = "Incidencia vacío";
        }else if ($_POST["date"]>date("Y-m-d")) {
           $errors[] = "La fecha no debe ser mayor a la actual.";
        	// strtotime($_POST["date"]>strtotime(date("Y-m-d")))
           // $errors[] = $_POST["date"]." ".date("Y-m-d");
        }else if (
			!empty($_POST['incidencia'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		require_once ("../../lib/send.php"); 
		
		$id=intval($_POST['mod_id']);
		
		$file=mysqli_real_escape_string($con,(strip_tags($_REQUEST["file"],ENT_QUOTES)));
		// echo $file;

		$date=mysqli_real_escape_string($con,(strip_tags($_POST["date"],ENT_QUOTES)));
		$time=mysqli_real_escape_string($con,(strip_tags($_POST["time"],ENT_QUOTES)));
		$date_added=$date." ".$time;

		$incidencia_txt=mysqli_real_escape_string($con,(strip_tags($_POST["incidencia"],ENT_QUOTES)));
		// $incidencia="<b>Incidencia: </b>".$incidencia_txt;
		$incidencia=$incidencia_txt;
		if(isset($_SESSION['user_id'])){
		    $idUser=$_SESSION['user_id'];
	    }else if(isset($_SESSION['admin_id'])){
	    	$idUser=$_SESSION['admin_id'];
	    }
	    //estado del ticket actual
		    $tickets=mysqli_query($con,"select * from tickets where id=$id");
		    $rw_ticket=mysqli_fetch_array($tickets);
		    $ticket_status=$rw_ticket['status_id'];
		    $number_ticket=$rw_ticket['number_ticket'];
	    //fin

		$created_at=date("Y-m-d H:i:s");


		/*
			envio de email
	    */
			//usuario o cliente que registro:
			$clientes=mysqli_query($con,"SELECT user.phone,user.business,user.fullname,user.email,user.ruc from tickets inner join user on tickets.client_id=user.id where tickets.id=$id");
			$clientes_rw=mysqli_fetch_array($clientes);
			$fullname_client=$clientes_rw['fullname'];
			$email_client=$clientes_rw['email'];


			/*$agentes=mysqli_query($con,"SELECT user.name,user.lastname,user.username,user.email from tickets inner join user on tickets.asigned_id=user.id where tickets.id=$id");
			$areas_rw=mysqli_fetch_array($agentes);
			$fullname_agente=$areas_rw['name']." ".$areas_rw['lastname'];
			$email_agente=$areas_rw['email'];*/

			$agentes=mysqli_query($con,"SELECT * from user where id=$idUser");
			$areas_rw=mysqli_fetch_array($agentes);
			$fullname_agente=$areas_rw['name']." ".$areas_rw['lastname'];
			$email_agente=$areas_rw['email'];

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

			add_proccess($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_client,$fullname_agente,$number_ticket,$incidencia_txt,$id);
		/*
			Fin de envio de emails
		*/

		$sql_update="UPDATE tickets SET status_id=3 WHERE id=$id";
		$query_update = mysqli_query($con,$sql_update);
		
		$sql="INSERT INTO log_bitacora (ticket_id,comment,created_at,dateBitacora,idUser,idStatus) VALUES ($id,\"$incidencia\",\"$created_at\",\"$date_added\",$idUser,3)";
		$query_insert = mysqli_query($con,$sql);
			if ($query_insert){
				$messages[] = "La bitacora se ha agregado satisfactoriamente.";

		    	$last=mysqli_query($con,"select LAST_INSERT_ID(id) as last from log_bitacora order by id desc limit 0,1 ");
				$rw=mysqli_fetch_array($last);
				$idbitacora=$rw['last'];

				if($file==="true"){
				    if(is_array($_FILES)){
				    	// print_r($_FILES);
				        foreach($_FILES['imagefile']['name'] as $name => $value)  {  
							$target_dir="../../Documentos/Bitacoras/";
							$image_name = time()."_".basename($_FILES["imagefile"]["name"][$name]);
							$target_file = $target_dir .$image_name ;
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
									$new_name = rand() . '.'. $file_name[1];  
					                $sourcePath = $_FILES["imagefile"]["tmp_name"][$name];  
					                $targetPath = "../../Documentos/Bitacoras/".$new_name;  
					                move_uploaded_file($sourcePath, $targetPath);
					                $img_insert="Documentos/Bitacoras/$new_name";
								}else{ 
									$img_insert="";
								}
				            	$sql = "
				            			INSERT INTO documentbitacora (idTicket,idBitacora,name,sizeKB,urlDocument) 
				            			values (\"$id\",\"$idbitacora\",\"$new_name\",\"$imageFileZise\",\"$img_insert\");
				            		";
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

				print("<script>window.location='./?view=proceso'</script>");
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