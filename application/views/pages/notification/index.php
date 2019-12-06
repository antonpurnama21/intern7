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
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th>No</th>
				<th>Type</th>
				<th>Title</th>
				<th>Notification</th>
				<th>Time Log</th>
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
						<td><span class="badge badge-success"><?= $key->notifType ?></span></td>
						<td><?= $key->notifTitle ?></td>
						<td><a href="<?= base_url($key->notifUrl)?>"><?= $key->notification?></td>
						<td><?= timestep($key->create_at)?></td>

					</tr>
				<?php
						}
					}
				?>
		</tbody>
	</table>
</div>