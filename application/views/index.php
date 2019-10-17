<div class="row">

	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Mahasiswa Total</h6>
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
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Project Total</h6>
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
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Project Scope Total</h6>
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
							<th width="10">No</th>
							<th width="10">Login ID</th>
							<th>Email</th>
							<th>Role</th>
							<th width="20">Action</th>
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
							<td><?= $no ?>.</td>
							<td><?= $key->loginID ?></td>
							<td>
								<?= $key->emaiL ?>  <?=$status?>
							</td>
							<td><?= what_role($key->roleID) ?></td>
							<td>
								<a data-placement="left" data-popup="tooltip" title="Batalkan Reset / Setup Link" style="margin: 10px" onclick="confirms('Revoke','Account `<?= $key->emaiL ?>`?','<?= base_url('account/do_revoke') ?>','<?= $key->emaiL ?>')"><i class="icon-blocked"></i></a>
								<a data-placement="left" data-popup="tooltip" title="Kirim Kembali Setup Link" style="margin: 10px" onclick="confirms('Resend Setup Link','For Account `<?= $key->emaiL ?>`?','<?= base_url('account/do_resend') ?>','<?= $key->emaiL ?>')"><i class="icon-sync"></i></a>
								<a data-placement="left" data-popup="tooltip" title="Delete Account" style="margin: 10px; color: red;" onclick="confirms('Delete','Account `<?= $key->emaiL ?>`?','<?= base_url('account/delete') ?>','<?= $key->loginID ?>')"><i class="icon-trash"></i></a>
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
							<th width="10">No</th>
							<th>Information</th>
							<th>Requiretment</th>
							<th width="20">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (!empty($dtscope)) {
								$no = 0;
									foreach ($dtscope as $key) {
									$no++;

									if ($key->isApproved == 'Y') {
									    $approve = 'Yes';
									    $btn = 'btn-primary';
									}elseif ($key->isApproved=='N') {
									    $approve = 'No';
									    $btn = 'btn-danger';
									}else{
									    $approve = 'Pending';
									    $btn = 'btn-default';
									}
									if($key->isTaken == 1){ 
									    $status = '<b>Open</b>';
									}else{
									    $status = '<b>Close</b>';
									}

						?>
						<tr class="text-size-mini">
							<td><?= $no ?>.</td>
							<td>
								 <div class='row' style='height:5px'>
								 	<div class='col-md-4 text-right text-bold'>Scope ID :</div>
								 	<div class='col-md-8 text-semibold text-success'><?=$key->projectScopeID?></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Project Scope :</div>
									<div class='col-md-8'><?=$key->projectScope?></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Department :</div>
									<div class='col-md-8'><?=name_dept($key->deptID)?></div>
								 </div>
								 <br/>
								 <div class='row nomargin' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Category :</div>
									<div class='col-md-8'><?=name_category($key->categoryID)?></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Project Name :</div>
									<div class='col-md-8'><?=name_project($key->projectID)?></div>
								 </div>
							</td>
							<td>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Requiretment :</div>
									<div class='col-md-8'><b><?=$key->reqQuantity?> | <?=chk_totalApply($key->projectScopeID)?></b></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Status :</div>
									<div class='col-md-8'><?=$status?></div>
								 </div>
								 <br/>
								 <div class='row' style='height:5px'>
									<div class='col-md-4 text-right text-bold'>Approval :</div>
									<div class='col-md-8'><b><?=ucwords($approve)?></b></div>
								 </div>
							</td>
							<td class="text-center">
								<a data-placement="left" data-popup="tooltip" title="Setujui Project Scope" style="margin: 10px" onclick="confirms('Publish','Project Scope `<?= $key->projectScope ?>`?','<?= base_url('scope/do_approve') ?>','<?= $key->projectScopeID ?>')"><i class="icon-clipboard2"></i></a>
								<a data-placement="left" data-popup="tooltip" title="Tolak Project Scope" style="margin: 10px; color: red;" onclick="confirms('Deny','Deny This Project Scope `<?= $key->projectScope ?>`?','<?= base_url('scope/not_approve') ?>','<?= $key->projectScopeID ?>')"><i class="icon-blocked"></i></a>								
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
