/<?php
/**
 * Renders the WooCommerce tickets table/form
 *
 * @version 4.2
 *
 * @var bool $global_stock_enabled
 * @var bool $must_login
 */
global $woocommerce;

$is_there_any_product         = false;
$is_there_any_product_to_sell = false;
$main = Tribe__Tickets_Plus__Commerce__WooCommerce__Main::get_instance();

$post_id = get_the_ID();

if(wp_get_post_parent_id($post_id)!=0){
	$event_id = wp_get_post_parent_id($post_id);
} else {
	$event_id = $post_id;
}
$tickets = $main->get_tickets( $event_id ); 
ob_start();

//print_r($tickets);exit;
?>
<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ) ?>" class="" method="post" enctype='multipart/form-data'>
<?php
	foreach ( $tickets as $ticket ) {
		/**
		 * @var Tribe__Tickets__Ticket_Object $ticket
		 * @var WC_Product $product
		 */
		global $product;
		
		$ticket_ids[] = $ticket->ID;
		
		if ( class_exists( 'WC_Product_Simple' ) ) {
			$product = new WC_Product_Simple( $ticket->ID );
		} else {
			$product = new WC_Product( $ticket->ID );
		}
		
		if ( $ticket->date_in_range( current_time( 'timestamp' ) ) ) {
		
			$is_there_any_product = true;
			$data_product_id = 'data-product-id="' . esc_attr( $ticket->ID ) . '"';

			echo sprintf( '<input type="hidden" name="product_id[]" value="%d">', esc_attr( $ticket->ID ) );
			
			$remaining = $ticket->remaining();
			
			echo '<div class="terminMain">'; 
				
				echo '<div class="terminDate">'.$ticket->name;
				if ( $product->is_in_stock() ) {
					
					// Max quantity will be left open if backorders allowed, restricted to 1 if the product is
					// constrained to be sold individually or else set to the available stock quantity
					$max_quantity = $product->backorders_allowed() ? '' : $product->get_stock_quantity();
					$max_quantity = $product->is_sold_individually() ? 1 : $max_quantity;
					$original_stock = $ticket->original_stock();

					// For global stock enabled tickets with a cap, use the cap as the max quantity
					if ( $global_stock_enabled && Tribe__Tickets__Global_Stock::CAPPED_STOCK_MODE === $ticket->global_stock_mode()) {
						$max_quantity = $ticket->global_stock_cap();
						$original_stock = $ticket->global_stock_cap();
					}
					
					echo '<p><b>(Noch '.$remaining.' Plätze frei)</b></p></div>';
				
					echo '<div class="personenNumber" '.$data_product_id.'>
						<div class="inputField">
							<input type="button" value="-" class="qtyminus" field="quantity_'.$ticket->ID.'" />
							<input type="text" id="quantity_'.$ticket->ID.'" name="quantity_'.$ticket->ID.'" value="0" class="qty" />
							<input type="button" value="+" class="qtyplus" field="quantity_'.$ticket->ID.'" />
							<input type="hidden" name="stock" value="'.$remaining.'" field="stock">
							<input type="hidden" name="addon-'.$ticket->ID.'-gutschein-option-0" value="" class="gutscheinoption"/>
						</div>
					</div>';
					
				
				$is_there_any_product_to_sell = true;
				do_action( 'wootickets_tickets_after_quantity_input', $ticket, $product );
			
			}else {
				echo '<p><b>(Ausgebucht)</b></p></div>';
				echo '<div class="personenNumber">&nbsp;</div>';
			}
			
			echo '</div>';
		}
			
	}
	
	?>

			<div class="buchenBtn">
				<div class="btns woocommerce add-to-cart"> 
					
					<?php if ( $must_login ): ?>
							<?php include Tribe__Tickets_Plus__Main::instance()->get_template_hierarchy( 'login-to-purchase' ); ?>
					<?php else: ?>
							<button type="submit" name="wootickets_process" value="1"
							class="btn" id="buchen-wootickets"><?php esc_html_e( 'Buchen', 'event-tickets-plus' );?></button>
					<?php endif; ?>	
				</div>
            </div>
			<div class="gutscheinbestellung">
			<div class="btns">
					<a class="btn" href="javascript:void(0)" id="gutscheinbestellung" itemprop="url">Buchen mit Gutscheinbestellung</a>
				</div>
			</div>
			<?php 
			//$product_ids = implode( ',', array( 852, 853 ) );
			//$quantity = implode( ',', array( 2, 6 ) );
			//echo $url = esc_url_raw( add_query_arg( array('add-to-cart' => $product_ids,'quantity' => $quantity),  wc_get_checkout_url() ) );?>
</form>		
<?php 

$content = ob_get_clean();
//print_r($ticket_ids); die;

if ( $is_there_any_product ) {
	echo $content;
} else {
	// if there isn't an unavailability message, bail
	if ( ! $unavailability_message ) {
		return;
	}

	?>
	<div class="tickets-unavailable">
		<?php echo esc_html( $unavailability_message ); ?>
	</div>
	<?php 
}?>

<script type="text/javascript">
jQuery('#gutscheinbestellung').click(function(e) {
//		e.preventDefault(); 
//		var myStringArray = <?php echo json_encode($ticket_ids)?>;
//		var arrayLength = myStringArray.length;
//		for (var i = 0; i < arrayLength; i++) {
//			var quantity = $('#quantity_'+myStringArray[i]).val();	
//			alert("Ticket added");
//			addToCart(myStringArray[i],quantity);
//		}
//		return true;
		//window.location.href = "/cart";
		$( ".gutscheinoption" ).each(function() {
  			$( this ).val( "schone-klappkarte-per-post-1" );
		});
		$('#buchen-wootickets').click();
    });

    function addToCart(p_id,qu) {
        $.get('?add-to-cart=' + p_id +'&quantity='+qu + '&addon-740-gutschein-option-0=mit-rotwein-als-weinlabel-1', function() {
		return;
	 });
//	$.post( "", { 'add-to-cart': p_id, quantity: qu, 'addon-740-gutschein-option-0': "mit-rotwein-als-weinlabel-1" } );
	return;
    }

$(document).ready(function(){	

	$( ".gutscheinoption" ).each(function() {
                   $( this ).val( "" );
        });

	if($('.personenNumber').length){
		$('.personenNumber').each(function(i){
			$(this).attr('id', 'personenNumber'+i);
			$(this).find('.qtyplus').attr('id', 'qtyplus'+i);
			$(this).find('.qtyminus').attr('id', 'qtyminus'+i);

			$('#qtyplus'+i).click(function(e){		        
				e.preventDefault();

				var fieldName = $(this).attr('field');
					field = $(this).parent().find('input[name='+fieldName+']');
					stock = $(this).parent().find('input[name=stock]');
							   
				var currentVal = parseInt($(field).val());		        
				var stockVal = parseInt($(stock).val());
				
				if(!isNaN(currentVal) && currentVal<stockVal) {		            
					field.val(currentVal + 1);
				} 
			});

			$('#qtyminus'+i).click(function(e) {
				// Stop acting like a button
				e.preventDefault();

				var fieldName = $(this).attr('field');
					field = $(this).parent().find('input[name='+fieldName+']');
				
				var currentVal = parseInt($(field).val());		        
				if(!isNaN(currentVal) && currentVal > 0) {		           
					field.val(currentVal - 1);
				} else {		           
				   field.val(0);
				}
			});
		});		
	}
 });
 </script>	





