<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('nav_bar_premium');
?>
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
<header>
	<script type="text/javascript" src="<?php echo base_url("/assets/js/app.js"); ?>"></script>
</header>
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
<div class="col-md-8 col-md-offset-2 col-sm-5">
	<div class="col-md-12" id="search-info">
		<div class="panel panel-default">
			<div class=" panel-heading">
				<strong>Search</strong>
			</div>
			<div class="panel-body">
				<form id="search-form">
					<div class="col-md-3">
						<label>
							<input type="text" id="query" name="query" placeholder="Search">
						</label>
					</div>
					<div class="col-md-6 btn-group" data-toggle="buttons">
						<div class="form-group">
							<div>
								<label style="margin-left:10vh">
									<input type="radio" id="q_1" name="query_type" checked="checked" value="1"/> Beer
								</label>
								<label style="margin-left:10vh">
									<input type="radio" id="q_2" name="query_type" value="2"/>Brewery
								</label>
							</div>
						</div>
				</form>
			</div>
			<div class="col-md-3">
				<button type="button" id="search" class="btn btn-info"><p style="font-size:large">Search</p></button>
			</div>

		</div>
	</div>
	<div class="" id="search-results">
		<div class="panel panel-default">
			<div class=" panel-heading">
				<strong>Search Results</strong>
			</div>
			<div id="results"></div>
			<div id="result-item-template" class="hidden">
				<div class="result">
					<div class="panel-body">
						<div class="col-md-2">
							<img src="##img-src##" style="height: 15vh;width: 15vh;">
						</div>
						<div class="col-md-8 col-sm-3">
							<div class="row">
								<h5>##name##</h5>
							</div>
							<div class="row">
								<p>##description##</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="result-messages">
				<div class="panel-body">
					<div class="col-md-offset-4 col-md-8 ">
						<h2 id="result-message">SEARCH FOR SOMETHING</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	$('#search').on('click', search);
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
	function searchBeer(search_criteria){
		$('#query').val(search_criteria);
		$('#q_1').attr('checked', true);
		search();
	}
	function searchBrewery(search_criteria){
		$('#query').val(search_criteria);
		$('#q_2').attr('checked', true);
		search();
	}

<?php if(isset($search_beer)){ ?>
	$( document ).ready(function() {
		searchBeer("<?php echo $search_beer;?>");
	});

<?php }else if(isset($search_brewery)) { ?>
	$( document ).ready(function() {
		searchBrewery("<?php echo $search_brewery;?>");
	});
<?php } ?>

</script>
