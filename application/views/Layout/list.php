<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('form');
$this->load->helper('url');
$this->load->view('nav_bar');
?>

<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="row">
			<div class="col-md-6">
				<h3> Layouts</h3>
			</div>
			<div class="col-md-6">
				<?php
				echo form_open('Layout/addForm');
				echo  form_button(array('class'=>'btn-success pull-right', 'type'=>'submit'), 'Add Layout');
				echo form_close();
				?>
			</div>

		</div>


	</div>

</div>