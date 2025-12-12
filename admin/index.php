<?php
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	ob_start();
	session_start();

	$view = isset($_GET['view']) ? $_GET['view'] : 'login';


	//cargo la vista
	if (file_exists('view/'.$view.'-view.php')) {
		include("view/".$view."-view.php");
	}else{
		include("view/error-view.php");
		//echo "No existe";
	}
