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
	<h2>Your Progress Bar</h2>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-white border-top-success">
			<div class="panel-heading">
				<h6 class="panel-title">Progress Scope (%) :</h6>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse" data-popup="tooltip" title="Collapse"></a></li>
                		<li><a data-action="reload" data-popup="tooltip" title="Reload"></a></li>
                		<li><a data-action="close" data-popup="tooltip" title="Close"></a></li>
                	</ul>
            	</div>
			</div><br />
			<div class="panel-body">
				<?php 
				if (!empty($dtpersen->id)) {
					$persen = $dtpersen->value.'%';
					$scope = name_projectscope($dtpersen->id);
					if($dtpersen->value=='100'){
						$bg = 'bg-blue';
						$ac = '';
					}else{
						$bg = 'bg-green';
						$ac = 'active';
					}
				}else{
					$persen = '0%';
					$scope = '';
					$bg = '';
					$ac = '';				
				}?>
				<label><?= $scope ?> ( % )</label>
				<div class="progress mb-3" style="height: 3rem;">
					<div class="progress-bar progress-bar-striped progress-bar-animated <?=$bg?> <?=$ac?>" style="width: <?=$persen?>">
						<span style="margin-top: 5px;"><?=$persen?> Complete</span>
					</div>
				</div>	
			</div>
		</div>

	</div>
</div>
<div>
	<h2>Timeline Progress</h2>
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
