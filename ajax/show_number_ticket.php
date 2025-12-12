<?php
	#compruebo si esta logueado
	session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id'])){
	/* Connect To Database*/
	require_once ("../admin/config/config.php"); 
	if (isset($_REQUEST["id"])){//codigo para eliminar 
		$id=$_REQUEST["id"];
		$id=intval($id);
		if($tickets=mysqli_query($con, "select number_ticket from tickets where id='$id'")){
			$rw=mysqli_fetch_array($tickets);
			echo $rw['number_ticket'];
		}
	}
}
?>		