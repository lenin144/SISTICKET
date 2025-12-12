<?php
	#compruebo si esta logueado
	session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id'])){
			
	/* Connect To Database*/
	require_once ("../admin/config/config.php"); 
	require_once ("../lib/send.php"); 
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	$id=intval($id);

		$ticket_category=mysqli_query($con,"select * from tickets where id=$id");
		$ticket_category_rw=mysqli_fetch_array($ticket_category);
		$area=$ticket_category_rw['area'];
		$asunt=$ticket_category_rw['asunt'];
		$comment=$ticket_category_rw['comment'];
		$id_categoria=$ticket_category_rw['tipo_requerimiento'];

		$categorias=mysqli_query($con,"select * from tipos_requerimientos where id=$id_categoria");
		$rw_cat=mysqli_fetch_array($categorias);
		$idType=$rw_cat['idType'];

		$id_ticket=$id-1;
		//nuevo modelo de numero de ticket
			$query_id = mysqli_query($con, "SELECT RIGHT(number_ticket,3) as number_ticket FROM tickets where id=$id_ticket ORDER BY number_ticket DESC LIMIT 1");
		    $count = mysqli_num_rows($query_id);
		    if($count <> 0) {
		    $data_id = mysqli_fetch_assoc($query_id);
		        $codigo = $id;
		        // $codigo = $id+1;
		        // $codigo = $data_id['number_ticket']+1;
		    } else {
		        $codigo = $id;
		        // $codigo = 100;
		    }
		    $buat_id = str_pad($codigo, 3, "0", STR_PAD_LEFT);  
			//actualizo el numero de ticket: Incidente ó Requerimiento
			if($idType==1){
				//incidencia
					$codigo = "INC$id";
					// $codigo = "INC$buat_id";
				    $number=mysqli_query($con, "select * from tickets where number_ticket!=''");
				    if (mysqli_num_rows($number)>0) {
				        $number_ticket=$codigo;
				    }else{
				        $number_ticket="INC".$id;
				        // $number_ticket="INC100";
				    }

				$number_ticket_final=$number_ticket;
			}else{
				//requerimiento
					$codigo = "REQ$id";
					// $codigo = "REQ$buat_id";
				    $number=mysqli_query($con, "select * from tickets where number_ticket!=''");
				    if (mysqli_num_rows($number)>0) {
				        $number_ticket=$codigo;
				    }else{
				        $number_ticket="REQ".$id;
				        // $number_ticket="REQ100";
				    }

				$number_ticket_final=$number_ticket;
			}
			// fin nuevo modelo de numero de ticket


		if($update=mysqli_query($con, "update tickets set status_id=1,status_ticket=1,number_ticket='$number_ticket_final' where id='$id'")){

			//agrego una bitacora automatica
			$ticket_registrado=mysqli_query($con,"select * from tickets where id=$id");
			$rw=mysqli_fetch_array($ticket_registrado);
			$client_id=$rw['client_id'];
			$dateBitacora=$rw['created_at'];
		    $clientes=mysqli_query($con,"select * from user where id=$client_id");
		    $rw_cliente=mysqli_fetch_array($clientes);
		    if($rw_cliente['fullname']!=""){
		        $nombre_cliente=$rw_cliente['fullname'];
		    }else{
		        $nombre_cliente=$rw_cliente['name']." ".$rw_cliente['lastname'];
		    }
		    // $text="<b>Registrado por: </b>$nombre_cliente";
		    $text="Ticket registrado";

		    if(isset($_SESSION['user_id'])){
		    	$idUser=$_SESSION['user_id'];
		    }else if(isset($_SESSION['admin_id'])){
		    	$idUser=$_SESSION['admin_id'];
		    }

		    $created_at=date("Y-m-d H:i:s");
		    $sql_insert_bitacora=mysqli_query($con,"INSERT INTO log_bitacora (ticket_id,comment,created_at,dateBitacora,idUser,idStatus) VALUES ($id,\"$text\",\"$created_at\",\"$created_at\",$idUser,1)");
		    //fin agregar bitacora

		    /*
				envio de email
		    */
				$areas=mysqli_query($con,"SELECT user.name,user.lastname,user.username,user.email from area inner join user on area.supervisor_id=user.id where area.id=$area");
				$areas_rw=mysqli_fetch_array($areas);
				$fullname_supervisor=$areas_rw['name']." ".$areas_rw['lastname'];
				$email_supervisor=$areas_rw['email'];

				// echo $email_supervisor;
				//usuario o cliente que registro:
				$clientes_ticket=mysqli_query($con,"SELECT user.name,user.lastname, user.phone,user.business,user.fullname,user.email,user.ruc from tickets inner join user on tickets.client_id=user.id where tickets.id=$id");
				$clientes_rw=mysqli_fetch_array($clientes_ticket);
				if ($clientes_rw['fullname']) {
					$fullname_client=$clientes_rw['fullname'];
				}else{
					$fullname_client=$clientes_rw['name']." ".$clientes_rw['lastname'];
				}
				// echo $fullname_client;


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
		
		
		new_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_supervisor,$fullname_client,$number_ticket_final,$asunt,$comment,$id);

			/*
				Fin de envio de emails
			*/

			$aviso="Bien hecho!";
			$msj="Ticket Creado.";
			$classM="alert alert-success";
			$times="&times;";	
		}else{
			$aviso="Aviso!";
			$msj="Error al finalizar el ticket ";
			$classM="alert alert-danger";
			$times="&times;";					
		}
	}

	if (isset($_REQUEST["id"])){
	?>
			<div class="<?php echo $classM;?>">
				<button type="button" class="close" data-dismiss="alert"><?php echo $times;?></button>
				<strong><?php echo $aviso?> </strong>
				<?php echo $msj;?>
			</div>	
	<?php
		}
}
?>		