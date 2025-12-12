<?php 
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	include "header.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Perfil </h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Perfil</li>
		</ol>
	</section>
		 <!-- Main content -->
        <section class="content">
			<div class="row"><!-- .row -->
			<div class="col-md-1"></div>
				<div class="col-md-3">
					<!-- Profile Image -->
						<div class="box box-primary">
							<div class="box-body box-profile">
							<div id="load_img">
								<?php if($profile_pic!=""){ ?>
                                        <img class="img-responsive" width="100%" src="admin/images/profiles/<?php echo $profile_pic; ?>" alt="Imagen de Perfil"/>
                                <?php }else{ ?>
                                    <img class="img-responsive" width="100%" src="admin/images/default.png" alt="Imagen de Perfil"/>
                                <?php } ?>
							</div>
								<h3 class="profile-username text-center"><?php echo $fullname;?></h3>
								<p class="text-muted text-center mail-text"><?php echo $email;?></p>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					<span class="btn btn-my-button btn-file" style="width: 100%; margin-top: 5px;">
						<form method="post" id="formulario" enctype="multipart/form-data">
							Cambiar Imagen de perfil: <input type="file" name="file">
						</form>
					</span>
					<div id="respuesta"></div><br>
				</div> 
				<div class="col-md-1"></div>
				<div class="col-md-6">
			<?php 

						if (isset($_GET)) {
						   if (isset($_GET['success'])) {
							  echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Actualizados Correctamente!</div>";
						   }
						   if (isset($_GET['success_pass'])) {
							  echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Contraseña Actualizada Correctamente!</div>";
						   }
						   if (isset($_GET['invalid'])) {
							  echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>La contraseña no coincide con la anterior!</div>";
						   }
						   if (isset($_GET['error'])) {
							  echo "<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Las nuevas  contraseñas no coinciden.!</div>";
						   }

						}

					?>
					<div class="box box-primary"><!-- general form elements -->
						<div class="box-header with-border">
							<h3 class="box-title">Datos Personales: </h3>
						</div> <!-- /.box-header -->
					
						<form role="form" method="post" action="action/upd_user.php" ><!-- form start -->
							<div class="box-body">
								<div class="form-group">
									<label for="name">Nombre:</label>
									<input name="name" type="text" class="form-control" id="name" value="<?php echo $name ?>">
								</div>
								<div class="form-group">
									<label for="lastname">Apellido:</label>
									<input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $lastname ?>">
								</div>
								<div class="form-group">
									<label for="business">Nombre Empresa:</label>
									<input name="business" type="text" class="form-control" id="business" value="<?php echo $business ?>">
								</div>
								<div class="form-group">
									<label for="email">Correo Electrónico</label>
									<input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?>">
								</div>
								<div class="form-group">
									<label for="ruc">RFC:</label>
									<input type="text" name="ruc" class="form-control" id="ruc" placeholder="RFC" value="<?php echo $ruc ?>" required onblur="aMayusculas(this.value,this.id)">
								</div>
								<div class="form-group">
									<label for="password">Contraseña Actual</label>
									<input name="password" type="password" class="form-control" id="password" placeholder="*******">
								</div>
								<div class="form-group">
									<label for="new_password">Nueva Contraseña</label>
									<input name="new_password" type="password" class="form-control" id="new_password">
								</div>
								<div class="form-group">
									<label for="confirm_new_password">Confirmar Nueva Contraseña</label>
									<input name="confirm_new_password" type="password" class="form-control" id="confirm_new_password">
								</div>
								<div class="form-group">
                                    <label>Archivos adjuntos</label>
                                    <?php if ($file1!="" && $file1 != null){ ?>
                                        <br><a href="<?php echo $file1?>" target="_blank">Archivo adjunto 1</a>
                                    <?php } ?>
                                   
                                    <?php if ($file2!="" && $file2 != null){ ?>
                                        <br><a href="<?php echo $file2?>" target="_blank">Archivo adjunto 2</a>
                                    <?php } ?>
                                </div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button name="token" type="submit" class="btn btn-success">Actualizar Datos</button>
							</div>
						</form>
					</div><!-- /.box -->
				</div>
				<div class="col-md-1"></div>
			</div><!-- /.row -->
		</section>
	</div><!-- /.content -->
<?php include "footer.php"; ?>
<script>
    function aMayusculas(obj,id){
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
</script>
<script>
	$(function(){
	$("input[name='file']").on("change", function(){
		var formData = new FormData($("#formulario")[0]);
		var ruta = "action/upload-profile.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta").html(datos);
			}
		});
	});
	});
</script>