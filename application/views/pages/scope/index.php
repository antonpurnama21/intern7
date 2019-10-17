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
				<th width="5">No</th>
				<th width="45">Information</th>
				<th width="35">Requiretment</th>
				<th width="15">Action</th>
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
				                        $badge = '<span class="badge badge-warning"><i class="icon-info3"></i> Please Complete Your Profile</span>';
				                    }else{
				                    	$button ='';
				                    	$badge  ='';

				                    	$check3 = chk_typeTemp($key->projectScopeID);
					                    if ($check3 == 'canceled') {
					                      	$button = 'disabled';
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
							<td></td>
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
									<div class='col-md-8'><?=name_dept($key->deptID)?> <?=chk_typeTemp($key->projectScopeID);?></div>
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
							</td>
							<td class="text-center">
								<a data-placement="left" data-popup="tooltip" title="Print Project Scope" style="margin: 10px;" href="<?=base_url()?>report/printScope/<?=$key->projectScopeID?>"><i class="icon-printer"></i></a>
	                            <a data-placement="left" data-popup="tooltip" title="View project Scope" style="margin: 10px" onclick="showModal('<?=base_url('scope/modalScope') ?>', '<?=$key->projectScopeID.'~'.$key->projectScope?>', 'review');"><i class="icon-eye"></i></a>
	                            <?php if($this->session->userdata('userlog')['sess_role']==55){ 
	                            $check2 = chk_applyMhs($key->projectScopeID);
	                            $stats = chk_statsTemp($key->projectScopeID); 
	                            if ($stats == 'accepted') {?>
	                            	<a data-placement="left" data-popup="tooltip" title="You Was Accepted" style="'<?=showLevel(array(55))?> margin: 10px;">Accepted</a>
	                            <?php }elseif ($stats == 'rejected'){?>
	                            	<a data-placement="left" data-popup="tooltip" title="You Was Rejected" style="<?=showLevel(array(55))?> margin: 10px">Rejected</a>
	                            <?php }else{
	                            if ($check2 == false) {?>
	                            <a data-placement="left" data-popup="tooltip" title="Apply This Project Scope" onclick="confirms('Apply','Apply Project Scope `<?=$key->projectScope?>` ?','<?=base_url('scope/applyScope')?>','<?=$key->projectScopeID?>')" style="<?=showLevel(array(55))?> margin: 10px;" class="<?=$button?>"><i class="icon-checkmark"></i> Apply</a><br/><?=$badge?>
	                        	<?php }else{?>
	                            '<a data-placement="left" data-popup="tooltip" title="Cancel This Project Scope" onclick="confirms('Cancel','Cancel Project Scope `<?=$key->projectScope?>` ?','<?=base_url('scope/cancelScope')?>','<?=$key->projectScopeID?>')" style="<?=showLevel(array(55))?> margin: 10px; color: red;"><i class="icon-cross2"></i> Cancel</a>,
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