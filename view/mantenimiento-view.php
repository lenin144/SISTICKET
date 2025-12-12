<?php
/*-------------------------
Autor: Autor Dev
Web: www.google.com
E-Mail: waptoing7@gmail.com
---------------------------*/
$active13 = "active";
include "header.php";
// include "sidebar.php"

$meses = [
    "Ene",
    "Feb",
    "Mar",
    "Abr",
    "May",
    "Jun",
    "Jul",
    "Ago",
    "Sep",
    "Oct",
    "Nov",
    "Dic"
];

$lista = mysqli_query($con, "SELECT m.`id`, m.`oficina`, m.`tarea`, m.`manual`, m.`tiempo`, m.`frecuencia`, m.`inicio`, m.`area`, m.`tipo`, m.ocultar, mf.nombre, u.name, u.lastname FROM `mantenimiento` m inner JOIN mantenimiento_frecuencia mf on m.`frecuencia` = mf.Id  LEFT JOIN user u on u.id = m.empleado where m.empleado = ". $_SESSION['user_id'] . " order by m.Id");

$dateTime = new DateTime();
$anio = (isset($_GET['year'])) ? $_GET['year'] : $dateTime->format('Y');

$period = new DatePeriod(
    new DateTime($anio . '-01-01'),
    new DateInterval('P1D'),
    new DateTime($anio + 1 . '-01-01')
);

// if ($is_admin != 1) {
//     print "<script>window.location='?view=dashboard&error';</script>";
// }
?>

<style>
    .headcol {
  position: absolute;
  width: 5em;
  left: 0;
  top: auto;
  border-top-width: 1px;
  /*only relevant for first row*/
  margin-top: -1px;
  /*compensate for top border*/
}

.headcol:before {
  content: 'Row ';
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Fecha mantenimiento</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Fecha mantenimiento</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form action="" method="get">
                    <input type="hidden" name="view" value="mantenimiento">
                    <select name="year" onchange="this.form.submit()">
                        <?php
                            for ($year = 2000; $year <= 2100; $year++) {
                                if ($year == $anio) {
                                    echo '<option value="' . $year . '" selected>' . $year . '</option>';
                                } else {
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                            }
                        ?>
                    </select>
                    
                </form>
                                <!-- <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_mantenimiento"><i class='fa fa-plus'></i> Nuevo</a> -->
                                <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="action/excel_mantenimiento.php?year=<?php echo $anio;?>&empleado=<?php echo $_SESSION['user_id'];?>"><i class='fa fa-file-excel-o'></i> Excel</a>
                                <br><br>
                                <?php
                                if (isset($_GET)) {
                                    if (isset($_GET['deletesuccess'])) {
                                        echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Eliminado Correctamente!</div>";
                                    }
                                    if (isset($_GET['errordelete'])) {
                                        echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Hubo un error al eliminar los datos!</div>";
                                    }
                                }
                                ?>
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Plan maestro de mantenimiento preventivo</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="example6" class="table table-bordered table-hover">
                            <thead class="table_header">
                               <tr>
                                    <th colspan="9" rowspan="2" class="text-center" style="vertical-align: middle;">Plan maestro de mantenimiento preventivo</th>
                                    <?php
                                    $cont = 0;
                                    $semana = 1;
                                    foreach ($period as $key => $value) {
                                        $cont++;
                                        if ($cont == 7) {
                                            echo '<th colspan="7" class="text-center">Semana ' . $semana . '</th>';
                                            $cont = 0;
                                            $semana++;
                                        }
                                    }
                                    ?>
                                </tr>
                                <tr>
                                <?php
                                foreach ($period as $key => $value) {
                                    $date = DateTime::createFromFormat("d/m/Y", $value->format("d/m/Y"));
                                    setlocale(LC_ALL, "es_ES");
                                    echo '<th class="text-center">' . $meses[intval($date->format("m")) - 1 ] . '</th>';
                                }
                                ?>
                                </tr> 
                                <tr>
                                    <th style="white-space: nowrap;">Empleado</th>
                                    <th style="white-space: nowrap;">Area</th>
                                    <th style="white-space: nowrap;">Tarea</th>
                                    <th style="white-space: nowrap;">Manual</th>
                                    <th style="white-space: nowrap;">Tiempo en Min.</th>
                                    <th style="white-space: nowrap;">Frecuencia</th>
                                    <th style="white-space: nowrap;">Tipo</th>
                                    <th style="white-space: nowrap;">Fecha de inicio</th>
                                    <th style="white-space: nowrap;">Area responsable</th>
                                    <?php
                                        foreach ($period as $key => $value) {
                                            echo '<th class="text-center">' . $value->format("d") . '</th>';
                                        }
                                        ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($lista)>0):
                            foreach ($lista as $item):
                                
                                if($item['ocultar']=='0000'|| ($item['ocultar']!='0000'&&$anio<$item['ocultar'])):

                            ?>
                                <tr>
                                    <td><?php echo $item['name'] . " " . $item['lastname'] ?></td>
                                    <td><?php echo $item['oficina'] ?></td>
                                    <td><?php echo $item['tarea'] ?></td>
                                    <td><?php echo '<a target ="_blank" href="'.$item['manual'].'">Descargar Manual</a>'?></td>
                                    <td><?php echo $item['tiempo'] ?></td>
                                    <td><?php echo $item['nombre'] ?></td>
                                    <td><?php echo $item['tipo'] ?></td>
                                    <td><?php echo substr($item['inicio'], 0, 10) ?></td>
                                    <td><?php echo $item['area'] ?></td>
                                    <!-- Calcular -->
                                    <?php
                                    calcularMantenimientos2($item['inicio'], $item['frecuencia'], $period, $anio);
                                    ?>
                                </tr>
                            <?php endif; endforeach; endif; ?>
                            </tbody>
                        </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
# Algoritmo
function calcularMantenimientos2($inicio, $frecuencia, $periodo, $anio)
{
    # Configuracion (numero de dias)
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
                echo "<th>🚩</th>";
            } else {
                echo "<th></th>";
            }

        }
        // Frecuencia semanal
    } else if ($frecuencia == 2) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $ini = 0;
        $connectYear = false;

        // $historico = new DatePeriod(
        //     new DateTime(substr($inicio, 0, 10)), // fecha de inicio
        //     new DateInterval('P1D'),
        //     new DateTime($anio . '-01-01') // ultimo dia del año anterior al seleccionado
        // );

        // if (count($historico) > 0) {
        //     foreach ($historico as $key => $value) {
        //         $a = new DateTime(substr($inicio, 0, 10));
        //         $b = new DateTime($value->format('Y-m-d'));
        //         if ($contHistorico == $semanal) {
        //             $contHistorico = 0;
        //         }
        //         $contHistorico++;
        //     }

        // }

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
                echo "<th>🚩</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>🚩</th>";
                    } else {
                        echo "<th></th>";
                    }
                }

                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $semanal) {
                    echo "<th>🚩</th>";
                    $cont = 0;
                } else {
                    echo "<th></th>";
                }

            } else {
                echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 3) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $ini = 0;
        // $historico = new DatePeriod(
        //     new DateTime(substr($inicio, 0, 10)), // fecha de inicio
        //     new DateInterval('P1D'),
        //     new DateTime($anio . '-01-01') // ultimo dia del año anterior al seleccionado
        // );

        // if (count($historico) > 0) {
        //     foreach ($historico as $key => $value) {
        //         $a = new DateTime(substr($inicio, 0, 10));
        //         $b = new DateTime($value->format('Y-m-d'));
        //         if ($contHistorico == $mensual) {
        //             $contHistorico = 0;
        //         }
        //         $contHistorico++;
        //     }
        //     $ini = $mensual - $contHistorico;
        // }

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
                echo "<th>🚩</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>🚩</th>";
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $mensual) {
                    echo "<th>🚩</th>";
                    $cont = 0;
                } else {
                    echo "<th></th>";
                }

            } else {
                echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 4) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $ini = 0;
        // $historico = new DatePeriod(
        //     new DateTime(substr($inicio, 0, 10)), // fecha de inicio
        //     new DateInterval('P1D'),
        //     new DateTime($anio . '-01-01') // ultimo dia del año anterior al seleccionado
        // );

        // if (count($historico) > 0) {
        //     foreach ($historico as $key => $value) {
        //         $a = new DateTime(substr($inicio, 0, 10));
        //         $b = new DateTime($value->format('Y-m-d'));
        //         if ($contHistorico == $anual) {
        //             $contHistorico = 0;
        //         }
        //         $contHistorico++;
        //     }
        //     $ini = $anual - $contHistorico;
        // }

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
                echo "<th>🚩</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>🚩</th>";
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    echo "<th>🚩</th>";
                    $cont = 0;
                } else {
                    echo "<th></th>";
                }

            } else {
                echo "<th></th>";
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
                echo "<th>🚩</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear ) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($show){
                        echo "<th>🚩</th>";
                        $show = false;
                        }else{
                            echo "<th></th>";
                        }
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    if($show){
                    echo "<th>🚩</th>";
                    $show = false;
                    }else{
                    echo "<th></th>";}
                    $cont = 0;
                } else {
                    echo "<th></th>";
                }

            } else {
                echo "<th></th>";
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
                echo "<th>🚩</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear ) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($show){
                        echo "<th>🚩</th>";
                        $show = false;
                        }else {
                            echo "<th></th>";
                        }
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    if($show){
                    echo "<th>🚩</th>";
                    $show = false;
                    }else {
                        echo "<th></th>";
                    }
                    $cont = 0;
                } else {
                    echo "<th></th>";
                }

            } else {
                echo "<th></th>";
            }
            $cont++;
        }
    } else if ($frecuencia == 7) {
        // Calcular historico
        $cont = 0;
        $contHistorico = 0;
        $connectYear = false;
        $ini = 0;
        // $historico = new DatePeriod(
        //     new DateTime(substr($inicio, 0, 10)), // fecha de inicio
        //     new DateInterval('P1D'),
        //     new DateTime($anio . '-01-01') // ultimo dia del año anterior al seleccionado
        // );

        // if (count($historico) > 0) {
        //     foreach ($historico as $key => $value) {
        //         $a = new DateTime(substr($inicio, 0, 10));
        //         $b = new DateTime($value->format('Y-m-d'));
        //         if ($contHistorico == $mensual) {
        //             $contHistorico = 0;
        //         }
        //         $contHistorico++;
        //     }
        //     $ini = $mensual - $contHistorico;
        // }

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
                echo "<th>🚩</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>🚩</th>";
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $semestral) {
                    echo "<th>🚩</th>";
                    $cont = 0;
                } else {
                    echo "<th></th>";
                }

            } else {
                echo "<th></th>";
            }
            $cont++;
        }
    }
}
?>

<?php include "footer.php"?>