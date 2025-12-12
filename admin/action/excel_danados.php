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
header("Content-Disposition: attachment; filename=danados$extension");
header("Pragma: no-cache");
header("Expires: 0");


?>

<table cellspacing="0" style="width: 100%; border: solid 1px red; bkacground: #ca4300;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            
            <th style="width: 15%">EQUIPO</th>
            <th style="width: 20%">RESPONSABLE</th>
            <th style="width: 20%">DEPARTAMENTO</th>
            <th style="width: 20%">SUCRUSAL</th>
            <th style="width: 20%">FECHA DE RECEPCION</th>
            <th style="width: 20%">OBSERVACION</th>
            
            
        </tr>
    </table>

    <table border="1" cellspacing="0" style="width: 100%; border: solid 1px red;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php
            $danados =mysqli_query($con, "select * from danados order by id asc");
            foreach($danados as $item) {
            ?>
                
                <td><?php echo $item['equipo'] ?></td>
                <td><?php echo $item['responsable'] ?></td>
                <td><?php echo $item['departamento'] ?></td>
                <td><?php echo $item['sucursal'] ?></td>
                <td><?php echo $item['fechare'] ?></td>
                <td><?php echo $item['observacion'] ?></td>
                
            </tr>    
            <?php
                }   
            ?>     
</table>

