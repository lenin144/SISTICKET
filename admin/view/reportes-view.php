<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active9="active";
    include "header.php";
    include "sidebar.php";
    $kinds=mysqli_query($con, "select * from kind");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Reportes</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Reportes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Registro de Tickets</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                                                <!-- form print -->
                        <form class="form-horizontal" role="form" id="reportes">
                             <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3 pull-left">
                                       <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/".date("m/Y")." - ".date("d/m/Y");?>" readonly onchange="load(1);">
                                    </div>
                                    <div class="col-md-3 pull-left">
                                        <select class="form-control" id="category" name="category" onchange="load(1);">
                                            <option selected="" value="0">-- Imprimir por Categoria --</option>
                                            <?php
                                            $categories = mysqli_query($con,"select * from status");
                                            while ($cat=mysqli_fetch_array($categories)) { ?>
                                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-default" onclick='load(1);'>
                                            <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                        <span id="loader"></span>
                                    </div>      
                                <div class="col-md-3  pull-right">
                                    <a onclick="reporte_excel();"  class="btn btn-primary"><i class='fa fa-download'></i> Descargar</a>
                                    <button type="submit" class="btn btn-default">
                                      <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button>
                                </div>  
                            </div>    
                        </form>
                        <!-- end form print -->

                        <!-- <div class="table-responsive"> -->
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                        <!-- </div> -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php include "footer.php" ?>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript" src="js/reportes.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>



        // function print
        $("#reportes").submit(function(e){
            e.preventDefault();
          var daterange = $("#daterange").val();
          var category = $("#category").val();
          

         VentanaCentrada('./pdf/documentos/tickets_pdf.php?daterange='+daterange+'&category='+category,'Gasto','','1024','768','true');
    });

</script>
<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker({
         locale: {
      format: 'DD/MM/YYYY',
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
       "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],      
    }
    });
});
</script>


<script>
    function reporte_excel(){
        /*var range=$("#range").val();
        var tipoevento=$("#tipoevento").val();
        var query=$("#q").val();*/
        var daterange = $("#daterange").val();
        var category = $("#category").val();
        window.open("action/excel_reporte.php?daterange="+daterange+"&category="+category);
    }
</script>