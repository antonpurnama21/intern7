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
		<input type="hidden" name="getResidence" id="getResidence" value="<?= base_url('mahasiswa/getResidence') ?>">
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
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">User ID</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="text" name="Mahasiswaid" id="Mahasiswaid" class="form-control" value="<?= isset($dMaster->mahasiswaID) ? $dMaster->mahasiswaID : '' ?>" readonly>
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
										<input type="text" name="Nim" id="Nim" class="form-control" required="required" placeholder="Insert NIM" title="Insert NIM" value="<?= isset($dMaster->mahasiswaNumber) ? $dMaster->mahasiswaNumber : '' ?>" required>
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
								<label class="control-label col-lg-4">Birth Place</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<input type="text" name="Birthplace" id="Birthplace" class="form-control" required="required" placeholder="Insert birth place" title="Insert birth place" value="<?=isset($dMaster->birthPlace) ? $dMaster->birthPlace : '' ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Birth Date</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-calendar"></i></div>
										<input type="text" name="Birthdate" id="Birthdate" class="form-control pickadate" required="required" placeholder="Pick date" title="Pick date" value="<?= isset($dMaster->birthDate) ? date_format(date_create($dMaster->birthDate), 'd F Y') : '' ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Jenis Kelamin </label>
								<div class="col-lg-8">
									<label class="radio-inline">
										<input type="radio" name="Gender" id="Gender" class="styled" title="Pick gender" value="male" <?= ((isset($dMaster->gender)) && ($dMaster->gender == "male")) ? 'checked' : '' ?> required="required">
										Male
									</label>

									<label class="radio-inline">
										<input type="radio" name="Gender" id="Gender" value="female" <?= ((isset($dMaster->gender)) && ($dMaster->gender == "female")) ? 'checked' : '' ?> class="styled">
										Female
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Religion</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-envelop3"></i></div>
										<input type="text" name="Religion" id="Religion" class="form-control" required="required" placeholder="Insert religion" title="Insert religion" value="<?= isset($dMaster->religion) ? $dMaster->religion : '' ?>" required>
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
								<label class="control-label col-lg-4">Select Residence</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-office"></i></div>
										<select name="Residenceid" id="Residenceid" class="select2" data-placeholder="Select Residence" title="Select Residence" required>
											<option value="<?= (isset($dMaster->residenceID)) ? $dMaster->residenceID : '' ?>"><?= (isset($dMaster->residenceID)) ? name_residence($dMaster->residenceID) : '' ?></option>
										</select>
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
								<label class="control-label col-lg-4">Hobby and Free Time Activities</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-map"></i></div>
										<textarea rows="3" cols="3" name="Hobby" id="Hobby" class="form-control" required="required" placeholder="Insert Hobby" title="Insert Hobby"><?= isset($dMaster->hobby) ? $dMaster->hobby : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>

					</div>

				</fieldset>

				<fieldset class="content-group">
					<legend class="text-semibold">
						<i class="icon-archive position-left"></i>
						Self Evaluation
						<a class="control-arrow" data-toggle="collapse" data-target="#demo2">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo2">

						<div class="col-md-6">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-lg-4">Strength (3 Point)</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon"><i class="icon-file-plus"></i></div>
											<textarea rows="5" cols="5" name="Strength" id="Strength" class="form-control" required="required" placeholder="Insert 3 Point of Your Strength" title="Insert 3 Point of Your Strength"><?= isset($dMaster->strength) ? $dMaster->strength : '' ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">

							<div class="row">
								<div class="form-group">
									<label class="control-label col-lg-4">Weakness (3 Point)</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon"><i class="icon-file-minus"></i></div>
											<textarea rows="5" cols="5" name="Weakness" id="Weakness" class="form-control" required="required" placeholder="Insert 3 Point of Your Weakness" title="Insert 3 Point of Your Weakness"><?= isset($dMaster->weakness) ? $dMaster->weakness : '' ?></textarea>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>

				</fieldset>

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-archive position-left"></i>
						Experience
						<a class="control-arrow" data-toggle="collapse" data-target="#demo3">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo3">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Organization Experience</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-bookmark"></i></div>
										<textarea rows="5" cols="5" name="Organizationexp" id="Organizationexp" class="form-control" required="required" placeholder="Insert Your Experience" title="Insert Your Experience"><?= isset($dMaster->organizationExp) ? $dMaster->organizationExp : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Project Ever Made</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-archive"></i></div>
										<textarea rows="5" cols="5" name="Projectevermade" id="Projectevermade" class="form-control" required="required" placeholder="Insert Your Project" title="Insert Your Project"><?= isset($dMaster->projectEverMade) ? $dMaster->projectEverMade : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>
						

					</div>

				</fieldset>

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-stack position-left"></i>
						Photo , Resume/cv, Academic Transcipt
						<a class="control-arrow" data-toggle="collapse" data-target="#demo4">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo4">

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Semester Academic</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-book"></i></div>
										<input type="text" name="Semester" id="Semester" class="form-control" required="required" placeholder="Insert Semester" title="Insert Semester" value="<?= isset($dMaster->semester) ? $dMaster->semester : '' ?>" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">SKS Total</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-book"></i></div>
										<input type="text" name="Skstotal" id="Skstotal" class="form-control" required="required" placeholder="Insert Total SKS" title="Insert Total SKS" value="<?= isset($dMaster->sksTotal) ? $dMaster->sksTotal : '' ?>" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">IPK Total</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-book"></i></div>
										<input type="text" name="Indextotal" id="Indextotal" class="form-control" required="required" placeholder="Insert Total IPK" title="Insert Total IPK" value="<?= isset($dMaster->indexTotal) ? $dMaster->indexTotal : '' ?>" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Upload Picture {alowed type: jpeg,jpg,png} {max: 1024KB}</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-user-tie"></i></div>
										<input type="file" accept="image/*" class="file-input" name="Photofile" id="Photofile" title="Upload Picture" <?= $Req; ?>>
									</div>
									<div id="image-holder">
                                        <img src="<?php echo base_url() ?><?= (isset($dMaster->photo)) ? $dMaster->photo : '' ?>" width="210" height="180" alt="">
                                        <br>
                                    </div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Upload CV / Resume {alowed type: pdf} {max: 512KB}</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-file-plus"></i></div>
										<input type="file" accept="application/pdf" class="file-input" name="Cvfile" id="Cvfile" title="Upload Resume" <?= $Req; ?>>
									</div>
									<div>
                                        Existing File : <a href="<?php echo base_url() ?><?= (isset($dMaster->resume)) ? $dMaster->resume : '' ?>">Resume/cv.pdf</a>
                                        <br>
                                    </div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label class="control-label col-lg-4">Upload Academic Transcipt {alowed type: pdf} {max: 512KB}</label>
								<div class="col-lg-8">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-file-plus"></i></div>
										<input type="file" accept="application/pdf" class="file-input" name="Acfile" id="Acfile" title="Upload Academic Transcipt" <?= $Req; ?>>
									</div>
									<div>
										Existing File : <a href="<?php echo base_url() ?><?= (isset($dMaster->academicTranscipt)) ? $dMaster->academicTranscipt : '' ?>">Academic Transcipt.pdf</a>
                                        <br>
                                    </div>
								</div>
							</div>
						</div>

					</div>

				</fieldset>
				
				<div class="text-right">
				<button type="button" onclick="location.href='<?=base_url('mahasiswa/profile')?>'" class="btn btn-default" id="reset">Cancel <i class="icon-reload-alt position-right"></i></button>
				<button type="submit" class="btn btn-primary" id="submit-dokumen" name="submit-dokumen">Save <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
	</div>
</div>