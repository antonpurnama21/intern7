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
	<input type="hidden" name="alamatList" id="alamatList" value="<?= base_url('admin/getList') ?>">
	<div class="ml-20">
		<button type="button" class="btn btn-success" onclick="showModal('<?= base_url('admin/modalAdd') ?>', '', 'add');"><i class="icon-add position-left"></i> Add</button>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th></th>
				<th width="10%">No</th>
				<th width="60%">Information Admin Campus</th>
				<th width="30%">Action</th>
			</tr>
		</thead>
	</table>
</div>