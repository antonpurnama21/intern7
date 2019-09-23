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
		
		<input type="hidden" name="getFaculty" id="getFaculty" value="<?= base_url('mahasiswa/getFaculty') ?>">
		<input type="hidden" name="getUniv" id="getUniv" value="<?= base_url('mahasiswa/getUniv') ?>">
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
								<label class="control-label col-lg-4">Select University</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-office"></i></div>
										<select name="Universityid" id="Universityid" class="select2" data-placeholder="Select University" title="Select University" required>
											<option value=""></option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Select Faculty</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-office"></i></div>
										<select name="Facultyid" id="Facultyid" class="select2" data-placeholder="Select Faculty" title="Select Faculty" required>
											<option value=""></option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Nomor Induk Mahasiswa (NIM)</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Nim" id="Nim" class="form-control" required="required" placeholder="Insert NIM" title="Insert NIM" value="" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Full Name</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Fullname" id="Fullname" class="form-control" required="required" placeholder="Insert name" title="Insert name" value="" required>
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
										<input type="email" name="Email" id="Email" class="form-control" required="required" placeholder="Insert email" title="Insert email" value="" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Mobile Phone</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-phone2"></i></div>
										<input type="text" name="Mobilephone" id="Mobilephone" class="form-control" required="required" placeholder="Insert Mobile phone" title="Insert Mobile phone" value="" required>
									</div>
								</div>
							</div>
						</div>
				</div>

			</fieldset>

			<div class="text-right">
				<button type="button" onclick="location.href='<?=base_url('mahasiswa')?>'" class="btn btn-default" id="reset">Cancel <i class="icon-reload-alt position-right"></i></button>
				<button type="submit" class="btn btn-primary" id="submit-dokumen" name="submit-dokumen">Save <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
	</div>
</div>