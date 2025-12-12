<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $activeEnkuestor="active";
    $activeEnkuestorConfig="active";
    include "header.php";
    include "sidebar.php";

    $id=intval($_GET['id']);

    if (isset($_GET['id']) && !empty($_GET['id'])){
        $id=$_GET["id"];
    } else {
        header("Location: ?view=encuestor_configuration");  
    }

    $sql=mysqli_query($con, "select * from surveycategory where idSurveyCategory=$id");

    $rows=mysqli_fetch_array($sql);
        $id=$rows['idSurveyCategory'];
        $IdCategory=$rows['IdCategory'];
        $idSurvey=$rows['idSurvey'];
        $DateRegister=$rows['DateRegister'];

        // $created_at=date("Y-m-d H:i:s");
        $ExpireDateStar=$rows['ExpireDateStar'];
        list($dateStart,$horaStart)=explode(" ",$ExpireDateStar);
        list($Y,$m,$d)=explode("-",$dateStart);
        list($H,$i,$s)=explode(":",$horaStart);
        $fechaStart=$Y."-".$m."-".$d;
        $horaStart=$H.":".$i.":".$s;
        // echo $horaStart;

        $ExpireDateEnd=$rows['ExpireDateEnd'];
        list($dateEnd,$horaEnd)=explode(" ",$ExpireDateEnd);
        list($Y,$m,$d)=explode("-",$dateEnd);
        list($H,$i,$s)=explode(":",$horaEnd);
        $fechaEnd=$Y."-".$m."-".$d;
        $horaEnd=$H.":".$i.":".$s;


        $Active=$rows['Active'];


        $categories = mysqli_query($con,"SELECT tipos_requerimientos.id as category, area.id as area FROM tipos_requerimientos inner join area on tipos_requerimientos.area_id=area.id where tipos_requerimientos.id=$IdCategory");
        $rw_cat = mysqli_fetch_array($categories);
        $area_id = $rw_cat['area'];
        $category_id = $rw_cat['category'];
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Configuración de Encuestas</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=encuestor_configuration"><i class="fa fa-th-list"></i> Configuración de Encuestas</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-xs-12 col-md-6">
                <div id="result"></div>
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="area_id">Area</label>
                                    <select name="area_id" class="chosen-select form-control" id="area_id" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                        <?php
                                            $sql=mysqli_query($con, "select * from area");
                                            while ($row=mysqli_fetch_array($sql)) {?>
                                                <option value="<?php echo $row['id'] ?>" <?php if($row['id']==$area_id){echo"selected";} ?>><?php echo $row['name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Categoría</label>
                                    <select name="category_id" class="form-control" id="category_id" required >
                                    <?php
                                        $sql=mysqli_query($con, "select * from tipos_requerimientos");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['id'] ?>" <?php if($row['id']==$category_id){echo"selected";} ?>><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="survey_id">Encuesta</label>
                                    <select name="survey_id" class="chosen-select form-control" id="survey_id" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                        <?php
                                            $sql=mysqli_query($con, "select * from survey");
                                            while ($row=mysqli_fetch_array($sql)) {?>
                                                <option value="<?php echo $row['idSurvey'] ?>" <?php if($row['idSurvey']==$idSurvey){echo"selected";} ?>><?php echo $row['Title'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ExpireDateStar">Fecha Inicio</label>
                                            <input type="date" name="ExpireDateStar" class="form-control" id="ExpireDateStar" required="" value="<?php echo $fechaStart ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label></label>
                                            <input type="time" name="ExpireTimeStar" class="form-control" id="ExpireTimeStar" required="" value="<?php echo $horaStart ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ExpireDateEnd">Fecha Fin</label>
                                            <input type="date" name="ExpireDateEnd" class="form-control" id="ExpireDateEnd" required="" value="<?php echo $fechaEnd ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label></label>
                                            <input type="time" name="ExpireTimeEnd" class="form-control" id="ExpireTimeEnd" required="" value="<?php echo $horaEnd ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" class="chosen-select form-control" id="status" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value="1" <?php if($Active==1){echo"selected";} ?>>Activo</option>
                                        <option value="0" <?php if($Active==0){echo"selected";} ?>>Inactivo</option>
                                  </select>
                                </div>
                                <input type="hidden" name="mod_id" value="<?php echo $id ?>">
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="upd_data" class="btn btn-success">Actualizar</button>
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
$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updencuestorconfig.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#upd_data').attr("disabled", false);
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