<?php defined('ABSPATH') or die();

/* Event Short Content */
add_shortcode('event_data','event_data_display');
function event_data_display(){
	// Retrieve the next 4 upcoming events
	$events = tribe_get_events(array(
	 'posts_per_page' => 4,
	 'tribe_events_cat' => '',
	 'order' => 'ASC'
	 ));
	
	if(count($events)>0){
		$eventData="<ul class='actualCourseList' itemprop='event-list'>";
		foreach ($events as $key => $value){
			$event_id 	= $value->ID;
			$location 	= sp_get_city($value->ID);
			$venue 	= sp_get_venue($value->ID);
			$startDate 	= sp_get_start_date($value->ID);
			$eventLink = tribe_get_event_link($event_id);
			$eventurl = get_permalink($event_id);
			$eventImage = /*tribe_event_featured_image($value->ID); */get_the_post_thumbnail($event_id, 'kursefeatured');
			/* $eventData .= '<li>
						<a href="'.tribe_get_event_link($value->ID).'" title="Lernen Sie wie es richtig geht: beim '.$value->post_title.'">'; */
			if($eventImage=='')
				$eventData .= '<li itemscope itemtype="http://schema.org/Event"><a itemprop="image" href="'.$eventurl.'"><img itemprop="image" alt="Kochkurse, Grillkurse und Weinproben in Hamburg" src="'.get_template_directory_uri().'/images/no-image.png"></a>';
			else
				$eventData .= '<li itemscope itemtype="http://schema.org/Event"><a itemprop="url" href="'.$eventLink.'">'.$eventImage.'</a>';

			$eventData .= '<h3 itemprop="name">'.$value->post_title.'</h3><div itemprop="location" itemscope itemtype="http://schema.org/Place" class="location"><span itemprop="name">'.$venue.'</span> <span class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="addressLocality">'.$location.'</span></span></div><div class="btns"><a class="btn" href="'.tribe_get_event_link($value->ID).'">Details</a><a class="btn mrgL5" href="'.tribe_get_event_link($value->ID).'">Anmelden</a></div><span class="blindhelper" itemprop="startDate" content="'.$startDate.'"></span>
					</li>';
		}
		$eventData .= '</ul>';
	}else{
		$eventData='Aktuell finden leider keine Kochkurse oder Weinproben statt.';
	} 
	return $eventData;
}

/* Event Short Content */
add_shortcode('event_listing','event_listing_display');
function event_listing_display( $atts ){
	
	$event_listing_atts = shortcode_atts( array(
			'kat' => '',
		), $atts, 'event_listing');
	if (isset($atts['kat'])) {
	$kat = $atts[ 'kat' ];
	} else {
		$kat = '';
	}
 
	$events = tribe_get_events(array(
	 'tribe_events_cat' => $kat,
	 'order' => 'DESC'
	 ));
	
	if(count($events)>0){
		$eventData="<ul class='actualCourseList' itemprop='event-list'>";
		foreach ($events as $key => $value){
			$event_id 	= $value->ID;
			$location 	= sp_get_city($value->ID);
			$venue 	= sp_get_venue($value->ID);
			$startDate 	= sp_get_start_date($value->ID);
			$eventLink = tribe_get_event_link($event_id);
			$eventImage = get_the_post_thumbnail($event_id, 'kursefeatured');
			
			$eventurl = get_permalink($event_id);
			if($eventImage=='')
				$eventData .= '<li itemscope itemtype="http://schema.org/Event"><a itemprop="image" href="'.$eventurl.'"><img itemprop="image" alt="Kochkurse, Grillkurse und Weinproben in und um Hamburg" src="'.get_template_directory_uri().'/images/no-image.png"></a>';
			else
				$eventData .= '<li itemscope itemtype="http://schema.org/Event"><a itemprop="url" href="'.$eventurl.'">'.$eventImage.'</a>';
			
			$eventData .= '<h3 itemprop="name">'.$value->post_title.'</h3><div itemprop="location" itemscope itemtype="http://schema.org/Place" class="location"><span itemprop="name">'.$venue.'</span> <span class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="addressLocality">'.$location.'</span></span></div><div class="btns" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><a class="btn" itemprop="url" href="'.tribe_get_event_link($value->ID).'">Details</a><a class="btn mrgL5" href="'.$eventLink.'">Anmelden</a><a class="alsGutscheinBtn" href="'.$eventLink.'">Als Gutschein</a></div><span class="blindhelper" itemprop="startDate" content="'.$startDate.'"></span>
					</li>';
		}
		$eventData .= '</ul>';
	}else{
		if (isset($atts['kat'])) {
			$eventData='Aktuell finden leider keine '.$kat.' statt.';	
		} else {
			$eventData='Aktuell finden leider keine Kurse statt.';
		}
	} 
	return $eventData;

}
?>