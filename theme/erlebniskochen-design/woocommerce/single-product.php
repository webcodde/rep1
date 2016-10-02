<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
		
get_header('shop');

// Custom code to override template		
global $product;
$product_id = get_the_ID();
		
	?>
<?php while ( have_posts() ) : the_post(); 

$attachment_ids = $product->get_gallery_attachment_ids();
?>
    <div class="zurUbersichtlink"><a href="/kurse/">« Zur Übersicht</a></div>
    <div class="zurUbersichtContent">
      <div class="zurUbersichtSlider">
        <div id="thumbsScrollSlider1" class="thumbsScrollSlider">
          <ul id="bxslider1" class="bxslider innerSlider">
				<?php $i=0;
				foreach ($attachment_ids as $fullImage){?>
				<li><a href="<?php echo wp_get_attachment_url($fullImage)?>" itemprop="url" title="Image <?php echo $i?>" rel="group-1" class="litebox"><img src="<?php echo wp_get_attachment_url($fullImage)?>" alt="Location" width="646" height="378"></a>
				<div class="bannerOffer"><span class="offerPrice single"><?php echo esc_attr( $product->get_display_price() ).''.esc_attr( get_woocommerce_currency_symbol() ) ?></span></div>
				</li>
				<?php $i++;
				}?>
			</ul>
          <div id="bx-pager1" class="bx-pager" itemprop="event-images">
				<ul>
					<?php $j=0;
					foreach ($attachment_ids as $thumbImage){?>
					<li><a href="javascript:void(0);" itemprop="url" onClick="clicked1(<?php echo $j?>);"><img src="<?php echo wp_get_attachment_url($thumbImage)?>" alt="Location" width="98" height="66"></a></li>
					<?php $j++;
					}?>
				</ul>
			</div>
        </div>
        <div class="gutscheinOhne">
          <div class="Ohnequotes">
            <h2><?php echo the_title();?></h2>
          </div>
          <p><?php echo get_the_content();?></p>
        </div>
      </div>
      <div class="asidebar">
        <div class="gutscheinBestellen"> 
		<?php 
		//echo wp_get_attachment_url(706);
		//echo woocommerce_get_product_thumbnail();
		if ( has_post_thumbnail() ) {
			$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
            echo '<img src="'.$feat_image_url.'" alt="Geschenkgutschein" width="1440" height="267">';
        }
		?>	
		
          <div class="bestellenBlock">
            <div class="bestellenTitle"><span>Geschenkgutschein</span> Thema, Termin und<br>
              Location nach Wahl</div>
            <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
			<form class="cart" method="post" enctype='multipart/form-data'>
				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() ) {
	 			woocommerce_quantity_input( array(
	 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
	 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
	 			) );
	 		}?>
				<div class="btns cf"> 
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
					<button type="submit" class="single_add_to_cart_button button btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
				</div>
				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			</form>
		  </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; // end of the loop. ?>	

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		
	?>

<?php get_footer( 'shop' ); ?>
