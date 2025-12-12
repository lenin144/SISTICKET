<?php
include('../config/config.php');
// $id = $_POST['id'];
	$prov = mysqli_query($con, "select * from urgency");
	if(mysqli_num_rows($prov)>0){
	echo '<option selected="selected" disabled="disabled">Elija su Urgencia</option>';
	while($prov2 = mysqli_fetch_array($prov)){
		echo '<option value="'.$prov2['idUrgency'].'">'.$prov2['Description'].'</option>';
	}
}
?>