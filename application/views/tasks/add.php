<? $this->load->view('_template/header'); ?>

<div class="row">
	<form role="form" action="<?= BASE_URL ?>/tasks/add_post" method="post" id="add-task-form">
		<button class="btn btn-default add-task">Add another task</button>
		<div class="form-group">
			<label for="project-title">Task description</label>
			<input type="text" class="form-control" name="task[]" placeholder="Enter Task desc">
		</div>
		<input type="hidden" value="<?= $project->id ?>" name="project-id" />
		<button type="submit" class="btn btn-default">Submit Tasks</button>
	</form>

</div>

<? $this->load->view('_template/footer'); ?>
