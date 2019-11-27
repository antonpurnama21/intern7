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
									<label class="control-label"><?= name_dept($dtscope->deptID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Project Leader </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_admin($dtscope->adminID) ?></label>
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
	                            <th>.</th>
	                            <th>No</th>
	                            <th>NIM</th>
	                            <th>Nama Mahasiswa</th>
	                            <th>University</th>
	                            <th>Type</th>
	                            <th>Status</th>
	                            <th>Action</th>
	                         </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!empty($dtmp)) {
								$no = 0;
								foreach ($dtmp as $key) {
									$no++;

                                	if ($key->type == 'canceled') {
                                		$buton = 'disabled';
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
                                <td><?=$key->mahasiswaNumber ?></td>
                                <td><?=ucwords($key->fullName)?></td>
                                <td><?=name_university($key->universityID)?></td>
                                <td><b><?=strtoupper($key->type)?></b></td>
                                <td><b><?=$status?></b></td>
                                <td>
                                    <a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="View Mahasiswa" style="margin: 5px" onclick="showModal('<?=base_url('scope/modalMahasiswa') ?>', '<?=$key->mahasiswaID.'~'.$key->fullName?>', 'review');"><i class="icon-eye2"></i></a>
                                	<?php if($key->statusTemp == 'accepted'){ ?>
                                    <span class="badge badge-success" style="margin: 5px"><i class="icon-checkmark"> ACCEPTED</i></span>
                                	<?php }elseif ($key->statusTemp == 'rejected') { ?>
                                    <span class="badge badge-danger" style="margin: 5px"><i class="icon-cross2"> REJECTED</i></span>
                                	<?php }else{ ?>
                                    <a class="btn btn-success" data-placement="left" data-popup="tooltip" title="Accept Mahasiswa" style="margin: 5px" onclick="confirms('Accept','`<?=$key->fullName?>` ?','<?=base_url('scope/do_accept')?>','<?=$key->tempID?>')" <?=$buton?> title="Accepted"><i class="icon-checkmark"></i></a>   
                                    <a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Reject Mahasiswa" style="margin: 5px;" onclick="confirms('Reject','`<?=$key->fullName?>` ?','<?=base_url('scope/do_reject')?>','<?=$key->tempID?>')" title="Denied"><i class="icon-cross2"></i></a>
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
