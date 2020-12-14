(function($){
    "use strict";
    
    // use of fontawesome
    window.FontAwesomeConfig = {
        searchPseudoElements: true
    }

    // search & cart option
    $(document).on('click','.ht_icon_all_search i, .search-close',function(){
        $(".search-area").toggleClass("open");
    });
    $(document).on('click','.ht_icon_all_option .ht_option, .sign_login_close, .Close_sing',function(){
        $(".sign_login").toggleClass("open");
    });

    $(document).on('click','.menu_bar i, .modal_close',function(){
        $(".hb_left_bottom").toggleClass("open");
        $(".menu_bar").toggleClass("open");
    });

    
    
    $("ul li ul, .mega_menu").parent("li").children("a").addClass("dd-icon");

    //shop-widget drodown menu display
    $('.main_menu ul li a, .pop_menu ul li a').on('click', function(e) {
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp(100,"swing");
        }
        else {
            element.addClass('open');
            element.children('ul').slideDown(100,"swing");
            element.siblings('li').children('ul').slideUp(100,"swing");
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp(100,"swing");
        }
    });

    // scroll up start here
    $(function() {
        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 300) {
                $('.scrollToTop').css({'bottom':'2%', 'opacity':'1','transition':'all .5s ease'});
            } else {
                $('.scrollToTop').css({'bottom':'-30%', 'opacity':'0','transition':'all .5s ease'})
            }
        });
        //Click event to scroll to top
        $('.scrollToTop').on('click',function(){
            $('html, body').animate({scrollTop : 0},500);
            return false;
        });
    });

    // menu list 
    $(document).on('click','.hb_left_top i',function(){
        $(".hb_left_top").toggleClass("open");
        $(".hb_left_bottom").toggleClass("open");
    });


    // banner slider
    var swiper = new Swiper('.banner-slider', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.banner-slider-next',
            prevEl: '.banner-slider-prev',
        },
        speed: 1200,
        autoplay: {
            delay: 3200,
            disableOnInteraction: false,
        },
        loop: true
    });
    // banner bottom slider
    var swiper = new Swiper('.bb_slider_1, .bb_slider_2, .bb_slider_3', {
        slidesPerView: 1,
        spaceBetween: 10,
        speed: 1600,
        pagination: {
            el: '.bb_slider_pagination',
            clickable: true,
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        loop: true
    });

    // testimonial slider
    var swiper = new Swiper('.testi_slider', {
        slidesPerView: 1,
        spaceBetween: 0,
        speed: 1600,
        pagination: {
            el: '.testi_slider_pagination',
            clickable: true,
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        loop: true
    });

    // counter up
    $('.counter').counterUp({
        time: 5000
    });


    //Slick Slider
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        asNavFor: '.slider-nav',
        // autoplay: 5000,
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 10,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
    });

    // active list js
    jQuery(function(){
        var $lis = $('.chosse_cata li').on('click', function(){
            $lis.removeClass('active');
            $(this).addClass('active')    
        });
    })


    // shop cart + - start here
    var CartPlusMinus = $('.cart-plus-minus');
    CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
    CartPlusMinus.append('<div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    //Review Tabs
    $('ul.review-nav').on('click', 'li', function (e) {
        e.preventDefault();
        var reviewContent = $('.review-content');
        var viewRev = $(this).data('target');
        $('ul.review-nav li').removeClass('active');
        $(this).addClass('active');
        reviewContent.removeClass('review-content-show description-show Spe-show').addClass(viewRev);
    });

    $('.faq_item ').on('click',function(){
        var before = $('.faq_item.active');
        before.removeClass('active');
        $(this).addClass('active');
    });
    
    //sign in & login Tabs
    $('.log_sign_nav').on('click', 'li', function (e) {
        e.preventDefault();
        var reviewContent = $('.log_sign_content');
        var viewRev = $(this).data('target');
        $('.log_sign_nav li').removeClass('active');
        $(this).addClass('active');
        reviewContent.removeClass('sign-show login-show').addClass(viewRev);
    });

    //retailer & customer Tabs
    $('.log_in_nav').on('click', 'li', function (e) {
        e.preventDefault();
        var reviewContent = $('.log_in_content');
        var viewRev = $(this).data('target');
        $('.log_in_nav li').removeClass('active');
        $(this).addClass('active');
        reviewContent.removeClass('retailer-show customer-show').addClass(viewRev);
    });
    $('.sign_in_nav').on('click', 'li', function (e) {
        e.preventDefault();
        var reviewContent = $('.sign_in_content');
        var viewRev = $(this).data('target');
        $('.sign_in_nav li').removeClass('active');
        $(this).addClass('active');
        reviewContent.removeClass('retailer-show customer-show').addClass(viewRev);
    });

    // Add smooth scrolling to all links
    $("a").on('click', function (event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();
            // Store hash
            var hash = this.hash;
            // specified area
            $('html, body').animate({
                scrollTop: $(hash)
                    .offset()
                    .top
            }, 800, function () {
                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }
    });

}(jQuery));
