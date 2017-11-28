<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('nav_bar_premium');

?>


<body>
<div class="col-md-8 col-md-offset-2">
	<?php if(isset($beer)) { ?>

		<div class="col-md-12">
			<h1> Beer Info </h1>
		</div>
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


	<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="test">
		<thead>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>code</th>
			<th>timestamp</th>
			<th>view</th>
			<th>delete</th>
		</tr>
		</thead>

		<tbody>
		<?php foreach($results as $id_result => $result) { ?>
			<tr>
				<td><?php echo $id_result + 1; ?></td>
				<td><?php echo $result['name']; ?></td>
				<td><?php echo $result['code']; ?></td>
				<td><?php echo $result['timestamp']; ?></td>
				<td>
				<span style="display: inline">
					<?php echo form_open("Premium/specificBeer"); ?>
					<input type="hidden" name="code" value="<?php echo $result['code']; ?>">
				<input type="submit" value="view details" class="btn btn-info btn-sm">
					<?php echo form_close(); ?>

				</span>
				<td>
					<?php echo form_open("Premium/deleteSpecificFavouriteBeer"); ?>
					<input type="hidden" name="id_beer_favourite" value="<?php echo $result['id']; ?>">
					<input type="submit" value="remove" class="btn btn-danger btn-sm">
					<?php echo form_close(); ?>
				</td>

			</tr>

		<?php } ?>
		</tbody>
	</table>

</div>
</body>

<script>
	$(document).ready(function() {
		$('#test').DataTable();
	});
</script>