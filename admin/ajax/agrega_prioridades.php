<?php
include('../config/config.php');
$id = intval($_POST['id']);
$impact = intval($_POST['impact']);
$dist = mysqli_query($con,"SELECT * FROM prioritymatrix WHERE idImpact = '$impact' and idUrgency = '$id'");
// echo "SELECT * FROM prioritymatrix WHERE idImpact = '$impact' and idUrgency = '$id'";
if(mysqli_num_rows($dist)>0){
	// echo '<option selected="selected" disabled="disabled">Elija su Distrito</option>';
	// while($dist2 = mysqli_fetch_array($dist)){
		$dist2 = mysqli_fetch_array($dist);
		$idPriority=$dist2['idPriority'];
		if($idPriority>0){
			$sql = mysqli_query($con,"select * from priority where idPriority=$idPriority");
			$rows=mysqli_fetch_array($sql);
			echo '<option selected="selected" value="'.$rows['idPriority'].'">'.$rows['Description'].'</option>';
		}else{
			echo '<option value="0" selected="selected" disabled="disabled">Aun no hay prioridad</option>';
		}
	// }
}
?>