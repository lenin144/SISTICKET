<?php
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
if(isset($_GET["id"])){
	include "../config/config.php";
	$id = intval($_GET["id"]);
	$file=mysqli_query($con, "select * from documentticket where iddocumentTicket=$id");
	while ($row=mysqli_fetch_array($file)) {
		$urlDocument=$row['urlDocument'];
		$name=$row['name'];
	}

	if($urlDocument!=null){
		$fullpath = "../../".$urlDocument;
		header("Content-Disposition: attachment; filename=$name");
		readfile($fullpath);
	}
}



?>