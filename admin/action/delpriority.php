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
        header("Location: ../?view=prioridades");  
    }
	$id=intval($_GET['id']);

	$sql=mysqli_query($con, "delete from prioritymatrix where idMatrix=$id");
	if ($sql) {
		//echo "eliminado correctamente";
		header("location: ../?view=prioridades&deletesuccess");
	}else{
		//echo "hubo un error al eliminar";
		header("location: ../?view=prioridades&errordelete");
	}