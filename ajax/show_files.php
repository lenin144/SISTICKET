<?php
	#compruebo si esta logueado
	session_start();
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id'])){
	/* Connect To Database*/
	require_once ("../admin/config/config.php"); 
	if (isset($_REQUEST["id"])){//codigo para eliminar 
		$id=$_REQUEST["id"];
		$id=intval($id);
		$files=mysqli_query($con,"select * from documentticket where idTicket=$id");
    	if(mysqli_num_rows($files)>0){
    		foreach($files as $file){
?>    				
			<a href="#" title="<?php echo $file['name'] ?>" id="btn_del_file" onclick="del_file(<?php echo $file['iddocumentTicket'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
<?php			
			}
		}
	}
}
?>		