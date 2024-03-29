(function ($) {

    'use strict';

    $(document).ready(function () {

        // Trigger WooCommerce cart fragments.

        $(document.body).trigger('wc_fragment_refresh');

        // Compare button functionality.
        orchidStoreAddonifyCompare();
        orchidStoreAddonifyWishlist();

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

        if (typeof tippy !== 'undefined') {

            tippy('.os-tooltip', {

                content: "",
                delay: 50,
                arrow: true,
                arrowType: 'sharp',
                size: 'large',
                duration: 300,
                animation: 'scale',
                placement: 'left-start',
            });
        }

        /*
        ====================
        = WooCommerce  cart events
        ============================
        */
        //console.log(orchid_store_obj);
        if (orchid_store_obj.isCartMessagesEnabled === '1') {

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

                $(document.body).on('added_to_cart', function () {

                    iziToast.success({

                        message: orchid_store_obj.added_to_cart_message,

                    });

                });
            }

            if (orchid_store_obj.cart_updated_message) {

                $(document.body).on('updated_cart_totals', function () {

                    iziToast.info({

                        message: orchid_store_obj.cart_updated_message,

                    });
                });
            }

            if (orchid_store_obj.removed_from_cart_message) {

                $(document.body).on('removed_from_cart', function () {

                    iziToast.success({

                        message: orchid_store_obj.removed_from_cart_message,

                    });
                });
            }
        }

        /*
        ============================
        = Mini cart toggle
        ===================================
        */

        var openCart = $('.mini-cart-open');

        $('body').on('click', '.trigger-mini-cart', function (e) {

            if (orchid_store_obj.cartDisplay == 'default') {
                openCart.toggleClass('display-block');
            }

            if (orchid_store_obj.cartDisplay == 'floating_cart') {
                document.body.classList.add('adfy__woofc-visible');
            }
        });


        /*
        ===========================
        = Woocommerce input type number
        =======================================
        */

        if (orchid_store_obj.displayPlusMinusBtns == '1') {

            $('body').on('click', 'button.woo-quantity-plus, button.woo-quantity-minus', function () {

                var quantityFieldEle = $(this).siblings('.quantity').find('.qty');

                var qtyVal = parseFloat(quantityFieldEle.val());

                qtyVal = (!isNaN(qtyVal)) ? qtyVal : parseFloat(0);

                var qtyMax = parseFloat(quantityFieldEle.attr('max'));
                var qtyMin = parseFloat(quantityFieldEle.attr('min'));
                var qtyStep = parseFloat(quantityFieldEle.attr('step'));

                var qtyValSplit = String(qtyVal).split('.');
                var qtyStepSplit = String(qtyStep).split('.');

                var qtyValPrecision = (qtyValSplit[1]) ? qtyValSplit[1].length : parseFloat(0);
                var qtyStepPrecision = (qtyStepSplit[1]) ? qtyStepSplit[1].length : parseFloat(0);

                var precision = (qtyValPrecision > qtyStepPrecision) ? qtyValPrecision : qtyStepPrecision;

                // Change the value if plus or minus

                if ($(this).is('.woo-quantity-plus')) {

                    if (isNaN(qtyMax)) {
                        quantityFieldEle.val(parseFloat((qtyVal + qtyStep)).toFixed(precision));
                    } else {
                        if (qtyVal < qtyMax) {
                            var increVal = parseFloat(qtyVal + qtyStep).toFixed(precision);
                            if (increVal >= qtyMax) {
                                increVal = qtyMax;
                            }
                            quantityFieldEle.val(increVal);
                        }
                        if (qtyMax === qtyVal) {
                            quantityFieldEle.val(qtyMax);
                        }
                    }
                }


                if ($(this).is('.woo-quantity-minus')) {
                    if (qtyVal == qtyMin) {
                        quantityFieldEle.val(qtyMin);
                    }
                    if (qtyVal > qtyMin) {
                        var decreVal = parseFloat(qtyVal - qtyStep).toFixed(precision);
                        if (decreVal <= qtyMin) {
                            decreVal = qtyMin;
                        }
                        quantityFieldEle.val(decreVal);
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

        if (megaMenus.length > 0) {
            megaMenus.each(function (index) {
                var currentMegaMenu = $(this);
                var megaSubmenu = currentMegaMenu.find('ul.mega-menu-sub-menu');
                if (megaSubmenu.length > 0) {
                    var submenuLi = megaSubmenu.find('li.mega-sub-menu-group');
                    if (submenuLi.length > 0) {
                        megaSubMenu.addClass('mega-menu-column-' + submenuLi.length);
                    }
                }
            });
        }

        $('body').on('click', '#site-navigation .sub-toggle', function () {

            $(this).toggleClass('active-submenu');

            $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('medium');

            $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('medium');

            if ($(this).hasClass('active-submenu')) {

                $(this).find('.bx').removeClass('bx-chevron-down').addClass('bx bx-chevron-up');

            } else {

                $(this).find('.bx').removeClass('bx-chevron-up').addClass('bx-chevron-down');
            }

        });

        $('body').on('click', '.masterheader .mobile-menu-toggle-btn', function (e) {

            $('body').toggleClass('menu-toggle-active'); // add class to body
        });

        $('body').on('click', '.mobile-navigation-mask, .trigger-mob-nav-close', function (e) {

            $('body').removeClass('menu-toggle-active'); // remove class from body
        });


        $('body').on('click', '.menu-item a[href="#"]', function (e) {

            e.preventDefault(); // prevent empty links clicks
        });


        // Category Navigation at header 
        $('body').on('click', '.cat-nav-trigger', function (e) {

            $('body').toggleClass('cat-nav-at-navigation-active'); // add class to body

        });


        $('body').on('click', '.mobile-header .sub-toggle', function () {

            $(this).toggleClass('active-submenu');

            $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('medium');

            $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('medium');

            if ($(this).hasClass('active-submenu')) {

                $(this).find('.bx').removeClass('bx-chevron-down').addClass('bx-chevron-up');

            } else {

                $(this).find('.bx').removeClass('bx-chevron-up').addClass('bx-chevron-down');
            }

        });

        // mobile header search 
        $('body').on('click', '.mobile-header .search-toggle', function (e) {

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

        let mobile_products_col = orchid_store_obj.product_cols_on_mobile;

        $('.carousel-preloader').hide();

        let owlrtl;

        if (jQuery('body').hasClass('rtl')) {

            owlrtl = true

        } else {

            owlrtl = false;
        }

        jQuery('.owl-carousel-1').owlCarousel({
            rtl: owlrtl,
            items: 1,
            loop: true,
            lazyLoad: true,
            margin: 0,
            smartSpeed: 1000,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
        });

        jQuery('.owl-carousel-2').owlCarousel({
            rtl: owlrtl,
            loop: true,
            lazyLoad: true,
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
                    items: 1
                },
                340: {
                    margin: 5,
                    items: 1
                },
                341: {
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

        $('body').on('click', '.tab-nav ul li a', function (e) {

            e.preventDefault();

            var parentLi = $(this).parent();

            var activeA = parentLi.siblings().find('a.active');

            var activeARel = activeA.attr('rel');

            //console.log(activeARel);

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

        $('body').on('click', ".orchid-backtotop", function (event) {

            event.preventDefault();

            $("html, body").animate({ scrollTop: 0 }, "slow");

            return false;
        });

        if (orchid_store_obj.scroll_top == '1') {

            $(window).scroll(function () {

                var height = $(window).scrollTop();

                if (height > 600) {

                    $('.orchid-backtotop').fadeIn('slow');

                } else {

                    $('.orchid-backtotop').fadeOut('slow');
                }
            });
        }

        function orchidStoreAddonifyWishlist() {

            let icons = {
                "initial": '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"/></svg>',
                "added": '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"><path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"/></svg>',
            }

            // Prevent default behaviour of add to compare button.
            $(".os-addtowishlist-btn").on('click', function (e) {
                e.preventDefault();
            });

            if (!orchid_store_obj.isUserLoggedIn) {

                let wishlist, productsInWishlist;
                let wishlistLocalStorageVal = localStorage.getItem('addonify-wishlist_' + orchid_store_obj.homeUrl + '_product_ids');

                if (wishlistLocalStorageVal !== null) {
                    wishlist = JSON.parse(localStorage.getItem('addonify-wishlist_' + orchid_store_obj.homeUrl + '_product_ids'));
                    productsInWishlist = wishlist[0].product_ids;
                }

                if (productsInWishlist !== null && productsInWishlist !== undefined && productsInWishlist.length > 0) {
                    $.map(productsInWishlist, function (value, index) {
                        if ($(".os-addtowishlist-btn[data-product_id='" + value + "']").length > 0) {
                            let osAddtoWishlistButton = $(".os-addtowishlist-btn[data-product_id='" + value + "']");
                            osAddtoWishlistButton.attr('data-tippy-content', orchid_store_obj.alreadyInWishlistText);
                            osAddtoWishlistButton.find('.w-icon').html(icons['added']);
                        }
                    });
                    $('.wishlist-items-count').html(productsInWishlist.length);
                }
            }

            // Update Wishlist item counts
            $(document).on('added_to_wishlist removed_from_wishlist', function () {
                $.get(orchid_store_obj.ajax_url, {
                    action: 'orchid_store_update_wishlist_count'
                }, function (data) {
                    $('.wishlist-items-count').html(data.count);
                });
            });

            $(document).on('addonify_added_to_wishlist', function (event, data) {

                if ($(".os-addtowishlist-btn[data-product_id='" + data.productID + "']")) {
                    let osAddtoWishlistButton = $(".os-addtowishlist-btn[data-product_id='" + data.productID + "']");

                    if (osAddtoWishlistButton.length > 0) {

                        osAddtoWishlistButton.find('.w-icon').html(icons['added']);

                        // Modify the tooltip content.
                        // Ref: https://atomiks.github.io/tippyjs/v6/tippy-instance/
                        // Ref: https://atomiks.github.io/tippyjs/v5/methods/#setcontent
                        let tippyInstance = osAddtoWishlistButton[0]._tippy;

                        if (tippyInstance) {

                            tippyInstance.setContent(orchid_store_obj.addedToWishlistText);
                            osAddtoWishlistButton.attr('data-tippy-content', orchid_store_obj.addedToWishlistText);
                        }
                    }
                }

                if (orchid_store_obj.isUserLoggedIn) {
                    $.get(orchid_store_obj.ajax_url, {
                        action: 'orchid_store_update_wishlist_count'
                    }, function (data) {
                        $('.wishlist-items-count').html(data.count);
                    });
                } else {
                    let wishlist = JSON.parse(localStorage.getItem('addonify-wishlist_' + orchid_store_obj.homeUrl + '_product_ids'));
                    let productsInWishlist = wishlist[0].product_ids;
                    $('.wishlist-items-count').html(productsInWishlist.length);
                }
            });

            $(document).on('addonify_removed_from_wishlist', function (event, data) {
                if ($(".os-addtowishlist-btn[data-product_id='" + data.productID + "']")) {
                    let osAddtoWishlistButton = $(".os-addtowishlist-btn[data-product_id='" + data.productID + "']");

                    if (osAddtoWishlistButton.length > 0) {

                        osAddtoWishlistButton.find('.w-icon').html(icons['initial']);

                        // Modify the tooltip content.
                        // Ref: https://atomiks.github.io/tippyjs/v6/tippy-instance/
                        // Ref: https://atomiks.github.io/tippyjs/v5/methods/#setcontent
                        let tippyInstance = osAddtoWishlistButton[0]._tippy;

                        if (tippyInstance) {

                            tippyInstance.setContent(orchid_store_obj.addToWishlistText);
                            osAddtoWishlistButton.attr('data-tippy-content', orchid_store_obj.addToWishlistText);
                        }
                    }
                }

                if (orchid_store_obj.isUserLoggedIn) {
                    $.get(orchid_store_obj.ajax_url, {
                        action: 'orchid_store_update_wishlist_count'
                    }, function (data) {
                        $('.wishlist-items-count').html(data.count);
                    });
                } else {
                    let wishlist = JSON.parse(localStorage.getItem('addonify-wishlist_' + orchid_store_obj.homeUrl + '_product_ids'));
                    $('.wishlist-items-count').html(wishlist.length);
                }
            });
        }

        /**
         * Modify the compare button when product is added and removed from the compare list.
         * 
         * @since 1.4.2
         */
        function orchidStoreAddonifyCompare() {

            let icons = {
                'initial': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M12,14.773a2.976,2.976,0,0,1-1.531-.425L.485,8.357a1,1,0,0,1,0-1.714L10.469.652a2.973,2.973,0,0,1,3.062,0l9.984,5.991a1,1,0,0,1,0,1.714l-9.984,5.991A2.976,2.976,0,0,1,12,14.773ZM2.944,7.5,11.5,12.633a.974.974,0,0,0,1,0L21.056,7.5,12.5,2.367a.974.974,0,0,0-1,0h0Z"/></svg>',
                'added': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z"/><path d="M.485,8.357l9.984,5.991a2.97,2.97,0,0,0,3.062,0l9.984-5.991a1,1,0,0,0,0-1.714L13.531.652a2.973,2.973,0,0,0-3.062,0L.485,6.643a1,1,0,0,0,0,1.714Z"/></svg>',
            }

            // Prevent default behaviour of add to compare button.
            $(".os-addtocompare-btn").on('click', function (e) {
                e.preventDefault();
            });

            // Get products in the compare list from localstorage.
            let comparelist = JSON.parse(localStorage.getItem('addonify_compare_products_plugin_product_ids' + '_' + orchid_store_obj.homeUrl));
            //console.log(comparelist);
            // Change the icon of buttons if products are in the compare list.
            if (comparelist !== null) {
                if (comparelist.length > 0) {
                    $.map(comparelist, function (value, index) {
                        if ($(".os-addtocompare-btn[data-product_id='" + value + "']").length > 0) {
                            $(".os-addtocompare-btn[data-product_id='" + value + "']").find('.icon').html(icons['added']);
                        }
                    });
                }
            }

            // Change the icon of button if a product is added into the compare list.
            $(document).on('addonify_added_to_comparelist', function (event, data) {
                if ($(".os-addtocompare-btn[data-product_id='" + data.productID + "']")) {
                    $(".os-addtocompare-btn[data-product_id='" + data.productID + "']").find('.icon').html(icons['added']);
                }
            });

            // Change the icon of button if a product is removed from the compare list. Remove 'disabled' attribute and 'selected' class.
            $(document).on('addonify_removed_from_comparelist', function (event, data) {
                if ($(".os-addtocompare-btn[data-product_id='" + data.productID + "']")) {
                    let addToCompareBtn = $(".os-addtocompare-btn[data-product_id='" + data.productID + "']");
                    addToCompareBtn.removeClass('selected').removeAttr('disabled');
                    addToCompareBtn.find('.icon').html(icons['initial']);
                }
            });
        }

    });

})(jQuery);