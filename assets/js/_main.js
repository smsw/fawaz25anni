/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function ($) {
    // Navigation
    $(window).scroll(function () {
        if ($(window).scrollTop() > 10) {
            $(".navbar").addClass('scrolling');
        } else {
            $(".navbar").removeClass('scrolling');
        }
    });

    var menuOpen = false;

    // Sidebar open and close
    $(function () {
        var body = $("body"),
            wrapper = $("#wrapper-main"),
            mainToggle = $(".js_toggle_side_menu"),
            closeToggle = $(".js_close_side_menu");

        mainToggle.on('click', function () {
            if (!body.hasClass('toggled')) {
                body.addClass('toggled');
                closeToggle.fadeIn(500);
            }else {

                //closeMenu();
            }
        });

        // Close Handlers
        closeToggle.on('click', function (){
            closeMenu();
        });

        wrapper.on('click', function (){
            //closeMenu();
        });

        function closeMenu() {
            body.removeClass('toggled');
            closeToggle.hide();
        }
    });

    // Hover animation on icons
    $(".circle-stats li").hover(function () {
        $('.circle', this).animateCSS('swing');
    });

    $(".js_animate_brands").hover(function () {
        $('.brands').animateCSS('swing');
    });

    $(".js_animate_stores").hover(function () {
        $('.stores').animateCSS('bounce');
    });

    $(".js_animate_investors").hover(function () {
        $('.investors').animateCSS('flip');
    });

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
    var Roots = {
        // All pages
        common: {
            init: function () {
                // JavaScript to be fired on all pages

                // Scroll To Top
                $('.backToTop').click('on', function (e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);
                });

                if ('addEventListener' in document) {
                    document.addEventListener('DOMContentLoaded', function () {
                        FastClick.attach(document.body);
                    }, false);
                }
            
            }
        },

        // Home page
        home: {
            init: function () {
                // JavaScript to be fired on the home page
                new WOW().init();
            
                // 25yr anniversary splash screen
                var Splash = (function () {
                  var splash_open = false;

                  var add_splash_screen = function () {
                    $('body').append('<span class="splash_container"><span class="helper"></span><img src="http://www.fawazalhokairfashion.com/wp-content/uploads/2015/06/25years-v4-proper-noBros.png"></span>');
                  };

                  var init_splash = function () {
                    $('body').addClass('splash_screen');
                    $('#wrapper-main, footer').animate({opacity: 0}, 1000, function () {
                      $('.splash_container').fadeIn('fast');
                    });
                    splash_open = true;
                  };

                  var clear_splash_screen = function () {
                    $('#wrapper-main, footer').animate({opacity: 1}, 1);
                    $('.splash_container').fadeOut('slow', function () {
                      $('body').removeClass('splash_screen');
                      splash_open = false;
                    });
                  };

                  var start_time = function () {
                    $('.splash_container').on('click', function () {
                      clear_splash_screen();
                    });

                    var timer = setTimeout(function () {
                      clear_splash_screen();
                    }, 5000);
                    return timer;
                  };
        
                  return {
                    add_elements: add_splash_screen,
                    init: init_splash,
                    start_time: start_time
                  };
                }());
                Splash.add_elements();
                Splash.init();
                Splash.start_time();

                $('#slider').flexslider({
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    animationLoop: true,
                    slideshow: true,
                    slideshowSpeed: 4000,
                    manualControls: ".flex-next"
                });

                $('.hover').hover(
                    function () {
                        $(this).find('.text').removeClass('animated fadeOut').addClass('animated fadeIn');
                    },
                    function () {
                        $(this).find('.text').removeClass('fadeIn').addClass('fadeOut');
                });

                // Stop ugly un-ordered images appearing.
                $('#brands-slider').toggleClass('hidden').fadeIn(1000);

                // Now unhidden, start the ticking!
                $('.bxslider').bxSlider({
                    minSlides: 1,
                    maxSlides: 6,
                    slideWidth: 200,
                    slideMargin: 50,
                    ticker: true,
                    speed: 90000
                });
            }
        },


        // About us page, note the change from about-us to about_us.
        about_us: {
            init: function () {
                // JavaScript to be fired on the about us page
            }
        },

        category: {
            init: function(){
                $(function () {
                    var initialHeight = $('.intro').height();
                    $(this).find('.hover').css('height', initialHeight);

                    $('.box').hover(
                        function () {
                            var el = $(this).find('.hover'),
                                curHeight = el.height(),
                                autoHeight = el.css('height', 'auto').height();
                            el.height(curHeight).animate({ height: autoHeight }, 0);
                            $(".intro p").css("padding-bottom", "0");
                            $(".expand").removeClass('animated fadeOut').addClass("animated fadeIn").css("opacity", "1");
                        },
                        function () {
                            $(this).find('.hover').css('height', initialHeight);
                            $('.expand').removeClass('animated fadeIn').css("opacity", "0");
                            $('.intro p').css('padding-bottom', '50px');
                        }
                    );
                });
            }
        }
    };

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function (func, funcname, args) {
            var namespace = Roots;
            funcname = (funcname === undefined) ? 'init' : funcname;
            if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            UTIL.fire('common');

            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                UTIL.fire(classnm);
            });
        }
    };

    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
