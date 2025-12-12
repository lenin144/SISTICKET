<?php
	ob_start();
	session_start();


	if (isset($_GET['sidebar'])) {
		if ($_GET['sidebar']=="hidden") {
			$_SESSION["sidebar"] = 1;
		}
	}

	$view = isset($_GET['view']) ? $_GET['view'] : 'login';
	
	//require('admin/config/config.php');

	//cargo la vista
	if (file_exists('view/'.$view.'-view.php')) {
		include("view/".$view."-view.php");
	}else{
		include("view/error-view.php");
		//echo "No existe";
	}
