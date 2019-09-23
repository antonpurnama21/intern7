<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><i class="icon-law"></i><?= $breadcrumb[1] ?></h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="ml-20">

	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th></th>
				<th width="5%">No</th>
				<th width="45%">Information</th>
				<th width="35%">Status</th>
				<th width="15%">Action</th>
			</tr>
		</thead>
		<tbody>
						<?php
							if (!empty($dtworkscope)) {
							$no = 0;
							foreach ($dtworkscope as $key) {
								$no++;

								$start = new DateTime($key->startDate);
                                $end = new DateTime($key->endDate);
                                $interval = $start->diff($end);
                                $totalTask = chk_totalTask($key->workscopeID);
                                $totalDone = chk_totalTaskDone($key->workscopeID);
                                $persen = @($totalDone / $totalTask * 100);

                                if ($key->statusWorkscope=='pending') {
                                    $btn = 'btn-secondary';
                                    $status = 'Pending';
                                }elseif ($key->statusWorkscope=='on-progress') {
                                    $btn = 'btn-success';
                                    $status = 'On Progress';
                                }else{
                                    $btn = 'btn-primary';
                                    $status = 'Done';
                                }
						?>
						<tr>
							<td></td>
							<td><?= $no ?>.</td>
							<td>
								 <div class='row' style='height:5px'>
								 	<div class='col-md-4 text-right text-bold'>Project Scope :</div>
								 	<div class='col-md-8 text-semibold text-success'><?=ucwords($key->projectScope) ?></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Project Name :</div>
									<div class='col-md-8'><?=name_project($key->projectID)?></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Mahasiswa Name :</div>
									<div class='col-md-8'><?=name_mhs($key->mahasiswaID) ?></div>
								 </div>
							</td>
							<td>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Progress :</div>
									<div class='col-md-8'>
										<div class="progress active" style="margin-bottom: 5px">
											<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$persen?>%">
												<span><?=$persen?> %</span>
											</div>
										</div>
									</div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Status :</div>
									<div class='col-md-8'><?=$status?></div>
								 </div>
							</td>
							<td class="text-center">
								<button data-placement="top" data-popup="tooltip" title="View Workscope" style="margin-bottom: 5px" type="button" class="btn btn-primary" onclick="location.href='<?=base_url('workscope/detail/'.$key->workscopeID) ?>'"><i class="icon-eye"></i></button>
							</td>
						</tr>
						<?php
								}
							}
						?>
				</tbody>
	</table>
</div>