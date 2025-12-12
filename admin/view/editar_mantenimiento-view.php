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

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET["id"];
} else {
    header("Location: ?view=mantenimiento");
}

$sql = mysqli_query($con, "select * from mantenimiento where Id=$id");
$rows = mysqli_fetch_array($sql);
$id = $rows['id'];
$oficina = $rows['oficina'];
$tarea = $rows['tarea'];
$manual = $rows['manual'];
$tiempo = $rows['tiempo'];
$frecuencia = $rows['frecuencia'];
$inicio = substr($rows['inicio'], 0, 10);
$responsable = $rows['area'];
$tipo = $rows['tipo'];
$ocultar = $rows['ocultar'];
$empleado = $rows['empleado'];

$frecuencias = mysqli_query($con, "select * from mantenimiento_frecuencia");
$empleados=mysqli_query($con, "select * from user where is_client=1");
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
			<li class="active">Editar Mantenimiento</li>
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
						<h3 class="box-title">Editar Mantenimiento</h3>
					</div>
						<!-- /.box-header -->
						<!-- form start -->
					<form role="form" method="post" name="upd" id="upd">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<div class="box-body">
							<div class="form-group">
								<label for="area">Área u oficina: </label>
								<input type="text" name="area" class="form-control" id="area" placeholder="Área" value="<?php echo $oficina ?>" required>
							</div>
							<div class="form-group">
								<label for="tarea">Actividad o tarea: </label>
								<input type="text" name="tarea" class="form-control" id="tarea" value="<?php echo $tarea ?>" placeholder="Tarea">
							</div>
							<div class="form-group">
								<label for="tarea">Manual: </label>
								<input type="text" name="manual" class="form-control" id="manual" value="<?php echo $manual ?>" placeholder="Manual">
							</div>
							<div class="form-group">
								<label for="tiempo">Tiempo: </label>
								<input type="number" name="tiempo" class="form-control" id="tiempo" value="<?php echo $tiempo ?>" placeholder="Tiempo en minutos">
							</div>
                            <div class="form-group">
                                <label for="frecuencia">Frecuencia: </label>
                                <select name="frecuencia" class="chosen-select form-control" id="frecuencia" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <?php
                                            foreach ($frecuencias as $value) {
                                                if ($value['id']!=$frecuencia){
                                                    echo '<option value="'.$value['id'].'" >'.$value['nombre'].'</option>';
                                                }else{
                                                    echo '<option value="'.$value['id'].'" selected>'.$value['nombre'].'</option>';
                                                }
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group">
								<label for="tipo">Tipo de mantenimiento: </label>
								<input type="text" name="tipo" class="form-control" id="tipo" value="<?php echo $tipo ?>" placeholder="Tipo de mantenimiento">
							</div>
							<div class="form-group">
								<label for="inicio">Fecha de inicio: </label>
								<input type="date" name="inicio" class="form-control" id="inicio" value="<?php echo $inicio ?>" placeholder="Fecha de inicio" required>
							</div>
							<div class="form-group">
								<label for="responsable">Área responsable: </label>
								<input type="text" name="responsable" class="form-control" id="responsable" value="<?php echo $responsable ?>" placeholder="Área responsable" required>
							</div>
							<div class="form-group">
                                <label for="ocultar">Ocultar: </label>
                                <select name="ocultar" class="chosen-select form-control" id="ocultar" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                    <option value="0000">No ocultar</option>    
									<?php
										for ($year = substr($inicio, 0 , 4) + 1; $year <= 2100; $year++) {
											if($year==$ocultar){
												echo '<option value="' . $year . '" selected>Desde el año ' . $year . '</option>';
											}else{
												echo '<option value="' . $year . '">Desde el año ' . $year . '</option>';
											}
										}
									?>
                                </select>
                            </div>
							<div class="form-group">
                                <label for="empleado">Asignar empleado: </label>
                                <select name="empleado" class="chosen-select form-control" id="empleado" required data-placeholder="-- Seleccionar --" autocomplete="off">
								<option value="NULL" selected>Ninguno</option>
										<?php
                                            foreach ($empleados as $value) {
                                                if ($value['id']!=$empleado){
                                                    echo '<option value="'.$value['id'].'" >'.$value['name']." ".$value['lastname'].'</option>';
                                                }else{
                                                    echo '<option value="'.$value['id'].'" selected>'.$value['name']." ".$value['lastname'].'</option>';
                                                }
                                            }
                                        ?>
                                </select>
                            </div>

						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" id="save_data" class="btn btn-success">Guardar</button>
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
 $( "#upd" ).submit(function( event ) {
    event.preventDefault();
    sendData();
});


function sendData(){
    var parametros = $( "#upd" ).serialize();
    $.ajax({
        type: "POST",
        url: "action/updmantenimiento.php",
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
