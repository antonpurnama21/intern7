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
		<h5>Welcome, <strong><?= $sesi['sess_name']?> !</strong></h5>
	</div>
</div>
<div>
	<h2>Project Scope Progress</h2>
</div>
<div class="row">
<?php
if (!empty($dtjumlah)) {
foreach ($dtjumlah as $key) {?>

	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> <?=$key->label?> </h6>
			</div>
			
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-4 text-bold ">Total Apply </label>
						<div class="col-lg-8">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-user-check"></i></div>
								<?php
								if (!empty($dtpersen)) {
								foreach ($dtpersen as $key2) {
									if ($key2->label==$key->label) {
										$persen = $key2->value;
									?>
								<label class="control-label"><?=$key->value?> Mahasiswa ( <?=$persen?> % )</label>

							<?php }
								}
							} ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-4 text-bold ">Progress </label>
						<div class="col-lg-8">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-hour-glass"></i></div>
								<?php
								if (!empty($dtprogress)) {
								foreach ($dtprogress as $key3) {
									if ($key3->label==$key->label) {
										$persen = $key3->value;
										if ($persen == 0) {
											$badge = "danger";
										}elseif ($persen < 100 ) {
											$badge = 'success';
										}elseif($persen == 100){
											$badge = 'primary';
										}
									?>
								<label class="control-label"><span class="badge badge-<?=$badge?>"><?=$persen?> %</span></label>

							<?php }
								}
							} ?>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
<?php 
	} 
}

?>
</div>
<div>
	<h2>Notifications</h2>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title">Pending Project Scope :</h6>
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
							<th>ID</th>
							<th>Project Scope</th>
							<th>Project Name</th>
							<th>From Department</th>
							<th>Requiretment</th>
							<th>Status</th>
							<th>Approval</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (!empty($dtscope)) {
								$no = 0;
									foreach ($dtscope as $key) {
									$no++;

									if ($key->isApproved == 'Y') {
									    $approve = '<span class="badge badge-success">Yes</span>';
									}elseif ($key->isApproved=='N') {
									    $approve = '<span class="badge badge-danger">No</span>';
									}else{
									    $approve = '<span class="badge badge-default">Pending</span>';
									}

									if($key->isTaken == 1){ 
									    $status = '<span class="badge badge-success">Open</span>';
									}else{
									    $status = '<span class="badge badge-danger">Close</span>';
									}

						?>
						<tr class="text-size-mini">
							<td></td>
							<td><?= $no ?>.</td>
							<td><div class='col-md-8 text-semibold text-success'><?=$key->projectScopeID?></div></td>
							<td><?=$key->projectScope?></td>
							<td><?=name_project($key->projectID)?></td>
							<td><?=name_dept($key->deptID)?></td>
							<td><span class="badge badge-primary"><?=$key->reqQuantity?></span>&emsp;|&emsp;<span class="badge badge-success"><?=chk_totalApply($key->projectScopeID)?></span></td>
							<td><?=$status?></td>
							<td class="text-center">
								<i class="icon-hour-glass"></i> <?=$approve?>							
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