<?php

	session_start();
	/* Connect To Database*/
	require_once ("../config/config.php");
	if (isset($_GET["id"])){
		$id=$_GET["id"];
		$id=intval($id);
		$sql="select * from documentticket where idTicket='$id'";
		$query=mysqli_query($con,$sql);
		$num=mysqli_num_rows($query);
	}	
	else {exit;}
?>

<?php if($num>0){?>
	<?php foreach($query as $files): ?>
		<div class="form-group">
			<label class="col-lg-2 control-label"></label>
			<div class="col-md-8">
				<a target="_blank" class="form-control col-md-7 col-xs-12" href="view/downloadfile_ticket.php?id=<?php echo $files['iddocumentTicket'] ?>"><i class="fa fa-download"></i> <?php echo " ".$files['name'] ?></a>
			</div>
		</div>
	<?php endforeach; ?>
<?php }else{?>
    <input type="text"  class="form-control col-md-7 col-xs-12" value="<?php echo "Sin Archivo Adjunto" ?>" readonly>
<?php }?>
<br>