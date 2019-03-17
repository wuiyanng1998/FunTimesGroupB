<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <title>Driver homepage</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.css" rel="stylesheet">


</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <img alt="" class="img-fluid" src="img/logo.png" style="width:5%">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="LandingPageDriver.html"> My home</a>
            </li>
        </ul>
        <button aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler navbar-toggler-right" data-target="#navbarResponsive" data-toggle="collapse"
                type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#myCalendar">Quick View</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#myPerformance">My Trips</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#myProfile">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contactUs">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.html">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--Welcome Page-->
<header class="masthead text-center text-white d-flex">
    <div class="container my-auto">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">Welcome,

                        <!-- PHP CODE TO GET FIRST NAME FOR WELCOME SECTION -->
                        <?php
                        require_once('php/phpDatabaseConnection.php');
                        $connection = connectToDb();
                        if (isset($_COOKIE["firstName"])) {
                            $first_name = $_COOKIE["firstName"];
                            print($first_name);
                        }
                        ?>

                        <!-- PHP CODE TO GET FIRST NAME FOR WELCOME SECTION -->

                    </h1>
                    <hr class="divider my-4">
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#myCalendar">Check my calendar</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Quick View -->
<section class="page-section bg-light" id="myCalendar">
    <div class="card bg-light border-light container-fluid">
        <div class="container">

            <h2 class="text-center mt-0">Quick view</h2>
            <hr class="divider my-4">
            <div class="row col-12 mx-auto">
                <div class="card my-3 col-3 mx-auto p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Upcoming trip ID: <br>

                            <!-- need to incorporate javascript to show the closest 2 upcoming trips (ASK ZHASLAN)-->
                            <?php

                            require_once('php/phpDatabaseConnection.php');
                            $connection = connectToDb();

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT booking.booking_id, booking.booking_time FROM booking JOIN driver USING(driver_id) WHERE driver.user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $booking_id = $array['booking_id'];
                                $booking_time = $array['booking_time'];

                                $query2 = "SELECT route.start_address, route.end_address FROM route JOIN booking USING(route_id) WHERE booking.booking_id = '$booking_id'";
                                $results2 = mysqli_query($connection, $query2);
                                $array2 = mysqli_fetch_assoc($results2);

                                $start_address = $array2['start_address'];
                                $end_address = $array2['end_address'];

                                print($booking_id);

                            } else {
                                print("Sorry, no cookie read.");
                            }


                            ?>
                            <i class="fas fa-2x fa-car text-light mb-0 mt-0 float-right"></i></h5>
                    </div>
                    <div class="card-body">

                        <!-- need to make sure that the time of day is here not just the date -->

                        <p class="card-text">Time: <?php print($booking_time); ?></p>
                        <p class="card-text">From: <?php print($start_address); ?></p>
                        <p class="card-text">To: <?php print($end_address); ?></p>
                    </div>
                </div>

                <div class="card my-3 col-3 mx-auto p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Upcoming trip ID: <br>

                            <!-- need to incorporate javascript to show the closest 2 upcoming trips (ASK ZHASLAN)-->
                            <?php

                            require_once('php/phpDatabaseConnection.php');
                            $connection = connectToDb();

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT booking.booking_id, booking.booking_time FROM booking JOIN driver USING(driver_id) WHERE driver.user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $booking_id = $array['booking_id'];
                                $booking_time = $array['booking_time'];

                                $query2 = "SELECT route.start_address, route.end_address FROM route JOIN booking USING(route_id) WHERE booking.booking_id = '$booking_id'";
                                $results2 = mysqli_query($connection, $query2);
                                $array2 = mysqli_fetch_assoc($results2);

                                $start_address = $array2['start_address'];
                                $end_address = $array2['end_address'];

                                print($booking_id);

                            } else {
                                print("Sorry, no cookie read.");
                            }


                            ?>
                            <i class="fas fa-2x fa-car text-light mb-0 mt-0 float-right"></i></h5>
                    </div>
                    <div class="card-body">

                        <!-- need to make sure that the time of day is here not just the date -->

                        <p class="card-text">Time: <?php print($booking_time); ?></p>
                        <p class="card-text">From: <?php print($start_address); ?></p>
                        <p class="card-text">To: <?php print($end_address); ?></p>
                    </div>
                </div>

                <div class="card my-3 col-3 mx-auto p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Upcoming trip ID: <br>

                            <!-- need to incorporate javascript to show the closest 2 upcoming trips (ASK ZHASLAN)-->
                            <?php

                            require_once('php/phpDatabaseConnection.php');
                            $connection = connectToDb();

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT booking.booking_id, booking.booking_time FROM booking JOIN driver USING(driver_id) WHERE driver.user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $booking_id = $array['booking_id'];
                                $booking_time = $array['booking_time'];

                                $query2 = "SELECT route.start_address, route.end_address FROM route JOIN booking USING(route_id) WHERE booking.booking_id = '$booking_id'";
                                $results2 = mysqli_query($connection, $query2);
                                $array2 = mysqli_fetch_assoc($results2);

                                $start_address = $array2['start_address'];
                                $end_address = $array2['end_address'];

                                print($booking_id);

                            } else {
                                print("Sorry, no cookie read.");
                            }


                            ?>
                            <i class="fas fa-2x fa-car text-light mb-0 mt-0 float-right"></i></h5>
                    </div>
                    <div class="card-body">

                        <!-- need to make sure that the time of day is here not just the date -->

                        <p class="card-text">Time: <?php print($booking_time); ?></p>
                        <p class="card-text">From: <?php print($start_address); ?></p>
                        <p class="card-text">To: <?php print($end_address); ?></p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- My Trip -->
<section class="page-section bg-primary" id="myPerformance">

    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="text-light mt-0">My Trips</h2>
            <hr class="divider light my-4">
            <div class="row col-12 mx-auto">
                <!--Calendar view-->
                <div class="card container-fluid m-0 col-12 bg-light border-light my-4 p-3">
                    <h3 class="card-header" id="monthAndYear"></h3>
                    <table class="table table-bordered table-responsive-sm" id="calendar">
                        <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        </thead>

                        <tbody id="calendar-body">

                        </tbody>

                        <input type="hidden" name="selected_date" id="selected_date" value="">

                    </table>

                    <div class="form-inline">

                        <button class="btn btn-primary col-sm-5 mx-auto" id="previous" onclick="previous()">Previous
                        </button>

                        <button class="btn btn-primary col-sm-5 offset-1 mx-auto" id="next" onclick="next()">Next</button>
                    </div>
                    <br/>
                    <form class="form-inline">
                        <label class="lead mr-2 ml-2" for="month">Jump To: </label>
                        <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                            <option value=0>Jan</option>
                            <option value=1>Feb</option>
                            <option value=2>Mar</option>
                            <option value=3>Apr</option>
                            <option value=4>May</option>
                            <option value=5>Jun</option>
                            <option value=6>Jul</option>
                            <option value=7>Aug</option>
                            <option value=8>Sep</option>
                            <option value=9>Oct</option>
                            <option value=10>Nov</option>
                            <option value=11>Dec</option>
                        </select>


                        <label for="year"></label><select class="form-control col-sm-4" name="year" id="year"
                                                          onchange="jump()">
                            <option value=1990>1990</option>
                            <option value=1991>1991</option>
                            <option value=1992>1992</option>
                            <option value=1993>1993</option>
                            <option value=1994>1994</option>
                            <option value=1995>1995</option>
                            <option value=1996>1996</option>
                            <option value=1997>1997</option>
                            <option value=1998>1998</option>
                            <option value=1999>1999</option>
                            <option value=2000>2000</option>
                            <option value=2001>2001</option>
                            <option value=2002>2002</option>
                            <option value=2003>2003</option>
                            <option value=2004>2004</option>
                            <option value=2005>2005</option>
                            <option value=2006>2006</option>
                            <option value=2007>2007</option>
                            <option value=2008>2008</option>
                            <option value=2009>2009</option>
                            <option value=2010>2010</option>
                            <option value=2011>2011</option>
                            <option value=2012>2012</option>
                            <option value=2013>2013</option>
                            <option value=2014>2014</option>
                            <option value=2015>2015</option>
                            <option value=2016>2016</option>
                            <option value=2017>2017</option>
                            <option value=2018>2018</option>
                            <option value=2019>2019</option>
                            <option value=2020>2020</option>
                            <option value=2021>2021</option>
                            <option value=2022>2022</option>
                            <option value=2023>2023</option>
                            <option value=2024>2024</option>
                            <option value=2025>2025</option>
                            <option value=2026>2026</option>
                            <option value=2027>2027</option>
                            <option value=2028>2028</option>
                            <option value=2029>2029</option>
                            <option value=2030>2030</option>
                        </select></form>
                </div>

                <div class="card container-fluid m-0 col-12 bg-light border-light my-4 p-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="upcoming_tab" onclick="upcomingTabAJAX()">Next 10
                                    trips</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link text-primary" id="history" onclick="historyTabAJAX()">Last
                                    10 trips</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link text-primary" id="selectedDay">Trips on selected day</a>
                            </li>
                        </ul>
                    </div>
                    <table bgcolor="#ffd700" class="table-light table-bordered table-hover text-left">
                        <th class="bg-light text-primary p-2">Trip ID</th>
                        <th class="bg-light text-primary p-2">Time</th>
                        <th class="bg-light text-primary p-2">Pick up</th>
                        <th class="bg-light text-primary p-2">Drop off</th>
                        <th class="bg-light text-primary p-2">Number of passengers</th>
                        <th class="bg-light text-primary p-2">Car Type</th>

                        <!-- PHP  -->
                        <?php
                        if (isset($_COOKIE["driverId"])) {
                            $driver_id = $_COOKIE["driverId"]; ?>
                            <input type="hidden" name="driverId" id="driverId" value="<?php echo $driver_id ?>">
                            <?php
                        } else {
                            print('No cookie set');
                        }

                        $qryBooking =
                            "SELECT booking_id, booking_time, start_post_code, end_post_code, number_of_travelers, vehicle_name 
                             FROM booking JOIN route ON route.route_id=booking.route_id JOIN vehicle ON 
                             booking.vehicle_id=vehicle.vehicle_id WHERE booker_id ='" . $driver_id . "' AND booking_time > NOW() LIMIT 10";
                        ?>
                        <tbody id="myBookingTable">
                        <?php
                        if ($result = mysqli_query($connection, $qryBooking)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td class="p-2"><?php echo $row["booking_id"] ?></td>
                                    <td class="p-2"><?php echo $row["booking_time"] ?></td>
                                    <td class="p-2"><?php echo $row["start_post_code"] ?></td>
                                    <td class="p-2"><?php echo $row["end_post_code"] ?></td>
                                    <td class="p-2"><?php echo $row["number_of_travelers"] ?></td>
                                    <td class="p-2"><?php echo $row["vehicle_name"] ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- My Profile Section -->
<section class="page-section bg-light" id="myProfile">
    <div class="container">
        <h2 class="text-center mt-0">My Profile</h2>
        <hr class="divider my-4">
        <div class="row container-fluid px-1 py-1 bg-light mx-auto">

            <!--Basic info card-->
            <div class="card mx-auto mb-3 col-md-5 col-12 text-center bg-card">
                <div class="card-body px-0 mt-2">
                    <i class="fas fa-4x fa-address-card text-primary mb-4"></i>
                    <h3 class="card-title mb-2 text-dark">Basic info</h3>
                    <div class="container bg-light p-2 text-left">
                        <h5 class="card-subtitle text-primary">

                            Name </h5>
                        <div class="form-control validate border-0 bg-light" id="nameId" type="text">

                            <?php

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT first_name, last_name FROM driver  WHERE user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $first_name = $array['first_name'];
                                $last_name = $array['last_name'];

                                echo $first_name . ' ' . $last_name;
                                echo '&nbsp';

                            } else {
                                print("Sorry, no cookie read.");
                            }
                            ?>

                        </div>


                    </div>

                    <hr class="divider my-2">

                    <div class="container bg-light p-2 text-left">
                        <h5 class="card-subtitle text-primary">Email</h5>
                        <div class="form-control validate border-0 bg-light" id="email" type="email">

                            <?php

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT email FROM loginuser  WHERE user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $email = $array['email'];

                                echo $email;
                                echo '&nbsp';

                            } else {
                                print("Sorry, no cookie read.");
                            }
                            ?>

                        </div>
                    </div>


                    <hr class="divider my-2">

                    <div class="container bg-light p-2 text-left">
                        <h5 class="card-subtitle text-primary">Telephone</h5>
                        <div class="form-control validate border-0 bg-light" id="telephone" type="tel">

                            <!--WHAT TO DO WITH THE OTHER BLOCKS - DOESNT REALLY MAKE SENSE -->

                            <?php

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT phone_number FROM driver WHERE user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $phone_number = $array['phone_number'];

                                echo $phone_number;
                                echo '&nbsp';

                            } else {
                                print("Sorry, no cookie read.");
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

            <!--Account info card-->
            <div class="card mx-auto mb-3 col-md-5 col-12 text-center bg-card">
                <div class="card-body mt-2">
                    <i class="fas fa-4x fa-address-book text-primary mb-4"></i>
                    <h3 class="card-title mb-2 text-dark">Account info</h3>
                    <div class="container bg-light p-2 text-left">
                        <h5 class="card-subtitle text-primary">Employee ID</h5>
                        <input class="form-control validate border-0 bg-light" id="employeeId"
                               value="098094" type="text">
                    </div>

                    <hr class="divider my-2">

                    <div class="container bg-light p-2 text-left">
                        <h5 class="card-subtitle text-primary">Account password</h5>
                        <input class="form-control validate border-0 bg-light" id="accountPassword"
                               value="123245685" type="password">
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

<!-- Contact Us -->
<section class="bg-primary" id="contactUs">
    <div class="container text-light">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-heading bg">Contact Us</h2>
                <hr class="my-4">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center">
                <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
                <p>+44 77 6666 8888</p>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
                <p>
                    <a class="text-light" href="mailto:your-email@your-domain.com">executive@ballerdrivefancy.cars</a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/creative.js"></script>
<script src="js/calendar.js"></script>
<script src="js/landingPageDriver.js"></script>


<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-dark">Copyright &copy; 2019 - BDF</div>
    </div>
</footer>

</body>

</html>
