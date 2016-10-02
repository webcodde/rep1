<?php defined('ABSPATH') or die();

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
		$string.='<a href="/kontakt/" class="contactBtn">Kontaktformular</a>';
		
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