<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('nav_bar_premium');
?>

<script type="text/javascript" src="<?php echo base_url("/assets/js/app.js"); ?>"></script>
<style>
	#system-alert-container
	{
		top        : -6px;
		margin-top : 80px;
		height     : auto;
		width      : 50%;
		z-index    : 9999;
	}

	.system-alert:first-of-type
	{
		margin-top : 0;
	}

	.system-alert
	{
		position : absolute;
		top      : 35px;
		width    : 25%;
	}
</style>
<div id='system-alert-container'>
	<div class='alert hidden alert-dismissible col-md-offset-4 animated system-alert alert-success' id="alert-type" role='alert'>
		<div class="row">
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<i class="glyphicons glyphicons-ok-2"></i>
				<i class="glyphicons glyphicons-circle-exclamation-mark"></i>
				<i class="glyphicons glyphicons-alert"></i>
				<i class="glyphicons glyphicons-circle-info"></i>
			</button>
		</div>
		<span class='system-alert-text hidden-sm-down' id="alert-message"></span>
		<button type='button' class='close close-right' data-dismiss='alert' aria-label='Close'>
			<i class="glyphicons glyphicons-remove-2"></i>
		</button>
	</div>
</div>

<body>
<div class="col-md-8 col-md-offset-2">
	<?php if(isset($beer)) { ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class=" panel-heading">
					<h4 id="beer-name"><?php echo $beer->getName(); ?></h4>
				</div>
				<div class="panel-body">
					<div class="col-md-2">
						<img id="beer-label" style="width: 20vh;height: 20vh" src="<?php echo $beer->getImage('large'); ?>">
					</div>
					<div class="col-md-7">
						<p id="beer-desc" style="font-size: medium">
							<?php echo $beer->getDescription(); ?>
						</p>
					</div>
					<div class="col-md-2">

						<div class="row">
							<form id="favourite_beer">
								<input type="hidden" name="beer_name" value="<?php echo $beer->getName()?>">
								<input type="hidden" name="beer_code"value="<?php echo $beer->getId()?>">
								<button type="button" id="beer-save" class="btn btn-info btn-sm"><p style="font-size:small">
										Save Beer</p></button>
							</form>
						</div>
						<br>
						<div class="row">
							<input type="hidden" id="brewery-list" value="<?php echo implode(",", $beer->getBreweries()) ?? ''; ?>">
							<button type="button" id="brewery-list-btn" class="btn btn-info btn-sm">
								<p style="font-size:small">
									More From This Brewery</p></button>
						</div>

					</div>

				</div>
			</div>
		</div>
	<?php } ?>
</div>
</body>

<script>
	$('#random-beer-btn').on('click', getRandomBeer);
	$('#search').on('click', search);
	$('#brewery-list-btn').on('click', displayBreweryBeers);
	$('#beer-save').on('click', saveBeer);
	var resultTemplate = $('#result-item-template').html();
	$('#result-item-template').remove();
	var BASEPATH = "<?php echo base_url();?>";

	function saveBeer()
	{
		var form_data = $('#favourite_beer').serialize();
		jQuery.ajax({
			type   : "POST",
			url    : BASEPATH + "index.php/premium/saveBeer",
			data   : form_data,
			cache  : false,
			async  : false,
			success: function(response) {
				systemAlert('success', "Beer saved to favourites");
			},
			error  : function(jqXHR, textStatus, errorThrown) {
				systemAlert('danger', "Apologies we encountered an issue");
			}
		});
	}

</script>