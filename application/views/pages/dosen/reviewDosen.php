<div id="modalPortal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;<?= $modalTitle ?></h5>
			</div>

			<div class="modal-body">
					<div class="col-md-3" style="margin-right: 10px; margin-top: 10px">
						<img src="<?= base_url().$dMaster->profilePic?>" style="width:240px;height:auto;" class="img-responsive" alt="">
					</div>
				<fieldset class="content-group">
					
					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Profile Dosen
						<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo1">

						<div class="col-md-12">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-lg-4 text-bold ">Nomor Induk Dosen</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->dosenNumber ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Full Name</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->fullName ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">University</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_university($dMaster->universityID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Faculty</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_faculty($dMaster->facultyID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Email</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->emaiL ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Contact Number</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->fixedPhone.' / '.$dMaster->mobilePhone ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Address</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= ucwords($dMaster->address.', '.$dMaster->city.' ('.$dMaster->zip.')') ?></label>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

				</fieldset>

				
						
				
			</div>
			<br />
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
			</div>
		</div>
	</div>
</div>