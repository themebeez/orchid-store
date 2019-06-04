(function($) {

    'use strict';

    // Document ready function

    $(document).ready(function() {


        /*
        ====================
        = Init wow js
        ============================
        */

        var wow = new WOW({

            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: -150, // distance to the element when triggering the animation (default is 0)
            mobile: false, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
            scrollContainer: null // optional scroll container selector, otherwise use window
        });
        wow.init();

        if ($(window).width() <= 1000) {

            $(".wow").removeClass("wow");
            $(".osfadeInUp").removeClass("osfadeInUp");
        }


        /*
        =========================
        = Tooltip
        ==================================
        */

        tippy('.os-tooltip', {

            content: "",
            delay: 50,
            arrow: true,
            arrowType: 'sharp',
            size: 'large',
            duration: 300,
            animation: 'scale',
            placement: 'left-start',
        })




        /*
        =============================
        = Nice select
        =======================================
        */


        $('select').niceSelect();



        /*
        ============================
        = Mini cart toggle
        ===================================
        */


        $('.trigger-mini-cart').on('mouseover', function(e) {

            $( ".mini-cart-open" ).toggle();

        });


        /*
        ===========================
        = Main navigation
        ====================================
        */


        $('.menu-toggle').on('click', function(e) {

            $('#site-navigation').slideToggle('medium');

            $('body').toggleClass('menu-toggle-active'); // add class to body

        });

        $('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-caret-down" aria-hidden="true"></i> </span>');

        $('#site-navigation .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-caret-down" aria-hidden="true"></i> </span>');


        $('#site-navigation .sub-toggle').on('click', function() {

            $(this).toggleClass('active-submenu');

            $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('medium');

            $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('medium');

            if ($(this).hasClass('active-submenu')) {

                $(this).find('.fa').removeClass('fa-caret-down').addClass('fa-caret-up');

            } else {

                $(this).find('.fa').removeClass('fa-caret-up').addClass('fa-caret-down');
            }

        });


        $('.menu-item a[href="#"]').on('click', function(e) {

            e.preventDefault(); // prevent empty links clicks
        });


        /*
        ============================
        = Tab at theme single
        ==========================================
        */

        $('div.tab-content').hide();

        $('div#tab1').show('fast');

        $('body').on('click', '.tab-nav ul li a', function(e) {

            e.preventDefault();

            var parentLi = $(this).parent();

            var activeA = parentLi.siblings().find('a.active');

            var activeARel = activeA.attr('rel');

            $('.tab-wrapper').find('div#' + activeARel).hide();

            activeA.removeClass('active');

            $(this).addClass('active');

            var currentARel = $(this).attr('rel');

            $('.tab-wrapper').find('div#' + currentARel).show();

        });



        /*
        ===========================
        = Sticky sidebar
        ==========================================
        */

        if (window.matchMedia("(max-width: 991px)").matches) {

            $(".col-lg-8").removeClass("sticky-portion");

        } else {

            $('.sticky-portion').theiaStickySidebar({

                additionalMarginTop: 30

            });

        }



        /*
        =======================
        = Owl carousels 
        ====================================
        */


        // banner style 1 


        jQuery('.owl-carousel-1').owlCarousel({

            items: 1,
            loop: true,
            lazyLoad: false,
            margin: 0,
            smartSpeed: 1000,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
        });


        // product widget 3

        jQuery('.owl-carousel-2').owlCarousel({

            items: 4,
            loop: true,
            lazyLoad: false,
            margin: 30,
            smartSpeed: 1000,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                400: {
                    items: 1
                },
                500: {

                    items: 2
                },
                600: {
                    items: 2
                },
                768: {
                    items: 3
                },
                850: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1050: {

                    items: 3
                },
                1200: {
                    items: 4
                }
            },
        });


        /*
        ==========================
        = Back to top
        =======================================
        */

        // $('body').append('<div id="glaze-toTop"><span>Back to top <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></div>');

        // // Window scroll function

        // $(window).scroll(function() {

        //     var height = $(window).scrollTop();

        //     if (height > 500) {

        //         $('#glaze-toTop').fadeIn();

        //     } else {

        //         $('#glaze-toTop').fadeOut();
        //     }
        // });

        // $("#glaze-toTop").on('click', function(event) {

        //     event.preventDefault();

        //     $("html, body").animate({ scrollTop: 0 }, "slow");

        //     return false;
        // });





        /* 
        =============================
        =
        = Window load function
        =
        =====================================
        */


        $(window).load(function() {






        });

    });

})(jQuery);