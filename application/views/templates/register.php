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

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/forms/selects/select2.min.js')?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/app.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/register.js'); ?>"></script>
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
				<div class="content d-flex justify-content-center align-items-center">
					<input type="hidden" name="getFaculty" id="getFaculty" value="<?= base_url('commonfunction/getFaculty') ?>">
					<input type="hidden" name="getUniv" id="getUniv" value="<?= base_url('commonfunction/getUniv') ?>">
					<!-- Advanced login -->
					<form id="dokumen-form" action="<?= base_url('auth/do_register') ?>" method="POST" name="dokumen-form" id="dokumen-form">
						<div class="col-lg-3"></div>
						<div class="col-lg-6">
								<div class="panel panel-body">
									<div class="text-center">
										<div>
											<img src="<?= base_url('assets/dashboards/images/cbnlogo.png'); ?>" alt="" style="width:100px;height:auto;">
										</div>
										<h5 class="content-group">Registration Page <small class="display-block">New Application</small></h5>
									</div>


									<div class="form-group form-group-feedback form-group-feedback-right">
										<input type="number" name="Nim" id="Nim" class="form-control" required="required" placeholder="Insert your nomor induk mahasiswa (NIM)" title="Insert your nomor induk mahasiswa (NIM)" required>
										<div class="form-control-feedback">
											<i class="icon-user-tie text-muted"></i>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<select name="Universityid" id="Universityid" class="select2" data-placeholder="Select University" title="Select University" required>
													<option value=""></option>
												</select>
												<div class="form-control-feedback">
													<i class="text-muted"></i>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<select name="Facultyid" id="Facultyid" class="select2" data-placeholder="Select Faculty" title="Select Faculty" required>
													<option value=""></option>
												</select>
												<div class="form-control-feedback">
													<i class="text-muted"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group form-group-feedback form-group-feedback-right">
										<input type="text" name="Fullname" id="Fullname" class="form-control" placeholder="Insert your Full name" title="Insert your Full name" required="required" required>
										<div class="form-control-feedback">
											<i class="icon-user-plus text-muted"></i>
										</div>
									</div>

									<div class="form-group form-group-feedback form-group-feedback-right">
										<input type="email" name="Email" id="Email" class="form-control" placeholder="Insert your email" title="Insert your email" required="required" required>
										<div class="form-control-feedback">
											<i class="icon-envelope text-muted"></i>
										</div>
									</div>

									<div class="form-group form-group-feedback form-group-feedback-right">
										<input type="text" name="Mobilephone" id="Mobilephone" class="form-control" placeholder="Insert your phone number" title="Insert your phone number" required="required" required>
										<div class="form-control-feedback">
											<i class="icon-phone text-muted"></i>
										</div>
									</div>

									<center>
									<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> Create account</button>
									</center>
								</div>
						</div>
						<div class="col-lg-3"></div>
					</form>
					<!-- /advanced login -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						Copyright &copy; 2019. <a href="<?=base_url()?>">Portal Internship PT. Cyberindo Aditama </a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">A.P</a>
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
</script>
</html>
