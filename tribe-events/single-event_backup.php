<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.2.4
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();
$event_id = get_the_ID();
$customFields = tribe_get_custom_fields($event_id);
$eventTitle = get_the_title();

// Fetch ticket information

$ticketInfo="";
$ticketPrice="";
$productID = array();

/*
foreach($tickets as $myticket){
	$ticketPrice = $myticket->price;
	$product = new WC_Product( $myticket->ID );
	$ticketRemainingStock = $product->get_stock_quantity(); 
	$productID[] = $myticket->ID;
	
	$ticketInfo.="<div class='terminMain'> 
		<div class='terminDate'>
			".$myticket->name;
		if($ticketRemainingStock>0){
			$ticketInfo.="<p><b>Noch ".$ticketRemainingStock." Plätze frei</b></p>";
		}else{
			$ticketInfo.="<p><b>Ausgebucht</b></p>";
		}		
	$ticketInfo.="</div>
		<div class='personenNumber'>";
	
	if($ticketRemainingStock>0){
	$ticketInfo.="
			<div class='inputField'>
				<input type='button' value='-' class='qtyminus' field='quantity' />
				<input type='text' name='quantity' value='0' class='qty' readonly />
				<input type='button' value='+' class='qtyplus' field='quantity' />
				<input type='hidden' name='stock' value='".$ticketRemainingStock."' field='stock'>
			</div>";
	}else{
	$ticketInfo.="<p style='color:red; text-align:right'><b>Ausgebucht</b></p>";	
	}		
	$ticketInfo.="</div>
	</div>";
}*/

if( class_exists('Dynamic_Featured_Image') ) {
    global $dynamic_featured_image;
	global $fullImage;
	global $thumbImage;
    $featured_images = $dynamic_featured_image->get_featured_images( $event_id );
 }
 ?>
<div class="zurUbersicht-banner bannerHight">
	<h1>Kursname Grillkurs im HAUS am Kiekeberg</h1>
</div>
<section class="zurUbersicht">
	<div class="row">
		<div class="zurUbersichtlink"><a href="<?php echo get_site_url();?>/kurse">« Zur Übersicht</a></div>
		<div class="zurUbersichtContent">
			<div class="zurUbersichtSlider">
				<div id="thumbsScrollSlider1" class="thumbsScrollSlider">
					<ul id="bxslider1" class="bxslider innerSlider">
						<?php $i=0;
						foreach ($featured_images as $fullImage){?>
						<li><a href="<?php echo $fullImage['full']?>" title="Image <?php echo $i?>" rel="group-1" class="litebox"><img src="<?php echo $fullImage['full']?>" alt="Location" width="646" height="367"></a>
						<div class="bannerOffer"><span class="offerPrice"><?php echo $ticketPrice?>€</span> <span class="conditionApply">pro Person max.<?php echo $customFields['Maximum Participant']?> Teiln.</span></div>
						</li>
						<?php $i++;
						}?>
					</ul>
					<div id="bx-pager1" class="bx-pager">
						<ul>
							<?php $j=0;
							foreach ($featured_images as $thumbImage){?>
							<li><a href="javascript:void(0);" onClick="clicked1(<?php echo $j?>);"><img src="<?php echo $thumbImage['thumb']?>" alt="Location" width="98" height="66"></a></li>
							<?php $j++;
							}?>
						</ul>
					</div>
				</div>
				<div class="gutscheinOhne">
					<div class="Ohnequotes">
						<h2><?php echo $eventTitle;?></h2>
					</div>		
					<?php 
					while ( have_posts() ) :  the_post();
						the_content(); 
					endwhile;?>
				</div>
			</div>
			<div class="asidebar">
				<div class="gutscheinBestellen">
					<div class="gutscheinStaff cf">
						<?php tribe_get_template_part( 'modules/meta/organizer'); ?>
					</div>
					<div class="erlebniskochenLoft">
						<div class="loftTitle">Erlebniskochen LOFT</div>
						<div class="terminPersonen cf">
							<div class="terminMain termHeader"> 
								<div class="terminDate"><span>Termin:</span></div>
								<div class="personenNumber">
									<div class="inputField"><span>Personen:</span></div>
								</div>
							</div>
							<?php tribe_get_template_part( 'wootickets/tickets'); ?>
						</div>
						<div class="gutscheinbestellung">
							<div class="btns"><a class="btn" href="#">Buchen mit Gutscheinbestellung</a></div>
						</div>
						<div class="gutscheinBtn">
							<div class="btns"><a class="btn" href="#">Gutschein einlösen</a></div>
						</div>
					</div>
				</div>
				<div class="menuMain">
					<div class="menuTitle">MENÜ</div>
					<?php echo $customFields['Menu']?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
$venueMapArray = tribe_get_coordinates($event_id);
$lat = $venueMapArray['lat'];
$lng = $venueMapArray['lng'];
$venueAddress = tribe_get_address($event_id);
?>
<section class="bigMap">
	<div class="row">
		<div class="gmap"></div>
		<span class="mapAdd"><?php echo $venueAddress?></span>
	</div>
</section>

<script type="text/javascript">
	
	var slider1;
	var carousel1;
	
	$(document).ready(function(){					
		
		if($('.bigMap').length){

		function initialize(){
			var lang = <?php echo $lat?>;
			var lati = <?php echo $lng?>;
			var contentString = '<strong>Erlebniskochen Events Location:</strong> <?php echo $venueAddress?>';
			
			var mapOptions = {
				zoom: 15
				,center: new google.maps.LatLng(lang , lati)
				,mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			var mapClass = $('.gmap');
			var map = new google.maps.Map(mapClass[0],mapOptions);			
			
		    var infowindow = new google.maps.InfoWindow({
		        content: contentString
		    });
			google.maps.event.addListener(map, 'click', function(){
			  infowindow.close();
			});
			var marker = new google.maps.Marker({
			  map: map,
			  position: new google.maps.LatLng(lang , lati)
			});
			google.maps.event.addListener(marker, 'click', function(){
		        infowindow.open(map,marker);
		    });
		    google.maps.event.addListenerOnce(map, 'idle', function(){
			    google.maps.event.trigger(marker, 'click');
			});

			infowindow.open(map,marker);
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		}	
	   
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


