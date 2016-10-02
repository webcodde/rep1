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
$ticket_ids = array();

if( class_exists('Dynamic_Featured_Image') ) {
    global $dynamic_featured_image;
	global $fullImage;
	global $thumbImage;
    $featured_images = $dynamic_featured_image->get_featured_images( $event_id );
 }

 $bannerTitel = tribe_get_custom_field('Bannertitel');
 $unterTitel = tribe_get_custom_field('Untertitel');
 ?>
<div class="zurUbersicht-banner bannerHight">
<?php if(!empty($bannerTitel) || !empty($unterTitel)){ ?>
	<h1><?php echo $customFields['Bannertitel'] ?><span><?php echo $customFields['Untertitel'] ?></span></h1>
<?php } ?>
</div>
<div id="tribe-events-pg-template">
<section class="zurUbersicht">
	<div class="row">
		<div class="zurUbersichtlink"><a href="<?php echo get_site_url();?>/kurse">« Zur Übersicht</a></div>
		<div class="zurUbersichtContent">
			<div class="zurUbersichtSlider">
				<div id="thumbsScrollSlider1" class="thumbsScrollSlider">
					<ul id="bxslider1" class="bxslider innerSlider">
						<?php $i=0;
						foreach ($featured_images as $fullImage){?>
						<li><a href="<?php echo $fullImage['full']?>" title="Image <?php echo $i?>" rel="group-1" class="litebox"><img src="<?php echo $fullImage['full']?>" alt="Location" width="646" height="378"></a>
						<div class="bannerOffer"><span class="offerPrice"><?php echo $customFields['Preis'] ?>€</span><span class="conditionApply">Pro Person<hr><?php echo $customFields['Maximum Participant']?> Teiln.</span></div>
						</li>
						<?php $i++;
						}?>
					</ul>
					<div id="bx-pager1" class="bx-pager" itemprop="event-images">
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
						<div class="loftTitle" itemprop="venue"><?php echo tribe_get_venue(); ?></div>
						<div class="terminPersonen cf">
							<div class="terminMain termHeader"> 
								<div class="terminDate"><span>Termin:</span></div>
								<div class="personenNumber">
									<div class="inputField"><span>Personen:</span></div>
								</div>
							</div>
							<?php tribe_get_template_part( 'wootickets/tickets'); ?>
						</div>
						<input type="hidden" name="addon-740-gutschein-option-0" value="mit-rotwein-als-weinlabel-1"/>
						<div class="gutscheinBtn">
							<div class="btns"><a class="btn" href="#" itemprop="url">Gutschein einlösen</a></div>
						</div>
					</div>
				</div>
				<div class="menuMain">
					<div class="menuTitle" itemprop="menu">MENÜ</div>
					<?php the_field('menu_sidebar'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
	echo '<div class="tribe-events-meta-group tribe-events-meta-group-gmap">';
	tribe_get_template_part( 'modules/meta/map' );
	echo '</div>';

?>

</div>
