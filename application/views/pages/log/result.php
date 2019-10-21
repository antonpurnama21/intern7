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
	<input type="hidden" name="getAdmin" id="getAdmin" value="<?= base_url('log/getAdmin') ?>">
	<input type="hidden" name="getAdminCampus" id="getAdminCampus" value="<?= base_url('log/getAdminCampus') ?>">
	<input type="hidden" name="getDosen" id="getDosen" value="<?= base_url('log/getDosen') ?>">
	<input type="hidden" name="getMahasiswa" id="getMahasiswa" value="<?= base_url('log/getMahasiswa') ?>">
	<div class="col-lg-3">
		<form action="<?= base_url('log/result/adm') ?>" method="POST" name="form1" id="form1">
			<label>Search For Admin Department</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="icon-direction"></i></div>
				<select name="Admin" id="Admin" class="select2" required="required">
					<option value=""></option>
				</select>
			</div>
			<div class="pull-right">
				<button type="submit" style="margin-top: 10px;" class="btn btn-primary" id="submit-form" name="submit-form">Search <i class="icon-search4 position-right"></i></button>
			</div>
		</form>
	</div>
	<div class="col-lg-3">
		<form action="<?= base_url('log/result/admcampus') ?>" method="POST" name="form2" id="form2">
			<label>Search For Admin Campus</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="icon-direction"></i></div>
				<select name="Admincampus" id="Admincampus" class="select2" required="required">
					<option value=""></option>
				</select>
			</div>
			<div class="pull-right">
				<button type="submit" style="margin-top: 10px;" class="btn btn-primary" id="submit-form" name="submit-form">Search <i class="icon-search4 position-right"></i></button>
			</div>
		</form>
	</div>
	<div class="col-lg-3">
		<form action="<?= base_url('log/result/dsn') ?>" method="POST" name="form3" id="form3">
			<label>Search For Dosen</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="icon-direction"></i></div>
				<select name="Dosen" id="Dosen" class="select2" required="required">
					<option value=""></option>
				</select>
			</div>
			<div class="pull-right">
				<button type="submit" style="margin-top: 10px;" class="btn btn-primary" id="submit-form" name="submit-form">Search <i class="icon-search4 position-right"></i></button>
			</div>
		</form>
	</div>
	<div class="col-lg-3">
		<form action="<?= base_url('log/result/mhs') ?>" method="POST" name="form4" id="form4">
			<label>Search For Mahasiswa</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="icon-direction"></i></div>
				<select name="Mahasiswa" id="Mahasiswa" class="select2" required="required">
					<option value=""></option>
				</select>
			</div>
			<div class="pull-right">
				<button type="submit" style="margin-top: 10px;" class="btn btn-primary" id="submit-form" name="submit-form">Search <i class="icon-search4 position-right"></i></button>
			</div>
		</form>
	</div>

	<div class="row">
			<form action="<?= base_url('report/printLogbyID') ?>" target="_blank" method="POST">
				<input type="hidden" name="iduser" id="iduser" value="<?= $id?>">
				<div>
					<a style="margin-top: 20px; margin-left: 20px;" onclick="location.href='<?=base_url('log')?>'" class="btn btn-default" id="submit-form" name="submit-form">Reset <i class="icon-reload-alt position-right"></i></a>
					<?php if (!empty($dMaster)): ?>
					<button type="submit" style="margin-top: 20px; margin-left: 20px;" class="btn btn-success" id="submit-form" name="submit-form">Print <i class="icon-printer position-right"></i></button>
					<?php endif ?>
				</div>
			</form>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th>.</th>
				<th>No</th>
				<th>Email User</th>
				<th>Log Time</th>
				<th>Browser Access</th>
				<th>IP Address</th>
				<th>Platform</th>
				<th>Type Log</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if (!empty($dMaster)) {
				$i = 0;
				foreach ($dMaster as $key) {
				 $i++;
			 ?>
			<tr>
				<td></td>
				<td><?= $i ?></td>
				<td><?= email($key->logUsrID) ?></td>
				<td><?= timestep($key->logTime) ?></td>
				<td><?= $key->logBrowser ?></td>
				<td><?= $key->logIP ?></td>
				<td><?= $key->logPlatform  ?></td>
				<td><?= logtype($key->logTypeID) ?></td>
				<td><?= $key->logDesc ?></td>
			</tr>
		<?php }
	} ?>
		</tbody>
	</table>
</div>