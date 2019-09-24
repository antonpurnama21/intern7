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
		<?php 
		if (!empty($dtpersen->value)) {
			$persen = $dtpersen->value.'%';
			$scope = name_projectscope($dtpersen->id);
		}else{
			$persen = '0%';
			$scope = '';
		}?>
		<label><?= $scope ?> ( % )</label>
		<div class="progress mb-3" style="height: 1.375rem;">
			<div class="progress-bar progress-bar-striped progress-bar-animated bg-green active" style="width: <?=$persen?>">
				<span><?=$persen?> Complete</span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title">Progress Timeline :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div><br />
			<div class="panel-body">
				<input type="hidden" name="getTimeline" id="getTimeline" value="<?= base_url('workscope/getTimeline') ?>">
				<div id='calendar'></div><br />	
			</div>
		</div>

	</div>
</div>
