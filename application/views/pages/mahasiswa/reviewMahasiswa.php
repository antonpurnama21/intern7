<div id="modalPortal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;<?= $modalTitle ?></h5>
			</div>

			<div class="modal-body">
					<div class="col-md-3" style="margin-right: 10px; margin-top: 10px">
						<img src="<?= base_url().$dMaster->photo?>" style="width:240px;height:auto;" class="img-responsive" alt="">
					</div>
				<fieldset class="content-group">
					
					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Profile Mahasiswa
						<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo1">

						<?php 
                        if (is_null($dMaster->birthDate)) {
                            $umur = '';
                        }else{
                            $d = date('Y',strtotime($dMaster->birthDate)); 
                            $d1 = date('Y');
                            $umur = $d1 - $d;   
                        }?>

						<div class="col-md-12">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-lg-4 text-bold ">Nomor Induk Mahasiswa</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->mahasiswaNumber ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Full Name</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->fullName ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">University</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_university($dMaster->universityID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Faculty</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_faculty($dMaster->facultyID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Age</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $umur ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Gender</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->gender ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Religion</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->religion ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Residence</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= name_residence($dMaster->residenceID) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Email</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->emaiL ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Contact Number</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->fixedPhone.' / '.$dMaster->mobilePhone ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Address</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= ucwords($dMaster->address.', '.$dMaster->city.' ('.$dMaster->zip.')') ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Hobbies</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br(ucwords($dMaster->hobby)) ?></label>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

				</fieldset>

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Self Evaluation
						<a class="control-arrow" data-toggle="collapse" data-target="#demo2">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo2">

						<div class="col-md-6">

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Strength</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br(ucwords($dMaster->strength)) ?></label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Weakness</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br(ucwords($dMaster->weakness)) ?></label>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>

				</fieldset>

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Mahasiswa Experience
						<a class="control-arrow" data-toggle="collapse" data-target="#demo3">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo3">

						<div class="col-md-12">

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Organization Experience</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br(ucwords($dMaster->organizationExp)) ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Project Ever Made</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= nl2br(ucwords($dMaster->projectEverMade)) ?></label>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>

				</fieldset>

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Mahasiswa Document
						<a class="control-arrow" data-toggle="collapse" data-target="#demo4">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo4">

						<div class="col-md-6">

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Semester</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->semester ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">SKS Total</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->sksTotal ?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Index Total (IPK)</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?= $dMaster->indexTotal ?></label>
										</div>
									</div>
								</div>
							</div>
							
						</div>

						<div class="col-md-6">

							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">File</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label">
												<a style="margin-bottom: 5px" class="btn btn-success btn-sm" href="<?php echo base_url(); ?>mahasiswa/download/resume/<?=$dMaster->mahasiswaID?>"><i class="icon-file-download"></i> resume.pdf</a><br /><a style="margin-bottom: 5px" class="btn btn-success btn-sm" href="<?php echo base_url(); ?>mahasiswa/download/transcipt/<?=$dMaster->mahasiswaID?>"><i class="icon-file-download"></i> transcipt.pdf</a>
											</label>
										</div>
									</div>
								</div>
							</div>
							
						</div>

					</div>

				</fieldset>

				<fieldset class="content-group">

					<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Project On Board
						<a class="control-arrow" data-toggle="collapse" data-target="#demo5">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo5">
						<?php 
						if (!empty($dtworkscope)) {
							foreach ($dtworkscope as $key) {?>
								
						<div class="col-md-12">
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Project Name</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?=name_project($key->projectID)?></label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Project Scope</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?=$key->projectScope?></label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group ">
									<label class="control-label col-lg-4 text-bold ">Department</label>
									<div class="col-lg-8">
										<div class="input-group">
											<div class="input-group-addon" style="padding-top:0px;">:</div>
											<label class="control-label"><?=name_dept($key->deptID)?></label>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<?php }
						}
						 ?>
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