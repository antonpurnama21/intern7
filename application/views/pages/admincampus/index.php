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
		<button type="button" class="btn btn-success" onclick="showModal('<?= base_url('admincampuscampus/modalAdd') ?>', '', 'add');"><i class="icon-add position-left"></i> Add</button>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th>No</th>
				<th>ID User</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>University</th>
				<th>Role</th>
				<th>Action</th>
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
				<td><?= $no ?></td>
				<td><div class="col-md-8 text-semibold text-success"><?= $key->loginID?></div></td>
				<td><?= $key->fullName?></td>
				<td><?= $key->emaiL?></td>
				<td><?= $key->telePhone?></td>
				<td><?= name_university($key->universityID)?></td>
				<td><?= what_role($key->roleID)?></td>
				<td>
					<a data-placement="left" data-popup="tooltip" title="Reset Password" style="margin: 10px" onclick="showModal('<?= base_url("admincampus/modalReset")?>', '<?= $key->adminCampusID.'~'.$key->fullName?>', 'resetpass')"><i class="icon-lock"></i></a>
					<a data-placement="left" data-popup="tooltip" title="Edit Data" style="margin: 10px" onclick="showModal('<?=base_url("admincampus/modalEdit")?>', '<?=$key->adminCampusID.'~'.$key->fullName?>', 'editadmincampus')"><i class="icon-quill4"></i></a>
					<a data-placement="left" data-popup="tooltip" title="Delete Data" style="margin: 10px; color: red;" onclick="confirms('Delete','admincampus `<?= $key->fullName?>`?','<?= base_url("admincampus/delete")?>','<?= $key->adminCampusID?>')"><i class="icon-trash"></i></a>
				</td>
			</tr>
			<?php
					}
				}
			?>
		</tbody>
	</table>
</div>