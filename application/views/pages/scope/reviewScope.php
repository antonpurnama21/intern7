<div id="modalPortal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;<?= $modalTitle ?></h5>
			</div>

			<div class="modal-body">

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Project Scope Review
						<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo1">

						<div class="col-md-6">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-lg-4 text-bold ">Project Scope </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->projectScope ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Project Scope ID </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->projectScopeID ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Project Name </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_project($dMaster->projectID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Category </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_category($dMaster->categoryID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Department </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_department($dMaster->deptID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Description </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br($dMaster->description)?></label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Qualification </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br($dMaster->qualification)?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Start Date  </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= date_format(date_create($dMaster->startDate), 'd F Y') ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">End Date  </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= date_format(date_create($dMaster->endDate), 'd F Y') ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Requiretment </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->reqQuantity ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Is Taken </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= isTaken($dMaster->isTaken) ?></label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Is Approve </label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= isApprove($dMaster->isApproved) ?></label>
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