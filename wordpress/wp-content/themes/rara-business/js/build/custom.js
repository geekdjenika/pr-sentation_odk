jQuery(document).ready(function($) {
    if( rb_localize_data.animation ){
        new WOW().init();
    }

    var winWidth = $(window).width();

    $(".skills").addClass("active");
    $(".skills .skill .skill-bar span").each(function() {
        $(this).animate({
            "width": $(this).parent().attr("data-bar") + "%"
        }, 1000);
        $(this).append('<b>' + $(this).parent().attr("data-bar") + '%</b>');
    });
    setTimeout(function() {
        $(".skills .skill .skill-bar span b").animate({ "opacity": "1" }, 1000);
    }, 2000);
     
    $('<button class="submenu-toggle"><i class="fa fa-angle-down"></i></button>').insertAfter($('.mobile-navigation ul .menu-item-has-children > a'));
    $('.mobile-navigation ul li .submenu-toggle').on( 'click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    $('#primary-toggle-button').on( 'click', function() {
        $('.responsive-menu-holder').slideToggle();
        $('.site-header .header-t').toggleClass("bg-color");
        $('#primary-toggle-button').css("display", "none");
    });

    $('.responsive-menu-holder .mobile-navigation .close-main-nav-toggle').on( 'click', function() {
        $('.responsive-menu-holder').slideToggle();
        $('.site-header .header-t').toggleClass("bg-color");
        $('#primary-toggle-button').css("display", "block");
    });

    //custom scroll bar
    if( $('.widget_rrtc_description_widget').length ){
        $('.description').each(function(){ 
            var ps = new PerfectScrollbar($(this)[0]); 
        });
    }
    
    if( $('.filter-grid div.element-item').length > 0 ){
        var origin_left;
        if( rb_localize_data.rtl == '1' ){
            origin_left = false;
        }else{
            origin_left = true; 
        }

        // init Isotope
        var $grid = $('.filter-grid').imagesLoaded( function(){  

            $grid.isotope({
              isOriginLeft: origin_left,
            });
            
            // filter items on button click
            $('.filter-button-group').on( 'click', 'button', function() {
              $('.filter-button-group button').removeClass('is-checked');
              $(this).addClass('is-checked');
              var filterValue = $(this).attr('data-filter');
              $grid.isotope({ filter: filterValue });
          });

        });
    }

    //accessible menu in IE
    var windowWidth = $(window).width();
    if(windowWidth > 1024){
        $(".main-navigation ul li a").on( 'focus', function() {
            $(this).parents("li").addClass("hover");
        }).on( 'blur', function() {
            $(this).parents("li").removeClass("hover");
        });
    }

});
