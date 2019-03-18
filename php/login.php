<?php

require_once('phpDatabaseConnection.php');

$identity = $_POST['myIdentity'] ?? 1;
$password = $_POST['password']?? 1;

$connection = connectToDb();
$cookie_email = $_POST['email'] ?? 1;
$get_password = "SELECT password, user_id FROM loginuser WHERE  email = '$cookie_email'";
$results1 = mysqli_query($connection, $get_password);
$array1 = mysqli_fetch_assoc($results1);
$user_id = $array1['user_id'];
$hash = $array1['password'];

if (password_verify($password, $hash)) {

    //Look for user in booker
    $bookerQuery = "SELECT * FROM booker WHERE user_id = '$user_id'";
    $bookerQueryResults = mysqli_query($connection, $bookerQuery);
    $bookerRows = mysqli_num_rows($bookerQueryResults);

    //Look for user in driver
    $driverQuery = "SELECT * FROM driver WHERE user_id = '$user_id'";
    $driverQueryResults = mysqli_query($connection, $driverQuery);
    $driverRows = mysqli_num_rows($driverQueryResults);


    if ($bookerRows != 0) {
        bookerCookies();
    } elseif($driverRows != 0) {
        driverCookies();
    }
    else{
        echo "Error! User is not registered as neither a driver or booker!";
    }
} else {
    echo 'INVALID CREDENTIALS';
}

function bookerCookies()
{
    $connection = connectToDb();
    $cookie_email = $_POST['email'] ?? 1;

    // Build the query statement, shown in two steps as you might need this for your coursework
    $query = "SELECT booker.booker_id, booker.first_name, loginuser.user_id FROM loginuser JOIN booker ON loginuser.user_id = booker.user_id WHERE loginuser.email = '$cookie_email'";

// Execute the query and retrieve the results

    $results = mysqli_query($connection, $query);
    $array = mysqli_fetch_assoc($results);
    $booker_id = $array['booker_id'];
    $first_name = $array['first_name'];
    $user_id = $array['user_id'];

    setcookie("bookerId", $booker_id, time()+(86400*30), "/" );
    setcookie("firstName", $first_name, time()+(86400*30), "/" );
    setcookie("userId", $user_id, time()+(86400*30), "/" );

    echo $_COOKIE["bookerId"] . "<br>" .  $_COOKIE["firstName"] . "<br>" . $_COOKIE["userId"] . "<br>";
    print_r($_COOKIE);
    print(PHP_EOL);

    header('location: ..\landingPageEmployee.php');

    exit;

}

function driverCookies()
{
    $connection = connectToDb();
    $cookie_email = $_POST['email'] ?? 1;

    // Build the query statement, shown in two steps as you might need this for your coursework

    $query = "SELECT driver.driver_id, driver.first_name, loginuser.user_id FROM loginuser JOIN driver ON loginuser.user_id = driver.user_id WHERE loginuser.email = '$cookie_email'";

// Execute the query and retrieve the results

    $results = mysqli_query($connection, $query);
    $array = mysqli_fetch_assoc($results);

    $driver_id = $array['driver_id'];
    $first_name = $array['first_name'];
    $user_id = $array['user_id'];

    setcookie("driverId", $driver_id, time()+(86400*30), "/" );
    setcookie("firstName", $first_name, time()+(86400*30), "/" );
    setcookie("userId", $user_id, time()+(86400*30), "/" );

    echo $_COOKIE["driverId"] . "<br>" .  $_COOKIE["firstName"] . "<br>" . $_COOKIE["userId"] . "<br>";
    print_r($_COOKIE);
    print(PHP_EOL);

    header('location: ..\landingPageDriver.php');


    exit;
}

