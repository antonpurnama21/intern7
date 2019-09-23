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
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/reset.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/notif.js')?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/ui/ripple.min.js'); ?>"></script>
	<!-- /theme JS files -->
	<link rel="shortcut icon" href="<?= base_url('assets/dashboards/images/logo_icon_dark.png'); ?>" />

</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-blue-700">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="<?= base_url('assets/dashboards/images/logo_light.png'); ?>" alt=""></a>

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
					<form id="form-reset" action="<?= base_url('auth/do_reset') ?>" id="form-reset" name="form-reset">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div >
									<img src="<?= base_url('assets/dashboards/images/cbnlogo.png'); ?>" alt="" style="width:50%;height:auto;">
								</div>
								<h5 class="content-group">CBN Internship <small class="display-block">Reset Password</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="email" class="form-control" placeholder="Email" value="<?=$email?>" name="email" id="email" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="pass1" id="pass1" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Repeat Password" name="pass2" id="pass2" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-green-600 btn-block">Reset <i class="icon-arrow-right14 position-right"></i></button>
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
