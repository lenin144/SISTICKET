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
header("Content-Disposition: attachment; filename=proveedor$extension");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table cellspacing="0" style="width: 100%; border: solid 1px red; bkacground: #ca4300;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            
            <th style="width: 15%">TIPO DE DOCUMENTO</th>
            <th style="width: 20%">NUMERO DE DOCUMENTO</th>
            <th style="width: 20%">RAZON SOCIAL</th>
            <th style="width: 20%">DIRECCION</th>
            <th style="width: 20%">NOMBRE DEL VENDEDOR</th>
            <th style="width: 20%">CELULAR</th>
            <th style="width: 20%">CORREO</th>
            
        </tr>
    </table>

	<table border="1" cellspacing="0" style="width: 100%; border: solid 1px red;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php
            $proveedor =mysqli_query($con, "select * from proveedor order by id asc");
            foreach($proveedor as $item) {
			?>
                
                <td><?php echo $item['tipo'] ?></td>
                <td><?php echo $item['numero'] ?></td>
                <td><?php echo $item['razon'] ?></td>
                <td><?php echo $item['direccion'] ?></td>
                <td><?php echo $item['nombre'] ?></td>
                <td><?php echo $item['celular'] ?></td>
                <td><?php echo $item['correo'] ?></td>
			</tr>	 
			<?php
			    }	
            ?>     
</table>

