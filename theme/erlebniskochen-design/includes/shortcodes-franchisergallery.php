<?php defined('ABSPATH') or die();

/* Galerie Kontakt */
add_shortcode( 'franchiser_galerie', 'franchiser_galerie_display' );
function franchiser_galerie_display(){
	$string="";
	 $string.= '<section class="erlebniskochenList">
  <div class="row">
    <div class="kochenListMain">
      <div class="erlebniskochenContent kontaktC">
        <h3 class="ekganzd">Hier finden<br> Sie uns<br> außerdem<br> …</h3>
      </div>
      <div class="erlebniskochenImg">
        <div class="teamGroupList">
          <ul>
            <li><a href="#"> <img width="211" height="184" alt="Erlebniskochen in Berlin" src="http://ek.saskialund.de/wp-content/uploads/event-location-kiekeberg.jpg">
              <div class="teamMain">
                <div class="personName">Berlin</div>
                <div class="personeText">Website besuchen</div>
              </div></a></li><li><a href="#"> <img width="211" height="184" alt="Erlebniskochen in München" src="http://ek.saskialund.de/wp-content/uploads/event-location-kiekeberg2.jpg">
              <div class="teamMain">
                <div class="personName">München</div>
                <div class="personeText">Website besuchen</div>
              </div></a></li><li><a href="#"> <img width="211" height="184" alt="Erlebniskochen in Frankfurt Rhein/Main" src="http://ek.saskialund.de/wp-content/uploads/event-location-kiekeberg3.jpg">
              <div class="teamMain">
                <div class="personName">Frankfurt<br>Rhein/Main</div>
                <div class="personeText">Website besuchen</div>
              </div></a></li><li><a href="#"> <img width="211" height="184" alt="Erlebniskochen in Köln/Bonn" src="http://ek.saskialund.de/wp-content/uploads/event-location-kiekeberg4.jpg">
              <div class="teamMain">
                <div class="personName">Köln/Bonn</div>
                <div class="personeText">Website besuchen</div>
              </div></a></li><li><a href="#"> <img width="211" height="184" alt="Erlebniskochen in Bielefeld/Müst..." src="http://ek.saskialund.de/wp-content/uploads/weihnachtsfeier-location-hamburg.jpg">
              <div class="teamMain">
                <div class="personName">Bielefeld/Müst...</div>
                <div class="personeText">Website besuchen</div>
              </div></a></li><li><a href="#"> <img width="211" height="184" alt="Erlebniskochen in Düsseldorf" src="http://ek.saskialund.de/wp-content/uploads/event-location-hamburg.jpg">
              <div class="teamMain">
                <div class="personName">Düsseldorf</div>
                <div class="personeText">Website besuchen</div>
              </div></a></li></ul>
       </div>
    </div>
  </div></div>
</section>';
return $string;
} 


?>