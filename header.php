<?php
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	// session_start();
	include "admin/config/config.php";
	if (!isset($_SESSION['user_id']) AND $_SESSION['user_id'] != 1) {
		header("location: ?view=login");
		exit;
	}

	$id=$_SESSION['user_id'];
	$id_client=$_SESSION['user_id'];
	$query=mysqli_query($con,"SELECT * from user where id=$id");
	$row=mysqli_fetch_array($query);
		$business=$row['business'];
		$fullname=$row['fullname'];
		$name=$row['name'];
		$lastname=$row['lastname'];
		$email=$row['email'];
		$ruc=$row['ruc'];
		$profile_pic=$row['profile_pic'];
		$file1 = $row['file1'];
		$file2 = $row['file2'];

	$config = mysqli_query($con, "select * from configuration where name='website' ");
		$row1=mysqli_fetch_array($config);
		$website=$row1['val'];

	$fav = mysqli_query($con, "select * from configuration where name='favicon' ");
		$row2=mysqli_fetch_array($fav);
		$favicon=$row2['val'];

	// Consultar mis tareas asignadas
	$tareas = mysqli_query($con, "SELECT * FROM `mantenimiento` WHERE empleado = " . $id);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="admin/images/<?php echo $favicon ?>" />
	<title><?php echo $website ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="admin/bootstrap/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
	<!-- DataTables -->
	<link rel="stylesheet" href="admin/plugins/datatables/dataTables.bootstrap.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
	
	<!-- bootstrap datepicker -->
  	<link rel="stylesheet" href="admin/plugins/datepicker/datepicker3.css">
	<!-- Chosen Select -->
	<link rel="stylesheet" type="text/css" href="admin/plugins/chosen/css/chosen.min.css" />
	<!--  Select2 -->
	<link rel="stylesheet" type="text/css" href="admin/plugins/select2/select2.min.css" />
	<!-- jvectormap -->
	<link rel="stylesheet" href="admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
	
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="admin/plugins/iCheck/all.css">

	<link rel="stylesheet" href="admin/dist/css/skins/_all-skins.min.css">
	<!-- <link rel="stylesheet" href="admin/dist/css/skins/my-kin-light.css"> -->
	<link rel="stylesheet" href="admin/dist/css/micss.css">
	<!-- wizard -->
	<link rel="stylesheet" href="easyWizard.css">
	<style>
		.table_header{
		   background-color: #ca4300;
		   color:#fff;
		}
	</style>
	<style>
		

.modal20{
	width: 100%;
	height: 100vh;
	background: rgba(0, 0, 0, 0.8);
	position: absolute;
	top: 0;
	left: 0;
    display: flex;

	animation: modal20 2s 0s forwards;
	
	visibility: hidden;
	opacity: 0;

}

.contenidos10{
	margin: auto;
	
	background: black;
	border-radius: 10px;
	text-align: center;
	
	box-sizing: border-box;

}

#cerrar{
	display: none;
}


#cerrar:checked + label, #cerrar:checked ~ .modal20{
	display: none;
}

@keyframes modal20{
	100%{
		visibility: visible;
		opacity: 1;
}
}



.modal20{
	position: fixed;
}

.modal20 .wrapper{
	position: relative;
}
.modal20 #btn-cerrar{
	position: absolute;
    right: 9px;
    top: 9px;
    height: 30px;
    width: 30px;
   background: #ca4300;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    border-radius: 50%;
    cursor: pointer;
}
	</style>
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
    <?php
	if ($_SESSION['modal']==true){
	?>
	<input type="checkbox" id="cerrar">
        
        <div style="z-index: 20000" class="modal20">
            <div class="contenidos10">
                <div class="wrapper" style="background: none !important;">
                    <label style="z-index: 20000; font-weight: bold" for="cerrar" id="btn-cerrar" style="font-weight: bold;">X</label>
                    <img  src="images/calidraper_modal.png" alt="Calidra Peru" style="border-radius: 6px; width:321px; height: 520px;  "> 
                </div>
            </div>
        </div>
	<?php
	$_SESSION['modal'] = false;
	}
	?>
<div class="wrapper">

  <header class="main-header">
	<?php if(!isset($_SESSION['sidebar'])){ ?>
	<!-- Logo -->
	<a href="#" class="logo">
	  <!-- mini logo for sidebar mini 50x50 pixels -->
	  <span class="logo-mini"><b>C</b>P</span>
	  <!-- logo for regular state and mobile devices -->
	  <span class="logo-lg"><b><?php echo $website ?></b></span>
	</a>
	<?php } ?>

	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
	  <!-- Sidebar toggle button-->
	  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
	  </a>
	  <!-- Navbar Right Menu -->
	  <div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span id="cont_tareas" class=""><i class="fa fa-flag" aria-hidden="true"></i> 0</span>
					</a>
					
					<ul class="dropdown-menu">
						<ul class="list-group" style="margin-bottom: 0px !important;">
							<li class="list-group-item text-center text-muted">TAREAS ASIGNADAS PARA HOY</li>
							<?php
								// Tareas pendientes
								$dateTime = new DateTime();
								$anio = $dateTime->format('Y');
								$today = $dateTime->format('Y-m-d');

								$period = new DatePeriod(
									new DateTime($anio . '-01-01'),
									new DateInterval('P1D'),
									new DateTime($anio + 1 . '-01-01')
								);
								// Recorrer
								$cont = 0;
								foreach ($tareas as $item) {
									if(calcularMantenimientos($item['inicio'], $item['frecuencia'], $period, $anio, $today)){
										echo '<li class="list-group-item">'.$item['tarea'].'</li>';
										$cont++;
									}
								}

								echo "<script>cont_tareas.innerHTML = '".'<i class="fa fa-flag" aria-hidden="true"></i>'." $cont';</script>"
							?>
						</ul>
					</ul>
				</li>  
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php if($profile_pic!=""){ ?>
							<img src="admin/images/profiles/<?php echo $profile_pic; ?>" class="user-image" alt="Cliente Image"/>
						<?php }else{ ?>
							<img src="admin/images/default.png" class="user-image" alt="Cliente Image"/>
						<?php } ?>
						<span class="hidden-xs"><?php echo $name," ",$lastname ?> <i style="margin-left:5px" class="fa fa-angle-down"></i></span>
					</a>
					
					<ul class="dropdown-menu">
						<li class="user-header">
							<?php if($profile_pic!=""){ ?>
								<img src="admin/images/profiles/<?php echo $profile_pic; ?>" class="img-circle" alt="Cliente Image"/>
							<?php }else{ ?>
								<img src="admin/images/default.png" class="img-circle" alt="Cliente Image"/>
							<?php } ?>
						<p> <?php echo $name," ",$lastname ?> <small>(Cliente)</small> </p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="?view=profile" class="btn btn-default btn-flat">Perfil</a>
							</div>
							<div class="pull-right">
								<a style="width:80px" data-toggle="modal" href="action/logout.php" class="btn btn-default btn-flat">Salir</a>
							</div>
						</li>
					</ul>
				</li>      
				        
			</ul>

	  </div>

	</nav>
  </header>


  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="<?php if(isset($_SESSION['sidebar'])){echo 'padding-top: 50px;'; } ?>" >
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	  <!-- Sidebar user panel -->
	  <div class="user-panel">
		<div class="pull-left image">
		  <!-- <img src="admin/images/profiles/<?php echo $profile_pic ?>" class="img-circle" alt="User Image"> -->
		  <?php if($profile_pic!=""){ ?>
			<img src="admin/images/profiles/<?php echo $profile_pic; ?>" class="img-circle" alt="Cliente Image"/>
		<?php }else{ ?>
			<img src="admin/images/default.png" class="img-circle" alt="Cliente Image"/>
		<?php } ?>
		</div>
		<div class="pull-left info">
		  <p><?php echo $name." ".$lastname ?></p>
		  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	  </div>

	  <!-- sidebar menu: : style can be found in sidebar.less -->
	  <ul class="sidebar-menu">
		<li class="header">MENU</li>
		<li class="<?php if(isset($active1)){echo $active1;}?>">
		  <a href="?view=tickets">
			<i class="fa fa-ticket"></i> <span>Mis Tickets </span>
		  </a>
		</li>

		<li class="<?php if(isset($active2)){echo $active2;}?>">
		  <a href="?view=addticket">
			<i class="fa fa-plus"></i> <span>Crear Ticket</span>
		  </a>
		</li>
        <li class="<?php if(isset($active4)){echo $active4;}?>">
		  <a href="?view=mantenimiento">
			<i class="fa fa-wrench"></i> <span>Fecha mantenimiento</span>
		  </a>
		</li>
		<?php 
			$encuestor = mysqli_query($con,"select * from surveyticket where IdUserClient=$id_client and DateCompleted is null and Porcentage is null");
		?>
		<li style="display: none;"> class="<?php if(isset($active3)){echo $active3;}?>">
		  <a href="?view=mysurvey">
			<i class="fa fa-list-alt"></i> <span>Mis Encuestas </span>
			<span class="pull-right-container">
				<?php if(mysqli_num_rows($encuestor)>0){  ?>
              	<span class="label label-danger pull-right">
          			<?php echo mysqli_num_rows($encuestor); ?>
          		</span>
          		<?php } ?>
            </span>
		  </a>
		</li>
	  </ul>
	</section>
	<!-- /.sidebar -->
  </aside>

<?php
# Algoritmo
function calcularMantenimientos($inicio, $frecuencia, $periodo, $anio, $today)
{
    # Configuracion (numero de dias)
	$resp = false;
    $semanal = 7;
    $mensual = 30;
    $anual = 365;
    $trienal = $anual * 3; // Requiere actualizar algoritmo
    $cuatrienal = $anual * 4; // Requiere actualizar algoritmo 
    $semestral = 180;
    // Frecuencia diaria
    if ($frecuencia == 1) {
        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));
            if ($a <= $b) {
				if($today == $value->format('Y-m-d')){
					$resp = true;
				}                
            } else {
                // echo "<th></th>";
            }

        }
        // Frecuencia semanal
    } else if ($frecuencia == 2) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $ini = 0;
        $connectYear = false;

        if ($anio != substr($inicio, 0, 4)) {
            $fecha1 = new DateTime(substr($inicio, 0, 10));
            $fecha2 = new DateTime($anio . '-01-01');
            $diff = $fecha2->diff($fecha1);
            $contHistorico = $diff->days % $semanal;
            $ini = $semanal - $contHistorico;
        }

        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));

            if ($a == $b) {
                if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    // echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    } else {
                        // echo "<th></th>";
                    }
                }

                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $semanal) {
                    if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    $cont = 0;
                } else {
                    // echo "<th></th>";
                }

            } else {
                // echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 3) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $ini = 0;

        if ($anio != substr($inicio, 0, 4)) {
            $fecha1 = new DateTime(substr($inicio, 0, 10));
            $fecha2 = new DateTime($anio . '-01-01');
            $diff = $fecha2->diff($fecha1);

            $contHistorico = $diff->days % $mensual;
            $ini = $mensual - $contHistorico;
        }

        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));

            if ($a == $b) {
                if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    // echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    } else {
                        // echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $mensual) {
                    if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    $cont = 0;
                } else {
                    // echo "<th></th>";
                }

            } else {
                // echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 4) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $ini = 0;

        if ($anio != substr($inicio, 0, 4)) {
            $fecha1 = new DateTime(substr($inicio, 0, 10));
            $fecha2 = new DateTime($anio . '-01-01');
            $diff = $fecha2->diff($fecha1);
            $contHistorico = $diff->days % $anual;
            if ($contHistorico == 0) {
                $ini = 0;
            } else {
                $ini = $anual - $contHistorico;
            }
        }

        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));

            if ($a == $b) {
                if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    // echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    } else {
                        // echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    $cont = 0;
                } else {
                    // echo "<th></th>";
                }

            } else {
                // echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 5) {
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $show = false;
        $ini = 0;

        if ($anio != substr($inicio, 0, 4)) {
            $fecha1 = new DateTime(substr($inicio, 0, 10));
            $fecha2 = new DateTime($anio . '-01-01');
            $diff = $fecha2->diff($fecha1);
            $contHistorico = $diff->days % $anual;
            $show =  (($diff->y % 3) == 0);
            if ($contHistorico == 0) {
                $ini = 0;
            } else {
                $ini = $anual - $contHistorico;
            }
        }

        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));

            if ($a == $b) {
                if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                $cont = 0;
            } else if ($cont == $ini && !$connectYear ) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    // echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($show){
                        if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                        $show = false;
                        }else{
                            // echo "<th></th>";
                        }
                    } else {
                        // echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    if($show){
                    if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    $show = false;
                    }else{
                    // echo "<th></th>";
				}
                    $cont = 0;
                } else {
                    // echo "<th></th>";
                }

            } else {
                // echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 6) {
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $show = false;
        $ini = 0;

        if ($anio != substr($inicio, 0, 4)) {
            $fecha1 = new DateTime(substr($inicio, 0, 10));
            $fecha2 = new DateTime($anio . '-01-01');
            $diff = $fecha2->diff($fecha1);
            $contHistorico = $diff->days % $anual;
            $show =  (($diff->y % 4) == 0);
            if ($contHistorico == 0) {
                $ini = 0;
            } else {
                $ini = $anual - $contHistorico;
            }
        }

        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));

            if ($a == $b) {
                if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                $cont = 0;
            } else if ($cont == $ini && !$connectYear ) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    // echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($show){
                        if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                        $show = false;
                        }else {
                            // echo "<th></th>";
                        }
                    } else {
                        // echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    if($show){
                    if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    $show = false;
                    }else {
                        // echo "<th></th>";
                    }
                    $cont = 0;
                } else {
                    // echo "<th></th>";
                }

            } else {
                // echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 7) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $ini = 0;

        if ($anio != substr($inicio, 0, 4)) {
            $fecha1 = new DateTime(substr($inicio, 0, 10));
            $fecha2 = new DateTime($anio . '-01-01');
            $diff = $fecha2->diff($fecha1);

            $contHistorico = $diff->days % $semestral;
            $ini = $semestral - $contHistorico;
        }

        foreach ($periodo as $key => $value) {
            // verificar si ya paso
            $a = new DateTime(substr($inicio, 0, 10));
            $b = new DateTime($value->format('Y-m-d'));

            if ($a == $b) {
                if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    // echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    } else {
                        // echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $semestral) {
                    if($today == $value->format('Y-m-d')){
					$resp = true;
				} 
                    $cont = 0;
                } else {
                    // echo "<th></th>";
                }

            } else {
                // echo "<th></th>";
            }
            $cont++;
        }
    }
	return $resp;
}
?>