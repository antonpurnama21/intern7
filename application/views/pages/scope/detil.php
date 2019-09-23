<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><!--<img src="<?= base_url().$dtscope->LokasiLogo ?>" style="width:20px;height:auto;" class="img-responsive" alt="">--> Detail <?= $dtscope->projectScope ?> :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<div class="panel-body">
				<div class="col-md-6">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4 text-bold ">Project Scope </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $dtscope->projectScope ?></label>
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
									<label class="control-label"><?= $dtscope->projectScopeID ?></label>
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
									<label class="control-label"><?= name_project($dtscope->projectID) ?></label>
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
									<label class="control-label"><?= name_category($dtscope->categoryID) ?></label>
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
									<label class="control-label"><?= name_category($dtscope->categoryID) ?></label>
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
									<label class="control-label"><?= nl2br($dtscope->description)?></label>
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
									<label class="control-label"><?= nl2br($dtscope->qualification)?></label>
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
									<label class="control-label"><?= date_format(date_create($dtscope->startDate), 'd F Y') ?></label>
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
									<label class="control-label"><?= date_format(date_create($dtscope->endDate), 'd F Y') ?></label>
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
									<label class="control-label"><?= $dtscope->reqQuantity ?></label>
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
									<label class="control-label"><?= isTaken($dtscope->isTaken) ?></label>
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
									<label class="control-label"><?= isApprove($dtscope->isApproved) ?></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title">List Applier <?= $dtscope->projectScope ?> :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<div class="panel-body">

				<table class="table datatable-responsive-row-control table-hover">
					<thead>
	                        <tr style="font-size:12px;text-align:center;">
	                            <th></th>
	                            <th width="10%">No</th>
	                            <th width="40%">Mahasiswa Information</th>
	                            <th width="20%">Status</th>
	                            <th width="30%">Action</th>
	                         </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!empty($dtmp)) {
								$no = 0;
								foreach ($dtmp as $key) {
									$no++;

                                if ($key->type == 'canceled') {
                                $buton = "disabled";
                                    }else{
                                        $buton = '';
                                    }
                                    if ($key->statusTemp == "") {
                                        $status = "NONE";
                                    }else{
                                        $status = strtoupper($key->statusTemp);
                                    }
                                ?>
                            <tr>
                            	<td></td>
                                <td><?= $no ?>.</td>
								<td>
									 <div class='row' style='height:5px'>
									 	<div class='col-md-4 text-right text-bold'>NIM :</div>
									 	<div class='col-md-8 text-semibold text-success'><?=$key->mahasiswaNumber ?></div>
									 </div>
									 <br/>
									 <div class='row' style='height:5px'>
										<div class='col-md-4 text-right text-bold'>Mahasiswa Name :</div>
										<div class='col-md-8'><?=ucwords($key->fullName)?></div>
									 </div>
									 <br/>
									 <div class='row' style='height:5px'>
										<div class='col-md-4 text-right text-bold'>University :</div>
										<div class='col-md-8'><?=name_university($key->universityID)?></div>
									 </div>
									 <br/>
									 <div class='row nomargin' style='height:5px'>
										<div class='col-md-4 text-right text-bold'>Faculty :</div>
										<div class='col-md-8'><?=name_faculty($key->facultyID)?></div>
									 </div>
								</td>
								<td>
									 <div class='row' style='height:5px'>
										<div class='col-md-4 text-right text-bold'>Type :</div>
										<div class='col-md-8'><b><?=strtoupper($key->type)?></b></div>
									 </div>
									 <br/>
									 <div class='row' style='height:5px'>
										<div class='col-md-4 text-right text-bold'>Status :</div>
										<div class='col-md-8'><b><?=$status?></b></div>
									 </div>
								</td>
                                <td>
                                    <button data-placement="left" data-popup="tooltip" title="View Mahasiswa" style="margin-bottom: 5px" onclick="showModal('<?=base_url('scope/modalMahasiswa') ?>', '<?=$key->mahasiswaID.'~'.$key->fullName?>', 'review');" class="btn btn-primary btn-sm"><i class="icon-eye2"></i></button>
                                <?php if($key->statusTemp == 'accepted'){ ?>
                                    <a style="margin-bottom: 5px" href="#" class="btn btn-default btn-sm"><i class="icon-checkmark"> Accepted</i></a>
                                <?php }elseif ($status == 'rejected') { ?>
                                    <a style="margin-bottom: 5px" href="#" class="btn btn-default btn-sm"><i class="icon-cross2"> Rejected</i></a>
                                <?php }else{ ?>
                                    <a data-placement="left" data-popup="tooltip" title="Accept Mahasiswa" style="margin-bottom: 5px" onclick="confirms('Accept','`<?=$key->fullName?>` ?','<?=base_url('scope/do_accept')?>','<?=$key->tempID?>')" class="btn btn-primary btn-sm <?=$buton?>" title="Accepted"><i class="icon-checkmark"></i></a>   
                                    <a data-placement="left" data-popup="tooltip" title="Reject Mahasiswa" style="margin-bottom: 5px" onclick="confirms('Reject','`<?=$key->fullName?>` ?','<?=base_url('scope/do_reject')?>','<?=$key->tempID?>')" class="btn btn-danger btn-sm" style="color: white;" title="Denied"><i class="icon-cross2"></i></a>
                                <?php } ?>
                                </td>
                            </tr>
                            <?php
                              }
                            }
                              ?>
                        </tbody>
				</table>
			</div>
		</div>

	</div>
</div>
