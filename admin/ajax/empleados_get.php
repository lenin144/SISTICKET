<?php
	include("../config/config.php");
	$id_area=intval($_REQUEST['id_area']);
	$usuarios_areas = mysqli_query($con,"select * from usuarios_areas INNER join user on usuarios_areas.user_id=user.id where usuarios_areas.area_id='$id_area'");
	echo '<option value = "">Selecciona un empleado  </option>';
	while($row = mysqli_fetch_array($usuarios_areas)){
	?>	
		<option value="<?php echo $row['user_id'] ?>"><?php echo utf8_encode($row['name']." ".$row['lastname']) ?></option>
	<?php 	
	}
?>