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
	<input type="hidden" name="alamatList" id="alamatList" value="<?= base_url('log/getList') ?>">

	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th></th>
				<th>No</th>
				<th>Email User</th>
				<th>Log Time</th>
				<th>Browser Access</th>
				<th>IP Address</th>
				<th>Pletform</th>
				<th>Type Log</th>
				<th>Description</th>
			</tr>
		</thead>
	</table>
</div>