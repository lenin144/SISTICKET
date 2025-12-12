<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/  

    // session_start();
    include "admin/config/config.php";
    include "lib/Helper/CryptoHelper.php";
    if (!isset($_REQUEST['token']) or $_REQUEST['token'] == "" or !isset($_REQUEST['c']) or $_REQUEST['c'] == "") {
        header("location: 404");
        exit;
    }
    $var =urldecode( $_REQUEST['token']);
    // $idticket  = CryptoHelper::decrypt($var);

    //datos del ticket
    $id = intval($_GET['c']);
    // $sql = mysqli_query($con,"SELECT tickets.asunt,user.name,user.lastname,user.email FROM `tickets`  inner join user on tickets.asigned_id=user.id WHERE tickets.id=$id");
    $sql = mysqli_query($con,"SELECT surveyticket.DateCompleted,surveyticket.Porcentage,surveyticket.idSurvey,surveyticket.idSurveyTicket,surveyticket.IdTicket,tickets.asunt,tickets.created_at, tickets.date_atendid, user.name,user.lastname,user.email FROM `surveyticket` inner join tickets on surveyticket.IdTicket=tickets.id inner join user on surveyticket.IdUserAgent=user.id where surveyticket.idSurveyTicket=$id");
    $rw=mysqli_fetch_array($sql);
    $asunt=$rw['asunt'];
    $name=$rw['name'];
    $lastname=$rw['lastname'];
    $email=$rw['email'];
    $IdTicket=$rw['IdTicket'];
    $idSurvey=$rw['idSurvey'];
    $DateCompleted=$rw['DateCompleted'];
    $Porcentage=$rw['Porcentage'];

    

    list($dateEnd,$horaEnd)=explode(" ",$rw['created_at']);
    list($Y,$m,$d)=explode("-",$dateEnd);
    list($H,$i,$s)=explode(":",$horaEnd);
    $fechaEnd=$d."/".$m."/".$Y;
    $horaEnd=$H.":".$i." hrs";
    $created_at = $fechaEnd." ".$horaEnd;

    list($dateEnd,$horaEnd)=explode(" ",$rw['date_atendid']);
    list($Y,$m,$d)=explode("-",$dateEnd);
    list($H,$i,$s)=explode(":",$horaEnd);
    $fechaFinish=$d."/".$m."/".$Y;
    $horaFinish=$H.":".$i." hrs";
    $date_atendid = $fechaFinish." ".$horaFinish;



    // $fullname=$name." ".$lastname." <b>($email)</b>";
    $fullname=$name." ".$lastname;



    if (mysqli_num_rows($sql)==0) {
       header("location: 404");
    }
    

    $config = mysqli_query($con, "select * from configuration where name='website' ");
        $row1=mysqli_fetch_array($config);
        $website=$row1['val'];

    $fav = mysqli_query($con, "select * from configuration where name='favicon' ");
        $row2=mysqli_fetch_array($fav);
        $favicon=$row2['val'];  
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="admin/images/<?php echo $favicon ?>" />
    <title><?php echo $website ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/css/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="admin/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="admin/css/public.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-yellow-light layout-top-nav">
<div class="wrapper">

  <header class="main-header" >
    <nav class="navbar navbar-static-top" style="background-color:#0858D1;">
      <div class="container" >
        <div class="navbar-header" >
          <a  href="#" class="navbar-brand"><b>Ticketly</b> Pro</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index">Iniciar Sesion</a></li>
          </ul>

        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Encuesta</h1>
      </section>
    <?php
        //estado del ticket actual
            $tickets=mysqli_query($con,"select * from tickets where id=$IdTicket");
            $rw_ticket=mysqli_fetch_array($tickets);
            $tipo_requerimiento=$rw_ticket['tipo_requerimiento'];
        //fin

        //evaluo si la encuesta aun esta activa y esta en el rango:
        $encuestorCheck = mysqli_query($con,"SELECT * FROM surveycategory WHERE (
        (ExpireDateStar <= NOW() AND ExpireDateEnd >= NOW())
            OR ExpireDateEnd BETWEEN NOW() AND NOW()
            OR ExpireDateEnd BETWEEN NOW() AND NOW()
        )
        and IdCategory=$tipo_requerimiento
        and Active=1");
        if(($DateCompleted==null or $Porcentage==null) and mysqli_num_rows($encuestorCheck)>0): 
    ?>
      <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- <div class="col-md-1"></div> -->
                <div class="box box-primary">
                    <div class="box-body">
                        <div id="result"></div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <span><b>No. Ticket</b></span>
                                    <span><?php echo $IdTicket; ?></span>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <span><b>Asunto</b></span>
                                    <span><?php echo $asunt ?></span>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <span><b>Agente</b></span>
                                    <span><?php echo $fullname ?></span>
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <span><b>Fecha de registro y finalización</b></span>
                                <ul class="timeline">
                                    <li class="time-label" style="font-size: 12px">
                                        <span class="bg-red">
                                            <?php echo $created_at ?>
                                        </span>
                                    </li>
                                    <li class="time-label" style="font-size: 12px">
                                        <span class="bg-red">
                                            <?php echo $date_atendid ?>
                                        </span>
                                       
                                    </li>
                                </ul>
                            </div>
                        </div>
                <form method="post" enctype="multipart/form-data" name="add" id="add">
                        <?php  
                            $questions = mysqli_query($con,"select * from surveyticketquestion where idSurvey=$idSurvey and idTicket=$IdTicket");
                            $count=1;
                            foreach ($questions as $key) {

                                $idQuestion= $key['idQuestion'];
                        ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radio">
                                    <label><?php echo $count; ?>. <?php echo $key['Description'] ?></label>
                                    <br>
                                    <?php  
                                        $response = mysqli_query($con,"select * from surveyticketresponse where idQuestion=$idQuestion");
                                        foreach ($response as $resp) {
                                    ?>
                                        <div class="col-md-12" style="padding-left: 35px">
                                            <label for="response_encuestor_<?php echo $resp['idResponse'] ?>">
                                                <input required type="radio" name="response_encuestor_<?php echo $key['idQuestion'] ?>" id="response_encuestor_<?php echo $resp['idResponse'] ?>" value="<?php echo $resp['idResponse'] ?>"><?php echo $resp['Description'] ?><br>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php $count++; } ?>
            
                        <div class="col-md-12">
                            <br><br>
                            <button id="save_data" type="submit" class="btn btn-primary">Guardar</button>
                            <!-- <button class="btn btn-default">Regresar</button> -->
                        </div>
                </form> 
                <div class="col-md-12  text-center">
                    <div id="sesions" style="display: none">
                        <a href="index" class="btn btn-primary">Iniciar Sesión</a>
                    </div>
                    <br><br>
                </div>      
                    </div>
                </div>
            </div>
        </section>
        <?php else: ?>
        <section class="content">
            <div class="row">
                <!-- <div class="col-md-1"></div> -->
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="alert alert-" role="alert">
                            <strong>Advertencia!</strong> <br>
                            <!-- Esta encuesta ya fue resuelta correctamente, puede que ya haya caducido o ya no este activa... -->
                            <p>Posibles casos de la advertencia:</p>
                            <ul>
                                <li>1. Encuesta ya fue resuelta correctamente.</li>
                                <li>2. Haya Caducido</li>
                                <li>3. o ya no este activa</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

<footer class="main-footer"><!-- /.content-wrapper -->
    <div class="pull-right hidden-xs">
      <b>Version Pro</b> 2.0
    </div>
    <!-- <strong>2014-<?php echo date("Y")?> <a target="_blank" href="http://abisoftgt.net">Soporte</a>.</strong> by: <a target="_blank" href="http://abisoftgt.net">Abisoft</a> -->
    <strong><?php echo $website ?> ||  2015 - <?php echo date('Y') ?> <a target="_blank" href="https://www.google.com/">Calidra Peru</a> </strong>
</footer><!-- ./wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>

<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/responsesurvey.php?idSurveyTicket=<?php echo $id ?>",
            data: parametros,
            beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
            },
            success: function(datos){
                window.setTimeout(function() {
                    $("#result").html(datos);
                    $('#save_data').attr("disabled", false);
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove();
                        });
                        $("#add").css("display","none");
                        $("#sesions").css("display","inline-block");
                        // window.location.href = "encuestor?token=<?php echo $var ?>&c=<?php echo $id ?>&ui=<?php echo $_GET['ui'] ?>";
                    }, 2500);
                }, 1000);
            }
           
    });
  event.preventDefault();
})

</script>

<script type="text/javascript">
    /*$(document).ready(function(){
        $("#enviar").click(function(e){  
            <?php foreach ($questions as $data) {
            ?>
            // alert($('input:radio[name=response_encuestor_<?php echo $data['idQuestion'] ?>]:checked').val());
            // $("#formulario").submit();
            <?php  } ?>
            e.preventDefault();
        });
    });*/
</script>

</body>
</html>