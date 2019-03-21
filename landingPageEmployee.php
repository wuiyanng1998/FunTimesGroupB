<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <title>Employee homepage</title>

    <!--icon on web-browser tab-->
    <link rel="icon" href="img/logo.png">

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
                <a class="nav-link js-scroll-trigger" href="landingPageEmployee.php">My home</a>
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
                    <a class="nav-link js-scroll-trigger" href="#myBookings">My Bookings</a>
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

<!-- Welcome Page Section -->
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
                        } else {
                            print('No cookie set');
                        }
                        ?>

                        <!-- PHP CODE TO GET FIRST NAME FOR WELCOME SECTION -->
                    </h1>

                    <hr class="divider my-4">
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="makeNewBookingPage.html">Make a
                        booking</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- My Bookings Section -->
<section class="page-section bg-primary" id="myBookings">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-12 text-center container-fluid">
                <h2 class="text-light mt-0">My Bookings</h2>
                <hr class="divider light my-4">
                <div class="container">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="upcoming_tab"
                                       onclick="upcomingTabAJAX()">Upcoming</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-primary" id="history_tab"
                                       onclick="historyTabAJAX()">History</a>
                                </li>
                            </ul>
                        </div>
                        <table bgcolor="#ffd700" class="table-light table-bordered table-hover text-left">
                            <th class="bg-light text-primary p-2">Trip ID</th>
                            <th class="bg-light text-primary p-2">Time</th>
                            <th class="bg-light text-primary p-2">Pick up</th>
                            <th class="bg-light text-primary p-2">Drop off</th>
                            <th class="bg-light text-primary p-2">Car Type</th>
                            <th class="bg-light text-primary p-2">Price</th>
                            <!-- PHP  -->
                            <?php
                            if (isset($_COOKIE["bookerId"])) {
                                $booker_id = $_COOKIE["bookerId"]; ?>
                                <input type="hidden" name="bookerId" id="bookerId" value="<?php echo $booker_id ?>">
                                <?php
                            } else {
                                print('No cookie set');
                            }

                            $qryBooking =
                                "SELECT booking_id, booking_time, start_post_code, end_post_code, service_fee, vehicle_name 
                    FROM booking JOIN route ON route.route_id=booking.route_id JOIN vehicle ON booking.vehicle_id=vehicle.vehicle_id 
                    WHERE booker_id ='$booker_id' AND booking_time > NOW() LIMIT 10";
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
                                        <td class="p-2"><?php echo $row["vehicle_name"] ?></td>
                                        <td class="p-2">£<?php echo $row["service_fee"] ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                print "Error with car cost json encoding";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
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
                        <h5 class="card-subtitle text-primary">Name</h5>

                        <div class="form-control validate border-0 bg-light" id="nameId" type="text">

                            <?php

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT first_name, last_name FROM booker  WHERE user_id = '$user_id'";
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
                        <h5 class="card-subtitle text-primary">Organisation</h5>
                        <div class="form-control validate border-0 bg-light" id="organisationId" type="text">

                            <?php

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT company_name FROM company JOIN booker USING(company_id) WHERE booker.user_id = '$user_id'";
                                $results = mysqli_query($connection, $query);
                                $array = mysqli_fetch_assoc($results);

                                $company_name = $array['company_name'];

                                echo $company_name;
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

                            <?php

                            if (isset($_COOKIE["userId"])) {
                                $user_id = $_COOKIE["userId"];

                                $query = "SELECT phone_number FROM booker WHERE user_id = '$user_id'";
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
                        <div class="form-control validate border-0 bg-light" id="employee_id" type="text">
                            <?php

                            if (isset($_COOKIE["bookerId"])) {
                                $booker_id = $_COOKIE["bookerId"];
                                echo $booker_id;
                                echo '&nbsp';
                            } else {
                                print("Sorry, no cookie read.");
                                header('location: ../errorPage.php?errorCode=4');
                            }
                            ?>
                        </div>
                    </div>

                    <hr class="divider my-2">

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
<script src="js/creative.min.js"></script>
<script src="js/landingPageEmployee.js"></script>

<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-dark">Copyright &copy; 2019 - BDF</div>
    </div>
</footer>

</body>

</html>
