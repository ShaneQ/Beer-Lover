<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('form');
$this->load->view('login/header');
?>

<body>
<div id="container">

	<div class="jumbotron">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">

				<h1> Brewery Login</h1>
			</div>
		</div>
	</div>

	<?php
	if(array_key_exists('login_failure', $_POST) && $_POST['login_failure'] === true) {
		?>
		<h3>Your user name and password combination was not recognised, please try again </h3>
		<?php
		$_POST['login_failure'] = false;
	} ?>
	<?php $attributes = array("name" => "comment-form");
	echo validation_errors();
	echo form_open("login/login_now"); ?>
	<div class="row ">
		<div class="col-md-4 col-md-offset-4 well">
			<div class="form-group">
				<input type="email" name="username" minlength="3" placeholder="username" class="form-control">
				<input type="password" name="password" minlength="8" placeholder="password" class="form-control">
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<div class="col-md-4">
						<input type="submit" name="submit" value="login" class="btn btn-success btn-lg">
					</div>
					<div class="col-md-4">
						<a href="<?php echo site_url('Register') ?>">
							<input type="button" value="Register" class="btn btn-danger btn-lg">
						</a>
					</div>
					<div class="col-md-4">
						<a href="<?php echo site_url('/') ?>">
							<input type="button" value="Free Site" class="btn btn-info btn-lg">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>

</div>
</body>