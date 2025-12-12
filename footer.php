  <footer class="main-footer">
	<div class="pull-right hidden-xs">
	  <b>Version</b> 1.0.0
	</div>
	<strong><?php echo $website ?> || <?php echo date('Y') ?> <a target="_blank" href="https://google.com/">Google</a> </strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- chosen select -->
<script src="admin/plugins/chosen/js/chosen.jquery.min.js"></script>
<!-- bootstrap datepicker -->
<script src="admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!--  select2 -->
<script src="admin/plugins/select2/select2.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>


<!-- DataTables -->
<!-- <script src="admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="admin/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


<!-- SlimScroll -->
<script src="admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="admin/plugins/fastclick/fastclick.js"></script>
	<!-- maskMoney -->
	<script src="assets/js/jquery.maskMoney.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>

	<!-- page script -->
	<script type="text/javascript">
	  $(function () {
		// datepicker plugin
		/*$('.date-picker').datepicker({
		  autoclose: true,
		  todayHighlight: true
		});*/

		// chosen select
		$('.chosen-select').chosen({allow_single_deselect:true}); 
		//resize the chosen on window resize
		
		// mask money
		$('#harga_beli').maskMoney({thousands:'.', decimal:',', precision:0});
		$('#harga_jual').maskMoney({thousands:'.', decimal:',', precision:0});

		$(window)
		.off('resize.chosen')
		.on('resize.chosen', function() {
		  $('.chosen-select').each(function() {
			 var $this = $(this);
			 $this.next().css({'width': $this.parent().width()});
		  })
		}).trigger('resize.chosen');
		//resize chosen on sidebar collapse/expand
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
		  if(event_name != 'sidebar_collapsed') return;
		  $('.chosen-select').each(function() {
			 var $this = $(this);
			 $this.next().css({'width': $this.parent().width()});
		  })
		});
	
	
		$('#chosen-multiple-style .btn').on('click', function(e){
		  var target = $(this).find('input[type=radio]');
		  var which = parseInt(target.val());
		  if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
		   else $('#form-field-select-4').removeClass('tag-input-style');
		});

		// DataTables
		$('#mistickets').dataTable({
		  "bPaginate": true,
		  "bLengthChange": false,
		  "bFilter": true,
		  "bInfo": true,
		  // "language": idioma_español,
		  "language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
		  responsive: true
		});



		$("#dataTables1").dataTable();
		$('#dataTables2').dataTable({
		  "bPaginate": true,
		  "bLengthChange": false,
		  "bFilter": false,
		  "bSort": true,
		  "bInfo": true,
		  "bAutoWidth": false,

		  // "language": idioma_español,
		  "language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
		  responsive: true
		});
	  });

	  //nuevo
		$('#dataTables3').DataTable({
		  "bPaginate": false,
		  "bLengthChange": false,
		  "bFilter": true,
		  "bSort": false,
		  "bInfo": false,
		  "bAutoWidth": false,
		  "paging": false,
		  "lengthChange": false,
		  "autoWidth": false,
		   "bInfo": false,
		   // "language": idioma_español,
		   "language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
		   responsive: true
		});


		//nuevo
		$('#ticketDetail').DataTable({
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
			// "language": idioma_español,
			"language": {
	            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	        },
			responsive: true
		});

		var idioma_español= {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}

		</script>



</body>
</html>
