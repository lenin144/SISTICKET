<?php
include("../config/config.php");
session_start();
if (!isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 1) {
    header("location: ../../");
	exit;
}

$anio = isset($_GET['year']) ? $_GET['year'] : null;
$tipo = 'excel';
$extension = '.xls';
header("Content-type: application/vnd.ms-$tipo");
header("Content-Disposition: attachment; filename=mantenimiento_".$anio.$extension);
header("Pragma: no-cache");
header("Expires: 0");


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

$lista = mysqli_query($con, "SELECT m.`id`, m.`oficina`, m.`tarea`, m.`manual`, m.`tiempo`, m.`frecuencia`, m.`inicio`, m.`area`, m.`tipo`, m.ocultar, mf.nombre, u.name, u.lastname FROM `mantenimiento` m inner JOIN mantenimiento_frecuencia mf on m.`frecuencia` = mf.Id  LEFT JOIN user u on u.id = m.empleado order by m.Id");
$dateTime = new DateTime();
$anio = (isset($_GET['year'])) ? $_GET['year'] : $dateTime->format('Y');

$period = new DatePeriod(
    new DateTime($anio . '-01-01'),
    new DateInterval('P1D'),
    new DateTime($anio + 1 . '-01-01')
);

?>



	<table border="1" cellspacing="0" style="width: 100%;  text-align: center; font-size: 9.5pt;padding:1mm;">
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
                                    <th style="white-space: nowrap;">Tiempo Min.</th>
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
                            foreach ($lista as $item):
                                if($item['ocultar']=='0000'|| ($item['ocultar']!='0000'&&$anio<$item['ocultar'])):

                            ?>
                                <tr>
                                    <td><?php echo $item['name'] . " " . $item['lastname'] ?></td>
                                    <td><?php echo $item['oficina'] ?></td>
                                    <td><?php echo $item['tarea'] ?></td>
                                    <td><?php echo $item['manual'] ?></td>
                                    <td><?php echo $item['tiempo'] ?></td>
                                    <td><?php echo $item['nombre'] ?></td>
                                    <td><?php echo $item['tipo'] ?></td>
                                    <td><?php echo substr($item['inicio'], 0, 10) ?></td>
                                    <td><?php echo $item['area'] ?></td>
                                    <!-- Calcular -->
                                    <?php
                                    calcularMantenimientos($item['inicio'], $item['frecuencia'], $period, $anio);
                                    ?>
                                </tr>
                            <?php endif; endforeach;?>
                            </tbody>
                        </table>


<?php
# Algoritmo
function calcularMantenimientos($inicio, $frecuencia, $periodo, $anio)
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
                echo "<th>X</th>";
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
                echo "<th>X</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>X</th>";
                    } else {
                        echo "<th></th>";
                    }
                }

                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $semanal) {
                    echo "<th>X</th>";
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
                echo "<th>X</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>X</th>";
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $mensual) {
                    echo "<th>X</th>";
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
                echo "<th>X</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>X</th>";
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $anual) {
                    echo "<th>X</th>";
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
                echo "<th>X</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear ) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($show){
                        echo "<th>X</th>";
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
                    echo "<th>X</th>";
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
                echo "<th>X</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear ) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        if($show){
                        echo "<th>X</th>";
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
                    echo "<th>X</th>";
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
                echo "<th>X</th>";
                $cont = 0;
            } else if ($cont == $ini && !$connectYear) {
                // Veerificar si la fecha es del año anterior
                if ($anio < substr($inicio, 0, 4)) {
                    echo "<th></th>";
                } else {
                    if ($a < $b) {
                        echo "<th>X</th>";
                    } else {
                        echo "<th></th>";
                    }
                }
                $cont = 0;
                $connectYear = true;
            } else if ($a < $b) {
                if ($cont == $semestral) {
                    echo "<th>X</th>";
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
