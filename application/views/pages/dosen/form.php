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
		
		<input type="hidden" name="getFaculty" id="getFaculty" value="<?= base_url('commonfunction/getFaculty') ?>">
		<input type="hidden" name="getUniv" id="getUniv" value="<?= base_url('commonfunction/getUniv') ?>">
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
								<label class="control-label col-lg-4">Upload Picture</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="file" accept="image/*" class="file-input" name="Userfile" id="Userfile" title="Upload Picture" <?= $Req; ?>>
									</div>
									<div id="image-holder">
                                        <img src="<?php echo base_url() ?><?= (isset($dMaster->profilePic)) ? $dMaster->profilePic : '' ?>" width="210" height="180" alt="">
                                        <br>
                                    </div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Select University</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-office"></i></div>
										<select name="Universityid" id="Universityid" class="select2" data-placeholder="Select University" title="Select University" required>
											<option value="<?= (isset($dMaster->universityID)) ? $dMaster->universityID : '' ?>"><?= (isset($dMaster->universityID)) ? name_university($dMaster->universityID) : '' ?></option>
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
											<option value="<?= (isset($dMaster->facultyID)) ? $dMaster->facultyID : '' ?>"><?= (isset($dMaster->facultyID)) ? name_faculty($dMaster->facultyID) : '' ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="Dosenid" id="Dosenid" class="form-control" value="<?= isset($dMaster->dosenID) ? $dMaster->dosenID : '' ?>" readonly>
						
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Nomor Induk Dosen (NID)</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Nid" id="Nid" class="form-control" required="required" placeholder="Insert NID" title="Insert NID" value="<?= isset($dMaster->dosenNumber) ? $dMaster->dosenNumber : '' ?>" required>
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
										<div class="input-group-addon"><i class="icon-phone"></i></div>
										<input type="text" name="Fixedphone" id="Fixedphone" class="form-control" required="required" placeholder="Insert Telephone" title="Insert Telephone" value="<?= isset($dMaster->fixedPhone) ? $dMaster->fixedPhone : '' ?>" required>
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
										<input type="text" name="Mobilephone" id="Mobilephone" class="form-control" required="required" placeholder="Insert Mobile phone" title="Insert Mobile phone" value="<?= isset($dMaster->mobilePhone) ? $dMaster->mobilePhone : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">City</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-direction"></i></div>
										<input type="text" name="City" id="City" class="form-control" required="required" placeholder="Insert City" title="Insert City" value="<?= isset($dMaster->city) ? $dMaster->city : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Zip postal</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-mailbox"></i></div>
										<input type="text" name="Zip" id="Zip" class="form-control" required="required" placeholder="Insert Zip postal" title="Insert Zip postal" value="<?= isset($dMaster->zip) ? $dMaster->zip : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Address</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<textarea rows="3" cols="3" name="Address" id="Address" class="form-control" required="required" placeholder="Insert Address" title="Insert Address"><?= isset($dMaster->address) ? $dMaster->address : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>
				</div>

			</fieldset>

			<div class="text-right">
				<button type="button" onclick="location.href='<?=base_url('dosen')?>'" class="btn btn-default" id="reset">Cancel <i class="icon-reload-alt position-right"></i></button>
				<button type="submit" class="btn btn-primary" id="submit-dokumen" name="submit-dokumen">Save <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
	</div>
</div>