function tripInfoForm() {
    addPassengerFields();
    carFilter();
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
    if(numberOfPassengers <= 4 && numberOfLuggage <= 4){
        container.dangerouslySetInnerHTML = (
            <div className="row">
                <div className="card col-12 col-md-5 my-3 bg-light car-card px-0" id="MEClass">
                    <div className="card-body text-center">
                        <div className="container-fluid">
                            <img className="container-fluid px-0" src="../img/cars/car-list-eclass.png"/>
                            <h5 className="my-3">Mercedes E-Class</h5>
                        </div>
                        <div className="row">
                            <div className="card col-4 offset-1 bg-dark">
                                <div className="card-body text-light p-0">
                                    <a> <i className="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                                </div>
                            </div>
                            <div className="card col-4 offset-2 bg-dark">
                                <div className="card-body text-light p-0">
                                    <a> <i className="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--price-->
                    <div className="card-footer text-center">
                        <a id="priceMEClass"> </a>
                    </div>
                </div>


                <div className="card col-12 col-md-5 offset-md-2 my-3 bg-light car-card px-0" id="MSClass">
                    <div className="card-body text-center">
                        <div className="container-fluid">
                            <img className="container-fluid px-0" src="../img/cars/car-list-sclass1.png"/>
                            <h5 className="my-3 ">Mercedes S-Class</h5>
                        </div>
                        <div className="row">
                            <div className="card col-4 offset-1 bg-dark">
                                <div className="card-body text-light p-0">
                                    <a> <i className="fas fa-1x fa-user-friends text-light"> </i> 4 </a>
                                </div>
                            </div>
                            <div className="card col-4 offset-2 bg-dark">
                                <div className="card-body text-light p-0">
                                    <a> <i className="fas fa-1x fa-suitcase-rolling text-light"> </i> 2 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--price-->
                    <div className="card-footer text-center">
                        <a id="priceMSClass"> </a>
                    </div>
                </div>
            </div>)
    }

}


//Passengers Forms
function addPassengerFields() {
    // Number of inputs to create
    var number_passengers = document.getElementById("number_passengers").value;
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("passenger_container");
    // Clear previous contents of the container
    console.log("worked");
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    //Add detail form for passengers
    for (i = 1; i <= number_passengers; i++) {
        // Assemble passenger from
        var passenger_form = document.createElement('div');

        passenger_form.className = "col-sm-12 col-lg-6 mt-md-1 mt-sm-1 mt-1 mt-lg-0 mt-xl-0 mb-4";

        passenger_form.dangerouslySetInnerHTML = (
            <div className="col-sm-12 col-lg-6 mt-md-1 mt-sm-1 mt-1 mt-lg-0 mt-xl-0 mb-4">
                <div className="card bg-card">
                    <div className="card-body">
                        <h4>Passengers 4</h4>
                        <!--<divs class="container">-->
                        <div className="card pl-0 my-3 bg-light">
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-2">
                                        <i className="fas fa-2x fa-address-book text-primary-light my-3"> </i>
                                    </div>
                                    <div className="col-10">
                                        <h5>Name</h5>
                                        <input className="form-control validate" id="passenger_name"
                                               placeholder="Enter name"
                                               type="text"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="card pl-0 my-3 bg-light">
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-2">
                                        <i className="fas fa-2x fa-mail-bulk text-primary-light my-3"> </i>
                                    </div>
                                    <div className="col-10">
                                        <h5>Email</h5>
                                        <input className="form-control validate" id="passenger_email"
                                               placeholder="Enter email"
                                               type="email"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="card ml-0 pl-0 my-3 bg-light">
                            <div className="card-body ">
                                <div className="row">
                                    <div className="col-2">
                                        <i className="fas fa-2x fa-phone text-primary-light my-3"> </i>
                                    </div>
                                    <div className="col-10">
                                        <h5>Mobile number</h5>
                                        <input className="form-control validate" id="passenger_phone"
                                               value="+44"
                                               type="tel"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--</divs>-->
                    </div>
                </div>
            </div>);

    // Append a passenger from
    container.appendChild(passenger_form);
    }
    }




// Old way of forming a passenger forms
//
// abs=   '
//     <div class="card bg-card">\n' +
//         ' <div class="card-body">\n' +
//             ' <h4 class="font-weight-bold">Passengers ' + i + '</h4>\n' +
//             ' <!--<divs class="container">-->\n' +
//             ' <div class="card pl-0 my-3 bg-light">\n' +
//                 ' <div class="card-body">\n' +
//                     ' <div class="row">\n' +
//                         ' <div class="col-2">\n' +
//                             ' <i class="fas fa-2x fa-address-book text-primary-light my-3"></i>\n' +
//                             ' </div>\n' +
//                         ' <div class="col-10">\n' +
//                             ' <h5>First name</h5>\n' +
//                             ' <input class="form-control validate" id="passenger_first_name_' + i + '"\n' +
//         ' placeholder="Enter first name" name="passenger_first_name_' + i + '"\n' +
//         ' type="text">\n' +
//                             ' </div>\n' +
//                         ' </div>\n' +
//                     ' </div>\n' +
//                 ' </div>\n' +
//             ' <div class="card pl-0 my-3 bg-light">\n' +
//                 ' <div class="card-body">\n' +
//                     ' <div class="row">\n' +
//                         ' <div class="col-2">\n' +
//                             ' <i class="fas fa-2x fa-address-book text-primary-light my-3"></i>\n' +
//                             ' </div>\n' +
//                         ' <div class="col-10">\n' +
//                             ' <h5>Last name</h5>\n' +
//                             ' <input class="form-control validate" id="passenger_last_name_' + i + '"\n' +
//         ' placeholder="Enter last name" name="passenger_last_name_' + i + '"\n' +
//         ' type="text">\n' +
//                             ' </div>\n' +
//                         ' </div>\n' +
//                     ' </div>\n' +
//                 ' </div>\n' +
//             ' <div class="card pl-0 my-3 bg-light">\n' +
//                 ' <div class="card-body">\n' +
//                     ' <div class="row">\n' +
//                         ' <div class="col-2">\n' +
//                             ' <i class="fas fa-2x fa-mail-bulk text-primary-light my-3"></i>\n' +
//                             ' </div>\n' +
//                         ' <div class="col-10">\n' +
//                             ' <h5>Email</h5>\n' +
//                             ' <input class="form-control validate" id="passenger_email' + i + '"\n' +
//         ' placeholder="Enter email" name="passenger_email_' + i + '"\n' +
//         ' type="email">\n' +
//                             ' </div>\n' +
//                         ' </div>\n' +
//                     ' </div>\n' +
//                 ' </div>\n' +
//             '\n' +
//             ' <div class="card ml-0 pl-0 my-3 bg-light">\n' +
//                 ' <div class="card-body ">\n' +
//                     ' <div class="row">\n' +
//                         ' <div class="col-2">\n' +
//                             ' <i class="fas fa-2x fa-phone text-primary-light my-3"></i>\n' +
//                             ' </div>\n' +
//                         ' <div class="col-10">\n' +
//                             ' <h5>Mobile number</h5>\n' +
//                             ' <input class="form-control validate" id="passenger_phone' + i + '"\n' +
//         ' value="+44" name="passenger_phone_' + i + '"\n' +
//         ' type="tel">\n' +
//                             ' </div>\n' +
//                         ' </div>\n' +
//                     ' </div>\n' +
//                 ' </div>\n' +
//             ' <!--</divs>-->\n' +
//             ' </div>\n' +
//         ' </div>
// \n' +
// '            </div>';