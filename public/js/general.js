// equal height
function equalHeight() {
    jQuery.fn.extend({
        equalHeight: function() {
            var top = 0;
            var row = [];
            var classname = ('equalHeight' + Math.random()).replace('.', '');
            jQuery(this).each(function() {
                var thistop = jQuery(this).offset().top;
                if (thistop > top) {
                    jQuery('.' + classname).removeClass(classname);
                    top = thistop;
                }
                jQuery(this).addClass(classname);
                jQuery(this).height('auto');
                var h = (Math.max.apply(null, jQuery('.' + classname).map(function() {
                    return jQuery(this).outerHeight();
                }).get()));
                jQuery('.' + classname).height(h);
            }).removeClass(classname);
        }
    });
    jQuery('.niveshaay-news .niveshaay-news-slider .niveshaay-news-item .niveshaay-news-inner').equalHeight();
    jQuery('.niveshaay-client .niveshaay-client-content .client-content-wrapper .content-wrapper p').equalHeight();
    jQuery('.niveshaay-siksha .siksha-grid-inner h3').equalHeight();
    jQuery('.niveshaay-client .niveshaay-client-content .client-content-wrapper .designation').equalHeight();
    jQuery('.twitter-feeds-section .twitter-content-wrapper').equalHeight();
    jQuery('.research-card-section .research-card-grid .white-card .card-content-wrapper').equalHeight();
    jQuery('.our-team-section .team-slider-wrapper .team-member-wrapper .team-member-inner .member-detail p').equalHeight();
    jQuery('.featured-on .list-wrapper .list-inner-wrapper .list-item ul').equalHeight();
    setTimeout(function() {
        jQuery('.list-catagory-section.niveshaay-research-block .list-catagory-wrapper .list-wrapper .list-inner-wrapper .list-item-wrapper .list-item .item-content-wrapper h3').equalHeight();
        jQuery('.list-catagory-section.niveshaay-research-block .list-catagory-wrapper .list-wrapper .list-inner-wrapper .list-item-wrapper .list-item .item-content-wrapper .item-inner-content p').equalHeight();
        jQuery('.niveshaay-pick-smallcase .smallcase-grid .grid-item .top-block').equalHeight();
        jQuery('.niveshaay-pick-smallcase .smallcase-grid .grid-item .content-block-inner').equalHeight();
    }, 500);
}

function mobileMenu() {
    if (jQuery(window).width() <= 1199) {
        jQuery('.hamburger').unbind('click').click(function() {
            jQuery('html,body').toggleClass('mobile-menu');
            if(jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').length){
                if(jQuery('html,body').hasClass('mobile-menu')){
                    if(jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').hasClass('open')){
                        jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').removeClass('open');
                    }
                    jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').css({
                        opacity: 0,
                        visibility: 'hidden'
                    });
                }
                else{
                    jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').removeAttr('style');
                }
            }
        });
    } else {
        jQuery('html,body').removeClass('mobile-menu');
    }
}

function addPadding() {
    var headerHeight = jQuery(".niveshaay-header").innerHeight();
    jQuery(".main-wrapper").css("padding-top", headerHeight);

    if (jQuery('.home-page-banner-section .banner-slider-wrapper').length) {
        jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider').css('min-height', jQuery(window).height() - headerHeight);
        jQuery('.home-page-banner-section').addClass('loaded');

    }
}

// Tab to accordion service page
var service_flag = true;
function serviceAccordion(){    
    if(jQuery(window).width() <= 991){
        if(service_flag){
            jQuery('.services-tabbing-section .tab-heading-block li a').each(function(){
                var _id = jQuery(this).attr('data-tab');
                var element = jQuery(".services-tabbing-section .tab-content-block .tab-content-inner[data-id='"+ _id+"']");
				element.detach().appendTo(jQuery(this).parent());				
            }); 
            service_flag = false;                       
        }       
    }
    else{                    
        if(!service_flag){   
            var current_id = jQuery(".services-tabbing-section .tab-heading-block li.active a").attr('data-tab');
            jQuery('.services-tabbing-section .tab-heading-block li').each(function(){
                jQuery(this).children('.tab-content-inner').detach().appendTo('.services-tabbing-section .tab-content-block');
            });
            setTimeout(function() {
                if (current_id == undefined) {
                	console.log('if');
                    jQuery('.services-tabbing-section .tab-content-block .tab-content-inner:first-child').addClass('active');
                    jQuery('.services-tabbing-section .tab-heading-block li:first-child').addClass('active');
                } else {
                    jQuery(".services-tabbing-section .tab-content-block .tab-content-inner[data-id='" + current_id + "']").siblings().removeClass('active');
                    jQuery(".services-tabbing-section .tab-content-block .tab-content-inner[data-id='" + current_id + "']").addClass('active');  
                    jQuery(".services-tabbing-section .tab-heading-block li a[data-tab='" + current_id + "']").parent().addClass('active');
                    jQuery(".services-tabbing-section .tab-heading-block li a[data-tab='" + current_id + "']").parent().siblings().removeClass('active');
                }
                jQuery('.services-tabbing-section .tab-content-block .tab-content-inner').removeAttr('style');
            }, 100);
            service_flag = true;
        }
    }
}

//services-tabbing-section 
function serviceTabbing(){ 
    jQuery('.services-tabbing-section .tab-heading-block a').unbind('click').click(function(e){
		e.preventDefault();  
		if(jQuery(window).width() <= 991){ 
            var _this = jQuery(this).attr("data-tab");
            var _thisvar = jQuery(this);
            jQuery(this).closest("li").siblings().find(".tab-content-inner").slideUp('slow');
            jQuery(".tab-content-inner[data-id='" + _this + "']").stop(true, true).slideToggle();
            jQuery(this).closest('li').find(".tab-content-inner[data-id='" + _this + "']").toggleClass('active');
            jQuery(this).closest('li').siblings().find(".tab-content-inner").removeClass('active');
            jQuery(this).closest("li").toggleClass("active");
            jQuery(this).closest("li").siblings().removeClass("active");  
            if (jQuery('.tab-content-inner.active').find('.slick-slider')) {
                console.log('found-slider');
                jQuery('.tab-content-inner.active .slick-slider').slick('refresh');
                equalHeight();
                setTimeout(function(){
                    jQuery(".tab-content-inner.active").toggleClass('opacity').closest('li').siblings().find('.tab-content-inner').removeClass('opacity');
                },700);
            }   
		}
		else{
             var _this = jQuery(this).attr("data-tab");
            jQuery(".tab-content-inner[data-id='" + _this + "']").siblings().fadeOut(0);
            jQuery(".tab-content-inner[data-id='" + _this + "']").fadeIn(300);
            jQuery(".tab-content-inner[data-id='" + _this + "']").addClass('active').siblings().removeClass('active');
            jQuery(this).closest("li").addClass("active");
            jQuery(this).closest("li").siblings().removeClass("active");			
            if (jQuery('.tab-content-inner.active').find('.slick-slider')) {
                jQuery('.slick-slider').slick('refresh');
                equalHeight();
                setTimeout(function(){
                    jQuery(".tab-content-inner.active").addClass('opacity').siblings().removeClass('opacity');
                },700);
            }					    	    
		}
	});	
}

jQuery(document).ready(function() {
    
    jQuery(".custom-dropdown").select2({
        placeholder: "Select a State/UnionTerritory",
        // minimumResultsForSearch: Infinity,
     });
    mobileMenu();
    addPadding();
    equalHeight();
    serviceAccordion(); 
    serviceTabbing();
    jQuery('html,body').click(function(){
        if(jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').hasClass('open')){
            jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper').removeClass('open');
        }
    });
    jQuery('.niveshaay-header .header-wrapper .user-dropdown-wrapper .dropdown-link').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        jQuery(this).closest('.user-dropdown-wrapper').toggleClass('open');
    });
    
    jQuery('.niveshaay-complaints-section .tab-heading-wrapper span').click(function() {
        jQuery(this).closest('.tab-heading-wrapper').toggleClass('open');
    });
    jQuery('.niveshaay-complaints-section .tab-heading-wrapper .tab-heading li').click(function() {        
        var _id = jQuery(this).attr('data-id');
        jQuery('.niveshaay-complaints-section .tab-heading-wrapper').removeClass('open');
        jQuery(this).addClass('active').siblings().removeClass('active');
        jQuery(".niveshaay-complaints-section .tab-content-wrapper .niveshhay-table-responsive[data-attr='" + _id + "']").addClass('active').siblings().removeClass('active');
        jQuery(this).closest('.niveshaay-complaints-section .tab-heading-wrapper').find('span').text(jQuery(this).text());
    });
    
    // Home page banner slider
    if (jQuery('.home-page-banner-section .banner-slider-wrapper').length) {
        jQuery('.home-page-banner-section .banner-slider-wrapper').slick({
            arrows: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 4000,
            fade: true,
            infinite: true,
            speed: 1000,
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 0.7)',

        });
        setTimeout(function() {
            jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content h2').removeClass("aos-animate");
            jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content .banner-content').removeClass("aos-animate");
            setTimeout(function() {
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider').removeClass("not-visible");
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content h2').addClass("aos-animate");
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content .banner-content').addClass("aos-animate");
            }, 800);
        }, 400);

        jQuery('.home-page-banner-section .banner-slider-wrapper')
            .on('beforeChange', function() {
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider').addClass("not-visible");
                setTimeout(function() {
                    jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content h2').removeClass("aos-animate");
                    jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content .banner-content').removeClass("aos-animate");
                }, 400);
            })
            .on('afterChange', function(event, slick, currentSlide) {
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider').removeClass("not-visible");
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content h2').addClass("aos-animate");
                jQuery('.home-page-banner-section .banner-slider-wrapper .home-banner-slider .home-banner-content .banner-content').addClass("aos-animate");
            });

    }
    //custom-modal
    jQuery('.modal-link').click(function(e){
        e.preventDefault();
        jQuery('body,html').addClass('open-modal');
        var obj=jQuery(this).attr('data-link');
        var activemodal= jQuery("[data-tab='" + obj + "']");
        activemodal.addClass('visible');        
    });
    // jQuery('.signup-page .login-link').click(function(e){
    //    jQuery('#login-modal').addClass('visible');
    // });
    jQuery('.modal-close, .modal-backdrop').click(function(e){
        e.preventDefault();
        jQuery('body,html').removeClass('open-modal');
        jQuery(this).closest('.custom-modal').removeClass('visible');   
    });
    jQuery('.custom-modal').click(function(e){
        e.preventDefault();
        jQuery('body,html').removeClass('open-modal');
        jQuery(this).removeClass('visible');   
    });
    jQuery('.custom-modal .modal-body').click(function(e){
        e.stopPropagation();
        
    });

    //slider-opacity
    equalHeight();

    // Datepicker
    if(jQuery('.datepicker').datepicker){
        jQuery( ".datepicker" ).datepicker({ dateFormat: "dd/mm/yy",changeMonth: true,
        changeYear: true });
    }
    // our-research-slider
    if (jQuery('.niveshaay-research-block .list-inner-wrapper:not(.featured-on)').length) {
        jQuery('.niveshaay-research-block .list-inner-wrapper:not(.featured-on)').slick({
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            autoplay:false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 574,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ]
        });
    }
    if (jQuery('.niveshaay-research-block .list-inner-wrapper.featured-on').length) {
        jQuery('.niveshaay-research-block .list-inner-wrapper.featured-on').slick({
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            autoplay:true,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 574,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ]
        });
    }

    
    
    // pick-smallcase-slider
    if (jQuery('.niveshaay-pick-smallcase .smallcase-grid').length) {
        jQuery('.niveshaay-pick-smallcase .smallcase-grid').slick({
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            autoplay:true,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 574,
                    settings: {
                        slidesToShow: 1,
                        adaptiveHeight:true,
                    },
                },
            ]
        });
    }
    // our-team-slider
    if (jQuery('.our-team-section .team-slider-wrapper').length) {
        jQuery('.our-team-section .team-slider-wrapper').slick({
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            autoplay:true,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 574,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ]
        });
    }
    // our-client-slider
    if (jQuery('.niveshaay-client .our-clients-slider').length) {
        jQuery('.niveshaay-client .our-clients-slider').slick({
            arrows: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true,
            autoplay:true,
            responsive: [{
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                }
            }, ]
        });
    }
    //in-the-news-slider
    if (jQuery('.niveshaay-news .niveshaay-news-slider').length) {
        jQuery('.niveshaay-news .niveshaay-news-slider').slick({
            slidesToShow: 5,
            dots: true,
            arrows: false,
            autoplay: true,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }
    //twitter-feeds-slider
    if (jQuery('.twitter-feeds-section .twitter-feeds-slider').length) {
        jQuery('.twitter-feeds-section .twitter-feeds-slider').slick({
            slidesToShow: 4,
            dots: true,
            arrows: true,
            infinite: true,
            autoplay:true,
            responsive: [{
                    breakpoint: 1280,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 574,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
    }
});
jQuery(window).load(function() {
    setTimeout(function() {
        equalHeight();
    }, 1000);
    AOS.init();
});

jQuery(window).on('resize', function() {
    mobileMenu();
    addPadding();     
    setTimeout(function(){
        serviceAccordion();  
        serviceTabbing();
    },100);
    setTimeout(function() {
        equalHeight();              
    }, 500);
});