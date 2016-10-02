/*---------------------------------------------------------------------*/
;(function($){

/*================= Global Variable Start =================*/		   
var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
var IEbellow9 = !$.support.leadingWhitespace;
var iPhoneAndiPad = /iPhone|iPod/i.test(navigator.userAgent);
var isIE = navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0;
function isIEver () {
  var myNav = navigator.userAgent.toLowerCase();
  return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}
//if (isIEver () == 8) {}
		   
var jsFolder = "js/";
var cssFolder = "css/";	
var ww = document.body.clientWidth, wh = document.body.clientHeight;
var mobilePort = 992, ipadView = 1024, wideScreen = 1600;

/*================= Global Variable End =================*/	

//css3 style calling 
/* document.write('<link rel="stylesheet" type="text/css" href="' + cssFolder +'animate.css">'); */

/*================= On Document Load Start =================*/	
$(document).ready( function(){
	$('body').removeClass('noJS').addClass("hasJS");
	$(this).scrollTop(0);
	getWidth();
	
	//Set Element to vertical center using padding
	 $.fn.verticalAlign = function () {return this.css("padding-top", ($(this).parent().height() - $(this).height()) / 2 + 'px');};
	 
	setTimeout(function(){
		$('.vCenter').each(function () {$(this).verticalAlign();});
	}, 800);
	
	// Index Banner Slider	
	if( $(".sliderBanner").length) {
		var owl = $(".sliderBanner");
		var autoplay;
		if (owl.children().length == 1) {autoplay = false}
		else {autoplay = true}
		
		owl.owlCarousel({
			loop:autoplay
			,autoplay:autoplay
			,mouseDrag:false
			,autoplayTimeout:4500
			//,autoplaySpeed:5000
			,smartSpeed:1300
			,nav:false	
			,dots:false
			,items:1
			//,animateIn: 'owlFadeIn'
			,animateOut:'owlFadeOut'
			,autoplayHoverPause:false
			//dots : false		
			,onInitialized: function(event) {
				if (owl.children().length > 1) { 
					 //owl.trigger('stop.owl.autoplay');
					 //this.settings.autoplay = true;
					 //this.settings.loop = true;
				}
			}
		});
	};
	
	// Inner Banner Slider	
	if( $(".slider").length) {
		var owl2 = $(".slider");
		var autoplay;
		if (owl2.children().length == 1) {autoplay = false	}
		else {autoplay = true}
		
		owl2.owlCarousel({
			loop:autoplay
			,autoplay:autoplay
			,mouseDrag:autoplay
			,autoplayTimeout:3000
			,autoplaySpeed:800
			,smartSpeed:1200
			,nav:autoplay
			,dots:autoplay
			,items : 1
			,autoplayHoverPause: true
			//dots : false		
			,onInitialized: function(event) {
				if (owl2.children().length > 1) { 
				}
			}
		});
	};
	
	
	if( $(".carouselBlock").length) {
		$('.carouselBlock').owlCarousel({
			 loop:true
			,autoplay:true
			,autoplayTimeout:3000
			,smartSpeed:1200
			,margin:10
			,nav:true
			,responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:5
				}
			}
		})
	};
	
	if( $(".marqueeScrolling li").length > 1){
		var $mq = $('.marquee').marquee({
			 speed: 25000
			,gap: 0
			,duplicated: true
			,pauseOnHover: true
			});
		$(".btnMPause").toggle(function(){
			$(this).addClass('play');
			$(this).text('Play');
			$mq.marquee('pause');
		},function(){
			$(this).removeClass('play');
			$(this).text('Pause');
			$mq.marquee('resume');
			return false;
		});
	};
	
	// Multiple Ticker	
	if( $(".ticker").length){
		$('.ticker').each(function(i){
			$(this).addClass('tickerDiv'+i).attr('id', 'ticker'+i);
			$('#ticker'+i).find('.tickerDivBlock').first().addClass('newsTikker'+i).attr('id', 'newsTikker'+i);
			$('#ticker'+i).find('a.playPause').attr('id', 'stopNews'+i)
			$('#newsTikker'+i).vTicker({ speed: 1E3, pause: 4E3, animation: "fade", mousePause: false, showItems: 3, height: 150, direction: 'up' })
			$("#stopNews"+i).click(function () {
				if($(this).hasClass('stop')){
					$(this).removeClass("stop").addClass("play").text("Play").attr('title', 'Play');
				}else{
					$(this).removeClass("play").addClass("stop").text("Pause").attr('title', 'pause');
				}
				return false;
			});
		});
	};
	
	
	
	// Responsive Tabing Script
	if( $(".resTab").length) {
		$('.resTab').responsiveTabs({
			 rotate: false
			,startCollapsed: 'tab' //accordion
			,collapsible: 'tab' //accordion
			,scrollToAccordion: true
		});
	};
				
	if( $(".accordion").length){
	   $('.accordion .accordDetail').hide();
	   $(".accordion .accordDetail:first").show(); 
	   $(".accordion .accTrigger:first").addClass("active");	
	   $('.accordion .accTrigger').click(function(){
		  if ($(this).hasClass('active')) {
			   $(this).removeClass('active');
			   $(this).next().slideUp();
		  } else {
			  if ($('body').hasClass('desktop')) {
			   $('.accordion .accTrigger').removeClass('active');
			   $('.accordion .accordDetail').slideUp();
			  }
			   $(this).addClass('active');			   
			   $(this).next().slideDown();
		  }
		  return false;
	   });
	};
	
	if( $(".tableData").length > 0){
		$('.tableData').each(function(){
			$(this).wrap('<div class="tableOut"></div>');
			$(this).find('tr').each(function(){
			$(this).find('td:first').addClass('firstTd');
			$(this).find('th:first').addClass('firstTh');
			$(this).find('th:last').addClass('lastTh');
			});
			$(this).find('tr:last').addClass('lastTr');
			$(this).find('tr:even').addClass('evenRow');
			$(this).find('tr:nth-child(2)').find('th:first').removeClass('firstTh');
		});	
	};
	
	// Responsive Table
	if( $(".responsiveTable").length){
		$(".responsiveTable").each(function(){		
		$(this).find('td').removeAttr('width');
		//$(this).find('td').removeAttr('align');
		var head_col_count =  $(this).find('tr th').size();
		// loop which replaces td
		for ( i=0; i <= head_col_count; i++ )  {
			// head column label extraction
			var head_col_label = $(this).find('tr th:nth-child('+ i +')').text();
			// replaces td with <div class="column" data-label="label">
			$(this).find('tr td:nth-child('+ i +')').attr("data-label", head_col_label);
		}
		});
	};
	
	// Responsive Table
	if( $(".tableScroll").length){
		$(".tableScroll").each(function(){
			$(this).wrap('<div class="tableOut"></div>');
		});
	};
	
	// Back to Top function
	if( $("#backtotop").length){
		$(window).scroll(function(){
			if ($(window).scrollTop()>120){
			$('#backtotop').fadeIn('250').css('display','block');}
			else {
			$('#backtotop').fadeOut('250');}
		});
		$('#backtotop').click(function(){
			$('html, body').animate({scrollTop:0}, '200');
			return false;
		});
	};
	

	if($('.verticalSlider').length){		

		$('.verticalSlider').each(function(i){
			$(this).attr('id', 'verticalSlide'+i);
		});
		$('.verticalSliderWrap').find('.bx-pager').each(function(i){
			$(this).attr('id', 'verticalPager'+i);
		});

		var sliderSets = $('.verticalSliderWrap');
		function initSliders(targetSlider, targetPager) {
			$(targetSlider).bxSlider({
		    	pagerCustom: targetPager,		    	
			  	minSlides: 1,
			  	maxSlides: 4,
			  	controls: false,
			  	mode: 'vertical',
			  	mode: 'fade',
			  	controls: false
		  	});
		}

		$(sliderSets).each(function() {
			var targetSlider = "#" + $(this).children('.verticalSlider').attr('id');
		  	var targetPager = "#" + $(this).children('.bx-pager').attr('id');
		  
			initSliders(targetSlider, targetPager);
		});		
	}

	//Custom Select Dropdown
	if( $(".customSelect").length){
		$('.customSelect').customSelect();
	}

	// Custom Checkbox
	if($('.app input[type=checkbox], .app input[type=radio]').length){
		$('.app input[type=checkbox], .app input[type=radio]').iCheck();
	}

	// Custom Checkbox
	if($('.kontaktRight').length){
		setTimeout(function(){
			$('.kontaktRight').css('opacity', '1')
		}, 300);		
	}
	
	
	
	
	
		
	// Get Focus Inputbox
	if( $(".getFocus").length){
			$(".getFocus").each(function(){
			$(this).on("focus", function(){
			if ($(this).val() == $(this)[0].defaultValue) { $(this).val("");};
		  }).on("blur", function(){
			  if ($(this).val() == "") {$(this).val($(this)[0].defaultValue);};
		  });								  
		});
	};
	
	// For device checking
	if (isMobile == false) {
	
	};
	
	// Video JS
	if( $(".videoplayer").length){	
		$(".videoplayer").each(function(){
			var $this = $(this);
			var poster = $this.children("a").find("img").attr("src");
			var title = $this.children("a").find("img").attr("alt");	
			var videotype = $this.children("a").attr("rel");
			var video = $this.children("a").attr("href");
			$this.children("a").remove();
			
			projekktor($this, {
			 poster: poster
			,title: title
			,playerFlashMP4: '../videoplayer/jarisplayer.swf'
			,playerFlashMP3: '../videoplayer/jarisplayer.swf'
			,width: 640
			,height: 385
			,fullscreen:true
			,playlist: [
				{0: {src: video, type: videotype}}
			],
			plugin_display: {
				logoImage: '',
				logoDelay: 1
			}
			}, function(player) {} // on ready 
			);
		})
	};
	
	
	if( $(".litebox").length){	
		$('.litebox').liteBox();
		$('.litebox').each(function(){
			var rel = $(this).data('rel');
			$(this).attr({ 'rel': rel });
		});
	};	
	
	$('.equalHeights > div').equalHeight();
	
	setTimeout (function(){
		if( $(".fixedErrorMsg").length){					 
			$(".fixedErrorMsg").slideDown("slow");				 
			setTimeout( function(){$('.fixedErrorMsg').slideUp();},5000 );
		}
		if( $(".fixedSuccessMsg").length){					 
			$(".fixedSuccessMsg").slideDown("slow");				 
			setTimeout( function(){$('.fixedSuccessMsg').slideUp();},5000 );
		}
	},500);
	
	/*================= On Document Load and Resize Start =================*/
	$(window).on('resize', function () {
									 
		ww = document.body.clientWidth; 
		wh = document.body.clientHeight;		
		
		$('.vCenter').each(function () {$(this).verticalAlign();});	
		
		if($("body").hasClass("mobilePort")){
			$("body").removeClass("wob");
		}
		
		//$('.container').resize(function(){});
		
    }).trigger('resize');
	/*================= On Document Load and Resize End =================*/
	
	/*Navigation */
	if( jQuery("#nav").length) {
		if(jQuery(".toggleMenu").length == 0){
			jQuery("#mainNav").prepend('<a href="#" class="toggleMenu cf"><span class="mobileMenu"></span><span class="iconBar"></span></a>');	
		}
		jQuery(".toggleMenu").click(function() {
			jQuery(this).toggleClass("active");
			jQuery("#nav").slideToggle();
			return false;
		});
		jQuery("#nav li a").each(function() {
			if ($(this).next().length) {
				$(this).parent().addClass("parent");
			};
		})
		jQuery("#nav li.parent").each(function () {
			if (jQuery(this).has(".menuIcon").length <= 0) jQuery(this).append('<i class="menuIcon">+</i>')
		});
		dropdown('nav', 'hover', 1);
		adjustMenu();	
	};
	
if($('.datepicker').length){
	$.datepicker.setDefaults({
	  showOn: "both"
	  ,dateFormat:"dd/mm/yy"
	  ,changeMonth: true
	  ,changeYear: true
	  //,buttonImage: "images/calendar.png"
	 //,buttonImageOnly: true
	  ,shortYearCutoff: 50
	  ,buttonText: "<span class='sprite calIcon'></span>"
	  ,beforeShow: function (textbox, instance) {
		instance.dpDiv.css({
			marginTop: /*(textbox.offsetHeight)*/ 0 + 'px'
			,marginLeft: 0 + 'px'
		});
		}
	});
	
	$( ".datepicker" ).datepicker({
		   dateFormat:"dd/mm/yy"
		   ,showOn: "both"
		   ,buttonText: "<span class='sprite calIcon'></span>"
		   ,shortYearCutoff: 50
		 //,buttonImage: "images/calendar.png"
		 //,buttonImageOnly: true
		   ,beforeShow: function (textbox, instance) {
			instance.dpDiv.css({
					marginTop: /*(textbox.offsetHeight)*/ 0 + 'px'
					,marginLeft: 0 + 'px'
					});
			}
	  });	
}

if( $(".datetimepicker").length){
	$( ".datetimepicker" ).datetimepicker({
           dateFormat:"dd-mm-yy", 
           showOn: "both",
		   buttonText: "<span class='sprite calIcon'></span>",
           //buttonImage: "images/calendar.png"
           //buttonImageOnly: true,
		   beforeShow: function (textbox, instance) {
            instance.dpDiv.css({
                    marginTop: /*(textbox.offsetHeight)*/ 15 + 'px',
                    marginLeft: -13 + 'px'
            		});
    		}
      });
}

	

	if($(".firmenBox").length){
		$('.firmenBox').click(function(){
			$('html, body').animate({scrollTop: $('.firmenGruppen').offset().top}, 900);
			return false;
		});
	}
	
	if($("#kuche").length){
		$('#kuche').click(function(){
		$('html, body').animate({scrollTop: $('#kucheContent').offset().top}, 900);
		return false;
		});
	}
	
	$("#kuche").click(function() {
		$('html, body').animate({
			scrollTop: $("#kucheContent").offset().top
	}, 2000);
	});
 
	if($("#organisation").length){
		$('#organisation').click(function(){
		$('html, body').animate({scrollTop: $('#organisationContent').offset().top}, 900);
		return false;
		});
	}


	if($(".actualCourseList").length){
		$(window).on('resize', function(){
			$('.overlayBg').css({ 'height': $('.overlayBg').siblings('img').height() });
		}).trigger('resize');
	}

	/* Parallax */
	if($(".parallaxImg").length){
		$.Scrollax();
	} 

	// Fading Images	
	if($(".fadeImgsBlock").length){
		$('.fadeImgsBlock .fadeImgsOuter:gt(0)').hide();
		setInterval(function(){
		    $('.fadeImgsBlock .fadeImgsOuter:first-child').fadeOut().next('.fadeImgsOuter').fadeIn().end().appendTo('.fadeImgsBlock');
		}, 6000);

		$(window).on('load resize', function(){
			var rowHeight = $('.fadeImgsOuter').outerHeight() + 18;
			$('.fadeImgsBlock').css({ 'height': rowHeight, 'overflow': 'hidden' });			
		}).trigger('resize');
	}
	
	// gutscheineSlider
	
	if($('.gutscheineSlider').length){
		$('.gutscheineSlider').bxSlider({
			mode: 'fade',
			auto: true,
			autoControls: false
		});
	}
	
});
/*================= On Document Load End =================*/

/*================= On Window Resize Start =================*/	
$(window).bind('resize orientationchange', function() {
	getWidth();												
	adjustMenu();
	$('.vCenter').each(function () {$(this).verticalAlign();});
});

/*================= On Window Resize End =================*/	

/*================= On Window Load Start =================*/
$(window).load(function() {
						
});
/*================= On Document Load End =================*/


function getWidth() {
	ww = document.body.clientWidth;
	if(ww>wideScreen){$('body').removeClass('device').addClass('desktop widerDesktop');}
	if(ww>mobilePort && ww<=wideScreen){	$('body').removeClass('device widerDesktop').addClass('desktop');}
	if(ww<=mobilePort) {$('body').removeClass('desktop widerDesktop').addClass('device');}
	if(ww > 767 && ww < 1025){$('body').addClass('ipad');}
	else {$('body').removeClass('ipad');}	
}

})(jQuery);


function validate() {
    return false;
};

if($('#thumbsScrollSlider0').length){	

	var slider0;
	var carousel0;

	$(document).ready(function(){

		slider0 = $('#bxslider0');
		if($(slider0).find('li').length > 5){
			slider0.bxSlider({
		        //captions: true,
		        mode: 'fade',
		        controls: false,
		        pager: false
		    });
			
			carousel0 = $('#bx-pager0 ul').bxSlider({
				slideWidth: 76,
		        minSlides: 5,
		        maxSlides: 15,
		        moveSlides: 1,
		        //slideMargin: 10,
		        pager: false
		    });
		    
	    } else {
	    	slider0 = $('#bxslider0').bxSlider({
		        //captions: true,
		        mode: 'fade',
		        controls: false,
		        pager: false
		    });

		    carousel0 = $('#bx-pager0 .bx-viewport').bxSlider({
				slideWidth: 66,
		        //minSlides: 1,
		        //maxSlides: 5,
		        //moveSlides: 1,
		        infiniteLoop: false,
		        slideMargin: 10,
		        pager: false,
		        controls: false
		    });
	    }

	    $(window).on('resize', function(){
	    	if($(window).width() > 480){
	    		$('#bx-pager0 ul li').css({ 'width': 'auto', 'display': 'inline-block', 'margin': 0, 'padding': '0 5px' });
	    	} else {
	    		$('#bx-pager0 ul li').css({ 'width': '120px', 'display': 'block', 'margin': '0 auto', 'padding': '0 5px 10px' });
	    	}
	    }).trigger('resize');
    });

	function clicked0(position) {
	    slider0.goToSlide(position);
	}
}


if($('#thumbsScrollSlider1').length){	

	var slider1;
	var carousel1;

	$(document).ready(function(){					

		slider1 = $('#bxslider1');
		if($(slider1).find('li').length > 5){
			slider1.bxSlider({
		        //captions: true,
		        mode: 'fade',
		        controls: false,
		        pager: false
		    });
		
			carousel1 = $('#bx-pager1 ul').bxSlider({
				slideWidth: 76,
		        minSlides: 2,
		        maxSlides: 25,
		        moveSlides: 1,
		        //slideMargin: 10,
		        pager: false
		    });

	    } else {
	    	slider1= $('#bxslider1').bxSlider({
		        //captions: true,
		        mode: 'fade',
		        controls: false,
		        pager: false
		    });

		    carousel1 = $('#bx-pager1 .bx-viewport').bxSlider({
				slideWidth: 66,
		        //minSlides: 1,
		        //maxSlides: 5,
		        //moveSlides: 1,
		        infiniteLoop: false,
		        slideMargin: 10,
		        pager: false,
		        controls: false
		    });

		    $(window).on('resize', function(){
		    	if($(window).width() > 480){
		    		$('#bx-pager1 ul li').css({ 'width': 'auto', 'display': 'inline-block', 'margin': 0, 'padding': '0 5px' });
		    	} else {
		    		$('#bx-pager1 ul li').css({ 'width': '120px', 'display': 'block', 'margin': '0 auto', 'padding': '0 5px 10px' });
		    	}
		    }).trigger('resize');	    
	    }
	   
    });

	function clicked1(position){
	    slider1.goToSlide(position);
	}
}


$(document).ready(function(){

	$(".bxsliderfeatured").each(function( index ) {
		$(this).data('testmw','test');
		var selectorbyid = '#bxslidermain' + $(this).data('indexnr');
		
		$(selectorbyid).bxSlider({
				 mode: 'fade',
		         controls: false,
		         auto: true,
		         speed: 2000,
		         infiniteLoop: true,
		         maxSlides: 6,
                 pagerCustom: $('#bxpagerfeatured' + $(this).data('indexnr'))
		});
	});

});



if($('.featuredSlider').length){	

	var sliderFeatured;
	var carouselFeatured;
	var currentPagerId;
	var custompager;

	$(document).ready(function(){		


		    $(window).on('resize', function(){
		    	if($(window).width() > 480){
		    		$('.bxpagerfeatured a').css({ 'width': 'auto', 'display': 'inline-block', 'margin': 0, 'padding': '0 5px' });
		    	} else {
		    		$('.bxpagerfeatured a').css({ 'width': '98px', 'display': 'block', 'margin': '0 auto', 'padding': '0 5px 10px' });
		    	}
		    }).trigger('resize');	    
	    
	   
    });

	function clicked1(position){
	    slider1.goToSlide(position);
	}
}
