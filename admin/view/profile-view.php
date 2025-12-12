<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    include "header.php";
    include "sidebar.php" 
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  Perfil</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Perfil</li>
            </ol>
        </section>
         <!-- Main content -->
        <section class="content">
        <div class="row"><!-- .row -->
            <div class="col-md-1"></div>
            <div class="col-xs-12 col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div id="load_img">
                            <img class="img-responsive" width="100%" src="images/profiles/<?php echo $profile_pic ?>" alt="Imagen de Perfil">
                        </div>
                        <h3 class="profile-username text-center"><?php echo $name." ".$lastname;?></h3>
                        <p class="text-muted text-center mail-text"><?php echo $email;?></p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <span class="btn btn-my-button btn-file" style="width: 255px; margin-top: 5px;">
                    <form method="post" id="formulario" enctype="multipart/form-data">
                        Cambiar Imagen de perfil: <input type="file" name="file">
                    </form>
                </span>
                <div id="respuesta"></div><br>
            </div> 
            <div class="col-md-1"></div>
            <div class="col-xs-12 col-md-6">
                <?php 
                    if (isset($_GET)) {
                        if (isset($_GET['success'])) {
                            echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Actualizados Correctamente!</div>";
                        }
                        if (isset($_GET['success_pass'])) {
                            echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Contraseña Actualizada Correctamente!</div>";
                        }
                        if (isset($_GET['invalid'])) {
                            echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>La contraseña no coincide con la anterior!</div>";
                        }
                        if (isset($_GET['error'])) {
                            echo "<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Las nuevas  contraseñas no coinciden.!</div>";
                        }

                    }

                    ?>
                    <div class="box box-primary"><!-- general form elements -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Personales: </h3>
                        </div> <!-- /.box-header -->
                        <?php if($is_admin==1){?>
                        <form role="form" method="post" action="action/updprofile.php" ><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Nombre Usuario:</label>
                                    <input name="usuario" type="text" class="form-control" id="usuario" value="<?php echo $username ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos:</label>
                                    <input name="apellidos" type="text" class="form-control" id="apellidos" value="<?php echo $lastname ?>">
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Nueva Contraseña</label>
                                    <input name="new_password" type="password" class="form-control" id="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_password">Confirmar Nueva Contraseña</label>
                                    <input name="confirm_new_password" type="password" class="form-control" id="confirm_new_password">
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button name="token" type="submit" class="btn btn-success">Actualizar Datos</button>
                            </div>
                        </form>
                        <?php } ?>
                        <?php if($is_admin!=1){?>
                        <form role="form" method="post" action="action/updprofileemp.php" ><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Nombre Usuario:</label>
                                    <input name="usuario" type="text" class="form-control" id="usuario" value="<?php echo $username ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos:</label>
                                    <input name="apellidos" type="text" class="form-control" id="apellidos" value="<?php echo $lastname ?>">
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña Actual</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="*******">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Nueva Contraseña</label>
                                    <input name="new_password" type="password" class="form-control" id="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_password">Confirmar Nueva Contraseña</label>
                                    <input name="confirm_new_password" type="password" class="form-control" id="confirm_new_password">
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button name="token" type="submit" class="btn btn-success">Actualizar Datos</button>
                            </div>
                        </form>
                        <?php } ?>
                    </div><!-- /.box -->
                </div>
                <div class="col-md-1"></div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php include "footer.php"; ?>
<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "action/upload-profile.php";
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