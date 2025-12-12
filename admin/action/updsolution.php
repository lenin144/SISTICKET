<?php	
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	include 'myLibAbisoftINC.php';
    $cart = new Cart;
	// session_start();

	if (empty($_POST['Description'])) {
           $errors[] = "Descripción vacío";
        } else if (
			!empty($_POST['Description']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$Description=mysqli_real_escape_string($con,(strip_tags($_POST["Description"],ENT_QUOTES)));
		$status=intval($_POST['status']);
		$id=intval($_POST['mod_id']);
		$created_at=date("Y-m-d H:i:s");
		//$user_id=$_SESSION['user_id'];
		$sql="UPDATE causesolution SET Description=\"$Description\",Active=$status where idCauseSolution=$id";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "La causa de solución ha sido actualizada satisfactoriamente.";

				if(!empty($_POST['categories'])){
					$delete_categories=mysqli_query($con,"delete from categorycausesolution where idCauseSolution=$id");
					if($delete_categories){
						if(isset($_POST['categories'])){	
							foreach($_POST['categories'] as $cat){
								$query2=mysqli_query($con,"insert into categorycausesolution (idCauseSolution, idCategory) values ($id,$cat)");
								$cart->destroy();
							}
						}
					}
				}
				
				
				print("<script>window.location='./?view=cause_solution'</script>");
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>