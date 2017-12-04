<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?php echo base_url('assets/js/check-form.js'); ?>"></script>
</head>
<style>
	body {
		/** FROM www.trilliumbrewing.com , https://static1.squarespace.com/static/5527dc92e4b04be388ca48e4/5527e4a1e4b079f2c38d11e3/5638df8ae4b07293802143ed/1510931224174/trillium-brewing-taps-2.jpg?format=1500w**/
		background-image: url("<?php echo base_url('assets/images/background_taps.png'); ?>");
		background-color: #ffffff;
	}
	input{
		margin: 10px;
	}
</style>