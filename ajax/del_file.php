<?php

	#compruebo si esta logueado
	session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id'])){
			
	/* Connect To Database*/
	require_once ("../admin/config/config.php"); 
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	$id=intval($id);

	
		if($update=mysqli_query($con, "delete from documentticket where iddocumentTicket='$id'")){
			$aviso="Bien hecho!";
			$msj="Archivo Eliminado!.";
			$classM="alert alert-success";
			$times="&times;";	
		}else{
			$aviso="Aviso!";
			$msj="Error al eliminar el archivo ";
			$classM="alert alert-danger";
			$times="&times;";					
		}
	}

	if (isset($_REQUEST["id"])){
	?>
			<div class="<?php echo $classM;?>">
				<button type="button" class="close" data-dismiss="alert"><?php echo $times;?></button>
				<strong><?php echo $aviso?> </strong>
				<?php echo $msj;?>
			</div>	
	<?php
		}
}
?>		