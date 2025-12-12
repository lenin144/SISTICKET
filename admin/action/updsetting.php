<?php
    
    session_start();

    

    include "../config/config.php";

    if (isset($_FILES["file"]))
    {
        $file = $_FILES["file"];
        $nombre = $file["name"];
        $tipo = $file["type"];
        $ruta_provisional = $file["tmp_name"];
        $size = $file["size"];
        $carpeta = "../images/";
        
        if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
        {
          //echo "Error, el archivo no es una imagen"; 
            echo "<br><div class='alert alert-info' role='alert'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>¡Error!</strong> El archivo no es una imagen!
            </div>";
        }
        else if ($size > 1024*1024)
        {
          //echo "Error, el tamaño máximo permitido es un 1MB";
            echo "<br><div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>¡Error!</strong> El tamaño máximo permitido es un 1MB!
            </div>";
        }
        else
        {
            $src = $carpeta.$nombre;
           @move_uploaded_file($ruta_provisional, $src);

           $query=mysqli_query($con, "UPDATE configuration set val=\"$nombre\" where name='favicon'");
           if($query){
            echo "<br><div class='alert alert-success' role='alert'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>¡Bien hecho!</strong> Favicon Actualizado Correctamente
            </div>";
           }else{
           // echo "error".mysqli_error($con);
           }
        }
    }

?>