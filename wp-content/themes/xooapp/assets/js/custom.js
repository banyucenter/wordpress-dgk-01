// JavaScript Document


jQuery(window).on('load', function() {
	
	"use strict";

	/*----------------------------------------------------*/
		/*	Preloader
		/*----------------------------------------------------*/
		
		jQuery("#loader").delay(100).fadeOut();
		jQuery("#loader-wrapper").delay(100).fadeOut("fast");

		// jQuery(window).stellar({});
		
	});


jQuery(window).on('scroll', function() {

	"use strict";

	/*----------------------------------------------------*/
	/*	Navigtion Menu Scroll
	/*----------------------------------------------------*/	

	var b = jQuery(window).scrollTop();

	if( b > 72 ){		
		jQuery(".navbar").addClass("scroll");
	} else {
		jQuery(".navbar").removeClass("scroll");
	}



});

jQuery(document).ready(function() {

	"use strict";

		//print page
		jQuery(".print-this").on("click", function() {
			window.print();
		});

		/*----------------------------------------------------*/
		/*	Dropdown  Menu 
		/*----------------------------------------------------*/	

		jQuery('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
			if (!jQuery(this).next().hasClass('show')) {
				jQuery(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
			}
			var $subMenu = jQuery(this).next(".dropdown-menu");
			$subMenu.toggleClass('show');

			jQuery(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				jQuery('.dropdown-submenu .show').removeClass("show");
			});

			return false;
		});

		

		jQuery(".xooapp-navmenu > li").on('mouseenter mouseleave', function (e) {

			if (jQuery('ul', this).length) {
				var elm = jQuery('ul:first', this);
				var off = elm.offset();
				var l = off.left;
				var w = elm.width();
				// var docH = jQuery(".container").height();
				var docW = jQuery(".container").width();

				var isEntirelyVisible = (l + w <= docW);

				if (!isEntirelyVisible) {
					jQuery(this).addClass('edge');
				} else {
					jQuery(this).removeClass('edge');
				}
			}
		});



		/*----------------------------------------------------*/
		/*	OnScroll Animation
		/*----------------------------------------------------*/
		//code deleted

		/*----------------------------------------------------*/
		/*	Animated Scroll To Anchor
		/*----------------------------------------------------*/
		if ( jQuery( 'body' ).is( '.mobile' ) ) {
			jQuery( 'body' ).removeAttr( 'data-animation' );
		}
		
		jQuery('.header a[href^="#"], .page a.btn[href^="#"], .page a.internal-link[href^="#"]').on('click', function (e) {
			
			e.preventDefault();

			
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = jQuery(this.hash);
				target = target.length ? target : jQuery("[name=' + this.hash.slice(1) + ']");
				if (target.length) {
					jQuery('html,body').animate({
						scrollTop: target.offset().top -70
					}, 1000);
					return false;
				}
			}

		});


		/*----------------------------------------------------*/
		/*	ScrollUp
		/*----------------------------------------------------*/
		
		jQuery.scrollUp = function (options) {

			// Defaults
			var defaults = {
				scrollName: 'scrollUp', // Element ID
				topDistance: 600, // Distance from top before showing element (px)
				topSpeed: 800, // Speed back to top (ms)
				animation: 'fade', // Fade, slide, none
				animationInSpeed: 200, // Animation in speed (ms)
				animationOutSpeed: 200, // Animation out speed (ms)
				scrollText: '', // Text for element
				scrollImg: false, // Set true to use image
				activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
			};

			var o = jQuery.extend({}, defaults, options),
			scrollId = '#' + o.scrollName;

			// Create element
			jQuery('<a/>', {
				id: o.scrollName,
				href: '#top',
				title: o.scrollText
			}).appendTo('body');
			
			// If not using an image display text
			if (!o.scrollImg) {
				jQuery(scrollId).text(o.scrollText);
			}

			// Minium CSS to make the magic happen
			jQuery(scrollId).css({'display':'none','position': 'fixed','z-index': '2147483647'});

			// Active point overlay
			if (o.activeOverlay) {
				jQuery("body").append("<div id='"+ o.scrollName +"-active'></div>");
				jQuery(scrollId+"-active").css({ 'position': 'absolute', 'top': o.topDistance+'px', 'width': '100%', 'border-top': '1px dotted '+o.activeOverlay, 'z-index': '2147483647' });
			}

			// Scroll function
			jQuery(window).on('scroll', function(){	
				switch (o.animation) {
					case "fade":
					jQuery( (jQuery(window).scrollTop() > o.topDistance) ? jQuery(scrollId).fadeIn(o.animationInSpeed) : jQuery(scrollId).fadeOut(o.animationOutSpeed) );
					break;
					case "slide":
					jQuery( (jQuery(window).scrollTop() > o.topDistance) ? jQuery(scrollId).slideDown(o.animationInSpeed) : jQuery(scrollId).slideUp(o.animationOutSpeed) );
					break;
					default:
					jQuery( (jQuery(window).scrollTop() > o.topDistance) ? jQuery(scrollId).show(0) : jQuery(scrollId).hide(0) );
				}
			});

			// To the top
			jQuery(scrollId).on('click', function(event){
				jQuery('html, body').animate({scrollTop:0}, o.topSpeed);
				event.preventDefault();
			});

		};
		
		jQuery.scrollUp();


		/*----------------------------------------------------*/
		/*	Video Link Lightbox
		/*----------------------------------------------------*/
		
		jQuery('.video-popup').magnificPopup({
			type: 'iframe',

			iframe: {
				patterns: {
					youtube: {
						index: 'youtube.com',
					}
				}
			}		  		  
		});


		/*----------------------------------------------------*/
		/*	Statistic Counter
		/*----------------------------------------------------*/

		jQuery('.statistic-number').each(function () {
			jQuery(this).appear(function() {
				jQuery(this).prop('Counter',0).animate({
					Counter: jQuery(this).text()
				}, {
					duration: 4000,
					easing: 'swing',
					step: function (now) {
						jQuery(this).text(Math.ceil(now));
					}
				});
			},{accX: 0, accY: 0});
		});



		/*----------------------------------------------------*/
		/*	Bottom Quick Form
		/*----------------------------------------------------*/
		var setHeight = jQuery('.bottom-form-holder').outerHeight(); 
		jQuery('.bottom-form-holder').css({ 'height': setHeight + "px" });

		jQuery('.bottom-form-header').parent().delay(1000).animate({bottom: '-'+setHeight + "px"}, 1000, function(){
			jQuery(this).find('.bottom-form-header').addClass('closed');
		}); 
		
		
		jQuery('.bottom-form-header').on('click', function(){
			if (jQuery(this).hasClass('closed')){
				jQuery(this).next('.bottom-form-holder').css({display:'block'}).parent().animate({bottom: 0}, 1000, function(){
					jQuery(this).find('.bottom-form-header').removeClass('closed');
				});
			} else {
				jQuery(this).parent().animate({bottom: '-'+setHeight + "px"}, 1000, function(){
					jQuery(this).find('.bottom-form-header').addClass('closed');
				});
			}
			
			return false;
		});





	});