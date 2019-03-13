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


    $(".car-card").mouseenter(function () {
        $(this).animate({
            "top": "-=1vw"
        }, "fast")
    });

    $(".car-card").mouseleave(function () {
        $(this).animate({
            "top": "+=1vw"
        }, "fast")
    });

    $(".car-card").click(function () {
        $(".car-card").removeClass("bg-card-active");
        $(this).addClass("bg-card-active");
        $('#car_name').val($(this).attr('name'));
        $('#car_type').val($(this).attr('id'));
        setTimeout(
            function () {
                $('#car_type_summary').text($('#car_name').val());
            }, 10);

    });


})(jQuery); // End of use strict




//
// //Calculate prices form different cars
//
// var xhr = new XMLHttpRequest();
// xhr.open("Get", "php/makeNewBooking.php", true);
//
//
// xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//         var json = json.parse(xhr.responseText);
//     }
// };
// xhr.send();
//
//
// $.ajax({
//     type: "GET",
//     url: "php/makeNewBooking.php",
//     async: true,
//     data: {},
//     dataType: "json",
//     success: function (data) {
//         $(#main).html(data);
//     },
//     error: function (jqXHR, textStatus, error) {
//     }
// });
//
//
// $('sumbit_passengers').on("click", function (e) {
//     e.preventDefault();
//
//
//
// });
//




