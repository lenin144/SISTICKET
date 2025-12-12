<?php

	session_start();

	if (empty($_POST['mod_id'])) {

           $errors[] = "ID Ticket vacío";

        }else if (empty($_POST['comentario'])) {

           $errors[] = "Solución vacío";

        } else if (

			!empty($_POST['comentario'])

		){



		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		require_once ("../../lib/send.php"); 

		include_once "../../lib/Helper/CryptoHelper.php";





		$id=intval($_POST['mod_id']);

		$idCauseSolution=intval($_POST['idCauseSolution']);

		$file=mysqli_real_escape_string($con,(strip_tags($_REQUEST["file"],ENT_QUOTES)));

		$date=mysqli_real_escape_string($con,(strip_tags($_POST["date"],ENT_QUOTES)));

		$time=mysqli_real_escape_string($con,(strip_tags($_POST["time"],ENT_QUOTES)));

		$date_added=$date." ".$time;

		$comentario=mysqli_real_escape_string($con,(strip_tags($_POST["comentario"],ENT_QUOTES)));

		$created_at=date("Y-m-d H:i:s");





		$causesolution=mysqli_query($con,"SELECT Description from causesolution where idCauseSolution=$idCauseSolution");

			$rwSolution=mysqli_fetch_array($causesolution);

			$CauseSolution=$rwSolution['Description'];



		//agrego una bitacora automatica

	    // $text="<b>Ticket Finalizado</b>: $comentario";

	    $text="$CauseSolution. <br />$comentario";

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

		    $tipo_requerimiento=$rw_ticket['tipo_requerimiento'];

		    $client_id=$rw_ticket['client_id'];

		    $asigned_id=$rw_ticket['asigned_id'];

	    //fin

	    $sql_insert_bitacora=mysqli_query($con,"INSERT INTO log_bitacora (ticket_id,comment,created_at,dateBitacora	,idUser,idStatus) VALUES ($id,\"$text\",\"$created_at\",\"$date_added\",$idUser,4)");





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

            	if ($query_new_insert){ 

            		// $messages[] = "success";

				} else {

                	$errors[] = "Lo sentimos, la carga del archivo falló. Intente nuevamente. ";

            	}

			}

        }

    }

}else{

	// $errors[] = "sin archivos ";

}





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





			//consulta para ver si la categoria del ticket tiene encuesta y si esta en el rango

			$encuestorCheck = mysqli_query($con,"SELECT * FROM surveycategory WHERE (

				(ExpireDateStar <= NOW() AND ExpireDateEnd >= NOW())

		        	OR ExpireDateEnd BETWEEN NOW() AND NOW()

		        	OR ExpireDateEnd BETWEEN NOW() AND NOW()

		        )

		        and IdCategory=$tipo_requerimiento

		        and Active=1");

			$idticket_token =urlencode(CryptoHelper::encrypt($id));

			if (mysqli_num_rows($encuestorCheck)>0) {

				//antes de enviar el correo copio la encuesta: preguntas y sus respuestas de cada pregunta

				$rwEncuestorCheck = mysqli_fetch_array($encuestorCheck);

				$idSurvey=$rwEncuestorCheck['idSurvey'];



				//consulta para los datos de la encuesta

				$surveyQuery=mysqli_query($con,"select * from survey where idSurvey=$idSurvey");

				$surveyRW=mysqli_fetch_array($surveyQuery);

				$Title=$surveyRW['Title'];

				$Description=$surveyRW['Description'];



				//inserto o copia la encuesta, para la encuesta del ticket

				mysqli_query($con,"INSERT into surveyticket (idSurvey,IdTicket,IdUserClient,IdUserAgent,Title,Description,DateSend) values (\"$idSurvey\",\"$id\",\"$client_id\",\"$asigned_id\",\"$Title\",\"$Description\",NOW())");





				//veo el ultimo id de la tabla surveyticket

				$last=mysqli_query($con,"select LAST_INSERT_ID(idSurveyTicket) as last from surveyticket order by idSurveyTicket desc limit 0,1 ");

				$rw=mysqli_fetch_array($last);

				$idSurveyTicketLast=$rw['last'];



				//leo e inserto las preguntas:

				$questosSurvey = mysqli_query($con,"select * from surveyquestions where idSurvey=$idSurvey");

				foreach ($questosSurvey as $question) {

					$descriptionQuestion = $question['Description'];

					$idQuestion = $question['idQuestion'];

					//inserto todas las preguntas de la encuesta

					mysqli_query($con,"INSERT into surveyticketquestion (Description,idSurvey,idTicket) values (\"$descriptionQuestion\",\"$idSurvey\",\"$id\") ");

					





					//veo el ultimo id de la tabla surveyticketquestion

					$last=mysqli_query($con,"select LAST_INSERT_ID(idQuestion) as last from surveyticketquestion order by idQuestion desc limit 0,1 ");

					$rw=mysqli_fetch_array($last);

					$idQuestionLast=$rw['last'];



						//leo e inserto las respuestas de las preguntas:

						$responseQuery = mysqli_query($con,"select * from surveyresponse where idQuestion=$idQuestion");

						foreach ($responseQuery as $response) {

							$descriptionResponse = $response['Description'];

							$porcentajeResponse = $response['SatisfactionPorcentage'];

							

							//inserto todas las respuestas de las preguntas

							mysqli_query($con,"INSERT into surveyticketresponse (idQuestion,Description,Porcentage) values (\"$idQuestionLast\",\"$descriptionResponse\",\"$porcentajeResponse\") ");

						}

				}



				finish_ticket_Encuestor($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_client,$fullname_agente,$number_ticket,$comentario,$id,$idticket_token,$idSurveyTicketLast);

				// echo "con encuesta";

			}else{

				finish_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_client,$fullname_agente,$number_ticket,$comentario,$id);

				// echo "sin encuesta";

			}

		/*

			Fin de envio de emails

		*/





		$sql="UPDATE tickets SET status_id=4, finalizado=\"$comentario\", date_atendid=\"$date_added\",date_finish=\"$created_at\",idCauseSolution=\"$idCauseSolution\", final=NOW()  WHERE id=$id";

		$query_update = mysqli_query($con,$sql);

			if ($query_update){

				$messages[] = "El ticket ah sido finalizado satisfactoriamente.";

				print("<script>window.location='./?view=finalizados'</script>");

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