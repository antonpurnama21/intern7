<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $titleWeb ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/core.css');?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/components.css');?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/css/colors.css');?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/dashboards/js/plugins/notifications/sweetalert2.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<?php if(isset($_CSS) and !empty($_CSS)) echo $_CSS; ?>
	<!-- Core JS files -->
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/loaders/pace.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/libraries/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/libraries/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/loaders/blockui.min.js'); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/ui/moment/moment.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/ui/nicescroll.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/notifications/jgrowl.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/notifications/sweetalert2.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/notif.js'); ?>"></script>
	<?php if(isset($_JS) and !empty($_JS)) echo $_JS; ?>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/core/app.js'); ?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/pages/layout_fixed_custom.js'); ?>"></script>

	<script type="text/javascript" src="<?= base_url('assets/dashboards/js/plugins/ui/ripple.min.js'); ?>"></script>
	<!-- /theme JS files -->
	<link rel="shortcut icon" href="<?= base_url('assets/dashboards/images/cbn-shortcut.png'); ?>" />
	<style>
	#image-holder {
        margin-top: 8px;
    }
        
    #image-holder img {
        border: 5px solid #DDD;
        max-width:100%;
    }

    #calendar {
	    max-width: 900px;
	    margin: 0 auto;
	  }

	 a.disabled {
	  pointer-events: none;
	  cursor: default;
	}
	
	</style>

	

</head>

<body class="navbar-top">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top bg-blue-800">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?=base_url()?>dashboard"><img src="<?= base_url('assets/dashboards/images/internship.png'); ?>" style="width: 100px; height: auto;"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			</ul>

			<div class="navbar-right">
				<p class="navbar-text"><?= $sesi['sess_name'] ?></p>
				<p class="navbar-text"><span class="label bg-success-400">online</span></p>
				<?php if($sesi['sess_role'] == 11){ ?>
				<input type="hidden" name="getNotif" id="getNotif" value="<?= base_url('notification/get_notif') ?>">
				<?php } ?>
				<ul class="nav navbar-nav">				
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="label label-pill label-danger count" style="border-radius:10px; margin-top: 7px; margin-right: 7px;z-index: 10;"></span>
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Activity</span>
							
						</a>

						<div class="dropdown-menu dropdown-content width-350">
							<div class="dropdown-content-heading">
								Activity
								<ul class="icons-list">
									<li><a href="#"><i class="icon-menu7"></i></a></li>
								</ul>
							</div>
							<div class="dropdown-content-body dropdown-scrollable">
								<ul class="media-list">

								</ul>
							</div>

							<div class="dropdown-content-footer bg-light">
								<a href="<?=base_url('notification')?>" class="text-grey mr-auto">All activity</a>
							</div>
						</div>
					</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default sidebar-fixed">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<a href="#"><img src="<?= $sesi['sess_avatar']; ?>" class="img-circle img-responsive" alt=""></a>
								<h6><?= $sesi['sess_name'] ?></h6>
								<span class="text-size-small"><?= what_role($sesi['sess_role']); ?></span><br />
								<?php  
								if ($sesi['sess_role'] == 11 OR $sesi['sess_role'] == 22) {?>
								<span class="text-size-small">[ <?= name_dept($sesi['sess_deptID']); ?> ]</span>
								<?php }else {?>
								<span class="text-size-small">[ <?= name_university($sesi['sess_univID']); ?> ]</span>
								<?php } ?>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<?php $this->load->view('partials/sidebar'); ?>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - <?= $breadcrumb[0] ?></h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?= base_url() ?>dashboard"><i class="icon-home2 position-left"></i> Dashboard</a></li>
							<li><?= $breadcrumb[0] ?></li>
							<li class="active"><?= $breadcrumb[1] ?></li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-calendar position-left"></i> <?= date('d F Y'); ?></a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear position-left"></i>
									Setting
									<span class="caret"></span>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<?php if ($sesi['sess_role']==11){ ?>
									<li><a href="<?= base_url('admin/profile') ?>"><i class="icon-user"></i> Profile</a></li>
									<?php }elseif ($sesi['sess_role']==22) {?>
									<li><a href="<?= base_url('admin/profile') ?>"><i class="icon-user"></i> Profile</a></li>
									<?php }elseif ($sesi['sess_role']==33) {?>
									<li><a href="<?= base_url('admincampus/profile') ?>"><i class="icon-user"></i> Profile</a></li>
									<?php }elseif ($sesi['sess_role']==44) {?>
									<li><a href="<?= base_url('dosen/profile') ?>"><i class="icon-user"></i> Profile</a></li>
									<?php }else{?>
									<li><a href="<?= base_url('mahasiswa/profile') ?>"><i class="icon-user"></i> Profile</a></li>
									<?php } ?>
									<li><a href="<?= base_url('auth/logout') ?>"><i class="icon-exit"></i> Log out</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Dashboard content -->
					
					<?= $body ?>
					<!-- /dashboard content -->


					<!-- Footer -->
					<?php $this->load->view('partials/footer'); ?>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	<div id="tampilModal"></div>
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
	  var x = document.getElementById("Password1");
	  var y = document.getElementById("Password2");
	  if (x.type === "password" || y.type === "password") {
	    x.type = "text";
	    y.type = "text";
	  } else {
	    x.type = "password";
	    y.type = "password";
	  }
	}

	$(document).ready(function(){
		function load_unseen_notification(view = '')
	    {
	        $.ajax({
	            url:$('#getNotif').val(),
	            method:"POST",
	            data:{view:view},
	            dataType:"json",
	            success:function(data)
	            {
	                $('.media-list').html(data.notification);
	                if(data.unseen_notification > 0)
	            {
	                $('.count').html(data.unseen_notification);
	                }
	            }
	        });
	    }
 
		load_unseen_notification();

		 
		$(document).on('click', '.dropdown-toggle', function(){
		    $('.count').html('');
		    load_unseen_notification('yes');
		});
		 
		setInterval(function(){ 
		    load_unseen_notification();; 
		}, 5000);
	});
</script>

</html>
