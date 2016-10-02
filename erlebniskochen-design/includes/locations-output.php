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
?>