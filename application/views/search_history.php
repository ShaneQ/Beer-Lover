<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('nav_bar_premium');
$type_array = array(
	1=> 'Beer',
	2=>'Brewery',
);
?>


<body>
<div id="container">
	<div class="col-md-offset-2 col-md-8">
		<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="test">
			<thead>
			<tr>
				<th>id</th>
				<th>Type</th>
				<th>search</th>
				<th>timestamp</th>
				<th>result count</th>
				<th>view</th>
				<th>delete</th>
			</tr>
			</thead>

			<tbody>
			<?php foreach($results as $id => $result) { ?>
				<tr>
					<td><?php echo $id+1; ?></td>
					<td><?php echo $type_array[$result['type']]; ?></td>
					<td><?php echo $result['search']; ?></td>
					<td><?php echo $result['timestamp']; ?></td>
					<td><?php echo $result['results']; ?></td>
					<td>
				<span style="display: inline">
					<?php echo form_open("Premium/searchSpecificBeer"); ?>
					<input type="hidden" name="search_type" value="<?php echo $result['type']; ?>">
					<input type="hidden" name="search_term" value="<?php echo $result['search']; ?>">
				<input type="submit" value="view results" class="btn btn-info btn-sm">
					<?php echo form_close(); ?>

				</span>
					<td>
						<?php echo form_open("Premium/deleteSpecificHistory"); ?>
						<input type="hidden" name="id_search_history" value="<?php echo $result['id']; ?>">
						<input type="submit" value="remove" class="btn btn-danger btn-sm">
						<?php echo form_close(); ?>
					</td>

				</tr>

			<?php } ?>
			</tbody>
		</table>
	</div>
	<script>
		$(document).ready(function() {
			$('#test').DataTable();
		});
	</script>
</div>
</body>