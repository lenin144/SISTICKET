<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    // session_start();
    include "admin/config/config.php";
    if (isset($_SESSION['user_id']) AND $_SESSION['user_id'] != 0) {
        header("location: ?view=tickets");
        // header("location: tickets.php");
        exit;
    }else if(isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 0){
        // header("location: admin/dashboard.php");
        header("location: admin/?view=dashboard");
    }
    $config = mysqli_query($con, "select * from configuration where name='website' ");
    $row01=mysqli_fetch_array($config);
    $website=$row01['val'];

    $fav = mysqli_query($con, "select * from configuration where name='favicon' ");
    $row02=mysqli_fetch_array($fav);
    $favicon=$row02['val'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $website ?> | Iniciar Sesión</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="admin/images/<?php echo $favicon ?>" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/bootstrap/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="admin/https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">

    <style>
        body{
            background-color: #0858D1;
        }
        .login-box-body{
            background: #fff none repeat scroll 0 0;
            border-radius: 3px;
            border-top: 3.5px solid #ca4300;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
            color: #666;
            padding: 20px;
        }
        .login-logo{
            color:#ca4300
        }
        .form-control{
            border-radius: 4px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset
        }
    </style>
</head>
<body style="background: url('images/sgs_fondo.png');
    background-position: center center;
    background-size: cover;" class="hold-transition login-page">
<div class="login-box">
      <!-- /.login-logo -->
    <!-- /.login-logo -->
    <div class="login-box-body" style="">
        <div style="text-align: center;"><img style="margin-top:-12px; width: 175px; height: 83px; margin-bottom: 20px" src="assets/img/sgs_logo.png" alt="Logo" height="50"> <b style="display: none;"><?php echo $website ?></b></div>
        <?php if(isset($_SESSION['data'])){ ?>
            <div class="alert alert-<?php echo $_SESSION['data']['alert']; ?> fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $_SESSION['data']['notice']; ?></strong> 
                <br><?php echo $_SESSION['data']['msg']; ?>
            </div>
        <?php 
                unset($_SESSION['data']);//elimino la variable de sesion
            } 
        ?>            
       <p style="bkacground: #ca4300; color: white; padding: 10px 20px 10px 20px;" class="login-box-msg"><i class="fa fa-laptop"></i> Sistema de Tickets</p>
        <br/>
        <form action="action/login.php" method="post">
            <div style="margin-top: 9px" class="form-group has-feedback">
                <select class="form-control" autofocus name="type_session" id="type_session"  required >
                    <option value="1">Empleado</option>
                    <option value="2">Administrador/Agente</option>
                </select>
                <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
            </div>

            <div id="otro">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" autofocus name="email" id="email" placeholder="Correo Electrónico"  />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña"  />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
            </div>
            
            <div id="cliente">
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="rfc" id="rfc" placeholder="CODIGO_EMPLEADO"  />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox icheck">
                        <label>
                            <input name="session" type="checkbox"> Mantener sesión
                        </label>
                       <!-- <a style="display:none" class="pull-right" href="usuarios/usuario.xlsx">Descargue datos aquí</a>-->
                    </div>
                </div>
                <a style="color: white" class="pull-right" href="usuarios/usuario.xlsx">Olvide contraseña?</a>
                <!-- /.col -->
                <div class="row" style="margin-right: 1px;margin-left: 1px;">
                    <div class="col-md-12">
                    <input style="background: #ca4300; border-color: #ca4300" type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="token" value="Iniciar Sesión" />
                    </div><!-- /.col -->
                </div>
                <!-- /.col -->
            </div>
        </form>
        
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });


        $("#cliente").show();
        $("#otro").hide();

        $("#type_session").change(function(){
            // alert($(this).val())
            if($(this).val()==1){
                $("#cliente").show();
                $("#otro").hide();
            }else{
                $("#cliente").hide();
                $("#otro").show();
            }
        })
    });
</script>
</body>
</html>
