<div class="sidebar-category sidebar-category-visible">
	<div class="category-content no-padding">
		<ul class="navigation navigation-main navigation-accordion">

			<!-- Main -->
			<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
			<li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : ''?>><a href="<?=base_url()?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
			<li style="<?= showLevel(array(11)); ?>">
				<a href="#"><i class="icon-magazine"></i> <span>Account</span></a>
				<ul>
					<li <?= getActiveFunc('admin/index') ?>><a href="<?= base_url('admin') ?>">Dept. Admin</a></li>
					<li <?= getActiveFunc('admincampus/index') ?>><a href="<?= base_url('admincampus') ?>">Campus Admin</a></li>
				</ul>
			</li>
			<li style="<?= showLevel(array(11)); ?>">
				<a href="#"><i class="icon-books"></i> <span>Data</span></a>
				<ul>
					<li <?= getActiveFunc('department/index') ?>><a href="<?= base_url('department') ?>">Department</a></li>
					<li <?= getActiveFunc('university/index') ?>><a href="<?= base_url('university') ?>">University</a></li>
					<li <?= getActiveFunc('faculty/index') ?>><a href="<?= base_url('faculty') ?>">Faculty</a></li>
				</ul>
			</li>
			<li style="<?= showLevel(array(11,33,44)); ?>" <?= getActiveFunc('mahasiswa/index') ?> ><a href="<?= base_url('mahasiswa') ?>"><i class="icon-users"></i> <span>Mahasiswa</span></a></li>
			<li style="<?= showLevel(array(11,33)); ?>" <?= getActiveFunc('dosen/index') ?> ><a href="<?= base_url('dosen') ?>"><i class="icon-user"></i> <span>Dosen</span></a></li>
			<li>
				<a href="#"><i class="icon-bookmark"></i> <span>Project Scope</span></a>
				<ul>
					<li <?= getActiveFunc('scope/index') ?>><a href="<?= base_url('scope') ?>">Project Scope List</a></li>
					<li style="<?= showLevel(array(11,22)); ?>" <?= getActiveFunc('scope/manage') ?>><a href="<?= base_url('scope/manage') ?>">Manage Project Scope</a></li>
				</ul>
			</li>
			<li <?= getActiveFunc('workscope/index') ?> style="<?= showLevel(array(11,22,33,44)); ?>" ><a href="<?= base_url('workscope') ?>"><i class="icon-calendar"></i> <span>Workscope</span></a></li>
			<li <?= getActiveFunc('workscope/myworkscope') ?> style="<?= showLevel(array(55)); ?>"><a href="<?= base_url('workscope/myworkscope') ?>"><i class="icon-calendar"></i> <span>My Workscope</span></a></li>
			<li <?= getActiveFunc('log/index') ?> style="<?= showLevel(array(11)); ?>"><a href="<?= base_url('log') ?>"><i class="icon-price-tag3"></i> <span>Log Activity</span></a></li>
						
		</ul>
	</div>
</div>