<?php
/*
Template Name: Page Global Operations
*/
?>

<?php
$global_operations_totals = get_field( 'global_operations_totals' );

// New array to hold re-organised data
$globalArr = [];

foreach ( $global_operations_totals as $k => $v ) {
	$globalArr[ $k ]['country_name']     = $v['country_name'];
	$globalArr[ $k ]['country_code']     = $v['country_code'];
	$globalArr[ $k ]['colour_key']       = $v['colour_key'];
	$globalArr[ $k ]['number_of_stores'] = $v['number_of_stores'];

	foreach ( $v['brands_in_this_country'] as $key ) {
		// Loop over wp post array, and echo needed objects
		$globalArr[ $k ]['brand'][] = $key->post_title;
	}
}
?>

<script type="text/javascript" src="//www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", "1", {packages: ["geochart"]});
	google.setOnLoadCallback(drawRegionsMap);

	function drawRegionsMap() {

		// Begin custom map array
		var mapArr = [
			['Country', 'Total Stores'],
			<?php
				foreach($globalArr as $k => $v): ?>
			['<?php echo $v['country_name']; ?>', <?php echo $v['number_of_stores']; ?>],

			<?php endforeach; ?>
		];

		// Use new custom map array in google maps
		var data = google.visualization.arrayToDataTable(mapArr);

		var options = {
			legend: 'none',
			backgroundColor: {
				fill: 'transparent',
				strokeWidth: '0'
			},
			datalessRegionColor: '#40454d',
			colorAxis: {minValue: 1, maxValue: 9, colors: ['#147a41', '#147a41', '#147a41', '#147a41']},
			keepAspectRatio: true,
			width: 100 + "%",
			height: 100 + "%"
		};

		// Instantiate new chart based on id
		var chart = new google.visualization.GeoChart(document.getElementById('js_globalMap'));

		// Click handler for each country
		google.visualization.events.addListener(chart, 'regionClick', function (eventData) {
			// Popup modal containing data
			$("#country_" + eventData['region']).modal('toggle');
		});

		// Redraw map on resize of window
		window.addEventListener('resize', respond);

		function respond() {
			chart.draw(data, options);
		}
		respond();
	}
</script>

<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part( 'templates/page', 'header' ); ?>
	<?php get_template_part( 'templates/content', 'page' ); ?>

	<div id="js_globalMap" class="hidden-xs"></div>

	<div class="table-responsive text-left visible-xs">
		<table class="table">
			<thead>
			<tr>
				<th><?php _e( 'Country', 'fawazalhokairfashion' ); ?></th>
				<th><?php _e( 'Number of Stores', 'fawazalhokairfashion' ); ?></th>
				<th><?php _e( 'Brands', 'fawazalhokairfashion' ); ?></th>
			</tr>
			</thead>

			<tbody>
			<?php foreach ( $globalArr as $k => $v ) : ?>
				<tr>
					<td><?php echo $v['country_name']; ?></td>
					<td><?php echo $v['number_of_stores']; ?></td>
					<td>
						<?php foreach ( $v['brand'] as $b ) : ?>
							<?php echo $b . ',' ?>
						<?php endforeach; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php foreach ( $globalArr as $k => $v ): ?>
		<div class="modal fade" id="country_<?php echo $v['country_code']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $v['country_name']; ?>" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel"><?php echo $v['country_name']; ?> -  <?php echo $v['number_of_stores']; ?> Stores</h3>
					</div>
					<div class="modal-body">
						<p>
							<?php foreach ( $v['brand'] as $b ) : ?>
								<?php echo $b . ', ' ?>
							<?php endforeach; ?>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endwhile; ?>