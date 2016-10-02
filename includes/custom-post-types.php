<?php defined('ABSPATH') or die();

// admin post types
add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'premium_locations',
    array(
      'labels' => array(
        'name' => __( 'Premium Locations' ),
        'singular_name' => __( 'premium_locations' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports'	=>	array('title', 'editor','thumbnail'),
      'rewrite' => array('slug' => 'premium_locations'),
    )
  );

  register_post_type( 'banner_home',
    array(
      'labels' => array(
        'name' => __( 'Home Slider' ),
        'singular_name' => __( 'banner_home' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'banner_home'),
    )
  );
  
  register_post_type( 'ribbon_home',
    array(
      'labels' => array(
        'name' => __( 'Home Slider Ribbon' ),
        'singular_name' => __( 'ribbon_home' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'ribbon_home'),
    )
  );
  
  register_post_type( 'tour_sec_home',
    array(
      'labels' => array(
        'name' => __( 'Home Tour Section' ),
        'singular_name' => __( 'tour_sec_home' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'tour_sec_home'),
    )
  );
  
  register_post_type( 'footer_content',
    array(
      'labels' => array(
        'name' => __( 'Footer Content' ),
        'singular_name' => __( 'footer_content' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'footer_content'),
    )
  );
  
  register_post_type( 'banner_gutscheine',
    array(
      'labels' => array(
        'name' => __( 'Gutscheine Slider' ),
        'singular_name' => __( 'banner_gutscheine' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports'	=>	array('title', 'editor','thumbnail'),
      'rewrite' => array('slug' => 'banner_gutscheine'),
    )
  );

  register_post_type( 'banner_kurse',
    array(
      'labels' => array(
        'name' => __( 'Kurse Slider' ),
        'singular_name' => __( 'banner_kurse' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports'	=>	array('title', 'editor','thumbnail'),
      'rewrite' => array('slug' => 'banner_kurse'),
    )
  );
  
}


?>