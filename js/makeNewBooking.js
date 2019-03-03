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
        $('#car_type').val($(this).attr('id'));
    });


})(jQuery); // End of use strict



//Passengers Forms
function addPassengerFields() {
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
            '                                        <input class="form-control validate" id="passenger_name' + i + '"\n' +
            '                                               placeholder="Enter name" name="passenger_name_' + i + '"\n' +
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
            '                                        <input class="form-control validate" id="passenger_email' + i + '"\n' +
            '                                               placeholder="Enter email" name="passenger_email_' + i + '"\n' +
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
            '                                        <input class="form-control validate" id="passenger_phone' + i + '"\n' +
            '                                               value="+44" name="passenger_phone_' + i + '"\n' +
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

//HERE MAPS
{
/*
Map initialization
*/
{
    var platform = new H.service.Platform({
        'app_id': 'gOZdM09wsZ9MKBhgZMoC',
        'app_code': 'zQg5oadGrNGCVAr-hqbYcw'
    });

// Obtain the default map types from the platform object:
    var defaultLayers = platform.createDefaultLayers();

// Instantiate (and display) a map object:
    var map = new H.Map(
        document.getElementById('mapContainer'),
        defaultLayers.normal.map,
        {
            zoom: 12,
            center: {lat: 51.509865, lng: -0.118092}
        });
}


/*
Map responsiveness
*/
{
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
}

function removeObjectById(id) {
    for (object of map.getObjects()) {
        if (object.id === id) {
            map.removeObject(object);
        }
    }
}


// To change location of marker after new searches
var pickupFirstSearch = true;
var dropoffFirstSearch = true;
var routedOnce = false;


//    For routing
var pickupPosition = new Array(2);
var dropoffPosition = new Array(2);


function pickup_search() {
    // Create the parameters for the geocoding request:
    var geocodingParams = {
        searchText: document.getElementById("pickup_address").value
    };

    // Define a callback function to process the geocoding response:
    var onSuccessAddress = function (result) {
        var locations = result.Response.View[0].Result,
            position,
            marker;
        // Add a marker for each location found
        for (i = 0; i < locations.length; i++) {
            position = {
                lat: locations[i].Location.DisplayPosition.Latitude,
                lng: locations[i].Location.DisplayPosition.Longitude
            };
            //Saving latitude for routing
            pickupPosition[0] = locations[i].Location.DisplayPosition.Latitude;
            pickupPosition[1] = locations[i].Location.DisplayPosition.Longitude;
            if (pickupFirstSearch) {
                marker = new H.map.Marker(position);
                marker.id = "pickupId";
                map.addObject(marker);
                map.setCenter(position, true);
                console.log(map.getObjects());
                pickupFirstSearch = false;
            } else {
                console.log(map.getObjects());
                removeObjectById("pickupId");
                console.log(map.getObjects());
                marker = new H.map.Marker(position);
                marker.id = "pickupId";
                map.addObject(marker);
                map.setCenter(position, true);
            }
        }

        if (dropoffPosition[0] === undefined) {
        } else {
            drawRoute(pickupPosition, dropoffPosition);
        }
    };

    // Get an instance of the geocoding service:
    var geocoder = platform.getGeocodingService();

    // Call the geocode method with the geocoding parameters,
    // the callback and an error callback function (called if a
    // communication error occurs):
    geocoder.geocode(geocodingParams, onSuccessAddress, function (e) {
        alert(e);
    });
}


// Listening for users "enter" key in the form to start pickup address search
document.getElementById("pickup_address").addEventListener("keyup", function (event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("pickup_button").click();
    }
});


function dropoff_search() {
    // Create the parameters for the geocoding request:
    var geocodingParams = {
        searchText: document.getElementById("dropoff_address").value
    };

    // Define a callback function to process the geocoding response:
    var onSuccessAddress = function (result) {
        var locations = result.Response.View[0].Result,
            position,
            marker;
        // Add a marker for each location found
        for (i = 0; i < locations.length; i++) {
            position = {
                lat: locations[i].Location.DisplayPosition.Latitude,
                lng: locations[i].Location.DisplayPosition.Longitude
            };
            //Saving latitude for routing
            dropoffPosition[0] = locations[i].Location.DisplayPosition.Latitude;
            dropoffPosition[1] = locations[i].Location.DisplayPosition.Longitude;

            if (dropoffFirstSearch) {
                marker = new H.map.Marker(position);
                marker.id = "dropoffMarker";
                map.addObject(marker);
                map.setCenter(position, true);
                console.log(map.getObjects());
                dropoffFirstSearch = false;
            } else {
                console.log(map.getObjects());
                removeObjectById("dropoffMarker");
                console.log(map.getObjects());
                marker = new H.map.Marker(position);
                marker.id = "dropoffMarker";
                map.addObject(marker);
                map.setCenter(position, true);
            }
        }
        if (pickupPosition[1] === undefined) {
        } else {
            drawRoute(pickupPosition, dropoffPosition);
        }
    };

    // Get an instance of the geocoding service:
    var geocoder = platform.getGeocodingService();

    // Call the geocode method with the geocoding parameters,
    // the callback and an error callback function (called if a
    // communication error occurs):
    geocoder.geocode(geocodingParams, onSuccessAddress, function (e) {
        alert(e);
    });
}

// Listening for users "enter" key in the form to start dropoff address search
document.getElementById("dropoff_address").addEventListener("keyup", function (event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("dropoff_button").click();
    }
});


/*
Routing
*/
function drawRoute(pickupPosition, dropoffPosition) {
    pickup = pickupPosition[0] + ',' + pickupPosition[1];
    dropoff = dropoffPosition[0] + ',' + dropoffPosition[1];

// Create the parameters for the routing request:
    var routingParameters = {
        // The routing mode:
        mode: 'fastest;car',
        // The start point of the route:
        waypoint0: pickup,
        // The end point of the route:
        waypoint1: dropoff,
        // To retrieve the shape of the route we choose the route
        // representation mode 'display'
        representation: 'display'
    };


    //delete previous routes
    if (routedOnce) {
        removeObjectById("route");

    } else {
        routedOnce = true;
    }


// Define a callback function to process the routing response:
    var onResult = function (result) {
        var route,
            routeShape,
            linestring;

        if (result.response.route) {
            // Pick the first route from the response:
            route = result.response.route[0];
            // Pick the route's shape:
            routeShape = route.shape;

            // Create a linestring to use as a point source for the route line
            linestring = new H.geo.LineString();

            // Push all the points in the shape into the linestring:
            routeShape.forEach(function (point) {
                var parts = point.split(',');
                linestring.pushLatLngAlt(parts[0], parts[1]);
            });

            // Create a polyline to display the route:
            var routeLine = new H.map.Polyline(linestring, {
                style: {strokeColor: '#f3a571', lineWidth: 10}
            });
            routeLine.id = "route";

            // Add the route polyline and the two markers to the map:
            map.addObject(routeLine);

            // Set the map's viewport to make the whole route visible:
            map.setViewBounds(routeLine.getBounds());
        }
    };

// Get an instance of the routing service:
    var router = platform.getRoutingService();

// Call calculateRoute() with the routing parameters,
// the callback and an error callback function (called if a
// communication error occurs):
    router.calculateRoute(routingParameters, onResult,
        function (error) {
            alert(error.message);
        });
}
}