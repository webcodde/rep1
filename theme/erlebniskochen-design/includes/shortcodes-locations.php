<?php defined('ABSPATH') or die();

add_shortcode('location_details','location_details_display');
function location_details_display(){
	
	$argsclint = array('post_type'=>'tribe_venue');
	$string='<ul class="locationList">';
    $venueData = new WP_Query($argsclint);
	$i=0;
	$count=1;
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
			if($j>2){
				break;
			}else{
				$j++;
			}
		}
		$i++;
		$id=get_the_ID();
		$venue_id=get_the_ID();
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
				<h3 id="title'.$id.'">'.get_the_title().'</h3>
				<div class="listItems">'.substr(get_the_content(),0,350).'</div>
			  </div>
			  <div class="btns"> <button class="btn" id="myBtn'.$venue_id.'" onclick="getPopup('.$venue_id.')">Unverbindlich anfragen</button></div>
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
	$string='';
	
	if( class_exists('Dynamic_Featured_Image') ) {
			global $dynamic_featured_image;
			global $thumbImage;
	}
    $featuredLocationsData = new WP_Query($argsclint);
	
	$i=0;
	$j=0;
   
	
	if( $featuredLocationsData->have_posts() ) {
	  while( $featuredLocationsData->have_posts()) : $featuredLocationsData->the_post();
		
		$venuemap = tribe_get_embedded_map(get_the_ID());
		if ( empty( $venuemap ) ) {
		return;
		}
		$venue_id = get_the_ID();
		$location_logo=get_field('location_logo',get_the_ID());	 
		$address = tribe_get_address(get_the_ID()) . ', ' . tribe_get_zip(get_the_ID()) .' '. tribe_get_city(get_the_ID());
		$is_featured_location = get_field('featured_location',get_the_ID());	 
		$title = get_the_title();
		$featured_images = $dynamic_featured_image->get_featured_images(get_the_ID());
		$thisPage = the_post(get_the_ID());
		if( !empty($location_logo) ){
			$location_logoalt = $location_logo['alt'];
			$location_logourl = $location_logo['url'];
		}else{
			$location_logoalt = 'No Image';
			$location_logourl = get_template_directory_uri().'/images/no-image-home.png';
		}
		
		$thumbImages='';
		$fullImages='';
		
		if($is_featured_location[0]!=''){
		$k = 0;
		foreach($featured_images as $mainImage){
			$fullImages  .=	'<li><img src="'.$mainImage['full'].'" alt="Location" width="646" height="367"></li>';
			
			$thumbImages .=	'<a href="javascript:void(0)" data-slide-index="'.$k++.'"><img src="'.$mainImage['thumb'].'" alt="Location" width="98" height="66"></a>';
			$i++;
		}		
		$j++;	
		$string .='
		<section class="zurUbersicht locationMap">
		<div class="row">
		<div class="zurUbersichtContent">
			<div class="zurUbersichtSlider">
				<div class="thumbsScrollSlider featuredSlider">
				<img src="'.$location_logourl.'" width="111" height="111" alt="'.$location_logoalt.'" class="imgTag" />
						<ul id="bxslidermain'.$i.'" class="bxsliderfeatured innerSlider cf" data-indexnr="'.$i.'">
							'.$fullImages.'
						</ul>
						<div id="bxpagerfeatured'.$i.'" class="bx-pager bxpagerfeatured cf" data-idattribute="'.$i.'">
								'.$thumbImages.'
						</div>
				</div>
			</div>
			<div class="asidebar">
				<div class="gutscheinBestellen">
					<div id="gmap1" class="gmap smallMap">'.$venuemap.'</div>
						<div class="bestellenBlock">
							<h3 id="title'.$venue_id.'">'.$title.'</h3>
							<span class="h3SubTitle">'.$address.'</span>
							'.get_the_content().'
						</div>
						<div class="btns"> <button class="btn" id="myBtn'.$venue_id.'" onclick="getPopup('.$venue_id.')">Unverbindlich anfragen</button> </div>
					</div>
				</div>
			</div>
		</div>
		</section>';
		
		}
		
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

/* Location for kontakt page */
add_shortcode( 'kontakt_locations', 'kontakt_locations_display' );
function kontakt_locations_display(){
	
	global $lat;
	global $lbg;
	
	$argsclint = array('post_type'=>'tribe_venue');
	$string='';
	
	$featuredLocationsData = new WP_Query($argsclint);
	
	if( $featuredLocationsData->have_posts() ) {
	  while( $featuredLocationsData->have_posts()) : $featuredLocationsData->the_post();
		
		$venuemap = tribe_get_embedded_map(get_the_ID());
		if ( empty( $venuemap ) ) {
			return;
		}
		$location_bild=get_field('bild_kontakt',get_the_ID());
		$location_logo=get_field('location_logo',get_the_ID());		 
		$address = tribe_get_address(get_the_ID()) . ', ' . tribe_get_zip(get_the_ID()) .' '. tribe_get_city(get_the_ID());
		$is_featured_location = get_field('featured_location',get_the_ID());	 
		$title = get_the_title();
		if( !empty($location_bild) ){
			$location_bildalt = $location_bild['alt'];
			$location_bildurl = $location_bild['url'];
		}else{
			$location_bildalt = 'No Image';
			$location_bildurl = get_template_directory_uri().'/images/no-image-kontakt.png';
		}
		if( !empty($location_logo) ){
			$location_logoalt = $location_logo['alt'];
			$location_logourl = $location_logo['url'];
		}else{
			$location_logoalt = 'No Image';
			$location_logourl = get_template_directory_uri().'/images/no-image-kontakt.png';
		}
		$thumbImages='';
		$fullImages='';
		
		if($is_featured_location[0]!=''){
			$string .='
			<section class="anfahrtZumMain">
				<div class="row">
					<div class="anfahrtZumLoft">
						<h2 style="background:url('.$location_logourl.') top left / contain no-repeat;">Anfahrt: '.$title.'</h2>
						<div class="anfahrtZumContent cf">
							<div class="anfahrtZumBanner">
								<img src="'.$location_bildurl.'" alt="'.$location_bildalt.'" width="334" height="334" />
							</div>
							<div class="rightContent loftMap">'.$venuemap.'</div>
						</div>
						<div class="anfahrtZumAddress">'.$address.'</div>
					</div>
				</div>
			</section>';
		
		}
		
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