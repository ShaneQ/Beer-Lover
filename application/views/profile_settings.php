<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('nav_bar_premium');
?>
<script src="<?php echo base_url('assets/js/check-form.js'); ?>"></script>

<body>
<div id="container">

	<?php
	echo form_open("Register/updatePassword", array('id'=>"update_password_form")); ?>
	<div class="row ">
		<div class="col-md-4 col-md-offset-4 well">
			<div class="form-group">
				<div class="row form-group col-md-12">
					<input type="password" name="password_old" value="<?php echo set_value('password_old'); ?>" minlength="8" maxlength="12" placeholder="old password" class="form-control required">
					<?php if(isset($old_password_matching)) echo $old_password_matching;?>
					<?php echo form_error('password_old'); ?>
				</div>
				<div class="row form-group col-md-12">
					<input type="password" name="password_one" value="<?php echo set_value('password_one'); ?>" minlength="8" maxlength="12" placeholder="new password" class="form-control required">
					<?php echo form_error('password_one'); ?>
				</div>
				<div class="row form-group col-md-12">
					<input type="password" name="password_two" value="<?php echo set_value('password_two'); ?>" minlength="8" maxlength="12" placeholder="new password retype" class="form-control required">
					<?php echo form_error('password_two'); ?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<div class="col-md-offset-4 col-md-4">
						<input type="submit" name="submit" value="Update Password" class="btn btn-success btn-lg">
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>

</div>
</body>

<script>
	$('#update_password_form').on('submit', function(e) {
		var check = validateForm('update_password_form');
		if(check) {
			e.preventDefault();
		}
	});
</script>