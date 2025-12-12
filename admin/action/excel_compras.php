<?php
include("../config/config.php");
session_start();
if (!isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 1) {
    header("location: ../../");
    exit;
}


$tipo = 'excel';
$extension = '.xls';
header("Content-type: application/vnd.ms-$tipo");
header("Content-Disposition: attachment; filename=compras$extension");
header("Pragma: no-cache");
header("Expires: 0");


?>

<table cellspacing="0" style="width: 100%; border: solid 1px red; bkacground: #ca4300;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            
            <th style="width: 15%">NUMERO DE COMPROBANTE</th>
            <th style="width: 20%">TIPO DE DOCUMENTO</th>
            <th style="width: 20%">NUMERO DE DOCUMENTO</th>
            <th style="width: 20%">RAZON SOCIAL</th>
            <th style="width: 20%">FECHA DE EMISION</th>
            <th style="width: 20%">BIEN O SERVICIO</th>
            <th style="width: 20%">TOTAL</th>
            
        </tr>
    </table>

    <table border="1" cellspacing="0" style="width: 100%; border: solid 1px red;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php
            $compras =mysqli_query($con, "select * from compras order by id asc");
            foreach($compras as $item) {
            ?>
                
                <td><?php echo $item['numcom'] ?></td>
                <td><?php echo $item['tipo'] ?></td>
                <td><?php echo $item['numero'] ?></td>
                <td><?php echo $item['razon'] ?></td>
                <td><?php echo $item['fecha'] ?></td>
                <td><?php echo $item['bienservicio'] ?></td>
                <td><?php echo $item['total'] ?></td>
            </tr>    
            <?php
                }   
            ?>     
</table>

