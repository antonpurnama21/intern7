<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $titleWeb ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/core.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/components.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/colors.css'); ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/loaders/pace.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/libraries/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/libraries/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/loaders/blockui.min.js'); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/forms/styling/uniform.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/forms/validation/validate.min.js')?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/notifications/jgrowl.min.js')?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/app.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/forgot.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/notif.js')?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/ui/ripple.min.js'); ?>"></script>
	<!-- /theme JS files -->
	<link rel="shortcut icon" href="<?= base_url('assets/dashboards/images/cbn-shortcut.png'); ?>" />

	<!-- Kode menampilkan peringatan untuk mengaktifkan javascript-->
	<div align="center"><noscript>
	   <div style="position:fixed; top:0px; left:0px; z-index:3000; height:100%; width:100%; background-color:#FFFFFF">
	   <div style="font-family: Arial; font-size: 17px; background-color:#00bbf9; padding: 11pt;">Mohon aktifkan javascript pada browser untuk mengakses halaman ini!</div></div>
	</noscript></div>
	 
	<!--Kode untuk mencegah seleksi teks, block teks dll.-->
	<script type="text/javascript">
	function disableSelection(e){if(typeof e.onselectstart!="undefined")e.onselectstart=function(){return false};else if(typeof e.style.MozUserSelect!="undefined")e.style.MozUserSelect="none";else e.onmousedown=function(){return false};e.style.cursor="default"}window.onload=function(){disableSelection(document.body)}
	</script>
	 
	<!--Kode untuk mematikan fungsi klik kanan di blog-->
	<script type="text/javascript">
	function mousedwn(e){try{if(event.button==2||event.button==3)return false}catch(e){if(e.which==3)return false}}document.oncontextmenu=function(){return false};document.ondragstart=function(){return false};document.onmousedown=mousedwn
	</script>
	 
	<style type="text/css">
	* : (input, textarea) {
	    -webkit-touch-callout: none;
	    -webkit-user-select: none;
	 
	}
	</style>
	<style type="text/css">
	img {
	     -webkit-touch-callout: none;
	     -webkit-user-select: none;
	    }
	</style>
	 
	<!--Kode untuk mencegah shorcut keyboard, view source dll.-->
	<script type="text/javascript">
	window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
	</script>
	<script type="text/javascript">
	document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
	</script>

</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-blue-700">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?= base_url()?>"><img src="<?= base_url('assets/dashboards/images/internship.png'); ?>" style="width: 100px; height: auto;"></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-calendar"> <?= date('d F Y'); ?></i>
						<span class="visible-xs-inline-block position-right"> </span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form id="form-forgot" action="<?= base_url('auth/do_forgot') ?>" id="form-forgot" name="form-forgot">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div >
									<img src="<?= base_url('assets/dashboards/images/cbnlogo.png'); ?>" alt="" style="width:50%;height:auto;">
								</div>
								<h5 class="content-group">CBN Internship <small class="display-block">Forgot Password</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-green-600 btn-block">Send Link Setup<i class="icon-paper-plane position-right"></i></button>
							</div>

							<div class="m-t-20 text-center">
                                <a href="<?php echo base_url(); ?>auth/login">BACK</a><br>
                            </div>

							<span class="help-block text-center no-margin">CBN Internship</span>
						</div>
					</form>
					<!-- /advanced login -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						Copyright &copy; <?=date('Y')?>. <a href="#">Portal Internship PT. Cyberindo Aditama</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">A.P</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
