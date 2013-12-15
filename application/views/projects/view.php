<? $this->load->view('_template/header'); ?>

<div id="project-id" style="display:none;" data-id="<?= $project->id ?>"></div>
<div class="col-lg-12">
	<?php if (isset($project)) : ?>
		<h2><?= $project->title ?></h2>
		<div class="well col-lg-12"><?= $project->desc ?><a href="<?= BASE_URL ?>tasks/add/<?= $project->id ?>" class="btn btn-default pull-right">Add Tasks</a></div>
			<div class="progress col-lg-12 project-single">
				<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $project->done ?>" aria-valuemin="0" aria-valuemax="<?= $project->total ?>" style="width: <?= $project->perc ?>%">
					<span class="sr-only"><?= $project->perc ?>% Complete</span>
				</div>
			</div>
		<?php if (isset($tasks) && (count($tasks) > 0)) : ?>
			<?php foreach ($tasks as $t) : ?>
				<div class="task col-lg-12" data-done="<?= $t->status ?>"><?= $t->desc ?>
					<button class="btn mark-done pull-right" data-id="<?= $t->id ?>"><span class="glyphicon glyphicon-ok"></span></button>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<span class="alert alert-warning">Currently no tasks</span> <a href="<?= BASE_URL ?>tasks/add/<?= $project->id ?>" class="btn btn-default">add one</a>
		<?php endif; ?>
	<?php else : ?>
		<span class="alert alert-warning">No project</span>
	<?php endif; ?>
</div>

<? $this->load->view('_template/footer'); ?>
