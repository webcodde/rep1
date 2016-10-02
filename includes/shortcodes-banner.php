<?php defined('ABSPATH') or die();

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

?>