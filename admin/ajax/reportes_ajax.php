<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_expence=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from tickets where id='".$id_expence."'");
        $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM tickets WHERE id='".$id_expence."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
    <?php 
        }else{
    ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
<?php
        } //end else
    } //end if
?>
    <?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
		  $status=intval($_REQUEST['category']);
        
         $sTable = "tickets";
         $sWhere = "";
		
		list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where created_at between '$fecha_inicial' and '$fecha_final' ";
		
			if ($status>0){
				$sWhere .=" and status_id='$status'";
			}
			
			
		 
        $sWhere.=" and status_ticket=1";
        $sWhere.=" order by created_at desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './reportes.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped table-bordered table-hover">
                <thead class="table_header">
                    <tr>
                        <th class="column-title">Fecha </th>
                        <th class="column-title">Codigo </th>
                        <!-- <th class="column-title">Nombre </th> -->
                        <th class="column-title">Cliente </th>
                        <th class="column-title">Estatus </th>
                        <!-- <th class="column-title no-link last"><span class="nobr"></span></th> -->
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];
                            $created_at=date('d/m/Y', strtotime($r['created_at']));
                            $asigned_id=$r['asigned_id'];
                            $number_ticket=$r['number_ticket'];
                            $status_id=$r['status_id'];

                            $client_id=$r['client_id'];
                            $empresa=mysqli_query($con, "select * from user where id=$client_id");
                                $rows02=mysqli_fetch_array($empresa);
                                    if($rows02['fullname']!=""){
                                        $fullname=$rows02['fullname'];
                                    }else{
                                        $fullname=$rows02['name']." ".$rows02['lastname'];
                                    }


                ?>

                    <tr>
                        <td><?php echo $created_at ?></td>
                        <td ><?php echo $number_ticket ?></td>
                        <!-- <td><?php echo $name." <b>(".$email.")</b>" ?></td> -->
                        <td><a href="#"><?php echo $fullname ?></a></td>
                        <td>
                            <?php 

                            if($status_id==1){
                                echo "<span class='label label-warning'>Registrado</span>";
                            }else if($status_id==2){
                                echo "<span class='label label-info'>Asignados</span>";
                            }else if($status_id==3){
                                echo "<span class='label label-primary'>En Proceso</span>";
                            }else if($status_id==4){
                                echo "<span class='label label-success'>Atendidos</span>";
                            }
                    
                            ?>
                        </td>

                    </tr>
                <?php
                    } //end while
                ?>
                <tr>
                    <td colspan=5><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
        
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar
            </div>
        <?php    
        }
    }
?>