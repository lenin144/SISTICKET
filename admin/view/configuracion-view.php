<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active12="active";
    include "header.php";
    include "sidebar.php";

    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }

   $configuration = mysqli_query($con, "select * from configuration");
   include_once "../lib/Helper/CryptoHelper.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Configuración</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Configuración</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-xs-12 col-md-8">
                        
                <?php 
                    if (isset($_GET['succes'])){
                        ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong> Datos actualizados correctamente. 
                    </div>      
                        <?php
                    }
                ?>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title">Nueva Area</h3> -->
                    </div><!-- /.box-header -->
                    <div class="box-body with-border">
                        <form method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/updconfig.php"><!-- form start -->
                            <?php if(mysqli_num_rows($configuration)>0){
                                foreach($configuration as $cat){
                                    if ($cat['name']=="favicon") {
                                        $logo=$cat['val'];
                                    }
                                    if($cat['name']=="website"){
                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                <div class="col-md-8 col-sm-10 col-xs-12">
                                    <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                </div>
                            </div>
                            <?php 
                                } if($cat['name']=="email"){
                            ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>
                            <?php 
                                } if($cat['name']=="url_base"){
                            ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>
                            <?php 
                                } if($cat['name']=="id_website"){
                                    $id_website=CryptoHelper::decrypt($cat['val']);
                            ?>
                                <div class="form-group" style="display: none">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-4 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $id_website;?>" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-10 col-xs-12">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Enviar Invitación para descargar App</button>
                        
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                
                                <div id="loader" class="text-center"></div>
                                <div class="outer_div"></div><!-- Datos ajax Final --> 

                                <h1 class="text-center"><i class="glyphicon glyphicon-phone"></i></h1>              
                                <p class="text-center">Envía una invitación para que descargen la aplicación móvil y puedan iniciar sesión con su propia cuenta de usuario y utilizando este identificador <?php echo $id_website;?></p>
                                <div class="form-group">
                                    <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <select name="opt" id="opt" class="form-control">
                                            <option value="1">Enviar invitación a todos los usuarios de esta aplicación web</option>
                                            <option value="2">Enviar invitación a un usuario en especifico</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="correos">
                                    <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <input type="text" id="emails" name="emails" class="form-control" placeholder="Correo">
                                        <span class="text-info">Si desea ingresar mas de un correo separe los correos con una coma "," Ejemplo marco@mail.com, mario@mail.com</span>
                                    </div>
                                </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="send" class="btn btn-primary">Enviar Invitación</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                    </div>
                                </div>
                             <?php 
                                } if($cat['name']=="email_smtp"){
                            ?>
                           
                            <h3>Configuración de SMTP:</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>


                                <?php 
                                } if($cat['name']=="password_smtp"){
                            ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo utf8_encode($cat['label']) ?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" placeholder="*****" required>
                                    </div>
                                </div>



                                <?php 
                                } if($cat['name']=="name_smtp"){
                            ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>
                            <?php 
                                } if($cat['name']=="host_smtp"){
                            ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>
                                

                              <?php 
                                } if($cat['name']=="port_smtp"){
                            ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-2 col-xs-12" for="first-name"><?php echo $cat['label']?></label>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <input type="text" id="first-name" name="<?php echo $cat['name']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>      



                                <?php }  } //end foreach?>
                            <?php } //end if ?>    
                            <div class="box-footer">
                                <button name="token" type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            
        </div> 
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-xs-12 col-md-4">
                <br><br>
                <!-- general form elements -->
                <!-- <div class="box box-success"> -->
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title">Nueva Area</h3> -->
                    </div>
                    <!-- <div class="box-body"> -->
                        <div class="image view view-first text-center">
                            <img class="thumb-image" style="display: inline-block;" src="images/<?php echo $logo ?>" alt="Favicon Image">
                        </div>
                        <span class="btn btn-my-button btn-file" style="width: 345px; margin-top: 5px;">
                            <form method="post" id="formulario" enctype="multipart/form-data">
                                Cambiar Imagen de Favicon: <input type="file" name="file">
                            </form>
                        </span>
                        <div id="respuesta"></div>
                        <br>
                    <!-- </div> -->
                <!-- </div> --><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include "footer.php" ?>

<script>
    $(function(){
    $("input[name='file']").on("change", function(){
        var formData = new FormData($("#formulario")[0]);
        var ruta = "action/updsetting.php";
        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
                $("#respuesta").html(datos);
            }
        });
    });
    });
</script>
<script>
    $(document).ready(function(){

        $("#send").click(function(){
            var opt=$("#opt").val();
            var emails=$("#emails").val();
            var parametros = {"action":"ajax","opt":opt,"emails":emails};
            $.ajax({
                url:'action/sendemailShare.php',
                data: parametros,
                 beforeSend: function(objeto){
                $("#loader").html(" <div class='alert alert-info text-left'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Mensaje: </strong>Espere un momento, este proceso puede tardar unos minutos</div> <img src='./images/ajax-loader.gif'>");
              },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                    window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();});}, 5000);
                }
            })
        });

        //funcion de opciones de envio de email
        $("#correos").hide();
        $("#opt").change(function(){
            var valueSelect = $("#opt").val();
            if(valueSelect==1){
                $("#correos").hide();
            }else{
                $("#correos").show();
            }
            // alert(valueSelect)
        });


    })
</script>
