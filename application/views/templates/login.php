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
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/login.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/notif.js')?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/ui/ripple.min.js'); ?>"></script>
	<!-- /theme JS files -->
	<link rel="shortcut icon" href="<?= base_url('assets/dashboards/images/cbn-shortcut.png'); ?>" />

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
					<form id="form-login" action="<?= base_url('auth/do_login') ?>" id="form-login" name="form-login">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div >
									<img src="<?= base_url('assets/dashboards/images/cbnlogo.png'); ?>" alt="" style="width:50%;height:auto;">
								</div>
								<h5 class="content-group">Login Page <small class="display-block">Insert your Email and Password</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="email" class="form-control" value="<?php if (get_cookie('u_mail')) { echo get_cookie('u_mail'); } ?>" placeholder="Email" name="email" id="email" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" value="<?php if (get_cookie('u_pass')) { echo get_cookie('u_pass'); } ?>" placeholder="Password" name="password" id="password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" name="chkremember" <?php if (get_cookie('u_mail')) { echo "checked"; } ?>>
									Remember Me
								</label>
								<div class="pull-right">
									<label class="checkbox-inline">
										<input type="checkbox" onclick="myFunction()" class="styled">
										Show Password
									</label>
								</div>
								
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-green-600 btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
							</div>

							<div class="m-t-20 text-center">
                                <a href="<?php echo base_url(); ?>auth/forgot">Forgot Password ? Click Here !</a>
                                <br>
                                <a href="<?php echo base_url(); ?>auth/register">New Application ? Register Now !</a>
                            </div>

							<span class="help-block text-center no-margin">CBN Internship</span>
						</div>
					</form>
					<!-- /advanced login -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						Copyright &copy; 2019. <a href="<?=base_url()?>" >Portal Internship PT. Cyberindo Aditama </a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">A.P</a>
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
<script type="text/javascript" charset="utf-8" async defer>
	<?php if(has_alert()):?>
    <?php foreach(has_alert() as $key => $message):
        if ($key == 'bg-danger') { $head = 'Error'; } elseif ($key == 'bg-info') { $head = 'Information'; } elseif ($key == 'bg-success') { $head = 'Success'; } else { $head = 'Warning'; }
    ?>
        notif('<?= $head ?>','<?= $message ?>','<?= $key ?>');
    <?php endforeach; ?>
    <?php endif; ?>

    function myFunction() {
	  var x = document.getElementById("password");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	}
</script>

</html>
