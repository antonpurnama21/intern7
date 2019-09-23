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
		
		<form class="form-horizontal form-validate-jquery" action="<?= $actionForm ?>" method="POST" name="dokumen-form" id="dokumen-form">
			<button type="button" id="btn-tambah-form" class="btn btn-primary">Add Form</button>
            <button type="button" id="btn-reset-form" class="btn btn-danger">Reset All Form</button><br><br>
			<fieldset class="content-group">

				<legend class="text-semibold">
						<i class="icon-magazine position-left"></i>
						Add Task
						<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
							<i class="icon-circle-down2"></i>
						</a>
					</legend>

					<div class="collapse in" id="demo1">

						<input type="hidden" name="Wsid" value="<?=$workscopeID?>">
                        <div class="form-group row m-b-15">
                            <label class="col-form-label text-md-right col-md-3">Task Name</label>
                            <div class="col-md-9">
                            <input type="text" name="Taskname[]" placeholder="Task Name" required="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label text-md-right col-md-3">Description</label>
                            <div class="col-md-9">
                            <textarea name="Taskdesc[]" rows="5" placeholder="Task Description" required="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label text-md-right col-md-3">Start Date</label>
                            <div class="col-md-9">
                            <input type="date" name="Startdate[]" required="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-form-label text-md-right col-md-3">End Date</label>
                            <div class="col-md-9">
                            <input type="date" name="Enddate[]" required="" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="Workscopeid[]" value="<?=$workscopeID?>">
                        <br><br>
                        <div id="insert-form"></div>
					</div>

			</fieldset>

			<div class="text-right">
				<button type="button" onclick="location.href='<?=base_url('workscope/manageTask/'.$workscopeID)?>'" class="btn btn-default" id="reset">Cancel <i class="icon-reload-alt position-right"></i></button>
				<button type="submit" class="btn btn-primary" id="submit-dokumen" name="submit-dokumen">Save <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
		<input type="hidden" id="jumlah-form" value="1">
	</div>
</div>

<script>
    $(document).ready(function(){ // Ketika halaman sudah diload dan siap
        $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
            var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
            var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
            
            // Kita akan menambahkan form dengan menggunakan append
            // pada sebuah tag div yg kita beri id insert-form
            $("#insert-form").append("<b>Task " + nextform + " :</b><br/><br/>" +
                    "<div class='form-group row m-b-15'>"+
                        "<label class='col-form-label text-md-right col-md-3'>Task Name</label>"+
                        "<div class='col-md-9'>"+
                            "<input type='text' name='Taskname[]' class='form-control'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group row m-b-15'>"+
                        "<label class='col-form-label text-md-right col-md-3'>Description</label>"+
                        "<div class='col-md-9'>"+
                        "<textarea name='Taskdesc[]' rows='5' required class='form-control'></textarea>"+
                        "</div>"+
                    "</div>"+
                     "<div class='form-group row m-b-15'>"+
                         "<label class='col-form-label text-md-right col-md-3'>Start Date</label>"+
                         "<div class='col-md-9'>"+
                         "<input type='date' name='Startdate[]' required class='form-control'>"+
                         "</div>"+
                    "</div>"+
                    "<div class='form-group row m-b-15'>"+
                        "<label class='col-form-label text-md-right col-md-3'>End Date</label>"+
                        "<div class='col-md-9'>"+
                        "<input type='date' name='Enddate[]' required class='form-control'>"+
                        "</div>"+
                    "</div>"+
                    "<input type='hidden' name='Workscopeid[]'' value='<?=$workscopeID?>'>"+
                "<br><br>");
            
            $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
        });
        
        // Buat fungsi untuk mereset form ke semula
        $("#btn-reset-form").click(function(){
            $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
            $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
        });
    });
    </script>