<?php
#compruebo si esta logueado
session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id']) ){

	$id= intval($_REQUEST['id']);
	$value= intval($_REQUEST['value']);
	// var_dump($_POST);
	/* Connect To Database*/
	require_once ("../config/config.php");
	if (isset($_POST['value'])){
		
		$update_priority=mysqli_query($con,"update prioritymatrix set idPriority=$value where idMatrix='$id'");
		if ($update_priority) {
			/*echo '<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>¡Bien hecho!</strong>
					Datos actualizados con exito.
			</div>';*/
		}else{
			/*echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					Hubo un error al actualizar los datos
			</div>';*/
		}
	}

}else{
	header("location: ../../");//Redirecciona 
	exit;

}
