/**
	Template Name 	 : Music & Band Website Templates | W3Music - Bootstrap 5 HTML Template - Empowering Your Music Businesses  | DexignZone
	Author			 : DexignZone
	Version			 : 1.0
	Author Portfolio : https://themeforest.net/user/dexignzone/portfolio
	
	Core script to handle the entire theme and core functions
**/
jQuery(window).on('load', function() {
    'use strict';
	
	
	function changeItemBoxed() {
		if(jQuery("body").hasClass("boxed")) {
			return 3;
		} else {
			return 4;
		}
	}

	// main-banner-1
	if(jQuery('.main-slider-1').length > 0){
		var swiperThumbs = new Swiper(".main-thumb1", {
			loop: true,
			spaceBetween: 25,
			slidesPerView: "2",
			freeMode: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.thumb-button-next',
				prevEl: '.thumb-button-prev',
			},
		});
		var swiper2 = new Swiper(".main-slider-1", {
			loop: true,
			effect: "fade",
			speed: 1500,
			parallax: true,
			autoplay: {
			   delay: 3000,
			},																			
			navigation: {
				nextEl: '.main-button-next',
				prevEl: '.main-button-prev',
			},
			pagination: {
				el: ".main-slider-pagination",
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '">' +"0"+ (index + 1) + "</span>";
				},
			},
			thumbs: {
				swiper: swiperThumbs,
			},
		});
	}
	// Banner 3
	if(jQuery('.main-slider-3').length > 0){
		var swiper = new Swiper(".main-slider-3", {
			speed: 1000,
			parallax: true,
			spaceBetween: 0,
			freeMode: false,
			direction: 'vertical',
			scrollbar: '.swiper-scrollbar',
			autoplay: {
			   delay: 2500,
			},
			navigation: {
				nextEl: '.main-button-next',
				prevEl: '.main-button-prev',
			},
			pagination: {
				el: ".main-swiper3-pagination",
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '">' +"0"+ (index + 1) + "</span>";
				},
			},
		});
		swiper.on('onSlideNextStart', function (){
			$('.swiper-slide .banner-inner').attr('data-swiper-parallax-duration','');
			$('.swiper-slide-prev .banner-inner').attr('data-swiper-parallax-duration','4000');
		});
	}


	// Clients Swiper
	if(jQuery('.clients-swiper').length > 0){
		var swiper5 = new Swiper('.clients-swiper', {
			speed: 1500,
			parallax: true,
			slidesPerView: 5,
			spaceBetween: 30,
			loop: true,
			autoplay: {
				delay: 3000,
			},
			breakpoints: {
				1191: {
					slidesPerView: 5,
				},
				992: {
					slidesPerView: 4,
				},
				768: {
					slidesPerView: 3,
				},
				575: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 2,
				},
			}
		});
	}
	
	//  Product Gallery Swiper1 ==	
	if(jQuery('.product-gallery-swiper').length > 0){
		var swiper = new Swiper(".product-gallery-swiper", {
			spaceBetween: 15,
			slidesPerView: 4,
			freeMode: true,
			watchSlidesProgress: true,
			pagination: {
				el: ".swiper-pagination-trading",
			},
		});
		var swiper2 = new Swiper(".product-gallery-swiper2", {
		  spaceBetween: 0,
		  updateOnWindowResize: true,	
		  navigation: {
			nextEl: ".gallery-button-next",
			prevEl: ".gallery-button-prev",
		  },
		  thumbs: {
			swiper: swiper,
		  },
		});
	}

	// Testimonial Swiper 7
	if(jQuery('.reviews-swiper').length > 0){
		var swiper = new Swiper('.reviews-swiper', {
			speed: 1500,
			parallax: true,
			effect: 'fade',
			slidesPerView:"auto",
			spaceBetween: 0,
			centeredSlides: true,
			loop: true,
			 autoplay: {
			   delay: 2500,
			}, 
			navigation:{
				nextEl: ".reviews-button-next",
				prevEl: ".reviews-button-prev",
			},
		});
	}
	
	//  handle Category Swiper2 ==
	if(jQuery('.category-swiper2').length > 0){
		var swiper = new Swiper( '.category-swiper2', {
			slidesPerView: 6,
			centeredSlides: false,
			spaceBetween: 20,
			loop: true,
			/* pagination: {
				el: ".swiper-pagination-two",
			}, */
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: ".tranding-button-next", 
				prevEl: ".tranding-button-prev",
			},	
			breakpoints: {
				1600: {
					slidesPerView: 6,
					spaceBetween: 40,
				},
				1200: {
					slidesPerView: 6,
					spaceBetween: 20,
				},
				991: {
					slidesPerView: 4,
					spaceBetween: 20,
				},
				575: {
					slidesPerView: 3, 	
					spaceBetween: 15,
				},
				320: {
					slidesPerView: 2,
					spaceBetween: 15,
				},
			}
		});
	}
	
	// Team Swiper
	if(jQuery('.artists-swiper').length > 0){
		var swiper = new Swiper(".artists-swiper", {
			slidesPerView:8,
			speed: 1500,
			parallax: true,
			spaceBetween: 15,
			loop: true,
			grabCursor: true,	
			/* autoplay: {
			   delay: 2500,
			},	 */
			 breakpoints: {
				1280: {
					slidesPerView: 8,
				},
				1024: {
					slidesPerView: 6,
				},
				768: {
					slidesPerView: 4,
				},
				767: {
					slidesPerView: 4,
				},
				600: {
					slidesPerView: 3,
				},
				320: {
					slidesPerView: 1.5,
				},
			} 
		});
	}
	//  Quick View Modal Swiper ==
		if(jQuery('.quick-modal-swiper').length > 0){
			var swiper = new Swiper(".quick-modal-swiper", {
			  spaceBetween: 15,
			  slidesPerView: 4,
			  freeMode: true,
			  watchSlidesProgress: true,
			});
			var swiper2 = new Swiper(".quick-modal-swiper2", {
			  spaceBetween: 0,
			  updateOnWindowResize: true,	
			  navigation: {
				nextEl: ".gallery-button-next",
				prevEl: ".gallery-button-prev",
			  },
			  thumbs: {
				swiper: swiper,
			  },
			});
		}

	
	// Team Swiper
	if(jQuery('.team-swiper').length > 0){
		var swiper = new Swiper(".team-swiper", {
			speed: 1000,
			loop: true,
			parallax: true,
			slidesPerView: 4,
			spaceBetween: 30,
			navigation: {
				nextEl: '.team-button-next',
				prevEl: '.team-button-prev',
			},
	/* 		autoplay: {
			   delay: 2500,
			}, */
			breakpoints: {
				1280: {
					slidesPerView: 4,
				},
				991: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: 2,
				},
				600: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// browser-menu
	if(jQuery('.menu-swiper').length > 0){
		var swiper = new Swiper(".menu-swiper", {
			spaceBetween: 30,
			speed: 1000,
			//parallax: true,
			loop: true,
			centeredSlides: false,
			freeMode: true,
			watchSlidesVisibility: true,
			
			autoplay: {
			   delay: 1000,
			},
			navigation: {
				nextEl: '.menu-button-next1',
				prevEl: '.menu-button-prev1',
			},
			breakpoints: {
				1280: {
					slidesPerView: 4,
          			spaceBetween: 20,
				},
				991: {
					slidesPerView: 3,
          			spaceBetween: 30,
				},
				591: {
					slidesPerView: 2,
          			spaceBetween: 40,
				},
				0:{
					slidesPerView: 1,
          			spaceBetween: 50,
				},
			}
		});
	}
	
	// blog-slider-full
	if(jQuery('.blog-swiper').length > 0){
		var swiper = new Swiper('.blog-swiper', {
			speed: 1000,
			slidesPerView: 2,
			loop: true,
			spaceBetween: 30,
			centeredSlides: false,
			watchSlidesVisibility: true,
			autoplay: {
			   delay: 1500,
			}, 
			navigation:{
				nextEl: '.blog-button-next',
				prevEl: '.blog-button-prev',
			},
			pagination: {
				el: ".swiper-pagination",
			},
			breakpoints: {
				1200: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
		
	// blog-slider-full	
	if(jQuery('.blog-swiper-1').length > 0){
		var swiper = new Swiper('.blog-swiper-1', {
			speed: 1500,
			slidesPerView: 2.2,
			spaceBetween: 30,
			parallax: true,
			loop:true,
			autoplay: {
			   delay: 1000,
			}, 
			breakpoints: {
				1480: {
					slidesPerView: 2.2,
				},
				1280: {
					slidesPerView: 2,
				},
				1200: {
					slidesPerView: 1.5,
				},
				1024: {
					slidesPerView: 1.5,
				},
				600: {
					slidesPerView: 1,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	
	
	// testimonial2
	if(jQuery('.testimonial-two-swiper').length > 0){
		var swiper = new Swiper('.testimonial-two-swiper', {
			speed: 2000,
			slidesPerView: 1,
			spaceBetween: 30,
			parallax: true,
			loop:true,
			autoplay: {
			   delay: 2000,
			},
			navigation: {
				nextEl: '.testimonial-2-button-next',
				prevEl: '.testimonial-2-button-prev',
			},
			breakpoints: {
				1200: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 1,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// img slider
	if(jQuery('.portfolio-swiper').length > 0){
		var swiper = new Swiper('.portfolio-swiper', {
			slidesPerView: 4,
			spaceBetween: 30,
			speed: 1000,
			parallax: true,
			loop:true,
			autoplay: {
			   delay: 1000,
			}, 
			navigation: {
				nextEl: '.img-button-next',
				prevEl: '.img-button-prev',
			},
			breakpoints: {
				1200: {
					slidesPerView: 4,
				},
				1024: {
					slidesPerView: 4,
				},
				768: {
					slidesPerView: 2,
				},
				600: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// testimonial
	if(jQuery('.testimonial-one-swiper').length > 0){
		var swiper = new Swiper(".testimonial-one-thumb", {
			slidesPerView: "3",
			spaceBetween: 0,
			
			grid: {
				rows: 2,
			},
			autoplay: {
			   delay: 1500,
			},
		});
		var swiper2 = new Swiper(".testimonial-one-swiper", {
			slidesPerView: "1",
			autoplay: {
			   delay: 1500,
			},
			thumbs: {
			  swiper: swiper,
			},
		});
	}
	
	// post-swiper
	if(jQuery('.post-swiper').length > 0){
		var swiper = new Swiper(".post-swiper", {
			slidesPerView: "1",
			spaceBetween: 10,
			speed: 1500,
			loop:true,
			autoplay: {
			   delay: 1500,
			},
			navigation: {
				nextEl: '.menu-button-next',
				prevEl: '.menu-button-prev',
			},
		});
	}
	// service-swiper
	if(jQuery('.service-swiper').length > 0){
		var swiper = new Swiper(".service-swiper", {
			slidesPerView: "1",
			spaceBetween: 10,
			speed: 1000,
			loop:true,
			autoplay: {
			   delay: 1000,
			},
			navigation: {
				nextEl: '.service-button-next',
				prevEl: '.service-button-prev',
			},
			paginationClickable: true,
			pagination: {
				el: ".swiper-pagination",
			},
		});
	}
	// service-swiper
	if(jQuery('.service2-swiper').length > 0){
		var swiper = new Swiper(".service2-swiper", {
			slidesPerView: "1",
			spaceBetween: 10,
			speed: 1000,
			loop:true,
			autoplay: {
			   delay: 1000,
			},
			paginationClickable: true,
			pagination: {
				el: ".swiper-pagination",
			},
		});
	}

	if (jQuery('.blog-slideshow').length > 0) {
		var swiperTestimonial = new Swiper('.blog-slideshow', {
			loop: true,
			spaceBetween: 0,
			slidesPerView: "auto",
			speed: 1500,
			autoplay: {
				delay: 2000,
			},
			pagination: {
				el: ".swiper-pagination-two",
				clickable: true,
			},
		});
	}
	if (jQuery('.blog-slideshow').length > 0) {
		var swiper = new Swiper(".mySwiper", {
			spaceBetween: 10,
			slidesPerView: 4,
			freeMode: true,
			watchSlidesProgress: true,
		  });
		  var swiper2 = new Swiper(".galleryswiper2", {
			spaceBetween: 10,
			navigation: {
			  nextEl: ".swiper-button-next",
			  prevEl: ".swiper-button-prev",
			},
			thumbs: {
			  swiper: swiper,
			},
		  });
	}

	// StorySwiper
	var StorySwiper = function () {
		if (jQuery('.status-swiper').length > 0) {
			var Statusswiper = new Swiper('.status-swiper', {
				loop: true,
				spaceBetween: 0,
				slidesPerView: "auto",
				speed: 1500,
				effect: "fade",
				// autoplay: {
				// 	delay: 2000,
				// },
				pagination: {
					el: ".status-pagination",
					clickable: true,
				},
			});

			jQuery('.post-status-btn').on('click', function () {
				Statusswiper.slideTo(0); 
				Statusswiper.autoplay.start(); 
			});
		}
	};

	
})

	if (jQuery('.blog-single').length > 0) {
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
	}

	if ($('.galley-thumb-swiper').length > 0 && $('.galley-swiper').length > 0) {
		var swiper = new Swiper(".galley-thumb-swiper", {
		loop: false,
		spaceBetween: 10,
		slidesPerView: 4,
		freeMode: true,
		watchSlidesProgress: true,
		});
	
		var swiper2 = new Swiper(".galley-swiper", {
		loop: true,
		spaceBetween: 10,
		thumbs: {
			swiper: swiper,
		},
		});
	}


	


/* Document .ready END */