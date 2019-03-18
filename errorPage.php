<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Error Page</title>

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
        <img class="img-fluid" src="img/logo.png" alt="" style="width:5%">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#page-top"> Home </a>
            </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#fleet">Our Fleet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="login.html">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="register.html">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead text-center text-white d-flex">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-12 mx-auto" style="font-size: 500px">
                <h1 class="text-uppercase" style="color: white">
                    <strong>Oops... an error has occurred: </strong>
                </h1>
            </div>
            <div class="col-lg-12 mx-auto" style="font-size: 500px">
                <h2 class="text-uppercase" style="color: white">
                    <strong>
                        <?php
                        if ($_GET) {
                            $errorCode = $_GET['errorCode'];
                            if ($errorCode == 1) {
                                echo "Invalid login details. Please try again.";
                            } elseif ($errorCode == 2) {
                                echo "Insufficient funds. Choose different type of car or contact with your finance manager ";
                            } elseif ($errorCode == 3) {
                                echo "Unfortunately, there are no available driver for this time";
                            } elseif ($errorCode == 4) {
                                echo "Seems like you should not be here";
                            }
                        } else {
                            echo "Oooops seems like no errors. Sorry use back button";
                        }
                        ?>
                    </strong>
                </h2>
                <hr>
            </div>
        </div>
        <div class="col-lg-8 mx-auto">
            <button class="btn btn-primary btn-xl js-scroll-trigger m-1" onclick="history.go(-1)">Back</button>
        </div>
    </div>
    </div>
</header>

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

<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-dark">Copyright &copy; 2019 - BDF</div>
    </div>
</footer>

</body>

</html>
