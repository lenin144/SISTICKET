<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active1="active";
    include "header.php";

if (isset($_GET['id']) && !empty($_GET['id'])){
        $id=intval($_GET["id"]);
    } else {
       print "<script>window.location='?view=tickets&error'</script>";
    }

    $sql = mysqli_query($con, "select * from tickets where id=$id");
    $rows= mysqli_fetch_array($sql);
        $id_ticket= $rows['id'];
        $comment= $rows['comment'];
        $image= $rows['image'];
        $area= $rows['area'];
        $asunt= $rows['asunt'];
        $client_id= $rows['client_id'];
        $created_at= $rows['created_at'];
        $status_id= $rows['status_id'];
        $number_ticket= $rows['number_ticket'];
        $asigned_id= $rows['asigned_id'];
        $atendido= $rows['date_atendid'];
        $finalizado=$rows['finalizado'];
        $tipo_requerimiento=$rows['tipo_requerimiento'];
        $image=$rows['image'];


    if (mysqli_num_rows($sql)==0) {
        print "<script>window.location='?view=tickets'</script>";
    }

    //tipo requerimiento
    $requerimientos=mysqli_query($con, "select * from tipos_requerimientos where id=$tipo_requerimiento");
    $rows2=mysqli_fetch_array($requerimientos);
    $name_require=$rows2['name'];

    if ($asigned_id!=0) {
        $user_id=$asigned_id;
        $user=mysqli_query($con, "select * from user where id=$user_id");
            $row=mysqli_fetch_array($user);
            $name_user=$row['name'];
            $lastname_user=$row['lastname'];
    }

    $status=mysqli_query($con, "select * from status where id=$status_id");
    $rows02=mysqli_fetch_array($status);
    $name_status=$rows02['name'];

    $clientes_sql=mysqli_query($con,"select * from user where id=$client_id and is_client=1");
    $rw_client=mysqli_fetch_array($clientes_sql);
    $name_client=$rw_client['business'];

?>

<form class="form-horizontal" method="post" id="files_ticket" name="files_ticket">
    <div class="modal fade" id="modal_files_ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Archivos</h4>
                </div>
                <div class="modal-body">
                    <div id="resultados_comentario"></div>
                    <div id="loader2" class="text-center"></div>
                    <div class="outer_div2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form class="form-horizontal" method="post" id="files_bitacora" name="files_bitacora">
    <div class="modal fade" id="modal_files_bitacora" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Archivos</h4>
                </div>
                <div class="modal-body">
                    <div id="resultados_comentario"></div>
                    <div id="loader2" class="text-center"></div>
                    <div class="outer_div2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb">
              <li><a href="?view=tickets"><i class="fa fa-ticket"></i> Mis Tickets </a></li>
              <li class="active"> Detalles Ticket </li>
            </ol>
        </section>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default pull-right" href="?view=tickets"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
            </div>
            <br>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom"><!-- Custom Tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Detalle</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Seguimiento de ticket</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <!-- form start -->
                                <form role="form" class="form-horizontal" action="action/addticket.php" method="POST" enctype="multipart/form-data">
                                    <div class="box-body">  


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Numero Ticket:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $number_ticket ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Cliente:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $name_client ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                
                                                    <?php
                                                        if($rows['status_id']==1){
                                                                echo "<span class='label label-warning'>Registrado</span>";
                                                        }else if($rows['status_id']==2){
                                                                echo "<span class='label label-info'>Asignado</span>";
                                                        }else if($rows['status_id']==3){
                                                                echo "<span class='label label-primary'>En Proceso</span>";
                                                        }else if($rows['status_id']==4){
                                                                echo "<span class='label label-success'>Finalizado</span>";
                                                        }else if($rows['status_id']==5){
                                                                echo "<span class='label label-danger'>Cancelado</span>";
                                                        }
                                                    ?>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fecha Registro:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $created_at ?>" readonly>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Asunto:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $asunt ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Descripción:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12" readonly><?php echo  $comment ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Area:
                                            </label>
                                            <?php 
                                                $areas = mysqli_query($con,"select * from area where id=$area");
                                                $rw_area=mysqli_fetch_array($areas);
                                                $name_area=$rw_area['name'];
                                            ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $name_area ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Categoria:
                                            </label>
                                            <?php 
                                            $categorias = mysqli_query($con,"select * from tipos_requerimientos where id=$tipo_requerimiento");
                                            $rw_categorias=mysqli_fetch_array($categorias);
                                            $name_category=$rw_categorias['name'];
                                            ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $name_category ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Agente:
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php if($asigned_id==0){ ?>
                                                <input type="text"  class="form-control col-md-7 col-xs-12" value="Sin Asignar" readonly>
                                            <?php }else{ ?> 
                                                <input type="text"  class="form-control col-md-7 col-xs-12" value="<?php echo $name_user." ".$lastname_user ?>" readonly>
                                            <?php } ?>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Solución</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <?php if($finalizado==""){?>
                                                    <textarea  class="form-control col-md-7 col-xs-12" readonly><?php echo "EN ESPERA..." ?></textarea>
                                                <?php
                                                }else{
                                                ?> 
                                                    <textarea style="color: white;background-color: #f39c12" class=" form-control col-md-7 col-xs-12" readonly><?php echo $finalizado ?></textarea>
                                                <?php
                                                }
                                                ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" ><!-- Descargar Adjuntos: -->
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php 
                                                        $contadorArchivo = mysqli_query($con,"select * from documentticket where idTicket='$id'");

                                                    ?>
                                                   <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal_files_ticket" onclick="show_files_ticket('<?php echo $id;?>');"><i class="fa fa-paperclip"></i> Ver Documentos (<?php echo mysqli_num_rows($contadorArchivo) ?>)</a>
                                                </div>
                                            </div>
                                       </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="tab_2"><!-- /.tab-pane -->
                                <div class="row">
                                    <div class="col-md-12 table-responsive">            
                                        <table id="ticketDetail" class="table table-bordered table-striped">
                                        <!-- <table class="table table-bordered table-striped"> -->
                                            <?php
                                                $sql_bitacora=mysqli_query($con,"SELECT * from log_bitacora where ticket_id=$id ORDER BY id desc"); 
                                            ?>
                                            <thead class="table_header">
                                                <tr>
                                                    <th>Descripci&oacute;n</th>
                                                    <th>Fecha Registro</th>
                                                    <th>Fecha Bitacora</th>
                                                    <th>Usuario</th>
                                                    <th>Estatus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($sql_bitacora as $bitacoras): 
                                                    $id_bitacora = $bitacoras['id'];

                                                    $fecha_registro= date('d/m/Y H:i:s', strtotime($bitacoras['created_at']));
                                                    $fecha_bitacora= date('d/m/Y H:i:s', strtotime($bitacoras['dateBitacora']));

                                                    $idUser=$bitacoras['idUser'];
                                                    $users=mysqli_query($con,"select * from user where id=$idUser");
                                                    $rw_user=mysqli_fetch_array($users);

                                                    if($rw_user['fullname']!=""){
                                                        $user=$rw_user['fullname'];
                                                    }else{
                                                        $user=$rw_user['name']." ".$rw_user['lastname'];
                                                    }
                                                    $files_bitacora = mysqli_query($con,"select * from documentbitacora where idBitacora=$id_bitacora");
                                                    $rw_files_bitacora = mysqli_fetch_array($files_bitacora);
                                                ?>
                                                <tr>
                                                    <td><?php echo $bitacoras['comment'] ?></td>
                                                    <td><?php echo $fecha_registro ?></td>
                                                    <td><?php echo $fecha_bitacora ?></td>
                                                    <td><?php echo $user; ?></td>
                                                    <td>
                                                        <?php
                                                            if($bitacoras['idStatus']==1){
                                                                echo "<span class='label label-warning'>Registrado</span>";
                                                            }else if($bitacoras['idStatus']==2){
                                                                echo "<span class='label label-info'>Asignado</span>";
                                                            }else if($bitacoras['idStatus']==3){
                                                                echo "<span  class='label label-primary'>En Proceso</span>";
                                                            }else if($bitacoras['idStatus']==4){
                                                                echo "<span  class='label label-success'>Finalizado</span>";
                                                            }else if($bitacoras['idStatus']==5){
                                                                echo "<span  class='label label-danger'>Cancelado</span>";
                                                            }

                                                            if(mysqli_num_rows($files_bitacora)>0){
                                                        ?>
                                                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal_files_bitacora" onclick="show_files_bitacora('<?php echo $id_bitacora;?>');"><i class="fa fa-paperclip"></i></a>
                                                    <?php } ?>
                                                    </td>
                                                </tr>   
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
        </section><!-- /.content -->
    </div>
<?php include "footer.php" ?>


<script>
    function show_files_ticket(id){
        var parametros = {"action":"ajax","id":id};
        $.ajax({
            url:'ajax/show_files_ticket.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loader2").html("<img src='images/ajax-loader.gif'>");
          },
            success:function(data){
                $(".outer_div2").html(data).fadeIn('slow');
                $("#loader2").html("");
            }
        })
    }   
    function show_files_bitacora(id){
        var parametros = {"action":"ajax","id":id};
        $.ajax({
            url:'ajax/show_files_bitacora.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loader2").html("<img src='images/ajax-loader.gif'>");
          },
            success:function(data){
                $(".outer_div2").html(data).fadeIn('slow');
                $("#loader2").html("");
            }
        })
    }   
</script>