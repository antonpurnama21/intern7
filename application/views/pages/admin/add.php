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
		
		<input type="hidden" name="getrole" id="getrole" value="<?= base_url('admin/getRole') ?>">
		<input type="hidden" name="getdept" id="getdept" value="<?= base_url('admin/getDept') ?>">
		<form class="form-horizontal form-validate-jquery" action="<?= $actionForm ?>" method="POST" name="dokumen-form" id="dokumen-form">
			<fieldset class="content-group">

				<legend class="text-semibold">
					<i class="icon-magazine position-left"></i>
					INPUT FORM					
					<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
						<i class="icon-circle-down2"></i>
					</a>
				</legend>

				<div class="collapse in" id="demo1">

					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4">Select Role Type</label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon"><i class="icon-direction"></i></div>
									<select name="Roleid" id="Roleid" class="select2" data-placeholder="Select role type" title="Select role type" required>
										<option value="<?= (isset($dMaster->roleID)) ? $dMaster->roleID : '' ?>"><?= (isset($dMaster->roleID)) ? what_role($dMaster->roleID) : '' ?></option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4">Department</label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon"><i class="icon-direction"></i></div>
									<select name="Deptid" id="Deptid" class="select2" data-placeholder="Select department" title="Select department" required>
										<option value="<?= (isset($dMaster->deptID)) ? $dMaster->deptID : '' ?>"><?= (isset($dMaster->deptID)) ? name_dept($dMaster->deptID) : '' ?></option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<input type="hidden" name="Adminid" id="Adminid" class="form-control" placeholder="Admin ID" title="Admin ID" value="<?= isset($dMaster->adminID) ? $dMaster->adminID : '' ?>" readonly>
					
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
				</div>

			</fieldset>

			<div class="text-right">
				<button type="button" onclick="location.href='<?=base_url('admin')?>'" class="btn btn-default" id="reset">Cancel <i class="icon-reload-alt position-right"></i></button>
				<button type="submit" class="btn btn-primary" id="submit-dokumen" name="submit-dokumen">Save <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
	</div>
</div>