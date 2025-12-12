<?php
	session_start();
	if (empty($_POST['ticked_id'])) {
           $errors[] = "Ticket vacío";
        } else if (
			!empty($_POST['ticked_id'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		require_once ("../../lib/send.php"); 
		
		$asigned_id=mysqli_real_escape_string($con,(strip_tags($_POST["asigned_id"],ENT_QUOTES)));
		$id_area=mysqli_real_escape_string($con,(strip_tags($_POST["id_area"],ENT_QUOTES)));
		$tipo_requerimiento=mysqli_real_escape_string($con,(strip_tags($_POST["tipo_requerimiento"],ENT_QUOTES)));
		$id=intval($_POST['ticked_id']);
		$dateBitacora=date("Y-m-d H:i:s");
		$created_at=date("Y-m-d H:i:s");


		//agrego una bitacora automatica
	    $clientes=mysqli_query($con,"select * from user where id=$asigned_id");
	    $rw_cliente=mysqli_fetch_array($clientes);
	    $nombre_cliente=$rw_cliente['name']." ".$rw_cliente['lastname'];
	    $email_agente=$rw_cliente['email'];
	    $text="<b>Reasignado a</b>: $nombre_cliente";
	    if(isset($_SESSION['user_id'])){
		    $idUser=$_SESSION['user_id'];
	    }else if(isset($_SESSION['admin_id'])){
	    	$idUser=$_SESSION['admin_id'];
	    }
	    //estado del ticket actual
		    $tickets=mysqli_query($con,"select status_id from tickets where id=$id");
		    $rw_ticket=mysqli_fetch_array($tickets);
		    $ticket_status=$rw_ticket['status_id'];
	    //fin
	    $sql_insert_bitacora=mysqli_query($con,"INSERT INTO log_bitacora (ticket_id,comment,created_at,dateBitacora,idUser,idStatus) VALUES ($id,\"$text\",\"$created_at\",\"$dateBitacora\",$idUser,2)");













		    /*
				envio de email
		    */
				
				//usuario o cliente que registro:
				$clientes=mysqli_query($con,"SELECT user.phone,user.business,user.fullname,user.email,user.ruc from tickets inner join user on tickets.client_id=user.id where tickets.id=$id");
				$clientes_rw=mysqli_fetch_array($clientes);
				$fullname_client=$clientes_rw['fullname'];

				$tickets = mysqli_query($con,"select * from tickets where id=$id");
				$ticket_rw=mysqli_fetch_array($tickets);
				$ticket_number=$ticket_rw['number_ticket'];
				$asunt=$ticket_rw['asunt'];
				$comment=$ticket_rw['comment'];
				$area_ticket=$ticket_rw['area'];
				$idPriority=$ticket_rw['idPriority'];
				$created_at=$ticket_rw['created_at'];

				list($date,$hora)=explode(" ",$created_at);
				list($Y,$m,$d)=explode("-",$date);
				$fecha=$d."-".$m."-".$Y." ".$hora;

				//areas del ticket registrado <supervisor>
				// $areas=mysqli_query($con,"SELECT user.name,user.lastname,user.username,user.email from area inner join user on area.supervisor_id=user.id where area.id=$area_ticket");
				$areas = mysqli_query($con,"select * from user where id=$idUser");
				$areas_rw=mysqli_fetch_array($areas);
				$fullname=$areas_rw['name']." ".$areas_rw['lastname'];
				// $email_supervisor=$areas_rw['email'];



				//areas:
				$areas = mysqli_query($con,"select * from area where id=$id_area");
				$area_rw=mysqli_fetch_array($areas);
				$nombre_area=$area_rw['name'];

				//areas:
				$categorias = mysqli_query($con,"select * from tipos_requerimientos where id=$tipo_requerimiento");
				$area_rw=mysqli_fetch_array($categorias);
				$nombre_categoria=$area_rw['name'];

				//prioridades:
				$priority = mysqli_query($con,"select * from priority where idPriority=$idPriority");
				$priority_rw=mysqli_fetch_array($priority);
				$name_priority=$priority_rw['Description'];
				

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


		reasigne_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_agente,$fullname,$ticket_number,$asunt,$comment,$id,$nombre_categoria,$nombre_area,$fecha,$name_priority);

			/*
				Fin de envio de emails
			*/

















		$sql="UPDATE tickets SET status_id=2, asigned_id=\"$asigned_id\", tipo_requerimiento=\"$tipo_requerimiento\", area_id=\"$id_area\" WHERE id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La asignación ah sido actualizada satisfactoriamente.";
				print("<script>window.location='./?view=asignados'</script>");
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