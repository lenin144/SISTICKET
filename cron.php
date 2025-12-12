<?php
include "admin/config/config.php";
include_once("lib/class.phpmailer.php");
include_once("lib/class.smtp.php");

// Verifica clave 
$clave = isset($_GET['clave']) ? $_GET['clave'] : null;
if ($clave != '123456') {
    die;
}

// Consuta usuarios
$tareas = mysqli_query($con, "SELECT m.id, u.name, u.lastname, m.oficina, m.tarea, m.manual, m.tiempo, mf.nombre as 'frecuencia', m.inicio, u.email FROM `mantenimiento` as m INNER JOIN user as u on u.id = m.empleado INNER JOIN mantenimiento_frecuencia as mf on mf.id = m.frecuencia WHERE DATE(m.inicio) = CURRENT_DATE()");

// Consulta configuraci��n de correo
//correo electronico smtp
$emails_smtp=mysqli_query($con,"select * from configuration where name='email_smtp'");
$rw_emails_smtp=mysqli_fetch_array($emails_smtp);
$email_user=$rw_emails_smtp['val'];

//contrase�0�9a smtp
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

if ($tareas->num_rows < 1) {
    die;
} else {
    // Envia correos por tarea
    foreach ($tareas as $item) {
        enviarCorreo($email_user,$email_password,$from_name,$Host,$Port,$url_base, $item);
    }
}

function enviarCorreo($email_user,$email_password,$from_name,$Host,$Port,$url_base, $item){
	$the_subject = "Plan de mantenimiento preventivo 2022";
    echo $Host;
    echo $Port;
	/*OPCIONAL*/
	$address_to = $item['email'];
	$phpmailer = new PHPMailer();
	// ---------- datos de la cuenta-------------------------------
	$phpmailer->Username = $email_user;
	$phpmailer->Password = $email_password; 
	//-----------------------------------------------------------------------
	$phpmailer->SMTPDebug = 1;
	$phpmailer->Host = $Host; // GMail
	$phpmailer->Port = $Port;
	$phpmailer->IsSMTP(); // use SMTP
	$phpmailer->SMTPSecure = "ssl";
	$phpmailer->SMTPAuth = true;
	$phpmailer->setFrom($phpmailer->Username,$from_name);
	$phpmailer->AddAddress($address_to); // recipients email
	$phpmailer->Subject = $the_subject;	
	$phpmailer->Body ="Estimado(a) ".$item['name']." ".$item['lastname']." como parte del mantenimiento preventivo de las computadoras se debe: <br>".$item['tarea'].", el tiempo que se tomara es de ".$item['tiempo']." minutos. Esta tarea tiene una frecuencia ".$item['frecuencia']."<br>En caso tenga algun inconveniente, con gusto lo atendere.<br>"."<a href='".$item['manual']."' target='_blank'>Manual de la tarea</a><br><br>
	Saludos;<br><br>Atte."."<br>".'<img src="https://ticket.calidraperu.com.pe/firma_calidraperu.png" width="588" height="137" >';
	
	$phpmailer->IsHTML(true);
	$phpmailer->Send();
}