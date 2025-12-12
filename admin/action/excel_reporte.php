<?php

include "../config/config.php";

session_start();

if (!isset($_SESSION['admin_id']) and $_SESSION['admin_id'] != 1) {

    header("location: ../../");

    exit;

}



$sql_count = mysqli_query($con, "select * from tickets left join user on user.id = tickets.asigned_id");

$count = mysqli_num_rows($sql_count);

if ($count == 0) {

    echo "<script>alert('No hay Tickets agregados!')</script>";

    echo "<script>window.close();</script>";

    exit;

}



$calificaciones = [

    null=> "",

    1=>"Excelente",

    2=>"Buena",

    3=>"Regular",

    4=>"Mala",

    5=>"Pesima",

    6=>"Sin respuesta"

];



$tipo = 'excel';

$extension = '.xls';

header("Content-type: application/vnd.ms-$tipo; charset=UTF-8");

header("Content-Disposition: attachment; filename=reporte_ticket$extension");

header("Pragma: no-cache");

header("Expires: 0");

echo "\xEF\xBB\xBF"; 

// Variables por GET

$daterange = mysqli_real_escape_string($con, (strip_tags($_REQUEST['daterange'], ENT_QUOTES)));

$category = intval($_REQUEST['category']);



?>



<table cellspacing="0" style="width: 100%; border: solid 1px #16a085; background: #16a085;color:white; text-align: center; font-size: 10pt;padding:1mm;">

        <tr>

            <th style="width: 100px;">FECHA DE SOLICITUD</th>

            <th style="width: 100px;">FECHA DE RESPUESTA</th>

            <th style="width: 100px;">FECHA DE CONCLUSIÓN</th>

            <th style="width: 100px;">CODIGO</th>

            <th style="width: 100px;">EMPLEADO</th>

            <th style="width: 100px;">AREA</th>

            <th style="width: 100px;">CATEGORIA</th>

            <th style="width: 100px;">STATUS</th>

            <th style="width: 100px;">HORA DE SOLICITUD</th>

            <th style="width: 100px;">HORA DE RESPUESTA</th>

            <th style="width: 100px;">HORA DE CONCLUSIÓN</th>

            <th style="width: 100px;">TIEMPO DE RESPUESTA</th>

            <th style="width: 100px;">TIEMPO DE SOLUCIÓN</th>

            <th style="width: 100px;">NOMBRE DEL AGENTE</th>

            <th style="width: 100px;">CALIFICACIÓN</th>

            <th style="width: 100px;">RANGO HORA SOLICITUD</th>

            <th style="width: 100px;">SOLUCIÓN</th>

            <th style="width: 100px;">REPORTE</th>


        </tr>

    </table>



    <table border="1" cellspacing="0" style="width: 100%; border: solid 1px #16a085;  text-align: center; font-size: 9.5pt;padding:1mm;">

    <?php



$sTable = "tickets";



list($f_inicio, $f_final) = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol

list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial

$fecha_inicial = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles

list($dia_fin, $mes_fin, $anio_fin) = explode("/", $f_final); //Extrae la fecha final

$fecha_final = "$anio_fin-$mes_fin-$dia_fin 23:59:59";



$sWhere = "where tickets.created_at between '$fecha_inicial' and '$fecha_final' ";



if ($category > 0) {

    $sWhere .= " and status_id='$category'";

}

$sWhere .= " order by tickets.created_at desc";

$sql = "SELECT * FROM  $sTable left join user on user.id = tickets.asigned_id $sWhere";

$query = mysqli_query($con, $sql);

$sumador_total = 0;



while ($key = mysqli_fetch_array($query)) {

    $category_id = $key['status_id'];



    $category = mysqli_query($con, "select * from status where id=$category_id");

    $rw = mysqli_fetch_array($category);

    $status_name = $rw['name'];



    $tipo_requerimiento = $key['tipo_requerimiento'];

    $categorias_sql = mysqli_query($con, "select * from tipos_requerimientos where id=$tipo_requerimiento");

    $rw = mysqli_fetch_array($categorias_sql);

    $categoria = $rw['name'];



    $area = $key['area'];

    $areas_sql = mysqli_query($con, "select * from area where id=$area");

    $rw = mysqli_fetch_array($areas_sql);

    $area_name = $rw['name'];



    $client_id = $key['client_id'];

    $clients = mysqli_query($con, "select * from user where id=$client_id");

    $rows02 = mysqli_fetch_array($clients);

    if ($rows02['fullname'] != "") {

        $fullname = $rows02['fullname'];

    } else {

        $fullname = $rows02['name'] . " " . $rows02['lastname'];

    }



    ?>

            <tr>

                <td style="min-width: 100px; text-align: left"><?php echo date("d/m/Y", strtotime($key[6])); ?></td>

                <td><?php echo substr($key['asignado'], 0, 10) ?></td>

                <td><?php echo substr($key['final'] ,0,10)?></td>

                <td style="min-width: 100px; text-align: right;"><?php echo $key['number_ticket']; ?></td>

                <td style="min-width: 100px; text-align: center;"><?php echo $fullname; ?></td>

                <td style="min-width: 100px; text-align: center;"><?php echo $area_name; ?></td>

                <td style="min-width: 100px; text-align: center"><?php echo $categoria; ?></td>

                <td style="min-width: 100px; text-align: center"><?php echo $status_name; ?></td>

                <td><?php echo substr($key[6], 11,-3) ?></td>

                <td><?php echo substr($key['asignado'], 11, -3) ?></td>

                <td><?php echo substr($key['final'], 11, -3) ?></td>

                <td><?php echo getTiempo($key[6], $key['asignado']) ?></td>

                <td><?php echo getTiempo($key[6], $key['final']) ?></td>

                <td><?php echo $key['name'] . " " . $key['lastname']?> </td>

                <td><?php echo $calificaciones[$key['calificacion']] ?></td>

                <td><?php echo round (substr($key[6], 11,-3)).':00' ?></td>

                <td><?php echo $key[13]?></td>
                <td><a href="<?php echo ((isset($_SERVER['HTTPS']))?'https://'.$_SERVER['HTTP_HOST']: 'http://'.$_SERVER['HTTP_HOST'].'/ticket_cal') ?>/admin/?view=pdf_reporte&id=<?=$key[0]?>"><?php echo ((isset($_SERVER['HTTPS']))?'https://'.$_SERVER['HTTP_HOST']: 'http://'.$_SERVER['HTTP_HOST'].'/ticket_cal') ?>/admin/?view=pdf_reporte&id=<?=$key[0]?></a></td>

            </tr>

                 <?php



}



?>

    </table>

<?php

function getTiempo($a, $b)

{

    if ($a == null || $b == null) {

        return "";

    } else {

        $datetime1 = strtotime(substr($a,0,-3));

        $datetime2 = strtotime(substr($b,0,-3));

        $total = round(abs($datetime1 - $datetime2) / 60, 2);

        $minutos = $total % 60;

        $horas = ($total - $minutos) / 60;

        return $horas . ":" . $minutos;

    }

}

?>

