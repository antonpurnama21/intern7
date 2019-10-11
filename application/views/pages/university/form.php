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

						<input type="hidden" name="Universityid" id="Universityid" class="form-control" placeholder="Admin ID" title="Admin ID" value="<?= isset($dMaster->UniversityID) ? $dMaster->UniversityID : '' ?>" readonly>
						
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">University</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Universityname" id="Universityname" class="form-control" required="required" placeholder="Insert University" title="Insert University" value="<?= isset($dMaster->UniversityName) ? $dMaster->UniversityName : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">MOU ACCEPTED </label>
								<div class="col-lg-8">
									<label class="radio-inline">
										<input type="radio" name="Mou" id="Mou" class="styled" value="YES" <?= ((isset($dMaster->mou)) && ($dMaster->mou == "YES")) ? 'checked' : '' ?> required="required">
										YES
									</label>

									<label class="radio-inline">
										<input type="radio" name="Mou" id="Mou" value="NO" <?= ((isset($dMaster->mou)) && ($dMaster->mou == "NO")) ? 'checked' : '' ?> class="styled">
										NO
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