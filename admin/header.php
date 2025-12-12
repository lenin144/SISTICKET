<?php
  /*-------------------------
  Autor: Autor Dev
  Web: www.google.com
  E-Mail: waptoing7@gmail.com
  ---------------------------*/
	// session_start();
	include "config/config.php";
	if (!isset($_SESSION['admin_id']) AND $_SESSION['admin_id'] != 1) {
		header("location: index.php");
		exit;
	}
?>
<?php 
	$id=$_SESSION['admin_id'];
	$query=mysqli_query($con,"SELECT * from user where id=$id");
	$row=mysqli_fetch_array($query);
		$username=$row['username'];
		$name=$row['name'];
		$lastname=$row['lastname'];
		$email=$row['email'];
		$profile_pic=$row['profile_pic'];
		$is_admin=$row['is_admin'];
		$created_at=$row['created_at'];

	$config = mysqli_query($con, "select * from configuration where name='website' ");
	$row01=mysqli_fetch_array($config);
	$website=$row01['val'];

	$fav = mysqli_query($con, "select * from configuration where name='favicon' ");
	$row02=mysqli_fetch_array($fav);
	$favicon=$row02['val'];

	if($is_admin!=1){
		$user_supervisor=mysqli_query($con,"select * from area inner join user on area.supervisor_id=user.id where user.id=$id");
		$soy_supervisor=mysqli_num_rows($user_supervisor);
		// echo $soy_supervisor;
	}  

	if($is_admin!=1 and $soy_supervisor!=1){
		$soy_agente = 1;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="images/<?php echo $favicon ?>" />
	<!-- <title><?php echo $website ?> | <?php echo $username ?></title> -->
	<title><?php echo $website ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
	
	<!-- Disabled on Mantenimiento Module -->
	<?php //if(!isset($active13)){ ?> 
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
	
		<style>
			.table_header{
			background-color:#ca4300;
			color:#fff;
			}
		</style>
	<?php //} ?>
	
	
	<!-- bootstrap datepicker -->
  	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	<!-- Chosen Select -->
	<link rel="stylesheet" type="text/css" href="plugins/chosen/css/chosen.min.css" />
	<!--  Select2 -->
	<link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css" />
	<!-- jvectormap -->
	<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	
	<!-- iCheck for checkboxes and radio inputs -->
  	<link rel="stylesheet" href="plugins/iCheck/all.css">

	 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!--<link rel="stylesheet" href="dist/css/skins/my-kin-light.css">-->
	<link rel="stylesheet" href="dist/css/micss.css">
	<!-- wizard -->
	<link rel="stylesheet" href="../easyWizard.css">

</head>
<body class="hold-transition skin-blue-light sidebar-mini">
	<div class="wrapper">
  		<header class="main-header">
  			<?php if(!isset($_SESSION['sidebar'])){ ?>
			<a href="#" class="logo"><!-- Logo -->
			  	<span class="logo-mini"><b>C</b>P</span> <!-- mini logo for sidebar mini 50x50 pixels -->
			  	<span class="logo-lg"><b><?php echo $website ?></b></span><!-- logo for regular state and mobile devices -->
			</a>
			<?php } ?>
			<nav class="navbar navbar-static-top"><!-- Header Navbar: style can be found in header.less -->
			  	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><!-- Sidebar toggle button-->
					<span class="sr-only">Toggle navigation</span>
			  	</a>
			  	<div class="navbar-custom-menu"><!-- Navbar Right Menu -->
					<ul class="nav navbar-nav">
					 	<li class="dropdown user user-menu"><!-- User Account: style can be found in dropdown.less -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							  	<img src="images/profiles/<?php echo $profile_pic ?>" class="user-image" alt="User Image">
							  	<span class="hidden-xs"><?php echo $name." ".$lastname ?></span>
							</a>
							<ul class="dropdown-menu">
							  	<li class="user-header"><!-- User image -->
									<img src="images/profiles/<?php echo $profile_pic ?>" class="img-circle" alt="User Image">
									<p>
										<?php 
											echo $name." ".$lastname;
											if ($is_admin==1) {
											   echo " (Admin)";
											}else if($soy_supervisor==1){
											 	echo " (Supervisor)";
											}else{
												echo " (Agente)";
											}
										?>
										<small>Miembro desde el:  <?php $created_at=date('d/M/Y', strtotime($created_at)); echo $created_at ?></small>
									</p>
							  	</li>

						  
							  	<li class="user-footer"><!-- Menu Footer-->
									<div class="pull-left">
								  		<a href="?view=profile" class="btn btn-default btn-flat">Perfil</a>
									</div>
									<div class="pull-right">
								  		<a href="action/logout.php" class="btn btn-default btn-flat">Salir</a>
									</div>
							  	</li>
							</ul>
					  	</li>
					</ul>
				</div>
			</nav>
		</header>