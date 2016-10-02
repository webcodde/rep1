<?php
/**
 * Single Event Meta (Map) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */
$post_id = get_the_ID();

if(wp_get_post_parent_id($post_id)!=0){
	$event_id = wp_get_post_parent_id($post_id);
} else {
	$event_id = $post_id;
}
$venuename = tribe_get_venue($event_id);
$venueAddress = tribe_get_address($event_id);
$venueZipCity = tribe_get_zip($event_id) . ' ' . tribe_get_city($event_id);
$venuemap = tribe_get_embedded_map($event_id);

if ( empty( $venuemap ) ) {
	return;
}

?>
<section class="bigMap">
	<div class="row">
		<div class="tribe-events-venue-map">
	<?php
	// Display the map.
	do_action( 'tribe_events_single_meta_map_section_start' );
	echo $venuemap;
	echo '<span class="mapAdd">'.$venuename.', '. $venueAddress . ', ' .$venueZipCity. '</span>';
	do_action( 'tribe_events_single_meta_map_section_end' );
	?>
		</div>
	</div>
</section>

