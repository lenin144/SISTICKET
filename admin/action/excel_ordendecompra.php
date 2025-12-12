<?php

include("../config/config.php");

session_start();

if (!isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 1) {

    header("location: ../../");

    exit;

}





$tipo = 'excel';
bkacground: #ca4300;
$extension = '.xls';

header("Content-type: application/vnd.ms-$tipo");

header("Content-Disposition: attachment; filename=ordendecompra$extension");

header("Pragma: no-cache");

header("Expires: 0");





?>



<table cellspacing="0" style="width: 100%; border: solid 1px red; bkacground: #ca4300;color:white; text-align: center; font-size: 10pt;padding:1mm;">

        <tr>

            <th style="width: 15%">ID_AREA</th>

            <th style="width: 15%">AREA</th>

            <th style="width: 15%">RESPONSABLE</th>

            <th style="width: 20%">NUMERO DE DE O.C.</th>

            <th style="width: 20%">PROVEEDOR</th>

            <th style="width: 20%">FECHA DE EMISION</th>

            <th style="width: 20%">BIEN O SERVICIO</th>

            <th style="width: 20%">CATEGORIA</th>

            <th style="width: 20%">MARCA</th>

            <th style="width: 20%">DESCRIPCION</th>

            <th style="width: 20%">CANTIDAD</th>

            <th style="width: 20%">PRECIO TOTAL EN SOLES</th>

            <th style="width: 20%">PRECIO TOTAL EN DOLARES</th>

            <th style="width: 20%">ORDEN DE COMPRA</th>

            

        </tr>

    </table>



    <table border="1" cellspacing="0" style="width: 100%; border: solid 1px red;  text-align: center; font-size: 9.5pt;padding:1mm;">

    <?php

            $ordendecompra =mysqli_query($con, "select * from ordendecompra order by id asc");

            foreach($ordendecompra as $item) {

            ?>

                <td><?php echo $item['id']."_".substr($item['area'],0,4) ?></td>

                <td><?php echo $item['area'] ?></td>

                <td><?php echo $item['usuario'] ?></td>

                <td><?php echo $item['numero'] ?></td>

                <td><?php echo $item['proveedor'] ?></td>

                <td><?php echo $item['fecha'] ?></td>

                <td><?php echo $item['bienservicio'] ?></td>

                <td><?php echo $item['categoria'] ?></td>

                <td><?php echo $item['marca'] ?></td>

                <td><?php echo $item['descripcion'] ?></td>

                <td><?php echo $item['cantidad'] ?></td>

                <td><?php echo $item['ptsoles'] ?></td>

                <td><?php echo $item['ptdolares'] ?></td>

                

                <td><?php 

                                            if($item['adjunto1'] != null){

                                                echo "<a href=".$item['adjunto1']." target='_blank'>Orden de compra</a>";

                                            }

                                            

                                        ?></td>

            </tr>    

            <?php

                }   

            ?>     

</table>



