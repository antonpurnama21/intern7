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
						Status Task : ( <?=ucwords($dMaster->statusTask)?> )
						<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo1">

						<div class="col-md-6">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-lg-4 text-bold ">Task Name :</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;"><i class="icon-hammer-wrench"></i></div>
											<label class="control-label"><?= $dMaster->taskName ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Start Date :</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;"><i class="icon-calendar "></i></div>
											<label class="control-label"><?= date_format(date_create($dMaster->startDate), 'd F Y') ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">End Date :</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;"><i class="icon-calendar "></i></div>
											<label class="control-label"><?= date_format(date_create($dMaster->endDate), 'd F Y') ?></label>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="col-md-6">
							
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Description :</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;"><i class="icon-paragraph-justify2 "></i></div>
											<label class="control-label"><?= nl2br($dMaster->taskDesc)?></label>
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