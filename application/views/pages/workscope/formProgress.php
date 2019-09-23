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
						<input type="hidden" name="Taskid" id="Taskid" value="<?=$taskID?>">
						<input type="hidden" name="Progressid" id="Progressid" class="form-control" value="<?= isset($dMaster->progressID) ? $dMaster->progressID : '' ?>" readonly>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Progress</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<textarea rows="3" cols="3" name="Progress" id="Progress" class="form-control" required="required" placeholder="Insert Progress Task" title="Insert Progress Task"><?= isset($dMaster->progress) ? $dMaster->progress : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Finding</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<textarea rows="3" cols="3" name="Finding" id="Finding" class="form-control" required="required" placeholder="Insert Finding" title="Insert Finding"><?= isset($dMaster->finding) ? $dMaster->finding : '' ?></textarea>
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