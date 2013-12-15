<? $this->load->view('_template/header'); ?>

<div class="col-lg-12 landing">
	<h1>Final frontier for project management</h1>
	<?php if (isset($projects) && (count($projects) > 0)) : ?> 
		<?php foreach ($projects as $p) : ?>
			<div class="col-lg-12 well project-list-item" data-id="<?= $p->id ?>">
				<div class="col-lg-4"><a href="<?= BASE_URL ?>projects/view/<?= $p->id ?>" class="btn btn-primary btn-large"><?= $p->title ?></a></div>
				<div class="well col-lg-8"><?= $p->desc ?></div>
				<div class="progress col-lg-12">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $p->done ?>" aria-valuemin="0" aria-valuemax="<?= $p->total ?>" style="width: <?= $p->perc ?>%">
						<span class="sr-only"><?= $p->perc ?>% Complete</span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<span class="alert alert-warning">No projects</span><a href="<?= BASE_URL ?>projects/add" class="btn btn-primary">Add One</a>
	<?php endif; ?>
</div>

<? $this->load->view('_template/footer'); ?>
