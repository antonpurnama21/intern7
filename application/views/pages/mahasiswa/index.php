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
				<th>.</th>
				<th>No</th>
				<th>PIC</th>
				<th>Nim</th>
				<th>Mahasiswa Name</th>
				<th>Email</th>
				<th>University</th>
				<th>Faculty</th>
				<th>Action</th>
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
					<td></td>
					<td><?= $no ?>.</td>
					<td><img src="<?=$lokasi?>" alt="" class="img-responsive" style="width:70%;height:auto;"></td>
					<td><div class="col-md-8 text-semibold text-success"><?=$key->mahasiswaNumber?></div></td>
					<td><?=$key->fullName?></td>
					<td><?=$key->emaiL?></td>
					<td><?=name_university($key->universityID)?></td>
					<td><?=name_faculty($key->facultyID)?></td>
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