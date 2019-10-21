<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold">Profile <?= $dtmahasiswa->fullName ?> :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<div class="panel-body">
				<?php 
                if (is_null($dtmahasiswa->birthDate)) {
                    $umur = '';
                }else{
                    $d = date('Y',strtotime($dtmahasiswa->birthDate)); 
                    $d1 = date('Y');
                    $umur = $d1 - $d;   
                }?>
				<div class="col-md-9">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4 text-bold ">Nomor Induk Mahasiswa </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label text-semibold text-success"><?= $dtmahasiswa->mahasiswaNumber ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4 text-bold ">Your ID </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label text-semibold text-success"><?= $dtmahasiswa->mahasiswaID ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Full Name </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtmahasiswa->fullName ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">University </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_university($dtmahasiswa->universityID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Faculty </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_faculty($dtmahasiswa->facultyID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Age </label>
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
							<label class="control-label col-lg-4 text-bold ">Gender </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtmahasiswa->gender ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Religion </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtmahasiswa->religion ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Residence </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_residence($dtmahasiswa->residenceID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Email </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtmahasiswa->emaiL ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Contact Number </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtmahasiswa->fixedPhone.' / '.$dtmahasiswa->mobilePhone ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Address </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= ucwords($dtmahasiswa->address.', '.$dtmahasiswa->city.' ('.$dtmahasiswa->zip.')') ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Hobbies </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= nl2br(ucwords($dtmahasiswa->hobby)) ?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">File </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label">
										<?php 
										if (!empty($dtmahasiswa->resume)) {?>
										<a style="margin-bottom: 5px" class="btn btn-success btn-sm" target="_blank" href="<?php echo base_url(); ?>mahasiswa/download/resume/<?=$dtmahasiswa->mahasiswaID?>"><i class="icon-file-download"></i> resume.pdf</a><br />
										<a style="margin-bottom: 5px" class="btn btn-success btn-sm" target="_blank" href="<?php echo base_url(); ?>mahasiswa/download/transcipt/<?=$dtmahasiswa->mahasiswaID?>"><i class="icon-file-download"></i> transcipt.pdf</a>
										<?php } ?>
									</label>
								</div>
							</div>
						</div>
					</div>
					<br />

					<div class="row">
						<button style="margin-bottom: 5px" class="btn btn-primary" onclick="location.href='<?=base_url('mahasiswa/formProfile/'.$dtmahasiswa->mahasiswaID) ?>'"><i class="icon-quill4"></i> Update Profile</button>
						<a style="margin-bottom: 5px" class="btn btn-danger" onclick="showModal('<?=base_url("mahasiswa/changePass")?>', '<?=$dtmahasiswa->mahasiswaID.'~'.$dtmahasiswa->fullName?>', `editadmin`);"><i class="icon-lock"></i> Change Password</a><br />
						
					</div>
				</div>
				<div class="col-md-3">
					<div class="pull-right">
					<img src="<?= base_url().$dtmahasiswa->photo?>" style="width:240px;height:auto;" class="img-responsive" alt="">
					</div>
				</div>

			</div>
		</div>

	</div>
	
	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold">Your Activities :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			<input type="hidden" name="alamatList" id="alamatList" value="<?= base_url('log/getListByid') ?>">
			<div class="panel-body">
				<table class="table datatable-responsive-row-control table-hover">
					<thead>
						<tr style="font-size:12px;text-align:center;">
							<th>.</th>
							<th>No</th>
							<th>Email User</th>
							<th>Log Time</th>
							<th>Browser Access</th>
							<th>IP Address</th>
							<th>Pletform</th>
							<th>Type Log</th>
							<th>Description</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>
