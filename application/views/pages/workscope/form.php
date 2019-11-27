<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><i class="icon-law"></i> <?= $breadcrumb[1] ?></h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="panel-body">
		
		<input type="hidden" name="getCategory" id="getCategory" value="<?= base_url('commonfunction/getCategory') ?>">
		<input type="hidden" name="getProject" id="getProject" value="<?= base_url('commonfunction/getProject') ?>">
		
		<form class="form-horizontal form-validate-jquery" action="<?= $actionForm ?>" method="POST" name="dokumen-form" id="dokumen-form">
			<fieldset class="content-group">

				<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Project Scope Data
						<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo1">

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Select Category</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-bookmark"></i></div>
										<select name="Categoryid" id="Categoryid" class="select2" data-placeholder="Select Category" title="Select Category" required>
											<option value="<?= (isset($dMaster->categoryID)) ? $dMaster->categoryID : '' ?>"><?= (isset($dMaster->categoryID)) ? name_category($dMaster->categoryID) : '' ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Select Project</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-office"></i></div>
										<select name="Projectid" id="Projectid" class="select2" data-placeholder="Select Project" title="Select Project" required>
											<option value="<?= (isset($dMaster->projectID)) ? $dMaster->projectID : '' ?>"><?= (isset($dMaster->projectID)) ? name_project($dMaster->projectID) : '' ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="Projectscopeid" id="Projectscopeid" class="form-control" value="<?= isset($dMaster->projectScopeID) ? $dMaster->projectScopeID : '' ?>" readonly>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Project Scope</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Projectscope" id="Projectscope" class="form-control" required="required" placeholder="Insert Project Scope" title="Insert Project Scope" value="<?= isset($dMaster->projectScope) ? $dMaster->projectScope : '' ?>" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Description</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<textarea rows="3" cols="3" name="Description" id="Description" class="form-control" required="required" placeholder="Insert Description" title="Insert Description"><?= isset($dMaster->description) ? $dMaster->description : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Qualification</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<textarea rows="3" cols="3" name="Qualification" id="Qualification" class="form-control" required="required" placeholder="Insert Qualification" title="Insert Qualification"><?= isset($dMaster->qualification) ? $dMaster->qualification : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Start Date</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-calendar"></i></div>
										<input type="text" name="Startdate" id="Startdate" class="form-control pickadate" required="required" placeholder="Pick Start Date" title="Pick Start Date" value="<?= isset($dMaster->startDate) ? date_format(date_create($dMaster->startDate), 'd F Y') : '' ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">End Date</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-calendar"></i></div>
										<input type="text" name="Enddate" id="Enddate" class="form-control pickadate" required="required" placeholder="Pick End Date" title="Pick End Date" value="<?= isset($dMaster->endDate) ? date_format(date_create($dMaster->endDate), 'd F Y') : '' ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Request Quantity</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-file-plus"></i></div>
										<input type="text" name="Quantity" id="Quantity" class="form-control" required="required" placeholder="Insert Quantity" title="Insert Quantity" value="<?= isset($dMaster->reqQuantity) ? $dMaster->reqQuantity : '' ?>" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Is Taken </label>
								<div class="col-lg-8">
									<label class="radio-inline">
										<input type="radio" name="Istaken" id="Istaken" class="styled" value="1" <?= ((isset($dMaster->isTaken)) && ($dMaster->isTaken == "1")) ? 'checked' : '' ?> required="required">
										Yes
									</label>

									<label class="radio-inline">
										<input type="radio" name="Istaken" id="Istaken" value="0" <?= ((isset($dMaster->isTaken)) && ($dMaster->isTaken == "0")) ? 'checked' : '' ?> class="styled">
										No
									</label>
								</div>
							</div>
						</div>

					</div>

			</fieldset>

			<div class="text-right">
				<button type="button" onclick="location.href='<?=base_url('scope/manage')?>'" class="btn btn-default" id="reset">Cancel <i class="icon-reload-alt position-right"></i></button>
				<button type="submit" class="btn btn-primary" id="submit-dokumen" name="submit-dokumen">Save <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
	</div>
</div>