<?php
	include('../config/config.php');
	$id_area=intval($_REQUEST['area_id']);
	$cat = mysqli_query($con, "select * from tipos_requerimientos WHERE area_id = '$id_area'");
	if(mysqli_num_rows($cat)>0){
		// echo '<option selected="selected" disabled="disabled">Elija su Categoría</option>';
		while($row = mysqli_fetch_array($cat)){
			echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		}
	}
?>