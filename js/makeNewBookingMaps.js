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
            // + "London, UK"
        };


        // Define a callback function to process the geocoding response:
        var onSuccessAddress = function (result) {
            checkForErrorInAddress(result);
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
                    pickupFirstSearch = false;
                } else {
                    console.log(map.getObjects());
                    removeObjectById("pickupId");
                    marker = new H.map.Marker(position);
                    marker.id = "pickupId";
                    map.addObject(marker);
                    map.setCenter(position, true);
                }
            }

            if (dropoffPosition[0] === undefined) {
            } else {
                //Draw route and return travel time
                drawRoute(pickupPosition, dropoffPosition);
            }

            //Saving users search
            document.getElementById("pickup_address_api").value = result.Response.View[0].Result[0].Location.Address.Label;
            document.getElementById("pickup_address_summary").textContent = result.Response.View[0].Result[0].Location.Address.Label;
            $("#pickup_address_summary").attr("class", "text-light");

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
            // + "London, UK"
        };

        // Define a callback function to process the geocoding response:
        var onSuccessAddress = function (result) {
            checkForErrorInAddressDropOff(result);
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
                    dropoffFirstSearch = false;
                } else {
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
                //Draw route and return travel time
                drawRoute(pickupPosition, dropoffPosition);
            }
            //Saving users search
            document.getElementById("dropoff_address_summary").textContent = result.Response.View[0].Result[0].Location.Address.Label;
            document.getElementById("dropoff_address_api").value = result.Response.View[0].Result[0].Location.Address.Label;
            $("#dropoff_address_summary").attr("class", "text-light");
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
                    style: {strokeColor: '#1887dc', lineWidth: 7}
                });
                routeLine.id = "route";

                // Add the route polyline and the two markers to the map:
                map.addObject(routeLine);

                // Set the map's viewport to make the whole route visible:
                map.setViewBounds(routeLine.getBounds());

                //Get route travel time for service fee calculation
                totalTime = 0;
                numberOfManeuvers = result.response.route[0].leg[0].maneuver.length;
                for (i = 0; i < numberOfManeuvers; i++) {
                    totalTime += result.response.route["0"].leg["0"].maneuver[i].travelTime
                }
                document.getElementById("travel_time_api").value = totalTime;
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


    function checkForErrorInAddress(result) {
        if (result.Response.View[0] == null) {
            document.getElementById("error_pickup_address").innerHTML = "<h4 class='text-warning'> Unfortunately, we couldn't find this address, check address or try to use postcode</h4>";
        } else {
            document.getElementById("error_pickup_address").innerHTML = "<h4 class='text-warning'> </h4>";
            document.getElementById("pickup_search_button_logo").className = "fas fa-1x fa-check-circle text-dark my-3";
        }
    }

    function checkForErrorInAddressDropOff(result) {
        if (result.Response.View[0] == null) {
            document.getElementById("error_dropoff_address").innerHTML = "<h4 class='text-warning'> Unfortunately, we couldn't find this address, check address or try to use postcode</h4>";
        } else {
            document.getElementById("error_dropoff_address").innerHTML = "<h4 class='text-warning'></h4>";
            document.getElementById("dropoff_search_button_logo").className = "fas fa-1x fa-check-circle text-dark my-3";
        }
    }
}


//reset search buttons back to normal search icon
$("#pickup_address").click(function () {
    document.getElementById("pickup_search_button_logo").className = "fas fa-1x fa-search-location text-light my-3";
});

$("#dropoff_address").click(function () {
    document.getElementById("dropoff_search_button_logo").className = "fas fa-1x fa-search-location text-light my-3";
});


