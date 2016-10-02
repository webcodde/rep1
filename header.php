<?php
defined('ABSPATH') or die();
/**
 * Default Page Header
 *
 * @author Saskia Lund | SL IT&WEBDESIGN (mail@saskialund.de)
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<!-- Start Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php wp_title(); ?> </title>
<!-- Start Favicon -->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/images/favicon.ico">


<!--
<script type='text/javascript' src='<?php // echo plugins_url('/contact-form/includes/js/jquery.form.min.js'); ?>'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/ek.saskialund.de\/wp-content\/plugins\/contact-form\/images\/ajax-loader.gif","sending":"Sending ..."};
/* ]]> */
</script>
<script type='text/javascript' src='<?php // echo plugins_url('/contact-form/includes/js/scripts.js'); ?>'></script> -->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Start Header -->
<div class="topbarWrapper">
	<div class="logodummydiv"></div>
	<div class="topbar">
        <div class="callUs">
            <span class="hamburg">Hamburg</span> <span class="phNo">(040) 702 92 64 20</span>
        </div>
        <?php wp_nav_menu( array( 
                'theme_location' => 'top', 
                'menu_class' => 'topMenu',
                'container' => '',
                'link_before' => '<span onclick="void(0)" onfocus="void(0)">',
                'link_after' => '</span>'
                 ) ); ?>
        
			<?php 
			 function erlebniskochen_get_cart_button_html() {
			  $btn_cart = '';

			  if (class_exists('Woocommerce')) { 
				global $woocommerce;
					$btn_cart = '
					  <a class="topbarWarenkorb" href="'.get_permalink( woocommerce_get_page_id( 'cart' ) ).'" title="Warenkorb ansehen">
						<span class="shoppingCart cart"><i class="artikelzahl">'.$woocommerce->cart->cart_contents_count.'</i>&nbsp;<i class="hide800">Warenkorb</i></span>
					  </a>
					';
			  } 
			  echo $btn_cart;
			}
			echo erlebniskochen_get_cart_button_html(); 
			?>
	</div>
</div> <!-- /.topbarWrapper -->
<header id="header">
    <h1 id="logo">
        <a href="<?php echo get_site_url();?>" title="Erlebniskochen - Events mit Geschmack">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/erlebniskochen-logo.png" alt="Erlebniskochen - Events mit Geschmack" width="267" height="59">
        </a>
    </h1>
    <div class="menubar">
        <!-- Start Navigation -->
        <nav id="mainNav">
            <div class="menuPart">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'nav', 'link_before' => '<span onclick="void(0)" onfocus="void(0)">',
                'link_after' => '</span>' ) ); ?>
            </div>
        </nav>
        <!-- End Navigation -->

    </div>
</header>
<!-- End Header -->
<?php 
if(is_front_page()){
	get_template_part('banner-home');
} else if(is_page('aktuelle-kochkurse') || is_page('kurse')){?>
	<style>
	.tribe-events-event-image .attachment-full{width:646px; height:171px}
	</style><?php
} else if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() || tribe_is_venue()) { ?>
	<div class="zurUbersicht-banner bannerHight">
	<?php the_title( '<h1>', '</h1>' ); ?>
	</div> 
	<section class="zurUbersicht">
		<div class="row">
<?php } else if (is_page_template('page-default.php')) { ?>
	<div class="zurUbersicht-banner bannerHight">
	<?php the_title( '<h1>', '</h1>' ); ?>
	</div> 
	<section class="zurUbersicht">
	<div class="row">
		<div class="pageContent">

	<?php } else if(is_404()) { ?>
<div class="zurUbersicht-banner bannerHight"><h1>404 Fehler</h1></div>
<section class="kochkurseContent error-404 not-found"><div class="row">


	<?php } else { ?>
	<style>
	.tribe-events-event-image .attachment-thumbnail {width:66px; height:50px}
	.tribe-events-event-image .attachment-full{width:646px; height:378px}
	</style>
	<?php  } 


