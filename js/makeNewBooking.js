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
            "top": "-=2vw"
        }, "fast")
    });

    $(".car-card").mouseleave(function () {
        $(this).animate({
            "top": "+=2vw"
        }, "fast")
    });

    $(".car-card").click(function () {
        $(".car-card").removeClass("bg-card-active");
        $(this).addClass("bg-card-active");
    });


    
})(jQuery); // End of use strict



function addFields() {
    // Number of inputs to create
    var number_passengers = document.getElementById("number_passengers").value;
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("passenger_container");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    //Add detail form for passengers
    for (i = 1; i <= number_passengers; i++) {
        // Assemble passenger from
        var passenger_form = document.createElement('div');

        passenger_form.className = "col-sm-12 col-lg-6 mt-md-1 mt-sm-1 mt-1 mt-lg-0 mt-xl-0 mb-4";

        passenger_form.innerHTML =
            '                <div class="card bg-card">\n' +
            '                    <div class="card-body">\n' +
            '                        <h4 class="font-weight-bold">Passengers ' + i + '</h4>\n' +
            '                        <!--<divs class="container">-->\n' +
            '                        <div class="card pl-0 my-3 bg-light">\n' +
            '                            <div class="card-body">\n' +
            '                                <div class="row">\n' +
            '                                    <div class="col-2">\n' +
            '                                        <i class="fas fa-2x fa-address-book text-primary-light my-3"></i>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-10">\n' +
            '                                        <h5>Name</h5>\n' +
            '                                        <input class="form-control validate" id="passenger_name'+i+'"\n' +
            '                                               placeholder="Enter name"\n' +
            '                                               type="text">\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                        <div class="card pl-0 my-3 bg-light">\n' +
            '                            <div class="card-body">\n' +
            '                                <div class="row">\n' +
            '                                    <div class="col-2">\n' +
            '                                        <i class="fas fa-2x fa-mail-bulk text-primary-light my-3"></i>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-10">\n' +
            '                                        <h5>Email</h5>\n' +
            '                                        <input class="form-control validate" id="passenger_email'+i+'"\n' +
            '                                               placeholder="Enter email"\n' +
            '                                               type="email">\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '\n' +
            '                        <div class="card ml-0 pl-0 my-3 bg-light">\n' +
            '                            <div class="card-body ">\n' +
            '                                <div class="row">\n' +
            '                                    <div class="col-2">\n' +
            '                                        <i class="fas fa-2x fa-phone text-primary-light my-3"></i>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-10">\n' +
            '                                        <h5>Mobile number</h5>\n' +
            '                                        <input class="form-control validate" id="passenger_phone'+i+'"\n' +
            '                                               value="+44"\n' +
            '                                               type="tel">\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                        <!--</divs>-->\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>';

        // Append a passenger from
        container.appendChild(passenger_form);
    }
}
