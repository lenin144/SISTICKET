<?php
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	/*Datos de conexion a la base de datos*/
	define('DB_HOST', 'localhost');//DB_HOST:  generalmente suele ser "127.0.0.1"
	define('DB_USER', 'root');//Usuario de tu base de datos
	define('DB_PASS', '');//Contraseña del usuario de la base de datos
	define('DB_NAME', 'ticket');//Nombre de la base de datos

	/*Datos de conexion a la base de datos
	define('DB_HOST', '188.165.215.109');//DB_HOST:  generalmente suele ser "127.0.0.1"
	define('DB_USER', 'Admin');//Usuario de tu base de datos
	define('DB_PASS', 'akqwE6eW2');//Contraseña del usuario de la base de datos
	define('DB_NAME', 'nextservice');//Nombre de la base de datos
	*/
	
	$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
    mysqli_query($con,"SET NAMES 'utf8'");

    //configuracion de zona horaria:
    date_default_timezone_set("America/Lima");
    header("Content-Type: text/html;charset=utf-8");
?>