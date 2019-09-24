<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold">Profile <?= $dtdosen->fullName ?> :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<div class="panel-body">
				<div class="col-md-9">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4 text-bold ">Full Name </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtdosen->fullName ?></label>
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
									<label class="control-label text-semibold text-success"><?= $dtdosen->dosenID ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">NID (Nomor Induk Dosen) </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label text-semibold text-success"><?= $dtdosen->dosenNumber ?></label>
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
									<label class="control-label"><?= what_role($dtdosen->roleID) ?></label>
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
									<label class="control-label"><?= $dtdosen->emaiL ?></label>
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
									<label class="control-label"><?= name_university($dtdosen->universityID) ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Faculties </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_faculty($dtdosen->facultyID) ?></label>
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
									<label class="control-label"><?= $dtdosen->fixedPhone?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Mobile Phone </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtdosen->mobilePhone?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Cities </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtdosen->city ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Zip Postal </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtdosen->zip ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Address </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtdosen->address ?></label>
								</div>
							</div>
						</div>
					</div>
					<br />

					<div class="row">
						<button style="margin-bottom: 5px" class="btn btn-primary" onclick="location.href='<?=base_url('dosen/formProfile/'.$dtdosen->dosenID) ?>'"><i class="icon-quill4"></i> Update Profile</button>
						<a style="margin-bottom: 5px" class="btn btn-danger" onclick="showModal('<?=base_url("dosen/changePass")?>', '<?=$dtdosen->dosenID.'~'.$dtdosen->fullName?>', `editadmin`);"><i class="icon-lock"></i> Change Password</a><br />
						
					</div>

				</div>
				<div class="col-md-3">
					<div class="pull-right">
					<img src="<?= base_url().$dtdosen->profilePic?>" style="width:240px;height:auto;" class="img-responsive" alt="">
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
							<th></th>
							<th width="10%">No</th>
							<th width="40%">Log Information</th>
							<th width="10%">Type Log</th>
							<th width="40%">Description</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>
