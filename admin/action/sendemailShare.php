<?php
	#compruebo si esta logueado
	session_start();
	if (!isset($_SESSION['admin_id'])){
		header("location: ../");//Redirecciona 
		exit;
	}
	include('../config/config.php');
	include "../../lib/send.php";//Contiene funcion que conecta a la base de datos
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		if (isset($_REQUEST["opt"])){
			$opt = $_REQUEST["opt"];


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

	
			if ($opt == 1) {
				//enviar email opc1:
				if(SendMessageUserAll($email_user,$email_password,$from_name,$Host,$Port,$url_base,$con)){
					echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Aviso!</strong> Invitación Enviada Correctamente a todos los usuarios.<div>";
				}else{
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Aviso!</strong> Hubo un error al enviar la invitación<div>";
				}
				// echo SendMessageUserAll($email_user,$email_password,$from_name,$Host,$Port,$url_base,$con);
			}else if($opt == 2){
				//enviar email opc2:
				if (isset($_REQUEST["emails"])){
					$emails = $_REQUEST["emails"];
					if(SendMessageUserSelected($email_user,$email_password,$from_name,$Host,$Port,$url_base, $emails)){
						echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Aviso!</strong> Invitación Enviada Correctamente a los usuarios seleccionados.<div>";
					}else{
						echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Aviso!</strong> Hubo un error al enviar la invitación a los usuarios<div>";
					}
					// echo SendMessageUserSelected($email_user,$email_password,$from_name,$Host,$Port,$url_base, $emails);
				}
				
			}
		}
	}