<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?>

<div class="wrap" id="cron-gui">
	<div id="icon-tools" class="icon32"><br /></div>
	<h2><?php _e( 'What\'s in Cron?' ); ?></h2>


	<h3>Available schedules</h3>
	
	<ul>
		<?php foreach( $schedules as $schedule ) { ?>
			<li><strong><?php echo $schedule[ 'display' ]; ?></strong>, every <?php echo human_time_diff( 0, $schedule[ 'interval' ] ); ?></li>
		<?php } ?>
	</ul>

	<h3>Events</h3>

	<table class="widefat fixed">
		<thead>
			<tr>
				<th scope="col">Next due (GMT/UTC)</th>
				<th scope="col">Schedule</th>
				<th scope="col">Hook</th>
				<th scope="col">Arguments</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $cron as $timestamp => $cronhooks ) { ?>
				<?php foreach ( (array) $cronhooks as $hook => $events ) { ?>
					<?php foreach ( (array) $events as $event ) { ?>
						<tr>
							<th scope="row"><?php echo $event[ 'date' ]; ?> (<?php echo $timestamp; ?>)</th>
							<td>
								<?php 
									if ( $event[ 'schedule' ] ) {
										echo $schedules [ $event[ 'schedule' ] ][ 'display' ]; 
									} else {
										?><em>One-off event</em><?php
									}
								?>
							</td>
							<td><?php echo $hook; ?></td>
							<td><?php if ( count( $event[ 'args' ] ) ) { ?>
								<ul>
									<?php foreach( $event[ 'args' ] as $key => $value ) { ?>
										<strong>[<?php echo $key; ?>]:</strong> <?php echo $value; ?>
									<?php } ?>
								</ul>
							<?php } ?></td>
						</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
	
</div>
