<?php defined('ABSPATH') or die();

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
		$ribbonUrl = get_field('ribbon_link', get_the_ID());
		$ribbonTextColor = get_field('ribbon_text_color', get_the_ID());
		$ribbonStart = get_field('ribbon_start', get_the_ID());
		$ribbonEnd = get_field('ribbon_end', get_the_ID());
		$string.='<a href="'.$ribbonUrl.'" title="Erfahren Sie alles zum Event"><span style="color:'.$ribbonTextColor.'"><span>'.$ribbonTitle.'</span>'.$ribbonText.'</span></a>';
		
		
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

?>