<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('form');
//https://getbootstrap.com/docs/3.3/components/#navbar navbar template
?>
<head>
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

	<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

</head>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar">Test</span>
			</button>
			<a class="navbar-brand" href="#">FlixTix</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active">
					<?php echo anchor('app/home','Home');?></li>
				<li>
					<?php echo anchor('storefront/home','Storefront');?></li>
				<li>
					<?php echo anchor('Layout/list','Layouts');?></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
			<?php echo form_open("login/login_now",'class="navbar-form navbar-right"'); ?>
			<input type="submit" value="Logout" class="btn btn-danger">
			<?php echo form_close(); ?>


			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Link</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</li>

			</ul>

		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>