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
		<button type="button" class="btn btn-success" onclick="showModal('<?= base_url('university/modalAdd') ?>', '', 'add');"><i class="icon-add position-left"></i> Add</button>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th>No</th>
				<th>University ID</th>
				<th>University</th>
				<th>Mou</th>
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
						<td><?= $no ?>.</td>
						<td><?= $key->universityID ?></td>
						<td><?= $key->universityName ?></td>
						<td><span class="badge badge-success"><?= $key->mou?></span></td>
						<td class="text-center">
							<a class="btn btn-primary" data-placement="left" data-popup="tooltip" title="Edit" style="margin: 5px" onclick="showModal('<?= base_url('university/modalEdit') ?>','<?= $key->universityID.'~'.$key->universityName ?>','edituniversity')"><i class="icon-quill4"></i></a>
							<a class="btn btn-danger" data-placement="left" data-popup="tooltip" title="Delete" style="margin: 5px;" onclick="confirms('Delete','University `<?= $key->universityName ?>`?','<?= base_url('university/delete') ?>','<?= $key->universityID ?>')"><i class="icon-trash"></i></a>
						</td>
					</tr>
				<?php
						}
					}
				?>
		</tbody>
	</table>
</div>