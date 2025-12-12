<?php 
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	$active11="active";
	include "header.php";
	include "sidebar.php";
		if($is_admin!=1){
		print "<script>window.location='?view=dashboard&error';</script>";
	}

	$areas =mysqli_query($con, "select * from area");
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
			<li><a href="?view=usuarios"><i class="fa fa-child"></i> Usuarios</a></li>
			<li class="active">Nuevo Usuario</li>
		</ol>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-xs-12 col-md-6">
				<div id="result"></div>
				<!-- general form elements -->
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Nuevo Usuario</h3>
					</div>
						<!-- /.box-header -->
						<!-- form start -->
					<form role="form" method="post" name="add" id="add" onsubmit="validate(event,this);">
						<div class="box-body">
							<div class="form-group">
								<label for="nombre">Nombre: </label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
							</div>
							<div class="form-group">
								<label for="apellidos">Apellidos: </label>
								<input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos">
							</div>
							<div class="form-group">
								<label for="email">E-mail: </label>
								<input type="email" name="email" class="form-control" id="email" placeholder="Correo Electrónico">
							</div>
							<div class="form-group">
								<label for="usuario">Usuario: </label>
								<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre" required>
							</div>
							<div class="form-group">
								<label for="password">Contraseña: </label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
							</div>
							<div class="form-group">
								<label for="confirm_pass">Confirmar Contraseña: </label>
								<input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="Contraseña" required>
							</div>
							<div class="form-group" id="areas">
								<label for="area">Área: </label><br>
								<!-- <select class="chosen-select form-control" name="area[]" multiple id="area" data-placeholder="-- Seleccionar --" autocomplete="off">
									<?php foreach($areas as $cat):?>
									<option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
									<?php endforeach; ?>
								</select> -->
								<?php foreach($areas as $cat):?>
					                <label style="font-weight: normal;">
					                  	<input name="area[]" id="area" value="<?php echo $cat['id']; ?>" type="checkbox" class="minimal"> <?php echo $cat['name']; ?>
					                </label><br>
				                <?php endforeach; ?>
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
    <input type="hidden" class="search_latitude" size="30" id="lat" name="lat">
    <input type="hidden" class="search_longitude" size="30" id="long" name="long">
							</div>
<div class="form-group">
	<h4>Detalles de la ubicación</h4>
	<label for="confirm_pass">Dirección: </label>
	<input type="text" name="confirm_pass" class="form-control search_addr">
</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="is_admin" id="is_admin" > Administrador
								</label>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" id="save_data" class="btn btn-success">Agregar</button>
						</div>
					</form>
				</div><!--	 /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include "footer.php" ?>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX6wD6FcmE4ZEFB2gEVka9qNkdsA4eqeg"></script>
<script src="../assets/js/localizacion.js" type="text/javascript"></script>

<script>
$(document).ready(function(){

	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });


	$("#is_admin").click(function(){;
		if($('#is_admin').is(':checked') ) {
			$("#areas").hide();
		}else{
			$("#areas").show();
		}
	});
});  

// $( "#add" ).submit(function( event ) {
function validate(e) {		
	if($('#is_admin').is(':checked') ) {
		// console.log("soy admin");
		
		//envio los datos
		sendData();
		e.preventDefault();
	}else{
		// console.log("soy agente");
		var forms = document.add;
		var seleccted = false;
		for (var i = 0; i < forms.area.length; i++) {
			if (forms.area[i].checked) {
				seleccted = true;
			}
		}
		if (!seleccted){
			alert ('debes seleccionar al menos una área');
			if (e.preventDefault) {
				e.preventDefault();
			}else{
				e.returnValue = false;
			}
		}else{
			//envio los datos
			sendData();
		}
		e.preventDefault();
	}
}
	
function sendData(){
	if($("#password").val()==$("#confirm_pass").val()){
		$('#save_data').attr("disabled", true);
		var parametros = $( "#add" ).serialize();
		// var parametros = $(this).serialize();
	 	$.ajax({
			type: "POST",
			url: "action/adduser.php",
			data: parametros,
			 beforeSend: function(objeto){
					$("#result").html("Mensaje: Cargando...");
				},
			success: function(datos){
			$("#result").html(datos);
			$('#save_data').attr("disabled", false);
			// load(1);
			}
		});
		// event.preventDefault();
	}else{
		alert("Las contraseñas no coinciden!");
	}     
}

// })

</script>
