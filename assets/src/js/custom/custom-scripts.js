(function($) {

    'use strict';

    $(document).ready(function() {

        // Trigger WooCommerce cart fragments.

        $(document.body).trigger('wc_fragment_refresh');
        

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
        ===================================================
        = Remove tooltip from woocommerce product single 
        ===============================================================
        */

        if ($('body').hasClass('single-product')) {

            $('.entry-summary .wish-list-button').removeAttr('data-tippy-content');
            $('.entry-summary .wish-list-button').removeClass('os-tooltip');

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
        ====================
        = WooCommerce  cart events
        ============================
        */

        iziToast.settings({

            class: 'izitoast-notification',
            position: 'topRight',
            theme: 'light',
            zindex: 99999999,
            rtl: false,
        });


        if (jQuery('body').hasClass('rtl')) {

            iziToast.settings({

                rtl: true,
                position: 'topLeft',
            });

        }

        if (orchid_store_obj.added_to_cart_message) {

            $(document.body).on('added_to_cart', function() {

                iziToast.success({

                    message: orchid_store_obj.added_to_cart_message,

                });

            });
        }

        if (orchid_store_obj.cart_updated_message) {

            $(document.body).on('updated_cart_totals', function() {

                iziToast.info({

                    message: orchid_store_obj.cart_updated_message,

                });
            });
        }

        if (orchid_store_obj.removed_from_cart_message) {

            $(document.body).on('removed_from_cart', function() {

                iziToast.success({

                    message: orchid_store_obj.removed_from_cart_message,

                });
            });
        }

        /*
        ============================
        = Mini cart toggle
        ===================================
        */

        var openCart = $('.mini-cart-open');

        $('body').on('click', '.trigger-mini-cart', function(e) {

            openCart.toggleClass('display-block');
        });


        /*
        ===========================
        = Woocommerce input type number
        =======================================
        */

        if ( orchid_store_obj.displayPlusMinusBtns == '1' ) {            

            $('body').on('click', 'button.woo-quantity-plus, button.woo-quantity-minus', function() {
                
                var quantityFieldEle = $(this).siblings('.quantity').find('.qty');

                var qtyVal = parseFloat(quantityFieldEle.val());

                qtyVal = ( ! isNaN(qtyVal) ) ? qtyVal : parseFloat(0);

                var qtyMax = parseFloat(quantityFieldEle.attr('max'));
                var qtyMin = parseFloat(quantityFieldEle.attr('min'));
                var qtyStep = parseFloat(quantityFieldEle.attr('step'));

                var qtyValSplit = String(qtyVal).split('.');
                var qtyStepSplit = String(qtyStep).split('.');

                var qtyValPrecision = ( qtyValSplit[1] ) ? qtyValSplit[1].length : parseFloat(0);
                var qtyStepPrecision = ( qtyStepSplit[1] ) ? qtyStepSplit[1].length : parseFloat(0);

                var precision = ( qtyValPrecision > qtyStepPrecision ) ? qtyValPrecision : qtyStepPrecision;

                // Change the value if plus or minus

                if ( $(this).is('.woo-quantity-plus') ) {

                    if ( isNaN(qtyMax)) {
                        quantityFieldEle.val( parseFloat(( qtyVal + qtyStep )).toFixed(precision) );
                    } else {
                        if ( qtyVal < qtyMax ) {
                            var increVal = parseFloat( qtyVal + qtyStep ).toFixed(precision);
                            if ( increVal >= qtyMax ) {
                                increVal = qtyMax;
                            }
                            quantityFieldEle.val( increVal );
                        } 
                        if ( qtyMax === qtyVal ) {
                            quantityFieldEle.val(qtyMax);
                        }
                    }
                }
                

                if ( $(this).is('.woo-quantity-minus') ) {
                    if ( qtyVal == qtyMin ) {
                        quantityFieldEle.val(qtyMin);
                    }
                    if ( qtyVal > qtyMin ) {
                        var decreVal = parseFloat( qtyVal - qtyStep ).toFixed(precision);
                        if ( decreVal <= qtyMin ) {
                            decreVal = qtyMin;
                        }
                        quantityFieldEle.val( decreVal );
                    }
                }
            });
        }


        /*
        ===========================
        = Navigations
        ====================================
        */

        $('#site-navigation .menu-item-has-children > .menu-link').append('<span class="sub-toggle visible-desktop"> <i class="bx bx-chevron-down"></i> </span>');

        $('#site-navigation .page_item_has_children > .menu-link').append('<span class="sub-toggle visible-desktop"> <i class="bx bx-chevron-down"></i> </span>');

        // add to li
        $('#site-navigation .menu-item-has-children').append('<span class="sub-toggle visible-tablet"> <i class="bx bx-chevron-down"></i> </span>');

        $('#site-navigation .page_item_has_children').append('<span class="sub-toggle visible-tablet"> <i class="bx bx-chevron-down"></i> </span>');

        // add to anchour

        $('.category-navigation .menu-item-has-children > .menu-link').append('<span class="sub-toggle visible-desktop"> <i class="bx bx-chevron-right"></i> </span>');

        $('.category-navigation .page_item_has_children > .menu-link').append('<span class="sub-toggle visible-desktop"> <i class="bx bx-chevron-right"></i> </span>');

        // add to li 

        $('.category-navigation .menu-item-has-children').append('<span class="sub-toggle visible-tablet"> <i class="bx bx-chevron-down"></i> </span>');

        $('.category-navigation .page_item_has_children').append('<span class="sub-toggle visible-tablet"> <i class="bx bx-chevron-down"></i> </span>');

        // Count & add class in Mega Menu Orchid store Theme

        var megaSubMenu = $('.masterheader .menu-item-has-mega-children > ul');

        megaSubMenu.addClass('mega-menu-sub-menu');

        var megaMenus = $('.masterheader .menu-item-has-children.menu-item-has-mega-children');

        if ( megaMenus.length > 0 ) {
            megaMenus.each( function( index ) {
                var currentMegaMenu = $(this);
                var megaSubmenu = currentMegaMenu.find('ul.mega-menu-sub-menu');
                if ( megaSubmenu.length > 0 ) {
                    var submenuLi = megaSubmenu.find('li.mega-sub-menu-group');
                    if ( submenuLi.length > 0 ) {
                        megaSubMenu.addClass('mega-menu-column-' + submenuLi.length);
                    }
                }
            } );
        }

        $('body').on('click', '#site-navigation .sub-toggle', function() {

            $(this).toggleClass('active-submenu');

            $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('medium');

            $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('medium');

            if($(this).hasClass('active-submenu')) {

                $(this).find('.bx').removeClass('bx-chevron-down').addClass('bx bx-chevron-up');

            } else {

                $(this).find('.bx').removeClass('bx-chevron-up').addClass('bx-chevron-down');
            }

        });

        $('body').on('click', '.masterheader .mobile-menu-toggle-btn', function(e){

            $('body').toggleClass('menu-toggle-active'); // add class to body
        });

        $('body').on('click', '.mobile-navigation-mask, .trigger-mob-nav-close', function(e){

            $('body').removeClass('menu-toggle-active'); // remove class from body
        });


        $('body').on('click', '.menu-item a[href="#"]', function(e) {

            e.preventDefault(); // prevent empty links clicks
        });


        // Category Navigation at header 

        $('body').on('click', '.cat-nav-trigger', function(e) {

            $('body').toggleClass('cat-nav-at-navigation-active'); // add class to body

        });


        $('body').on('click', '.mobile-header .sub-toggle', function() {

            $(this).toggleClass('active-submenu');

            $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('medium');

            $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('medium');

            if($(this).hasClass('active-submenu')) {

                $(this).find('.bx').removeClass('bx-chevron-down').addClass('bx-chevron-up');

            } else {

                $(this).find('.bx').removeClass('bx-chevron-up').addClass('bx-chevron-down');
            }

        });


        // mobile header search 

        $('body').on('click', '.mobile-header .search-toggle', function(e){

            $('body').toggleClass('mobile-header-search-active'); // toggle class to display & hide mobile header search
        });
        

        /*
        ===========================
        = Sticky sidebar
        ==========================================
        */


        $("#customer_details .col-1").addClass("sticky-portion"); // woo-commerce checkout page
        $("#customer_details .col-2").addClass("sticky-portion"); // woo-commerce checkout page

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

        $('.carousel-preloader').hide();

        var owlrtl;

        if (jQuery('body').hasClass('rtl')) {

            owlrtl = true

        } else {

            owlrtl = false;
        }

        // banner style 1 

        jQuery('.owl-carousel-1').owlCarousel({

            rtl: owlrtl,
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

        var mobile_products_col = orchid_store_obj.product_cols_on_mobile;

        jQuery('.owl-carousel-2').owlCarousel({

            rtl: owlrtl,
            loop: true,
            lazyLoad: false,
            margin: 30,
            smartSpeed: 1000,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    margin: 5,
                    items: mobile_products_col
                },
                400: {
                    margin: 5,
                    items: mobile_products_col
                },
                575: {
                    margin: 5,
                    items: mobile_products_col
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
        = Product category filter tab widget
        =======================================
        */

        $('div.tab-content').hide();

        $('div#tab1').show('fast');

        $('body').on('click', '.tab-nav ul li a', function(e) {

            e.preventDefault();

            var parentLi = $(this).parent();

            var activeA = parentLi.siblings().find('a.active');

            var activeARel = activeA.attr('rel');

            console.log( activeARel );

            $(this).parents('div.tab-wrapper').find('div#' + activeARel).hide();

            activeA.removeClass('active');

            $(this).addClass('active');

            var currentARel = $(this).attr('rel');

            $(this).parents('div.tab-wrapper').find('div#' + currentARel).show();

        });


        /*
        ==========================
        = Back to top
        =======================================
        */

        $('body').on('click', ".orchid-backtotop", function(event) {

            event.preventDefault();

            $("html, body").animate({ scrollTop: 0 }, "slow");

            return false;
        });


        // Window scroll event

        if( orchid_store_obj.scroll_top == '1' ) {

            $(window).scroll(function() {

                var height = $(window).scrollTop();

                if (height > 600) {

                    $('.orchid-backtotop').fadeIn('slow');

                } else {

                    $('.orchid-backtotop').fadeOut('slow');
                }
            });    
        }   


        // Update Wishlist item counts

        $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
                action: 'orchid_store_update_wishlist_count'
            }, function( data ) {
                $('.wishlist-items-count').html( data.count );
            } );
        });

    });

})(jQuery);