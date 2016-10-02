<?php if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ) { ?>
    </div> <!-- /div.row -->
</section> <!-- /section.zurUbersicht --> 
<?php } ?>
<?php if(!is_front_page()){ ?>
    <div class="dividerline"></div>
 <?php } 
 if(is_page('locations')){?>
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">x</span>
    <h3 class="venuePopupTitle" id="eventTitle"></h3>
	<p>
		<?php echo do_shortcode('[contact-form-7 id="805" title="contact_locations"]');?>
	</p>
  </div>
</div>
<div id="thanksMessage" class="modal">
  <div class="modal-content">
    <span class="close" id="close">x</span>
	<p><h3>Ihre Anfrage wurde gesendet.<br>Vielen Dank.</h3></p>
  </div>
</div>
 <?php } ?>  
 
<footer id="footer">
    <div class="row">
        <div class="footerLeft">
            <h2>Erlebniskochen<br> in Hamburg</h2>
            <img src="<?php echo get_template_directory_uri();?>/images/erlebniskochen-signature.png" alt="Erlebniskochen in Hamburg Image" width="377" height="274">
            <p>&copy; 2016 by MD.Verlag | Erlebniskochen &amp; Weinschmecken</p>
                <?php wp_nav_menu( array( 
                'theme_location' => 'footer', 
                'menu_class' => 'footerLinks',
                'container' => '',
                'link_before' => '',
                'link_after' => ''
                 ) ); ?>
        </div>
        <div class="footerRight">
            
			<?php echo do_shortcode('[footer_content]');?>
			
            <h3>FRANCHISE</h3>
            <p>Werden Sie Geschmacksunternehmer und machen Sie mit der Erlebniskochen-Philosophie, die Welt zu einem leckereren Ort: <br><a href="mailto:franchise@erlebniskochen.de" class="emailId">franchise@erlebniskochen.de</a></p>
        </div>
    </div>
</footer>

<a href="#top" title="Back to Top" id="backtotop">Back to Top</a>
<!-- Start Script -->
<?php wp_footer(); ?>
<script>
smoothScroll.init();

// Get the modal
function getPopup(venue_id){
	var modal = document.getElementById('myModal');
	var btn = document.getElementById("myBtn"+venue_id);
	var venue = document.getElementById("title"+venue_id).innerHTML;
	document.getElementById("eventTitle").innerHTML = "Anfrage für "+venue+"";
	var span = document.getElementsByClassName("close")[0];
	modal.style.display = "block";
	document.getElementById("venuename").value = ""+venue+"";
	document.getElementById("venuename").readOnly = true;
	span.onclick = function() {
		modal.style.display = "none";
	}
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
}
function sentPopup(){
	document.getElementById('myModal').style.display ="none";
	var modal = document.getElementById('thanksMessage');
	var span = document.getElementById("close");
	modal.style.display = "block";
	span.onclick = function() {
		modal.style.display = "none";
	}
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
}
	
</script>

</body>
</html>
