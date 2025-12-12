<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active15="active";
    include "header.php";
    include "sidebar.php";
    

    $referencia = explode('view=', $_SERVER['HTTP_REFERER']);
    if ($referencia[1]==="cause_solution") {
        unset($_SESSION["cart_contents"]);
    }

    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }

    include 'action/myLibAbisoftINC.php';
    $cart = new Cart;
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Causa de Solución</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=cause_solution"><i class="fa fa-th-list"></i> Causa de Solución</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8">
                <div id="result"></div>
                <div id="resultados_ajax"></div>
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nuevo Causa de Solución</h3>
                        </div><!-- /.box-header -->
                        <form role="form" method="post" name="add" id="add"> <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Description">Causa de Solución</label>
                                    <input type="text" name="Description" class="form-control" id="Description" placeholder="Motivo de Solución">
                                </div>


                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="area_id">Area</label>
                                        <select name="area_id" class="select2 form-control" id="area_id">
                                            <option value="">--SELECCIONAR--</option>
                                        <?php
                                            $sql=mysqli_query($con, "select * from area");
                                            while ($row=mysqli_fetch_array($sql)) {?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                      </select>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Categoría</label>
                                            <select name="category_id" class="select2 form-control" id="category_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a style="margin-top: 24px;" class="btn btn-success" onclick="value_cat();">Agregar</a>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <table id="tableSolution" class="table table-bordered table-striped">
                                        <thead class="table_header">
                                            <tr>
                                                <th>Area</th>
                                                <th>Categoría</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // echo $cart->total_items();
                                            // if($cart->total_items() > 0){
                                                //get cart items from session
                                                $cartItems = $cart->contents();
                                                foreach($cartItems as $item){
                                            ?>
                                            <tr>
                                                <td><?php echo $item["area"]; ?></td>
                                                <td>
                                                    <?php echo $item["categoria"]; ?>
                                                    <ul style="list-style: none; display: none">
                                                        <li>
                                                            <input id="categories" name="categories[]" type="checkbox" value="<?php echo $item["id"]; ?>" checked>
                                                        </li>
                                                    </ul> 
                                                </td>
                                                <td style="width: 80px">
                                                    <a href="action/addcause_solution_tmp.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>&opt=add" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php  ?>    
                                        </tbody>
                                 <?php } //}else{ ?>
                                    <!-- <tr><td colspan="5"><p>Aun no hay datos...</p></td> -->
                                    <?php// } ?>
                                    </table>
                                </div>
                                




                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" class="chosen-select form-control" id="status" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value="1" >Activo</option>
                                        <option value="0" >Inactivo</option>
                                    </select>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Guardar Cambios</button>
                                <a style="margin-left: 20px;" class="btn btn-default" href="javascript:history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>   
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

  <?php include "footer.php" ?>

<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addsolution.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

</script>
<script type = "text/javascript">
    $(document).ready(function(){
        $('#area_id').on('change', function(){
            if($('#area_id').val() == ""){
                $('#category_id').empty();
                $('<option value = "">Selecciona un Categoría</option>').appendTo('#category_id');
                $('#category_id').attr('disabled', 'disabled');
            }else{
                $('#category_id').removeAttr('disabled', 'disabled');
                $('#category_id').load('ajax/categories_get.php?area_id=' + $('#area_id').val());
                // alert($('#category_id').val());
            }
        });
    });
</script>
<script>
    function value_cat(){
        // alert($('#category_id').val());
        var category_id = $('#category_id').val();
        if(category_id>0){
            location.href="action/addcause_solution_tmp.php?action=addToCart&id="+category_id+"&opt=add";
        }else{
            alert("No ah seleccionado la categoría");
        }
    }
</script>