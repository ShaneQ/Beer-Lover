<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('form');
$this->load->view('login/header');

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="<?php echo base_url('assets/js/check-form.js'); ?>"></script>
<body>
<div id="container">
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h2> Brewery Registration</h2>
				<p>Register to avoid nasty ads and get premium features</p>
			</div>
		</div>
	</div>
	<?php
	echo form_open("register/registerIt", array('id' => 'registration_form')); ?>
	<div class="row ">
		<div class="col-md-4 col-md-offset-4 well">
			<div class="form-group ">
				<div class="col-md-12 ">

					<div class="row form-group">
						<input type="text" name="first_name" minlength="1" maxlength="35" placeholder="first name" value="<?php echo set_value('first_name'); ?>" class="form-control required">
						<?php echo form_error('first_name'); ?>
					</div>
					<div class="row form-group">
						<input type="text" name="last_name" minlength="1" maxlength="35" placeholder="last name" value="<?php echo set_value('last_name'); ?>" class="form-control required">
						<?php echo form_error('last_name'); ?>
					</div>
					<div class="row form-group">
						<input type="email" name="email_one" minlength="3" maxlength="50" placeholder="email" value="<?php echo set_value('email_one'); ?>" class="form-control required">
						<?php if(isset($email_exists)) {
							echo $email_exists;
						} ?>
						<?php echo form_error('email_one'); ?>
					</div>
					<div class="row form-group">
						<input type="email" name="email_two" minlength="3" maxlength="50" placeholder="re-type email" class="form-control required">
						<?php echo form_error('email_two'); ?>
					</div>
					<div class="row form-group">
						<input type="password" name="password" minlength="8" maxlength="12" placeholder="password" value="<?php echo set_value('password'); ?>" class="form-control required">
						<?php echo form_error('password'); ?>
					</div>
					<div class="row">
						<div class="col-md-4 ">
							<input type="submit" value="register" class="btn btn-success btn-lg">

						</div>
						<div class="col-md-4">
							<a href="<?php echo site_url('login/') ?>">
								<input type="button" value="login" class="btn btn-danger btn-lg">
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
	</div>
</div>
<?php echo form_close(); ?>
</body>
<script>
	$('#registration_form').on('submit', function(e) {
		var check = validateForm('registration_form');
		if(check){
			e.preventDefault();
		}
	});


</script>