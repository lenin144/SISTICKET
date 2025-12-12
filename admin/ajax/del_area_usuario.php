<?php
#compruebo si esta logueado
session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id']) ){

	$id= intval($_REQUEST['id']);
	$idusuario= intval($_REQUEST['idusuario']);
	/* Connect To Database*/
	require_once ("../config/config.php");

	if (isset($_POST['id'])){
		$sql=mysqli_query($con,"select * from area where id=$id and supervisor_id=$idusuario");
		if (mysqli_num_rows($sql)>0) {
			echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Esta area no se puede eliminar ya que es supervisor del area, por favor vaya a: <br> <strong>Areas -> Editar</strong> y actualize el supervisor!
			</div>';
			echo "<script>setInterval(function(){ location.reload(true); }, 2000);</script>";
		}else{
			$delete_areas_user=mysqli_query($con,"delete from usuarios_areas where user_id=$idusuario and area_id=$id");
			if ($delete_areas_user) {
				echo '<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Aviso!</strong> Eliminado del area con exitó
			</div>';
			}else{
				echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Hubo un error al eliminar el area
			</div>';
			}
			echo false;

		}
		/*echo "area: ".$id;
		echo "usuario: ".$idusuario;*/
	}

}else{
	header("location: ../../");//Redirecciona 
	exit;

}