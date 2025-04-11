/**
	Template Name 	 : Music & Band Website Templates | W3Music - Bootstrap 5 HTML Template - Empowering Your Music Businesses  | DexignZone
	Author			 : DexignZone
	Version			 : 1.0
	Author Portfolio : https://themeforest.net/user/dexignzone/portfolio
	
	Core script to handle the entire theme and core functions
**/

var W3music = function(){
	'use strict';
		
	var screenWidth = $( window ).width();
	
	/* Home Search ============ */
	var handleHomeSearch = function() {
		/* top search in header on click function */
		var quikSearch = jQuery("#quik-search-btn");
		var quikSearchRemove = jQuery("#quik-search-remove");
		
		quikSearch.on('click',function() {
			jQuery('.dz-quik-search').fadeIn(500);
			jQuery('.dz-quik-search').addClass('On');
		});
		
		quikSearchRemove.on('click',function() {
			jQuery('.dz-quik-search').fadeOut(500);
			jQuery('.dz-quik-search').removeClass('On');
		});	
		/* top search in header on click function End*/
	}
	
	/* Header Height ============ */
	var handleResizeElement = function(){
		var headerTop = 0;
		var headerNav = 0;
		
		$('.header .sticky-header').removeClass('is-fixed');
		$('.header').removeAttr('style');
		
		if(jQuery('.header .top-bar').length > 0 &&  screenWidth > 991)
		{
			headerTop = parseInt($('.header .top-bar').outerHeight());
		}

		if(jQuery('.header').length > 0 )
		{
			headerNav = parseInt($('.header').height());
			headerNav =	(headerNav == 0)?parseInt($('.header .main-bar').outerHeight()):headerNav;
		}	
		
		var headerHeight = headerNav + headerTop;
		
		jQuery('.header').css('height', headerHeight);
	}
	
	/* Resize Element On Resize ============ */
	var handleResizeElementOnResize = function(){
		var headerTop = 0;
		var headerNav = 0;
		
		$('.header .sticky-header').removeClass('is-fixed');
		$('.header').removeAttr('style');
		
		
		setTimeout(function(){
			
			if(jQuery('.header .top-bar').length > 0 &&  screenWidth > 991)
			{
				headerTop = parseInt($('.header .top-bar').outerHeight());
			}

			if(jQuery('.header').length > 0 )
			{
				headerNav = parseInt($('.header').height());
				headerNav =	(headerNav == 0)?parseInt($('.header .main-bar').outerHeight()):headerNav;
			}	
			
			var headerHeight = headerNav + headerTop;
			
			jQuery('.header').css('height', headerHeight);
		
		}, 500);
    }
	/* handle Bootstrap Touch Spin ============ */
	var handleBootstrapTouchSpin = function(){
		if($("input[name='demo_vertical2']").length > 0 ) {
			jQuery("input[name='demo_vertical2']").TouchSpin({
			  verticalbuttons: true,
			  verticalupclass: 'ti-plus',
			  verticaldownclass: 'ti-minus'
			});
		}
		if($(".quantity-input").length > 0 ) {
			jQuery(".quantity-input").TouchSpin({
			  verticalbuttons: true,
			  verticalupclass: 'ti-plus',
			  verticaldownclass: 'ti-minus'
			});
		}
	}
	/* Mini shop-filter Function*/
	var handleShopPannel = function(){
		$(".panel-btn").on('click',function(){
			$(".shop-filter").addClass('show');
		});
		$('.panel-close-btn').on('click',function(){
			$(".shop-filter").removeClass('show');
		})
	}
	/* Cart Function*/
	var cartButton = function(){
		$(".item-close").on('click',function(){
			$(this).closest(".cart-item").hide('500');
		});
		$('.cart-btn').unbind().on('click',function(){
			$(".cart-list").slideToggle('slow');
		})
		
	} 

	/* Range ============ */
	var priceslider = function(){
		if($("#slider-tooltips").length > 0 ) {
			var tooltipSlider = document.getElementById('slider-tooltips');
			
			var formatForSlider = {
				from: function (formattedValue) {
					return Number(formattedValue);
				},
				to: function(numericValue) {
					return Math.round(numericValue);
				}
			};

			noUiSlider.create(tooltipSlider, {
				start: [40, 346],
				connect: true,
				format: formatForSlider,
				tooltips: [wNumb({decimals: 1}), true],
				range: {
					'min': 0,
					'max': 400
				}
			});
			var formatValues = [
				document.getElementById('slider-margin-value-min'),
				document.getElementById('slider-margin-value-max')
			];
			tooltipSlider.noUiSlider.on('update', function (values, handle, unencoded) {
				formatValues[0].innerHTML = "Min Price: " + "$"+ values[0];
				formatValues[1].innerHTML = "Max Price: " + "$"+ values[1];
			});
		}
	}
	
	/* Load File ============ */
	var dzTheme = function(){
		
	if(screenWidth <= 991 ){
			
			var menuObj ;
			 jQuery('.navbar-nav > li > a, .sub-menu > li > a, .navbar-nav > li > a > i, .sub-menu > li > a > i')
				.unbind()
				.on({
					click: function(e){
						menuObj = jQuery(this);
						handleMenus(e, menuObj);
					},
					keypress: function(e){
						if(e.key !== 'Enter') {
							return false;
						}
						menuObj = jQuery(this);
						handleMenus(e, menuObj);	
					},
				});
			jQuery('.tabindex').attr("tabindex","0");	
			function handleMenus(e, menuObj){
				
				if(menuObj.parent('li').has('ul').length > 0){e.preventDefault();}					
					
					/* if(jQuery('.navbar-nav-scroll').length > 0){						
						jQuery(document).on("scroll", pageOnScroll);					
						var headerFullHeight =   parseInt($('.main-bar').css('height'), 10);						
						
						jQuery('.navbar-nav-scroll a[href^="#"]').on('click', function (e) {
							e.preventDefault();
							jQuery(document).off("scroll");							
							jQuery('.navbar-nav-scroll a').each(function () {								
								menuObj.parent('li').removeClass('active');
							})				
							menuObj.parent('li').addClass('active');							
							var target = e.hash,							
							menu = target;
							var $target = $(target);							
							if($target.length > 0){					
								jQuery('html, body').stop().animate({						
									'scrollTop': $target.offset().top - headerFullHeight
								}, 500, 'swing', function () {
									jQuery(document).on("scroll", pageOnScroll);
								});
							}
						});
					}		 */

					/* if(menuObj.closest('li').children('ul').length > 0 ){
						jQuery('.header-nav').removeClass('collapsed').addClass('collapse show');
					}else{
						jQuery('.navbar-toggler').removeClass('open').addClass('collapsed');
						jQuery('.header-nav').removeClass('show');
					} */
				
				if(menuObj.parent().hasClass('open')){
					menuObj.parent().removeClass('open');
				}else{
					if(menuObj.hasClass('sub-menu')){
						menuObj.parent().addClass('open');
					}else{
						menuObj.parent().parent().find('li').removeClass('open');
						menuObj.parent().addClass('open');
					}
				}
			 }			
		}else{
			jQuery('.tabindex').removeAttr("tabindex");	
		}

		jQuery('.dz-carticon').on('click',function(){
			jQuery(this).toggleClass('active');
		});
		jQuery('.dz-wishicon').on('click',function(){
			jQuery(this).toggleClass('active');
		});
		
		jQuery('.sidenav-nav .navbar-nav > li > a').next('.sub-menu,.mega-menu').slideUp();
		jQuery('.sidenav-nav .sub-menu > li > a').next('.sub-menu').slideUp();
		
		jQuery('.sidenav-nav .navbar-nav > li > a, .sidenav-nav .sub-menu > li > a').unbind().on('click', function(e){
			if(jQuery(this).hasClass('open')){
				jQuery(this).removeClass('open');
				jQuery(this).parent('li').children('.sub-menu,.mega-menu').slideUp();
			}else{
				jQuery(this).addClass('open');
				
				if(jQuery(this).parent('li').children('.sub-menu,.mega-menu').length > 0){
					
					e.preventDefault();
					jQuery(this).next('.sub-menu,.mega-menu').slideDown();
					jQuery(this).parent('li').siblings('li').find('a').removeClass('open');
					jQuery(this).parent('li').siblings('li').children('.sub-menu,.mega-menu').slideUp();
				}else{
					jQuery(this).next('.sub-menu,.mega-menu').slideUp();
				}
			}
		}); 
		
		jQuery('.menu-btn').on('click', function () {
			jQuery('body').append('<div class="menu-backdrop"></div>');
			jQuery('.menu-backdrop').on('click', function () {
				jQuery('.contact-sidebar').removeClass('active');
				$(this).remove();
			})

		});
		jQuery('.menu-btn, .openbtn').on('click', function () {
			jQuery('.contact-sidebar').addClass('active');
		});
		jQuery('.menu-close').on('click', function () {
			jQuery('.contact-sidebar').removeClass('active');
			jQuery('.menu-btn').removeClass('open');
			jQuery('.menu-backdrop').remove();
		});
		
	}
	
	
	
	/* Magnific Popup ============ */
	var MagnificPopup = function(){
		
		if(jQuery('.mfp-gallery').length > 0){
			/* magnificPopup function */
			jQuery('.mfp-gallery').magnificPopup({
				delegate: '.mfp-link',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title') + '<small></small>';
					}
				}
			});
			/* magnificPopup function end */
		}
		
		if(jQuery('.mfp-video').length > 0){
			/* magnificPopup for Play video function */		
			jQuery('.mfp-video').magnificPopup({
				type: 'iframe',
				iframe: {
					markup: '<div class="mfp-iframe-scaler">'+
							'<div class="mfp-close"></div>'+
							'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
							'<div class="mfp-title">Some caption</div>'+
							'</div>'
				},
				callbacks: {
					markupParse: function(template, values, item) {
						values.title = item.el.attr('title');
					}
				}
			});	
		}

		if(jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').length > 0){
			/* magnificPopup for Play video function end */
			$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: true,
			});
		}
	}
	
	/* Scroll To Top ============ */
	var scrollTop = function (){
		var scrollTop = jQuery("button.scroltop");
		
		/* page scroll top on click function */	
		scrollTop.on('click',function() {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 1000);
			return false;
		})

		jQuery(window).bind("scroll", function() {
			var scroll = jQuery(window).scrollTop();
			if (scroll > 900) {
				jQuery("button.scroltop").fadeIn(1000);
			} else {
				jQuery("button.scroltop").fadeOut(1000);
			}
		});
		/* page scroll top on click function end*/
	}
	
	/* Header Fixed ============ */
	var headerFix = function(){
		/* Main navigation fixed on top  when scroll down function custom */		
		jQuery(window).on('scroll', function () {
			if(jQuery('.sticky-header').length > 0){
				var menu = jQuery('.sticky-header');
				if ($(window).scrollTop() > menu.offset().top) {
					menu.addClass('is-fixed');
				} else {
					menu.removeClass('is-fixed');
				}
			}
		});
		/* Main navigation fixed on top  when scroll down function custom end*/
	}
	
	
	/* Counter Number ============ */
	var counter = function(){
		if(jQuery('.counter').length){
			jQuery('.counter').counterUp({
				delay: 10,
				time: 3000
			});	
		}
	}
	/* Heart Blast ============ */

	
	/* Video Popup ============ */
	var handleVideo = function(){
		/* Video responsive function */	
		jQuery('iframe[src*="youtube.com"]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
		jQuery('iframe[src*="vimeo.com"]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');	
		/* Video responsive function end */
	}
	
	/* Gallery Filter ============ */
	var handleFilterMasonary = function(){
		/* gallery filter activation = jquery.mixitup.min.js */ 
		if (jQuery('#image-gallery-mix').length) {
			jQuery('.gallery-filter').find('li').each(function () {
				$(this).addClass('filter');
			});
			jQuery('#image-gallery-mix').mixItUp();
		};
		if(jQuery('.gallery-filter.masonary').length){
			jQuery('.gallery-filter.masonary').on('click','span', function(){
				var selector = $(this).parent().attr('data-filter');
				jQuery('.gallery-filter.masonary span').parent().removeClass('active');
				jQuery(this).parent().addClass('active');
				jQuery('#image-gallery-isotope').isotope({ filter: selector });
				return false;
			});
		}
		/* gallery filter activation = jquery.mixitup.min.js */
	}
	
	/* BGEFFECT ============ */
	var reposition = function (){
		
		var modal = jQuery(this),
		dialog = modal.find('.modal-dialog');
		modal.css('display', 'block');
		
		/* Dividing by two centers the modal exactly, but dividing by three 
		 or four works better for larger screens.  */
		dialog.css("margin-top", Math.max(0, (jQuery(window).height() - dialog.height()) / 2));
	}
	
	var handelResize = function (){
		/* Reposition when the window is resized */
		jQuery(window).on('resize', function() {
			jQuery('.modal:visible').each(reposition);			
		});
	}
	var formattedDate = null;
		var WebsiteLaunchDate = jQuery('.countdown').data('launch-date'); // Get date from Blade
		if (WebsiteLaunchDate) {
			var dateObj = new Date(WebsiteLaunchDate);
	
			if (!isNaN(dateObj.getTime())) { // Ensure valid date
				formattedDate = dateObj.getFullYear() + "-" + 
									("0" + (dateObj.getMonth() + 1)).slice(-2) + "-" + 
									("0" + dateObj.getDate()).slice(-2) + 
									" 23:05"; // Adjusted time format
				
				console.log("Formatted Countdown Date:", formattedDate); // Debugging output
	
			} else {
				console.error("Invalid WebsiteLaunchDate format:", WebsiteLaunchDate);
			}
		} else {
			console.error("WebsiteLaunchDate is not set.");
		}
	
	/* Countdown Function */
	var handleCountDown = function(){
		if(jQuery(".countdown").length) {
			// Define interval to prevent errors
			var interval;

			jQuery('.countdown').countdown({ 
				date: formattedDate 
			}, function() {
				jQuery('.countdown').text('We are live');
			});
		}
	};
	
		
	// Light Gallery ============
	var handleLightgallery = function() {
		if(jQuery('#lightgallery').length > 0){
			lightGallery(document.getElementById('lightgallery'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail:true,
				exThumbImage: 'data-src'
            });
		}
		if(jQuery('#lightgallery2').length > 0){
			lightGallery(document.getElementById('lightgallery2'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail:true,
				exThumbImage: 'data-src'
            });
		}
		if(jQuery('#lightgallery3').length > 0){
			lightGallery(document.getElementById('lightgallery3'),{
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail:true,
				exThumbImage: 'data-src'
            });
		}
		if(jQuery('#lightgallery4').length > 0){
			lightGallery(document.getElementById('lightgallery4'),{
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail:true,
				exThumbImage: 'data-src'
            });
		}
		if(jQuery('#lightgallery5').length > 0){
			lightGallery(document.getElementById('lightgallery5'),{
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail:true,
				exThumbImage: 'data-src'
            });
		}
	}
	
	/* Box Hover ============ */
	var boxHover = function(){
		jQuery('.box-hover').on('mouseenter',function(){
			var selector = jQuery(this).parent().parent();
			selector.find('.box-hover').removeClass('active');
			jQuery(this).addClass('active');
		});
	}

	/* Current Active Menu ============ */
	var handleCurrentActive = function() {
		for (var nk = window.location,
				o = $("ul.navbar a").filter(function(){
				return this.href == nk;
			})
			.addClass("active").parent().addClass("active");;)
		{
		if (!o.is("li")) break;
			o = o.parent().addClass("show").parent('li').addClass("active");
		}
	}
	
	/* Select Picker ============ */
	var handleSelectpicker = function(){
		if(jQuery('.default-select').length > 0 && jQuery.isFunction($.fn.selectpicker) ){
			jQuery('.default-select').selectpicker();
		}
	}

	/* Icon Dropdowm ============ */
	var handleIconDropdown = function(){
		jQuery(".icon-dropdown").on('click', function(){
			if($(this).hasClass("show")){
				$(this).removeClass("show");
			}else {
				jQuery(".icon-dropdown").removeClass("show");	
				$(this).addClass("show");
			}
	  	});
	}

	/* Perfect Scrollbar ============ */
	var handlePerfectScrollbar = function() {
		if(jQuery('.deznav-scroll').length > 0){
			const qs = new PerfectScrollbar('.deznav-scroll');
			qs.isRtl = false;
		}
	}

	
	/* WOW ANIMATION ============ */
	var handleWowAnimation = function(){
		if($('.wow').length > 0){
			var wow = new WOW({
				boxClass:     'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset:       100,          // distance to the element when triggering the animation (default is 0)
				mobile:       false       // trigger animations on mobile devices (true is default)
			});
			wow.init();	
		}	
	}

	
	/* Handle Page On Scroll ============ */
	var handlePageOnScroll = function(event){
		
		var headerHeight = parseInt($('.header').css('height'), 10);
		
		$('.navbar-scroll .scroll').on('click', function(event) 
		{
			event.preventDefault();

			jQuery('.navbar-scroll .scroll').parent().removeClass('active');
			jQuery(this).parent().addClass('active');
			
			if (this.hash !== "") {
				var hash = this.hash;	
				var seactionPosition = parseInt($(hash).offset().top, 10);
				var headerHeight =   parseInt($('.header').css('height'), 10) - 30;
				
				var scrollTopPosition = seactionPosition - headerHeight;
				$('html, body').animate({
					scrollTop: scrollTopPosition
				}, 500, function(){
					
				});
			}   
		});
		
		pageOnScroll();
	}
	
	/* Page On Scroll ============ */
	var pageOnScroll = function(event){
		
		if(jQuery('.navbar-scroll').length > 0){
			
			$('.header .sticky-header').addClass('is-fixed');
			var headerHeight = parseInt(jQuery('header .main-bar').height(), 10);
			
			setTimeout(function(){
				$('.header .sticky-header').removeClass('is-fixed');
			}, 100);
			
			jQuery(document).on("scroll", function(){
				
				var scrollPos = jQuery(this).scrollTop();
				jQuery('.navbar-scroll .scroll').each(function () {
					var elementLink = jQuery(this);
					
					var refElement = jQuery(elementLink.attr("href"));
					var seactionPosition = parseInt(jQuery(this.hash).offset().top, 10);
					var scrollTopPosition = (seactionPosition - headerHeight) - 30;
					
					if (scrollTopPosition <= scrollPos){
						elementLink.parent().addClass("active");
						elementLink.parent().siblings().removeClass("active");
					}
				});
				
			});
		}
	} 
	
	/* Handle Navbar Toggler ============ */
	var handleScreenLock = function(){
		jQuery('.navbar-toggler').on('click',function(){
			jQuery('body').toggleClass('screen-lock');
			jQuery('.styleswitcher, .DZ-theme-btn, .demo-btn-bx').toggleClass('	');
		});
	}
	
	/* Scroll Top Progress ============ */
	var handleScrollTopProgress = function (){
		if(jQuery('.scroltop-progress').length > 0){
			var progressPath = $('.scroltop-progress path');
			var pathLength = progressPath[0].getTotalLength();
			var offset = 500;
			var duration = 550;

			progressPath.css({
				'transition': 'none',
				'WebkitTransition': 'none',
				'strokeDasharray': pathLength + ' ' + pathLength,
				'strokeDashoffset': pathLength
			});

			progressPath[0].getBoundingClientRect();

			progressPath.css({
				'transition': 'stroke-dashoffset 10ms linear',
				'WebkitTransition': 'stroke-dashoffset 10ms linear'
			});

			var updateProgress = function() {
			var scroll = $(window).scrollTop();
			var height = $(document).height() - $(window).height();
			var progress = pathLength - (scroll * pathLength / height);
				progressPath.css('strokeDashoffset', progress);
			};

			updateProgress();

			$(window).scroll(updateProgress);

			$(window).on('scroll', function() {
				if ($(this).scrollTop() > offset){
				  $('.scroltop-progress').addClass('active-progress');
				} else {
				  $('.scroltop-progress').removeClass('active-progress');
				}
			});

			$('.scroltop-progress').on('click', function(event) {
				event.preventDefault();
				$('html, body').animate({
					scrollTop: 0
				}, duration);
				return false;
			});
		}
	}
	
	var handleTilt = function(){
		if(jQuery('.dz-tilt').length > 0){			
			$('.dz-tilt').tilt({
				glare: true,
				maxGlare: .5,
				scale: 1
			})
		}
	}
	
	var handlePlaceholderAnimation = function(){
		if(jQuery('.dezPlaceAni').length){
			$('input, textarea').focus(function(){
				$(this).parents('.input-group').addClass('focused');
			});
			$('input, textarea').blur(function(){
				var inputValue = $(this).val();
				if ( inputValue == "" ) {
					$(this).removeClass('filled');
					$(this).parents('.input-group').removeClass('focused');  
				} else {
					$(this).addClass('filled');
				}
			})
		}
	}
	
	var handleParallaxScroll = function(){
		if(jQuery('.dz-parallax').length > 0){
			$(window).on("load scroll", function() {
				var parallaxElements = $(".dz-parallax");

				window.requestAnimationFrame(function() {
					parallaxElements.each(function() {
						var currentElement = $(this),
							windowTop = $(window).scrollTop(),
							elementTop = currentElement.offset().top,
							elementHeight = currentElement.height(),
							viewPortHeight = window.innerHeight * 0.5 - elementHeight * 0.5,
							scrolled = windowTop - elementTop + viewPortHeight,
							customSpeed = currentElement.data("parallax-speed") || 0.1;

						currentElement.css({
							transform: "translate3d(0," + scrolled * -customSpeed + "px, 0) rotate(" + scrolled * -customSpeed + "deg)"
						});
					});
				});
			});	
		}
		if(jQuery('.bg-parallax').length > 0){
			$(window).on("scroll", function() {
				let offset = $(window).scrollTop();
				$(".bg-parallax").css("background-position-y", offset * 0.02 + "px");
			});	
		}
	}
	
	var handleTempusDominus = function(){
		if(jQuery('#datePickerOnly').length > 0){
			const td = new tempusDominus.TempusDominus(document.getElementById("datePickerOnly"), {
				display: {
					viewMode: "calendar",
					components: {
						decades: true,
						year: true,
						month: true,
						date: true,
						hours: false,
						minutes: false,
						seconds: false
					},
				},
				localization: {
				  locale: 'en',
				  format: 'dd/MM/yyyy',
				}
				
			});
		}
		if(jQuery('#timePickerOnly').length > 0){
			new tempusDominus.TempusDominus(document.getElementById("timePickerOnly"),{
				display: {
					viewMode: "clock",
					components: {
						decades: false,
						year: false,
						month: false,
						date: false,
						hours: true,
						minutes: true,
						seconds: false
					}
				},
				localization: {
					locale: 'en',
					format: 'HH:mm',
				}
			});
		}
	}
	
	/* Pointer Effect ============ */
	var handlePointerEffect = function(){
		/* 
			pointer.js was created by OwL for use on websites, 
			and can be found at https://seattleowl.com/pointer.
		*/
		
		const pointer = document.createElement("div")
		pointer.id = "pointer-dot"
		const ring = document.createElement("div")
		ring.id = "pointer-ring"
		document.body.insertBefore(pointer, document.body.children[0])
		document.body.insertBefore(ring, document.body.children[0])

		let mouseX = -100
		let mouseY = -100
		let ringX = -100
		let ringY = -100
		let isHover = false
		let mouseDown = false
		const init_pointer = (options) => {

			window.onmousemove = (mouse) => {
				mouseX = (mouse.clientX != undefined)?mouse.clientX:-100;
				mouseY = (mouse.clientY != undefined)?mouse.clientY:-100;
			}

			window.onmousedown = (mouse) => {
				mouseDown = true
			}

			window.onmouseup = (mouse) => {
				mouseDown = false
			}

			const trace = (a, b, n) => {
				return (1 - n) * a + n * b;
			}
			window["trace"] = trace

			const getOption = (option) => {
				let defaultObj = {
					pointerColor: "#750c7e",
					ringSize: 15,
					ringClickSize: (options["ringSize"] || 15) - 5,
				}
				if (options[option] == undefined) {
					return defaultObj[option]
				} else {
					return options[option]
				}
			}

			const render = () => {
				if(mouseX != undefined){
					ringX = trace(ringX, mouseX, 0.2)
					ringY = trace(ringY, mouseY, 0.2)
	
					if (document.querySelector(".p-action-click:hover")) {
						pointer.style.borderColor = getOption("pointerColor")
						isHover = true
					} else {
						pointer.style.borderColor = "white"
						isHover = false
					}
					ring.style.borderColor = getOption("pointerColor")
					if (mouseDown) {
						ring.style.padding = getOption("ringClickSize") + "px"
					} else {
						ring.style.padding = getOption("ringSize") + "px"
					}
					
					
					
					
					pointer.style.transform = `translate(${mouseX}px, ${mouseY}px)`
					
					ring.style.transform = `translate(${ringX - (mouseDown ? getOption("ringClickSize") : getOption("ringSize"))}px, ${ringY - (mouseDown ? getOption("ringClickSize") : getOption("ringSize"))}px)`
	
					requestAnimationFrame(render)
				}
			}
			requestAnimationFrame(render)
		}
		
		jQuery('a').on('mousemove',function(e){
			jQuery('#pointer-ring').addClass('active');
		});
		
		jQuery('a').on('mouseleave',function(e){
			jQuery('#pointer-ring').removeClass('active');
		});

		init_pointer({});
	}
	
	var handleBoxAware = function (){
		if(jQuery('.hover-aware').length > 0){	
			$('.hover-aware').on('mouseenter', function(e) {
				var parentOffset = $(this).offset(),
				relX = e.pageX - parentOffset.left,
				relY = e.pageY - parentOffset.top;
				$(this).find('.effect').css({top:relY, left:relX})
			})
			.on('mouseout', function(e) {
				var parentOffset = $(this).offset(),
				relX = e.pageX - parentOffset.left,
				relY = e.pageY - parentOffset.top;
				$(this).find('.effect').css({top:relY, left:relX})
			});
		}
	}
	
	var handledzNumber = function (){
		if ($('.dz-number').length > 0) {
			$('.dz-number').on('input', function() {
				var inputVal = $(this).val();
				var numericVal = inputVal.replace(/\D/g, ''); // Remove non-numeric characters

				if (numericVal.length > 10) {
					$(this).val(numericVal.slice(0, 10));
				} else {
					$(this).val(numericVal);
				}
			});
		}
	}
	
	var handleDZhoverMove = function (){
		if(jQuery('.dz-hover-move').length > 0){
			const dzAnchorTags = document.querySelectorAll(".dz-hover-move li");
			dzAnchorTags.forEach((anchor) => {
				let sx = 0;
				let sy = 0;
				let ssize = 1;

				let dx = sx;
				let dy = sy;
				let dsize = ssize;

				let dzWidth = window.innerWidth;
				let dzHeight = window.innerHeight;

				anchor.addEventListener("mousemove", (e) => {
					const rect = anchor.getBoundingClientRect();
					const anchorCenterX = rect.left + rect.width / 2;
					const anchorCenterY = rect.top + rect.height / 2;

					dx = (e.clientX - anchorCenterX) * 0.90;
					dy = (e.clientY - anchorCenterY) * 0.90;

					dsize = 1.3;
				});

				anchor.addEventListener("mouseleave", (e) => {
					dx = 0;
					dy = 0;
					dsize = 1;
				});
			  
				window.addEventListener("resize", () => {
					dzWidth = window.innerWidth;
					dzHeight = window.innerHeight;
				});

				function lerp(a, b, t) {
					return (1 - t) * a + t * b;
				}

				function update() {
					sx = lerp(sx, dx, 0.1);
					sx = Math.floor(sx * 100) / 100;

					sy = lerp(sy, dy, 0.1);
					sy = Math.floor(sy * 100) / 100;

					ssize = lerp(ssize, dsize, 0.05);
					ssize = Math.floor(ssize * 100) / 100;

					anchor.style.transform = `translate(${sx}px, ${sy}px) scale(${ssize})`;
					requestAnimationFrame(update);
				}

				update();

			});
		}
	}
		
	var handleImageTooltip = function(){
		if(screenWidth > 991){
			$('.image-tooltip-effect').hover(function(){
				var title = $(this).data('url');
				$('body').append("<div class='image-tooltip overflow-visible'>"+`<img src="${title}" class='title'>`+"</div>");
				$('.image-tooltip').width(300);		
				$('.image-tooltip img').css('scale','1');
				$('.image-tooltip img').css('opacity','1');
			},
			function(){
				// Hover out code
				$(this).find('span', $(this).data('tipText'));
				$('.image-tooltip').remove();
				
			}).mousemove(function(e){
				var mousex = e.pageX + 50; //Get X coordinates
				var mousey = e.pageY + -100; //Get Y coordinates

				if(mousex > 900 ){
					$('.image-tooltip img').css('transform','rotate(5deg)');
					$('.image-tooltip img').css('scale','1.1');
				}else if(mousex < 900 && mousex > 800  ){
					$('.image-tooltip img').css('transform','rotate(0deg)');

				}else{
					$('.image-tooltip img').css('transform','rotate(-5deg)');
					$('.image-tooltip img').css('scale','1');
				}
				$('.image-tooltip').css({ top: mousey, left: mousex })
					if(mousex + $('.image-tooltip').width() + 60 > screen.width){
					$('.image-tooltip').css({ top: mousey, left: mousex - $('.image-tooltip').width() - 60})
				}
			});
		}
	}
	var dzbtnhover = function(){
		$('.btn-hover-4').each(function() {
			$(this).html('<div><span>' + $(this).text().trim().split('').join('</span><span>') + '</span></div>');
		});
	}

	/* Split Box ============ */
	var isScrolledIntoView = function (elem){
		var $elem = $(elem);
		var $window = $(window);

		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();

		var elemTop = $elem.offset().top;
		var elemBottom = elemTop + $elem.height();

		return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}
	
	
	var splitImageAnimation = function (){
		$(window).on('scroll',function(){
			$('.split-box').each(function(){
				if(isScrolledIntoView($(this))){
					$(this).addClass('split-active');
				}
			});
		});
	}

	var servicesopen = function(){
		jQuery('.dz-services-box').on('click',function(){
			jQuery('.dz-services-box').removeClass('active');
			jQuery(this).addClass('active');
		});
	}


	var handleMagnifyGallery = function(){
		
		const imageSelector = $('.DZoomImage');
		/* let x = imageSelector.find('img');
		$(window).on('resize',function(){
			console.log(imageSelector.width());
			x.css("width", imageSelector.width() + "px");
			x.css("height", imageSelector.height() + "px");
		}) */



		imageSelector.on('mousemove',function(t) {
			let e = $(this).offset();
			var i = (t.pageX - e.left) / $(this).width() * 100 <= 100 ? (t.pageX - e.left) / $(this).width() * 100 : 100;
			var c = (t.pageY - e.top) / $(this).height() * 100 <= 100 ? (t.pageY - e.top) / $(this).height() * 100 : 100;
			
			$(this).find('img').css("transform-origin", i + "% " + c + "%");
		})
		imageSelector.on('mouseenter',function(t) {
			let n = $(this).find('img');
			n.css("cursor", "pointer"), 
				/* n.css("width", $(this).width() + "px"), 
				n.css("height", $(this).height() + "px"), */ 
			n.css("transition", "0.1s"), 
			n.css("transform", "scale(" + 1.5 + ")"),
			$(this).find('.mfp-link i').css({opacity : 1,zIndex : 1})
		});
		imageSelector.on('mouseleave',function(t) {
			let n = $(this).find('img');
			n.css("transition", "0.1s"), n.css("transform", "scale(1)")
			$(this).find('.mfp-link i').css({opacity : 0,zIndex : 1})
		});
	}
	
	var handleColorFilter = function(){
		var colorsInput = document.querySelectorAll(".color-filter .form-check-input");
		colorsInput.forEach(colorChange)
		function colorChange(item, index, arr) {
			var color = $(item).val();
			var element = $(item).closest('.form-check').find('span');
			element.css({backgroundColor : color});
		}
	}
	
	var menuHover = function(){
		jQuery('.header-menu .nav > li').on('mouseenter',function(){
			jQuery('.header-menu .nav > li').removeClass('active');
			jQuery(this).addClass('active');
		})
		jQuery('.menu-nav-btn').on('click',function(){
			jQuery('.page-wraper').toggleClass('active-menu');
			//jQuery(this).addClass('active');
		})
	}
	
	/* Coming Soon Counter ============ */
	var handleComingSoonCounter = function(){
		
		var commingSoonDate = new Date(WebsiteLaunchDate).getTime();
		
		var x = setInterval(function() {
			clockCounter();
		}, 1000);
		
		function clockCounter(){
			var currentTime = new Date().getTime();
			var clockTime = commingSoonDate - currentTime;

			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(clockTime / (1000 * 60 * 60 * 24));
			var hours = Math.floor((clockTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((clockTime % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((clockTime % (1000 * 60)) / 1000);

			var remainDays 		= (days.toString().length 		== 1) ? '0'+days	: days;
			var remainHour 		= (hours.toString().length 		== 1) ? '0'+hours	: hours;
			var remainMin 		= (minutes.toString().length 	== 1) ? '0'+minutes	: minutes;
			var remainSeconds 	= (seconds.toString().length 	== 1) ? '0'+seconds	: seconds;

			jQuery('#day').text(remainDays);
			jQuery('#hour').text(remainHour);
			jQuery('#min').text(remainMin);
			var num = '' + remainSeconds;
			jQuery('#second').html("<span>"+num.charAt(0)+"</span><span>"+num.charAt(1)+"</span>");
			
			var rotateNum = 6 * seconds;

			$('.round').css({'transform': 'rotate(' + rotateNum + 'deg)'});
			$('.round').css({'-webkit-transform': 'rotate(' + rotateNum + 'deg)'});
			$('.round').css({'-o-transform': 'rotate(' + rotateNum + 'deg)'});
			$('.round').css({'-moz-transform': 'rotate(' + rotateNum + 'deg)'});
			$('.round').css({'-ms-transform': 'rotate(' + rotateNum + 'deg)'});

			// If the count down is over, write some text 
			if (clockTime < 0) {
				clearInterval(x);
				jQuery("#day, #hour, #min, #second").html("EXPIRED");
			}
		}	
	}
	
	var alertshow = function(){
		jQuery('#placeorder').on('click',function(){
			swal.fire("PLACE ORDER!", "You order received", "success");
		});
	}
	
	var handleOpenModal = function(){
		
		var modalBox = `<div class="modal fade inquiry-modal style-1" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="height:100vh;">
			<div class="modal-dialog" role="document" style="background-image: url(assets/images/background/pic4.jpg);">
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
							  <path d="M2.08214 15.705L8.13672 9.65043L14.1914 15.7051C14.6091 16.1228 15.2873 16.1228 15.7051 15.705C16.1228 15.2873 16.1228 14.6091 15.7051 14.1914L9.65043 8.13672L15.7051 2.082C16.1228 1.66432 16.1228 0.98611 15.7051 0.568429C15.2873 0.150609 14.6091 0.150609 14.1914 0.56829L8.13672 6.623L2.08214 0.568429C1.66432 0.150609 0.98611 0.150609 0.568429 0.56829C0.150609 0.98611 0.150609 1.66432 0.568429 2.08214L6.623 8.13672L0.568429 14.1913C0.150609 14.6091 0.150609 15.2873 0.568429 15.7051C0.98611 16.1228 1.66432 16.1228 2.08214 15.705Z" fill="white"/>
							</svg>
					  </span>
					</button>
					<div>
						<div class="modal-header">
							<h3 class="modal-title" id="exampleModalLongTitle">Join Our Mailing List</h3>
							<p class="text">Music the heartbeat of existence</p>
						</div>
						<div class="modal-body">
							<form class="dzSubscribe dz-subscribe-wrapper1" action="assets/script/mailchamp.php" method="post">
								<div class="dzSubscribeMsg"></div>
								<div class="form-group">
									<div class="input-group">
										<i class="fa-regular fa-envelope"></i>
										<input name="dzEmail" required="required" type="email" class="form-control" placeholder="Enter Your Email Address">
										<div class="input-group-addon ">
											<button name="submit" value="Submit" type="submit" class="btn-link">
												<i class="la la-arrow-right"></i>
											</button>
										</div>
									</div>
								</div> 
								<div class="form-check m-lg-b50 m-b30">
									<input class="form-check-input checkbox-secondary m-r15" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">I Agree To The <span>Privacy Policy</span></label>
								</div>
								<div class="input-group-addon ">
									<button name="submit" value="Submit" type="submit" class="btn btn-gradient btn-hover-1">
											<span>SUBSCRIBE NOW</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>`;
			
		jQuery('body').append(modalBox);
		setTimeout(function() {
			if(!getCookie('inquiryModal')){
				jQuery("#myModal").modal('show');
				setCookie('inquiryModal',true);
			}
		}, 5000)
	}

	var musicplayer = function(){

		var timeString = (secs) => {

		  let ss = Math.floor(secs),
			hh = Math.floor(ss / 3600),
			mm = Math.floor((ss - hh * 3600) / 60);
		  ss = ss - hh * 3600 - mm * 60;


		  if (hh > 0) {
			mm = mm < 10 ? "0" + mm : mm;
		  }
		  ss = ss < 10 ? "0" + ss : ss;
		  return hh > 0 ? `${hh}:${mm}:${ss}` : `${mm}:${ss}`;
		};

		function setProgress(elTarget) {
		  let divisionNumber = elTarget.getAttribute("max") / 100;
		  let rangeNewWidth = Math.floor(elTarget.value / divisionNumber);
		  if (rangeNewWidth > 95) {
			elTarget.nextSibling.style.width = "95%";
		  } else {
			elTarget.nextSibling.style.width = rangeNewWidth + "%";
		  }
		}

		for (let i of document.querySelectorAll(".dz-player")) {
			
		  i.audio = new Audio(encodeURI(i.dataset.src));
		  (i.aPlay = i.querySelector(".dz-play-btn")),
			(i.aPlayIco = i.querySelector(".dz-play-btnIco")),
			(i.dzPlayCurDuration = i.querySelector(".dzPlayCurDuration")),
			(i.dzPlayDuration = i.querySelector(".dzPlayDuration")),
			(i.dzPlayRange = i.querySelector(".dzPlayRange")),
			(i.dzPlayVol = i.querySelector(".dzPlayVol")),
			(i.dzPlayerVolIcon = i.querySelector(".dzPlayerVolIcon"));
		  i.seeking = false; 


		  i.aPlay.onclick = () => {
			if (i.audio.paused) {
			  i.audio.play();
			} else {
			  i.audio.pause();
			}
		  };

		  i.audio.onplay = () => (i.aPlayIco.innerHTML = '<i class="fa fa-pause"></i>');
		  i.audio.onpause = () => (i.aPlayIco.innerHTML = '<i class="fa fa-play"></i>');

		  i.audio.onloadstart = () => {
			i.dzPlayCurDuration.innerHTML = "Loading";
			i.dzPlayDuration.innerHTML = "";
		  };


		  i.audio.onloadedmetadata = () => {

			i.dzPlayCurDuration.innerHTML = timeString(0);
			i.dzPlayDuration.innerHTML = timeString(i.audio.duration);

			i.dzPlayRange.max = Math.floor(i.audio.duration);

			i.dzPlayRange.oninput = () => (i.seeking = true); 
			i.dzPlayRange.onchange = () => {
			  i.audio.currentTime = i.dzPlayRange.value;
			  if (!i.audio.paused) {
				i.audio.play();
			  }
			  i.seeking = false;
			};

			i.audio.ontimeupdate = () => {
			  if (!i.seeking) {
				i.dzPlayRange.value = Math.floor(i.audio.currentTime);
			  }
			  i.dzPlayCurDuration.innerHTML = timeString(i.audio.currentTime);
			  let divisionNumber = i.dzPlayRange.getAttribute("max") / 100;
			  let rangeNewWidth = Math.floor(i.dzPlayRange.value / divisionNumber);
			  if (rangeNewWidth > 95) {
				i.dzPlayRange.nextSibling.style.width = "95%";
			  } else {
				i.dzPlayRange.nextSibling.style.width = rangeNewWidth + "%";
			  }
			};
		  };
		  
		  i.dzPlayerVolIcon.onclick = () => {
			i.audio.volume = i.audio.volume == 0 ? 1 : 0;
			i.dzPlayVol.value = i.audio.volume;
			i.dzPlayerVolIcon.innerHTML =
			  i.dzPlayVol.value == 0
				? '<i class="fa fa-volume-off"></i>'
				: '<i class="fa fa-volume-up"></i>';
			if (i.dzPlayVol.value == 0) {
			  i.dzPlayVol.nextSibling.style.width = "0%";
			} else {
			  i.dzPlayVol.nextSibling.style.width = "95%";
			}
		  };
		  i.dzPlayVol.onchange = () => {
			i.audio.volume = i.dzPlayVol.value;
			i.dzPlayerVolIcon.innerHTML =
			  i.dzPlayVol.value == 0
				? '<i class="fa fa-volume-off"></i>'
				: '<i class="fa fa-volume-up"></i>';
		  };

		  i.audio.oncanplaythrough = () => {
			i.aPlay.disabled = false;
			i.dzPlayVol.disabled = false;
			i.dzPlayRange.disabled = false;
		  };
		  i.audio.onwaiting = () => {
			i.aPlay.disabled = true;
			i.dzPlayVol.disabled = true;
			i.dzPlayRange.disabled = true;
		  };

		  i.dzPlayRange.addEventListener("input", function () {
			setProgress(this);
		  });

		  i.dzPlayVol.addEventListener("input", function () {
			setProgress(this);
		  });
		}	
	}
	
	var musiccontrolbutton = function(){
		$(document).ready(function() {
			var $tracks = $(".track");
			var $controlBtns = $(".play-pause");
			var activeIndex = -1;

			function playPause(index) {
				if (activeIndex === index) {

					var $track = $tracks[index];
					var $controlBtn = $controlBtns.eq(index);

					if ($track.paused) {
						$track.play();
						$controlBtn.removeClass("play").addClass("pause");
					} else {
						$track.pause();
						$controlBtn.removeClass("pause").addClass("play");
					}
				} else {
					if (activeIndex !== -1) {
						var $activeTrack = $tracks[activeIndex];
						var $activeControlBtn = $controlBtns.eq(activeIndex);
						$activeTrack.pause();
						$activeControlBtn.removeClass("pause").addClass("play");
					}

					var $track = $tracks[index];
					var $controlBtn = $controlBtns.eq(index);
					$track.play();
					$controlBtn.removeClass("play").addClass("pause");
					activeIndex = index;
				}
			}

			$controlBtns.each(function(index) {
				$(this).on("click", function() {
					playPause(index);
				});
			});

			$tracks.on("ended", function() {
				var index = $tracks.index(this);
				$controlBtns.eq(index).removeClass("pause").addClass("play");
				activeIndex = -1;
			});
		});	
	}
	
	/* Password Show / Hide */
	var handleShowPass = function(){
		jQuery('.show-pass').on('click',function(){
			var inputType = jQuery(this).parent().find('.dz-password');
			if(inputType.attr('type') == 'password')
			{
				inputType.attr('type', 'text');
				jQuery(this).addClass('active');
			}
			else
			{
				inputType.attr('type', 'password');
				jQuery(this).removeClass('active');
			}
		});
	}

  /* Current Year */
var setCurrentYear = function(){
		const currentDate = new Date();
		let currentYear = currentDate.getFullYear();
	   let elements = document.getElementsByClassName('current-year'); 

		  for (const element of elements) {
		  element.innerHTML = currentYear;
	  }
  }
  var StorySwiper = function () {
		if (jQuery('.status-swiper').length > 0) {
			var swiperTestimonial = new Swiper('.status-swiper', {
				loop: true,
				spaceBetween: 0,
				slidesPerView: "auto",
				speed: 1500,
				effect: "fade",
				//  autoplay: {
				//  	delay: 2000,
				//  },
				pagination: {
					el: ".status-pagination",
					clickable: true,
				},
			});
		}
	}
	
	/* Function ============ */
	return {
		init:function(){
			handleHomeSearch();
			handleWowAnimation();
			setCurrentYear();
			alertshow();
			StorySwiper();
			menuHover();
			handleImageTooltip();
			handleColorFilter();
			boxHover();
			musicplayer();
			musiccontrolbutton();
			dzbtnhover();
			handleMagnifyGallery();
			servicesopen();
			dzTheme();
			handleDZhoverMove();
			splitImageAnimation();
			MagnificPopup();
			scrollTop();
			headerFix();
			handleSelectpicker();
			handleVideo();
			handlePlaceholderAnimation();
			handleFilterMasonary();
			handelResize();
			handleLightgallery();
			handleCountDown();
			handleBootstrapTouchSpin();
			handleIconDropdown();
			handleCurrentActive();
			handlePerfectScrollbar();
			handleComingSoonCounter();
			handleShowPass();
			handlePageOnScroll();
			handleShopPannel();
			priceslider();
			cartButton();
			handleScreenLock();
			handleScrollTopProgress();
			handleTilt();
			handleParallaxScroll();
			handleTempusDominus();
			handlePointerEffect();
			handleBoxAware();
			handledzNumber();
		},

		load:function(){
			counter();
			// handleOpenModal();
			jQuery('.modal').on('show.bs.modal', reposition);
		},
		
		resize:function(){
			screenWidth = $(window).width();
			dzTheme();	

		}
	}
	
}();


/* Document.ready Start */	
jQuery(document).ready(function() {
	'use strict';
	W3music.init();
	
	jQuery('.navicon').on('click',function(){
		$(this).toggleClass('open');
	});
	
	if($('[data-splitting]').length > 0){
		Splitting();
	}
	setInterval(function() {
		jQuery('[data-splitting]').toggleClass('active');
	}, 5000);

	
});

/* Window Resize START */
jQuery(window).on('resize',function () {
	
	W3music.resize();
	
});
/*  Window Resize END */

/* Window Load START */
jQuery(window).on('load',function () {
	
	W3music.load();
	
	setTimeout(function(){
		jQuery('#loading-area').fadeOut();
	}, 500);
	
	if(jQuery('#loading-area2').length > 0){
		let isVisible = false;
		
		function handleVisibilityChange() {
			if (!isVisible && !document.hidden) {
				
				setTimeout(function (){
					jQuery('#loading-area2').addClass('active');
					
					setTimeout(function() {
						jQuery('#loading-area2').fadeOut();
					}, 1200);
					
				}, 700);
				
				isVisible = true;
			}
		}
		document.addEventListener("visibilitychange", handleVisibilityChange);
		
		if ($("#loading-area2").is(":visible")) {
			handleVisibilityChange();
		}
	}
	if(jQuery('#loading-area3').length > 0){
		let isVisible = false;
		
		function handleVisibilityChange() {
			if (!isVisible && !document.hidden) {
				
				setTimeout(function() {
					jQuery('.text').addClass('show');
				}, 100);
				setTimeout(function (){
					jQuery('#loading-area3').addClass('active');
				}, 1500);
				setTimeout(function() {
					jQuery('#loading-area3').fadeOut();
				}, 2000);
				
				isVisible = true;
			}
		}
		document.addEventListener("visibilitychange", handleVisibilityChange);
		
		if ($("#loading-area3").is(":visible")) {
			handleVisibilityChange();
		}
	}

	setTimeout(function(){		
		jQuery('#loading-area-4').addClass('active');
		jQuery('#loading-area-4').fadeOut(2500);
	}, 2500);
	setTimeout(function(){
		jQuery('#loading-area').fadeOut();
		jQuery('#loading-area-4').addClass('show');
	}, 2000);
	
	
	document.body.addEventListener( 'keydown', function() {
	document.body.classList.add( 'show-focus-outline' );
	});

	document.body.addEventListener( 'mousedown', function() {
		document.body.classList.remove( 'show-focus-outline' );
	});
	
});
/*  Window Load END */