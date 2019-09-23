<div id="modalPortal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;<?= $modalTitle ?></h5>
			</div>
			<input type="hidden" name="getCampus" id="getCampus" value="<?= base_url('admincampus/getCampus') ?>">

			<form class="form-horizontal form-validate-jquery" action="<?= $formAction ?>" method="post" enctype="multipart/form-data" name="dokumen-form" id="dokumen-form">
				<div class="modal-body">
					<fieldset class="content-group">

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">University</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-direction"></i></div>
										<select name="Universityid" id="Universityid" class="select2" data-placeholder="Select University" title="Select University" required>
											<option value="<?= (isset($dMaster->universityID)) ? $dMaster->universityID : '' ?>"><?= (isset($dMaster->universityID)) ? name_university($dMaster->universityID) : '' ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="Admincampusid" id="Admincampusid" class="form-control" placeholder="Admin ID" title="Admin ID" value="<?= isset($dMaster->adminCampusID) ? $dMaster->adminCampusID : '' ?>" readonly>
						
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Full Name</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Fullname" id="Fullname" class="form-control" required="required" placeholder="Insert name" title="Insert name" value="<?= isset($dMaster->fullName) ? $dMaster->fullName : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Email</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-envelop3"></i></div>
										<input type="email" name="Email" id="Email" class="form-control" required="required" placeholder="Insert email" title="Insert email" value="<?= isset($dMaster->emaiL) ? $dMaster->emaiL : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Contact (Telp)</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-phone2"></i></div>
										<input type="number" name="Telephone" id="Telephone" class="form-control" required="required" placeholder="Insert contact" title="Insert contact" value="<?= isset($dMaster->telePhone) ? $dMaster->telePhone : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<br />
				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Cancel</button>
					<button class="btn btn-success" name="submit-dokumen" id="submit-dokumen"><i class="icon-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>