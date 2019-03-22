<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Confirmation</title>

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
<?php
session_start();
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <img alt="" class="img-fluid" src="img/logo.png" style="width:5%">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="landingPageEmployee.php"> My homepage</a>
            </li>
        </ul>

        <button aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler navbar-toggler-right" data-target="#navbarResponsive" data-toggle="collapse"
                type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link js-scroll-trigger active" href="makeNewBookingPage.html">Make A Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="landingPageEmployee.php#myBookings">View Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="landingPageEmployee.php#myProfile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.html">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--Header dark theme-->
<section class="bg-dark pb-5 pt-5">
</section>

<!--Summary Card-->
<section class="bg-light pt-5">
    <div class="container">
        <form class="card bg-card">
            <div class="card-body">
                <div class="row">

                    <!--Summary content-->
                    <div class="col-md-12 col-lg-6">
                        <div class="pl-0">
                            <h3 class="font-weight-bold"> Booking Confirmation </h3>
                        </div>

                        <!--Pick up address-->
                        <div class="card pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h5 class="text-primary">Pick-up Address</h5>
                                        <div class="row align-items-center">
                                            <div class="col-10 ">
                                                <p> <?php echo $_SESSION["pickup"] ?>  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Drop off address-->
                        <div class="card pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h5 class="text-primary">Drop-off Address</h5>
                                        <div class="row align-items-center">
                                            <div class="col-10 ">
                                                <p> <?php echo  $_SESSION["dropoff"] ?>  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Date of journey-->
                        <div class="card ml-0 pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h5 class="text-primary">Date of Journey</h5>
                                        <p> <?php echo $_SESSION["date"] ?>  </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Time of journey-->
                        <div class="card ml-0 pl-0 my-3 bg-light">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h5 class="text-primary">Time of Journey</h5>
                                        <p> <?php echo $_SESSION["time"] ?>  </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Number of passenger-->
                        <div class="card ml-0 pl-0 my-3 bg-light">
                            <div class="card-body ">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h5 class="text-primary">Number of Passenger</h5>
                                        <p> <?php echo $_SESSION["numberOfPassengers"] ?>  </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Car details -->
                    <div class="card col-12 col-md-5 my-3 bg-light car-card p-0 m-auto" id="e-class">
                        <div class="card-body text-center">
                            <div class="container-fluid">
                                <?php $carType = $_SESSION["carType"];
                                $price = $_SESSION["price"];
                                $link = "";
                                if ($carType == "MEClass") {
                                    $link = "car-list-eclass.png";
                                    $carName = "Mercedes E-Class";
                                    $numOfPass = 4;
                                    $numOfLugg= 2;
                                }elseif ($carType == "MSClass"){
                                    $link = "car-list-sclass1.png";
                                    $carName = "Mercedes S-Class";
                                    $numOfPass = 4;
                                    $numOfLugg= 2;
                                }elseif ($carType == "RRPhantom"){
                                    $link = "car-list-phantom1.png";
                                    $carName = "Rolls-Royce Phantom";
                                    $numOfPass = 4;
                                    $numOfLugg= 2;
                                }elseif ($carType == "BMulsanne"){
                                    $link = "bentley-mulsanne.png";
                                    $carName = "Bentley Mulsanne";
                                    $numOfPass = 4;
                                    $numOfLugg= 2;
                                }elseif ($carType == "RRover"){
                                    $link = "rra1.png";
                                    $carName = "Range Rover";
                                    $numOfPass = 4;
                                    $numOfLugg= 4;
                                }elseif ($carType == "MVClass"){
                                    $link = "V-class-side.png";
                                    $carName = "Mercedes V-Class";
                                    $numOfPass = 6;
                                    $numOfLugg= 2;
                                }
                                ?>
                                <img alt="picture of <?php echo $carName?>" class="container-fluid px-0" src="img/cars/<?php echo $link?>"/>
                                <h5 class="my-3 "><?php echo $carName ?> </h5>
                            </div>
                            <div class="row">
                                <div class="card col-4 offset-1 bg-dark">
                                    <div class="card-body text-light p-0">
                                        <a> <i class="fas fa-1x fa-user-friends text-light"> </i>
                                            <?php echo $numOfPass?> </a>
                                    </div>
                                </div>
                                <div class="card col-4 offset-2 bg-dark">
                                    <div class="card-body text-light p-0">
                                        <a> <i class="fas fa-1x fa-suitcase-rolling text-light"> </i>
                                            <?php echo $numOfLugg?>  </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--price-->
                        <div class="card-footer text-center">
                            <a> <?php echo $price?>  </a>
                        </div>
                    </div>

                </div>

                <!--Confirm button-->
                <div class="row">
                    <div class="col-4 offset-2 mx-auto my-3">
                        <a class="btn btn-primary btn-xl" href="landingPageEmployee.php">Back to My Profile</a>
                    </div>
                    <div class="col-4 offset-2 mx-auto my-3">
                        <a class="btn btn-primary btn-xl" href="makeNewBookingPage.html">Make another booking</a>
                    </div>
                </div>
            </div>
        </form>
        <br>
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

</body>

</html>