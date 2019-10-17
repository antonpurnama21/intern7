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
		<button type="button" class="btn btn-success" onclick="location.href='<?=base_url('mahasiswa/add')?>'"><i class="icon-add position-left"></i> Add</button>
		<button type="button" style="margin-right: 10px" class="btn btn-success pull-right" onclick="location.href='<?=base_url('report/reportMahasiswa')?>'"><i class="icon-printer position-left"></i> Print to PDF</button>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th width="5">No</th>
				<th>Pic</th>
				<th>Information</th>
				<th>Addresses</th>
				<th width="10">Action</th>
			</tr>
		</thead>
		<tbody>
				<?php
					if (!empty($dtmahasiswa)) {
					$no = 0;
					foreach ($dtmahasiswa as $key) {

					$no++;
					if ($key->photo != '') {
						$lokasi = base_url().$key->photo;
					}else{
						$lokasi = base_url()."/fileupload/pic_mahasiswa/default.png";
					}
				?>
				<tr>
					<td><?= $no ?>.</td>
					<td><img src="<?=$lokasi?>" alt="" class="img-responsive" style="width:70%;height:auto;"></td>
					<td>
						"<div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">NIM :</div>
							<div class="col-md-8 text-semibold text-success"><?=$key->mahasiswaNumber?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">mahasiswa Name :</div>
							<div class="col-md-8"><?=$key->fullName?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">Email :</div>
							<div class="col-md-8"><?=$key->emaiL?></div>
						 </div>
						 <br/>
						 <div class="row nomargin" style="height:5px">
							<div class="col-md-4 text-right text-bold">University :</div>
							<div class="col-md-8"><?=name_university($key->universityID)?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">Faculty :</div>
							<div class="col-md-8"><?=name_faculty($key->facultyID)?></div>
						 </div>
					</td>
					<td>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">NO Telepon :</div>
							<div class="col-md-8"><?=$key->fixedPhone?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">Mobile Phone :</div>
							<div class="col-md-8"><?=$key->mobilePhone?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">City :</div>
							<div class="col-md-8"><?=$key->city?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">Zip Postal :</div>
							<div class="col-md-8"><?=$key->zip?></div>
						 </div>
						 <br/>
						 <div class="row" style="height:5px">
							<div class="col-md-4 text-right text-bold">Address :</div>
							<div class="col-md-8"><?=$key->address?></div>
						 </div>
					</td>
					<td class="text-center">
						<a data-placement="left" data-popup="tooltip" title="Reset Password" style="margin: 10px" onclick="showModal('<?=base_url("mahasiswa/modalReset")?>', '<?=$key->mahasiswaID.'~'.$key->fullName?>', `resetpass`);"><i class="icon-lock"></i></a>
						<a data-placement="left" data-popup="tooltip" title="Edit Mahasiswa" style="margin: 10px" href="<?=base_url('mahasiswa/form/'.$key->mahasiswaID)?>"><i class="icon-quill4"></i></a>
						<a data-placement="left" data-popup="tooltip" title="View Mahasiswa" style="margin: 10px" onclick="showModal('<?=base_url("mahasiswa/modalMahasiswa")?>', '<?=$key->mahasiswaID.'~'.$key->fullName?>', `view`);"><i class="icon-eye"></i></a>
						<a data-placement="left" data-popup="tooltip" title="Delete" style="margin: 10px; color: red;" onclick="confirms('Delete','Mahasiswa `<?=$key->fullName ?>`?','<?=base_url('mahasiswa/delete') ?>','<?=$key->mahasiswaID?>')"><i class="icon-trash"></i></a>
					</td>
				</tr>
				<?php
						}
					}
				?>
		</tbody>
	</table>
</div>