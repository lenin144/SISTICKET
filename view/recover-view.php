<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    // session_start();

    include "admin/config/config.php";
    include_once "lib/Helper/CryptoHelper.php";

    $code = $_GET['e'];
    $recover = mysqli_query($con,"select * from recover where code=\"$code\" ");
    $rows = mysqli_fetch_array($recover);
    $id_recover = $rows['id'];
    $user_id_recover = $rows['user_id'];
    $code_recover = $rows['code'];
    $is_used_recover = $rows['is_used'];

    if (isset($_SESSION['user_id']) AND $_SESSION['user_id'] != 0) {
        header("location: ?view=tickets");
        // header("location: tickets.php");
        exit;
    }else if(isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 0){
        // header("location: admin/dashboard.php");
        header("location: admin/?view=dashboard");
    }else if( (!isset($_GET['ui']) or $_GET['ui']=="") or (!isset($_GET['c']) or $_GET['c']=="") or (!isset($_GET['e']) or $_GET['e']=="") ){
        header("location: index.php");
    }else if(mysqli_num_rows($recover)==0){
        header("location: index.php");
    }




    $config = mysqli_query($con, "select * from configuration where name='website' ");
    $row01=mysqli_fetch_array($config);
    $website=$row01['val'];

    $fav = mysqli_query($con, "select * from configuration where name='favicon' ");
    $row02=mysqli_fetch_array($fav);
    $favicon=$row02['val'];

   /* $cadena = $_GET['ui'];
    $cadena = str_replace (' ', '+',$cadena);
    // echo $cadena; 
    $uid = CryptoHelper::decrypt($cadena);*/
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
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="login-page bg-login">
    <div class="login-box">
      <div style="color:#ca4300" class="login-logo">
        <img style="margin-top:-12px" src="assets/img/logo-blue.png" alt="Logo" height="50"> <b><?php echo $website ?></b>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
            <div id="result"></div>
            <div id="formus">
                <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Actualización de contraseña</p>
                <br/>
            <?php if($is_used_recover==0){ ?>
                <form role="form" method="post" name="upd" id="upd">
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Nueva Contraseña" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmar Nueva Contraseña" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <input type="hidden" class="form-control" name="uid" id="uid" value="<?php echo $user_id_recover; ?>" />
                    <input type="hidden" class="form-control" name="idrc" id="idrc" value="<?php echo $id_recover; ?>" />
                    <br/>
                    <div class="row">
                        <div class="col-xs-12">
                        <input type="submit" id="upd_data" class="btn btn-primary btn-lg btn-block btn-flat" name="token" value="Actualizar" />
                        </div><!-- /.col -->
                    </div>
                </form>
            </div>
            <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> 
                    Este enlace ya fue utilizado!<br>
                    Si cree que esto es un error por favor contacte al administrador...
                </div>
            <?php } ?>
            <br>
            <a href="?view=index">Iniciar Sesión</a><br>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>
<script>
$( "#upd" ).submit(function(event) {
    if($("#password").val()==$("#password_confirm").val()){
        $('#upd_data').attr("disabled", true);
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "action/recover_password.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
                $("#result").html(datos);
                $('#upd_data').attr("disabled", false);
                $("#formus").hide();
                // setInterval(function(){ location.reload(true); }, 3000);
                // load(1);
            }
        });
        event.preventDefault();
    }else{
        alert("Las contraseñas no coinciden!");
        event.preventDefault();
    }  
})

</script>