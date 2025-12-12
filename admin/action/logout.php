<?php
session_start();
if (isset($_SESSION['admin_id'])) {
		//session_destroy();
		unset($_SESSION['sidebar']);
		unset($_SESSION['admin_id']);
		header('Location: ../../index.php'); //estemos donde estemos nos redirije al index
		$_SESSION['data']=array('alert'=>'success','notice'=>'¡Bien hecho!', 'msg'=>'Has sido desconectado.');
	}
header("location: ../../"); //estemos donde estemos nos redirije al index
?>