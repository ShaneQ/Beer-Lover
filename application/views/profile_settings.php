<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('nav_bar_premium');
?>

<body>
<div id="container">

	<?php
	echo form_open("Register/updatePassword"); ?>
	<div class="row ">
		<div class="col-md-4 col-md-offset-4 well">
			<div class="form-group">
				<input type="password" name="password_old" value="<?php echo set_value('password_old'); ?>" minlength="8" maxlength="12" placeholder="old password" class="form-control">
				<?php if(isset($old_password_matching)) echo $old_password_matching;?>
				<?php echo form_error('password_old'); ?>
				<br>
				<input type="password" name="password_one" value="<?php echo set_value('password_one'); ?>" minlength="8" maxlength="12" placeholder="new password" class="form-control">
				<?php echo form_error('password_one'); ?>
				<br>
				<input type="password" name="password_two" value="<?php echo set_value('password_two'); ?>" minlength="8" maxlength="12" placeholder="new password retype" class="form-control">
				<?php echo form_error('password_two'); ?>
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