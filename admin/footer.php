  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong><?php echo $website ?> || <?php echo date('Y') ?> <a target="_blank" href="https://www.sgs.com/es-pe">SGS Perú</a> </strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- chosen select -->
<script src="plugins/chosen/js/chosen.jquery.min.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!--  select2 -->
<script src="plugins/select2/select2.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<!-- Disabled on Mantenimiento Module -->
<?php //if(!isset($active13)){ ?> 
	<!-- DataTables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<?php //} ?>


<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->

<script>
	$(document).ready(function() {
		// Table 1
	    var table = $('#example1').DataTable( {
	    	"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
	        responsive: true
	    } );
    	// new $.fn.dataTable.FixedHeader(table);

    	//table 2
    	var table1 = $('#example2').DataTable( {
	    	"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
	        "paging": true,
	      	"lengthChange": false,
	      	"searching": false,
	      	"ordering": true,
	      	"info": true,
	      	"autoWidth": false,
	        responsive: true
	    } );
    	// new $.fn.dataTable.FixedHeader(table1);
    	
    	//table 3
    	var table3 = $('#example3').DataTable( {
	    	"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
	        "paging": false,
	      	"lengthChange": false,
	      	"autoWidth": false,
	      	"bInfo": false,
	      	 "bSort": false,//nuevo, add 20/10/18
	        responsive: true
	    } );
    	// new $.fn.dataTable.FixedHeader(table3);

    	//table 4
    	var table4 = $('#ticketDetail').DataTable( {
	    	"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
	        "order": [[ 1, "desc" ]],
	        "bPaginate": false,
	        "bLengthChange": false,
	        "bFilter": false,
	        "bSort": true,
	        "bInfo": false,
	        "bAutoWidth": false,
	        "paging": false,
	        "lengthChange": false,
	        "autoWidth": false,
	        "bInfo": false,
	        responsive: true
	    } );
    	// new $.fn.dataTable.FixedHeader(table4);

    	//table 5
    	var table5 = $('#tableSolution').DataTable( {
	    	"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
	        "paging": true,
	      	"lengthChange": true,
	      	"searching": false,
	      	"ordering": true,
	      	"info": false,
	      	"autoWidth": false,
	        responsive: true
	    } );
    	// new $.fn.dataTable.FixedHeader(table5);

		// Table 6
	    var table6 = $('#example6').DataTable( {
	    	"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
	        responsive: false
	    } );
	});

  	$(function () {
	    //Initialize Select2 Elements
	    $(".select2").select2();

	    // chosen select
	    $('.chosen-select').chosen({allow_single_deselect:true}); 
	    //resize the chosen on window resize

	    //Date picker
	    $('#datepicker').datepicker({
	      format: 'yyyy-mm-dd',
	      autoclose: true
	    });


	    
	});
</script>
</body>
</html>
