<?php
require_once 'tgm/class-tgm-plugin-activation.php';
require_once ( get_template_directory() .'/includes/required-plugins-check.php');
add_action( 'tgmpa_register', 'slit_register_required_plugins' );


/**
 * Setup Theme Functions
 * SLIT
 */
if (!function_exists('erlebniskochen_theme_setup')):

    function erlebniskochen_theme_setup() {

        load_theme_textdomain('slit', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support( 'menus' );
		    add_theme_support( 'woocommerce' );
        add_theme_support('post-formats', array('aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio', 'chat'));

    		register_nav_menus( array(
    		  'primary' => __( 'Primary Menu','slit' ),
    		  'top' => __( 'Top Menu','slit' ),
          'footer' => __('Footer Menu','slit'),
    		 ) );

        require_once ( get_template_directory() .'/includes/custom-post-types.php');
        require_once ( get_template_directory() .'/includes/locations-output.php');
        require_once ( get_template_directory() .'/includes/shortcodes-banner.php');
        require_once ( get_template_directory() .'/includes/shortcodes-home.php');
        require_once ( get_template_directory() .'/includes/footer-section.php');
        require_once ( get_template_directory() .'/includes/shortcodes-kurse-eventlisting.php');
        require_once ( get_template_directory() .'/includes/shortcodes-locations.php');
        require_once ( get_template_directory() .'/includes/shortcodes-franchisergallery.php');
        // add_image_size( 'berichte-thumb', 660 ); // 660 pixels wide (and unlimited height)
        add_image_size( 'kochthumb', 155, 237, true ); // (softcrop)
        add_image_size( 'eventslider', 676, 378 );
        add_image_size( 'kursefeatured', 365, 164, true );
        // add_image_size( 'homepage-recent-lg-thumb', 425, 261 ); // (softcrop)
    }

endif;
add_action('after_setup_theme', 'erlebniskochen_theme_setup');

/**
 * Load CSS styles and scripts for theme.
 *
 */
function erlebniskochen_scripts_loader() {
      // Theme stylesheets
      wp_enqueue_style( 'erlebniskochen-style', get_stylesheet_uri() );
      wp_enqueue_style('erlebniskochen-responsive', get_template_directory_uri() . '/css/responsive.css');
      wp_enqueue_style('erlebniskochen-animate', get_template_directory_uri() . '/css/animate.css');

     /**
       * Load jQuery latest for theme from Google repository and avoid conflicts.
       *
       */
   if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
      function my_jquery_enqueue() {
         wp_deregister_script('jquery');
         wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://code.jquery.com/jquery-1.12.4.min.js", false, null);
         wp_enqueue_script('jquery'); 
    } 
      wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), false, false );


      // Theme js

      // IE9
      wp_enqueue_script( 'erlebniskochen-ie', get_template_directory_uri() . '/js/ie.js');
      wp_script_add_data( 'erlebniskochen-ie', 'conditional', 'lte IE 9' );
      
      wp_enqueue_script( 'erlebniskochen-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), null , true );
      wp_enqueue_script( 'erlebniskochen-general', get_template_directory_uri() . '/js/general.js', array( 'jquery','erlebniskochen-functions' ), null, true );
      wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smooth-scroll.js', array( 'jquery' ), null, true );
}
add_action('wp_enqueue_scripts', 'erlebniskochen_scripts_loader');

add_action('admin_init', function() {
  global $wp_filter, $yoast_woo_seo;

  if (!empty($wp_filter['admin_notices'][10])) {
    foreach ($wp_filter['admin_notices'][10] as $hook_key => $hook) {
      if (is_array($hook['function']) && $hook['function'][0] instanceof \Yoast_Plugin_License_Manager && $hook['function'][1] == 'display_admin_notices') {
        unset($wp_filter['admin_notices'][10][$hook_key]);
      }
    }
  }
});

/**
 * Trim zeros in price decimals
 **/
 add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

add_filter( 'show_admin_bar', '__return_false' );

// Smooth scroll in submenus
 add_filter( 'nav_menu_link_attributes', 'my_nav_menu_attribs', 10, 3 );
function my_nav_menu_attribs( $atts, $item, $args )
{
  if ($item->ID == 378) {
    $atts['id'] = 'kuche';
  }
  if ($item->ID == 379) {
    $atts['id'] = 'organisation';
  }
  return $atts;
}

// Change button text woocommerce
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
 
function woo_archive_custom_cart_button_text() {
 
        return __( 'Buchen', 'woocommerce' );
 
}

remove_action( 'phpmailer_init', 'wpcf7_phpmailer_init' );

//Shortcode API images
function myImageLink(){
	return get_template_directory_uri();
}
add_shortcode('imagePath', 'myImageLink');
// end shortcode image

// Ensure cart contents update when products are added to the cart via AJAX 
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
    if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
      function woocommerce_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
          <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart-contents" title="Warenkorb ansehen">
          <div class="cart_image"></div>
          <span class="num_of_product_cart"><?php global $woocommerce;
           echo sprintf(_n('%d ', '%d ', $woocommerce->cart->cart_contents_count, 'twentyfifteen'), $woocommerce->cart->cart_contents_count); ?></span>
        </a>
        <?php
        $fragments['a.cart-contents'] = ob_get_clean();
        return $fragments;
      }
    }

// Get event data in cart using product id
function get_tribe_event_ID_from_product($product_id) {
    if ( class_exists( 'Tribe__Tickets_Plus__Commerce__WooCommerce__Main' )) {
        $my_tribe = new Tribe__Tickets_Plus__Commerce__WooCommerce__Main();
        $my_event_id = get_post_meta($product_id, $my_tribe->event_key, true);
        return $my_event_id;
    }
}

// Disable thumbnails in cart & checkout
add_filter( 'woocommerce_cart_item_thumbnail', '__return_false' );

add_filter( 'woocommerce_cart_item_name', 'woocommerce_cart_item_name_event_title', 10, 3 );
function woocommerce_cart_item_name_event_title( $title, $values, $cart_item_key ) {
	$ticket_meta = get_post_meta( $values['product_id'] );
	$event_id = absint( $ticket_meta['_tribe_wooticket_for_event'][0] );
	if ( $event_id ) {
		$title = sprintf( '%s <br><a href="%s" target="_blank"><strong>%s</strong></a>', $title, get_permalink( $event_id ), get_the_title( $event_id ) );
	}
	return $title;
}

wpcf7_add_shortcode('postdropdown', 'getvenuedropdown');
function getvenuedropdown(){ 
	$venues = tribe_get_venues();
	$result = '<select name="location" id="exampleSelect" class="customSelect">';
	foreach($venues as $venue){ 
		$result .= '<option value="'.$venue->post_title.'">'.$venue->post_title.'</option>';
	}
	$result .= '</select>';
	return $result;	
}


