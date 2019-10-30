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
				<th>.</th>
				<th>No</th>
				<th>Project Scope</th>
				<th>Project Name</th>
				<th>Mahasiswa Name</th>
				<th>Progress</th>
				<th>Status</th>
				<th>Action</th>
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
                                    $bg = '';
                                    $status = '<span class="badge badge-default">Pending</span>';
                                }elseif ($key->statusWorkscope=='on-progress') {
                                    $btn = 'bg-green';
                                    $bg = 'bg-success';
                                    $status = '<span class="badge badge-success">On Progress</span>';
                                }else{
                                    $btn = 'btn-primary';
                                    $bg = 'bg-blue';
                                    $status = '<span class="badge badge-primary">Done</span>';
                                }
						?>
						<tr>
							<td></td>
							<td><?= $no ?>.</td>
							<td><?=ucwords($key->projectScope) ?></td>
							<td><?=name_project($key->projectID)?></td>
							<td><?=name_mhs($key->mahasiswaID) ?></td>
							<td>
								<div class="progress active" style="margin: 5px">
									<div class="progress-bar progress-bar-striped progress-bar-animated <?=$bg?>" style="width: <?=$persen?>%">
										<span><?=$persen?> %</span>
									</div>
								</div>
							</td>
							<td><?=$status?></td>
							<td class="text-center">
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="View Workscope" style="margin: 5px" onclick="location.href='<?=base_url('workscope/detail/'.$key->workscopeID) ?>'"><i class="icon-eye"></i></a>
							</td>
						</tr>
						<?php
								}
							}
						?>
				</tbody>
	</table>
</div>