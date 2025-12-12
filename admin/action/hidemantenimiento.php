<?php    
	session_start();
    include "../config/config.php";
    if (!isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 1) {
        header("location: index.php");
        exit;
        }

	if (isset($_GET['id']) && !empty($_GET['id'])){
        $id=$_GET["id"];
    } else {
        header("Location: ../?view=mantenimiento");  
    }
	$id=intval($_GET['id']);
    $year=intval($_GET['year']);
    

	$sql=mysqli_query($con, "UPDATE `mantenimiento` SET `ocultar` = $year WHERE `mantenimiento`.`id` = $id");
	if ($sql) {
		header("location: ../?view=mantenimiento&year=$year");
	}else{
		header("location: ../?view=mantenimiento&year=$year");
	}