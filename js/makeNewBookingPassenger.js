function tripInfoForm() {
    addPassengerFields();
    let carList = carFilter();
    calculateFee(carList);
}


// Verify luggage, number of passengers and date of journey
{
    $("#luggage").on('blur', function () {
        if ($("#luggage").val() < 0 || $("#luggage").val() > 4) {
            let errorContainer = $("#luggageError");
            errorContainer.text("Luggage should be between 0 and 4");
        }
    });

    $("#number_passengers").on('blur', function () {
        if ($("#number_passengers").val() < 0 || $("#number_passengers").val() > 6) {
            let errorContainer = $("#passengerError");
            errorContainer.text("Passenger number should be between 0 and 6");
        }
    });

}


//Passengers Forms
function addPassengerFields() {
    // Creates number of inputs and Summary fields

    // Container <div> where dynamic content will be placed
    var number_passengers = document.getElementById("number_passengers").value;

    //Passenger forms
    {
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

            passenger_form.innerHTML = (`
                <div class="card bg-card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Passengers ` + i + `</h4>
                        
                        <div class="card pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-2x fa-address-book text-primary-light my-3"> </i>
                                    </div>
                                    <div class="col-10">
                                        <h5>First name</h5>
                                        <input class="form-control validate" id="passenger_first_name_` + i + `"
                                               placeholder="Enter first name" name="passenger_first_name_` + i + `" 
                                               type="text"/>
                                        <div id="passenger_first_nameError` + i + `"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-2x fa-address-book text-primary-light my-3"> </i>
                                    </div>
                                    <div class="col-10">
                                        <h5>Last name</h5>
                                        <input class="form-control validate" id="passenger_last_name_` + i + `"
                                               placeholder="Enter last name" name="passenger_last_name_` + i + `"
                                               type="text"/>
                                        <div id="passenger_last_nameError_` + i + `"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-2x fa-mail-bulk text-primary-light my-3"> </i>
                                    </div>
                                    <div class="col-10">
                                        <h5>Email</h5>
                                        <input class="form-control validate" id="passenger_email` + i + `"
                                               placeholder="Enter email" name="passenger_email_` + i + `"
                                               type="email"/>
                                        <div id="passenger_emailError_` + i + `"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card ml-0 pl-0 my-3 bg-light">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-2x fa-phone text-primary-light my-3"> </i>
                                    </div>
                                    <div class="col-10">
                                        <h5>Mobile number</h5>
                                        <input class="form-control validate" id="passenger_phone` + i + `"
                                               name="passenger_phone_` + i + `" value="" placeholder="Enter phone number"
                                               type="tel"/>
                                        <div id="phoneNumberError_` + i + `"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`);
            // Append a passenger from
            container.appendChild(passenger_form);
        }
    }


    //Verify traveler details
    for (let i = 1; i <= number_passengers; i++) {
        //verify traveler first name
        $("#passenger_first_name_" + i).on("blur", function () {

            let errorContainer = document.getElementById("passenger_first_nameError" + i);
            let input = document.getElementById('passenger_first_name_' + i).value;
            console.log(input);
            let re = new RegExp("[A-Z][a-z]*$");
            if (re.test(input)) {
                errorContainer.innerHTML = "";
                return true
            } else {
                errorContainer.innerHTML = "<p class='text-warning'> First name should start with a capital letter and only contain letters</p>";
                return false
            }
        });

        //verify traveler last name
        $("#passenger_last_name_" + i).on("blur", function () {
            console.log("first name being selected");
            let errorContainer = document.getElementById("passenger_last_nameError_" + i);
            let input = document.getElementById('passenger_last_name_' + i).value;
            let re = new RegExp("[A-Z][a-z]*$");
            if (re.test(input)) {
                errorContainer.innerHTML = "";
                return true
            } else {
                errorContainer.innerHTML = "<p class='text-warning'> Last name should start with a capital letter and only contain letters</p>";
                return false
            }
        });

        //verify traveler phone number
        $("#passenger_phone" + i).on("blur", function () {
            let errorContainer = document.getElementById("phoneNumberError_" + i);
            let input = document.getElementById('passenger_phone' + i).value;
            let re = new RegExp("[0-9]*$");
            if (re.test(input) && input.length == 11) {
                errorContainer.innerHTML = "";
                return true
            } else {
                errorContainer.innerHTML = "<p class='text-warning'> Phone number must be made of 11 digits</p>";
                return false
            }
        });


        //verify traveler phone number
        $("#passenger_email" + i).on("blur", function () {
            let errorContainer = document.getElementById("passenger_emailError_" + i);
            let input = document.getElementById('passenger_email' + i).value;
            let re = new RegExp("^(?:(?:[\\w`~!#$%^&*\\-=+;:{}'|,?\\/]+(?:(?:\\.(?:\"(?:\\\\?[\\w`~!#$%^&*\\-=+;:{}'|,?\\/\\.()<>\\[\\] @]|\\\\\"|\\\\\\\\)*\"|[\\w`~!#$%^&*\\-=+;:{}'|,?\\/]+))*\\.[\\w`~!#$%^&*\\-=+;:{}'|,?\\/]+)?)|(?:\"(?:\\\\?[\\w`~!#$%^&*\\-=+;:{}'|,?\\/\\.()<>\\[\\] @]|\\\\\"|\\\\\\\\)+\"))@(?:[a-zA-Z\\d\\-]+(?:\\.[a-zA-Z\\d\\-]+)*|\\[\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\])$");
            if (re.test(input)) {
                errorContainer.innerHTML = "";
                return true
            } else {
                errorContainer.innerHTML = "<p class='text-warning'> Enter valid email</p>";
                return false
            }
        });



    }


    //Passenger details summary
    {
        var container = document.getElementById("passenger_summary");
        // Clear previous contents of the container
        while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
        }
        //Add detail form for passengers
        for (a = 1; a <= number_passengers; a++) {
            // Assemble passenger summary
            var passenger_summary = document.createElement('div');

            passenger_summary.innerHTML = (`
        <h6 class="text-primary"><i class="fas fa-1x fa-address-book text-primary"> </i> Passenger ` + a + `
        </h6>
        <div class="row align-items-center">
            <div class="col-10 mb-3">
                <p class="summary-not-filled" id="passenger_summary_` + a + `">Information required </p>
            </div>
        </div>`);
            // Append a passenger from
            container.appendChild(passenger_summary);
        }
    }

    //Display passenger details in summary
    for (let b = 1; b <= number_passengers; b++) {
        // Assemble ids for passenger fields and summary
        let currentIDFirstName = "passenger_first_name_" + b;
        let currentIDLastName = "passenger_last_name_" + b;
        let currentFieldID = "passenger_summary_" + b;
        $("#" + currentIDFirstName).keyup(function () {
            $("#" + currentFieldID).text($("#" + currentIDFirstName).val() + " " + $("#" + currentIDLastName).val());
            $("#" + currentFieldID).attr("class", "text-light");
        });
        $("#" + currentIDLastName).keyup(function () {
            $("#" + currentFieldID).text($("#" + currentIDFirstName).val() + " " + $("#" + currentIDLastName).val());
            $("#" + currentFieldID).attr("class", "text-light");
        });
    }

}


//Filter Cars
function carFilter() {
    // Number of inputs to create
    let numberOfPassengers = document.getElementById("number_passengers").value;
    // Number of inputs to create
    let numberOfLuggage = document.getElementById("luggage").value;

    let container = document.getElementById("car_selection");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    if (numberOfPassengers > 4 && numberOfPassengers <= 6 && numberOfLuggage <= 2) {
        container.innerHTML = `
            <div class="card col-12 col-md-5 my-3 mx-auto bg-light car-card px-0" name="Mercedes V-Class" id="MVClass">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/V-class-side.png"/>
                        <h5 class="my-3 ">Mercedes V-Class</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 6 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceMVClass"> </a>
                </div>
            </div>`;
        loadAnimations();
        let carList = ["MVClass"];
        return carList;
    } else if (numberOfPassengers <= 4 && numberOfLuggage > 2 && numberOfLuggage <= 4) {
        container.innerHTML = `<div class="card col-12 col-md-5 my-3 mx-auto bg-light car-card px-0"  name="Range Rover" id="RRover">
                            <div class="card-body text-center">
                                <div class="container-fluid">
                                    <img class="container-fluid px-0" src="img/cars/rra1.png"/>
                                    <h5 class="my-3 ">Range Rover</h5>
                                </div>
                                <div class="row">
                                    <div class="card col-4 offset-1 bg-dark">
                                        <div class="card-body text-light p-0">
                                            <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                                        </div>
                                    </div>
                                    <div class="card col-4 offset-2 bg-dark">
                                        <div class="card-body text-light p-0">
                                            <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 4 </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--price-->
                            <div class="card-footer text-center">
                                <a id="priceRRover"> </a>
                            </div>
                        </div>`;
        let carList = ["RRover"];
        loadAnimations();
        return carList;

    } else if (numberOfPassengers <= 4 && numberOfLuggage <= 2) {
        container.innerHTML = `
        <div class="row">
            <div class="card col-12 col-md-5 my-3 mx-auto bg-light car-card px-0" name="Mercedes E-Class" id="MEClass">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/car-list-eclass.png"/>
                        <h5 class="my-3">Mercedes E-Class</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceMEClass"> </a>
                </div>
            </div>


            <div class="card col-12 col-md-5 offset-md-1 my-3 mx-auto bg-light car-card px-0" name="Mercedes S-Class" id="MSClass">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/car-list-sclass1.png"/>
                        <h5 class="my-3 ">Mercedes S-Class</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceMSClass"> </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card col-12 col-md-5 my-3 mx-auto bg-light car-card px-0" name="Rolls-Royce Phantom" id="RRPhantom">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/car-list-phantom1.png"/>
                        <h5 class="my-3">Rolls-Royce Phantom</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceRRPhantom"> </a>
                </div>
            </div>
    
            <div class="card col-12 col-md-5 offset-md-1 my-3 mx-auto bg-light car-card px-0" name="Bentley Mulsanne" id="BMulsanne">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/bentley-mulsanne.png"/>
                        <h5 class="my-3 ">Bentley Mulsanne</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceBMulsanne"> </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card col-12 col-md-5 my-3 mx-auto bg-light car-card px-0"  name="Range Rover" id="RRover">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/rra1.png"/>
                        <h5 class="my-3 ">Range Rover</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 4 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceRRover"> </a>
                </div>
            </div>

            <div class="card col-12 col-md-5 offset-md-1 my-3 mx-auto bg-light car-card px-0" name="Mercedes V-Class" id="MVClass">
                <div class="card-body text-center">
                    <div class="container-fluid">
                        <img class="container-fluid px-0" src="img/cars/V-class-side.png"/>
                        <h5 class="my-3 ">Mercedes V-Class</h5>
                    </div>
                    <div class="row">
                        <div class="card col-4 offset-1 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-user-friends text-light"> </i> 6 </a>
                            </div>
                        </div>
                        <div class="card col-4 offset-2 bg-dark">
                            <div class="card-body text-light p-0">
                                <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--price-->
                <div class="card-footer text-center">
                    <a id="priceMVClass"> </a>
                </div>
            </div>
        </div>`;
        let carList = ["MEClass", "MSClass", "RRPhantom", "BMulsanne", "RRover", "MVClass"];
        loadAnimations();
        return carList;
    } else {
        container.innerHTML =
            `<div class="card col-12 col-md-5 my-3 bg-light p-5">
            <h5> Unfortunately, we do not have a car which can 
            accommodate selected number of passengers and luggage. </h5>
        </div>`;
        return [];
    }

}


//Loading Car selection animations
function loadAnimations() {
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
        $('#car_type_summary').attr("class", "text-light");
        $(this).addClass("bg-card-active");
        $('#car_name').val($(this).attr('name'));
        $('#car_type').val($(this).attr('id'));
        setTimeout(
            function () {
                $('#car_type_summary').text($('#car_name').val());
            }, 10);
        $('#travel_fee').text($('.bg-card-active .card-footer a').text());
        $('#travel_fee').attr("class", "text-light");
        $('#service_rate_car').text($('.bg-card-active .card-footer a').text());
    });

}


//Filling in the summary
{
//Input Data
    (function ($) {
        "use strict"; // Start of use strict

        $("#pickup_date").keyup(function () {
            $("#time_summary").text($("#pickup_date").val() + "   " + $("#pickup_time").val());
            $("#time_summary").attr("class", "text-light");
        });

        $("#pickup_time").keyup(function () {
            $("#time_summary").text($("#pickup_date").val() + "   " + $("#pickup_time").val())
            $("#time_summary").attr("class", "text-light");
        });

        $("#pickup_button").click(function () {
            setTimeout(
                function () {
                    let seconds = $("#travel_time_api").val();
                    let minutes = seconds / 60;
                    let time = Math.round(minutes);
                    if (time == 1) {
                        $("#travel_time_summary").text(time + " minute");
                    } else {
                        $("#travel_time_summary").text(time + " minutes");
                    }
                    $("#travel_time_summary").attr("class", "text-light");
                }, 1000);

        });

        $("#dropoff_button").click(function () {
            setTimeout(
                function () {
                    let seconds = $("#travel_time_api").val();
                    let minutes = seconds / 60;
                    let time = Math.round(minutes);
                    if (time == 1) {
                        $("#travel_time_summary").text(time + " minute");
                    } else {
                        $("#travel_time_summary").text(time + " minutes");
                    }
                    $("#travel_time_summary").attr("class", "text-light");
                }, 1000);
        });

    })(jQuery);
}


function calculateFee(carList) {
    //Retrieve information
    var q = $("#travel_time_api").val();

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/MakeNewBookingCarCost.php?q=' + q, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            var carCost = JSON.parse(result);
            addFeeToHTML(carCost, carList);
        }
    };
    xhr.send();
}


function addFeeToHTML(carCost, carList) {
    let allFilteredCarCost = [];
    //leave relevant cars in the order of the html elements
    for (i = 0; i < carList.length; i++) {
        for (a = 0; a < carCost.length; a++) {
            if (carList[i] == carCost[a]["name"]) {
                allFilteredCarCost.push(carCost[a]);
                break
            }
        }
    }


    //adding cost of trip on html elements
    for (i = 0; i < allFilteredCarCost.length; i++) {
        let carName = allFilteredCarCost[i]["name"];
        let carCost = allFilteredCarCost[i]["carCost"].toFixed(2);
        $("#price" + carName).text("£" + carCost);
    }

}


function collectDataForPHP() {
    let numberOfPassengers = $("#number_passengers").val();

    let validated = true;

    let container = document.getElementById("passengerDetail");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    //Add detail form for passengers
    for (i = 1; i <= numberOfPassengers; i++) {
        // Assemble passenger from
        let passenger_form = document.createElement('div');
        passenger_form.innerHTML = (`
                <input type="hidden" name="passenger_first_name_hidden_` + i + `" id="passenger_first_name_hidden_` + i + `" value="">
                <input type="hidden" name="passenger_last_name_hidden_` + i + `" id="passenger_last_name_hidden_` + i + `" value="">
                <input type="hidden" name="passenger_email_hidden_` + i + `" id="passenger_email_hidden_` + i + `" value="">
                <input type="hidden" name="passenger_phone_hidden_` + i + `" id="passenger_phone_hidden_` + i + `" value="">`);
        container.appendChild(passenger_form);

        //Pickup information from user inputs
        let firstName = $("#passenger_first_name_hidden_" + i).val($("#passenger_first_name_" + i).val());
        let lastName = $("#passenger_last_name_hidden_" + i).val($("#passenger_last_name_" + i).val());
        let email = $("#passenger_email_hidden_" + i).val($("#passenger_email" + i).val());
        let phone = $("#passenger_phone_hidden_" + i).val($("#passenger_phone" + i).val());

        if (firstName == null || firstName == "" || lastName == null || lastName == "" || email == null || email == "" || phone == null || phone == "") {
            validated = false;
        }
    }

    $("#pickup_time_post").val($("#pickup_time").val());
    $("#pickup_date_post").val($("#pickup_date").val());
    $("#number_passengers_post").val($("#number_passengers").val());
    $("#service_rate_car").val($("#travel_fee").text());
    $("#pickup_address_post").val($("#pickup_address").val());
    $("#dropoff_address_post").val($("#dropoff_address").val());


    let $pickupDate = $("#pickup_date_post").val();
    let pickupTime = $("#pickup_time_post").val();

    let numberPassengers = $("#number_passengers_post").val();
    let serviceRate = $("#service_rate_car").val();

    let pickupAddress = $("#pickup_address_post").val();
    let dropoffAddress = $("#dropoff_address_post").val();

    let carType = $("#car_type").val();

    let pickupAddressAPI = $("#pickup_address_api").val();
    let dropoffAddressAPI = $("#dropoff_address_api").val();


    //Checking for blank inputs
    {
        let errorContainer = document.getElementById("missingInput");

        while (errorContainer.hasChildNodes()) {
            errorContainer.removeChild(errorContainer.lastChild);
        }

        errorContainer.innerHTML += "<h3> Oooops, some data is missing</h3>";

        if (pickupAddress == null || pickupAddress == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please enter pickup address</p>";
            validated = false;
        }

        if (dropoffAddress == null || dropoffAddress == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please enter dropoff address</p>";
            validated = false;
        }

        if (pickupAddressAPI == null || pickupAddressAPI == "") {
            errorContainer.innerHTML +=
                "<p class='text-warning'> Please press button beside pickup address to search for address</p>";
            validated = false;
        }

        if (dropoffAddressAPI == null || dropoffAddressAPI == "") {
            errorContainer.innerHTML +=
                "<p class='text-warning'> Please press button beside dropoff address to search for address</p>";
            validated = false;
        }

        if ($pickupDate == null || $pickupDate == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please enter pickup date</p>";
            validated = false;
        }

        if (pickupTime == null || pickupTime == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please enter pickup time</p>";
            validated = false;
        }

        if (numberPassengers == null || numberPassengers == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please enter number of passengers</p>";
            validated = false;
        }

        if (serviceRate == null || serviceRate == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please select a car</p>";
            validated = false;
        }

        if (carType == null || carType == "") {
            errorContainer.innerHTML += "<p class='text-warning'> Please select a car</p>";
            validated = false;
        }
    }

    return validated;
}


// let checkLastName = function () {
//     let errorContainer = document.getElementById("lastNameError");
//     let input = document.getElementById('lastName').value;
//     let re = new RegExp("[A-Z][a-z]*$");
//     if (re.test(input)) {
//         errorContainer.innerHTML = "";
//         return true
//     } else {
//         errorContainer.innerHTML = "<p class='text-warning'> First name should start with a capital letter and only contain letters</p>";
//         return false
//     }
// };
//
//
// let checkPhoneNumber = function () {
//     let errorContainer = document.getElementById("phoneNumberError");
//     let input = document.getElementById('phoneNumber').value;
//     let re = new RegExp("[0-9]*$");
//     if (re.test(input) && input.length == 11) {
//         errorContainer.innerHTML = "";
//         return true
//     } else {
//         errorContainer.innerHTML = "<p class='text-warning'> Phone number must be made of 11 digits</p>";
//         return false
//     }
// };





