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
		<button type="button" class="btn btn-success" onclick="showModal('<?= base_url('admin/modalAdd') ?>', '', 'add');"><i class="icon-add position-left"></i> Add</button>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th></th>
				<th width="10%">No</th>
				<th width="70%">Information Admin Campus</th>
				<th width="20%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if (!empty($dMaster)) {
					$no = 0;
					foreach ($dMaster as $key) {
						$no++;
			?>
			<tr class="text-size-mini">
				<td></td>
				<td><?= $no ?></td>
				<td>
					<div class="row" style="height:5px">
						<div class="col-md-4 text-right text-bold">ID User :</div>
						<div class="col-md-8 text-semibold text-success"><?= $key->loginID?></div>
					 </div>
					 <br/>
					 <div class="row" style="height:5px">
						<div class="col-md-4 text-right text-bold">Admin Name :</div>
						<div class="col-md-8"><?= $key->fullName?></div>
					 </div>
					 <br/>
					 <div class="row" style="height:5px">
						<div class="col-md-4 text-right text-bold">Email :</div>
						<div class="col-md-8"><?= $key->emaiL?>"</div>
					 </div>
					 <br/>
					 <div class="row" style="height:5px">
						<div class="col-md-4 text-right text-bold">Phone Number :</div>
						<div class="col-md-8"><?= $key->telePhone?></div>
					 </div>
					 <br/>
					 <div class="row nomargin" style="height:5px">
						<div class="col-md-4 text-right text-bold">Department :</div>
						<div class="col-md-8"><?= name_dept($key->deptID)?></div>
					 </div>
					 <br/>
					 <div class="row" style="height:5px">
						<div class="col-md-4 text-right text-bold">Role User :</div>
						<div class="col-md-8"><?= what_role($key->roleID)?></div>
					 </div>
				</td>
				<td>
					<a data-placement="left" data-popup="tooltip" title="Reset Password" style="margin-bottom: 5px" onclick="showModal('<?= base_url("admin/modalReset")?>', '<?= $key->adminID.'~'.$key->fullName?>', 'resetpass')"><i class="icon-lock"></i></a>
					<a data-placement="left" data-popup="tooltip" title="Edit Data" style="margin-bottom: 5px" onclick="showModal('<?=base_url("admin/modalEdit")?>', '<?=$key->adminID.'~'.$key->fullName?>', 'editadmin')"><i class="icon-quill4"></i></a>
					<a data-placement="left" data-popup="tooltip" title="Delete Data" style="margin-bottom: 5px; color: red;" onclick="confirms('Delete','Admin `<?= $key->fullName?>`?','<?= base_url("admin/delete")?>','<?= $key->adminID?>')"><i class="icon-trash"></i></a>
				</td>
			</tr>
			<?php
					}
				}
			?>
		</tbody>
	</table>
</div>