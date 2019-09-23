<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"><i class="icon-law"></i> <?= $breadcrumb[1];?> <?=name_task($taskID)?></h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="panel-body">
		<div style="overflow: scroll; height: 480px;">
			<?php
				if (!empty($dtprogress)) {
				$no = 0;
				foreach ($dtprogress as $key) {
			?>
			<strong><?= date_format(date_create($key->date), 'd F Y') ?></strong> <br />
			<div class="row" style="border-top: 2px solid lightgreen; padding: 5px; margin-bottom: 20px;">
				<div class="col-md-6">
					<strong>Progress</strong> <i class="icon-book"></i> <br />
					<?= nl2br($key->progress)?>
				</div>
				<div class="col-md-6">
					<strong>Finding</strong> <i class="icon-book"></i> <br />
					<?= nl2br($key->finding)?>
				</div>
			</div>
			<?php }}else{ ?>
				<p>Progress not Found</p>
			<?php } ?>
		</div>
	</div>
</div>