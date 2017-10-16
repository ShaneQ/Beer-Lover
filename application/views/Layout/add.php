<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('form');
$this->load->helper('url');
$this->load->view('nav_bar');
?>

<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="row">
			<h3> Layouts</h3>
		</div>
		<?php echo form_open('Layout/add', array(
			'name' => 'layout_form',
			'id'   => 'form_one'
		)); ?>
		<div class="row">
			<div class="form-group">
				<label>Name:
					<input type='text' class="required form-control" name='layout_name' id="layout">
				</label>
			</div>
		</div>
		<div class="row ">
			<div class="col-md-3">
				<h3>Sections:</h3>
			</div>
		</div>
		<div id='section' class="form-group">
			<div class="row ">
				<div class="col-md-3 pull-right">
					<button type='button' id="add_section" class="btn-success btn-xs ">Add Another Section</button>
				</div>
			</div>
			<div id="section">
				<div id="section_template">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Name:
									<input class="form-control required" type='text' name='section[0][name]'>
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Size:
									<input class="form-control required" type='number' name='section[0][size]'>
								</label>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-5">
				<button class="btn-success" id="save"> Save</button>
				<button class="btn-danger"> Cancel</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
	<script>
		var section_template = $('#section_template').html();
		var section_template_number = 1;
		$('#add_section').on('click', addNewSection);
		$('#save').on('click', save);

		function addNewSection()
		{
			var new_section = section_template.replace(/[0]/gi, section_template_number);
			section_template_number++;
			$('#section').append(new_section);
		}

		function validateFrom(form_name)
		{
			var check = true;
			$('#' + form_name + ' .required').each(function(index) {
				if($(this).val() === '') {
					check = false;
					$(this).closest('.form-group').addClass('has-error');
				}
				else {
					$(this).closest('.form-group').removeClass('has-error');
				}
			});
			return check
		}

		function save()
		{
			if(!validateFrom('form_one')) {
				event.preventDefault();
			}
		}
	</script>