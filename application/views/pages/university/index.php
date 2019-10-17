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
				<th>.</th>
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
						<td></td>
						<td><?= $no ?>.</td>
						<td><?= $key->universityID ?></td>
						<td><?= $key->universityName ?></td>
						<td><?= $key->mou?></td>
						<td class="text-center">
							<a data-placement="left" data-popup="tooltip" title="Edit" style="margin: 10px" onclick="showModal('<?= base_url('university/modalEdit') ?>','<?= $key->universityID.'~'.$key->universityName ?>','edituniversity')"><i class="icon-quill4"></i></a>
							<a data-placement="left" data-popup="tooltip" title="Delete" style="margin: 10px; color: red;" onclick="confirms('Delete','University `<?= $key->universityName ?>`?','<?= base_url('university/delete') ?>','<?= $key->universityID ?>')"><i class="icon-trash"></i></a>
						</td>
					</tr>
				<?php
						}
					}
				?>
		</tbody>
	</table>
</div>