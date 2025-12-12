<?php

#compruebo si esta logueado
session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id']) ){

	$id= intval($_REQUEST['id']);
	/* Connect To Database*/
	require_once ("../admin/config/config.php");

	if (isset($_POST['value'])){
		
		$campo=intval($_POST['campo']);
		if ($campo==1){
			$value=intval($_POST['value']);
			$condicion="area='$value'";
		} else if ($campo==2){

			$value=intval($_POST['value']);
			$condicion="tipo_requerimiento='$value'";

			//veo que categoria es para verificar: impacto, urgencia, prioridad
			$categorias=mysqli_query($con,"select * from tipos_requerimientos where id=$value");
			$rw_cat=mysqli_fetch_array($categorias);
			$idType=$rw_cat['idType'];
			$idImpact=$rw_cat['idImpact'];
			$idUrgency=$rw_cat['idUrgency'];
			$idPriority=$rw_cat['idPriority'];
			//actualizo el ticket con los valores de la categoria escogida: impacto, urgencia, prioridad
			$condicion.=", idImpact='$idImpact'";
			$condicion.=", idUrgency='$idUrgency'";
			$condicion.=", idPriority='$idPriority'";

		} else if ($campo==3){
			$value=mysqli_real_escape_string($con,(strip_tags($_REQUEST['value'], ENT_QUOTES)));
			$condicion="asunt='$value'";
		} else if ($campo==4){
			$value=mysqli_real_escape_string($con,(strip_tags($_REQUEST['value'], ENT_QUOTES)));
			$condicion="comment='$value'";
		} else if ($campo==5){
			$value=mysqli_real_escape_string($con,(strip_tags($_REQUEST['value'], ENT_QUOTES)));
			$condicion="client_id='$value'";
		}
		$update_sale=mysqli_query($con,"update tickets set  $condicion where id='$id'");
		// echo "update tickets set  $condicion where id='$id'";
	}

}else{
	header("location: ../../");//Redirecciona 
	exit;

}