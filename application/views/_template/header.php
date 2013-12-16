<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?= BASE_URL ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/space.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>
    <div class="container">
    <header class="col-lg-12">
        <?php $this->load->view("_template/nav"); ?>
    </header>
    <hr />
    <div class="col-lg-12">
