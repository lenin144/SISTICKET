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
header("Content-Disposition: attachment; filename=licencias$extension");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table cellspacing="0" style="width: 100%; border: solid 1px red; bkacground: #ca4300;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            
            <th style="width: 15%">EQUIPO</th>
            <th style="width: 20%">RESPONSABLE</th>
            <th style="width: 20%">DEPARTAMENTO</th>
            <th style="width: 20%">SUCURSAL</th>
            <th style="width: 20%">PROGRAMA</th>
            <th style="width: 20%">LICENCIA</th>
            <th style="width: 20%">CORREO</th>
            <th style="width: 20%">CLAVE</th>
            <th style="width: 20%">FECHA DE REGISTRO</th>
            <th style="width: 20%">FECHA DE VENCIMIENTO</th>
            <th style="width: 20%">ESTADO</th>
            <th style="width: 20%">OBSERVACION</th>
            <th style="width: 20%">NOMBRE DE PROVEEDOR</th>
            <th style="width: 20%">NUMERO DE PROVEEDOR</th>
            
        </tr>
    </table>

	<table border="1" cellspacing="0" style="width: 100%; border: solid 1px red;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php
            $licencias =mysqli_query($con, "select * from licencias order by id asc");
            foreach($licencias as $item) {
			?>
                
                <td><?php echo $item['equipo'] ?></td>
                <td><?php echo $item['responsable'] ?></td>
                <td><?php echo $item['departamento'] ?></td>
                <td><?php echo $item['sucursal'] ?></td>
                <td><?php echo $item['programa'] ?></td>
                <td><?php echo $item['licencia'] ?></td>
                <td><?php echo $item['correo'] ?></td>
                <td><?php echo $item['clave'] ?></td>
                <td><?php echo $item['fechareg'] ?></td>
                <td><?php echo $item['fechaven'] ?></td>
                <td><?php echo $item['estado'] ?></td>
                <td><?php echo $item['observacion'] ?></td>
                <td><?php echo $item['nompro'] ?></td>
                <td><?php echo $item['numpro'] ?></td>
			</tr>	 
			<?php
			    }	
            ?>     
</table>

