<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID Ticket vacío";
        }else if (empty($_POST['description'])) {
           $errors[] = "Descripción vacío";
        }else if (
			!empty($_POST['description'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		require_once ("../../lib/send.php"); 
		
		$id=intval($_POST['mod_id']);

		$description_text=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
		$idReasonCancellation=intval($_POST['idReasonCancellation']);


		$reasoncancellation=mysqli_query($con,"SELECT Description from reasoncancellation where idReasonCancellation=$idReasonCancellation");
		$rscancellation_rw=mysqli_fetch_array($reasoncancellation);
		$mtCancelacion=$rscancellation_rw['Description'];

		// $descripcion="<b>Ticket Cancelado: </b>".$description_text;
		$descripcion="$mtCancelacion. <br />$description_text";

		
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


		
			// envio de email
			//usuario o cliente que registro:
			$clientes=mysqli_query($con,"SELECT user.phone,user.business,user.fullname,user.email,user.ruc from tickets inner join user on tickets.client_id=user.id where tickets.id=$id");
			$clientes_rw=mysqli_fetch_array($clientes);
			$fullname_client=$clientes_rw['fullname'];
			$email_client=$clientes_rw['email'];

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

			 add_cancel($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_client,$mtCancelacion,$number_ticket,$description_text,$id);
		
			// Fin de envio de emails
		

		$sql_update="UPDATE tickets SET status_id=5,idReasonCancellation=$idReasonCancellation,descriptionReasonCancellation=\"$description_text\" WHERE id=$id";
		$query_update = mysqli_query($con,$sql_update);
		
		$sql="INSERT INTO log_bitacora (ticket_id,comment,created_at,dateBitacora,idUser,idStatus) VALUES ($id,\"$descripcion\",\"$created_at\",\"$created_at\",$idUser,5)";
		$query_insert = mysqli_query($con,$sql);
			if ($query_insert){
				$messages[] = "La Cancelación se ha agregado satisfactoriamente.";

				print("<script>window.location='./?view=cancelados'</script>");
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