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
						<th>.</th>
						<th>No</th>
						<th>Category ID</th>
						<th>Category</th>
						<th>Action</th>
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
									<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Edit" style="margin: 5px" onclick="showModal('<?= base_url('scope/modalEditCategory') ?>','<?= $cat->categoryID.'~'.$cat->categoryName ?>','editcategory')"><i class="icon-quill4"></i></a>
									<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Delete" style="margin: 5px;" onclick="confirms('Delete','Category `<?= $cat->categoryName ?>`?','<?= base_url('scope/deleteCategory') ?>','<?= $cat->categoryID ?>')"><i class="icon-trash"></i></a>
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
						<th>.</th>
						<th>No</th>
						<th>Project ID</th>
						<th>Project Name</th>
						<th>Action</th>
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
									<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Edit" style="margin: 5px" onclick="showModal('<?= base_url('scope/modalEditProject') ?>','<?= $pro->projectID.'~'.$pro->projectName ?>','editproject')"><i class="icon-quill4"></i></a>
									<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Delete" style="margin: 5px;" onclick="confirms('Delete','Project `<?= $pro->projectName ?>`?','<?= base_url('scope/deleteProject') ?>','<?= $pro->projectID ?>')"><i class="icon-trash"></i></a>
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
						<th>.</th>
						<th>No</th>
						<th>ID</th>
						<th>Project Scope</th>
						<th>Project Name</th>
						<th>Department</th>
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
						<tr>
							<td></td>
							<td><?= $no ?>.</td>
							<td><div class='col-md-8 text-semibold text-success'><?=$key->projectScopeID?></div></td>
							<td><?=$key->projectScope?></td>
							<td><?=name_project($key->projectID)?></td>
							<td><?=name_dept($key->deptID)?></td>
							<td><span class="badge badge-primary"><?=$key->reqQuantity?></span>&emsp;|&emsp;<span class="badge badge-success"><?=chk_totalApply($key->projectScopeID)?></span></td>
							<td><?=$status?></td>
							<td><?=$approve?></td>
							<td class="text-center">
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Project Scope Detail" style="margin: 5px" onclick="location.href='<?=base_url('scope/detilScope/'.$key->projectScopeID) ?>'"><i class="icon-eye"></i></a>
								<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Edit" style="margin: 5px" onclick="location.href='<?=base_url('scope/form/'.$key->projectScopeID) ?>'"><i class="icon-quill4"></i></a>
								<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Delete" style="margin: 5px;" onclick="confirms('Delete','Project Scope `<?=$key->projectScope?>` ?','<?=base_url('scope/delete')?>','<?=$key->projectScopeID?>')"><i class="icon-trash"></i></a>								
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
