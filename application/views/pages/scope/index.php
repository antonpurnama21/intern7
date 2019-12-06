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
	<table class="table datatable-responsive-row-control table-striped table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th>No</th>
				<th>Project Scope</th>
				<th>Project Name</th>
				<th>From Department</th>
				<th>Requiretment</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
						<?php
							if (!empty($dtscope)) {
							$no = 0;
							foreach ($dtscope as $key) {
								$no++;

								if($key->isTaken == 1){ 
				                    $status = '<span class="badge badge-success">OPEN</span>';
				                    $button = '';
				                    $check = chk_statsMhs($this->session->userdata('userlog')['sess_usrID']);
				                    if ($check == false) {
				                        $button='disabled';
				                        $badge = '<span style="margin-top: 5px" class="badge badge-warning"><i class="icon-info3"></i> Please Complete Your Profile</span>';
				                    }else{
				                    	$button ='';
				                    	$badge  ='';

				                    	$check3 = chk_typeTemp($key->projectScopeID);
					                    if ($check3 == 'canceled') {
					                      	$button = 'disabled"';
					                    }else{
					                    	$button = '';
					                    	$check4 = chk_workMhs($this->session->userdata('userlog')['sess_usrID']);
							                if ($check4 == true) {
							                    $button = 'disabled';
							                }else{
							                    $button = '';
							                }
				                    	}
				                    }

				                    

				                }else{
				                    $status = '<span class="badge badge-danger">CLOSE</span>';
				                    $button = 'disabled';
				                    $badge  = '';
				                }
				                $approve = $key->isApproved;
						?>
						<tr>
							<td><?= $no ?>.</td>
							<td><?=$key->projectScope?></td>
							<td><?=name_project($key->projectID)?></td>
							<td><?=name_dept($key->deptID)?></td>
							<td><span class="badge badge-primary"><?=$key->reqQuantity?></span>&emsp;|&emsp;<span class="badge badge-success"><?=chk_totalApply($key->projectScopeID)?></span></td>
							<td><?=$status?></td>
							<td class="text-center">
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Print Project Scope" style="margin: 5px" target="_blank" href="<?=base_url()?>report/printScope/<?=$key->projectScopeID?>"><i class="icon-printer"></i></a>
	                            <a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="View project Scope" style="margin: 5px" onclick="showModal('<?=base_url('scope/modalScope') ?>', '<?=$key->projectScopeID.'~'.$key->projectScope?>', 'review');"><i class="icon-eye"></i></a>
	                            <?php if($this->session->userdata('userlog')['sess_role']==55){ 
	                            $check2 = chk_applyMhs($key->projectScopeID);
	                            $stats = chk_statsTemp($key->projectScopeID); 
	                            if ($stats == 'accepted') {?>
	                            	<span class="badge badge-success" style="margin: 5px">ACCEPTED</span>
	                            <?php }elseif ($stats == 'rejected'){?>
	                            	<span class="badge badge-danger" style="margin: 5px">REJECTED</span>
	                            <?php }else{
	                            if ($check2 == false) {?>
	                            <a class="btn btn-success" data-placement="left" data-popup="tooltip" title="Apply This Project Scope" onclick="confirms('Apply','Apply Project Scope `<?=$key->projectScope?>` ?','<?=base_url('scope/applyScope')?>','<?=$key->projectScopeID?>')" style="<?=showLevel(array(55))?> margin: 5px;" <?=$button?> ><i class="icon-checkmark"></i> APPLY</a><br/><?=$badge?>
	                        	<?php }else{?>
	                            '<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Cancel This Project Scope" onclick="confirms('Cancel','Cancel Project Scope `<?=$key->projectScope?>` ?','<?=base_url('scope/cancelScope')?>','<?=$key->projectScopeID?>')" style="<?=showLevel(array(55))?> margin: 5px;"><i class="icon-cross2"></i> CANCEL ?</a>,
	                            <?php } } }?>							
							</td>
						</tr>
						<?php
								}
							}
						?>
				</tbody>
	</table>
</div>