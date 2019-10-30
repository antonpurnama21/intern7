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

<div class="row">
	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Mahasiswa Total ( <?=$jmlMhs ?> )</h6>
			</div>
			
			<div class="panel-body">
				<?php
				if (!empty($dtmhs)) {
				foreach ($dtmhs as $mhs) {?>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold "><?=$mhs->label?> </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-users2"></i></div>
								<label class="control-label"><?=$mhs->value?></label>
							</div>
						</div>
					</div>
				</div>
			<?php }} ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Project Total ( <?=$jmlProject ?> )</h6>
			</div>
			
			<div class="panel-body">
				<?php
				if (!empty($dtprj)) {
				foreach ($dtprj as $prj) {?>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold "><?=$prj->label?> </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-cube4"></i></div>
								<label class="control-label"><?=$prj->value?></label>
							</div>
						</div>
					</div>
				</div>
				<?php }} ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Project Scope Total ( <?=$jmlScope ?> )</h6>
			</div>
			
			<div class="panel-body">
				<?php
				if (!empty($dtscp)) {
				foreach ($dtscp as $scope) {?>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold "><?=$scope->label?>  </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-clipboard5"></i></div>
								<label class="control-label"><?=$scope->value?></label>
							</div>
						</div>
					</div>
				</div>
				<?php }} ?>
			</div>
		</div>
	</div>

</div>

<div class="row">
<?php
if (!empty($dtjumlah)) {
foreach ($dtjumlah as $key) {?>

	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> <?=$key->label?> ( Project Scope )</h6>
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
								<label class="control-label"><?=$key->value?> Mahasiswa ( <strong><?=$persen?> % </strong> from all )</label>

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
											$persen = 'primary';
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

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title">Pending Account :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse" class="active"></a></li>
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
							<th>Login ID</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (!empty($dtaccount)) {
								$no = 0;
							foreach ($dtaccount as $key) {
							$no++;
							if ($key->statuS == 'new') {
								$status = '<span class="badge badge-success">New</span>';
							}elseif ($key->statuS == 'new-mahasiswa') {
								$status = '<span class="badge badge-success">New Mahasiswa</span>';
							}elseif ($key->statuS == 'reset') {
								$status = '<span class="badge badge-warning">Reset Password</span>';
							}else{
								$status = 'Revoke';
							}
						?>
						<tr class="text-size-mini">
							<td></td>
							<td><?= $no ?>.</td>
							<td><?= $key->loginID ?></td>
							<td>
								<?= $key->emaiL ?>  <?=$status?>
							</td>
							<td><?= what_role($key->roleID) ?></td>
							<td>
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Batalkan Reset / Setup Link" style="margin: 5px" onclick="confirms('Revoke','Account `<?= $key->emaiL ?>`?','<?= base_url('account/do_revoke') ?>','<?= $key->emaiL ?>')"><i class="icon-blocked"></i></a>
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Kirim Kembali Setup Link" style="margin: 5px" onclick="confirms('Resend Setup Link','For Account `<?= $key->emaiL ?>`?','<?= base_url('account/do_resend') ?>','<?= $key->emaiL ?>')"><i class="icon-sync"></i></a>
								<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Delete Account" style="margin: 5px;" onclick="confirms('Delete','Account `<?= $key->emaiL ?>`?','<?= base_url('account/delete') ?>','<?= $key->loginID ?>')"><i class="icon-trash"></i></a>
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
							<th>Action</th>
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
							<td><b><?=$approve?></b></td>
							<td class="text-center">
								<a class="btn btn-success" data-placement="left" data-popup="tooltip" title="Setujui Project Scope" style="margin: 5px" onclick="confirms('Publish','Project Scope `<?= $key->projectScope ?>`?','<?= base_url('scope/do_approve') ?>','<?= $key->projectScopeID ?>')"><i class="icon-clipboard2"></i></a>
								<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Tolak Project Scope" style="margin: 5px;" onclick="confirms('Deny','Deny This Project Scope `<?= $key->projectScope ?>`?','<?= base_url('scope/not_approve') ?>','<?= $key->projectScopeID ?>')"><i class="icon-blocked"></i></a>								
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
