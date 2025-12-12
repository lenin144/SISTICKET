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
    <title><?php echo $website ?> | Restablecer contraseña</title>
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
<body class="hold-transition login-page">
<div class="login-box">
      <div class="login-logo">
        <img style="margin-top:-12px" src="assets/img/logo-blue.png" alt="Logo" height="50"> <b><?php echo $website ?></b>
      </div><!-- /.login-logo -->
    <!-- /.login-logo -->
    <div class="login-box-body" style="">
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
        <p class="login-box-msg"><i class="fa fa-lock icon-title"></i> Restablecer contraseña</p>
        <br/>
        <form action="action/reset_password.php" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Correo Electrónico" required />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="token" value="Restablecer" />
                    </div><!-- /.col -->
                </div>
            </form>
            <br>
            <a href="./">Iniciar Sesión</a><br>
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
    });
</script>
</body>
</html>
