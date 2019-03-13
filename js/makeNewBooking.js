(function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 56)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        $('.navbar-collapse').collapse('hide');
    });


    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);


    let carCard = $(".car-card")

    carCard.mouseenter(function () {
        $(this).animate({
            "top": "-=1vw"
        }, "fast")
    });

    carCard.mouseleave(function () {
        $(this).animate({
            "top": "+=1vw"
        }, "fast")
    });

    carCard.click(function () {
        carCard.removeClass("bg-card-active");
        $('#car_type_summary').attr("class", "text-light");
        $(this).addClass("bg-card-active");
        $('#car_name').val($(this).attr('name'));
        $('#car_type').val($(this).attr('id'));
        setTimeout(
            function () {
                $('#car_type_summary').text($('#car_name').val());
            }, 10);
    });


})(jQuery); // End of use strict





