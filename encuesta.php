<?php
include "admin/config/config.php";
$calificada = false;
$success = false;
// Verifica Id
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id == null) {
    header('location: index.php');
}
// Verifica si existe
$tickets = mysqli_query($con, "select * from tickets where id = $id");
if ($tickets->num_rows < 1) {
    header('location: index.php');
} else {
    // Verifica si esta calificada
    foreach ($tickets as $item) {
        if ($item['calificacion'] != null) {
            $calificada = true;
        }
    }
}


?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Encuesta de satisfacción</title>
</head>

<body>
    <div class="container py-5">
    <h2>Encuesta de satisfacción</h2>
        <?php if($calificada==false&&$success==false) { ?>
            <form id="form" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <p>¿Cómo califica la atención brindada por el agente que lo atendió en el ticket #<?=$id?>?</p>
            <select class="form-select" name="valor" required>
                <option value="" selected>-- Seleccione una opción --</option>
                <option value="1">Excelente</option>
                <option value="2">Buena</option>
                <option value="3">Regular</option>
                <option value="4">Mala</option>
                <option value="5">Pesima</option>
                <option value="6">Sin respuesta</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </form>
        <?php } else if($calificada) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                Este ticket ya ha sido calificado por el usuario!
            </div>
        <?php }?>

    </div>



<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      El ticket ha sido calificado correctamente!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Regresar</button>
      </div>
    </div>
  </div>
</div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script>
        $("#form").submit(function (event) {

            var parametros = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "action/add_encuesta.php",
                data: parametros,
                success: function (datos) {
                    if(datos=="success"){
                        var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                            keyboard: false,
                            backdrop: 'static'
                        });
                        myModal.show();
                        document.getElementById('modal').addEventListener('hidden.bs.modal', function (event) {
                            location.href = "index.php?view=tickets";
                        });
                    }
                }
            });
            event.preventDefault();
        })
    </script>
</body>

</html>
