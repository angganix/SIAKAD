<?php
session_name("siakad");
session_start();

if(!isset($_SESSION['username'])){
	header("location:login.php");
}

if (!isset($_SESSION['app_token'])) {
    $_SESSION['app_token'] = base64_encode(openssl_random_pseudo_bytes(32));
} else {
	unset($_SESSION['app_token']);
	$_SESSION['app_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="asset/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="asset/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="asset/dist/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" href="asset/dist/css/ripples.min.css">
	<link rel="stylesheet" href="asset/dist/css/MaterialAdminLTE.min.css">
	<link rel="stylesheet" href="asset/dist/css/skins/all-md-skins.min.css">
	<link rel="stylesheet" href="asset/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="asset/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="asset/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="asset/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="asset/plugins/material-datepicker/css/bootstrap-material-datetimepicker.css">
        <link rel="stylesheet" href="asset/style.css?ver=<?= microtime();?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="asset/bower_components/jquery/dist/jquery.min.js"></script>
<script src="asset/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>
 $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="asset/dist/js/material.min.js"></script>
<script src="asset/dist/js/ripples.min.js"></script>
<script>
 $.material.init();
</script>
<script src="asset/bower_components/raphael/raphael.min.js"></script>
<script src="asset/bower_components/morris.js/morris.min.js"></script>
<script src="asset/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="asset/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="asset/bower_components/moment/min/moment.min.js"></script>
<script src="asset/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="asset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="asset/bower_components/fastclick/lib/fastclick.js"></script>
<script src="asset/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>
<script src="asset/bower_components/select2/dist/js/select2.min.js"></script>
<script src="asset/plugins/material-datepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="asset/plugins/tinymce/tinymce.min.js"></script>
<script src="asset/dist/js/adminlte.min.js"></script>
<script src="asset/tooltip.js"></script>
<script src="asset/script.js?<?= microtime();?>"></script>
<script>
	window.csrf = {app_token: '<?= $_SESSION['app_token']; ?>'};
	$.ajaxSetup({
		data: window.csrf
	});
</script>

</head>
<body class="hold-transition skin-green sidebar-mini">
	<div class="loader">
		<h4><i class="fa fa-circle-o-notch fa-spin"></i> Mohon Menunggu</h4>
	</div>

	<div class="wrapper">

		<header class="main-header">
			<a href="index.php" class="logo">
				<span class="logo-mini"><img src="asset/logo.jpeg" class="img-circle" style="margin-top:-4px;width: 30px;height: 30px;object-fit: cover;" /></span>
				<span class="logo-lg"><img src="asset/logo.jpeg" class="img-circle" style="margin-top:-4px;width: 30px;height: 30px;object-fit: cover;" /> SISFO AKADEMIK</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="asset/dist/img/user-icon.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs"><?= $_SESSION['fullname']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="asset/dist/img/user-icon.jpg" class="img-circle" alt="User Image">

									<p>
										<?= $_SESSION['fullname']; ?>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>