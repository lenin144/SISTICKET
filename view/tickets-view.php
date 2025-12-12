<?php  

    /*-------------------------

    Autor: Autor Dev

    Web: www.google.com

    E-Mail: waptoing7@gmail.com

    ---------------------------*/

    $active1="active";

    include "header.php";

?>



<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content-header">

      <h1>

        <i class="fa fa-ticket icon-title"></i> Mis Tickets

        <a style="background-color: #ca4300;color:#fff" class="btn btn- btn-social pull-right" href="?view=addticket" title="Crear Ticket" data-toggle="tooltip">

          <i class="fa fa-plus"></i> Crear Ticket

        </a>

      </h1>

    </section>

      <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-body">

                        <table id="mistickets" class="table table-bordered table-striped table-hover">

                            <thead class="table_header">

                                <tr>

                                    <th class="center">Detalle.</th>

                                    <th class="center">Nro. Ticket</th>

                                    <th class="center">Fecha -  Hora </th>

                                    <th class="center">Asunto</th>

                                    <!-- <th class="center">Descripci��n</th> -->

                                    <th class="center">Estatus</th>

                                    <th class="center">Encuesta</th>
                                    <th class="center">Reporte</th>
                                </tr>

                            </thead>

                            <tbody>

                            <?php 

                                $client_id=$_SESSION['user_id'];



                                $sql = mysqli_query($con, "SELECT * FROM tickets where client_id=$client_id and status_ticket=1 order by created_at desc");

                                foreach($sql as $client){

                                $status_id=$client['status_id'];



                                $fecha= date('d/m/Y H:i:s', strtotime($client['created_at']));

                            ?>

                                <tr>

                                    <td width='30' class='center'><a class="btn btn-default btn-xs" href="?view=ticket_detail&id=<?php echo $client['id'] ?>">Ver <span class="glyphicon glyphicon-arrow-right"></span></a></td>

                                    <td width='80' class='center'><?php echo $client['number_ticket'];?></td>

                                    <td width='180' align="center"><?php echo $fecha ?></td>

                                    <td width='100' align='center'><?php echo $client['asunt']; ?></td>

                                    <!-- <td width='100' align='left'> -->

                                        

                                    <td class='center' width='80'>

                                        <div>

                                            <?php  



                                            if($status_id==1){

                                                echo"<p style='padding:3px; margin-bottom:0; background-color:#f39c12;color:#fff;text-align:center'  class='alert alert-'>Registrado</p>";

                                                

                                            }else if($status_id==2){

                                                echo "<p style='padding:3px; margin-bottom:0; background-color:#00c0ef;color:#fff;text-align:center' class='alert alert-'>Asignado</p>";

                                            }else if($status_id==3){

                                                echo "<p style='padding:3px; margin-bottom:0; background-color:#0073b7;color:#fff;text-align:center' class='alert alert-'>En Proceso</p>

                                                ";

                                            }else{

                                                echo "<p style='padding:3px; margin-bottom:0; background-color:#00a65a;color:#fff;text-align:center'  class='alert alert-'>Finalizado</p>";

                                            }



                                        ?>

                                        </div>

                                    </td>

                                    <td class="center" width='80'>

                                        <a href="./encuesta.php?id=<?=$client['id']?>">Encuesta</a>

                                    </td>
                                    <td class="center" width="80">
                                            <?php if($status_id>3) {?>
                                                <a href="<?php echo ((isset($_SERVER['HTTPS']))?'https://'.$_SERVER['HTTP_HOST']: 'http://'.$_SERVER['HTTP_HOST'].'/ticket_cal') ?>/admin/?view=pdf_reporte&id=<?=$client['id']?>" target="_blank">Reporte</a>
                                            <?php }?>
										 </td>

                                </tr>

                        <?php

                            } //en while

                        ?>

                            </tbody>

                        </table>

                    </div><!-- /.box-body -->

                </div><!-- /.box -->

            </div><!--/.col -->

        </div>   <!-- /.row -->

    </section><!-- /.content-->

</div><!-- /.content-wrapper -->



<?php include "footer.php" ?>