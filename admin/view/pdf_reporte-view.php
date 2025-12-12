<?php

// echo $_SERVER['HTTP_HOST'];
// echo $_SERVER['SERVER_PROTOCOL'];


include "config/config.php";
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET["id"]);
} else {
    print "<script>window.location='?view=dashboard&error'</script>";
}

$sql = mysqli_query($con, "SELECT
    t.*,
    u.email,
    u.phone,
    u.business,
    CONCAT( u2.name, ' ', u2.lastname) as name2,
    u2.email AS email2,
    u2.phone AS phone2,
    tr.name as requerimiento,
    s.name as estado
    FROM
    tickets t
    INNER JOIN user
    u ON u.id = t.client_id
    INNER JOIN user
    u2 ON u2.id = t.asigned_id
    INNER JOIN tipos_requerimientos tr
    on tr.id = t.tipo_requerimiento
    INNER JOIN status s on s.id = t.status_id
    WHERE
    t.id = $id");
echo mysqli_error($con);
$rows = mysqli_fetch_array($sql);

$id_ticket = $rows['id'];
$comment = $rows['comment'];
$image = $rows['image'];
$area = $rows['area'];
$asunt = $rows['asunt'];
$client_id = $rows['client_id'];
$created_at = $rows['created_at'];
$status_id = $rows['status_id'];
$number_ticket = $rows['number_ticket'];
$asigned_id = $rows['asigned_id'];
$atendido = $rows['date_atendid'];
$date_finish = $rows['date_finish'];
$finalizado = $rows['finalizado'];
$tipo_requerimiento = $rows['tipo_requerimiento'];
$image = $rows['image'];
$email = $rows['email'];
$phone = $rows['phone'];
$business = $rows['business'];
$name2 = $rows['name2'];
$email2 = $rows['email2'];
$phone2 = $rows['phone2'];
$requerimiento = $rows['requerimiento'];
$estado = $rows['estado'];
$final = $rows['final'];

if (mysqli_num_rows($sql) == 0) {
    // print "<script>window.location='?view=mistickets'</script>";
    // print "<script>window.location='?view=dashboard&error'</script>";
}

require_once dirname(__FILE__) . '/../pdf/html2pdf.class.php';

$content = '
<div style="margin: 16px 32px;">
<br><br>
<table style="width: 100%;">
        <tr>
            <td style="width: 150px;">
                <img src="../assets/img/logo_finish2.png" alt="" style="width: 150px;">
            </td>
            <td>
                <span>Telefono: +51 914 498 397</span><br>
                <span>Email: lporras@calidra.com.mx</span><br>
                <span>Web:  www.calidraperu.com.pe</span><br>
            </td>
        </tr>
    </table>
    <br><br>
    <hr>
    <br>
    <div style="background: #E2231A; color: white; padding: 8px;">
        DATOS DE LA SOLICITUD
    </div>
    <table>
        <tr>
            <th style="text-align: start;">Fecha de solicitud</th>
            <td>' . $created_at . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Fecha de conclusión</th>
            <td>' . $date_finish . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Tiempo de solución</th>
            <td>'.getTiempo($created_at, $final).'</td>
        </tr>
        <tr>
            <th style="text-align: start;">N° de ticket</th>
            <td>' . $number_ticket . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Status</th>
            <td>' . $estado . '</td>
        </tr>
    </table>
    <br><br>
    <div style="background: #E2231A; color: white; padding: 8px;">
        DATOS DEL EMPLEADO
    </div>
    <table>
        <tr>
            <th style="text-align: start;">Correo</th>
            <td>' . $email . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Celular</th>
            <td>' . $phone . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Empresa</th>
            <td>' . $business . '</td>
        </tr>
    </table>
    <br><br>
    <div style="background: #E2231A; color: white; padding: 8px;">
        DATOS DEL AGENTE
    </div>
    <table>
        <tr>
            <th style="text-align: start;">Nombre</th>
            <td>' . $name2 . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Correo</th>
            <td>' . $email2 . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Número</th>
            <td>' . $phone2 . '</td>
        </tr>
    </table>
    <br><br>
    <div style="background: #E2231A; color: white; padding: 8px;">
        DATOS DEL SERVICIO
    </div>
    <table>
        <tr>
            <th style="text-align: start;">Descripción</th>
            <td>' . $comment . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Problema o categoría</th>
            <td>' . $requerimiento . '</td>
        </tr>
        <tr>
            <th style="text-align: start;">Solución</th>
            <td>' . $finalizado . '</td>
        </tr>
    </table>
</div>';

function getTiempo($a, $b)
{
    if ($a == null || $b == null) {
        return "";
    } else {
        $datetime1 = strtotime(substr($a, 0, -3));
        $datetime2 = strtotime(substr($b, 0, -3));
        $total = round(abs($datetime1 - $datetime2) / 60, 2);
        $minutos = $total % 60;
        $horas = ($total - $minutos) / 60;
        return $horas . ":" . $minutos;
    }
}

try
{
    // init HTML2PDF
    $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // display the full page
    $html2pdf->pdf->SetDisplayMode('fullpage');
    // convert
    $html2pdf->writeHTML($content);
    // send the PDF
    $html2pdf->Output('reporte_ticket.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
