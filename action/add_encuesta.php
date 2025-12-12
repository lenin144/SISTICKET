<?php
include "../admin/config/config.php";
$id = $_POST['id'];
$valor = $_POST['valor'];

$save = mysqli_query($con, "UPDATE `tickets` SET `calificacion` = ".$valor." WHERE `tickets`.`id` = $id");
if($save){
    echo "success";
}else{
    echo "error";
}
