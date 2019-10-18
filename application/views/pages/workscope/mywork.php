<?php
	if (!empty($dtworkscope)) {
		$no = 0;
	foreach ($dtworkscope as $key) {
?>
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><!--<img src="<?= base_url().$key->LokasiLogo ?>" style="width:20px;height:auto;" class="img-responsive" alt="">--> Detail <?= $key->projectScope ?> :</h6>
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
                    $start = date('d M Y', strtotime($key->startDate));
                    $end = date('d M Y', strtotime($key->endDate));

                    $totalTask = chk_totalTask($key->workscopeID);
                    $totalDone = chk_totalTaskDone($key->workscopeID);
                    $persen = @($totalDone / $totalTask * 100);
                 ?>
				<div class="col-md-6">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-lg-4 text-bold ">Project Scope </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= $key->projectScope ?></label>
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
									<label class="control-label"><?= $key->projectScopeID ?></label>
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
									<label class="control-label"><?= name_project($key->projectID) ?></label>
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
									<label class="control-label"><?= name_category($key->categoryID) ?></label>
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
									<label class="control-label"><?= name_category($key->categoryID) ?></label>
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
									<label class="control-label"><?= nl2br($key->description)?></label>
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
									<label class="control-label"><?= nl2br($key->qualification)?></label>
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
									<label class="control-label"><?= date_format(date_create($key->startDate), 'd F Y') ?></label>
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
									<label class="control-label"><?= date_format(date_create($key->endDate), 'd F Y') ?></label>
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
									<label class="control-label"><?= $key->reqQuantity ?></label>
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
									<label class="control-label"><?= name_admin($key->createdBY) ?></label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Name Mahasiswa </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?= name_mhs($key->mahasiswaID) ?></label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group ">
							<label class="control-label col-lg-4 text-bold ">Progress (%) </label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding-top:0px;">:</div>
									<label class="control-label"><?=$persen?> %</label>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>

<!-- <h1><?php 
	$date = date('Y-m-d', strtotime('+7 day'));
	echo $date++;
 ?></h1> -->

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title">Progress Timeline :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div><br />
			<div class="ml-20">
				<button type="button" class="btn btn-success" onclick="location.href='<?=base_url('workscope/manageTask/'.$key->workscopeID)?>'"><i class="icon-add position-left"></i> Manage Task</button>
			</div>
			<div class="panel-body">
				<input type="hidden" name="getTimeline" id="getTimeline" value="<?= base_url('workscope/getTimeline') ?>">
				<div id='calendar'></div><br />	
			</div>
		</div>

	</div>
</div>
<?php 
}
}else{
?>
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold">Not Found</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div>
			
			<div class="panel-body">
				<p>Not Found</p>
			</div>
		</div>

	</div>
</div>
<?php } ?>
