<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<a class="navbar-brand" href="<?= BASE_URL ?>">SPACE</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<li><a href="<?= BASE_URL ?>projects">List Projects</a></li>
				<li><a href="<?= BASE_URL ?>projects/add/">Add A Project</a></li>
			</li>
		</ul>
</nav>

<?php $success = $this->session->flashdata('success'); $error  =$this->session->flashdata('error'); ?>
<?php if($success) : ?>
	<div class="alert alert-success"><?= $success; ?></div>
<?php endif; ?>
<?php if($error) : ?>
	<div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>
