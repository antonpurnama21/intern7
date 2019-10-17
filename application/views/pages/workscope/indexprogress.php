<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><i class="icon-law"></i><?= $breadcrumb[1] ?> <?=name_task($taskID)?></h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>
	<?php 
	    $stats = chk_statsTask($taskID);
	    if ($stats=='done') {
	        $status = 'Done';
	        $btn = 'btn-primary';
	    }elseif($stats=='done-delay') {
	        $status = 'Done Delay';
	        $btn = 'btn-warning';
	    }elseif($stats=='on-progress') {
	        $status = 'On Progress';
	        $btn = 'btn-success';
	    }elseif($stats=='delay') {
	        $status = 'Delay';
	        $btn = 'btn-danger';
	    }else{
	        $status = 'Pending';
	        $btn = 'btn-secondary';
	    }
	 ?>
	<div class="ml-20" style="margin-right: 10px"><button class="btn <?=$btn?> pull-right"><?=$status?></button></div>
	<input type="hidden" name="alamatList" id="alamatList" value="<?= base_url('workscope/getListProgress/'.$taskID) ?>">

	<div class="ml-20">
	<?php
    $dateNow = date('Y-m-d');
    if(empty($getClose->closeDate)){ ?>
        <button type="button" style="<?= showLevel(array(55)) ?>" class="btn btn-success" onclick="showModal('<?= base_url('workscope/modalAddProgress/'.$taskID) ?>', '', 'add');"><i class="icon-add position-left"></i> Add Progress</button>
        
    <?php if($dateNow >= $getClose->endDate){ ?>
        <button type="button" style="<?= showLevel(array(55)); ?>" class="btn btn-success" onclick="location.href='<?=base_url('workscope/progressDone/'.$taskID)?>'"><i class="icon-add position-left"></i> Progress Done</button>
    <?php }
    } ?>
	</div>
	<table class="table datatable-responsive-row-control table-hover">
		<thead>
			<tr style="font-size:12px;text-align:center;">
				<th>.</th>
				<th>No</th>
				<th>Progress</th>
				<th>Finding</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>