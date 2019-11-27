<div id="modalPortal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;<?= $modalTitle ?></h5>
			</div>

			<input type="hidden" name="getDept" id="getDept" value="<?= base_url('commonfunction/getDept') ?>">
			<input type="hidden" name="getAdmin" id="getAdmin" value="<?= base_url('commonfunction/getAdmin') ?>">
			<form class="form-horizontal form-validate-jquery" action="<?= $formAction ?>" method="post" enctype="multipart/form-data" name="dokumen-form" id="dokumen-form">
				<div class="modal-body">
					<fieldset class="content-group">

						<input type="hidden" name="Projectid" id="Projectid" class="form-control" value="<?= isset($dMaster->projectID) ? $dMaster->projectID : '' ?>" readonly>
						
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Project Name</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-bookmark"></i></div>
										<input type="text" name="Projectname" id="Projectname" class="form-control" required="required" placeholder="Insert Project" title="Insert Project" value="<?= isset($dMaster->projectName) ? $dMaster->projectName : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Select Department</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-office"></i></div>
										<input type="text" name="Deptid" id="Deptid" class="form-control" required="required" value="<?= isset($dMaster->deptID) ? $dMaster->deptID : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Select Project Leader</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Adminid" id="Adminid" class="form-control" required="required" placeholder="Insert Project" title="Insert Project" value="<?= isset($dMaster->adminID) ? $dMaster->adminID : '' ?>" required>
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