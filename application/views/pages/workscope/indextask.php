<div class="row">
	<div class="col-md-12">
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
				<button type="button" style="<?= showLevel(array(55)); ?>" class="btn btn-success" onclick="location.href='<?=base_url('workscope/addTask/'.$workscopeID)?>'"><i class="icon-add position-left"></i> Add New Task</button>
			</div>
			<table class="table datatable-responsive-row-control table-hover">
				<thead>
					<tr style="font-size:12px;text-align:center;">
						<th>.</th>
						<th>No</th>
						<th>Task ID</th>
						<th>Task Name</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if (!empty($dtask)) {
							$no = 0;
							foreach ($dtask as $key) {
								$no++;

                                if ($key->statusTask == 'done') {
                                    $status     = 'DONE';
                                    $btn        = 'color: blue;';
                                }elseif ($key->statusTask == 'done-delay') {
                                    $status     = 'DONE DELAY';
                                    $btn        = 'color: orange;';
                                }elseif ($key->statusTask == 'on-progress') {
                                    $status     = 'ON PROGRESS';
                                    $btn        = 'color: green;';
                                }elseif ($key->statusTask == 'delay') {
                                    $status     = 'DELAY';
                                    $btn        = 'color: red;';
                                }else{
                                    $status     = 'PENDING';
                                    $btn      	= 'color: gray;';
                                }
						?>
						<tr>
							<td></td>
							<td><?= $no ?>.</td>
							<td><div class='col-md-8 text-semibold text-success'><?=$key->taskID?></div></td>
							<td><?=$key->taskName?></td>
							<td><?= date_format(date_create($key->startDate), 'd F Y') ?></td>
							<td><?= date_format(date_create($key->endDate), 'd F Y') ?></td>
							<td><?=$key->taskDesc?></td>
							<td><a style="<?= $btn?>"><?=$status?></a></td>
							<td class="text-center">
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Detail Task" style="margin: 5px" onclick="showModal('<?= base_url('workscope/modalReviewTask') ?>','<?= $key->taskID.'~'.$key->taskName ?>','edit')"><i class="icon-eye"></i></a>
								<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Edit Task" style="margin: 5px; <?= showLevel(array(55)); ?>" onclick="showModal('<?= base_url('workscope/modalEditTask') ?>','<?= $key->taskID.'~'.$key->taskName ?>','edit')"><i class="icon-quill4"></i></a>							
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