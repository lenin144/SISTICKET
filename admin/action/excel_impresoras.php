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
header("Content-Disposition: attachment; filename=impresoras$extension");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table cellspacing="0" style="width: 100%; border: solid 1px red; bkacground: #ca4300;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            
            <th style="width: 15%">EQUIPO</th>
            <th style="width: 20%">RESPONSABLE</th>
            <th style="width: 20%">DEPARTAMENTO</th>
            <th style="width: 20%">SUCURSAL</th>
            <th style="width: 20%">CATEGORIA</th>
            <th style="width: 20%">DESCRIPCION</th>
            <th style="width: 20%">MARCA</th>
            <th style="width: 20%">MODELO</th>
            <th style="width: 20%">DIRECCION IP</th>
            <th style="width: 20%">ESTADO</th>
            
        </tr>
    </table>

	<table border="1" cellspacing="0" style="width: 100%; border: solid 1px red;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php
            $impresoras =mysqli_query($con, "select * from impresoras order by id asc");
            foreach($impresoras as $item) {
			?>
                
                <td><?php echo $item['equipo'] ?></td>
                <td><?php echo $item['responsable'] ?></td>
                <td><?php echo $item['departamento'] ?></td>
                <td><?php echo $item['sucursal'] ?></td>
                <td><?php echo $item['categoria'] ?></td>
                <td><?php echo $item['descripcion'] ?></td>
                <td><?php echo $item['marca'] ?></td>
                <td><?php echo $item['modelo'] ?></td>
                <td><?php echo $item['ip'] ?></td>
                <td><?php echo $item['estado'] ?></td>
			</tr>	 
			<?php
			    }	
            ?>     
</table>

