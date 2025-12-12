<?php 
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	$active11="active";
	include "header.php";
	include "sidebar.php";

	$id=intval($_GET['id']);

	if (isset($_GET['id']) && !empty($_GET['id'])){
		$id=$_GET["id"];
	} else {
		header("Location: ?view=usuarios");  
	}

	if($is_admin!=1){
		print "<script>window.location='?view=dashboard&error';</script>";
	}

	$sql=mysqli_query($con, "select * from user where id=$id");
	$rows=mysqli_fetch_array($sql);
		$id=$rows['id'];
		$name=$rows['name'];
		$lastname=$rows['lastname'];
		$email=$rows['email'];
		$username=$rows['username'];
		$is_admin=$rows['is_admin'];
		$is_active=$rows['is_active'];

		$latitude=$rows['latitude'];
		$longitude=$rows['longitude'];
	
?>
<head>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Usuarios</h1>
			<ol class="breadcrumb">
				<li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="?view=usuarios"><i class="fa fa-th-child"></i> Usuarios</a></li>
				<li class="active">Editar Usuario</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-xs-12 col-md-6">
				<div id="result"></div>
					<!-- general form elements -->
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Editar Usuario</h3>
						</div>
					<!-- /.box-header -->
					<!-- form start -->
						<form role="form" method="post" name="upd" id="upd">
							<div class="box-body">
								<div class="form-group">
								  <label for="nombre">Nombre:</label>
								  <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $name ?>">
								</div>
								<div class="form-group">
								  <label for="apellidos">Apellido:</label>
								  <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellido" value="<?php echo $lastname ?>">
								</div>
								<div class="form-group">
								  <label for="email">E-mail:</label>
								  <input type="email" name="email" class="form-control" id="email" placeholder="Correo Electrónico" value="<?php echo $email ?>">
								</div>
								<div class="form-group">
								  <label for="usuario">Usuario:</label>
								  <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" value="<?php echo $username ?>">
								</div>
								<div class="form-group">
								  <label for="password">Contraseña:</label>
								  <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" value="">
								  <label for="confirm_pass">Confirmar Contraseña:</label>
								  <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="Contraseña" value="">
								  <p class="text-info">La contraseña solo se modifica si escribes algo, en caso contrario no.</p>
								</div>
							<div id="areas">
								<div class="form-group">
									<!-- <div class="alert alert-danger"><strong>Aviso!</strong><br> Si elimina una area, el usuario seguira siendo supervisor, por favor vaya a: <br> <strong>Areas Editar</strong> y actualize el supervisor!</div> -->
									<label for="area">Actualizar Areas: </label><br>
								  
									<!-- <select class="chosen-select form-control" name="area[]" multiple id="area" data-placeholder="-- Seleccionar --" autocomplete="off">
									<?php 
										$areas = mysqli_query($con, "select * from area");
										foreach($areas as $cat){
										$areas_seleccionadas =mysqli_query($con, "select * from usuarios_areas inner join user on usuarios_areas.user_id=user.id inner join area on usuarios_areas.area_id=area.id where usuarios_areas.user_id=$id");
									?>
										<option
											value="<?php echo $cat['id']; ?>"
											<?php 
												while ($cat_areas=mysqli_fetch_array($areas_seleccionadas)) {
													$id_areas_selecionadas = $cat_areas['area_id'];
													if($id_areas_selecionadas==$cat['id'])
														{echo"selected";}
												}
											?>
										>
											<?php echo $cat['name']; ?> 
										</option>
									<?php   
										}
									?>
									</select> -->

									<?php 
										$areas = mysqli_query($con, "select * from area");
										foreach($areas as $cat){
										$areas_seleccionadas =mysqli_query($con, "select * from usuarios_areas inner join user on usuarios_areas.user_id=user.id inner join area on usuarios_areas.area_id=area.id where usuarios_areas.user_id=$id");
									?>	<div id="resultados"></div>
										<label style="font-weight: normal;" >
					                  		<input name="area[]" id="area" value="<?php echo $cat['id']; ?>" type="checkbox"
												<?php 
													while ($cat_areas=mysqli_fetch_array($areas_seleccionadas)) {
														$id_areas_selecionadas = $cat_areas['area_id'];
														if($id_areas_selecionadas==$cat['id'])
															{echo"checked";echo" onclick=\"return update_area($cat_areas[id]);\"";
														echo $id_areas_selecionadas;
													}
													}
												?>	
					                  		> 
					                  		<?php echo $cat['name']; ?>
					                	</label>
					                	<br>
									<?php   
										}
									?>
								</div>    
							</div>    
							<div class="form-group">
    <!-- search input box -->
    <!-- <form> -->
        <div class="form-group input-group">
            <input type="text" id="search_location" class="form-control" placeholder="Buscar Ubicación">
            <div class="input-group-btn">
                <button class="btn btn-default get_map" type="submit">
                    Buscar
                </button>
            </div>
        </div>
    <!-- </form> -->

    <!-- display google map -->
    <div id="geomap" style="width: 100%; height: 400px;"></div>
    <input type="hidden" class="search_latitude" size="30" id="lat" name="lat" value="<?php echo $latitude ?>">
    <input type="hidden" class="search_longitude" size="30" id="long" name="long" value="<?php echo $longitude ?>">  
							</div>
<div class="form-group">
	<h4>Detalles de la ubicación</h4>
	<label for="confirm_pass">Dirección: </label>
	<input type="text" name="confirm_pass" class="form-control search_addr">
</div>
							<div class="form-group">
								<label for="status">Estado:</label>
								<select name="status" class="chosen-select form-control" id="status" required data-placeholder="-- Seleccionar --" autocomplete="off">
									<option value="1" <?php if($is_active==1){echo"selected";} ?>>Activo</option>
									<option value="0" <?php if($is_active==0){echo"selected";} ?>>Inactivo</option>
							  </select>
							</div>
								<div class="checkbox">
								  <label>
									<input type="checkbox" <?php if($is_admin==1){echo "checked"; } ?> name="is_admin" id="is_admin"> Administrador
								  </label>
								</div>
								<input type="hidden" name="mod_id" value="<?php echo $id ?>">
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" id="save_data" class="btn btn-success">Actualizar</button>
							</div>
						</form>
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->


<!-- class="minimal" -->
<?php include "footer.php" ?>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX6wD6FcmE4ZEFB2gEVka9qNkdsA4eqeg"></script>
<script src="../assets/js/localizacion.js" type="text/javascript"></script>


<script>
    function update_area(id){
        $.ajax({
            type: "POST",
            url: "ajax/del_area_usuario.php",
            data: "id="+id+"&idusuario="+<?php echo intval($_GET['id']); ?>,
                success: function(datos){
                    $("#resultados").html(datos);
                }
        });
    }
</script> 
<script>
$(document).ready(function(){
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

	if($('#is_admin').is(':checked') ) {
			$("#areas").hide();
		}else{
			$("#areas").show();
		}
	$("#is_admin").click(function(){;
		if($('#is_admin').is(':checked') ) {
			$("#areas").hide();
		}else{
			$("#areas").show();
		}
	});

	// si es administrador no le muestro "areas actuales"
	/*if($('#is_admin').is(':checked') ) {
		$("#areas_actuales").hide();
	}*/
});  

$( "#upd" ).submit(function( event ) {
	if($("#password").val()==$("#confirm_pass").val()){
		$('#upd_data').attr("disabled", true);
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "action/upduser.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#result").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#result").html(datos);
					$('#upd_data').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
	}else{
		alert("Las contraseñas no coinciden!");
		event.preventDefault();
	}          
})
</script>
