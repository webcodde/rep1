<?php defined('ABSPATH') or die();

/* Premium 	Location */
add_shortcode( 'premium_locations', 'premium_locations_display' );
function premium_locations_display(){
	$argsclint = array('post_type'=>'premium_locations');
	$string="";
	
	if( class_exists('Dynamic_Featured_Image') ) {
			global $dynamic_featured_image;
			global $thumbImage;
	}
    $premiumLocationsData = new WP_Query($argsclint);
	
    if( $premiumLocationsData->have_posts() ) {
	  while( $premiumLocationsData->have_posts()) : $premiumLocationsData->the_post();
		
		$i=0;
		$j=0;
		$address=get_field('address',get_the_ID());	 
		$map = get_field('map',get_the_ID());	 
		$title = get_the_title();
		$featured_images = $dynamic_featured_image->get_featured_images($posts->id);
		$location_logo = wp_get_attachment_url(get_post_thumbnail_id($posts->id)); 
		$thisPage = the_post($posts->id);
		
		$string .='
		<section class="zurUbersicht locationMap">
		<div class="row">
			<div class="zurUbersichtContent">
				<div class="zurUbersichtSlider">
					<div id="thumbsScrollSlider0" class="thumbsScrollSlider">
						<img src="'.$location_logo.'" style="width:135px; height:130px; position: absolute; z-index:5;  top: 174%; left: 13%;">
						<ul id="bxslider0" class="bxslider">';
					foreach($featured_images as $mainImage){
						$string .=	'<li><a href="" title="Image '.$i.'" rel="group-'.$posts->id.'" class="litebox"><img src="'.$mainImage['thumb'].'" alt="Location" width="646" height="367"></a></li>';
						$i++;
					}
						$string .=	'		
						</ul>
						<div id="bx-pager0" class="bx-pager">
							<ul>';
					foreach($featured_images as $thumbImage){
						$string .=	'<li><a href="javascript:void(0);" onClick="clicked0('.$i.');"><img src="'.$thumbImage['thumb'].'" alt="Location" width="98" height="66"></a></li>';
						$j++;
					}
						$string .=	'		
							</ul>
						</div>
					</div>
				</div>
				<div class="asidebar">
					<div class="gutscheinBestellen">
						<div class="acf-map">
							<div class="marker" data-lat="'.$map['lat'].'" data-lng="'.$map['lng'].'"></div>
						</div>
						<div class="bestellenBlock">
							<h3>'.$title.'</h3>
							<span class="h3SubTitle">'.$address.'</span>
							'.get_the_content().'
							<div class="btns"> <a class="btn" href="#">Unverbindlich anfragen</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</section>';
		$i++;
	  endwhile;
	  
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $string;
    }
    else {
      $string='';
	  return $string;
    }
} 

/* Banner Kurse */
add_shortcode( 'banner_kurse', 'banner_kurse_display' );
function banner_kurse_display(){
	$argsclint = array('post_type'=>'banner_kurse');
	$string="";
	$class ="<style>";
	$i=1;
    $bannerData = new WP_Query($argsclint);
	
    if( $bannerData->have_posts() ) {
	 $string = '<div id="gutscheineSlider" class="gutscheine-inner-banner bannerHight"><ul class="gutscheineSlider">';
      while( $bannerData->have_posts()) : $bannerData->the_post();
		$banner_image = wp_get_attachment_url(get_post_thumbnail_id($posts->id));
		$thisPage = the_post($posts->id);
		$class.= "li.gutschen".$i."{background-position: center; background-size: cover; width: 100%; height:267px; background-image: url('$banner_image');}"; 
		//$string.='<li><img src="'.$banner_image.'" alt="'.get_the_title().'" width="1440" height="267" /><h1>'.get_the_title().' <span>'.get_post_field('post_content', $posts->id).'</span></h1></li>';
		$string.='<li class="gutschen'.$i.'"></li>';
		$i++;
	  endwhile;
	  $string.= "</ul><h1 class='kurseslider'>".get_field('titel_im_kursbanner', $thisPage)."</h1></div>";
	  $class.="</style>";
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $class.$string;
    }
    else {
      $string='';
	  return $string;
    }
} 

/* Banner Gutscheine */
add_shortcode( 'banner_gutscheine', 'banner_gutscheine_display' );
function banner_gutscheine_display(){
	$argsclint = array('post_type'=>'banner_gutscheine');
	$string="";
	$class ="<style>";
	$i=1;
    $bannerData = new WP_Query($argsclint);
	
    if( $bannerData->have_posts() ) {
	 $string = '<div id="gutscheineSlider" class="gutscheine-inner-banner bannerHight"><ul class="gutscheineSlider">';
      while( $bannerData->have_posts()) : $bannerData->the_post();
		$banner_image = wp_get_attachment_url(get_post_thumbnail_id($posts->id));
		$thisPage = the_post($posts->id);
		$class.= "li.gutschen".$i."{background-position: center; background-size: cover; width: 100%; height:267px; background-image: url('$banner_image');}"; 
		//$string.='<li><img src="'.$banner_image.'" alt="'.get_the_title().'" width="1440" height="267" /><h1>'.get_the_title().' <span>'.get_post_field('post_content', $posts->id).'</span></h1></li>';
		$string.='<li class="gutschen'.$i.'"></li>';
		$i++;
	  endwhile;
	  $string.= "</ul><h1 class='kurseslider'>".get_field('titel_im_kursbanner', $thisPage)."</h1></div>";
	  $class.="</style>";
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $class.$string;
    }
    else {
      $string='';
	  return $string;
    }
} 

/* Banner Home */
add_shortcode( 'banner_home', 'banner_home_display' );
function banner_home_display(){
	$argsclint = array('post_type'=>'banner_home');
	$string="";
    $bannerData = new WP_Query($argsclint);
	
    if( $bannerData->have_posts() ) {
		
	 $string = "<div class='sliderBanner'>";
      while( $bannerData->have_posts()) : $bannerData->the_post();
	 
		$banner_image = get_field('banner_image', get_the_ID());
		$string.='<figure class="item">
            <img src="'.$banner_image['url'].'" alt="'.get_the_title().'" width="1440" height="549">
        </figure>';
	  endwhile;
	  $string.= "</div>";
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $string;
    }
    else {
      $string='';
	  return $string;
    }
} 

/* Ribbon Home */
add_shortcode( 'ribbon_home', 'ribbon_home_display' );
function ribbon_home_display(){
	$argsclint = array('post_type'=>'ribbon_home');
	$string="";
    $ribbonData = new WP_Query($argsclint);
	
    if( $ribbonData->have_posts() ) {
		
	  $string = "<div class='sideStrip'>";
      while( $ribbonData->have_posts()) : $ribbonData->the_post();
	 
		$ribbonTitle = get_field('ribbon_title', get_the_ID());
		$ribbonText = get_field('ribbon_text', get_the_ID());
		$ribbonTextColor = get_field('ribbon_text_color', get_the_ID());
		$ribbonStart = get_field('ribbon_start', get_the_ID());
		$ribbonEnd = get_field('ribbon_end', get_the_ID());
		$string.='<span style="color:'.$ribbonTextColor.'"><span>'.$ribbonTitle.'</span>'.$ribbonText.'</span>';
		
		
	  endwhile;
	  $string.= "</div>";
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $string;
    }
    else {
      $string='';
	  return $string;
    }
} 

/* Tour Section */
add_shortcode('tour_sec_home', 'tour_sec_home_display');
function tour_sec_home_display(){
	$argsclint = array('post_type'=>'tour_sec_home');
	$string="";
    $tourData = new WP_Query($argsclint);
	
    if( $tourData->have_posts() ) {
		
		while( $tourData->have_posts()) : $tourData->the_post();

			$tour_image = get_field('tour_image', get_the_ID());
			$tour_title = get_field('tour_title', get_the_ID());
			$tour_sub_title = get_field('tour_sub_title', get_the_ID());
			$tour_content = get_field('tour_content', get_the_ID());
			$tour_details = get_field('tour_details', get_the_ID());
			/* $tour_anmelden = get_field('tour_anmelden', get_the_ID()); */
		
			$string = '<section class="tourParallax">
					<div class="parallaxImg" data-scrollax-parent="true">
						<img src="'.$tour_image['url'].'" alt="'.$tour_title.'" width="1584" height="595" data-scrollax="properties: {\'translateY\': \'50%\'}"> 
					</div>
					<div class="row">
						<article class="tipBox">
							<h2>'.$tour_title.'</h2>
							<span class="subTitle">'.$tour_sub_title.'</span>
							<p>'.$tour_content.'</p>
							<div class="btns">
								<a href="'.$tour_details.'" title="Erfahren Sie mehr zum Event: '.$tour_title.'" class="btn">Details</a>
								<a href="'.$tour_details.'" title="Sichern Sie sich gleich Ihren Platz!" class="btn mrgL10">Anmelden</a>
							</div>
						</article>
					</div>
				</section>';
	
		endwhile;
		wp_reset_postdata();
		//wp_reset_query(); 
		return $string;
    }
    else {
      $string='';
	  return $string;
    }
}

/* Footer Content */
add_shortcode( 'footer_content', 'footer_content_display' );
function footer_content_display(){
	$argsclint = array('post_type'=>'footer_content');
	$string="";
    $footerData = new WP_Query($argsclint);
	
    if( $footerData->have_posts() ) {
		
	  while( $footerData->have_posts()) : $footerData->the_post();
	 
		$erlebniskochen_haus = get_field('erlebniskochen_haus', get_the_ID());
		$erlebniskochen_loft = get_field('erlebniskochen_loft', get_the_ID());
		$reservation_details = get_field('reservation_details', get_the_ID());
		
		$string.='<h3>Erlebniskochen HAUS</h3><p>'.$erlebniskochen_haus.'</p>';
		$string.='<h3>ERLEBNISKOCHEN LOFT</h3><p>'.$erlebniskochen_loft.'</p>';
		$string.='<h3>RESERVIERUNG</h3><p class="last">'.$reservation_details.'</p>';
		
	  endwhile;
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $string;
    }
    else {
      $string='';
	  return $string;
    }
}

/* Event Short Content */
add_shortcode('event_data','event_data_display');
function event_data_display(){
	// Retrieve the next 4 upcoming events
	$events = tribe_get_events(array(
	 'posts_per_page' => 4,
	 'tribe_events_cat' => '',
	 'order' => 'DESC'
	 ));
	
	if(count($events)>0){
		$eventData="<ul class='actualCourseList'>";
		foreach ($events as $key => $value){
			$event_id 	= $value->ID;
			$location 	= sp_get_city($value->ID);
			$eventImage = tribe_event_featured_image($value->ID);
			$eventData .= '<li>
						<a href="'.tribe_get_event_link($value->ID).'" title="Lernen Sie wie es richtig geht: beim '.$value->post_title.'">';
			if($eventImage=='')
				$eventData .= '<div class="tribe-events-event-image"><img alt="Das Event: '.$value->post_title.' findet in '.$location.' statt." src="'.get_template_directory_uri().'/images/no-image-home.png" width="310" height="171"></div></a>';
			else
				$eventData .= $eventImage;

			$eventData .= '</a>
						<h3 itemprop="event-title">'.$value->post_title.'</h3><span itemprop="event-location" class="location">'.$location.'</span><div class="btns"><a class="btn" href="'.tribe_get_event_link($value->ID).'">Details</a><a class="btn mrgL5" href="'.tribe_get_event_link($value->ID).'">Anmelden</a></div>
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
			
			$eventData .= '<h3 itemprop="name">'.$value->post_title.'</h3><div itemprop="location" itemscope itemtype="http://schema.org/Place" class="location"><span itemprop="name">'.$venue.'</span><span class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="addressLocality">'.$location.'</span></span></div><div class="btns" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><a class="btn" itemprop="url" href="'.tribe_get_event_link($value->ID).'">Details</a><a class="btn mrgL5" href="'.$eventLink.'">Anmelden</a><a class="alsGutscheinBtn" href="'.$eventLink.'">Als Gutschein</a></div><span class="blindhelper" itemprop="startDate" content="'.$startDate.'"></span>
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

add_shortcode('location_details','location_details_display');
function location_details_display(){
	
	$argsclint = array('post_type'=>'tribe_venue');
	$string='<ul class="locationList">';
    $venueData = new WP_Query($argsclint);
	$i=0;
    if( $venueData->have_posts() ) {
	  while( $venueData->have_posts()) : $venueData->the_post();
		
	  if( class_exists('Dynamic_Featured_Image') ) {
			global $dynamic_featured_image;
			global $thumbImage;
		}
		$thumbImages='';
		$mainImages='';
		$featured_images = $dynamic_featured_image->get_featured_images( get_the_ID() );
		$j=1;
		
		$thumbImages .= '<a data-slide-index="'.$i.'" href=""><img src="'.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' ).'" alt="Location" width="83" height="47"></a>';
		$mainImages  .= '<li><a href="#" title="Image '.get_the_ID().$i.'" rel="group-'.$i.'" class=""><img src="'.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' ).'" alt="Location" width="204" height="203"></a></li>';
		foreach ($featured_images as $thumbImage){
			$thumbImages .= '<a data-slide-index="'.$j.'" href=""><img src="'.$thumbImage['thumb'].'" alt="Location" width="83" height="47"></a>';
			$mainImages  .= '<li><a href="#" title="Image '.get_the_ID().$j.'" rel="group-'.$i.'" class=""><img src="'.$thumbImage['thumb'].'" alt="Location" width="204" height="203"></a></li>';
			$j++;
		}
		$i++;
		$string.= 
		'<li>
			<div class="gutscheinBestellen">
			  <div class="verticalSliderWrap cf">
				<ul class="verticalSlider">
					'.$mainImages.'
				</ul>
				<div class="bx-pager"> '.$thumbImages.' </div>
			  </div>
			  <div class="bestellenBlock">
				<h3>'.get_the_title().'</h3>
				<div class="listItems">'.substr(get_the_content(),0,350).'</div>
			  </div>
			  <div class="btns"> <a class="btn" href="#">Unverbindlich anfragen</a></div>
			</div>
		</li>';
		
	  endwhile;
	}  
	
	$string.= '</ul>';
	return $string;
}

/* Featured	Location */
add_shortcode( 'featured_locations', 'featured_locations_display' );
function featured_locations_display(){
	
	global $lat;
	global $lbg;
	
	$argsclint = array('post_type'=>'tribe_venue');
	$string="";
	
	if( class_exists('Dynamic_Featured_Image') ) {
			global $dynamic_featured_image;
			global $thumbImage;
	}
    $featuredLocationsData = new WP_Query($argsclint);
	
    if( $featuredLocationsData->have_posts() ) {
	  while( $featuredLocationsData->have_posts()) : $featuredLocationsData->the_post();
		
		$i=0;
		$j=0;
		
		$mapArray = tribe_get_coordinates(get_the_ID());
		$lat = $mapArray['lat'];
		$lng = $mapArray['lng'];

		$location_logo=get_field('location_logo',get_the_ID());	 
		$address = tribe_get_full_address(get_the_ID());
		$is_featured_location = get_field('featured_location',get_the_ID());	 
		$title = get_the_title();
		$featured_images = $dynamic_featured_image->get_featured_images(get_the_ID());
		$thisPage = the_post(get_the_ID());
		
		if($is_featured_location[0]==''){
			break;
		}
		
		$string .='
		<section class="zurUbersicht locationMap">
		<div class="row">
			<div class="zurUbersichtContent">
				<div class="zurUbersichtSlider">
					<div id="thumbsScrollSlider0" class="thumbsScrollSlider">
						<img src="'.$location_logo.'" style="width:135px; height:130px; position: absolute; z-index:5;  top: 175%; left: 14%;">
						<ul id="bxslider0" class="bxslider">';
					foreach($featured_images as $mainImage){
						$string .=	'<li><a href="" title="Image '.$i.'" rel="group-'.$posts->id.'" class="litebox"><img src="'.$mainImage['full'].'" alt="Location" width="646" height="367"></a></li>';
						$i++;
					}
						$string .=	'		
						</ul>
						<div id="bx-pager0" class="bx-pager">
							<ul>';
					foreach($featured_images as $thumbImage){
						$string .=	'<li><a href="javascript:void(0);" onClick="clicked0('.$j.');"><img src="'.$thumbImage['thumb'].'" alt="Location" width="98" height="66"></a></li>';
						$j++;
					}
						$string .=	'		
							</ul>
						</div>
					</div>
				</div>
				<div class="asidebar">
					<div class="gutscheinBestellen">
						<div id="gmap1" class="gmap smallMap"></div>
						<div class="bestellenBlock">
							<h3>'.$title.'</h3>
							<span class="h3SubTitle">'.$address.'</span>
							'.get_the_content().'
							<div class="btns"> <a class="btn" href="#">Unverbindlich anfragen</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</section>';
		$i++;
	  endwhile;
	  
	  wp_reset_postdata();
	  //wp_reset_query(); 
	  
	  return $string;
    }
    else {
      $string='';
	  return $string;
    }
} 
?>