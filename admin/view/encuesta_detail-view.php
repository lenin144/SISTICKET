<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/  
    $active2="active";
    $active4="active";
    include "header.php";
    include "sidebar.php";

    if ( !isset($_REQUEST['id']) or $_REQUEST['id'] == "") {
        // header("location: 404");
        print "<script>window.location='?view=dashboard&error';</script>";
        exit;
    }

    $id = intval($_GET['id']);

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

    $fullname=$name." ".$lastname;

    if (mysqli_num_rows($sql)==0) {
        print "<script>window.location='?view=dashboard&error';</script>";
    }
    
?>

  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Encuesta</h1>
      </section>
      <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box box-primary">
                    <div class="box-body">
                        <div id="result"></div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="col-md-12 text-center">
                                    <input type="text" class="knob" value="<?php echo $Porcentage ?>" data-width="80" data-height="80" data-fgColor="#ca4300" disabled="">
                                    <div class="knob-label"><!-- New Visitors --></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>
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
                            <div class="col-md-2">
                                <a style="margin-left: 20px;" class="btn btn-default pull-right" href="javascript:history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
                            </div>
                        </div>
    
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
                                                <input 
                                                    required 
                                                    type="radio" 
                                                    name="response_encuestor_<?php echo $key['idQuestion'] ?>" 
                                                    id="response_encuestor_<?php echo $resp['idResponse'] ?>"
                                                    value="<?php echo $resp['idResponse'] ?>"
                                                    <?php if($resp['Selected']==1){echo "checked";} ?>
                                                    disabled
                                                >
                                                    <?php echo $resp['Description'] ?>
                                                <br>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php $count++; } ?>
                        <div class="col-md-12">
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
<?php include "footer.php" ?>

<!-- jQuery Knob -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- page script -->
<script>
$(function () {
    $(".knob").knob({
        draw: function () {
        
        }
    });
});
  
  
</script>