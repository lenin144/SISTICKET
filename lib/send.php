<?php

include_once("class.phpmailer.php");
include_once("class.smtp.php");
function register_client($email_user,$email_password,$from_name,$Host,$Port,$url_base,$client_email,$password){
	$the_subject = "Registro!";
	$address_to = $client_email;
	$phpmailer = new PHPMailer();
	// ---------- datos de la cuenta -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; 
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email
	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
	    <div style='width: 100%;'> 
			<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
		        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
		                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Tus datos de acceso: </p>
		            <br>
		                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
		                    Correo electr&oacute;nico: <b>$client_email</b>
		                </div>
		                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
		                    Contrase&ntilde;a: <b>$password</b>
		                </div>
		                <br>
		                <div class='row'>
		                    <div class='col-xs-12'>
		                    <a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Ingresar</a>
		                    </div><!-- /.col -->
		                </div>
		        </div>
		    </div>
		</div>
	</body>";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();



	$msj = "<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
	    <div style='width: 100%;'> 
			<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
		        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
		                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Tus datos de acceso: </p>
		            <br>
		                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
		                    Correo electr&oacute;nico: <b>$client_email</b>
		                </div>
		                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
		                    Contrase&ntilde;a: <b>$password</b>
		                </div>
		                <br>
		                <div class='row'>
		                    <div class='col-xs-12'>
		                    <a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Ingresar</a>
		                    </div><!-- /.col -->
		                </div>
		        </div>
		    </div>
		</div>
	</body>";

	$mail_to_send_to = $client_email;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to, "Registro!", $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}
}



#Nuevo ticket:
function new_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_supervisor,$fullname_client,$number_ticket_final,$asunt,$comment,$id_ticket){

	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;

	$the_subject = "Registrado ".$number_ticket_final;
	$address_to = $email_supervisor;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto; color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/1.png alt='Registrado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El usuario: <b>$fullname_client</b> ha registrado el ticket <b>$number_ticket_final</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    Asunto: $asunt
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                   Descripci&oacute;n: ".utf8_decode($comment)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: left;'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();



	$msj="<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto; color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/1.png alt='Registrado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El usuario: <b>$fullname_client</b> ha registrado el ticket <b>$number_ticket_final</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    Asunto: $asunt
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                   Descripci&oacute;n: ".utf8_decode($comment)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: left;'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>";


	$mail_to_send_to = $email_user;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}

}
















#Asignar ticket:
function asigne_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_agente,$fullname_supervisor,$ticket_number,$asunt,$comment,$id_ticket,$nombre_categoria,$nombre_area,$fecha,$name_priority){

	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;

	$the_subject = "Asignado ".$ticket_number;
	$address_to = $email_agente;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/2.png alt='Asignado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    El Supervisor: <b>$fullname_supervisor</b> le asigno el ticket <b>$ticket_number</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Asunto: $asunt 
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Fecha Registro: $fecha
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left;'>
	                    <strong>Prioridad: $name_priority</strong>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Descripci&oacute;n: ".utf8_decode($comment)."
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Categoria: $nombre_categoria
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    &Aacute;rea Asignada: $nombre_area
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Favor de dar seguimiento a la brevedad posible.
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();



	$msj ="
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/2.png alt='Asignado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    El Supervisor: <b>$fullname_supervisor</b> le asigno el ticket <b>$ticket_number</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Asunto: $asunt 
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Fecha Registro: $fecha
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left;'>
	                    <strong>Prioridad: $name_priority</strong>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Descripci&oacute;n: ".utf8_decode($comment)."
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Categoria: $nombre_categoria
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    &Aacute;rea Asignada: $nombre_area
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Favor de dar seguimiento a la brevedad posible.
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";


	$mail_to_send_to = $email_agente;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}

}

















#bitacora ticket:
function add_proccess($email_user,$email_password,$from_name,$Host,$Port,$url_base,   $email_client,$fullname_agente,$number_ticket,$incidencia_txt,$id_ticket){

	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;

	$the_subject = "Proceso ".$number_ticket;
	$address_to = $email_client;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/3.png alt='Proceso'>
    	
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El administador TI: <b>$fullname_agente</b> ha registrado una bit&aacute;cora de proceso en el ticket <b>$number_ticket</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    Descripci&oacute;n: ".utf8_decode($incidencia_txt)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();
	/*<img src='../images/email/3.png' alt='Proceso'>*/
	// echo "<img src=",$url_base,"images/email/3.png alt='Proceso'>";



	$msj = "
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/3.png alt='Proceso'>
    	
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El administador TI: <b>$fullname_agente</b> ha registrado una bit&aacute;cora de proceso en el ticket <b>$number_ticket</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    Descripci&oacute;n: ".utf8_decode($incidencia_txt)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$mail_to_send_to = $email_client;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}
}














#cancelar ticket:
function add_cancel($email_user,$email_password,$from_name,$Host,$Port,$url_base,   $email_client,$mtCancelacion,$number_ticket,$descripcion_txt,$id_ticket){

	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;

	$the_subject = "Cancelado ".$number_ticket;
	$address_to = $email_client;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>

    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El ticket <b>$number_ticket</b> ha sido cancelado
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	<div><b>Motivo de Cancelaci&oacute;n</b></div>
	                    ".utf8_decode($mtCancelacion)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    ".utf8_decode($descripcion_txt)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$phpmailer->IsHTML(true);
	$phpmailer->Send();



	$msj = "
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>

    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El ticket <b>$number_ticket</b> ha sido cancelado
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	<div><b>Motivo de Cancelaci&oacute;n</b></div>
	                    ".utf8_decode($mtCancelacion)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    ".utf8_decode($descripcion_txt)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>";

	$mail_to_send_to = $email_client;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}
}







#Finalizar ticket:
function finish_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,   $email_client,$fullname_agente,$number_ticket,$comentario,$id_ticket){
	$comentarios=utf8_decode($comentario);
	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;
    $ver_reporte_url=$url_base."admin/?view=pdf_reporte&id=".$id_ticket;

	$the_subject = "Finalizado ".$number_ticket;
	$address_to = $email_client;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="

<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/4.png alt='Finalizado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El administador TI: <b>$fullname_agente</b> ha finalizado el ticket <b>$number_ticket</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Soluci&oacute;n: ".utf8_decode($comentarios)."
	                </div>
	                <br>
					<div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
						<a target='_blank' href=\"$ver_reporte_url\">Ver Reporte</a>
					</div>
					<div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
						<a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();



	$msj = "

<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/4.png alt='Finalizado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El administador TI: <b>$fullname_agente</b> ha finalizado el ticket <b>$number_ticket</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Soluci&oacute;n: ".utf8_decode($comentarios)."
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>


";

	$mail_to_send_to = $email_client;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}

	// Envia Correo al Empleado
}











#Finalizar ticket: este email va con encuesta
function finish_ticket_Encuestor($email_user,$email_password,$from_name,$Host,$Port,$url_base,   $email_client,$fullname_agente,$number_ticket,$comentario,$id_ticket,$idticket_token,$idsurvey){
	$comentarios=utf8_decode($comentario);
	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;

	$encuestorURL=$url_base."encuestor?token=".$idticket_token."&c=".$idsurvey."&ui=".$idticket_token;

	$the_subject = "Finalizado ".$number_ticket;
	$address_to = $email_client;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="

<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/4.png alt='Finalizado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El administador TI: <b>$fullname_agente</b> ha finalizado el ticket <b>$number_ticket</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Soluci&oacute;n: ".utf8_decode($comentarios)."
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Te invitamos a contestar una encuesta de evaluación en la siguiente liga : <br>
	                	<a target='_blank' href=\"$ver_ticket_url\">Encuesta de evaluación </a>
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    <a target='_blank' href=\"$encuestorURL\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();


	$msj = "

<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/4.png alt='Finalizado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    El administador TI: <b>$fullname_agente</b> ha finalizado el ticket <b>$number_ticket</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Soluci&oacute;n: ".utf8_decode($comentarios)."
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Te invitamos a contestar una encuesta de evaluación en la siguiente liga : <br>
	                	<a target='_blank' href=\"$ver_ticket_url\">Encuesta de evaluación </a>
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    <a target='_blank' href=\"$encuestorURL\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";

	$mail_to_send_to = $email_client;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}

}







#ReAsignar ticket:
function reasigne_ticket($email_user,$email_password,$from_name,$Host,$Port,$url_base,  $email_agente,$fullname,$ticket_number,$asunt,$comment,$id_ticket,$nombre_categoria,$nombre_area,$fecha,$name_priority){

	$ver_ticket_url=$url_base."admin/?view=ticket_detail&id=".$id_ticket;

	$the_subject = "Reasignado ".$ticket_number;
	$address_to = $email_agente;

	$phpmailer = new PHPMailer();

	// ---------- datos de la cuenta de Gmail -------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email

	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/2.png alt='Asignado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    El administador TI: <b>$fullname</b> le reasigno el ticket <b>$ticket_number</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Asunto: $asunt 
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Fecha Registro: $fecha
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left; color: red;'>
	                    Prioridad: $name_priority
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Descripci&oacute;n: ".utf8_decode($comment)."
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Categoria: $nombre_categoria
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    &Aacute;rea Asignada: $nombre_area
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Favor de dar seguimiento a la brevedad posible.
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";
	$phpmailer->IsHTML(true);

	$phpmailer->Send();




	$msj = "
<body style='background: #F2F2F2; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%; text-align:center;'>
    	<img style='width:60%; height:120px;' src=$url_base"."images/email/2.png alt='Asignado'>
    </div>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: left;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    El administador TI: <b>$fullname</b> le reasigno el ticket <b>$ticket_number</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Asunto: $asunt 
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Fecha Registro: $fecha
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left; color: red;'>
	                    Prioridad: $name_priority
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Descripci&oacute;n: ".utf8_decode($comment)."
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    Categoria: $nombre_categoria
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative;text-align:left'>
	                    &Aacute;rea Asignada: $nombre_area
	                </div>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                	Favor de dar seguimiento a la brevedad posible.
	                </div>
	                <br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align:left'>
	                    <a target='_blank' href=\"$ver_ticket_url\">Ver Ticket</a>
	                </div>

	                <br><br><br><br>
	                <div style='margin-bottom: 15px; margin-left:10px; font-size:17px;position: relative; text-align: center;'>
	                    <a target='_blank' href=\"$url_base\">nextservice.inteek.com.mx</a>
	                </div>
	        </div>
	    </div>
	</div>
</body>
";


	$mail_to_send_to = $email_agente;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}

}













function update_client($email_user,$email_password,$from_name,$Host,$Port,$url_base,$client_email,$password){
	$the_subject = "Actualizacion de datos!";
	$address_to = $client_email;
	$phpmailer = new PHPMailer();
	// ---------- datos de la cuenta-------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email
	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Tus datos de acceso: </p>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Correo electr&oacute;nico: <b>$client_email</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Contrase&ntilde;a: <b>$password</b>
	                </div>
	                <br>
	                <div class='row'>
	                    <div class='col-xs-12'>
	                    <a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Ingresar</a>
	                    </div><!-- /.col -->
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$phpmailer->IsHTML(true);
	$phpmailer->Send();


	$msj = "<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Tus datos de acceso: </p>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Correo electr&oacute;nico: <b>$client_email</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Contrase&ntilde;a: <b>$password</b>
	                </div>
	                <br>
	                <div class='row'>
	                    <div class='col-xs-12'>
	                    <a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Ingresar</a>
	                    </div><!-- /.col -->
	                </div>
	        </div>
	    </div>
	</div>
</body>";

	$mail_to_send_to = $client_email;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}
}





/*Registro y actualización de usuarios*/
function register_user($email_user,$email_password,$from_name,$Host,$Port,$url_base,$user_email,$username,$password){
	$the_subject = "Registro!";
	$address_to = $user_email;
	$phpmailer = new PHPMailer();
	// ---------- datos de la cuenta-------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email
	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Tus datos de acceso: </p>
	            <br>

	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Correo electr&oacute;nico: <b>$user_email</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Usuario: <b>$username</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Contrase&ntilde;a: <b>$password</b>
	                </div>

	                <br>
	                <div class='row'>
	                    <div class='col-xs-12'>
							<a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Ingresar</a>

	                    </div><!-- /.col -->
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$phpmailer->IsHTML(true);
	$phpmailer->Send();



	$msj = "<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Tus datos de acceso: </p>
	            <br>

	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Correo electr&oacute;nico: <b>$user_email</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Usuario: <b>$username</b>
	                </div>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                    Contrase&ntilde;a: <b>$password</b>
	                </div>

	                <br>
	                <div class='row'>
	                    <div class='col-xs-12'>
							<a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Ingresar</a>

	                    </div><!-- /.col -->
	                </div>
	        </div>
	    </div>
	</div>
</body>";
	$mail_to_send_to = $user_email;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}
}





// Restablecimiento de contraseña
function reset_password($email_user,$email_password,$from_name,$Host,$Port,$url_base,   $email_user_reset,$id_code,$codes){
	$the_subject = "Recuperacion de datos!";

	/*OPCIONAL*/
		$str = "abcdefghijklmopqrstuvwxyz1234567890";
		$code = "";
		for ($i=0; $i < 6; $i++) { 
			$code .= $str[rand(0,strlen($str)-1)];
		}
		$code = $code;
	/*OPCIONAL*/
	$enlace = $url_base."?view=recover&ui=".$id_code."&c=".sha1(md5($code))."&e=".$codes;
	$address_to = $email_user_reset;
	$phpmailer = new PHPMailer();
	// ---------- datos de la cuenta-------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	// $phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = "ssl";
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email
	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Recuperaci&oacute;n de datos de acceso: </p>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                	<br>
	                    <p>Ahora puedes recuperar tu cuenta en el siguiente link:</p>
						<p><a href=".$enlace.">Recuperar mi cuenta:</a></p>
	                </div>
	                <br>
	                <!--<div class='row'>
	                    <div class='col-xs-12' style='text-align: center;'>
	                    <a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Iniciar Sesi&oacute;n</a>
	                    </div> /.col 
	                </div>-->
	        </div>
	    </div>
	</div>
</body>";
	$phpmailer->IsHTML(true);
	$phpmailer->Send();


	$msj = "<body style='background: #ecf0f5; margin: 0 auto;-webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: 400;overflow-x: hidden;overflow-y: auto;     color: #333;font-size: 15px;line-height: 1.42857;'>
    <div style='width:100%;'> 
		<div style='color:#ca4300' style='font-size: 35px;text-align: center;margin-bottom: 25px;font-weight: 300;'>
	        <div style='background: #fff none repeat scroll 0 0;border-radius: 3px;border-top: 3.5px solid #ca4300;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);color: #666;padding: 20px;'>
	                    <p style='margin: 0;text-align: center; padding: 0 20px 10px 20px;font-size: 17px; border-bottom: 1px solid #f4f4f4;'><i class='fa fa-user icon-title'></i> Recuperaci&oacute;n de datos de acceso: </p>
	            <br>
	                <div style='margin-bottom: 15px; margin-left:80px; font-size:17px;text-align: left;'>
	                	<br>
	                    <p>Ahora puedes recuperar tu cuenta en el siguiente link:</p>
						<p><a href=".$enlace.">Recuperar mi cuenta:</a></p>
	                </div>
	                <br>
	                <!--<div class='row'>
	                    <div class='col-xs-12' style='text-align: center;'>
	                    <a href=\"$url_base\" target='_blank' style='background-color: #367fa9;width: 100%;color: #fff;text-decoration: none; -webkit-appearance: button;cursor: pointer;text-align: center;white-space: nowrap;vertical-align: middle;font-weight: 400;margin-bottom: 0; height: 40px; font-size: 20px; padding: 10px 44px; border-radius: 5px;'>Iniciar Sesi&oacute;n</a>
	                    </div> /.col 
	                </div>-->
	        </div>
	    </div>
	</div>
</body>";


	$mail_to_send_to = $email_user_reset;
	$from_email = "soporte@km2tecnologia.com";
	$header = "From: soporte@km2tecnologia.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	$header.= "X-Priority: 1\r\n";                     
	$sendflag = "send";                      
	if ($sendflag == "send")
	{
	    // $email = "soporte@km2tecnologia.com";
	    $email = $email_user;
	    $mensaje = "<h1>hola</h1>";
	    $headers = "De: $from_email". "\ r \ n". "Responder a: $email". "\ r \ n";
	    $a = mail ($mail_to_send_to,$the_subject, $msj, $header);
	    /*if($a)
	    {
	        print ("Se envió un mensaje, puede enviar otro");
	    }else{
	        print ("El mensaje no se envió, verifique que haya cambiado los correos electrónicos en la parte inferior");
	    }*/
	}
}
