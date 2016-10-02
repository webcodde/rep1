<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */
$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;
$website = tribe_get_organizer_website_link();
?>
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}
			?>
			<div class="staffMain">
				<?php echo get_the_post_thumbnail($organizer, 'kochthumb'); ?>
				
				<div class="staffAddress"><span><?php echo tribe_get_organizer( $organizer )."</span>,<br>". tribe_community_events_get_organizer_description ($organizer);?></div>
			</div>
		<?php	
		}	
		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
