<? $this->load->view('_template/header'); ?>

<div class="row">
	<form role="form" action="<?= BASE_URL ?>/projects/add_post" method="post">
		<div class="form-group">
			<label for="project-title">Project title</label>
			<input type="text" class="form-control" name="project-title" placeholder="Enter Project title">
		</div>
		<div class="form-group">
			<label for="project-desc">Description</label>
			<input type="text" class="form-control" name="project-desc" placeholder="Description">
		</div>
		<button type="submit" class="btn btn-default">Add Project</button>
	</form>

</div>

<? $this->load->view('_template/footer'); ?>
