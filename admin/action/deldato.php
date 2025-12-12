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
        header("Location: ../?view=datos");  
    }
	$id=intval($_GET['id']);

	$sql=mysqli_query($con, "delete from datos where id=$id");
	if ($sql) {
		//echo "eliminado correctamente";
		header("location: ../?view=datos&deletesuccess");
	}else{
		//echo "hubo un error al eliminar";
		header("location: ../?view=datos&errordelete");
	}