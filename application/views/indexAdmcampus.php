<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><i class="icon-law"></i> <?= $breadcrumb[1] ?></h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="panel-body">
		<h5>Welcome, <strong><?= $sesi['sess_name']?> !</strong></h5>
	</div>
</div>
<div>
	<h2>Statistic Data</h2>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> User Total</h6>
			</div>
			
			<div class="panel-body">
				
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold ">Total Mahasiswa </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-users2"></i></div>
								<label class="control-label"><?=$dtjml?></label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold ">Total Dosen </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-user"></i></div>
								<label class="control-label"><?=$dsjml?></label>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Detail Mahasiswa</h6>
			</div>
			
			<div class="panel-body">
				<?php
				if (!empty($mhsFac)) {//mahasiswa per fakultas
				foreach ($mhsFac as $mhs) {?>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold ">Jurusan <?=$mhs->label?> </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-users2"></i></div>
								<label class="control-label"><?=$mhs->value?></label>
							</div>
						</div>
					</div>
				</div>
			<?php }} ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title text-bold"><i class="icon-puzzle3"></i> Detail Dosen</h6>
			</div>
			
			<div class="panel-body">
				<?php
				if (!empty($dsnFac)) {//dosen per fakultas
				foreach ($dsnFac as $mhs) {?>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-lg-8 text-bold ">Jurusan <?=$mhs->label?> </label>
						<div class="col-lg-4">
							<div class="input-group">
								<div class="input-group-addon" style="padding-top:0px;"><i class="icon-user"></i></div>
								<label class="control-label"><?=$mhs->value?></label>
							</div>
						</div>
					</div>
				</div>
			<?php }} ?>
			</div>
		</div>
	</div>
</div>