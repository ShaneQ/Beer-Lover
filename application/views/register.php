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
        <?php echo validation_errors();
        echo form_open("register/registerIt"); ?>
        <div class="form-group">
            <div class="row">
                <input type="text" name="first_name" placeholder="first_name"  value="<?php echo set_value('first_name'); ?>" class="form-control">
            </div>
            <div class="row">
                <input type="text" name="last_name" placeholder="last_name"  value="<?php echo set_value('last_name'); ?>" class="form-control">
            </div>
            <div class="row">
                <input type="email" name="email_one" placeholder="email"  value="<?php echo set_value('email_one'); ?>" class="form-control">
            </div>
            <div class="row">
                <input type="email" name="email_two" placeholder="re-type email"  value="<?php echo set_value('email_two'); ?>" class="form-control">
            </div>
            <div class="row">
                <input type="password" name="password" placeholder="password"  value="<?php echo set_value('password'); ?>" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="register" class="btn btn-danger">
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>