<div class="row">
	<div class="col-md-6">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><i class="icon-law"></i> Category</h5>
				<div class="heading-elements">
					<ul class="icons-list">
		        		<li><a data-action="collapse"></a></li>
		        		<li><a data-action="reload"></a></li>
		        		<li><a data-action="close"></a></li>
		        	</ul>
		    	</div>
			</div>
			<div class="ml-20">
				<button type="button" class="btn btn-success" onclick="showModal('<?= base_url('scope/modalCategory') ?>', '', 'add');"><i class="icon-add position-left"></i> Add</button>
			</div>
			<table class="table datatable-responsive-row-control table-hover">
				<thead>
					<tr style="font-size:12px;text-align:center;">
						<th></th>
						<th width="10%">No</th>
						<th width="10%">Category ID</th>
						<th width="40%">Category</th>
						<th width="40%">Action</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if (!empty($dtcategory)) {
								$no = 0;
								foreach ($dtcategory as $cat) {
									$no++;
						?>
							<tr class="text-size-mini">
								<td></td>
								<td><?= $no ?>.</td>
								<td><?= $cat->categoryID ?></td>
								<td><?= $cat->categoryName ?></td>
								<td class="text-center">
									<a data-placement="left" data-popup="tooltip" title="Edit" style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal('<?= base_url('scope/modalEditCategory') ?>','<?= $cat->categoryID.'~'.$cat->categoryName ?>','editcategory')"><i class="icon-quill4"></i></a>
									<a data-placement="left" data-popup="tooltip" title="Delete" style="margin-bottom: 5px" class="btn btn-danger" onclick="confirms('Delete','Category `<?= $cat->categoryName ?>`?','<?= base_url('scope/deleteCategory') ?>','<?= $cat->categoryID ?>')"><i class="icon-trash"></i></a>
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
	<div class="col-md-6">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><i class="icon-law"></i> Project</h5>
				<div class="heading-elements">
					<ul class="icons-list">
		        		<li><a data-action="collapse"></a></li>
		        		<li><a data-action="reload"></a></li>
		        		<li><a data-action="close"></a></li>
		        	</ul>
		    	</div>
			</div>
			<div class="ml-20">
				<button type="button" class="btn btn-success" onclick="showModal('<?= base_url('scope/modalProject') ?>', '', 'add');"><i class="icon-add position-left"></i> Add</button>
			</div>
			<table class="table datatable-responsive-row-control table-hover">
				<thead>
					<tr style="font-size:12px;text-align:center;">
						<th></th>
						<th width="10%">No</th>
						<th width="15%">Project ID</th>
						<th width="40%">Project Name</th>
						<th width="35%">Action</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if (!empty($dtproject)) {
								$no = 0;
								foreach ($dtproject as $pro) {
									$no++;
						?>
							<tr class="text-size-mini">
								<td></td>
								<td><?= $no ?>.</td>
								<td><?= $pro->projectID ?></td>
								<td><?= $pro->projectName ?> ( <?= name_dept($pro->deptID) ?> }</td>
								<td class="text-center">
									<a data-placement="left" data-popup="tooltip" title="Edit" style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal('<?= base_url('scope/modalEditProject') ?>','<?= $pro->projectID.'~'.$pro->projectName ?>','editproject')"><i class="icon-quill4"></i></a>
									<a data-placement="left" data-popup="tooltip" title="Delete" style="margin-bottom: 5px" class="btn btn-danger" onclick="confirms('Delete','Project `<?= $pro->projectName ?>`?','<?= base_url('scope/deleteProject') ?>','<?= $pro->projectID ?>')"><i class="icon-trash"></i></a>
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
				<button type="button" class="btn btn-success" onclick="location.href='<?=base_url('scope/add')?>'"><i class="icon-add position-left"></i> Add</button>
			</div>
			<table class="table datatable-responsive-row-control table-hover">
				<thead>
					<tr style="font-size:12px;text-align:center;">
						<th></th>
						<th width="5%">No</th>
						<th width="45%">Information</th>
						<th width="35%">Requiretment</th>
						<th width="15%">Action</th>
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
								<button data-placement="left" data-popup="tooltip" title="Project Scope Detail" style="margin-bottom: 5px" type="button" class="btn btn-primary" onclick="location.href='<?=base_url('scope/detilScope/'.$key->projectScopeID) ?>'"><i class="icon-eye"></i></button>
								<button data-placement="left" data-popup="tooltip" title="Edit" style="margin-bottom: 5px" type="button" class="btn btn-primary" onclick="location.href='<?=base_url('scope/form/'.$key->projectScopeID) ?>'"><i class="icon-quill4"></i></button>
								<button data-placement="left" data-popup="tooltip" title="Delete" style="margin-bottom: 5px" class="btn btn-danger" onclick="confirms('Delete','Project Scope `<?=$key->projectScope?>` ?','<?=base_url('scope/delete')?>','<?=$key->projectScopeID?>')"><i class="icon-trash"></i></button>								
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
