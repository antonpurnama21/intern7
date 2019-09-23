<div id="modalPortal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;<?= $modalTitle ?></h5>
			</div>

			<form class="form-horizontal form-validate-jquery" action="<?= $formAction ?>" method="post" enctype="multipart/form-data" name="dokumen-form" id="dokumen-form">
				<div class="modal-body">
					<fieldset class="content-group">

						<input type="hidden" name="Dosenid" id="Dosenid" class="form-control" placeholder="Admin ID" title="Admin ID" value="<?= $dosenID ?>" readonly>
						
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">New Password</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-lock"></i></div>
										<input type="password" name="Password1" id="Password1" class="form-control" required="required" placeholder="Insert New Password" title="Insert New Password" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Repeat Password</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-lock"></i></div>
										<input type="password" name="Password2" id="Password2" class="form-control" required="required" placeholder="Repeat Password" title="Repeat Password" required>
									</div>

									<label class="checkbox-inline">
										<input type="checkbox" onclick="myFunction()" class="styled">
										Show Password
									</label>
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