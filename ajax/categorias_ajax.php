<?php

	#compruebo si esta logueado
	session_start();
	error_reporting(0);//ocultamos los errores....
if (isset($_SESSION['user_id']) or isset($_SESSION['admin_id'])){
			
	/* Connect To Database*/
	require_once ("../admin/config/config.php");

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
		$area = mysqli_real_escape_string($con,(strip_tags($_REQUEST['area'], ENT_QUOTES)));
		// echo $area;
		/*if(!$area>=0){
			print "<script>window.location='index.php'</script>";
		}*/
		$tables="tipos_requerimientos";
		$campos="*";
		if($area!=null and $area>0){
			$sWhere=" where area_id=".$area." and ";
			$sWhere.=" name LIKE '%".$query."%'";
			$sWhere.=" and Active=1";
		}

		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		// $per_page = intval($_REQUEST['per_page']); //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		// $offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables  $sWhere ");
		// print"<script>alert(\"SELECT count(*) AS numrows FROM $tables  $sWhere \")</script>";
		if ($row= mysqli_fetch_array($count_query)){@$numrows = $row['numrows'];}
		else {echo mysqli_error($con);}
		// $total_pages = ceil($numrows/$per_page);
		$reload = 'addticket.php';
		//main query to fetch the data
		// $query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
		$query = mysqli_query($con,"SELECT $campos FROM  $tables  $sWhere ");
		//loop through fetched data
	if (@$numrows>0){

	?>
		<!-- <br> -->
		<!-- <div class="table-responsive"> -->
			<table class="table table-bordered table-striped dataTable no-footer dtr-inline">
				<thead class="table_header">
					<tr>
						<th style="width: 70px;"></th>
						<th>Descripción </th>
					</tr>
				</thead>
				<?php 
				$finales=0;
				while($row = mysqli_fetch_array($query)){	
					$id=$row['id'];
					$name=$row['name'];
					$created_at=$row['created_at'];
			
					list($date,$hora)=explode(" ",$created_at);
					list($Y,$m,$d)=explode("-",$date);
					$fecha=$d."-".$m."-".$Y;
					
					$finales++;
				?>	
				<tr>
					<td style="width: 70px; text-align: center;">
						<input onchange="return ticket_update(this.value,2);" type="radio" name="categoria" id="<?php echo $id;?>" value="<?php echo $id;?>" />
					</td>
					<td><label style="font-weight: normal;" for="<?php echo $id;?>"><?php echo $name;?></label></td>
				</tr>
				<?php }?>	
				<tr>
					<!-- <td colspan='6'> 
						<?php 
							$inicios=$offset+1;
							$finales+=$inicios -1;
							// echo "Mostrando $inicios al $finales de $numrows registros";
							echo paginate($reload, $page, $total_pages, $adjacents);
						?>
					</td> -->
				</tr>	
			</table>
		<!-- </div> -->
	<?php	
		}else{
			echo "<br><div class='alert alert-info'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Aviso!</strong>
				No se encontraron categorías!.
			</div>";
		}
	?>
<?php		
	}
}else{
	header("location: ../../");//Redirecciona 
	exit;
}
?>          
		  
