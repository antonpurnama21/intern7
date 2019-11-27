<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><!--<img src="<?= base_url()?>" style="width:20px;height:auto;" class="img-responsive" alt="">--> Profile <?= $dtadmin->fullName ?> :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<div class="panel-body">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4 text-bold ">Full Name </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtadmin->fullName ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Your ID </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label text-semibold text-success"><?= $dtadmin->adminCampusID ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Universities </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_university($dtadmin->universityID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Role </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= what_role($dtadmin->roleID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Email </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtadmin->emaiL ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Telephone </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtadmin->telePhone?></label>
								</div>
							</div>
						</div>
					</div>
					<br />

					<div class="row">
						<a style="margin-bottom: 5px" class="btn btn-primary" onclick="location.href='<?=base_url('admincampus/profile_update')?>'"><i class="icon-quill4"></i> Update Profile</a>
						<a style="margin-bottom: 5px" class="btn btn-danger" onclick="showModal('<?=base_url("admincampus/changePass")?>', '<?=$dtadmin->adminCampusID.'~'.$dtadmin->fullName?>', `editadmin`);"><i class="icon-lock"></i> Change Password</a><br />
					</div>

				</div>

			</div>
		</div>

	</div>

	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold">Your Activities :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<input type="hidden" name="alamatList" id="alamatList" value="<?= base_url('log/getListByid') ?>">
			<div class="panel-body">
				<table class="table datatable-responsive-row-control table-hover">
					<thead>
						<tr style="font-size:12px;text-align:center;">
							<th>.</th>
							<th>No</th>
							<th>Email User</th>
							<th>Log Time</th>
							<th>Browser Access</th>
							<th>IP Address</th>
							<th>Pletform</th>
							<th>Type Log</th>
							<th>Description</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>





