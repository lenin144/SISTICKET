<?php
/*-------------------------
Autor: Autor Dev
Web: www.google.com
E-Mail: waptoing7@gmail.com
---------------------------*/
$active13 = "active";
include "header.php";
include "sidebar.php";
if ($is_admin != 1) {
    print "<script>window.location='?view=dashboard&error';</script>";
}

$frecuencias = mysqli_query($con, "select * from mantenimiento_frecuencia");
$empleados = mysqli_query($con, "select * from user where is_client=1");
?>

<head>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Mantenimiento</h1>
		<ol class="breadcrumb">
			<li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="?view=mantenimiento"><i class="fa fa-child"></i> Mantenimiento</a></li>
			<li class="active">Nuevo Mantenimiento</li>
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
						<h3 class="box-title">Nuevo Mantenimiento</h3>
					</div>
						<!-- /.box-header -->
						<!-- form start -->
					<form role="form" method="post" name="add" id="add">
						<div class="box-body">
							<div class="form-group">
								<label for="area">Área u oficina: </label>
								<input type="text" name="area" class="form-control" id="area" placeholder="Área" required>
							</div>
							<div class="form-group">
								<label for="tarea">Actividad o tarea: </label>
								<input type="text" name="tarea" class="form-control" id="tarea" placeholder="Tarea">
							</div>
							<div class="form-group">
								<label for="tarea">Manual: </label>
								<input type="text" name="manual" class="form-control" id="manual" placeholder="Manual">
							</div>
							<div class="form-group">
								<label for="tiempo">Tiempo: </label>
								<input type="number" name="tiempo" class="form-control" id="tiempo" placeholder="Tiempo en minutos">
							</div>
                            <div class="form-group">
                                <label for="frecuencia">Frecuencia: </label>
                                <select name="frecuencia" class="chosen-select form-control" id="frecuencia" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <?php
                                            foreach ($frecuencias as $value) {
                                                echo '<option value="'.$value['id'].'" >'.$value['nombre'].'</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group">
								<label for="tipo">Tipo de mantenimiento: </label>
								<input type="text" name="tipo" class="form-control" id="tipo" placeholder="Tipo de mantenimiento">
							</div>
							<div class="form-group">
								<label for="inicio">Fecha de inicio: </label>
								<input type="date" name="inicio" class="form-control" id="inicio" placeholder="Fecha de inicio" required>
							</div>
							<div class="form-group">
								<label for="responsable">Área responsable: </label>
								<input type="text" name="responsable" class="form-control" id="responsable" value="T.I." placeholder="Área responsable" required>
							</div>
							<div class="form-group">
                                <label for="empleado">Asignar empleado: </label>
                                <select name="empleado" class="chosen-select form-control" id="empleado" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value="NULL" selected>Ninguno</option>
										<?php
                                            foreach ($empleados as $value) {
                                                echo '<option value="'.$value['id'].'" >'.$value['name']." ".$value['lastname'].'</option>';
                                            }
                                        ?>
                                </select>
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
<?php include "footer.php"?>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
 $( "#add" ).submit(function( event ) {
    event.preventDefault();
    sendData();
});


function sendData(){
    var parametros = $( "#add" ).serialize();
    // var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "action/addmantenimiento.php",
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
}


</script>
