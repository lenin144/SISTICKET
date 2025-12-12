<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
	include "../admin/config/config.php";
	session_start();

	if (isset($_SESSION['user_id'])) {
		//session_destroy();
		$update = mysqli_query($con,"UPDATE `user` SET `last_logout` = NOW() WHERE `user`.`id` = ".$_SESSION['user_id']);

		unset($_SESSION['sidebar']);
		unset($_SESSION['user_id']);
		//header("location: index.php"); //estemos donde estemos nos redirije al index
		$_SESSION['data']=array('alert'=>'success','notice'=>'¡Bien hecho!', 'msg'=>'Has sido desconectado.');
	}
	header("location: ../"); //estemos donde estemos nos redirije al index
?>