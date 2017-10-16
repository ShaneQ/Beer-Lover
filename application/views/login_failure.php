<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('form');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

</head>
<body>

<div id="container">
	<div class="well" style="width:50%; margin: 0 auto;">
		<?php
		echo form_open("login/index");?>
		<div class="form-group">
			<input type="submit" name="submit" value="Try Again" class="btn btn-danger">
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>