<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('form');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tix.ie</title>
	<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>

<div id="container">
    <div class="well" style="width:50%; margin: 0 auto;">
	    <?php
		if($_POST['login_failure'] === true){?>
			<h3>Your user name and password combination was not recognised, please try again </h3>

			<?php
			$_POST['login_failure'] = false;
		}?>
        <?php $attributes = array("name" => "comment-form");
        echo validation_errors();
        echo form_open("login/login_now");?>
        <div class="form-group">
            <input type="email" name="username" placeholder="username" class="form-control">
            <input type="password" name="password" placeholder="password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="login" class="btn btn-danger">
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>