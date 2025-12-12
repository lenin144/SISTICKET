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
    <meta charset="UTF-8">
    <title><?php echo $website ?> | Iniciar Session</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- favicon -->
    <link rel="shortcut icon" href="admin/images/<?php echo $favicon ?>" />

    <!-- Bootstrap 3.3.2 -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="login-page bg-login">
    <div class="login-box">
      <div style="color:#ca4300" class="login-logo">
        <img style="margin-top:-12px" src="assets/img/logo-blue.png" alt="Logo" height="50"> <b><?php echo $website ?></b>
      </div><!-- /.login-logo -->
      
      <div class="login-box-body">
        <?php 

            /*if (isset($_GET['invalid'])) {
                echo "<div style='background-color:#dd4b39;color:#fff' class='alert alert- alert-dismissible fade in' role='alert'>
                    <strong>Error!</strong> Correo Electrónico y/o Contraseña son incorrectos!.
                    </div>";
            }

             if (isset($_GET['ban'])) {
                echo "<div style='background-color:#dd4b39;color:#fff' class='alert alert- alert-dismissible fade in' role='alert'>
                    <strong>Error!</strong> Lo sentimos la cuenta fue baneada, contacte al administrador.
                    </div>";
            }

            if (isset($_GET['inactive'])) {
                echo "<div style='background-color:#dd4b39;color:#fff' class='alert alert- alert-dismissible fade in' role='alert'>
                    <strong>Error!</strong> Lo sentimos la cuenta esta inactiva, contacte al administrador.
                    </div>";
            }*/
        ?>
        <?php if(isset($_SESSION['data'])){ ?>
            <div class="alert alert-<?php echo $_SESSION['data']['alert']; ?> fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $_SESSION['data']['notice']; ?></strong> <?php echo $_SESSION['data']['msg']; ?>
            </div>
        <?php 
                unset($_SESSION['data']);//elimino la variable de sesion
            } 
        ?>
            <p style="bkacground: #ca4300; color: white; padding: 10px 20px 10px 20px;" class="login-box-msg"><i class="fa fa-laptop"></i> Sistema de Tickets Calidra Perú</p>
            <br/>
            <form action="action/login.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" autofocus name="email" placeholder="Correo Electrónico" required />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="token" value="Ingresar" />
                    </div><!-- /.col -->
                </div>
            </form>
            <br>
            <a href="?view=reset_password">Olvidaste tu contraseña?</a><br>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>